<?php
/**
 * Matrici di quantizzazione per la Luminanza (Y) e Crominanza (Q)
 */
$quantizationMatrixY = array(
    array(16,11,10,16,24,40,51,61),
    array(12,12,14,19,26,58,60,55),
    array(14,13,16,24,40,57,69,56),
    array(14,17,22,29,51,87,80,62),
    array(18,22,37,56,68,109,103,77),
    array(24,35,55,64,81,104,113,92),
    array(49,64,78,87,103,121,120,101),
    array(72,92,95,98,112,100,103,99),
);

$quantizationMatrixQ = array(
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
 * Pre-processa il testo rimuovendo gli spazi e convertendo tutti i caratteri in minuscolo.
 *
 * Questa funzione prende una stringa di testo, rimuove tutti gli spazi al suo interno e
 * converte tutti i caratteri in minuscolo. È utile per preparare il testo per ulteriori
 * elaborazioni, come analisi testuale o cifratura.
 *
 * @param string $text Il testo da pre-processare.
 * @return string Il testo pre-processato senza spazi e in minuscolo.
 */
function textPreProcess($text) {
    $text = str_replace(' ', '', $text);
    $text = strtolower($text);
    return $text;
}

/**
 * Converte una stringa di testo in un array binario.
 *
 * Questa funzione prende una stringa di testo e la converte in un array dove
 * ogni elemento rappresenta il valore binario di un carattere del testo. Ogni
 * valore binario è una stringa di 8 bit.
 *
 * @param string $text Il testo da convertire in binario.
 * @return array Un array di stringhe binarie, ciascuna rappresentante un carattere del testo.
 */
function textToBinary($text) {
    $chars = str_split($text);
    $binary = array();

    foreach ($chars as $char) {
        $data = unpack('H*', $char);
        $bin = base_convert($data[1], 16, 2);
        $bin = str_pad($bin, 8, 0, STR_PAD_LEFT);
        array_push($binary, $bin);
    }
 
    return $binary;
}

/**
 * Converte un array di numeri interi in un array binario.
 *
 * Questa funzione prende un array di numeri interi, li converte in valori binari
 * a 8 bit (considerando solo i valori assoluti degli interi) e restituisce un array
 * di stringhe binarie. Ogni stringa binaria è una rappresentazione a 8 bit dell'intero
 * corrispondente.
 *
 * @param array $array L'array di numeri interi da convertire in binario.
 * @return array Un array di stringhe binarie a 8 bit, ciascuna rappresentante un intero dell'array di input.
 */
function intToBinary($array) {
    $b = array();
    foreach($array as $element) {
        $bin = decbin(abs($element));
        $bin = str_pad($bin, 8, 0, STR_PAD_LEFT);
        array_push($b, $bin);
    }
    return $b;
}

/**
 * Stampa una matrice in formato HTML.
 *
 * Questa funzione prende una matrice bidimensionale e la stampa come una tabella HTML.
 * Ogni riga della matrice diventa una riga della tabella, e ogni elemento diventa una cella.
 * La tabella risultante avrà la classe CSS "matrix".
 *
 * @param array $matrix La matrice bidimensionale da stampare.
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
 * Calcola la Trasformata Discreta del Coseno (DCT) di una matrice 8x8.
 *
 * Questa funzione prende una matrice bidimensionale 8x8 come input e calcola la sua
 * Trasformata Discreta del Coseno (DCT). La trasformata viene calcolata utilizzando
 * la formula DCT-II e il risultato viene restituito come una nuova matrice 8x8.
 *
 * @param array $matrix La matrice bidimensionale 8x8 da trasformare.
 * @return array La matrice risultante dopo aver applicato la DCT.
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

/**
 * Applica la quantizzazione a una matrice DCT utilizzando una matrice di quantizzazione.
 *
 * Questa funzione prende una matrice risultante dalla Trasformata Discreta del Coseno (DCT)
 * e una matrice di quantizzazione come input. Per ogni elemento della matrice DCT, divide
 * l'elemento corrispondente per l'elemento della matrice di quantizzazione e arrotonda per difetto
 * il risultato. La matrice quantizzata risultante viene quindi restituita.
 *
 * @param array $dctMatrix La matrice DCT 8x8 da quantizzare.
 * @param array $quantizationMatrix La matrice di quantizzazione 8x8 da utilizzare per la quantizzazione.
 * @return array La matrice 8x8 dei coefficienti quantizzati.
 */
function quantization($dctMatrix, $quantizationMatrix) {
    $m = $n = 8;
    $quantizedCoefficents = array(
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
            $quantizedCoefficents[$i][$j] = floor($dctMatrix[$i][$j] / $quantizationMatrix[$i][$j]);
        }
    }

    return $quantizedCoefficents;
}

/**
 * Esegue la scansione zigzag di una matrice 8x8.
 *
 * Questa funzione prende una matrice 8x8 come input e restituisce un array lineare contenente
 * gli elementi della matrice disposti in ordine di scansione zigzag. La scansione zigzag
 * è una tecnica comune utilizzata nella compressione di immagini, come nel formato JPEG.
 *
 * @param array $matrix La matrice 8x8 da scansionare in ordine zigzag.
 * @return array Un array contenente gli elementi della matrice in ordine di scansione zigzag.
 */
function zigzagScan($matrix) {
    $m = $n = 8;
    $row = $col = 0;
    $row_inc = false;
    $min = min($m, $n);
    $max = max($m, $n) - 1;
    $a = array();

    for ($len = 1; $len <= $min; $len++) {
        for ($i = 0; $i < $len; $i++) {
            array_push($a, $matrix[$row][$col]);

            if ($i + 1 == $len) {
                break;
            }
                
            if ($row_inc) {
                $row++; 
                $col--;
            } else {
                $row--; 
                $col++;
            }
        }

        if ($len == $min) {
            break;
        }

        if ($row_inc) {
            ++$row; 
            $row_inc = false;
        } else {
            ++$col; 
            $row_inc = true;
        }
    }

    if ($row == 0) {
        if ($col == $m - 1) {
            ++$row;
        } else {
            ++$col;
        }
        $row_inc = 1;
    } else {
        if ($row == $n - 1) {
            ++$col;
        } else {
            ++$row;
        }
        $row_inc = 0;
    }

    for ($len, $diag = $max; $diag > 0; --$diag) {
        if ($diag > $min) {
            $len = $min;
        } else {
            $len = $diag;
        }

        for ($i = 0; $i < $len; ++$i) {
            array_push($a, $matrix[$row][$col]);

            if ($i + 1 == $len) {
                break;
            }

            if ($row_inc) {
                ++$row; 
                --$col;
            } else {
                ++$col; 
                --$row;
            }
        }

        if ($row == 0 || $col == $m - 1) {
            if ($col == $m - 1) {
                ++$row;
            } else {
                ++$col;
            }
            $row_inc = true;
        } else if ($col == 0 || $row == $n - 1) {
            if ($row == $n - 1) {
                ++$col;
            } else {
                ++$row;
            }
            $row_inc = false;
        }
    }

    return $a;
}

/**
 * Genera una sequenza di numeri pseudo-casuali utilizzando un generatore lineare congruenziale.
 *
 * Questa funzione implementa un generatore lineare congruenziale (LCG) per creare una sequenza di numeri
 * pseudo-casuali. La sequenza è determinata dai parametri forniti: modulo, moltiplicatore, incremento e seed.
 *
 * @param int $module Il modulo utilizzato per il generatore. Questo valore determina l'intervallo dei numeri generati.
 * @param int $multiplier Il moltiplicatore utilizzato nel calcolo della sequenza.
 * @param int $increment L'incremento aggiunto in ogni passo del calcolo della sequenza.
 * @param int $seed Il valore iniziale (seed) da cui parte la sequenza.
 * @param int $length La lunghezza della sequenza da generare.
 * @return array Un array contenente la sequenza di numeri pseudo-casuali generata.
 */
function linearCongruentialGenerator($module, $multiplier, $increment, $seed, $length) {
    $X = array_fill(0, $length, 0);
    for ($i = 0; $i < $length; $i++) {
        if ($i == 0) {
            $X[$i] = (($multiplier * $seed) + $increment) % $module;
        } else {
            $X[$i] = (($multiplier * $X[$i-1]) + $increment) % $module;
        }
    }
    return $X;
}

/**
 * Converte una sequenza di numeri generata da un generatore lineare congruenziale in una sequenza binaria.
 *
 * Questa funzione prende una sequenza di numeri generata da un generatore lineare congruenziale (LCG)
 * e converte ciascun numero in un valore binario (0 o 1) utilizzando il modulo 2.
 *
 * @param array $lcg Un array contenente la sequenza di numeri generata da un LCG.
 * @return array Un array contenente la sequenza di valori binari corrispondente.
 */
function binaryLCG($lcg) {
    $b = array();
    foreach($lcg as $element) {
        array_push($b, $element % 2);
    }
    return $b;
}

/**
 * Genera una sequenza di bit pseudo-casuali utilizzando l'algoritmo Blum Blum Shub.
 *
 * Questa funzione implementa il generatore di numeri pseudo-casuali Blum Blum Shub (BBS).
 * Il generatore richiede due numeri primi grandi `p` e `q`, un seme iniziale `seed` e 
 * la lunghezza della sequenza desiderata `length`.
 * La funzione restituisce una sequenza di bit binari pseudo-casuali.
 *
 * @param int $p Primo numero primo.
 * @param int $q Secondo numero primo.
 * @param int $seed Seme iniziale.
 * @param int $length Lunghezza della sequenza di bit da generare.
 * @return array Un array contenente la sequenza di bit binari pseudo-casuali generata.
 */
function blumBlumShubGenerator($p, $q, $seed, $length) {
    $n = $p * $q;
    $X = array_fill(0, $length, 0);
    $B = array();

    $X[0] = pow($seed, 2) % $n;

    for ($i = 1; $i < $length + 1; $i++) {
        $X[$i] = pow($X[$i-1], 2) % $n;
        array_push($B, $X[$i] % 2);
    }

    return $B;
}

/**
 * Modifica il bit meno significativo (LSB) di una stringa binaria.
 *
 * Questa funzione modifica il bit meno significativo (LSB) di una stringa binaria.
 * Se specificato, il secondo bit meno significativo (penultimo) può essere modificato.
 *
 * @param string $binary La stringa binaria di input.
 * @param int $bit1 Il nuovo valore per il bit meno significativo (LSB).
 * @param int|null $bit2 (Opzionale) Il nuovo valore per il secondo bit meno significativo (penultimo).
 * @return string La stringa binaria con il bit meno significativo modificato.
 */
function changeLSB($binary, $bit1, $bit2 = null) {
    $list = str_split($binary);
    $last = count($list) - 1;
    if ($bit2 != null) {
        $list[$last - 1] = $bit1;
        $list[$last] = $bit2;
    } else {
        $list[$last] = $bit1;
    }
    return implode('',$list);
}

/**
 * Disegna una tabella con le informazioni sui coefficienti DCT, la distribuzione pseudo-casuale,
 * il messaggio segreto, il cambio del LSB, il coefficiente watermark e la distribuzione del rumore.
 *
 * Questa funzione disegna una tabella HTML con le seguenti colonne:
 * - Indice: l'indice del coefficiente DCT nell'array.
 * - Coefficiente DCT: il valore del coefficiente DCT.
 * - Coefficiente DCT in binario: il valore del coefficiente DCT rappresentato in binario.
 * - Pseudo random distribution: la distribuzione pseudo-casuale (PRD) per il coefficiente.
 * - Bit messaggio segreto: il bit del messaggio segreto associato al coefficiente PRD.
 * - Cambiamento del LSB: il coefficiente DCT con il LSB modificato se il bit del messaggio segreto è 1.
 * - Coefficiente Watermarked: il coefficiente DCT con il LSB modificato convertito in decimale.
 * - Distribuzione rumore pseudo casuale: la differenza tra il coefficiente watermarked e il coefficiente DCT originale.
 *
 * @param array $vector L'array dei coefficienti DCT.
 * @param array $prd L'array della distribuzione pseudo-casuale (PRD).
 * @param string $message Il messaggio segreto rappresentato in binario.
 * @param int $bitToChange (Opzionale) Specifica se cambiare 1 o 2 bit nel LSB. Valore predefinito: 1.
 * @param int $lastIndex (Opzionale) L'indice dell'ultimo bit processato nel messaggio segreto. Valore predefinito: 0.
 * @return int L'indice dell'ultimo bit processato nel messaggio segreto.
 */
function drawTable($vector, $prd, $message, $bitToChange = 1, $lastIndex = 0) {
    $binaryDCT = intToBinary($vector);

    echo '<table>';
    echo '<tr>';
        echo '<th>Indice</th>';
        echo '<th>Coefficente DCT</th>';
        echo '<th>Coefficente DCT in binario</th>';
        echo '<th>Pseudo random distribution</th>';
        echo '<th>Bit messaggio segreto</th>';
        echo '<th>Cambiamento del LSB</th>';
        echo '<th>Coefficente Watermarked</th>';
        echo '<th>Distribuzione rumore pseudo casuale</th>';
    echo '</tr>';

    foreach($vector as $index => $coefficent) {
        if ($prd[$index] == 1) {
            echo '<tr class="highlight">';
        } else {
            echo '<tr>';
        }
            echo '<td>'.$index.'</td>';
            // Coefficente DCT
            echo '<td><code>'.$coefficent.'</code></td>';
            // Coefficente DCT in binario
            echo '<td><code>'.$binaryDCT[$index].'</code></td>';
            // Pseudo random distribution
            echo '<td><code>'.$prd[$index].'</code></td>';
            // Bit messaggio segreto
            echo '<td><code>';
                if ($prd[$index] == 1) {
                    if ($bitToChange == 2) {
                        $current = $message[$lastIndex];
                        $current2 = $message[$lastIndex + 1];
                        echo $current.$current2;
                        $lastIndex = $lastIndex + 2;
                    } else {
                        $current = $message[$lastIndex];
                        echo $current;
                        ++$lastIndex;
                    }
                } else {
                    echo '-';
                }
            echo '</code></td>';
            // Cambiamento del LSB
            echo '<td><code>';
                if ($prd[$index] == 1) {
                    if ($bitToChange == 2) {
                        $changed = changeLSB($binaryDCT[$index], $current, $current2);
                    } else {
                        $changed = changeLSB($binaryDCT[$index], $current);
                    }
                    if ($binaryDCT[$index] != $changed) {
                        if ($bitToChange == 2) {
                            $last_two = substr($changed, -2);
                            echo substr($changed, 0, -2).'<span class="digits">'.$last_two.'</span>';
                        } else {
                            $last_one = substr($changed, -1);
                            echo substr($changed, 0, -1).'<span class="digits">'.$last_one.'</span>';
                        }
                    } else {
                        echo $changed;
                    }
                } else {
                    echo '-';
                }
            echo '</code></td>';
            // Coefficente Watermarked
            echo '<td><code>';
                if ($prd[$index] == 1) {
                    if ($coefficent < 0 && $changed != 0) {
                        echo '-';
                    }
                    echo bindec($changed);
                } else {
                    echo '-';
                }
            echo'</code></td>';
            // Distribuzione rumore pseudo casuale
            echo '<td><code>';
                if ($prd[$index] == 1) {
                    echo bindec($changed) - abs($coefficent);
                } else {
                    echo '0';
                }
            echo '</code></td>';
        echo '</tr>';
    }
    echo '</table>';

    return $lastIndex;
}

/**
 * Appiattisce un array di byte in un array di singoli bit.
 *
 * Questa funzione prende un array di byte (rappresentati come stringhe di bit)
 * e restituisce un array di singoli bit.
 *
 * @param array $array L'array di byte da appiattire.
 * @return array L'array di singoli bit.
 */
function flattenBits($array) {
    $b = array();
    foreach($array as $bite) {
        $bits = str_split($bite);
        foreach($bits as $bit) {
            array_push($b, $bit);
        }
    }
    return $b;
}
?>