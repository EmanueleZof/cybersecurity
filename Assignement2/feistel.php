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
    echo 'L0: '.$left.' R0: '.$right.'<br>';
    for ($i = 0; $i < $stages; ++$i) {
        $l = $left;
        $f = $function($right, $keys[$i]);
        $left = $right;
        $right = binaryXOR($l, $f);
        echo 'L'.($i+1).': '.$left.' R'.($i+1).': '.$right.'<br>';
    }
    echo 'R'.($i+1).': '.$right.' L'.($i+1).': '.$left.'<br>';
    return $right.$left;
}


/**
 * 
 */
$testFunc = function($text, $key) {  
    return $text;
};

/**
 * 
 */
function testKeySchedule($key) {  
    return ['00000000','11111111'];
};
?>