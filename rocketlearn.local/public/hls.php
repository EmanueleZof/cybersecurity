<?php
require __DIR__ . '/../src/bootstrap.php';

$filePath = '../src/hls/enc.key';

if (isGetRequest()) {
    if (file_exists($filePath)) {
        if (isUserLoggedIn()) {
            $length = filesize($filePath);
            header('Accept-Ranges: bytes');
            header('Content-Length: '.$length);
            readfile($filePath);
        } else {
            header($_SERVER['SERVER_PROTOCOL'].' 401 Unauthorized');
            die();
        }
    } else {
        header($_SERVER['SERVER_PROTOCOL'].' 404 File not found');
        die();
    }
} else {
    header($_SERVER['SERVER_PROTOCOL'].' 405 Method Not Allowed');
    die();
}
?>