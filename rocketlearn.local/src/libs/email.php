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