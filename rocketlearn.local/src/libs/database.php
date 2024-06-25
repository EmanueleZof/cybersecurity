<?php
/**
 * Connette al database MySQL utilizzando le credenziali definite nelle costanti.
 *
 * Tenta di stabilire una connessione al database utilizzando le costanti
 * DB_HOST, DB_USER, DB_PASSWORD e DB_NAME definite nel file di configurazione.
 * Se la connessione riesce, restituisce l'oggetto di connessione.
 * In caso di errore durante la connessione, registra un messaggio di errore
 * nel log degli errori e restituisce null.
 *
 * @return mysqli|null Restituisce l'oggetto di connessione MySQL se la connessione è avvenuta con successo, altrimenti restituisce null.
 */
function connectDB() {
    try {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    } catch (mysqli_sql_exception $e) {
        error_log('DB connection: '.$e, 1, ADMIN_EMAIL);
        return null;
    }
    return $connection;
}

/**
 * Chiude la connessione al database MySQL.
 *
 * Chiude la connessione al database MySQL specificata dall'oggetto di connessione passato come parametro.
 *
 * @param mysqli $connection L'oggetto di connessione MySQL da chiudere.
 * @return void
 */
function disconnectDB($connection) {
    mysqli_close($connection);
}
?>