<?php
function isAlreadyRegistered($db, $inputs) {
    $sql = 'SELECT user_ID FROM users WHERE user_name = "'.$inputs['userName'].'" OR user_email = "'.$inputs['userEmail'].'"';
    
    $query = mysqli_query($db, $sql);
    
    return mysqli_num_rows($query) == 0 ? false : true;
}

function generateActivationCode() {
    return bin2hex(random_bytes(16));
}

function registerUser($db, $inputs, $activationCode) {
    $passwordHash = password_hash($inputs['userPassword'], PASSWORD_BCRYPT);
    $activationCode = password_hash($activationCode, PASSWORD_DEFAULT);
    $expiry = 1 * 24  * 60 * 60;
    $activationExpiry = date('Y-m-d H:i:s',  time() + $expiry);
    
    $sql = 'INSERT INTO users (user_name, user_password, user_email, activation_code, activation_expiry) 
            VALUES ("'.$inputs['userName'].'", "'.$passwordHash.'", "'.$inputs['userEmail'].'", "'.$activationCode.'", "'.$activationExpiry.'")';
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        return [true, $activationExpiry];
    }

    return [false, ''];
}

function sendActivationEmail($email, $activationCode, $activationExpiry) {
    $activationLink = APP_URL.'/activate.php?email='.$email.'&activation_code='.$activationCode;

    $subject = 'Rocket Learn - Attiva il tuo account';

    $bodyHtml = '<p>Clicca sul seguente link per attivare il tuo account:</p>';
    $bodyHtml .= '<p><a href="'.$activationLink.'">Attiva il tuo account</a></p>';
    $bodyHtml .= '<p><b>Puoi attivare il tuo account fino al: '.$activationExpiry.'</b> altrimenti dovrai ripetere la registrazione.</p>';

    $mail = sendEmail($email, $subject, $bodyHtml);
    return $mail;
}
?>