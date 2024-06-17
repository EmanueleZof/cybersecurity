<?php
function view($filename, $data = []) {
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

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
?>