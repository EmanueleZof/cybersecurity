<?php
$courses = [];

if (isGetRequest()) {
    // Database operations
    $conn = connectDB();

    if ($conn) {
        $popular = getPopularCourses($conn);
        if ($popular) {
            $courses = $popular;
        }
    }

    disconnectDB($conn);
}
?>