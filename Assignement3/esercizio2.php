<?php
    include 'jpeg.php';

    $Y = array(
        array(52,55,61,66,70,61,64,73),
        array(63,59,55,90,109,85,69,72),
        array(62,59,68,113,144,104,66,73),
        array(63,58,71,122,154,106,70,69),
        array(67,61,68,104,126,88,68,70),
        array(79,65,60,70,77,68,58,75),
        array(85,71,64,59,55,61,65,83),
        array(87,79,69,68,65,76,78,94)
    );

    $Q = array(
        array(145,32,176,128,202,100,90,116),
        array(121,64,110,156,144,89,77,124),
        array(143,22,134,111,188,121,34,145),
        array(189,76,186,156,104,67,43,109),
        array(188,12,34,145,110,156,44,89),
        array(34,11,168,212,130,50,12,190),
        array(77,124,166,134,176,128,32,222),
        array(156,104,69,145,32,176,29,177)
    );
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignement 3 - Esercizio 2</title>
    <link href="css/main.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Assignement 3</a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Esercizio 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Esercizio 2</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <section class="container">
            <h1 class="mt-5">Assignement 3 - Esercizio 2</h1>
            <p class="lead">TODO</p>
            <p>
                <?php 
                printMatrix($Y);
                printMatrix($Q);
                ?>
            </p>
        </section>
        <section class="container">
            <p>DCT test</p>
            <p>
                <?php 
                $testMatrix = array(
                    array(88,84,83,84,85,86,83,82),
                    array(86,82,82,83,82,83,83,81),
                    array(82,82,84,87,87,87,81,84),
                    array(81,86,87,89,82,82,84,87),
                    array(81,84,83,87,85,89,80,81),
                    array(81,85,85,86,81,89,81,85),
                    array(82,81,86,83,86,89,81,84),
                    array(88,88,90,84,85,88,88,81),
                );
                $testDCT = dctTransform($testMatrix);
                printMatrix($testDCT);
                ?>
            </p>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
</body>
</html>