<?php
function connectDB() {
    try {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    } catch (mysqli_sql_exception $e) {
        error_log('DB connection: '.$e, 1, ADMIN_EMAIL);
        return null;
    }
    return $connection;
}

function disconnectDB($connection) {
    mysqli_close($connection);
}
?>