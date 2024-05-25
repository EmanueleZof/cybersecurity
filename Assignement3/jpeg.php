<?php
/**
 * 
 */
$quantizationY = array(
    array(16,11,10,16,24,40,51,61),
    array(12,12,14,19,26,58,60,55),
    array(14,13,16,24,40,57,69,56),
    array(14,17,22,29,51,87,80,62),
    array(18,22,37,56,68,109,103,77),
    array(24,35,55,64,81,104,113,92),
    array(49,64,78,87,103,121,120,101),
    array(72,92,95,98,112,100,103,99),
);

$quantizationQ = array(
    array(17,18,24,47,99,99,99,99),
    array(18,21,26,66,99,99,99,99),
    array(24,26,56,99,99,99,99,99),
    array(47,66,99,99,99,99,99,99),
    array(99,99,99,99,99,99,99,99),
    array(99,99,99,99,99,99,99,99),
    array(99,99,99,99,99,99,99,99),
    array(99,99,99,99,99,99,99,99),
);

/**
 * 
 */
function printMatrix($matrix) {
    echo '<table class="matrix">';
    foreach ($matrix as $row) {
        echo '<tr>';
        foreach ($row as $col) {
            echo '<td>'.strval($col).'</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

/**
 * 
 */
function dctTransform($matrix) {
    $m = $n = 8;
    $dct = array(
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
    );

    for ($i = 0; $i < $m; $i++) {
        for ($j = 0; $j < $n; $j++) {

            if ($i == 0) {
                $ci = 1 / sqrt($m);
            } else {
                $ci = sqrt(2) / sqrt($m);
            }

            if ($j == 0) {
                $cj = 1 / sqrt($n);
            } else {
                $cj = sqrt(2) / sqrt($n);
            }

            $sum = 0;

            for ($k = 0; $k < $m; $k++) {
                for ($l = 0; $l < $n; $l++) {
                    $dct1 = $matrix[$k][$l] * cos((2 * $k + 1) * $i * pi() / (2 * $m)) * cos((2 * $l + 1) * $j * pi() / (2 * $n));
                    $sum = $sum + $dct1;
                }
            }

            $dct[$i][$j] = round($ci * $cj * $sum);
        }
    }

    return $dct;
}

?>