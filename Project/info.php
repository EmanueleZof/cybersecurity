<!DOCTYPE html>
<html lang="it">
<?php
$GLOBALS['pageTitle'] = 'Informazioni - Piattaforma di video corsi';
include 'widgets/head.php';
?>
<body>
    <?php include 'widgets/navigation.php'; ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
        </symbol>
    </svg>
    <!-- TODO: da vedere se ha senso -->
    <main>
        <section class="container py-3"> 
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal text-body-emphasis">Informazioni</h1>
                <p class="fs-5 text-body-secondary">L'accesso alla piattaforma è riservato agli utenti registrati</p>
            </div>
        </section>
    </main>
    <?php include 'widgets/footer.php'; ?>
</body>
</html>