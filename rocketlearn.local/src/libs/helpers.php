<?php
/**
 * Carica e visualizza un file di vista PHP con i dati specificati.
 *
 * Questa funzione permette di visualizzare un file PHP situato nella directory 'inc'.
 * I dati forniti vengono estratti in variabili individuali disponibili nella vista.
 *
 * @param string $filename Il nome del file di vista (senza estensione) da caricare.
 * @param array $data Un array associativo di dati da estrarre come variabili per la vista.
 */
function view($filename, $data = []) {
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require __DIR__ . '/../inc/' . $filename . '.php';
}

/**
 * Sanifica un input utente rimuovendo spazi, backslash e convertendo i caratteri speciali.
 *
 * @param string $data Il dato di input da sanificare.
 * @return string Il dato sanificato.
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Verifica se la richiesta HTTP è di tipo POST.
 *
 * @return bool True se la richiesta è di tipo POST, altrimenti False.
 */
function isPostRequest() {
    return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}

/**
 * Verifica se la richiesta HTTP è di tipo GET.
 *
 * @return bool True se la richiesta è di tipo GET, altrimenti False.
 */
function isGetRequest() {
    return strtoupper($_SERVER['REQUEST_METHOD']) == 'GET';
}

/**
 * Visualizza gli errori in un formato HTML.
 *
 * @param array $errors Array di messaggi di errore da visualizzare.
 */
function displayErrors($errors) {
    echo '<div class="alert alert-danger" role="alert"><ul class="m-0">';
    foreach($errors as $error) {
        echo '<li>'.$error.'</li>';
    }
    echo '</ul></div>';
}

/**
 * Reindirizza l'utente a un URL specificato.
 *
 * @param string $url L'URL a cui reindirizzare l'utente.
 */
function redirectTo($url) {
    header('Location:' . $url);
    exit;
}

/**
 * Reindirizza l'utente a un URL specificato con un messaggio flash.
 *
 * @param string $url L'URL a cui reindirizzare l'utente.
 * @param string $message Il messaggio flash da visualizzare.
 * @param string $type Il tipo di messaggio flash (default 'success').
 */
function redirectWithMessage($url, $message, $type='success') {
    flashMessage('flash_'.uniqid(), $message, $type);
    redirectTo($url);
}
?>