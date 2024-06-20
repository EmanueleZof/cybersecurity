<?php
const FLASH = 'FLASH_MESSAGES';

function flashMessage($name, $message, $type) {
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

function displayFlashMessage($name) {
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }

    $flashMessage = $_SESSION[FLASH][$name];

    unset($_SESSION[FLASH][$name]);

    echo '<div class="alert alert-'.$flashMessage['type'].'" role="alert">'.$flashMessage['message'].'</div>';
}

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