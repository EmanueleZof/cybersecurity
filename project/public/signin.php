<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/signin.php';
?>

<?php view('header', ['page' => $PAGES['signin']]) ?>

<div class="row align-items-md-stretch">
    <div class="col-md-6">
        <img src="img/rocket.jpeg" class="full-image">
    </div>

    <div class="col-md-6">
        <?php if (isset($_SESSION[LOGIN]['verification'])) { ?>
            <form action="signin2.php" id="loginStep2" method="POST" class="container py-3 needs-validation" novalidate>
                <h1 class="h3 mb-3 fw-normal">Sign in</h1>

                <?php
                if (isset($_SESSION[FLASH])) {
                    displayAllFlashMessages();
                } elseif($errors) {
                    displayErrors($errors);
                }
                ?>

                <div class="form-group">
                    <label for="userCode">Codice di Google Authenticator</label>
                    <input type="number" class="form-control" name="userCode" id="userCode" placeholder="123456" value="" required>
                    <div class="invalid-feedback">Il codice non è valido</div>
                </div>

                <input type="hidden" name="csfrToken" value="<?= createCSRFToken() ?>">

                <button class="btn btn-primary w-100 py-2" type="submit">Verifica</button>
            </form>
        <?php } else { ?>
            <form action="signin.php" id="loginStep1" method="POST" class="container py-3 needs-validation" novalidate>
                <h1 class="h3 mb-3 fw-normal">Sign in</h1>

                <?php
                if (isset($_SESSION[FLASH])) {
                    displayAllFlashMessages();
                } elseif($errors) {
                    displayErrors($errors);
                }
                ?>

                <div class="form-group">
                    <label for="userEmail">Indirizzo email</label>
                    <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="name@example.com" value="<?= $inputs['userEmail'] ?? '' ?>" required>
                    <div class="invalid-feedback">L'indirizzo email inserito non è valido</div>
                </div>

                <div class="form-group">
                    <label for="userPassword">Password</label>
                    <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" value="<?= $inputs['userPassword'] ?? '' ?>" required>
                    <div class="invalid-feedback">La password inserita non è valida</div>
                </div>

                <input type="hidden" name="csfrToken" value="<?= createCSRFToken() ?>">

                <button class="btn btn-primary w-100 py-2" type="submit">Entra</button>
                
                <div class="my-3">Non sei già registrato? <a href="register.php">Registrati</a></div>
            </form>
        <?php } ?>
    </div>
</div>

<?php view('footer', ['signinScripts' => true]) ?>