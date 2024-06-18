<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>

<?php view('header', ['page' => $PAGES['register']]) ?>

<div class="row align-items-md-stretch">
    <div class="col-md-6">
        <img src="img/rocket.jpeg" class="full-image">
    </div>

    <?php if (isset($_SESSION['registrationWaitConfirmation'])) { ?>
    <div class="col-md-6">
        <section class="container py-3">
            <h1 class="h3 mb-3 fw-normal">Registrazione</h1>
            <p>Ti abbiamo inviato una email all'indirizzo ??. Completa la registrazione inserendo di seguito il codice ricevuto.</p>
        </section>
    </div>
    <?php } else { ?>
    <div class="col-md-6">
        <form action="register.php" method="POST" class="container py-3 needs-validation" novalidate>
            <h1 class="h3 mb-3 fw-normal">Registrazione</h1>

            <?php
            if (isset($_SESSION['registrationError'])) {
                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['registrationError'].'</div>';
                unset($_SESSION['registrationError']);
            }
            ?>

            <div class="form-group">
                <label for="userName">Nome utente</label>
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Nome" required>
                <div class="invalid-feedback">Inserire il nome utente</div>
            </div>

            <div class="form-group">
                <label for="userEmail">Indirizzo email</label>
                <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="name@example.com" required>
                <div class="invalid-feedback">L'indirizzo email inserito non è valido</div>
            </div>

            <div class="form-group">
                <label for="userPassword">Password</label>
                <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    <ul>
                        <li id="pwdCheckLength">Lunga almeno 12 caratteri.</li>
                        <li id="pwdCheckLower">Contenere almeno una lettera minuscola.</li>
                        <li id="pwdCheckUpper">Contenere almeno una lettera maiuscola.</li>
                        <li id="pwdCheckNumber">Contenere almeno un numero.</li>
                        <li id="pwdCheckSpecial">Contenere almeno un carattere speciale tra .!@#$%^&*()_+-=</li>
                        <li id="pwdCheckSpace">Non deve contenere spazi.</li>
                        <li id="pwdCheckEmoji">Non deve contenere emoji.</li>
                        <li id="pwdCheckName">Non deve contenere il nome utente.</li>
                    </ul>
                </small>
                <div class="invalid-feedback">La password inserita non è valida</div>
                <div class="valid-feedback">Tutti i criteri di sicurezza sono rispettati</div>
            </div>

            <div class="form-group">
                <label for="repeatedPassword">Ripeti la password</label>
                <input type="password" class="form-control" name="repeatedPassword" id="repeatedPassword" placeholder="Password" required>
                <div class="invalid-feedback">La password inserita è diversa</div>
            </div>

            <div class="captcha form-group">
                <altcha-widget challengeurl="captchachallenge.php"></altcha-widget>
                <div class="invalid-feedback">Verifica il captcha</div>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Registrati</button>

            <div class="my-3">Sei già registrato? <a href="signin.php">Fai il sign in</a></div>
        </form>
    </div>
    <?php } ?>

</div>

<?php view('footer', ['registrationScripts' => true]) ?>