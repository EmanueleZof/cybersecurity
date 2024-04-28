<?php
    include 'functions.php';
    $rawMessage = 'LEVKHWDKOXAESDXKHOHLHYLVEBIKXOWIHVIDKXOVHDKHOEKDWVDY OJDEOJIYDRIVDBDOJDXKDKODSIKLIKIWWHOIKLVHWIHLEQDOHSDCHG EVDCJCJDHEOOXGHLHSHDVXYYDGEOESEGEWDKDCDESIWWDKRHYD EKISXIHKKDBHKIWWIXWLDQIEVIDKBHLLDWDQGDHKLEYLHLEHLLHOOH LESHSDRIVYDSVEKDXKESIDMXHWDDKGHVLDOEWHVIJHDQGHLLHLEW HYLVXLLXVHSDOEKLIKDQIKLESIWVIHLLEVIKXQIVEYIKCHGIVBEVLXKHO HXYHVISHKKDOVDLDOD';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignement 1 - Esercizio 1</title>
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
                            <a class="nav-link active" aria-current="page" href="#">Esercizio 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Esercizio 2</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <section class="container">
            <h1 class="mt-5">Assignement 1 - Esercizio 1</h1>
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
            <h2>Step 2: analisi delle frequenze</h2>
            <div class="mt-2 mb-2">Tabella con l'analisi delle frequenze delle lettere del testo cifrato, in ordine decrescente</div> 
            <table>
                <tr>
                    <th>Lettera</th>
                    <th>Totale occorrenze</th>
                    <th>Percentuale</th>
                </tr>
                <?php $letters = frequencyAnalysis($message); ?>
                <script>var cypherGraphDataUnordered = <?php echo json_encode($letters); ?>;</script>
                <?php
                arsort($letters);
                foreach($letters as $letter => $value) {
                    echo '<tr>';
                    echo '<td>'.$letter.'</td>';
                    echo '<td>'.$value['count'].'</td>';
                    echo '<td>'.$value['percent'].'%</td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <div class="row align-items-start mt-2 mb-2">
                <div class="col">
                    <p class="mb-2">Grafico a barre delle frequenze delle lettere del testo cifrato, in ordine descresente.</p>
                    <script>var cypherGraphData = <?php echo json_encode($letters); ?>;</script>
                    <div id="cypher_graph"></div>
                </div>
                <div class="col">
                    <p class="mb-2">Grafico a barre delle frequenze delle lettere della lingua Italiana, in ordine decrescente.</p>
                    <script>
                        var italianGraphDataUnordered = <?php echo json_encode($italianFrequency); ?>;
                        var italianGraphData = <?php arsort($italianFrequency); echo json_encode($italianFrequency); ?>;
                    </script>
                    <div id="italian_graph"></div>
                </div>
            </div>
        </section>
        <section class="container">
            <h2>Step 3: verifica se cifrario di cesare</h2>
            <div class="row align-items-start mt-2 mb-2">
                <div class="col">
                    <p class="mb-2">Grafico a barre delle frequenze delle lettere del testo cifrato</p>
                    <script>var cypherGraphData = <?php echo json_encode($letters); ?>;</script>
                    <div id="cypher_graph_unordered"></div>
                </div>
                <div class="col">
                    <p class="mb-2">Grafico a barre delle frequenze delle lettere della lingua Italiana</p>
                    <div id="italian_graph_unordered"></div>
                </div>
            </div>
        </section>
        <section class="container">
            <h2>Step 3: analisi delle doppie</h2>
            <p>Di seguito vengono individuate ed evidenziate tutte le lettere doppie (in arancione) e le lettere direttamente precedenti o successive (in giallo).</p>
            <p class="monospace text-break">
                <?php  $doppie = hihglighter($message); ?>
            </p>
            <div class="row align-items-start mt-2 mb-2">
                <div class="col">
                    <table>
                        <tr>
                            <th>Doppie testo cifrato</th>
                            <th>Totale occorrenze</th>
                        </tr>
                        <?php
                        arsort($doppie);
                        foreach($doppie as $doppia => $value) {
                            echo '<tr>';
                            echo '<td>'.$doppia.'</td>';
                            echo '<td>'.$value.'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col">
                    <table>
                        <tr>
                            <th>Doppie lingua italiana</th>
                            <th>Frequenze</th>
                        </tr>
                        <?php
                        arsort($italianDoppieFrequency);
                        foreach($italianDoppieFrequency as $doppia => $value) {
                            echo '<tr>';
                            echo '<td>'.$doppia.'</td>';
                            echo '<td>'.$value.'%</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <section class="container">
            <h2>Step 4: sostituzione delle lettere</h2>
            <div>
                <?php 
                    $a = array(
                        'H' => 'a',
                        'K' => 'n',
                        'X' => 'u',
                        'E' => 'o',
                        'L' => 't',
                        'V' => 'r',
                        'Y' => 's',
                        'B' => 'f',
                        'O' => 'c',
                        'W' => 'l',
                        'I' => 'e',
                        'G' => 'p',
                        'S' => 'd',
                        'D' => 'i',
                        'A' => 'b',
                        'J' => 'h',
                        'R' => 'v',
                        'Q' => 'm',
                        'C' => 'z',
                        'M' => 'q',
                    );
                ?>
                <p><?php print_r($a); ?></p>
                <p class="monospace text-break decode">
                    <?php echo decode($message, $a); ?>
                </p>
            </div>
        </section>
        <section class="container">
            <h2>Step 5: testo in chiaro (con spazi e punteggiatura)</h2>
            <p class="monospace text-break">Torna l'incubo di una catastrofe nucleare in Ucraina con il rischio che si verifichi un incidente nella centrale atomica di Zaporizhzhia occupata dai russi poco dopo l'inizio dell' invasione due anni fa.</p>
            <p class="monospace text-break">Nelle ultime ore, infatti, l'impianto è stato attaccato da diversi droni uno dei quali in particolare ha impattato la struttura di contenimento del reattore numero senza per fortuna causare danni critici.</p>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-2.31.1.min.js" charset="utf-8"></script>
    <script src="js/esercizio1.js"></script>
</body>
</html>