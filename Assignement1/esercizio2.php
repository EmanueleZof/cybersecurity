<?php
    include 'functions.php';
    $rawMessage = 'NYDVZLXQAIIYGCJBFISREUUMEJCASMKLSNIXQTAJCUVRLXCXVQFCVMEMGWVQZWCLACPF YEEIUMROZGQMWZVJSRYIZXLFCSPFAREIDXKCPQJFZDICJVZLMPCOSESYVIIQSXCRFECWKI YITHJCQUSIAEFYCTTATGUXFYVCZZIAYQPJKZFMTYDWMCGBJRZRMCWFVEYEPJXKGKTUWQ TANYTWZUEEIEUXRQBJHZUMHLRBNPCAIILLMNCQHTTCLPGRJXCYGMGLCMBPDSWUCDWL CONMMTAWWJGWKRKKFGTSRKWZTTAKDSEKMVCMKIMYGJFZRLECJZAHDKQUMTSXKYUMY DKAJIELMNCMMEJKAPRCARXYEHBMPCEMUAWRIJQMGXGFPVLXTIDMVACLJGZUSOYRLXQG KQMFDEOUTKAGPYFRZYQCUIWMMTGMEJMGEYJABTCGOXIGHWTZWGCFCMPVDIVNIWGGE YFHVAGQGGCMCTFBTVJQGMJWESVGMMQRSFCJKACOGEMTAJTUKCKYUCNTIWTKWFUIJG QTMDGPVCUMBOWYMMEGRQNKMGGDGMMTGREUIBTCRCORR';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignement 1 - Esercizio 2</title>
    <link href="css/main.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Assignement 1</a>
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
            <h1 class="mt-5">Assignement 1 - Esercizio 2</h1>
            <p class="lead">Testo da cifrare</p>
            <p class="monospace"><?php  echo $rawMessage ?></p>
        </section>
        <section class="container">
            <h2>Step 1: rimuovere punteggiatura e spazi</h2>
            <p class="monospace text-break">
                <?php 
                $message = preProcessing($rawMessage);
                echo $message;
                ?>
            </p>
        </section>
        <section class="container">
            <h2>Step 2: metodo di Kasiski</h2>
            <div class="mt-2 mb-2">
                <p>Cerco tutte le sequenze di caratteri di lunghezza 3, che si ripetono nel testo</p>
                <table>
                    <tr>
                        <th>Sequenza</th>
                        <th>Numero di occorrenze</th>
                        <th>Distanze</th>
                        <th>Scomposizione delle distanze in fattori primi</th>
                    </tr>
                    <?php
                    $pattern3 = findPattern($message, 3);
                    foreach($pattern3 as $sequence => $value) {
                        $distances = patternDistance($message, $sequence);
                        $primeFactors3 = array();
                        foreach($distances as $distance) {
                            array_push($primeFactors3, primeFactors($distance));
                        }

                        echo '<tr>';
                        echo '<td>'.$sequence.'</td>';
                        echo '<td>'.$value.'</td>';
                        echo '<td>'.implode(',', $distances).'</td>';
                        echo '<td>'.implode(',', $primeFactors3).'</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="mt-2 mb-2">
                <p>Cerco tutte le sequenze di caratteri di lunghezza 4, che si ripetono nel testo</p>
                <table>
                    <tr>
                        <th>Sequenza</th>
                        <th>Numero di occorrenze</th>
                        <th>Distanze</th>
                        <th>Scomposizione delle distanze in fattori primi</th>
                    </tr>
                    <?php
                    $pattern3 = findPattern($message, 4);
                    foreach($pattern3 as $sequence => $value) {
                        $distances = patternDistance($message, $sequence);
                        $primeFactors4 = array();
                        foreach($distances as $distance) {
                            array_push($primeFactors4, primeFactors($distance));
                        }

                        echo '<tr>';
                        echo '<td>'.$sequence.'</td>';
                        echo '<td>'.$value.'</td>';
                        echo '<td>'.implode(',', $distances).'</td>';
                        echo '<td>'.implode(',', $primeFactors4).'</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-2.31.1.min.js" charset="utf-8"></script>
    <!-- <script src="js/esercizio1.js"></script> -->
</body>
</html>