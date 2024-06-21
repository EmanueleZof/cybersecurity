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
?>