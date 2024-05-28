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
            <p class="lead">Frase da nascondere</p>
            <p><?php echo $secretMessage; ?></p>
            <p class="lead">Blocco 8x8 di Luminanza <i>Y</i></p>
            <?php printMatrix($Y); ?>
            <p class="lead">Blocco 8x8 di Crominanza <i>Q</i></p>
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
            <p>Quantization</p>
            <p>
                <?php 
                /*$dctCoefficentsTest = array(
                    array(120,60,40,30,4,3,0,0),
                    array(70,48,32,3,4,1,0,0),
                    array(50,36,4,4,20,0,0,0),
                    array(40,4,5,1,1,0,0,0),
                    array(5,4,0,0,0,0,0,0),
                    array(3,2,0,0,0,0,0,0),
                    array(1,1,0,0,0,0,0,0),
                    array(0,0,0,0,0,0,0,0),
                );
                $quantizationTableTest = array(
                    array(10,10,15,20,25,30,35,40),
                    array(10,15,20,25,30,35,40,50),
                    array(15,20,25,30,35,40,50,60),
                    array(20,25,30,35,40,50,60,70),
                    array(25,30,35,40,50,60,70,80),
                    array(30,35,40,50,60,70,80,90),
                    array(35,40,50,60,70,80,90,100),
                    array(40,50,60,70,80,90,100,110),
                );

                $qc = quantization($dctCoefficentsTest, $quantizationTableTest);
                printMatrix($qc);*/

                $cY = quantization($dctY, $quantizationMatrixY);
                printMatrix($cY);

                $cQ = quantization($dctQ, $quantizationMatrixQ);
                printMatrix($cQ);
                ?>
            </p>
        </section>
        <section class="container">
            <p>Zig-Zag</p>
            <p>
                <?php 
                $cY = zigzagScan($cY);
                echo implode(' ',$cY);
                echo '<br>';
                $cQ = zigzagScan($cQ);
                echo implode(' ',$cQ);
                ?>
            </p>
        </section>
        <section class="container">
            <p>Pseudo random generator</p>
            <p>Linear Congruential</p>
            <p>
                <?php
                $lcg = linearCongruentialGenerator(pow(2,31) - 1, pow(7,5), 0, 1, 64);
                print_r($lcg);
                echo '<br>';
                $lcg = binaryLCG($lcg);
                print_r($lcg);
                ?>
            </p>
            <p>Blum Blum Shub</p>
            <p>
                <?php
                $bbs = blumBlumShubGenerator(383, 503, 101355, 64);
                print_r($bbs);
                ?>
            </p>
        </section>
        <section class="container">
            <p>Int to binary</p>
            <p>
                <?php
                $binaryDCT = intToBinary($cY);
                print_r($binaryDCT);
                //echo implode(' ',$binaryDCT);
                ?>
            </p>
        </section>
        <section class="container">
            <p>Test watermarked</p>
            <table class="matrix">
                <tr>
                    <th>Indice</th>
                    <th>Coefficente DCT</th>
                    <th>Coefficente DCT in binario</th>
                    <th>Pseudo random distribution</th>
                    <th>Bit messaggio segreto</th>
                    <th>Cambiamento del LSB</th>
                    <th>Coefficente Watermarked</th>
                    <th>Distribuzione rumore pseudo casuale</th>
                </tr>
                <?php
                $test = array(0,1,0,1,0,1,0,0,0,1,1,0,1,0,0,0,0,1,1,0,0,1,0,1,0,1,1,1,0,1,0,0,0,1,1,0,0,1,0,1,0,1,1,1,1,0,0,0,0,1,1,1,0,1,0,0,0,1,1,0,1,0,0,1);

                $lastIndex = 0;
                foreach($cY as $index => $coefficent) {
                    echo '<tr>';
                    echo '<td>'.$index.'</td>';
                    echo '<td>'.$coefficent.'</td>';
                    echo '<td>'.$binaryDCT[$index].'</td>';
                    echo '<td>'.$lcg[$index].'</td>';
                    echo '<td>';
                        if ($lcg[$index] == 0) {
                            echo '-';
                        } else {
                            $current =$test[$lastIndex];
                            echo $current;
                            ++$lastIndex;
                        }
                    echo '</td>';
                    echo '<td>';
                        if ($lcg[$index] == 0) {
                            echo '-';
                        } else {
                            $changed = changeLSB($binaryDCT[$index], $current);
                            echo $changed;
                        }
                    echo '</td>';
                    echo '<td>';
                        if ($lcg[$index] == 0) {
                            echo '-';
                        } else {
                            echo bindec($changed);
                        }
                    echo'</td>';
                    echo '<td>';
                    if ($lcg[$index] == 0) {
                        echo '0';
                    } else {
                        echo bindec($changed) - abs($coefficent);
                    }
                    echo '</td>';
                    echo '<tr>';
                }
                ?>
            </table>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
</body>
</html>