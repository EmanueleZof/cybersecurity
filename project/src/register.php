<?php
const GENERIC = 'Qualcosa è andato storto, riprova più tardi';
const USERNAME_REQUIRED = 'Inserire un nome utente';
const USEREMAIL_INVALID = 'L\'email inserita non è valida';
const USEREMAIL_REQUIRED = 'Inserire un indirizzo email';
const USERPASSWORD_INVALID = 'La password inserita non rispetta i criteri';
const USERPASSWORD_REQUIRED = 'Inserire una password';
const REPEATPASSWORD_INVALID = 'La password inserita è diversa';
const REPEATPASSWORD_REQUIRED = 'Inserire nuovamente la password';
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
    $csfrToken = filter_input(INPUT_POST, 'csfrToken', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $inputs['userName'] = $userName;
    $inputs['userEmail'] = $userEmail;
    $inputs['userPassword'] = $userPassword;
    $inputs['repeatedPassword'] = $repeatedPassword;

    //CSFR check
    if (!$csfrToken || $csfrToken !== $_SESSION[CSRF]['token']) {
        $errors['generic'] = GENERIC;
    }

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
            'options' => array(
                'regexp' => '/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()+=._-])(?!.*\s)(?!.*([0-9#][\x{20E3}])|[\x{00ae}\x{00a9}\x{203C}\x{2047}\x{2048}\x{2049}\x{3030}\x{303D}\x{2139}\x{2122}\x{3297}\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?)/u',
            )
        ));
        if ($userPassword == false || strlen($userPassword) < 12 || strpos($userPassword, $userName) != false) {
            $errors['userPassword'] = USERPASSWORD_INVALID;
        }
    } else {
        $errors['userPassword'] = USERPASSWORD_REQUIRED;
    }

    if ($repeatedPassword) {
        $repeatedPassword = trim($repeatedPassword);
        if ($userPassword != $repeatedPassword) {
            $errors['repeatedPassword'] = REPEATPASSWORD_INVALID;
        }
    } else {
        $errors['repeatedPassword'] = REPEATPASSWORD_REQUIRED;
    }

    if ($altcha) {
        $altcha = trim($altcha);
        if (!altchaValidation($altcha, HMAC_KEY)) {
            $errors['altcha'] = ALTCHA_INVALID;
        }
    } else {
        $errors['altcha'] = ALTCHA_REQUIRED;
    }

    // Database operations
    $conn = connectDB();
    if (!$conn) {
        $errors['generic'] = GENERIC;
    }
    if (isAlreadyRegistered($conn, $inputs)) {
        $errors['user'] = 'Esiste già un utente con la stesso nome o indirizzo email';
    }

    if (count($errors) == 0) {
        $activationCode = generateActivationCode();
        [$user, $activationExpiry] = registerUser($conn, $inputs, $activationCode);
        if ($user) {
            $_SESSION[REGISTRATION]['verification'] = $inputs['userEmail'];
            sendActivationEmail($inputs['userEmail'], $activationCode, $activationExpiry);
        } else {
            unset($_SESSION[REGISTRATION]['verification']);
            $errors['generic'] = GENERIC;
        }
    }

    disconnectDB($conn);
}
?>