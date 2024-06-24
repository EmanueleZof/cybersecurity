<?php
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function altchaValidation($payload, $hmacKey) {
        $data = json_decode(base64_decode($payload), true);
        $challenge = hash('sha256', $data['salt'].$data['number']);
        $signature = hash_hmac('sha256', $challenge, $hmacKey);
     
        if ($data['algorithm'] == 'SHA-256') {
           if($data['challenge'] == $challenge) {
              if ($data['signature'] == $signature) {
                 return true;
              }
           }
        }
        return false;
     }
?>