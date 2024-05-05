<?php
/**
 * @see https://www.php.net/manual/en/function.decbin.php
 */
function printBinary($binary) {
    return sprintf('%08b',  $binary);
}

/**
 * 
 */
function binaryXOR($input1, $input2) {
    return bindec($input1) ^ bindec($input2);
}

/**
 * 
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
 * 
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
 * 
 */
function keySchedule($key) {
    return str_split($key, 8);
}

/**
 * 
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
 * 
 */
function getDifference($input1, $input2) {
    $d = printBinary(binaryXOR($input1, $input2));
    $l = strlen($d);
    $n = substr_count($d, '1');
    $p = ($n / $l) * 100;
    return array($n, $p.'%');
}
?>