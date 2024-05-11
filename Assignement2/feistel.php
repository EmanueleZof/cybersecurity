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
 * Test A
 */
$fA = function($text, $key) {  
    $sum = bindec($text) + bindec($key);
    $mod = $sum % 16;
    return sprintf('%08b',  $mod);
};
$kA = ['11101011','10111110'];
//$k1 = ['11111111','00000000'];

?>