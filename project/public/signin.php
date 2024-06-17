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
        <form action="signin.php" method="POST" class="container py-3 needs-validation" novalidate>
            <h1 class="h3 mb-3 fw-normal">Sign in</h1>

            <div class="form-group">
                <label for="userEmail">Indirizzo email</label>
                <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="name@example.com" required>
                <div class="invalid-feedback">L'indirizzo email inserito non è valido</div>
            </div>

            <div class="form-group">
                <label for="userPassword">Password</label>
                <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" required>
                <div class="invalid-feedback">La password inserita non è valida</div>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Entra</button>

            <div class="my-3">Non sei già registrato? <a href="register.php">Registrati</a></div>
        </form>
    </div>
</div>

<?php view('footer') ?>