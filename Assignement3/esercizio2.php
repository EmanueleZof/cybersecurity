<?php
    include 'jpeg.php';

    $secretMessage = 'The text is beautiful if it is invisible';

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
        array(189,76,189,156,104,67,43,109),
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
                <a class="navbar-brand" href="#">Assignment 3</a>
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
            <h1 class="mt-5">Assignment 3 - Esercizio 2</h1>
            <p>Frase da nascondere</p>
            <p><?php echo $secretMessage; ?></p>
            <p>Blocco 8x8 di Luminanza <i>Y</i></p>
            <?php printMatrix($Y); ?>
            <p>Blocco 8x8 di Crominanza <i>Q</i></p>
            <?php printMatrix($Q); ?>
        </section>
        <section class="container">
            <h2>Step 1: analisi del messaggio segreto</h2>
            <p>Rimozione di tutti gli spazi e delle maiuscole</p>
            <code>
                <?php 
                $messageProcessed = textPreProcess($secretMessage);
                echo $messageProcessed;
                ?>
            </code>
            <p>Conversione in binario di tutte le lettere del messaggio</p>
            <code>
                <?php
                $messageBinary = textToBinary($messageProcessed);
                echo implode(' ', $messageBinary);
                ?>
            </code>
            <p>Bit totali del messaggio: <?php echo count($messageBinary) * 8 ?></p>
        </section>
        <section class="container">
            <h2>Step 2: calcolo dei coefficenti della DCT</h2>
            <p>Blocco 8x8 di Luminanza <i>Y</i></p>
            <?php 
            $dctY = dctTransform($Y);
            printMatrix($dctY);
            ?>
            <p>Blocco 8x8 di Crominanza <i>Q</i></p>
            <?php 
            $dctQ = dctTransform($Q);
            printMatrix($dctQ);
            ?>
        </section>
        <section class="container">
            <h2>Step 3: quantizzazione dei coefficenti della DCT</h2>
            <p>Blocco 8x8 di Luminanza <i>Y</i></p>
            <?php 
            $cY = quantization($dctY, $quantizationMatrixY);
            printMatrix($cY);
            ?>
            <p>Blocco 8x8 di Crominanza <i>Q</i></p>
            <?php 
            $cQ = quantization($dctQ, $quantizationMatrixQ);
            printMatrix($cQ);
            ?>
        </section>
        <section class="container">
            <h2>Step 4: lettura a zig-zag delle matrici</h2>
            <p>Vettore di Luminanza <i>Y</i></p>
            <code>
                <?php 
                $cY = zigzagScan($cY);
                echo implode(', ',$cY);
                ?>
            </code>
            <p>Vettore di Crominanza <i>Q</i></p>
            <code>
                <?php 
                $cQ = zigzagScan($cQ);
                echo implode(', ', $cQ);
                ?>
            </code>
        </section>
        <section class="container">
            <h2>Step 5: generatori pseudo casuali</h2>
            <h5>Linear Congruential</h5>
            <p>Parametri utilizzati:</p>
            <ul>
                <li>modulo: 2<sup>31</sup> - 1</li>
                <li>moltiplicatore: 48271</li>
                <li>incremento: 0</li>
                <li>seme: 64</li>
                <li>iterazioni: 64</li>
            </ul>
            <p>Sequenza di numeri pseudo casuali:</p>
            <code>
                <?php
                $lcg = linearCongruentialGenerator(pow(2,31) - 1, 48271, 0, 64, 64);
                echo implode(', ', $lcg);
                ?>
            </code>
            <p>Sequenza generata:</p>
            <code>
                <?php
                $lcg = binaryLCG($lcg);
                echo implode(', ', $lcg);
                ?>
            </code>
            <h5>Metodo: Blum Blum Shub</h5>
            <p>Parametri utilizzati:</p>
            <ul>
                <li>p: 383</li>
                <li>q: 503</li>
                <li>seme: 101355</li>
                <li>iterazioni: 64</li>
            </ul>
            <p>Sequenza generata:</p>
            <code>
                <?php
                $bbs = blumBlumShubGenerator(383, 503, 101355, 64);
                echo implode(', ', $bbs);
                ?>
            </code>
        </section>
        <section class="container">
            <h2>Step 6: calcolo dei coefficenti watermarked</h2>
            <?php $bitsToHide = flattenBits($messageBinary); ?>
            <div class="mb-4">
                <h5>Test A</h5>
                <p>Generatore pseudo casuale: <b>LCG</b></p>
                <p>Bit cambiati: <b>1</b></p>
                <p>Vettore: <b>Luminanza <i>Y</i></b></p>
                <?php $totBit = drawTable($cY, $lcg, $bitsToHide, 1); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Vettore: <b>Crominanza <i>Q</i></b></p>
                <?php $totBit = drawTable($cQ, $lcg, $bitsToHide, 1, $totBit); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Distribuzione del rumore pseudo casuale: <b>[-1, 1]</b></p>
            </div>
            <div class="mb-4">
                <h5>Test B</h5>
                <p>Generatore pseudo casuale: <b>BBS</b></p>
                <p>Bit cambiati: <b>1</b></p>
                <p>Vettore: <b>Luminanza <i>Y</i></b></p>
                <?php $totBit = drawTable($cY, $bbs, $bitsToHide, 1); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Vettore: <b>Crominanza <i>Q</i></b></p>
                <?php $totBit = drawTable($cQ, $bbs, $bitsToHide, 1, $totBit); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Distribuzione del rumore pseudo casuale: <b>[-1, 1]</b></p>
            </div>
            <div class="mb-4">
                <h5>Test C</h5>
                <p>Generatore pseudo casuale: <b>LCG</b></p>
                <p>Bit cambiati: <b>2</b></p>
                <p>Vettore: <b>Luminanza <i>Y</i></b></p>
                <?php $totBit = drawTable($cY, $lcg, $bitsToHide, 2); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Vettore: <b>Crominanza <i>Q</i></b></p>
                <?php $totBit = drawTable($cQ, $lcg, $bitsToHide, 2, $totBit); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Distribuzione del rumore pseudo casuale: <b>[-1, 3]</b></p>
            </div>
            <div class="mb-4">
                <h5>Test D</h5>
                <p>Generatore pseudo casuale: <b>BBS</b></p>
                <p>Bit cambiati: <b>2</b></p>
                <p>Vettore: <b>Luminanza <i>Y</i></b></p>
                <?php $totBit = drawTable($cY, $bbs, $bitsToHide, 2); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Vettore: <b>Crominanza <i>Q</i></b></p>
                <?php $totBit = drawTable($cQ, $bbs, $bitsToHide, 2, $totBit); ?>
                <p class="mt-3">Totale bit del messaggio segreto stenografati: <b><?php echo $totBit ?></b> di 264</p>
                <p>Distribuzione del rumore pseudo casuale: <b>[-1, 3]</b></p>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
</body>
</html>