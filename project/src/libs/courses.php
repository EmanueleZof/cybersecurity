<?php
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

function getPopularCourses($db) {
    $sql = 'SELECT *
            FROM courses
            WHERE course_id = 1 OR course_id = 5 OR course_id = 2 OR course_id = 4';
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $data;
    }
    return null;
}
?>