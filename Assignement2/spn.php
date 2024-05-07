<?php
/**
 * Converte un numero binario in una stringa di 8 cifre binarie.
 *
 * @param int $binary Il numero binario da stampare.
 * @return string Una stringa rappresentante il numero binario su 8 cifre.
 * @see https://www.php.net/manual/en/function.decbin.php
 */
function printBinary($binary) {
    return sprintf('%08b',  $binary);
}

/**
 * Esegue l'operazione di XOR bit a bit tra due numeri binari e restituisce il risultato.
 *
 * @param string $input1 Il primo numero binario.
 * @param string $input2 Il secondo numero binario.
 * @return int Il risultato dell'operazione XOR tra i due numeri binari.
 */
function binaryXOR($input1, $input2) {
    return bindec($input1) ^ bindec($input2);
}

/**
 * Esegue uno shift a sinistra su una rappresentazione binaria di un numero.
 *
 * @param string $input La rappresentazione binaria del numero da cui eseguire lo shift a sinistra.
 * @return string La rappresentazione binaria del numero dopo lo shift a sinistra.
 */
function binaryLeftShift($input) {
    $stack = str_split($input);
    $shifted = array_shift($stack);
    array_push($stack, $shifted);
    return implode('', $stack);
}

/**
 * Implementa la S-box della SPN. 
 * Applica la sostituzione di un numero binario in input in un'altro in output, secondo il criterio dato.
 *
 * @param string $input Il numero binario da sottoporre alla sostituzione S-box.
 * @param string $type Il tipo di operazione da eseguire sulla S-box, 'encript' per crittografare (predefinito) o 'decript' per decrittografare.
 * @return string Il risultato della sostituzione S-box.
 */
function sBox($input, $type = 'encript') {
    $s = array(
        '0000' => '1110',
        '0001' => '0100',
        '0010' => '1101',
        '0011' => '0001',
        '0100' => '0010',
        '0101' => '1111',
        '0110' => '1011',
        '0111' => '1000',
        '1000' => '0011',
        '1001' => '1010',
        '1010' => '0110',
        '1011' => '1100',
        '1100' => '0101',
        '1101' => '1001',
        '1110' => '0000',
        '1111' => '0111',
    );
    if ($type == 'decript') {
        return array_flip($s)[$input];
    }
    return $s[$input];
}

/**
 * Implementa la P-box della SPN.
 * Applica una permutazione su due stringhe binarie date in input.
 *
 * @param string $input1 La prima stringa binaria da sottoporre alla permutazione P-box.
 * @param string $input2 La seconda stringa binaria da sottoporre alla permutazione P-box.
 * @param string $type Il tipo di operazione da eseguire sulla P-box, 'encript' per crittografare (predefinito) o 'decript' per decrittografare.
 * @return string Il risultato della permutazione P-box.
 */
function pBox($input1, $input2, $type = 'encript') {
    $input = str_split($input1.$input2);
    $output = array();

    if ($type == 'decript') {
        $output[0] = $input[6];
        $output[1] = $input[4];
        $output[2] = $input[3];
        $output[3] = $input[1];
        $output[4] = $input[7];
        $output[5] = $input[2];
        $output[6] = $input[5];
        $output[7] = $input[0];
    } else {
        $output[0] = $input[7];
        $output[1] = $input[3];
        $output[2] = $input[5];
        $output[3] = $input[2];
        $output[4] = $input[1];
        $output[5] = $input[6];
        $output[6] = $input[0];
        $output[7] = $input[4];
    }

    return implode('', $output);
}

/**
 * Suddivide una chiave in una serie di sottochiavi di lunghezza fissa.
 *
 * @param string $key La chiave da suddividere.
 * @return array Un array contenente le sottochiavi generate dalla divisione della chiave.
 */
function keySchedule($key) {
    return str_split($key, 8);
}

/**
 * Genera una serie di sottochiavi shiftando a sinistra di un bit e dividendo in sottochiavi di lunghezza fissa.
 *
 * @param string $key La chiave principale da utilizzare per generare le sottochiavi.
 * @param int $tot Il numero totale di sottochiavi da generare.
 * @return array Un array contenente le sottochiavi generate.
 */
function keyScheduleTest($key, $tot) {
    $s = str_split($key, 8);
    $a = array($s[0],$s[1]);
    for ($i = 2; $i < $tot; $i = $i + 2) {
        $key = binaryLeftShift($key);
        $s = str_split($key, 8);
        array_push($a, $s[0],$s[1]);
    }
    return $a;
}

/**
 * Implementa un singolo strato della SPN.
 * Applica una combinazione di sostituzione e permutazione (S-box e P-box) e un XOR bit a bit tra l'input generato e la chiave.
 *
 * @param string $input Il blocco di input da elaborare.
 * @param string $key La chiave da utilizzare per l'operazione di XOR.
 * @param bool $permutation Specifica se applicare anche la permutazione P-box. Il valore predefinito è true.
 * @return string Il risultato dell'elaborazione del blocco di input.
 */
function spBlock($input, $key, $permutation = true) {
    $b = str_split($input, 4);
    $c1 = sBox($b[0]);
    $c2 = sBox($b[1]);
    if ($permutation) {
        $d = pBox($c1, $c2);
    } else {
        $d = $c1.$c2;
    }
    $e = binaryXOR($d, $key);
    return printBinary($e);
}

/**
 * Calcola la differenza tra due stringhe binarie e restituisce il numero di bit diversi e la percentuale di differenza.
 *
 * @param string $input1 La prima stringa binaria.
 * @param string $input2 La seconda stringa binaria.
 * @return array Un array contenente il numero di bit diversi e la percentuale di differenza.
 */
function getDifference($input1, $input2) {
    $d = printBinary(binaryXOR($input1, $input2));
    $l = strlen($d);
    $n = substr_count($d, '1');
    $p = ($n / $l) * 100;
    return array($n, $p.'%');
}

/**
 * Disegna la tabella di confronto (ed il grafico) tra testi in chiaro, utilizzando l'algoritmo SPN implementato.
 *
 * @param string $plainText1 Il primo testo in chiaro da confrontare.
 * @param string $plainText2 Il secondo testo in chiaro da confrontare.
 * @param string $key La chiave utilizzata per la crittografia.
 * @param string $keyLabel Etichetta della chiave per l'output.
 * @param int $iterations Il numero di round dell'algoritmo.
 * @return void
 */
function drawPlaintextComparisonTable($plainText1, $plainText2, $key, $keyLabel, $iterations) {
    $roundKeys = keySchedule($key);
    $differenceResults = array();

    echo '<p>Chiave utilizzata ('.$keyLabel.'): <code>'.$key.'</code> => K<sub>0</sub>: <code>'.$roundKeys[0].'</code> K<sub>1</sub>: <code>'.$roundKeys[1].'</code></p>';
    echo '<table>';
    echo '<tr><th>Round</th><th>Sotto chiave</th><th>Output</th><th>Differenza</th></tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><code>'.$roundKeys[0].'</code></td>';
    echo '<td><code>'.$plainText1.'</code><br><code>'.$plainText2.'</code></td>';
    list($differenceBits, $differencePercentage) = getDifference($plainText1, $plainText2);
    array_push($differenceResults, $differenceBits);
    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
    echo '</tr>';

    $a = printBinary(binaryXOR($plainText1, $roundKeys[0]));
    $b = printBinary(binaryXOR($plainText2, $roundKeys[0]));
    for ($i = 1; $i < $iterations; ++$i) {
        $keySelector = $i % 2;
        $a = spBlock($a, $roundKeys[$keySelector]);
        $b = spBlock($b, $roundKeys[$keySelector]);
        list($differenceBits, $differencePercentage) = getDifference($a, $b);
        array_push($differenceResults, $differenceBits);
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td><code>'.$roundKeys[$keySelector].'</code></td>';
        echo '<td><code>'.$a.'</code><br><code>'.$b.'</code></td>';
        echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
        echo '</tr>';
    }

    echo '</table>';

    $elementID = str_replace(' ', '', strtolower($keyLabel));
    echo '<script>var '.$elementID.'GraphData = '.json_encode($differenceResults).';</script>';
    echo '<div id="'.$elementID.'" class="graph"></div>';
}

/**
 * Disegna una tabella di confronto (e il grafico) tra due chiavi, utilizzando l'algoritmo SPN implementato.
 *
 * @param string $plainText Il testo in chiaro utilizzato per il confronto.
 * @param string $textLabel Etichetta del testo per l'output.
 * @param string $key1 La prima chiave utilizzata per la crittografia.
 * @param string $key2 La seconda chiave utilizzata per la crittografia.
 * @param int $iterations Il numero di round dell'algoritmo.
 * @return void
 */
function drawKeysComparisonTable($plainText, $textLabel, $key1, $key2, $iterations) {
    $roundKeys1 = keySchedule($key1);
    $roundKeys2 = keySchedule($key2);
    $differenceResults = array();

    echo '<p>Testo utilizzato ('.$textLabel.'): <code>'.$plainText.'</code></p>';
    echo '<table>';
    echo '<tr><th>Round</th><th>Sotto chiave</th><th>Output</th><th>Differenza</th></tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><code>'.$roundKeys1[0].'</code><br><code>'.$roundKeys2[0].'</code></td>';
    echo '<td><code>'.$plainText.'</code><br><code>'.$plainText.'</code></td>';
    list($differenceBits, $differencePercentage) = getDifference($plainText, $plainText);
    array_push($differenceResults, $differenceBits);
    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
    echo '</tr>';

    $a = printBinary(binaryXOR($plainText, $roundKeys1[0]));
    $b = printBinary(binaryXOR($plainText, $roundKeys2[0]));
    for ($i = 1; $i < $iterations; ++$i) {
        $keySelector = $i % 2;
        $a = spBlock($a, $roundKeys1[$keySelector]);
        $b = spBlock($b, $roundKeys2[$keySelector]);
        list($differenceBits, $differencePercentage) = getDifference($a, $b);
        array_push($differenceResults, $differenceBits);
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td><code>'.$roundKeys1[$keySelector].'</code><br><code>'.$roundKeys2[$keySelector].'</code></td>';
        echo '<td><code>'.$a.'</code><br><code>'.$b.'</code></td>';
        echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
        echo '</tr>';
    }

    echo '</table>';

    $elementID = str_replace(' ', '', strtolower($textLabel));
    echo '<script>var '.$elementID.'GraphData = '.json_encode($differenceResults).';</script>';
    echo '<div id="'.$elementID.'" class="graph"></div>';
}

/**
 * 
 */
function drawPlaintextComparisonTableTest($plainText1, $plainText2, $key, $keyLabel, $iterations) {
    $roundKeys = keyScheduleTest($key, $iterations);
    $differenceResults = array();

    echo '<p>Chiave utilizzata ('.$keyLabel.'): <code>'.$key.'</code> => K<sub>0</sub>: <code>'.$roundKeys[0].'</code> K<sub>1</sub>: <code>'.$roundKeys[1].'</code></p>';
    echo '<table>';
    echo '<tr><th>Round</th><th>Sotto chiave</th><th>Output</th><th>Differenza</th></tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><code>'.$roundKeys[0].'</code></td>';
    echo '<td><code>'.$plainText1.'</code><br><code>'.$plainText2.'</code></td>';
    list($differenceBits, $differencePercentage) = getDifference($plainText1, $plainText2);
    array_push($differenceResults, $differenceBits);
    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
    echo '</tr>';

    $a = printBinary(binaryXOR($plainText1, $roundKeys[0]));
    $b = printBinary(binaryXOR($plainText2, $roundKeys[0]));
    for ($i = 1; $i < $iterations; ++$i) {
        $keySelector = $i;
        $a = spBlock($a, $roundKeys[$keySelector]);
        $b = spBlock($b, $roundKeys[$keySelector]);
        list($differenceBits, $differencePercentage) = getDifference($a, $b);
        array_push($differenceResults, $differenceBits);
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td><code>'.$roundKeys[$keySelector].'</code></td>';
        echo '<td><code>'.$a.'</code><br><code>'.$b.'</code></td>';
        echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
        echo '</tr>';
    }

    echo '</table>';

    $elementID = str_replace(' ', '', strtolower($keyLabel));
    echo '<script>var '.$elementID.'GraphData = '.json_encode($differenceResults).';</script>';
    echo '<div id="'.$elementID.'" class="graph"></div>';
}
?>