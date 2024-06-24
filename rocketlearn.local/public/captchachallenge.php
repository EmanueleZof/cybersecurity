<?php
require_once __DIR__ . '/../config/altcha.php';
require_once __DIR__ . '/../src/libs/altcha.php';

$salt = generateRandomString();
$secretNumber = random_int(RANGE_MIN, RANGE_MAX);
$challenge = hash('sha256', $salt.$secretNumber);
$signature = hash_hmac('sha256', $challenge, HMAC_KEY);
$response = array(
    'algorithm' => 'SHA-256', 
    'challenge' => $challenge, 
    'salt' => $salt, 
    'signature' => $signature
);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>