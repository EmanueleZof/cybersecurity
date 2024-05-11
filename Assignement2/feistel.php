<?php
/**
 * 
 */
function binaryXOR($input1, $input2) {
    $output = bindec($input1) ^ bindec($input2);
    return sprintf('%08b',  $output);
}

/**
 * 
 */
function feistelNetwork($input, $stages, $function, $keys) {
    $split = str_split($input, strlen($input)/2);
    $left = $split[0];
    $right = $split[1];
    $log = array();
    $log[0] = array('L' => $left, 'R' => $right);
    for ($i = 0; $i < $stages; ++$i) {
        $l = $left;
        $f = $function($right, $keys[$i]);
        $left = $right;
        $right = binaryXOR($l, $f);
        $log[$i+1] = array('L' => $left, 'R' => $right);
    }    
    $log[$i+1] = array('R' => $right, 'L' => $left);
    $result = $right.$left;
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
 * 
 */
function drawComparisonTable($text1, $text2, $log1, $log2, $res1, $res2) {
    echo '<table class="borders">';
    echo '<tr><th>Plaintext</th><th>Esecuzione</th><th>Risultato</th><th>Differenza</th></tr>';
    
    echo '<tr>';
    echo '<td><code>'.$text1.'</code></td>';
    echo '<td>';
    foreach($log1 as $row) {
        print_r($row);
        echo '<br>';
    }
    echo '</td>';
    echo '<td><code>'.$res1.'</code></td>';
    list($differenceBits, $differencePercentage) = getDifference($res1, $res2);
    echo '<td rowspan="2">'.$differenceBits.'bit ('.$differencePercentage.')</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><code>'.$text2.'</code></td>';
    echo '<td>';
    foreach($log2 as $row) {
        print_r($row);
        echo '<br>';
    }
    echo '</td>';
    echo '<td><code>'.$res2.'</code></td>';
    echo '</tr>';

    echo '</table>';
}

/**
 * Test A
 */
$fA = function($text, $key) {  
    $sum = bindec($text) + bindec($key);
    $mod = $sum % 16;
    return sprintf('%08b',  $mod);
};
$kA = ['11101011','10111110'];

?>