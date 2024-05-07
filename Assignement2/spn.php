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
function binaryLeftShift($input) {
    $stack = str_split($input);
    $shifted = array_shift($stack);
    array_push($stack, $shifted);
    return implode('', $stack);
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
function keyScheduleTest1($key, $tot) {
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

/**
 * 
 */
function drawPlaintextComparisonTable($plainText1, $plainText2, $key, $keyLabel, $iterations) {
    $roundKeys = keySchedule($key);

    echo '<p>Chiave utilizzata ('.$keyLabel.'): <code>'.$key.'</code> => K<sub>0</sub>: <code>'.$roundKeys[0].'</code> K<sub>1</sub>: <code>'.$roundKeys[1].'</code></p>';
    echo '<table>';
    echo '<tr><th>Round</th><th>Sotto chiave</th><th>Output</th><th>Differenza</th></tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><code>'.$roundKeys[0].'</code></td>';
    echo '<td><code>'.$plainText1.'</code><br><code>'.$plainText2.'</code></td>';
    list($differenceBits, $differencePercentage) = getDifference($plainText1, $plainText2);
    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
    echo '</tr>';

    $a = printBinary(binaryXOR($plainText1, $roundKeys[0]));
    $b = printBinary(binaryXOR($plainText2, $roundKeys[0]));
    for ($i = 1; $i < $iterations; ++$i) {
        $keySelector = $i % 2;
        $a = spBlock($a, $roundKeys[$keySelector]);
        $b = spBlock($b, $roundKeys[$keySelector]);
        list($differenceBits, $differencePercentage) = getDifference($a, $b);
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td><code>'.$roundKeys[$keySelector].'</code></td>';
        echo '<td><code>'.$a.'</code><br><code>'.$b.'</code></td>';
        echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
        echo '</tr>';
    }

    echo '</table>';
}

/**
 * 
 */
function drawKeysComparisonTable($plainText, $textLabel, $key1, $key2, $iterations) {
    $roundKeys1 = keySchedule($key1);
    $roundKeys2 = keySchedule($key2);

    echo '<p>Testo utilizzato ('.$textLabel.'): <code>'.$plainText.'</code></p>';
    echo '<table>';
    echo '<tr><th>Round</th><th>Sotto chiave</th><th>Output</th><th>Differenza</th></tr>';

    echo '<tr>';
    echo '<td></td>';
    echo '<td><code>'.$roundKeys1[0].'</code><br><code>'.$roundKeys2[0].'</code></td>';
    echo '<td><code>'.$plainText.'</code><br><code>'.$plainText.'</code></td>';
    list($differenceBits, $differencePercentage) = getDifference($plainText, $plainText);
    echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
    echo '</tr>';

    $a = printBinary(binaryXOR($plainText, $roundKeys1[0]));
    $b = printBinary(binaryXOR($plainText, $roundKeys2[0]));
    for ($i = 1; $i < $iterations; ++$i) {
        $keySelector = $i % 2;
        $a = spBlock($a, $roundKeys1[$keySelector]);
        $b = spBlock($b, $roundKeys2[$keySelector]);
        list($differenceBits, $differencePercentage) = getDifference($a, $b);
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td><code>'.$roundKeys1[$keySelector].'</code><br><code>'.$roundKeys2[$keySelector].'</code></td>';
        echo '<td><code>'.$a.'</code><br><code>'.$b.'</code></td>';
        echo '<td>'.$differenceBits.'bit ('.$differencePercentage.')</td>';
        echo '</tr>';
    }

    echo '</table>';
}
?>