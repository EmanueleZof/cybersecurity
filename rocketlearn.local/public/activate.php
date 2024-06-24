<?php
require __DIR__ . '/../src/bootstrap.php';

const GENERIC = 'Qualcosa è andato storto, riprova più tardi';
const EXPIRED = 'Il codice di verifica non è valido, devi rifare la registrazione';
const USEREMAIL_REQUIRED = 'L\' indirizzo email non è valido';
const ACTIVATIONCODE_REQUIRED = 'Il codice di attivazione non è valido';

$inputs = [];
$errors = [];

if (isGetRequest()) {
    // Input sanitization
    $userEmail = filter_input(INPUT_GET, 'userEmail', FILTER_SANITIZE_EMAIL);
    $activationCode = filter_input(INPUT_GET, 'activationCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $inputs['userEmail'] = $userEmail;
    $inputs['activationCode'] = $activationCode;

    // Input validation
    if ($userEmail) {
        $userEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);
        if ($userEmail == false) {
            $errors['userEmail'] = USEREMAIL_REQUIRED;
        }
    } else {
        $errors['userEmail'] = USEREMAIL_REQUIRED;
    }

    if ($activationCode) {
        $activationCode = trim($activationCode);
        if ($activationCode == '') {
            $errors['activationCode'] = ACTIVATIONCODE_REQUIRED;
        }
    } else {
        $errors['activationCode'] = ACTIVATIONCODE_REQUIRED;
    }

    // Database operations
    $conn = connectDB();
    if (!$conn) {
        $errors['generic'] = GENERIC;
    }

    if (count($errors) == 0) {
        $user = findUnverifiedUser($conn, $inputs['userEmail'], $inputs['activationCode']);
        if ($user && activateUser($conn, $user['user_ID'])) {
            unset($_SESSION[REGISTRATION]['verification']);
            $_SESSION[REGISTRATION]['completed'] = $inputs['userEmail'];
            $_SESSION[USER]['userID'] = $user['user_ID'];
            $_SESSION[USER]['gaSecret'] = $user['user_ga_secret'];
            //redirectTo('register.php');
            redirectTo('genqrcode.php');
        } else {
            $errors['generic'] = EXPIRED;
        }
    }

    disconnectDB($conn);
}

unset($_SESSION[REGISTRATION]);
redirectWithMessage('register.php', end($errors), $type='danger');
?>