<?php
    include 'spn.php';
    
    $input1 = '10100110'; //bindec('10100110'); //0b10100110;
    $input2 = 0b10110110;
    $key1 = '0010110010010101'; //bindec('0010110010010101'); //0b0010110010010101;
    $key2 = 0b0010010010010101;
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
            <p class="lead">TODO</p>
            <div class="monospace"><?php echo $input1 ?> XOR</div>
            <div class="monospace">
                <?php
                $ar = str_split($key1, 8);
                //$test = 0b00101100;
                //echo printBinary($test)
                echo $ar[1];
                ?> 
            =</div>
            <div class="monospace">
                <?php
                $result = bindec($input1) ^ bindec($ar[1]);
                echo printBinary($result);
                ?>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-2.31.1.min.js" charset="utf-8"></script>
</body>
</html>