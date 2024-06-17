<?php
require __DIR__ . '/../config/auth.php';

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$salt = generateRandomString();
$secretNumber = random_int(999, 999999);
$challenge = hash('sha256', $salt.$secretNumber);
$signature = hash_hmac('sha256', $challenge, $HMAC_KEY);
$response = array(
    'algorithm' => 'SHA-256', 
    'challenge' => $challenge, 
    'salt' => $salt, 
    'signature' => $signature
);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>