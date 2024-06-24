<?php
function view($filename, $data = []) {
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require __DIR__ . '/../inc/' . $filename . '.php';
}

// TODO: to remove
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isPostRequest() {
    return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}

function isGetRequest() {
    return strtoupper($_SERVER['REQUEST_METHOD']) == 'GET';
}

function displayErrors($errors) {
    echo '<div class="alert alert-danger" role="alert"><ul class="m-0">';
    foreach($errors as $error) {
        echo '<li>'.$error.'</li>';
    }
    echo '</ul></div>';

}

function redirectTo($url) {
    header('Location:' . $url);
    exit;
}

function redirectWithMessage($url, $message, $type='success') {
    flashMessage('flash_'.uniqid(), $message, $type);
    redirectTo($url);
}
?>