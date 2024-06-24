<?php
const GENERIC = 'Qualcosa è andato storto, riprova più tardi';

$courses = [];
$errors = [];

if (isGetRequest()) {
    // Database operations
    $conn = connectDB();
    if (!$conn) {
        $errors['generic'] = GENERIC;
    }

    $all = getAllCourses($conn);
    if ($all) {
        $courses = $all;
    }

    disconnectDB($conn);
}
?>