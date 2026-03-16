<?php
/**
 * Mailer — envoi SMTP SSL via ssp.en.gp:465
 */
class Mailer {

    private static function smtp(string $to, string $toName, string $subject, string $htmlBody): bool {
        $host     = MAIL_HOST;
        $port     = MAIL_PORT;
        $user     = MAIL_USER;
        $pass     = MAIL_PASS;
        $from     = MAIL_FROM;
        $fromName = MAIL_FROM_NAME;

        $boundary = md5(uniqid());
        $textBody = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $htmlBody));

        $headers  = "Date: ".date('r')."\r\n";
        $headers .= "From: =?UTF-8?B?".base64_encode($fromName)."?= <$from>\r\n";
        $headers .= "To: =?UTF-8?B?".base64_encode($toName)."?= <$to>\r\n";
        $headers .= "Subject: =?UTF-8?B?".base64_encode($subject)."?=\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
        $headers .= "X-Mailer: SannaStudio/1.0\r\n";

        $body  = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($textBody))."\r\n";
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($htmlBody))."\r\n";
        $body .= "--$boundary--\r\n";

        $message = $headers."\r\n".$body;

        // Connexion SSL
        $ctx = stream_context_create(['ssl' => [
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true,
        ]]);

        $sock = @stream_socket_client("ssl://$host:$port", $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $ctx);
        if (!$sock) {
            error_log("[Mailer] Connexion échouée : $errstr ($errno)");
            return false;
        }

        stream_set_timeout($sock, 10);

        // Lecture d'une réponse SMTP (supporte les réponses multi-lignes)
        $read = function() use ($sock): string {
            $buf = '';
            while (!feof($sock)) {
                $line = fgets($sock, 512);
                if ($line === false) break;
                $buf .= $line;
                // Ligne finale : "XXX " (code + espace, pas tiret)
                if (strlen($line) >= 4 && $line[3] === ' ') break;
            }
            return $buf;
        };

        $send = function(string $cmd) use ($sock, $read): string {
            fwrite($sock, $cmd."\r\n");
            return $read();
        };

        $read(); // Banner 220

        $ehlo = $send("EHLO $host");
        // Si EHLO multi-lignes, tout lire
        while (strlen($ehlo) >= 4 && isset($ehlo[3]) && $ehlo[3] === '-') {
            $ehlo = $read();
        }

        $send("AUTH LOGIN");
        $send(base64_encode($user));
        $r = $send(base64_encode($pass));

        if (strpos($r, '235') === false) {
            error_log("[Mailer] Auth échouée pour $user : ".trim($r));
            fclose($sock);
            return false;
        }

        $send("MAIL FROM:<$from>");
        $send("RCPT TO:<$to>");
        $send("DATA");
        fwrite($sock, $message."\r\n.\r\n");
        $r = $read();
        $send("QUIT");
        fclose($sock);

        $ok = strpos($r, '250') !== false;
        if (!$ok) error_log("[Mailer] Envoi échoué vers $to : ".trim($r));
        return $ok;
    }

    // ── Emails ────────────────────────────────────────────────────────────

    public static function sendBienvenue(Client $client, string $tokenVerify): bool {
        $lien   = SITE_URL.'/verify?token='.$tokenVerify;
        $prenom = htmlspecialchars($client->getPrenom());

        $html = <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="font-family:Arial,sans-serif;background:#0a0a0a;color:#fff;padding:40px 20px;margin:0">
<div style="max-width:560px;margin:0 auto;background:#111;border-radius:12px;overflow:hidden">
  <div style="background:#e63946;padding:30px;text-align:center">
    <h1 style="margin:0;font-size:28px;letter-spacing:2px">SANNASTUDIO</h1>
    <p style="margin:6px 0 0;opacity:.8;font-size:13px">Webdiffusion Professionnelle</p>
  </div>
  <div style="padding:36px 32px">
    <h2 style="margin-top:0;color:#e63946">Bienvenue, {$prenom}&nbsp;!</h2>
    <p style="color:#ccc;line-height:1.7">
      Votre compte SannaStudio a bien été créé.<br>
      Cliquez sur le bouton ci-dessous pour confirmer votre adresse email.
    </p>
    <div style="text-align:center;margin:32px 0">
      <a href="{$lien}" style="background:#e63946;color:#fff;text-decoration:none;padding:14px 32px;border-radius:8px;font-weight:bold;font-size:15px;display:inline-block">
        ✔ Confirmer mon email
      </a>
    </div>
    <p style="color:#555;font-size:12px;text-align:center">
      Ou copiez ce lien : {$lien}<br><br>
      Lien valide 48h. Si vous n'avez pas créé de compte, ignorez cet email.
    </p>
    <hr style="border:none;border-top:1px solid #222;margin:24px 0">
    <p style="color:#555;font-size:12px;text-align:center;margin:0">
      SannaStudio — Webdiffusion &amp; Intégration Audiovisuelle<br>
      contact@sannastudio.ca | sannastudio.ca
    </p>
  </div>
</div>
</body></html>
HTML;
        return self::smtp(
            $client->getEmail(),
            $client->getNomComplet(),
            'Bienvenue sur SannaStudio — Confirmez votre email',
            $html
        );
    }

    public static function sendResetPassword(Client $client, string $token): bool {
        $lien   = SITE_URL.'/reset-password?token='.$token;
        $prenom = htmlspecialchars($client->getPrenom());

        $html = <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="font-family:Arial,sans-serif;background:#0a0a0a;color:#fff;padding:40px 20px;margin:0">
<div style="max-width:560px;margin:0 auto;background:#111;border-radius:12px;overflow:hidden">
  <div style="background:#e63946;padding:30px;text-align:center">
    <h1 style="margin:0;font-size:28px;letter-spacing:2px">SANNASTUDIO</h1>
  </div>
  <div style="padding:36px 32px">
    <h2 style="margin-top:0;color:#e63946">Réinitialisation du mot de passe</h2>
    <p style="color:#ccc;line-height:1.7">Bonjour {$prenom},<br><br>
    Vous avez demandé à réinitialiser votre mot de passe.</p>
    <div style="text-align:center;margin:32px 0">
      <a href="{$lien}" style="background:#e63946;color:#fff;text-decoration:none;padding:14px 32px;border-radius:8px;font-weight:bold;font-size:15px;display:inline-block">
        🔑 Réinitialiser mon mot de passe
      </a>
    </div>
    <p style="color:#666;font-size:12px;text-align:center">Ce lien expire dans 1 heure.</p>
    <hr style="border:none;border-top:1px solid #222;margin:24px 0">
    <p style="color:#555;font-size:12px;text-align:center;margin:0">SannaStudio — contact@sannastudio.ca</p>
  </div>
</div>
</body></html>
HTML;
        return self::smtp(
            $client->getEmail(),
            $client->getNomComplet(),
            'Réinitialisation de votre mot de passe — SannaStudio',
            $html
        );
    }

    public static function sendRdvConfirm(string $toEmail, string $toName, string $service, string $date): bool {
        $prenom = htmlspecialchars($toName);
        $svc    = htmlspecialchars($service);
        $dt     = htmlspecialchars($date);

        $html = <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="font-family:Arial,sans-serif;background:#0a0a0a;color:#fff;padding:40px 20px;margin:0">
<div style="max-width:560px;margin:0 auto;background:#111;border-radius:12px;overflow:hidden">
  <div style="background:#e63946;padding:30px;text-align:center">
    <h1 style="margin:0;font-size:28px;letter-spacing:2px">SANNASTUDIO</h1>
  </div>
  <div style="padding:36px 32px">
    <h2 style="margin-top:0;color:#e63946">Demande reçue ✔</h2>
    <p style="color:#ccc;line-height:1.7">Bonjour {$prenom},<br><br>
    Votre demande de rendez-vous pour <strong>{$svc}</strong>
    (date souhaitée : <strong>{$dt}</strong>) a bien été reçue.<br>
    Notre équipe vous contactera dans les <strong>24 heures</strong>.</p>
    <hr style="border:none;border-top:1px solid #222;margin:24px 0">
    <p style="color:#555;font-size:12px;text-align:center;margin:0">
      SannaStudio — contact@sannastudio.ca | +1 (367) 382-5551
    </p>
  </div>
</div>
</body></html>
HTML;
        return self::smtp($toEmail, $toName, 'Votre demande de RDV — SannaStudio', $html);
    }
}