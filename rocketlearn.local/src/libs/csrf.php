<?php
function createCSRFToken() {
    $token = md5(uniqid(mt_rand(), true));
    $_SESSION[CSRF]['token'] = $token;
    return $token;
}

function deleteCSRFToken() {
    unset($_SESSION[CSRF]['token']);
}

function blockConnection() {
    header($_SERVER['SERVER_PROTOCOL'].' 405 Method Not Allowed');
    exit;
}
?>