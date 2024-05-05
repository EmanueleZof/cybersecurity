<?php
    include 'spn.php';
    
    $plainText1 = '10100110';
    $plainText2 = '10110110';
    $key1 = '0010110010010101';
    $key2 = '0010010010010101';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignement 2 - Esercizio 1</title>
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
                            <a class="nav-link active" aria-current="page" href="#">Esercizio 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="esercizio2.php">Esercizio 2</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <section class="container">
            <h1 class="mt-5">Assignement 2 - Esercizio 1</h1>
            <p class="lead">Testo da cifrare e chiavi</p>
            <p><b>Plaintext 1: </b><code><?php echo $plainText1 ?></code></p>
            <p><b>Plaintext 2: </b><code><?php echo $plainText2 ?></code></p>
            <p><b>Key 1: </b><code><?php echo $key1 ?></code></p>
            <p><b>Key 2: </b><code><?php echo $key2 ?></code></p>
        </section>
        <section class="container">
            <h2>Step 1: analisi del PLAINTEXT</h2>
            <p>Risultato dell'algoritmo SPN quando il testo in chiaro viene cambiato di 1 bit</p>
            <?php
            $iterations = 10;
            $keysStep1 = keySchedule($key1);
            //$keysStep1 = keyScheduleTest1($key1, $iterations);
            ?>
            <!--<p>Chiave utilizzata (Key 1): <code><?php echo $key1 ?></code> => K<sub>0</sub>: <code><?php echo $keysStep1[0] ?></code> K<sub>1</sub>: <code><?php echo $keysStep1[1] ?></code></p>-->
            <p>Chiave utilizzata (Key 1): <code><?php echo $key1 ?></code></code></p>
            <table>
                <tr>
                    <th>Round</th>
                    <th>Sotto chiave</th>
                    <th>Output</th>
                    <th>Differenza</th>
                </tr>
                <tr>
                    <td></td>
                    <td><code><?php echo $keysStep1[0] ?></code></td>
                    <td><code><?php echo $plainText1 ?></code><br><code><?php echo $plainText2 ?></code></td>
                    <td>1 bit (12,5%)</td>
                </tr>
                <?php
                $a = printBinary(binaryXOR($plainText1, $keysStep1[0]));
                $b = printBinary(binaryXOR($plainText2, $keysStep1[0]));
                for ($i = 1; $i < $iterations; ++$i) {
                    $keySelector = $i % 2;
                    //$keySelector = $i;
                    $a = spBlock($a, $keysStep1[$keySelector]);
                    $b = spBlock($b, $keysStep1[$keySelector]);
                    list($differenceBits, $differencePercentage) = getDifference($a, $b);
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td><code>'.$keysStep1[$keySelector].'</code></td>';
                    echo '<td><code>'.$a.'</code><br><code>'.$b.'</code></td>';
                    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
                    echo '</tr>';
                    /*$result1 = spBlock($a, $keysStep1[$keySelector]);
                    $result2 = spBlock($b, $keysStep1[$keySelector]);
                    list($differenceBits, $differencePercentage) = getDifference($result1, $result2);
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td><code>'.$keysStep1[$keySelector].'</code></td>';
                    echo '<td><code>'.$result1.'</code><br><code>'.$result2.'</code></td>';
                    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
                    echo '</tr>';*/
                }
                ?>
            </table>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>