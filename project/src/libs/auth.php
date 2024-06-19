<?php
function isAlreadyRegistered($db, $inputs) {
    $sql = 'SELECT user_ID FROM users WHERE user_name = "'.$inputs['userName'].'" OR user_email = "'.$inputs['userEmail'].'"';
    
    $query = mysqli_query($db, $sql);
    
    return mysqli_num_rows($query) == 0 ? false : true;
}

function registerUser($db, $inputs) {
    $passwordHash = password_hash($inputs['userPassword'], PASSWORD_BCRYPT);
    $generateCode = bin2hex(random_bytes(16));
    $activationCode = password_hash($generateCode, PASSWORD_DEFAULT);
    $expiry = 1 * 24  * 60 * 60;
    $activationExpiry = date('Y-m-d H:i:s',  time() + $expiry);
    
    $sql = 'INSERT INTO users (user_name, user_password, user_email, activation_code, activation_expiry) 
            VALUES ("'.$inputs['userName'].'", "'.$passwordHash.'", "'.$inputs['userEmail'].'", "'.$activationCode.'", "'.$activationExpiry.'")';
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        return true;
    }

    return false;
}
?>