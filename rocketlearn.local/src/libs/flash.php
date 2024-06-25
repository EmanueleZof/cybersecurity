<?php
const FLASH = 'FLASH_MESSAGES';

/**
 * Imposta un messaggio flash nella sessione.
 *
 * Imposta un messaggio flash nella sessione con il nome specificato, sovrascrivendo eventuali messaggi esistenti con lo stesso nome.
 * Il messaggio è memorizzato come un array contenente il testo del messaggio e il tipo di messaggio (default 'danger').
 *
 * @param string $name Il nome del messaggio flash.
 * @param string $message Il testo del messaggio flash da mostrare all'utente.
 * @param string $type (Opzionale) Il tipo di messaggio ('danger' di default).
 * @return void
 */
function flashMessage($name, $message, $type='danger') {
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

/**
 * Mostra e rimuove un messaggio flash dalla sessione.
 *
 * Mostra un messaggio flash dalla sessione con il nome specificato e lo rimuove subito dopo la visualizzazione.
 * Il messaggio è formattato come un div con classe alert che dipende dal tipo di messaggio ('success', 'info', 'warning', 'danger').
 *
 * @param string $name Il nome del messaggio flash da visualizzare e rimuovere.
 * @return void
 */
function displayFlashMessage($name) {
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }

    $flashMessage = $_SESSION[FLASH][$name];

    unset($_SESSION[FLASH][$name]);

    echo '<div class="alert alert-'.$flashMessage['type'].'" role="alert">'.$flashMessage['message'].'</div>';
}

/**
 * Mostra e rimuove tutti i messaggi flash dalla sessione.
 *
 * Mostra tutti i messaggi flash presenti nella sessione e li rimuove subito dopo la visualizzazione.
 * Ogni messaggio è formattato come un div con classe alert che dipende dal tipo di messaggio ('success', 'info', 'warning', 'danger').
 *
 * @return void
 */
function displayAllFlashMessages() {
    if (!isset($_SESSION[FLASH])) {
        return;
    }

    $flashMessages = $_SESSION[FLASH];

    unset($_SESSION[FLASH]);

    foreach ($flashMessages as $flashMessage) {
        echo '<div class="alert alert-'.$flashMessage['type'].'" role="alert">'.$flashMessage['message'].'</div>';
    }
}
?>