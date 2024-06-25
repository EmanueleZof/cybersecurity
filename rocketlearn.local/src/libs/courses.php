<?php
/**
 * Ottiene tutti i corsi attivi dal database.
 *
 * Questa funzione esegue una query per selezionare tutti i corsi attivi dal database specificato.
 * Restituisce un array associativo contenente tutte le righe di dati dei corsi, se la query ha successo.
 * Se la query non ha successo o non ci sono corsi attivi, restituisce null.
 *
 * @param resource $db Connessione al database MySQL.
 * @return array|null Un array associativo contenente i dati dei corsi attivi, o null se non ci sono dati o c'è un errore.
 */
function getAllCourses($db) {
    $sql = 'SELECT *
            FROM courses
            WHERE course_active = 1';
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $data;
    }
    return null;
}

/**
 * Ottiene i corsi popolari dal database.
 *
 * Questa funzione esegue una query per selezionare i corsi popolari dal database specificato.
 * Restituisce un array associativo contenente tutte le righe di dati dei corsi popolari, se la query ha successo.
 * Se la query non ha successo o non ci sono corsi popolari, restituisce null.
 *
 * @param resource $db Connessione al database MySQL.
 * @return array|null Un array associativo contenente i dati dei corsi popolari, o null se non ci sono dati o c'è un errore.
 */
function getPopularCourses($db) {
    $sql = 'SELECT *
            FROM courses
            WHERE course_active = 1 AND course_id = 1 OR course_id = 5 OR course_id = 2 OR course_id = 4';
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $data;
    }
    return null;
}

/**
 * Ottiene un corso dal database dato il suo ID.
 *
 * Questa funzione esegue una query per selezionare un corso attivo dal database specificato,
 * basato sull'ID del corso fornito.
 * Restituisce un array associativo contenente i dati del corso se la query ha successo e il corso è attivo.
 * Se la query non ha successo o non trova un corso attivo con l'ID specificato, restituisce null.
 *
 * @param resource $db Connessione al database MySQL.
 * @param int $courseID ID del corso da cercare nel database.
 * @return array|null Un array associativo contenente i dati del corso, o null se non trovato o c'è un errore.
 */
function getCourseById($db, $courseID) {
    $sql = 'SELECT *
            FROM courses
            WHERE course_active = 1 AND course_id='.$courseID;
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        return mysqli_fetch_assoc($query);
    }
    return null;
}
?>