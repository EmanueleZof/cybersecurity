<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = SMTP_HOST;
$mail->Port       = SMTP_PORT;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = true;
$mail->Username   = SMTP_USER;
$mail->Password   = SMTP_PASSWORD;
$mail->isHTML(true);

/**
 * Invia un'email utilizzando le impostazioni SMTP configurate globalmente.
 *
 * Invia un'email utilizzando l'oggetto globale `$GLOBALS['mail']` configurato con le impostazioni SMTP.
 * Imposta il mittente, il destinatario, l'oggetto e il corpo del messaggio, inclusa un'alternativa (se specificato).
 * Restituisce true se l'email è stata inviata con successo, altrimenti false e registra l'errore nel log degli errori.
 *
 * @param string $toEmail L'indirizzo email del destinatario.
 * @param string $subject L'oggetto dell'email.
 * @param string $body Il corpo principale dell'email in formato HTML.
 * @param string $altBody (Opzionale) Il corpo alternativo dell'email in formato testuale semplice.
 * @return bool True se l'email è stata inviata con successo, altrimenti false.
 */
function sendEmail($toEmail, $subject, $body, $altBody = '') {
    $GLOBALS['mail']->setFrom(SMTP_USER, 'FromEmail');
    $GLOBALS['mail']->addAddress($toEmail, 'ToEmail');
    
    $GLOBALS['mail']->Subject = $subject;
    $GLOBALS['mail']->Body    = $body;
    $GLOBALS['mail']->AltBody = $altBody;

    if(!$GLOBALS['mail']->send()) {
        error_log('Mailer: '.$GLOBALS['mail']->ErrorInfo, 1, ADMIN_EMAIL);
        return false;
    } else {
       return true;
    }
}
?>