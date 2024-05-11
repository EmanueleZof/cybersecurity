<?php
    include 'feistel.php';

    $plainText1 = '0010110010010101';
    $plainText2 = '0010010010010101';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignement 2 - Esercizio 2</title>
    <link href="css/main.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Assignement 2</a>
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
            <h1 class="mt-5">Assignement 2 - Esercizio 2</h1>
            <p class="lead">Testo da cifrare</p>
            <p><b>Plaintext 1: </b><code><?php echo $plainText1 ?></code></p>
            <p><b>Plaintext 2: </b><code><?php echo $plainText2 ?></code></p>
        </section>
        <section class="container">
            <h2>Test A</h2>
            <div class="mt-3 mb-3">
                <p>Funzione: \( F(x, K_i) = (x + K_i) \mod 2^4 \)</p>
                <p>K<sub>0</sub>: <code><?php echo $kA[0] ?></code></p>
                <p>K<sub>1</sub>: <code><?php echo $kA[1] ?></code></p>
            </div>
            <?php
            list($result1a, $log1a) = feistelNetwork($plainText1, 2, $fA, $kA);
            list($result2a, $log2a) = feistelNetwork($plainText2, 2, $fA, $kA);
            drawComparisonTable($plainText1, $plainText2, $log1a, $log2a, $result1a, $result2a);
            ?>
        </section>
        <section class="container">
            <h2>Test B</h2>
            <div class="mt-3 mb-3">
                <p>Funzione: \( F(x, K_i) = x \oplus K_i \)</p>
                <p>K<sub>0</sub>: <code><?php echo $kB[0] ?></code></p>
                <p>K<sub>1</sub>: <code><?php echo $kB[1] ?></code></p>
            </div>
            <?php
            list($result1b, $log1b) = feistelNetwork($plainText1, 2, $fB, $kB);
            list($result2b, $log2b) = feistelNetwork($plainText2, 2, $fB, $kB);
            drawComparisonTable($plainText1, $plainText2, $log1b, $log2b, $result1b, $result2b);
            ?>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>