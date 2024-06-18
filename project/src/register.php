<?php
const USERNAME_REQUIRED = 'Inserire un nome utente';
const USEREMAIL_INVALID = 'L\'email inserita non è valida';
const USEREMAIL_REQUIRED = 'Inserire un indirizzo email';
const USERPASSWORD_INVALID = 'La password inserita non rispetta i criteri';
const USERPASSWORD_REQUIRED = 'Inserire una password';
const REPEATPASSWORD_INVALID = 'La password inserita è diversa';
const REPEATPASSWORD_REQUIRED = 'Ripetere la password';
const ALTCHA_INVALID = 'Probabilmente sei un robot';
const ALTCHA_REQUIRED = 'Verifica il captcha';

$inputs = [];
$errors = [];

if (isPostRequest()) {
    // Input sanitization
    $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
    $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_UNSAFE_RAW);
    $repeatedPassword = filter_input(INPUT_POST, 'repeatedPassword', FILTER_UNSAFE_RAW);
    $altcha = filter_input(INPUT_POST, 'altcha', FILTER_UNSAFE_RAW);

    $inputs['userName'] = $userName;
    $inputs['userEmail'] = $userEmail;
    $inputs['userPassword'] = $userPassword;
    $inputs['repeatedPassword'] = $repeatedPassword;
    $inputs['altcha'] = $altcha;

    // Input validation
    if ($userName) {
        $userName = trim($userName);
        if ($userName == '') {
            $errors['userName'] = USERNAME_REQUIRED;
        }
    } else {
        $errors['userName'] = USERNAME_REQUIRED;
    }

    if ($userEmail) {
        $userEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);
        if ($userEmail == false) {
            $errors['userEmail'] = USEREMAIL_INVALID;
        }
    } else {
        $errors['userEmail'] = USEREMAIL_REQUIRED;
    }

    if ($userPassword) {
        $userPassword = filter_var($userPassword, FILTER_VALIDATE_REGEXP, array(
            'options' => array('regexp' => '#[a-z]+#')
        ));
        if ($userPassword == false) {
            $errors['userPassword'] = USERPASSWORD_INVALID;
        }
    } else {
        $errors['userPassword'] = USERPASSWORD_REQUIRED;
    }

    if ($repeatedPassword) {
        $repeatedPassword = trim($repeatedPassword);
        if ($userPassword != $repeatedPassword) {
            $errors['userPassword'] = REPEATPASSWORD_INVALID;
        }
    } else {
        $errors['userPassword'] = REPEATPASSWORD_REQUIRED;
    }

    if ($altcha) {
        $altcha = trim($altcha);
        if ($altcha == '') {
            $errors['altcha'] = ALTCHA_INVALID;
        }
    } else {
        $errors['altcha'] = ALTCHA_REQUIRED;
    }

    print_r($inputs);
    print_r($errors);
}
?>