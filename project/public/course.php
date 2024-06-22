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
        
        
        <div class="h-100 p-5 text-bg-dark rounded-3 video">
            <video controls>
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
            </video>

            <?php if (isset($inputs['courseData']['course_trascription'])) { ?>
                <div class="accordion pt-3" id="videoTranscription">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Trascrizione
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?= $inputs['courseData']['course_trascription'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php view('footer') ?>