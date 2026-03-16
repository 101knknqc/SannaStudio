<?php
class Mailer {

    // ── Logo SSP en base64 (inline pour les mails) ──────────────────
    private static function getLogoBase64(): string {
        $path = PATH_MODELS.'/../assets/img/logo-white.png';
        if (file_exists($path)) {
            return base64_encode(file_get_contents($path));
        }
        return '';
    }

    private static function header(string $title = ''): string {
        $logo64 = self::getLogoBase64();
        $img = $logo64
            ? '<img src="data:image/png;base64,'.$logo64.'" alt="SannaStudio" style="height:40px;filter:brightness(0) invert(1)">'
            : '<span style="font-family:Arial,sans-serif;font-size:22px;font-weight:900;letter-spacing:3px;color:#fff">SANNASTUDIO</span>';
        return '
        <div style="background:linear-gradient(135deg,#1a0a2e,#2d1060);padding:28px 36px;text-align:center;border-bottom:2px solid #7B2FBE">
            '.$img.'
            '.($title ? '<p style="margin:10px 0 0;color:rgba(255,255,255,.6);font-size:13px;font-family:Arial,sans-serif;letter-spacing:1px;text-transform:uppercase">'.$title.'</p>' : '').'
        </div>';
    }

    private static function footer(): string {
        return '
        <div style="padding:20px 36px;border-top:1px solid #1e1e1e;text-align:center">
            <p style="color:#444;font-size:11px;font-family:Arial,sans-serif;margin:0;line-height:1.7">
                SannaStudio — Webdiffusion &amp; Intégration Audiovisuelle<br>
                <a href="mailto:contact@sannastudio.ca" style="color:#7B2FBE;text-decoration:none">contact@sannastudio.ca</a>
                &nbsp;|&nbsp;
                <a href="https://sannastudio.ca" style="color:#7B2FBE;text-decoration:none">sannastudio.ca</a>
            </p>
        </div>';
    }

    private static function wrap(string $body): string {
        return '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
        <body style="margin:0;padding:40px 20px;background:#0a0a0a;font-family:Arial,sans-serif">
        <div style="max-width:560px;margin:0 auto;background:#111;border-radius:14px;overflow:hidden;border:1px solid rgba(123,47,190,.25)">
        '.$body.'
        </div></body></html>';
    }

    // ── SMTP robuste ─────────────────────────────────────────────────
    private static function smtp(string $to, string $toName, string $subject, string $html): bool {
        $host     = MAIL_HOST;
        $port     = MAIL_PORT;
        $user     = MAIL_USER;
        $pass     = MAIL_PASS;
        $from     = MAIL_FROM;
        $fromName = MAIL_FROM_NAME;

        $boundary = md5(uniqid());
        $text = strip_tags(str_replace(['<br>','<br/>','<br />'], "\n", $html));

        // ── Construire les headers ──
        $headers  = "Date: ".date('r')."\r\n";
        $headers .= "From: =?UTF-8?B?".base64_encode($fromName)."?= <$from>\r\n";
        $headers .= "To: =?UTF-8?B?".base64_encode($toName)."?= <$to>\r\n";
        $headers .= "Subject: =?UTF-8?B?".base64_encode($subject)."?=\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
        $headers .= "X-Mailer: SannaStudio/2.0\r\n";

        $body  = "--$boundary\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($text))."\r\n";
        $body .= "--$boundary\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($html))."\r\n";
        $body .= "--$boundary--\r\n";

        // ── Connexion SSL (port 465) ──
        $ctx = stream_context_create(['ssl' => [
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true,
        ]]);

        $sock = @stream_socket_client(
            "ssl://$host:$port",
            $errno, $errstr, 20,
            STREAM_CLIENT_CONNECT,
            $ctx
        );

        if (!$sock) {
            error_log("[Mailer] Connexion échouée vers $host:$port — $errstr ($errno)");
            return false;
        }

        stream_set_timeout($sock, 15);

        // ── Helpers lecture / écriture ──
        $readAll = function() use ($sock): string {
            $buf = '';
            while (!feof($sock)) {
                $line = fgets($sock, 512);
                if ($line === false) break;
                $buf .= $line;
                // Dernière ligne du bloc SMTP : le 4e caractère est un espace
                if (strlen($line) >= 4 && $line[3] === ' ') break;
            }
            return $buf;
        };

        $send = function(string $cmd) use ($sock, $readAll): string {
            fwrite($sock, $cmd."\r\n");
            return $readAll();
        };

        // ── Dialogue SMTP ──
        $readAll(); // Bannière de bienvenue

        // EHLO avec hostname local (pas le host distant)
        $ehloHost = gethostname() ?: 'localhost';
        $ehloResp = $send("EHLO $ehloHost");

        // AUTH LOGIN
        $send("AUTH LOGIN");
        $send(base64_encode($user));
        $authResp = $send(base64_encode($pass));

        if (strpos($authResp, '235') === false) {
            error_log("[Mailer] Auth échouée pour $user : ".trim($authResp));
            fclose($sock);
            return false;
        }

        $send("MAIL FROM:<$from>");
        $send("RCPT TO:<$to>");
        $send("DATA");

        fwrite($sock, $headers."\r\n".$body."\r\n.\r\n");
        $dataResp = $readAll();

        $send("QUIT");
        fclose($sock);

        $ok = strpos($dataResp, '250') !== false;
        if (!$ok) {
            error_log("[Mailer] Envoi échoué vers $to : ".trim($dataResp));
        }
        return $ok;
    }

    // ── Emails ────────────────────────────────────────────────────────

    public static function sendWelcome(User $user, string $token): bool {
        $link   = SITE_URL.'/verify?token='.$token;
        $prenom = htmlspecialchars($user->getFirstName());

        $html = self::wrap(
            self::header('Webdiffusion Professionnelle').
            '<div style="padding:36px 36px 28px">
                <h2 style="margin:0 0 12px;color:#9B4FDE;font-size:22px">Bienvenue, '.$prenom.' !</h2>
                <p style="color:#ccc;line-height:1.8;font-size:14px">
                    Votre compte SannaStudio a bien été créé.<br>
                    Une seule étape restante : confirmer votre adresse email.
                </p>
                <div style="text-align:center;margin:30px 0">
                    <a href="'.$link.'" style="background:#7B2FBE;color:#fff;text-decoration:none;padding:14px 36px;border-radius:8px;font-weight:bold;font-size:15px;display:inline-block;letter-spacing:1px">
                        ✔ Confirmer mon email
                    </a>
                </div>
                <p style="color:#555;font-size:11px;text-align:center;word-break:break-all">
                    Ou copiez ce lien :<br>
                    <a href="'.$link.'" style="color:#7B2FBE">'.$link.'</a>
                </p>
                <p style="color:#444;font-size:11px;text-align:center;margin-top:16px">
                    Lien valide 48h. Si vous n\'avez pas créé de compte, ignorez cet email.
                </p>
            </div>'.
            self::footer()
        );

        return self::smtp(
            $user->getEmail(),
            $user->getFullName(),
            'Bienvenue sur SannaStudio — Confirmez votre email',
            $html
        );
    }

    public static function sendAccountConfirmed(User $user): bool {
        $prenom = htmlspecialchars($user->getFirstName());

        $html = self::wrap(
            self::header('Compte activé').
            '<div style="padding:36px 36px 28px">
                <div style="text-align:center;margin-bottom:24px">
                    <div style="width:64px;height:64px;background:rgba(123,47,190,.15);border:2px solid #7B2FBE;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:28px">✔</div>
                </div>
                <h2 style="margin:0 0 12px;color:#9B4FDE;font-size:22px;text-align:center">Compte confirmé !</h2>
                <p style="color:#ccc;line-height:1.8;font-size:14px;text-align:center">
                    Bonjour '.$prenom.',<br><br>
                    Votre compte SannaStudio est maintenant <strong style="color:#9B4FDE">actif et vérifié</strong>.<br>
                    Vous pouvez dès maintenant vous connecter et accéder à votre espace client.
                </p>
                <div style="text-align:center;margin:30px 0">
                    <a href="'.SITE_URL.'/connexion" style="background:#7B2FBE;color:#fff;text-decoration:none;padding:14px 36px;border-radius:8px;font-weight:bold;font-size:15px;display:inline-block;letter-spacing:1px">
                        → Accéder à mon espace
                    </a>
                </div>
                <div style="background:rgba(123,47,190,.08);border:1px solid rgba(123,47,190,.2);border-radius:8px;padding:16px 20px;margin-top:8px">
                    <p style="color:#9B4FDE;font-size:11px;font-weight:bold;margin:0 0 8px;letter-spacing:1px;text-transform:uppercase">Ce que vous pouvez faire</p>
                    <p style="color:#888;font-size:13px;margin:0;line-height:1.8">
                        📅 Faire une demande de rendez-vous<br>
                        📋 Suivre l\'avancement de vos projets<br>
                        💬 Contacter l\'équipe directement
                    </p>
                </div>
            </div>'.
            self::footer()
        );

        return self::smtp(
            $user->getEmail(),
            $user->getFullName(),
            'Votre compte SannaStudio est activé ✔',
            $html
        );
    }

    public static function sendResetPassword(User $user, string $token): bool {
        $link   = SITE_URL.'/reset-password?token='.$token;
        $prenom = htmlspecialchars($user->getFirstName());

        $html = self::wrap(
            self::header('Sécurité du compte').
            '<div style="padding:36px 36px 28px">
                <h2 style="margin:0 0 12px;color:#9B4FDE;font-size:22px">Réinitialisation du mot de passe</h2>
                <p style="color:#ccc;line-height:1.8;font-size:14px">
                    Bonjour '.$prenom.',<br>
                    Vous avez demandé à réinitialiser votre mot de passe. Cliquez ci-dessous :
                </p>
                <div style="text-align:center;margin:30px 0">
                    <a href="'.$link.'" style="background:#7B2FBE;color:#fff;text-decoration:none;padding:14px 36px;border-radius:8px;font-weight:bold;font-size:15px;display:inline-block">
                        🔑 Réinitialiser mon mot de passe
                    </a>
                </div>
                <p style="color:#555;font-size:11px;text-align:center">Ce lien expire dans 1 heure.</p>
                <p style="color:#444;font-size:11px;text-align:center;margin-top:8px">
                    Si vous n\'avez pas demandé cette réinitialisation, ignorez cet email.
                </p>
            </div>'.
            self::footer()
        );

        return self::smtp(
            $user->getEmail(),
            $user->getFullName(),
            'Réinitialisation de votre mot de passe — SannaStudio',
            $html
        );
    }

    public static function sendAppointmentConfirm(string $email, string $name, string $service, string $date): bool {
        $n = htmlspecialchars($name);
        $s = htmlspecialchars($service);
        $d = htmlspecialchars($date);

        $html = self::wrap(
            self::header('Demande de rendez-vous').
            '<div style="padding:36px 36px 28px">
                <h2 style="margin:0 0 12px;color:#9B4FDE;font-size:22px">Demande reçue ✔</h2>
                <p style="color:#ccc;line-height:1.8;font-size:14px">
                    Bonjour '.$n.',<br><br>
                    Votre demande de rendez-vous pour <strong style="color:#fff">'.$s.'</strong>
                    (date souhaitée : <strong style="color:#fff">'.$d.'</strong>) a bien été reçue.<br>
                    Notre équipe vous contactera dans les <strong style="color:#9B4FDE">24 heures</strong>.
                </p>
                <div style="background:rgba(123,47,190,.1);border:1px solid rgba(123,47,190,.25);border-radius:8px;padding:16px 20px;margin-top:24px">
                    <p style="color:#9B4FDE;font-size:12px;font-weight:bold;margin:0 0 6px;letter-spacing:1px;text-transform:uppercase">Notre promesse</p>
                    <p style="color:#aaa;font-size:13px;margin:0;line-height:1.6">Réponse sous 24h ouvrables — Devis personnalisé et sans engagement.</p>
                </div>
            </div>'.
            self::footer()
        );

        return self::smtp($email, $name, 'Votre demande de RDV — SannaStudio', $html);
    }
}
