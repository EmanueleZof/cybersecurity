<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['page' => $PAGES['pricing']]); ?>

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
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <a href="course.php?id=001" class="product-link">
            <div class="my-3 p-3">
                <h2 class="display-5">Tutorial 1</h2>
                <p class="lead">Come rendere sicuro un sito web.</p>
            </div>
            <div class="bg-body shadow-sm mx-auto product-thumbnail">
                <img src="img/tutorial_1.jpeg">
            </div>
        </a>
    </div>
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <a href="course.php?id=002" class="product-link">
            <div class="my-3 py-3">
                <h2 class="display-5">Tutorial 2</h2>
                <p class="lead">Come creare un podcast.</p>
            </div>
            <div class="bg-body shadow-sm mx-auto product-thumbnail">
                <img src="img/tutorial_2.png">
            </div>
        </a>
    </div>
</div>

<div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <a href="course.php?id=003" class="product-link">
            <div class="my-3 p-3">
                <h2 class="display-5">Tutorial 3</h2>
                <p class="lead">Come fare delle riprese con il telefono.</p>
            </div>
            <div class="bg-body shadow-sm mx-auto product-thumbnail">
                <img src="img/tutorial_3.jpeg">
            </div>
        </a>
    </div>
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <a href="course.php?id=004" class="product-link">
            <div class="my-3 py-3">
                <h2 class="display-5">Tutorial 4</h2>
                <p class="lead">Come fare un video tutorial.</p>
            </div>
            <div class="bg-body shadow-sm mx-auto product-thumbnail">
                <img src="img/tutorial_4.jpeg">
            </div>
        </a>
    </div>
</div>

<?php view('footer'); ?>