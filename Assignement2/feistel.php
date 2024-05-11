<?php
/**
 * 
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
        $f = $function($right, $keys[$i], $i);
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
 * Key schedule Test A
 */ 
function keyScheduleA($input) {
    $r = strrev($input);
    return array($r, binaryLeftShift($r));
}

/**
 * Key schedule Test B
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
 * Key schedule Test C
 */ 
function keyScheduleC($input) {
    $s = str_split($input, 8);
    return array($s[0], $s[1]);
}

/**
 * Test A
 */
/*$fA = function($text, $key, $index) {  
    $sum = bindec($text) + bindec($key);
    $mod = $sum % 16;
    return sprintf('%08b',  $mod);
};
$kA = ['11101011','10111110'];*/


/**
 * Test B
 */
/*$fB = function($text, $key, $index) {  
    return binaryXOR($text, $key);
};
$kB = ['10101001','01010011']; //10010101*/

?>