<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/courses.php';
?>

<?php view('header', ['page' => $PAGES['courses']]) ?>

<?php
if (isset($_SESSION[FLASH])) {
    displayAllFlashMessages();
} elseif($errors) {
    displayErrors($errors);
}
?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Bentornato <?= curentUser(); ?></h1>
            <p class="lead text-body-secondary">Ecco tutti i video tutorial a tua disposizione.</p>
        </div>
    </div>
</section>

<section class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
                foreach($courses as $data) {
                    view('card', [
                        'ID' => $data['course_id'],
                        'title' => $data['course_title'], 
                        'time' => $data['course_time'], 
                        'thumb' => $data['course_thumbnail'], 
                        'lead' => $data['course_lead']
                    ]);
                }
            ?>
        </div>
    </div>
</section>

<?php view('footer') ?>