<?php
const EMAIL_REQUIRED = 'Please enter your email';
const EMAIL_INVALID = 'Please enter a valid email';
const PASSWORD_REQUIRED = 'Please enter your pasword';

$inputs = [];
$errors = [];

if (isPostRequest()) {
    // Input sanitization
    $email = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
    $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_UNSAFE_RAW);

    $inputs['email'] = $email;
    $inputs['userPassword'] = $userPassword;

    //CSFR check
    if (!$csfrToken || $csfrToken !== $_SESSION[CSRF]['token']) {
        $errors['generic'] = GENERIC;
    } else {
        unset($_SESSION[CSRF]['token']);
    }

    // Input validation
    if ($email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $errors['email'] = EMAIL_INVALID;
        }
    } else {
        $errors['email'] = EMAIL_REQUIRED;
    }

    // Password
    if ($password) {
        //$email = hash();
    } else {
        $errors['password'] = PASSWORD_REQUIRED;
    }

    // Check on DB

    print_r($inputs);
    print_r($errors);
}
?>