<?php
    include 'functions.php';
    $message = 'LEVKHWDKOXAESDXKHOHLHYLVEBIKXOWIHVIDKXOVHDKHOEKDWVDY OJDEOJIYDRIVDBDOJDXKDKODSIKLIKIWWHOIKLVHWIHLEQDOHSDCHG EVDCJCJDHEOOXGHLHSHDVXYYDGEOESEGEWDKDCDESIWWDKRHYD EKISXIHKKDBHKIWWIXWLDQIEVIDKBHLLDWDQGDHKLEYLHLEHLLHOOH LESHSDRIVYDSVEKDXKESIDMXHWDDKGHVLDOEWHVIJHDQGHLLHLEW HYLVXLLXVHSDOEKLIKDQIKLESIWVIHLLEVIKXQIVEYIKCHGIVBEVLXKHO HXYHVISHKKDOVDLDOD';
    //$message = 'HXYHVISHKKDOVDLDOD';
?>

<!DOCTYPE html>
    <head>
        <title>Assignement 1</title>
    </head>
    <body>
        <section>
            Testo da cifrare
            <div><?php  echo $message ?></div>
        </section>
        <section>
            Testo in array
            <div><?php 
            $a = messageToArray($message);
            $length = count($a);
            for ($i = 0; $i < $length; ++$i) {
                /*if (($i+1) < $length) {
                    if ($a[$i] == $a[$i+1]) {
                        echo '<span style="font-weight: bold;">'.$a[$i].'</span>';
                    } 
                    echo '<div>'.$a[$i].' - '.$a[$i+1].'</div>';
                }*/
                if ($a[$i] == ' ') {
                    echo '<span style="background-color: red; color: red;">-</span>';
                } else if (($i+1) < $length) {
                    if ($a[$i] == $a[$i + 1]) {
                        echo '<span style="background-color: orange;">'.$a[$i].'</span>';
                        echo '<span style="background-color: orange;">'.$a[$i+1].'</span>';
                        $i++;
                    } else {
                        echo '<span>'.$a[$i].'</span>';
                    }
                } else {
                    echo '<span>'.$a[$i].'</span>';
                }
            }
            /*foreach(messageToArray($message) as $letter) {
                if ($letter == ' ') {
                    echo '<span style="background-color: red; color: red;">-</span>';
                } if ($letter = '') {
                    echo '<span style="font-weigth: bold;">'.$letter.'</span>';
                } else {
                    echo "<span>".$letter."</span>";
                }
            }*/
            ?></div>
        </section>
        <section>
            <h2>Step 1: rimuovere punteggiatura e spazi</h2>
            <div><?php echo preProcessing($message) ?></div>
        </section>
        <h2>Step 2: analisi frequenze (in ordine descrescente)</h2>
        <section style="float: left; width: 50%;">
            <ol>
                <?php
                $letters = frequencyAnalysis(preProcessing($message));
                arsort($letters);
                foreach($letters as $letter => $count) {
                    $percentage = ($count*26)/100;
                    echo "<li>".$letter." - ".$count." - ".$percentage."%</li>";
                }
                ?>
            </ol>
        </section>
        <section style="float: right; width: 50%;">
            <ol>
                <?php
                $it = $italianFrequency;
                arsort($it);
                foreach($it as $key => $value) {
                    echo "<li>".strtoupper($key)." - ".$value."%</li>";
                }
                ?>
            </ol>
        </section>
        <div style="clear: both;"></div>
        <section style="font-family: monospace;font-size: 16px;">
            <h2>Step 3: sostituzione lettere</h2>
            <?php
                $decypher = $message;
                $decypher = str_replace("A", "b", $decypher);
                $decypher = str_replace("B", "f", $decypher);
                $decypher = str_replace("C", "z", $decypher);
                $decypher = str_replace("D", "i", $decypher);
                $decypher = str_replace("E", "o", $decypher);
                $decypher = str_replace("F", "-", $decypher);
                $decypher = str_replace("G", "p", $decypher);
                $decypher = str_replace("H", "a", $decypher);
                $decypher = str_replace("I", "e", $decypher);
                $decypher = str_replace("J", "h", $decypher);
                $decypher = str_replace("K", "n", $decypher);
                $decypher = str_replace("L", "t", $decypher);
                $decypher = str_replace("M", "q", $decypher);
                $decypher = str_replace("N", "-", $decypher);
                $decypher = str_replace("O", "c", $decypher);
                $decypher = str_replace("P", "-", $decypher);
                $decypher = str_replace("Q", "m", $decypher);
                $decypher = str_replace("R", "v", $decypher);
                $decypher = str_replace("S", "d", $decypher);
                $decypher = str_replace("T", "-", $decypher);
                $decypher = str_replace("U", "-", $decypher);
                $decypher = str_replace("V", "r", $decypher);
                $decypher = str_replace("W", "l", $decypher);
                $decypher = str_replace("X", "u", $decypher);
                $decypher = str_replace("Y", "s", $decypher);
                $decypher = str_replace("Z", "-", $decypher);
            ?>
            <div><?php echo $decypher ?></div>
        </section>
        <section style="font-family: monospace;font-size: 16px;">
            <h2>Step 4: testo decifrato</h2>
            <div>Torna l'incubo di una catastrofe nucleare in Ucraina con il rischio che si verifichi un incidente nella centrale atomica di Zaporizhzhia occupata dai Russi poco dopo l'inizio dell'invasione due anni fà. Nelle ultime ore infatti l'impianto è stato attaccato da diversi droni, uno dei quali in particolare ha impattato la struttura di contenimento del reattore numero [...] senza perfortuna causare danni critici.</div>
        </section>
       <!-- <section>
            <h2>Test: cifratura di cesare</h2>
            <div></div>
        </section>-->
    </body>
</html>