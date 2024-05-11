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
                <p>Funzione: \( F(R_i, K_i) = (R_i + K_i) \mod 2^4 \)</p>
                <p>K<sub>0</sub>: <code><?php echo $kA[0] ?></code></p>
                <p>K<sub>1</sub>: <code><?php echo $kA[1] ?></code></p>
                <?php
                list($result1a, $log1a) = feistelNetwork($plainText1, 2, $fA, $kA);
                list($result2a, $log2a) = feistelNetwork($plainText2, 2, $fA, $kA);
                ?>
            </div>
            <table class="borders">
                <tr><th>Plaintext</th><th>Esecuzione</th><th>Risultato</th><th>Differenza</th></tr>
                <tr>
                    <td>a</td>
                    <td>a</td>
                    <td>a</td>
                    <td rowspan="2">z</td>
                </tr>
                <tr>
                    <td>s</td>
                    <td>s</td>
                    <td>s</td>
                </tr>
            </table>
            <!--<div class="mt-3 mb-3">
                <p>Esecuzione su Plaintext 1: <code><?php echo $plainText1 ?></code></p>
                <?php 
                /*list($result, $log) = feistelNetwork($plainText1, 2, $f1, $k1);
                foreach($log as $row) {
                    print_r($row);
                    echo '<br>';
                }
                echo $result;*/
                ?>
            </div>
            <div class="mt-3 mb-3">
                <p>Risultato esecuzione su Plaintext 2: <code><?php echo $plainText2 ?></code></p>
                <?php 
                /*list($result1, $log1) = feistelNetwork($plainText2, 2, $f1, $k1);
                foreach($log1 as $row) {
                    print_r($row);
                    echo '<br>';
                }
                echo $result1;*/
                ?>
            </div>-->
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--<script src="https://cdn.plot.ly/plotly-2.31.1.min.js" charset="utf-8"></script>-->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>