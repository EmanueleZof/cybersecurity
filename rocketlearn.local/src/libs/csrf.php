<?php
/**
 * Genera un token CSRF univoco e lo salva nella sessione.
 *
 * Questa funzione genera un token CSRF utilizzando md5 combinato con un valore univoco
 * generato da uniqid e mt_rand. Il token generato viene quindi salvato nella sessione
 * sotto l'indice specificato per l'utilizzo nelle verifiche CSRF.
 * Restituisce il token CSRF appena generato.
 *
 * @return string Il token CSRF generato.
 */
function createCSRFToken() {
    $token = md5(uniqid(mt_rand(), true));
    $_SESSION[CSRF]['token'] = $token;
    return $token;
}

/**
 * Elimina il token CSRF dalla sessione corrente.
 *
 * Questa funzione rimuove il token CSRF dalla sessione corrente,
 * rendendolo non più disponibile per le verifiche CSRF.
 */
function deleteCSRFToken() {
    unset($_SESSION[CSRF]['token']);
}

/**
 * Blocca la connessione corrente con una risposta "405 Method Not Allowed".
 *
 * Questa funzione imposta l'intestazione HTTP per rispondere con
 * lo stato "405 Method Not Allowed" e termina l'esecuzione dello script.
 */
function blockConnection() {
    header($_SERVER['SERVER_PROTOCOL'].' 405 Method Not Allowed');
    exit;
}
?>