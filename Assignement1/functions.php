<?php
/**
 * frequenza delle lettere dell'alfabeto Italiano
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

/**
 * Doppie più frequenti della lingua Italiana
 */
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
$kpItaliano = 0.075;

/**
 * 
 */
$krItaliano = 0.0385;

/**
 * Esegue il preprocessing del testo, rimuovendo caratteri specifici.
 *
 * @param string $text Il testo da elaborare.
 * @return string Il testo elaborato con i caratteri specifici rimossi.
 */
function preProcessing($text) {
    $toRemove = array(".", ",", ";", " ", "'");
    return strtoupper(str_replace($toRemove, '', $text));
}

/**
 * Analizza la frequenza delle lettere all'interno del testo e restituisce un array
 * associativo contenente il conteggio e la percentuale di occorrenza di ciascuna lettera.
 *
 * @param string $text Il testo da analizzare.
 * @return array Un array associativo che contiene il conteggio e la percentuale di occorrenza
 *              di ciascuna lettera dell'alfabeto inglese.
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
    return $frequency;
}

/**
 * Esegue l'evidenziazione del testo, evidenziando coppie di caratteri consecutivi identici
 * con un colore arancione.
 *
 * @param string $text Il testo da evidenziare.
 * @return array Un array associativo contenente le coppie di caratteri identiche e il loro conteggio.
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
 * Decodifica il testo sostituendo ogni carattere dell'alfabeto con il rispettivo valore
 * all'interno di tag <span>.
 *
 * @param string $text Il testo da decodificare.
 * @param array $alphabet Un array associativo che mappa i caratteri dell'alfabeto ai loro valori.
 * @return string Il testo decodificato con i caratteri dell'alfabeto sostituiti.
 */
function decode($text, $alphabet) {
    foreach ($alphabet as $key => $value) {
        $text = str_replace($key, '<span>'.$value.'</span>', $text);
    }
    return $text;
}

/**
 * 
 */
function findPattern($text, $length) {
    $letters = str_split($text);
    $textLength = count($letters);
    $counter = array();

    for ($i = 0; $i < $textLength - ($length - 1); ++$i) {
        $pattern = $letters[$i];
        for ($j = 1; $j < $length; ++$j) {
            $pattern = $pattern.$letters[$i + $j];
        }
        preg_match_all('/'.$pattern.'/', $text, $matches);
        $tot = count($matches[0]);
        if ($tot > 1) {
            $counter[$pattern] = $tot;
        }
    }

    return $counter;
}

/**
 * 
 */
function patternDistance($text, $pattern) {
    preg_match_all('/'.$pattern.'/', $text, $matches, PREG_OFFSET_CAPTURE);
    $matchesLength = count($matches[0]) - 1;
    $distances = array();

    for ($i = 0; $i < $matchesLength; ++$i)  {
        $distance = $matches[0][$i + 1][1] - $matches[0][$i][1];
        array_push($distances, $distance);
    }

    return $distances;
}

/**
 * @see https://www.geeksforgeeks.org/print-all-prime-factors-of-a-given-number/
 */
function primeFactors($n) {
    $factors = '';

    while($n % 2 == 0) {
        $factors = $factors.'2'.' ';
        $n = $n / 2;
    }

    for ($i = 3; $i <= sqrt($n); $i = $i + 2) {
        while ($n % $i == 0) {
            $factors = $factors.$i.' ';
            $n = $n / $i;
        }
    }

    if ($n > 2) {
        $factors = $factors.$n.' ';
    }

    return $factors;
}

function indexOfCoincidence($c, $n, $frequencies) {
    $numerator = 0;
    $denominator = $n*($n - 1);

    foreach($frequencies as $letter => $value) {
        $m = $value['count'] * ($value['count'] - 1);
        $numerator = $numerator + $m;
    }

    return round(($numerator / $denominator), 3);
}
?>