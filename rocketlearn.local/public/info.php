<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['page' => $PAGES['info']]) ?>

<section class="container py-3"> 
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Informazioni</h1>
        <p class="fs-5 text-body-secondary">L'accesso alla piattaforma è riservato agli utenti registrati</p>
    </div>
</section>

<?php view('footer') ?>