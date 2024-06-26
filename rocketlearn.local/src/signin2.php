<?php
const GENERIC = 'Qualcosa è andato storto, riprova più tardi';
const CODE_INVALID = 'Il codice inserito non è valido';
const CODE_REQUIRED = 'Inserire un codice';

$inputs = [];
$errors = [];

if (isUserLoggedIn()) {
    redirectTo('courses.php');
}

if (isGetRequest()) {
    unset($_SESSION[LOGIN]['verification']);
    redirectTo('signin.php');
}

if (isPostRequest()) {
    // Input sanitization
    $userCode = filter_input(INPUT_POST, 'userCode', FILTER_SANITIZE_NUMBER_INT);
    $csfrToken = filter_input(INPUT_POST, 'csfrToken', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $inputs['userCode'] = $userCode;

    //CSFR check
    if (!$csfrToken || $csfrToken !== $_SESSION[CSRF]['token']) {
        // flashMessage('flash_CSFR', GENERIC);
        blockConnection();
    } else {
        //deleteCSRFToken();
    }

    // Input validation
    if ($userCode) {
        $userCode = filter_var($userCode, FILTER_VALIDATE_INT);
        if ($userCode == false) {
            $errors['userCode'] = CODE_INVALID;
        }
    } else {
        $errors['userCode'] = CODE_REQUIRED;
    }

    // Database operations
    $conn = connectDB();
    if (!$conn) {
        $errors['generic'] = GENERIC;
    }

    if (validateGACode($_SESSION[USER]['gaSecret'], $inputs['userCode'])) {
        signInUser($conn, $_SESSION[USER]['email']);
        unset($_SESSION[LOGIN]);
        redirectTo('courses.php');
    } else {
        signOutUser();
        unset($_SESSION[LOGIN]['verification']);
        flashMessage('flash_2fa', 'Il codice inserito non è valido, riprova.');
        redirectTo('signin.php');
    }
}
?>