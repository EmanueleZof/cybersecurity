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

function passwordValidation($password, $copyPassword, $userName) {
   $lowercase = '#[a-z]+#';
   $uppercase = '#[A-Z]+#';
   $numbers = '#[0-9]+#';
   $special = '/[!@#$%^&*()+=._-]/';
   $emoji = '/([0-9#][\x{20E3}])|[\x{00ae}\x{00a9}\x{203C}\x{2047}\x{2048}\x{2049}\x{3030}\x{303D}\x{2139}\x{2122}\x{3297}\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u';


   if ($password != '' && $copyPassword != '') {
      if (strlen($password) >= 12) {
         if (preg_match($lowercase, $password)) {
            if (preg_match($uppercase, $password)) {
               if (preg_match($numbers, $password)) {
                  if (preg_match($special, $password)) {
                     if (strpos($password, ' ') == false) {
                        if (!preg_match($emoji, $password)) {
                           if (strpos($password, $userName) == false) {
                              if ($password == $copyPassword) {
                                 return true;
                              }
                           }
                        }
                     }
                  }
               }
            }
         }
      }
   }
   return false;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['userName']) && isset($_POST['userEmail']) && isset($_POST['userPassword']) && isset($_POST['repeatedPassword']) && isset($_POST['altcha'])) {
      // Input sanitization
      $input['userName'] = sanitizeInput($_POST['userName']);
      $input['userEmail'] = sanitizeInput($_POST['userEmail']);
      $input['userPassword'] = sanitizeInput($_POST['userPassword']);
      $input['repeatedPassword'] = sanitizeInput($_POST['repeatedPassword']);
      $input['altcha'] = sanitizeInput($_POST['altcha']);

      // Input validation
      if ($input['userName'] == '') {
         error('Lo user name inserito non è valido');
      }
      if ($input['userEmail'] == '' || !filter_var($input['userEmail'], FILTER_VALIDATE_EMAIL)) {
         error('L\'email inserita non è valida');
      }
      if (!passwordValidation($input['userPassword'], $input['repeatedPassword'], $input['userName'])) {
         error('La password inserita è diversa');
      }
      if ($input['altcha'] == '' || !altchaValidation($input['altcha'], $hmacKey)) {
         error('Il captcha non è valido');
      }

      // Database operations
      $conn = mysqli_connect($db['server'], $db['user'], $db['password'], $db['name']);
      if (!$conn) {
         error_log('registration.php - DB connection: '.mysqli_connect_error(), 1, $alertAddress);
         error();
      }

      $searchUsers = 'SELECT user_ID FROM users WHERE user_name = "'.$input['userName'].'" OR user_email = "'.$input['userEmail'].'"';
      $alreadyRegisteredUsers = mysqli_query($conn, $searchUsers);
      if (mysqli_num_rows($alreadyRegisteredUsers) == 0) {
         $passwordHash = password_hash($input['userPassword'], PASSWORD_BCRYPT);
         $insertUser = 'INSERT INTO users (user_name, user_password, user_email) VALUES ("'.$input['userName'].'", "'.$passwordHash.'", "'.$input['userEmail'].'")';
         if (mysqli_query($conn, $insertUser)) {
            echo "OK";
         } else {
            echo "Error: <br>" . mysqli_error($conn);
         }
      } else {
         error('Esiste già un utente con la stesso nome od indirizzo email');
      }

      mysqli_close($conn);
   } else {
      error();
   }
} else {
   error();
}
?>