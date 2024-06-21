<?php
function createToken() {
    $token = md5(uniqid(mt_rand(), true));
    $_SESSION[CSRF]['token'] = $token;
    return $token;
}
?>