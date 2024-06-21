<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/index.php';
?>

<?php view('header', ['page' => $PAGES['index']]); ?>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
    <h1 class="display-3 fw-bold">Rocket Learn</h1>
    <h3 class="fw-normal text-muted mb-3">Piattaforma di video tutorial</h3>
    <div class="d-flex gap-3 justify-content-center lead fw-normal">
        <a class="icon-link" href="courses.php">Scopri tutti i corsi</a>
        <a class="icon-link" href="pricing.php">Prezzi</a>
    </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <?php
        if ($courses) {
            view('box', ['data' => $courses[0]]);
            view('box', ['data' => $courses[1]]);
        }
    ?>
</div>

<div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <?php
        if ($courses) {
            view('box', ['data' => $courses[2]]);
            view('box', ['data' => $courses[3]]);
        }
    ?>
</div>

<?php view('footer'); ?>