<?php
    include 'feistel.php';

    $plainText1 = '0010110010010101';
    $plainText2 = '0010010010010101';

    $key1 = '10100110';
    $key2 = '1010011010';
    $key3 = '1010011010110110';
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
            <p class="lead">Esempi di testo da cifrare</p>
            <p><b>Plaintext 1: </b><code><?php echo $plainText1 ?></code></p>
            <p><b>Plaintext 2: </b><code><?php echo $plainText2 ?></code></p>
        </section>
        <section class="container">
            <h2>Key schedule</h2>
            <?php 
            $kA = keyScheduleA($key1);
            $kB = keyScheduleB($key2);
            $kC = keyScheduleC($key3);
            ?>
            <p><b>K<sub>A</sub></b>: <code><?php echo $key1 ?></code> (8 bit) => K<sub>A0</sub>: <code><?php echo $kA[0] ?></code> (8 bit) K<sub>A1</sub>: <code><?php echo $kA[1] ?></code> (8 bit)</p>
            <p><b>K<sub>B</sub></b>: <code><?php echo $key2 ?></code> (10 bit) => K<sub>B0</sub>: <code><?php echo $kB[0] ?></code> (8 bit) K<sub>B1</sub>: <code><?php echo $kB[1] ?></code> (8 bit)</p>
            <p><b>K<sub>C</sub></b>: <code><?php echo $key3 ?></code> (16 bit) => K<sub>C0</sub>: <code><?php echo $kC[0] ?></code> (8 bit) K<sub>C1</sub>: <code><?php echo $kC[1] ?></code> (8 bit)</p>
        </section>
        <section class="container">
            <h2>Round function A</h2>
            <div class="mt-3 mb-3">
                <p>Funzione: \( F(x, K_i) = (x + K_i) \mod 2^4 \)</p>
            </div>
            <?php
            list($result1a, $log1a) = feistelNetwork($plainText1, 2, $roundFunctionA, $kA);
            list($result2a, $log2a) = feistelNetwork($plainText2, 2, $roundFunctionA, $kA);

            list($result3a, $log3a) = feistelNetwork($plainText1, 2, $roundFunctionA, $kB);
            list($result4a, $log4a) = feistelNetwork($plainText2, 2, $roundFunctionA, $kB);

            list($result5a, $log5a) = feistelNetwork($plainText1, 2, $roundFunctionA, $kC);
            list($result6a, $log6a) = feistelNetwork($plainText2, 2, $roundFunctionA, $kC);
            
            drawComparisonTable($plainText1, $plainText2, array(
                'A' => array(
                    'results' => array($result1a, $result2a),
                    'logs' => array($log1a, $log2a)
                ),
                'B' => array(
                    'results' => array($result3a, $result4a),
                    'logs' => array($log3a, $log4a)
                ),
                'C' => array(
                    'results' => array($result5a, $result6a),
                    'logs' => array($log5a, $log6a)
                )
            ));
            ?>
        </section>
        <section class="container">
            <h2>Round function B</h2>
            <div class="mt-3 mb-3">
                <p>Funzione: \( F(x, K_i) = x \oplus K_i \)</p>
            </div>
            <?php
            list($result1b, $log1b) = feistelNetwork($plainText1, 2, $roundFunctionB, $kA);
            list($result2b, $log2b) = feistelNetwork($plainText2, 2, $roundFunctionB, $kA);

            list($result3b, $log3b) = feistelNetwork($plainText1, 2, $roundFunctionB, $kB);
            list($result4b, $log4b) = feistelNetwork($plainText2, 2, $roundFunctionB, $kB);

            list($result5b, $log5b) = feistelNetwork($plainText1, 2, $roundFunctionB, $kC);
            list($result6b, $log6b) = feistelNetwork($plainText2, 2, $roundFunctionB, $kC);

            drawComparisonTable($plainText1, $plainText2, array(
                'A' => array(
                    'results' => array($result1b, $result2b),
                    'logs' => array($log1b, $log2b)
                ),
                'B' => array(
                    'results' => array($result3b, $result4b),
                    'logs' => array($log3b, $log4b)
                ),
                'C' => array(
                    'results' => array($result5b, $result6b),
                    'logs' => array($log5b, $log6b)
                )
            ));
            ?>
        </section>
        <section class="container">
            <h2>Round function C</h2>
            <div class="mt-3 mb-3">
                <p>Funzione: \( F(x, K_i) = x \oplus K_i \) per tutti \(K_i \in \{0,1\}^4\) definita con la funzione \( f: \{0,1\}^4 \to \{0,1\}^4 \) utilizzando la tabella di "lookup" della S-box proposta nell' Esercizio 1</p>
            </div>
            <?php
            list($result1c, $log1c) = feistelNetwork($plainText1, 2, $roundFunctionC, $kA);
            list($result2c, $log2c) = feistelNetwork($plainText2, 2, $roundFunctionC, $kA);

            list($result3c, $log3c) = feistelNetwork($plainText1, 2, $roundFunctionC, $kB);
            list($result4c, $log4c) = feistelNetwork($plainText2, 2, $roundFunctionC, $kB);

            list($result5c, $log5c) = feistelNetwork($plainText1, 2, $roundFunctionC, $kC);
            list($result6c, $log6c) = feistelNetwork($plainText2, 2, $roundFunctionC, $kC);

            drawComparisonTable($plainText1, $plainText2, array(
                'A' => array(
                    'results' => array($result1c, $result2c),
                    'logs' => array($log1c, $log2c)
                ),
                'B' => array(
                    'results' => array($result3c, $result4c),
                    'logs' => array($log3c, $log4c)
                ),
                'C' => array(
                    'results' => array($result5c, $result6c),
                    'logs' => array($log5c, $log6c)
                )
            ));
            ?>
        </section>
        <section class="container">
            <h2>Round function D</h2>
            <div class="mt-3 mb-3">
                <p>Funzione: \( F(x, K_i) = s((s(p(A) + p(B)) \oplus p(C)) + p(D)) \).</p>
                <p>La funzione \( p: \{0,1\}^4 \to \{0,1\}^4 \) è una permutazione utilizzando la tabella di "lookup" della S-box proposta nell' Esercizio 1.</p>
                <p>La funzione \( s: \{0,1\}^4 \to \{0,1\}^4 \) fa uno shift a sinistra dei bit.</p>
                <p>Gli elementi della funzione F sono rispettivamente \( x = A || C \) e \( K_i = B || D \).</p>
            </div>
            <?php
            list($result1d, $log1d) = feistelNetwork($plainText1, 2, $roundFunctionD, $kA);
            list($result2d, $log2d) = feistelNetwork($plainText2, 2, $roundFunctionD, $kA);

            list($result3d, $log3d) = feistelNetwork($plainText1, 2, $roundFunctionD, $kB);
            list($result4d, $log4d) = feistelNetwork($plainText2, 2, $roundFunctionD, $kB);

            list($result5d, $log5d) = feistelNetwork($plainText1, 2, $roundFunctionD, $kC);
            list($result6d, $log6d) = feistelNetwork($plainText2, 2, $roundFunctionD, $kC);

            drawComparisonTable($plainText1, $plainText2, array(
                'A' => array(
                    'results' => array($result1d, $result2d),
                    'logs' => array($log1d, $log2d)
                ),
                'B' => array(
                    'results' => array($result3d, $result4d),
                    'logs' => array($log3d, $log4d)
                ),
                'C' => array(
                    'results' => array($result5d, $result6d),
                    'logs' => array($log5d, $log6d)
                )
            ));
            ?>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>