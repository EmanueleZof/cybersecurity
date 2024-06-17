<?php
const EMAIL_REQUIRED = 'Please enter your email';
const EMAIL_INVALID = 'Please enter a valid email';
const PASSWORD_REQUIRED = 'Please enter your pasword';

$inputs = [];
$errors = [];

if (isPostRequest()) {
    // User Email
    $email = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
    $inputs['email'] = $email;
    if ($email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $errors['email'] = EMAIL_INVALID;
        }
    } else {
        $errors['email'] = EMAIL_REQUIRED;
    }

    // Password
    $password = $_POST['userPassword'];
    $inputs['password'] = $password;
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