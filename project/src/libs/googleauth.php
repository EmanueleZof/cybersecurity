<?php
use Google\Authenticator\GoogleAuthenticator;

require_once __DIR__ . '/GoogleAuthenticator/src/FixedBitNotation.php';
require_once __DIR__ . '/GoogleAuthenticator/src/GoogleAuthenticatorInterface.php';
require_once __DIR__ . '/GoogleAuthenticator/src/GoogleAuthenticator.php';
require_once __DIR__ . '/GoogleAuthenticator/src/GoogleQrUrl.php';
require_once __DIR__ . '/GoogleAuthenticator/src/RuntimeException.php';

$g = new GoogleAuthenticator();

function genereateGASecret() {
    return $GLOBALS['g']->generateSecret();
}

function getQRCode($userName, $userSecret) {
    echo '<img src="'.$GLOBALS['g']->getURL($userName, 'localhost', $userSecret).'" />';
}
?>