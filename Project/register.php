<?php
include 'functions.php';
session_start();
$_SESSION['currentPage'] = 'register';
include 'session.php';
?>
<!DOCTYPE html>
<html lang="it">
<?php include 'widgets/head.php'; ?>
<body>
    <?php include 'widgets/navigation.php'; ?>
    <main>
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <img src="assets/img/rocket.jpeg" class="full-image">
            </div>
            <div class="col-md-6">
                <form action="functions/registration.php" method="POST" class="container py-3 needs-validation" novalidate>
                    <h1 class="h3 mb-3 fw-normal">Registrazione</h1>

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
                        <altcha-widget challengeurl="functions/captchachallenge.php"></altcha-widget>
                        <div class="invalid-feedback">Verifica il captcha</div>
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </main>
    <?php include 'widgets/footer.php'; ?>
    <script async defer src="https://cdn.jsdelivr.net/npm/altcha/dist/altcha.min.js" type="module"></script>
    <script src="assets/js/registration.js"></script>
</body>
</html>