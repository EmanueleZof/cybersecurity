<?php
/**
 * Esegue l'operazione di XOR bit a bit tra due numeri binari e restituisce il risultato in formato stringa.
 *
 * @param string $input1 Il primo numero binario.
 * @param string $input2 Il secondo numero binario.
 * @return string Una stringa rappresentante il numero binario.
 */
function binaryXOR($input1, $input2) {
    $output = bindec($input1) ^ bindec($input2);
    return sprintf('%08b',  $output);
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
 * Implementa una rete di Feistel su un input utilizzando una data funzione e una serie di chiavi.
 *
 * @param string $input Il testo in input da elaborare.
 * @param int $stages Il numero di stadi della rete di Feistel da eseguire.
 * @param callable $function La funzione da utilizzare per ogni stadio della rete di Feistel.
 * @param array $keys Un array contenente le chiavi da utilizzare per ogni stadio della rete di Feistel.
 * @return array Un array contenente il risultato dell'elaborazione e un registro delle operazioni eseguite.
 */
function feistelNetwork($input, $stages, $function, $keys) {
    // Dividi l'input in due parti
    $split = str_split($input, strlen($input)/2);
    $left = $split[0];
    $right = $split[1];
    
    // Inizializza un registro per memorizzare lo stato della rete
    $log = array();
    $log[0] = array('L' => $left, 'R' => $right);

    // Logica di ciascun stadio
    for ($i = 0; $i < $stages; ++$i) {
        $l = $left;
        // Applica la funzione specificata al blocco destro utilizzando la chiave corrispondente.
        $f = $function($right, $keys[$i], $i);
        $left = $right;
        // Esegui un'operazione XOR tra il blocco sinistro originale e il risultato della funzione.
        $right = binaryXOR($l, $f);
        // Aggiungi lo stato attuale al registro.
        $log[$i+1] = array('L' => $left, 'R' => $right);
    }

    // Aggiungi lo stato finale al registro.
    $log[$i+1] = array('R' => $right, 'L' => $left);

    // Concatena il blocco destro e sinistro per ottenere il risultato finale.
    $result = $right.$left;

    // Restituisce un array contenente il risultato dell'elaborazione e il registro delle operazioni eseguite.
    return array($result, $log);
}

/**
 * Calcola la differenza tra due stringhe binarie e restituisce il numero di bit diversi e la percentuale di differenza.
 *
 * @param string $input1 La prima stringa binaria.
 * @param string $input2 La seconda stringa binaria.
 * @return array Un array contenente il numero di bit diversi e la percentuale di differenza.
 */
function getDifference($input1, $input2) {
    $d = binaryXOR($input1, $input2);
    $n = substr_count($d, '1');
    $p = ($n / 16) * 100;
    return array($n, $p.'%');
}

/**
 * Disegna una tabella di confronto tra due testi e i loro risultati crittografici, inclusa la differenza tra i risultati.
 *
 * @param string $text1 Il primo testo da confrontare.
 * @param string $text2 Il secondo testo da confrontare.
 * @param array $data Un array contenente i dati da visualizzare nella tabella di confronto.
 * Ogni elemento dell'array rappresenta un confronto tra i due testi e contiene i seguenti campi:
 * - 'logs': un array bidimensionale contenente i log delle operazioni eseguite durante la crittografia per entrambi i testi.
 * - 'results': un array contenente i risultati crittografici per entrambi i testi.
 * @return void
 */
function drawComparisonTable($text1, $text2, $data) {
    echo '<table class="borders">';
    echo '<tr><th>Plaintext</th><th>Chiavi</th><th>Esecuzione</th><th>Risultato</th><th>Differenza</th></tr>';
    
    foreach($data as $label => $row) {
        echo '<tr>';
        echo '<td><code>'.$text1.'</code></td>';
        echo '<td>K<sub>'.$label.'</sub></td>';
        echo '<td>';
        foreach($row['logs'][0] as $log) {
            print_r($log);
            echo '<br>';
        }
        echo '</td>';
        echo '<td><code>'.$row['results'][0].'</code></td>';
        list($differenceBits, $differencePercentage) = getDifference($row['results'][0], $row['results'][1]);
        echo '<td rowspan="2">'.$differenceBits.'bit ('.$differencePercentage.')</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><code>'.$text2.'</code></td>';
        echo '<td>K<sub>'.$label.'</sub></td>';
        echo '<td>';
        foreach($row['logs'][1] as $log) {
            print_r($log);
            echo '<br>';
        }
        echo '</td>';
        echo '<td><code>'.$row['results'][1].'</code></td>';
        echo '</tr>';
    }

    echo '</table>';
}

/**
 * Key schedule A
 */ 
function keyScheduleA($input) {
    $r = strrev($input);
    return array($r, binaryLeftShift($r));
}

/**
 * Key schedule B
 */ 
function keyScheduleB($input) {
    $k = str_split($input);
    $p10 = array($k[2],$k[4],$k[1],$k[6],$k[3],$k[9],$k[0],$k[8],$k[7],$k[5]);
    $s = str_split(implode($p10), 5);
    $l = binaryLeftShift($s[0]);
    $r = binaryLeftShift($s[1]);
    $kk = str_split($l.$r);
    $k1 = array($kk[5],$kk[2],$kk[6],$kk[3],$kk[7],$kk[4],$kk[9],$kk[8]);
    $l = binaryLeftShift(binaryLeftShift($l));
    $r = binaryLeftShift(binaryLeftShift($r));
    $kk = str_split($l.$r);
    $k2 = array($kk[5],$kk[2],$kk[6],$kk[3],$kk[7],$kk[4],$kk[9],$kk[8]);
    return array(implode($k1), implode($k2));
}

/**
 * Key schedule C
 */ 
function keyScheduleC($input) {
    $s = str_split($input, 8);
    return array($s[0], $s[1]);
}

/**
 * Round function A
 */
$roundFunctionA = function($text, $key, $index) {  
    $sum = bindec($text) + bindec($key);
    $mod = $sum % 16;
    return sprintf('%08b',  $mod);
};

/**
 * Round function B
 */
$roundFunctionB = function($text, $key, $index) {  
    return binaryXOR($text, $key);
};

/**
 * Round function C
 */
$roundFunctionC = function($text, $key, $index) {
    $a = binaryXOR($text, $key);
    $s = str_split($a, 4);
    $p = array(
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
    return $p[$s[0]].$p[$s[1]];
};

/**
 * Round function D
 */
$roundFunctionD = function($text, $key, $index) {
    $t = str_split($text, 4);
    $k = str_split($key, 4);

    $p = array(
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
    $a = bindec($p[$t[0]]);
    $b = bindec($p[$k[0]]);
    $c = bindec($p[$t[1]]);
    $d = bindec($p[$k[1]]);

    $output = ($a + $b) % pow(2, 8);
    $output = $output ^ $c;
    $output = ($output + $d) % pow(2, 8);
    $output = $output << 1;

    return sprintf('%08b',  $output);
};

/**
 * Round function E
 */
$roundFunctionE = function($text, $key, $index) {
    $num = bindec($key);
    $exp = bindec($text);
    $output = pow($num, $exp) % pow(2, 8);
    return sprintf('%08b',  $output);
};
?>