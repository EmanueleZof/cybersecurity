<?php
/**
 * Verifica se un utente è già registrato nel database.
 *
 * @param mysqli $db Connessione al database.
 * @param array $inputs Array associativo contenente 'userName' e 'userEmail'.
 * @return bool Ritorna true se l'utente è già registrato, altrimenti false.
 */
function isAlreadyRegistered($db, $inputs) {
    $sql = 'SELECT user_ID FROM users WHERE user_name = "'.$inputs['userName'].'" OR user_email = "'.$inputs['userEmail'].'"';
    
    $query = mysqli_query($db, $sql);
    
    return mysqli_num_rows($query) == 0 ? false : true;
}

/**
 * Genera un codice di attivazione casuale.
 *
 * @return string Ritorna una stringa esadecimale di 32 caratteri generata casualmente.
 */
function generateActivationCode() {
    return bin2hex(random_bytes(16));
}

/**
 * Registra un nuovo utente nel database.
 *
 * @param mysqli $db Connessione al database.
 * @param array $inputs Array associativo contenente 'userName', 'userPassword' e 'userEmail'.
 * @param string $activationCode Codice di attivazione generato per l'utente.
 * @param string $gaSecret Segreto di Google Authenticator per l'utente.
 * @return array Ritorna un array contenente un booleano per indicare il successo dell'operazione 
 *               e una stringa con la data di scadenza dell'attivazione o un messaggio di errore.
 */
function registerUser($db, $inputs, $activationCode, $gaSecret) {
    $passwordHash = password_hash($inputs['userPassword'], PASSWORD_BCRYPT);
    $activationCode = password_hash($activationCode, PASSWORD_DEFAULT);
    $expiry = 1 * 24  * 60 * 60;
    $activationExpiry = date('Y-m-d H:i:s',  time() + $expiry);
    
    $sql = 'INSERT INTO users (user_name, user_password, user_email, activation_code, activation_expiry, user_ga_secret) 
            VALUES ("'.$inputs['userName'].'", "'.$passwordHash.'", "'.$inputs['userEmail'].'", "'.$activationCode.'", "'.$activationExpiry.'", "'.$gaSecret.'")';
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        return [true, $activationExpiry];
    }

    return [false, ''];
}

/**
 * Invia un'email di attivazione all'utente.
 *
 * @param string $email L'indirizzo email dell'utente.
 * @param string $activationCode Il codice di attivazione generato per l'utente.
 * @param string $activationExpiry La data di scadenza per l'attivazione.
 * @return bool Ritorna true se l'email è stata inviata con successo, altrimenti false.
 */
function sendActivationEmail($email, $activationCode, $activationExpiry) {
    $activationLink = APP_URL.'/activate.php?userEmail='.$email.'&activationCode='.$activationCode;

    $subject = 'Rocket Learn - Attiva il tuo account';

    $bodyHtml = '<p>Clicca sul seguente link per attivare il tuo account:</p>';
    $bodyHtml .= '<p><a href="'.$activationLink.'">Attiva il tuo account</a></p>';
    $bodyHtml .= '<p><b>Puoi attivare il tuo account fino al: '.$activationExpiry.'</b> altrimenti dovrai ripetere la registrazione.</p>';

    $mail = sendEmail($email, $subject, $bodyHtml);
    return $mail;
}

/**
 * Elimina un utente dal database in base al suo ID e allo stato di attività.
 *
 * @param mysqli $db La connessione al database.
 * @param int $id L'ID dell'utente da eliminare.
 * @param int $active Stato di attività dell'utente (0 o 1).
 * @return bool Ritorna true se l'utente è stato eliminato con successo, altrimenti false.
 */
function deleteUserByID($db, $id, $active = 0) {
    $sql = 'DELETE FROM users
            WHERE user_ID ='.$id.' and active='.$active;
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        return true;
    }
    return false;
}

/**
 * Trova un utente non verificato nel database in base all'email e al codice di attivazione.
 *
 * @param mysqli $db La connessione al database.
 * @param string $email L'email dell'utente da trovare.
 * @param string $activationCode Il codice di attivazione dell'utente.
 * @return array|null Ritorna un array con le informazioni dell'utente se trovato e non scaduto, altrimenti null.
 */
function findUnverifiedUser($db, $email, $activationCode) {
    $sql = 'SELECT user_ID, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND user_email="'.$email.'"';
    
    $query = mysqli_query($db, $sql);

    if ($query && mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);
        if ($user['expired'] == 1) {
            deleteUserByID($db, $user['user_ID']);
            return null;
        }
        if (password_verify($activationCode, $user['activation_code'])) {
            return $user;
        }
    }
    return null;
}

/**
 * Attiva un utente nel database impostando il suo stato come attivo e registrando la data di attivazione.
 *
 * @param mysqli $db La connessione al database.
 * @param int $userID L'ID dell'utente da attivare.
 * @return bool Ritorna true se l'utente è stato attivato correttamente, altrimenti false.
 */
function activateUser($db, $userID) {
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE user_ID='.$userID;

    $query = mysqli_query($db, $sql);

    if ($query) {
        return true;
    }
    return false;
}

/**
 * Trova un utente nel database utilizzando l'indirizzo email.
 *
 * @param mysqli $db La connessione al database.
 * @param string $email L'indirizzo email dell'utente da trovare.
 * @return array|null Ritorna un array associativo contenente i dati dell'utente se trovato, altrimenti null.
 */
function findUserByEmail($db, $email) {
    $sql = 'SELECT *
            FROM users
            WHERE user_email="'.$email.'"';

    $query = mysqli_query($db, $sql);

    if ($query) {
        $user = mysqli_fetch_assoc($query);
        return $user;
    }
    return null;
}

/**
 * Effettua l'accesso dell'utente nel sistema impostando l'ID utente nella sessione.
 *
 * @param mysqli $db La connessione al database.
 * @param string $userEmail L'indirizzo email dell'utente che sta effettuando l'accesso.
 */
function signInUser($db, $userEmail) {
    $user = findUserByEmail($db, $userEmail);
    
    if ($user) {
        session_regenerate_id();
        $_SESSION[USER]['userID']  = $user['user_ID'];
    }
}

/**
 * Verifica le credenziali di accesso dell'utente confrontando l'email e la password nel database.
 *
 * @param mysqli $db La connessione al database.
 * @param string $userEmail L'indirizzo email dell'utente.
 * @param string $userPassword La password inserita dall'utente.
 * @return array|false Restituisce l'utente dal database se le credenziali sono corrette, altrimenti ritorna false.
 */
function verifyUser($db, $userEmail, $userPassword) {
    $user = findUserByEmail($db, $userEmail);

    if ($user && password_verify($userPassword, $user['user_password'])) {
        return $user;
    }

    return false;
}

/**
 * Verifica se un utente è attualmente loggato.
 *
 * @return bool Restituisce true se l'utente è loggato, altrimenti false.
 */
function isUserLoggedIn() {
    return isset($_SESSION[USER]['userID']);
}

/**
 * Verifica se è necessario il login dell'utente per accedere alla pagina.
 *
 * @param array $page Le informazioni della pagina da controllare.
 * @return void
 */
function requireLogin($page) {
    if ($page['restricted'] && $page['name'] != 'signin') {
        if (!isUserLoggedIn()) {
          $_SESSION[NAVIGATION]['returnPage'] = $page['name'].'.php';
          redirectTo('signin.php');
        } 
    }
}

/**
 * Esegue il logout dell'utente corrente invalidando la sessione attiva.
 * Se l'utente è loggato, distrugge la sessione e reindirizza alla pagina di login.
 *
 * @return void
 */
function signOutUser() {
    if (isUserLoggedIn()) {
        unset($_SESSION[USER]);
        session_destroy();
        redirectTo('signin.php');
    }
}

/**
 * Restituisce il nome utente dell'utente attualmente loggato.
 * Se l'utente è loggato, restituisce il nome utente memorizzato nella sessione.
 * Altrimenti, restituisce null.
 *
 * @return string|null Il nome utente dell'utente attualmente loggato, o null se non loggato.
 */
function curentUser() {
    if (isUserLoggedIn()) {
        return $_SESSION[USER]['username'];
    }
    return null;
}
?>