<?php
function isAlreadyRegistered($db, $userName, $userEmail) {
    $sql = 'SELECT user_ID FROM users WHERE user_name = "'.$userName.'" OR user_email = "'.$userEmail.'"';
    $query = mysqli_query($db, $sql);
    return mysqli_num_rows($query) == 0 ? false : true;
}
?>