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
    $activationLink = APP_URL.'/activate.php?userEmail='.$email.'&activationCode='.$activationCode;

    $subject = 'Rocket Learn - Attiva il tuo account';

    $bodyHtml = '<p>Clicca sul seguente link per attivare il tuo account:</p>';
    $bodyHtml .= '<p><a href="'.$activationLink.'">Attiva il tuo account</a></p>';
    $bodyHtml .= '<p><b>Puoi attivare il tuo account fino al: '.$activationExpiry.'</b> altrimenti dovrai ripetere la registrazione.</p>';

    $mail = sendEmail($email, $subject, $bodyHtml);
    return $mail;
}

function deleteUserByID($db, $id, $active = 0) {
    $sql = 'DELETE FROM users
            WHERE user_ID ='.$id.' and active='.$active;
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        return true;
    }
    return false;
}

function findUnverifiedUser($db, $email, $activationCode) {
    $sql = 'SELECT user_ID, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND user_email="'.$email.'"';
    
    $query = mysqli_query($db, $sql);

    if ($query && mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);
        if ($user['expired'] == 1) {
            deleteUserByID($db, $user['user_ID']);
            return null;
        }
        if (password_verify($activationCode, $user['activation_code'])) {
            return $user;
        }
    }
    return null;
}

function activateUser($db, $userID) {
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE id='.$userID;

    $query = mysqli_query($db, $sql);

    if ($query) {
        return true;
    }
    return false;
}
?>