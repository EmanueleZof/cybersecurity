<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['page' => $PAGES['courses']]) ?>

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
            <?php view('card', [
                'ID' => '001',
                'title' => 'Tutorial 1', 
                'time' => 10, 
                'thumb' => 'img/tutorial_1.jpeg', 
                'lead' => 'Come rendere sicuro un sito web.'
            ]) ?>
            <?php view('card', [
                'ID' => '002',
                'title' => 'Tutorial 2', 
                'time' => 15, 
                'thumb' => 'img/tutorial_2.png', 
                'lead' => 'Come creare un podcast.'
            ]) ?>
            <?php view('card', [
                'ID' => '003',
                'title' => 'Tutorial 3', 
                'time' => 5, 
                'thumb' => 'img/tutorial_3.jpeg', 
                'lead' => 'Come fare delle riprese con il telefono.'
            ]) ?>
            <?php view('card', [
                'ID' => '004',
                'title' => 'Tutorial 4', 
                'time' => 30, 
                'thumb' => 'img/tutorial_4.jpeg', 
                'lead' => 'Come fare un video tutorial.'
            ]) ?>
            
        </div>
    </div>
</section>

<?php view('footer') ?>