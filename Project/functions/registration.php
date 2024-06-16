<?php
include '../config.php';
include '../functions.php';

session_start();
unset($_SESSION['registrationError']);

$input = array(
   'userName' => '',
   'userEmail' => '',
   'userPassword' => '',
   'repeatedPassword' => '',
   'altcha' => ''
);

function error($message = 'Qualcosa è andato storto, ripeti la registrazione.') {
   $_SESSION['registrationError'] = $message;
   header('Location: ../register.php');
}

function altchaValidation($payload) {
   $data = json_decode(base64_decode($payload), true);
   
   print_r($data);

   $challenge = hash('sha256', $data['salt'].$data['number']);
   $signature = hash_hmac('sha256', $challenge, $hmacKey);

   //signature_ok = equals(data.signature, hmac_sha2_hex(data.challenge, hmac_key))

   if ($data['algorithm'] == 'SHA-256') {
      if($data['challenge'] == $challenge) {
         if ($data['signature'] == $signature) {
            print_r($signature);
            return true;
         }
      }
   }
   return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['userName']) && isset($_POST['userEmail']) && isset($_POST['userPassword']) && isset($_POST['repeatedPassword']) && isset($_POST['altcha'])) {
      $input['userName'] = sanitizeInput($_POST['userName']);
      $input['userEmail'] = sanitizeInput($_POST['userEmail']);
      $input['userPassword'] = sanitizeInput($_POST['userPassword']);
      $input['repeatedPassword'] = sanitizeInput($_POST['repeatedPassword']);
      $input['altcha'] = sanitizeInput($_POST['altcha']);

      /*if ($input['userName'] == '') {
         error('Lo user name inserito non è valido');
      }
      if ($input['userEmail'] == '') {
         error('L\'email inserita non è valida');
      }
      if ($input['userPassword'] != $input['repeatedPassword']) {
         error('La password inserita è diversa');
      }
      if ($input['altcha'] == '' || !altchaValidation($input['altcha'])) {
         error('Il captcha non è valido');
      }*/

      echo 'Test:<br>';
      print_r($_POST);
      echo '<br>';
      print_r($input);
      echo '<br>';
      altchaValidation($input['altcha']);
   } else {
      error();
   }
} else {
   error();
}
?>