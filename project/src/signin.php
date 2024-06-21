<?php
const GENERIC = 'Qualcosa è andato storto, riprova più tardi';
const USEREMAIL_INVALID = 'L\'email inserita non è valida';
const USEREMAIL_REQUIRED = 'Inserire un indirizzo email';
const USERPASSWORD_INVALID = 'La password inserita non rispetta i criteri';
const USERPASSWORD_REQUIRED = 'Inserire una password';

$inputs = [];
$errors = [];

if (isPostRequest()) {
    // Input sanitization
    $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
    $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_UNSAFE_RAW);
    $csfrToken = filter_input(INPUT_POST, 'csfrToken', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $inputs['userEmail'] = $userEmail;
    $inputs['userPassword'] = $userPassword;

    //CSFR check
    if (!$csfrToken || $csfrToken !== $_SESSION[CSRF]['token']) {
        // flashMessage('flash_CSFR', GENERIC);
        blockConnection();
    } else {
        //deleteCSRFToken();
    }

    // Input validation
    if ($userEmail) {
        $userEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);
        if ($userEmail == false) {
            $errors['userEmail'] = USEREMAIL_INVALID;
        }
    } else {
        $errors['userEmail'] = USEREMAIL_REQUIRED;
    }

    if ($userPassword) {
        $userPassword = trim($userPassword);
        if ($userPassword == '') {
            $errors['userPassword'] = USERPASSWORD_REQUIRED;
        }
    } else {
        $errors['userPassword'] = USERPASSWORD_REQUIRED;
    }

    // Database operations
    $conn = connectDB();
    if (!$conn) {
        $errors['generic'] = GENERIC;
    }

    if (count($errors) == 0) {

    }

    disconnectDB($conn);
}
?>