<?php
/**
 * Frequenza delle lettere dell'alfabeto Italiano
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
 * Frequenza delle lettere dell'alfabeto Inglese
 */
$englishFrequency = array(
    "A"=>8.12,
    "B"=>1.49,
    "C"=>2.71,
    "D"=>4.32,
    "E"=>12.02,
    "F"=>2.30,
    "G"=>2.03,
    "H"=>5.92,
    "I"=>7.31,
    "J"=>0.10,
    "K"=>0.69,
    "L"=>3.98,
    "M"=>2.61,
    "N"=>6.95,
    "O"=>7.68,
    "P"=>1.82,
    "Q"=>0.11,
    "R"=>6.02,
    "S"=>6.28,
    "T"=>9.10,
    "U"=>2.88,
    "V"=>1.11,
    "W"=>2.09,
    "X"=>0.17,
    "Y"=>2.11,
    "Z"=>0.07
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
 * Costante di probabilità che due variabili casuali scelte a caso da una sorgente che emette lettere dell'alfabeto Italiano
 */
$kpItaliano = 0.075;

/**
 * Costante di probabilità di coincidenza per una selezione casuale con distribuzione uniforme per l'alfabeto Italiano
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
 * Trova i pattern di lunghezza specificata all'interno del testo e restituisce un array associativo
 * contenente i pattern che compaiono più di una volta nel testo e il loro conteggio di occorrenze.
 *
 * @param string $text Il testo in cui cercare i pattern.
 * @param int $length La lunghezza dei pattern da cercare.
 * @return array Un array associativo contenente i pattern che compaiono più di una volta nel testo
 *               e il loro conteggio di occorrenze.
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
 * Calcola le distanze tra le occorrenze di un determinato pattern all'interno di un testo.
 *
 * @param string $text Il testo in cui cercare il pattern.
 * @param string $pattern Il pattern da cercare all'interno del testo.
 * @return array Un array contenente le distanze tra le occorrenze del pattern nel testo.
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
 * Trova i fattori primi di un numero intero positivo e restituisce una stringa contenente
 * i fattori primi separati da spazi.
 *
 * @param int $n Il numero intero positivo di cui trovare i fattori primi.
 * @return string Una stringa contenente i fattori primi separati da spazi.
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

/**
 * Calcola l'indice di coincidenza per un insieme di frequenze di caratteri.
 *
 * @param int $c Il numero di caratteri distinti.
 * @param int $n La lunghezza del testo.
 * @param array $frequencies Un array associativo contenente le frequenze dei caratteri.
 * @return float Il valore dell'indice di coincidenza calcolato.
 */
function indexOfCoincidence($c, $n, $frequencies) {
    $numerator = 0;
    $denominator = $n * ($n - 1);
    $keys = array_keys($frequencies);

    for ($i= 0; $i < $c; $i++) {
        $m = $frequencies[$keys[$i]]['count'] * ($frequencies[$keys[$i]]['count'] - 1);
        $numerator += $m;
    }

    return round(($numerator / $denominator), 5);
}

/**
 * Stima la lunghezza della chiave utilizzando il metodo di Friedman.
 *
 * @param float $kp Il valore calcolato per Kp (indice di coincidenza atteso).
 * @param float $kr Il valore calcolato per Kr (indice di coincidenza reale).
 * @param float $k0 Il valore iniziale della lunghezza della chiave.
 * @return float La stima della lunghezza della chiave.
 */
function keyLenghtEstimate($kp, $kr, $k0) {
    $numerator = $kp - $kr;
    $denominator = $k0 - $kr;
    return round($numerator / $denominator, 5);
}

/**
 * Genera una matrice di caratteri suddivisi in colonne di lunghezza specificata.
 *
 * @param string $text Il testo da trasformare in una matrice.
 * @param int $length La lunghezza desiderata delle colonne.
 * @return array Una matrice di caratteri, con ciascuna colonna contenente un numero massimo di caratteri pari a $length.
 */
function getTextMatrix($text, $length) {
    $columns = str_split($text, $length);
    $matrix = array();
    foreach($columns as $column) {
        $letters = str_split($column);
        array_push($matrix, $letters);
    }
    return $matrix;
}

/**
 * Suddivide una matrice di testo in coseti di lunghezza specificata.
 *
 * @param array $textMatrix La matrice di testo da suddividere.
 * @param int $cosetLength La lunghezza dei coseti desiderata.
 * @return array Un array di coseti, ognuno contenente una serie di caratteri estratti dalla matrice di testo.
 */
function splitCosets($textMatrix, $cosetLength) {
    $cosets = array();

    for ($i = 0; $i < $cosetLength; ++$i) {
        $coset = array();
        foreach($textMatrix as $row) {
            if (array_key_exists($i, $row)) {
                array_push($coset, $row[$i]);
            }
        }
        array_push($cosets, $coset);
    }

    return $cosets;
}

/**
 * Calcola la media dei valori in un array.
 *
 * @param array $values Un array di valori numerici.
 * @return float La media dei valori nell'array, arrotondata a 5 cifre decimali.
 */
function average($values) {
    return round(array_sum($values) / count($values), 5);
}

/**
 * Ruota una stringa di un numero specificato di posizioni nell'alfabeto.
 *
 * @param string $s La stringa da ruotare.
 * @param int $n Il numero di posizioni di rotazione nell'alfabeto. Il valore predefinito è 13.
 * @return string La stringa ruotata di $n posizioni nell'alfabeto.
 * @see https://www.php.net/manual/en/function.str-rot13.php
 */
function str_rot($s, $n = 13) {
    static $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $n = (int)$n % 26;
    if (!$n) return $s;
    if ($n == 13) return str_rot13($s);
    for ($i = 0, $l = strlen($s); $i < $l; $i++) {
        $c = $s[$i];
        if ($c >= 'a' && $c <= 'z') {
            $s[$i] = $letters[(ord($c) - 71 + $n) % 26];
        } else if ($c >= 'A' && $c <= 'Z') {
            $s[$i] = $letters[(ord($c) - 39 + $n) % 26 + 26];
        }
    }
    return $s;
}
?>