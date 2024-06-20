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

    $flash_message = $_SESSION[FLASH][$name];

    unset($_SESSION[FLASH][$name]);

    echo '<div class="alert alert-'.$type.'" role="alert">'.$flash_message.'</div>';
}
?>