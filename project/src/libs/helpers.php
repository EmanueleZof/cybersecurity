<?php
function view($filename, $data = []) {
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require_once __DIR__ . '/../inc/' . $filename . '.php';
}
?>