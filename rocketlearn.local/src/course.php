<?php
const GENERIC = 'Qualcosa è andato storto, riprova più tardi';
const COURSE_GENERIC = 'Impossibile trovare il corso selezionato';

$inputs = [];
$errors = [];

if (isGetRequest()) {
    // Input sanitization
    $courseID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $inputs['courseID'] = $courseID;

    // Input validation
    if ($courseID) {
        $courseID = filter_var($courseID, FILTER_VALIDATE_INT);
        if ($courseID == false) {
            $errors['courseID'] = COURSE_GENERIC;
        }
    } else {
        $errors['courseID'] = COURSE_GENERIC;
    }

    // Database operations
    $conn = connectDB();
    if (!$conn) {
        $errors['generic'] = GENERIC;
    }

    if (count($errors) == 0) {
        $course = getCourseById($conn, $inputs['courseID']);
        if ($course) {
            $inputs['courseData'] = $course;
        }
    }

    disconnectDB($conn);
}
?>