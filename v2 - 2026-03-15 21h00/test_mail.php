<?php
/**
 * test_mail.php — Diagnostic SMTP SannaStudio
 * Mets ce fichier à la racine du site et accède à : https://sannastudio.ca/test_mail.php
 * SUPPRIME-LE après le test !
 */

// ── CONFIG — modifie ces valeurs ──────────────────────────────────────────
$host     = 'ssp.en.gp';
$port     = 465;
$user     = 're-reply@ssp.en.gp';   // ← ton vrai compte Plesk
$pass     = '69i%24Qtd';     // ← mdp du compte re-reply
$to       = 'thibaut.hozanne@ssp.en.gp'; // ← adresse de réception test
$from     = 're-reply@ssp.en.gp';
// ─────────────────────────────────────────────────────────────────────────

echo '<pre style="font-family:monospace;background:#111;color:#0f0;padding:20px;font-size:13px">';
echo "=== TEST SMTP SANNASTUDIO ===\n\n";

// Test 1 : PHP mail() natif
echo "── TEST 1 : mail() natif PHP ──\n";
$r = mail($to, 'Test mail() natif - SannaStudio', "Ceci est un test via mail() natif.\n", "From: $from\r\n");
echo $r ? "✔ mail() envoyé (pas de garantie de livraison)\n" : "✘ mail() a échoué\n";

echo "\n── TEST 2 : Connexion socket SSL port 465 ──\n";

$ctx = stream_context_create(['ssl' => [
    'verify_peer'      => false,
    'verify_peer_name' => false,
    'allow_self_signed'=> true,
]]);

$sock = @stream_socket_client("ssl://$host:$port", $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $ctx);

if (!$sock) {
    echo "✘ Impossible de se connecter à ssl://$host:$port\n";
    echo "  Erreur $errno : $errstr\n";
    echo "\n── TEST 3 : Connexion TLS port 587 ──\n";
    $sock2 = @stream_socket_client("tcp://$host:587", $errno2, $errstr2, 15);
    if (!$sock2) {
        echo "✘ Port 587 aussi inaccessible : $errstr2\n";
    } else {
        echo "✔ Port 587 accessible !\n";
        echo "  → Change MAIL_PORT à 587 et MAIL_SECURE à 'tls' dans defines.php\n";
        fclose($sock2);
    }
    echo "\n── TEST 4 : Connexion port 25 ──\n";
    $sock3 = @stream_socket_client("tcp://$host:25", $errno3, $errstr3, 15);
    echo $sock3 ? "✔ Port 25 accessible\n" : "✘ Port 25 : $errstr3\n";
    if ($sock3) fclose($sock3);
} else {
    echo "✔ Connexion SSL établie sur $host:$port\n";
    
    $log = [];
    
    $read = function() use ($sock, &$log) {
        $buf = '';
        stream_set_timeout($sock, 5);
        while (!feof($sock)) {
            $line = fgets($sock, 512);
            if ($line === false) break;
            $buf .= $line;
            $log[] = "  S: ".trim($line);
            if (strlen($line) >= 4 && $line[3] === ' ') break;
        }
        return $buf;
    };
    
    $send = function(string $cmd) use ($sock, &$log, $read) {
        $log[] = "  C: $cmd";
        fwrite($sock, $cmd."\r\n");
        return $read();
    };

    $banner = $read();
    echo "Banner: ".trim(explode("\n", $banner)[0])."\n";

    $ehlo = $send("EHLO $host");
    echo "EHLO: ".trim(explode("\n", $ehlo)[0])."\n";

    $authR = $send("AUTH LOGIN");
    echo "AUTH LOGIN: ".trim(explode("\n", $authR)[0])."\n";

    $userR = $send(base64_encode($user));
    echo "Username: ".trim(explode("\n", $userR)[0])."\n";

    $passR = $send(base64_encode($pass));
    echo "Password: ".trim(explode("\n", $passR)[0])."\n";

    if (strpos($passR, '235') !== false) {
        echo "\n✔✔✔ AUTHENTIFICATION RÉUSSIE !\n\n";

        $send("MAIL FROM:<$from>");
        $send("RCPT TO:<$to>");
        $send("DATA");
        
        $msg  = "Date: ".date('r')."\r\n";
        $msg .= "From: SannaStudio <$from>\r\n";
        $msg .= "To: $to\r\n";
        $msg .= "Subject: =?UTF-8?B?".base64_encode('Test SMTP SannaStudio ✔')."?=\r\n";
        $msg .= "MIME-Version: 1.0\r\n";
        $msg .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
        $msg .= "Le SMTP fonctionne ! Ce mail a été envoyé via ssl://$host:$port\n";
        
        fwrite($sock, $msg."\r\n.\r\n");
        $dataR = $read();
        echo "Envoi: ".trim(explode("\n", $dataR)[0])."\n";
        echo strpos($dataR, '250') !== false ? "\n✔ MAIL ENVOYÉ !\n" : "\n✘ Échec envoi : $dataR\n";
        
        $send("QUIT");
    } else {
        echo "\n✘ AUTHENTIFICATION ÉCHOUÉE\n";
        echo "  Code reçu: ".trim($passR)."\n";
        echo "\n  → Vérifier le mot de passe dans Plesk\n";
        echo "  → Vérifier que 're-reply@ssp.en.gp' est le bon compte\n";
        $send("QUIT");
    }
    
    fclose($sock);
    
    echo "\n── LOG COMPLET ──\n";
    foreach ($log as $l) echo $l."\n";
}

echo "\n── INFOS SERVEUR ──\n";
echo "PHP version : ".PHP_VERSION."\n";
echo "OpenSSL     : ".(extension_loaded('openssl') ? 'Activé ✔' : 'DÉSACTIVÉ ✘')."\n";
echo "allow_url_fopen : ".(ini_get('allow_url_fopen') ? 'On' : 'Off')."\n";
echo "SMTP ini    : ".(ini_get('SMTP') ?: '(non défini)')."\n";
echo "sendmail    : ".(ini_get('sendmail_path') ?: '(non défini)')."\n";

echo "\n=== FIN DU TEST ===\n";
echo '</pre>';