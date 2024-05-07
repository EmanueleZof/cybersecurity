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
            <h2>Effetto valanga: cambiamento nel PLAINTEXT</h2>
            <p>Risultato dell'algoritmo SPN proposto, quando il testo in chiaro viene cambiato di 1 bit</p>
            <?php $iterations = 20; ?>
            <div class="mt-3 mb-3">
            <?php drawPlaintextComparisonTable($plainText1, $plainText2, $key1, 'Key 1', $iterations) ?>
            </div>
            <div class="mt-3 mb-3">
            <?php drawPlaintextComparisonTable($plainText1, $plainText2, $key2, 'Key 2', $iterations) ?>
            </div>
        </section>
        <section class="container">
            <h2>Effetto valanga: cambiamento nella CHIAVE</h2>
            <p>Risultato dell'algoritmo SPN proposto, quando le chiavi differiscono di 1 bit</p>
            <?php $iterations = 20; ?>
            <div class="mt-3 mb-3">
            <?php drawKeysComparisonTable($plainText1, 'Plaintext 1', $key1, $key2, $iterations) ?>
            </div>
            <div class="mt-3 mb-3">
            <?php drawKeysComparisonTable($plainText2, 'Plaintext 2', $key1, $key2, $iterations) ?>
            </div>
        </section>
        <section class="container">
            <h2>Effetto valanga: cambiamento nel PLAINTEXT con keySchedule differente</h2>
            <p>Risultato dell'algoritmo SPN proposto, quando il testo in chiaro viene cambiato di 1 bit e con un diverso criterio di generazione delle sottochiavi.</p>
            <p>La chiave viene generata facendo prima uno shift a sinistra (di una posizione) e poi dividendola in due sotto chiavi.</p>
            <?php $iterations = 20; ?>
            <div class="mt-3 mb-3">
            <?php drawPlaintextComparisonTableTest($plainText1, $plainText2, $key1, 'Key 1', $iterations) ?>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-2.31.1.min.js" charset="utf-8"></script>
    <script src="js/esercizio1.js"></script>
</body>
</html>