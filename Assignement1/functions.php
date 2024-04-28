<?php

/**
 * 
 */
$italianFrequency = array(
    "A"=>11.74,
    "B"=>0.92,
    "C"=>4.50,
    "D"=>3.73,
    "E"=>11.79,
    "F"=>0.95,
    "G"=>1.64,
    "H"=>1.54,
    "I"=>11.28,
    "J"=>0,
    "K"=>0,
    "L"=>6.51,
    "M"=>2.51,
    "N"=>6.88,
    "O"=>9.83,
    "P"=>3.05,
    "Q"=>0.51,
    "R"=>6.37,
    "S"=>4.98,
    "T"=>5.62,
    "U"=>3.01,
    "V"=>2.10,
    "W"=>0,
    "X"=>0,
    "Y"=>0,
    "Z"=>0.49
);

$italianDoppieFrequency = array(
    "LL"=>0.86,
    "TT"=>0.73,
    "SS"=>0.64,
    "CC"=>0.38,
    "AA"=>0.3,
    "EE"=>0.3,
    "BB"=>0.19,
    "RR"=>0.18,
    "NN"=>0.18
);

/**
 * 
 */
function preProcessing($text) {
    $toRemove = array(".", ",", ";", " ", "'");
    return strtoupper(str_replace($toRemove, '', $text));
}

/**
 * 
 */
function frequencyAnalysis($text) {
    $frequency = array_fill_keys(range('A', 'Z'), array('count' => 0, 'percent' => 0));
    $string = str_split($text);
    $length = strlen($text);
    foreach ($string as $letter) {
        $frequency[$letter]['count'] = $frequency[$letter]['count'] + 1;
    }
    foreach($frequency as $key => $value) {
        $frequency[$key]['percent'] = ($value['count']*26)/100;
    }
    //arsort($frequency);
    return $frequency;
}

/**
 * 
 */
function hihglighter($text) {
    $letters = str_split($text);
    $length = count($letters);
    $counter = array();

    for ($i = 0; $i < $length; ++$i) {
        if (($i+1) < $length) {
            if ($letters[$i] == $letters[$i + 1]) {
                echo '<span class="highlight-orange">'.$letters[$i].'</span>';
                echo '<span class="highlight-orange">'.$letters[$i+1].'</span>';
                $i++;
                $name = strval($letters[$i]).strval($letters[$i]);
                if (array_key_exists($name, $counter)) {
                    $counter[$name] = $counter[$name] + 1;
                } else {
                    $counter[$name] = 1;
                }
            } else {
                echo '<span>'.$letters[$i].'</span>';
            }
        } else {
            echo '<span>'.$letters[$i].'</span>';
        }
    }

    return $counter;
}

/**
 * 
 */
function decode($text, $alphabet) {
    foreach ($alphabet as $key => $value) {
        $text = str_replace($key, '<span>'.$value.'</span>', $text);
    }
    return $text;
}
?>