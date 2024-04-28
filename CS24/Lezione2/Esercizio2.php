<?php
include 'functions.php';
?>

<!DOCTYPE html>
    <head>
        <title>Lezione 2</title>
    </head>
    <body>
        <section>
            <h3>Somma di due variabili</h3>
            <span> 10 + 10 =
            <?php
            $var1 = 10;
            $var2 = 10;
            $result = $var1 + $var2;
            echo $result;
            ?>
            or 
            <?php echo sum($var1, $var2); ?>
            </span>
        </section>
        <section>
            <h3>Calcolo teorema di Pitagora</h3>
            <img src="https://scuolaelettrica.it/media/classe2/matematica/geometria/pitagora1.jpg" width="25%">
            <div>b = 6</div>
            <div>c = 3</div>
            <div> a = 
                <?php
                $a = 0;
                $b = 6;
                $c = 3;
                $base = 2;
                $a = sqrt(pow($base, $b) + pow($base, $c));
                echo $a;
                ?>
            </div>
        </section>
    </body>
</html>