<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/course.php';
?>

<?php view('header', ['page' => $PAGES['course']]) ?>

<div class="container py-4">
    <?php
    if (isset($_SESSION[FLASH])) {
        displayAllFlashMessages();
    } elseif ($errors) {
        displayErrors($errors);
    }
    ?>

    <?php if (isset($inputs['courseData'])) { ?>
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold"><?= $inputs['courseData']['course_title'] ?></h1>
            <p class="col-md-8 fs-4"><?= $inputs['courseData']['course_description'] ?></p>
        </div>
    </div>
    <div class="row align-items-md-stretch">
        <div class="col-md-12">
            <div class="h-100 p-5 text-bg-dark rounded-3">
                <p>Video</p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php view('footer') ?>