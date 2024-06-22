<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['page' => $PAGES['genqrcode']]) ?>

<section class="container py-3"> 
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Google Authenticator</h1>
        <p class="fs-5 text-body-secondary"></p>
    </div>
    <div>
        <p>Google Authenticator introduce un ulteriore livello di sicurezza per i tuoi account online aggiungendo un secondo passaggio di verifica quando accedi.</p>
        <p>Questo significa che, oltre alla password, dovrai inserire anche un codice generato dall'app Google Authenticator sul telefono.</p>
        <p>Il codice di verifica può essere generato dall'app Google Authenticator sul telefono, anche se non hai una rete o una rete cellulare.</p>
    </div>
    <div class="mt-5">
        <h2>Passo 1</h2>
        <p>Scarica l'app Google Authenticator per il il tuo telefono:</p>
        <div class="row">
            <a class="col-sm" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=it&pli=1" target="_blank" rel="noopener noreferrer">
                <img class="store-badge" src="img/google_play.png"/>
            </a>
            <a class="col-sm" href="https://apps.apple.com/it/app/google-authenticator/id388497605" target="_blank" rel="noopener noreferrer">
                <img class="store-badge" src="img/apple_store.png"/>
            </a>
        </div>
    </div>
    <div class="mt-5">
        <h2>Passo 2</h2>
        <p>Inquadra il seguente QR code</p>
        <?php getQRCode($_SESSION[USER]['username'], $_SESSION[USER]['gaSecret']); ?>
    </div>
    <div class="mt-5">
        <h2>Passo 3</h2>
        <p><a class="btn btn-primary my-2" href="courses.php">Inizia a guardare i nostri video tutorial</a></p>
    </div>
</section>

<?php view('footer') ?>