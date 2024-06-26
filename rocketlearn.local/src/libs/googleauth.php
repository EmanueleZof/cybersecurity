<?php
use Google\Authenticator\GoogleAuthenticator;

require_once __DIR__ . '/GoogleAuthenticator/src/FixedBitNotation.php';
require_once __DIR__ . '/GoogleAuthenticator/src/GoogleAuthenticatorInterface.php';
require_once __DIR__ . '/GoogleAuthenticator/src/GoogleAuthenticator.php';
require_once __DIR__ . '/GoogleAuthenticator/src/GoogleQrUrl.php';
require_once __DIR__ . '/GoogleAuthenticator/src/RuntimeException.php';

$g = new GoogleAuthenticator();

/**
 * Genera un nuovo segreto per Google Authenticator.
 *
 * @return string Il segreto generato.
 */
function genereateGASecret() {
    return $GLOBALS['g']->generateSecret();
}

/**
 * Genera e visualizza il codice QR per Google Authenticator.
 *
 * @param string $userName Il nome dell'utente.
 * @param string $userSecret Il segreto dell'utente.
 */
function getQRCode($userName, $userSecret) {
    echo '<img src="'.$GLOBALS['g']->getURL($userName, 'localhost', $userSecret).'" />';
}

/**
 * Valida il codice di autenticazione Google Authenticator.
 *
 * @param string $userSecret Il segreto dell'utente.
 * @param string $code Il codice da validare.
 * @return bool Restituisce true se il codice è valido, altrimenti false.
 */
function validateGACode($userSecret, $code) {
    $code = strval($code);
    if ($GLOBALS['g']->checkCode($userSecret, $code)) {
        return true;
    } 
    return false;
}
?>