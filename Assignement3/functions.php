<?php
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
 * Calcola il numero di bit disponibili per l'inserimento di dati in un file audio.
 * 
 * Questa funzione calcola il numero di byte disponibili per l'inserimento di dati 
 * nascosti in un file audio, utilizzando la tecnica di steganografia LSB (Least Significant Bit).
 * 
 * @param int $seconds Durata dell'audio in secondi.
 * @param int $samplingFrequency Frequenza di campionamento dell'audio (in Hz).
 * @param int $channels Numero di canali audio (ad esempio, 1 per mono, 2 per stereo).
 * @param int $resolution Risoluzione dell'audio (in bit per campione, ad esempio 16).
 * 
 * @return int Numero di bit disponibili per l'inserimento di dati nascosti.
 */
function availableBits($seconds, $samplingFrequency, $channels, $resolution) {
    $totBits = $seconds * $samplingFrequency * $channels * $resolution;
    $usableBits = $totBits / ($resolution * $channels);
    $availableBits = $usableBits / 8;
    return round($availableBits);
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
function changeLSB($binary, $bitZ, $bitY = null) {
    $list = str_split($binary);
    $lastPosition = count($list) - 1;
    if ($bitY != null) {
        $list[$lastPosition - 1] = $bitY;
    }
    $list[$lastPosition] = $bitZ;
    return implode('',$list);
}

/**
 * Converte una stringa binaria in un numero decimale con segno.
 * 
 * Questa funzione prende una stringa binaria e la converte in un numero decimale con segno. 
 * Se la stringa binaria rappresenta un numero negativo (cioè, se è lunga 64 bit e il primo bit è 1), 
 * viene eseguita la conversione in complemento a due per ottenere il valore decimale negativo.
 * 
 * @param string $bin La stringa binaria da convertire.
 * 
 * @return int Il numero decimale con segno risultante dalla conversione della stringa binaria.
 */
function bindecSigned($bin) {
    if (strlen($bin) == 64 && $bin[0] == '1') {
        for ($i = 0; $i < 64; $i++) {
            $bin[$i] = $bin[$i] == '1' ? '0' : '1';
        }
        return (bindec($bin) + 1) * -1;
    }
    return bindec($bin);
}

/**
 * Nasconde un messaggio binario in un file audio WAV.
 * 
 * Questa funzione nasconde un messaggio binario all'interno di un file audio WAV 
 * modificando il bit meno significativo (LSB) dei campioni audio. 
 * Aggiunge una sequenza di terminazione '1111111111111110' alla fine del messaggio 
 * per segnalare la fine del messaggio nascosto.
 * Disegna una tabella in cui vengono riportati i dati di tutti i passaggi delle modifiche
 * del LSB.
 * 
 * @param string $inputWav Il percorso del file WAV di input.
 * @param string $outputWav Il percorso del file WAV di output dove verrà salvato l'audio con il messaggio nascosto.
 * @param array $binaryMessage Un array di stringhe binarie che rappresentano il messaggio da nascondere.
 * 
 * @return void
 */
function hideMessageInAudio($inputWav, $outputWav, $binaryMessage) {
    array_push($binaryMessage, '1111111111111110');
    $binaryString = implode('', $binaryMessage);

    $wav = fopen($inputWav, 'rb');
    $header = fread($wav, 44);
    $data = fread($wav, filesize($inputWav) - 44);
    fclose($wav);

    $samples = unpack('s*', $data);

    echo '<table>';
    echo '<tr>';
        echo '<th>Campione</th>';
        echo '<th>Campione in binario</th>';
        echo '<th>Bit da cambiare</th>';
        echo '<th>Campione cambiato in binario</th>';
        echo '<th>Campione cambiato</th>';
    echo '</tr>';

    for ($i = 0; $i < strlen($binaryString); $i++) {
        echo '<tr>';
        echo '<td>'.$samples[$i + 1].'</td>';

        $sampleToBinary = decbin($samples[$i + 1]);

        echo '<td>'.$sampleToBinary.'</td>';
        echo '<td>'.$binaryString[$i].'</td>';

        $sampleToBinary = changeLSB($sampleToBinary, $binaryString[$i]);
        
        echo '<td>'.$sampleToBinary.'</td>';

        $binaryToSample = bindecSigned($sampleToBinary);

        echo '<td>'.$binaryToSample.'</td>';
        echo '</tr>';
    }

    echo '</table>';

    $packedData = pack('s*', ...$samples);

    $wavOut = fopen($outputWav, 'wb');
    fwrite($wavOut, $header);
    fwrite($wavOut, $packedData);
    fclose($wavOut);
}

/**
 */
function intToBinary($int) {
    $b = decbin($int);
    $b = str_pad($b, 8, 0, STR_PAD_LEFT);
    return $b;
}

/**
 * 
 */
function getPalette($inputGif) {
    $c = array();
    $image = imagecreatefromgif($inputGif);
    if ($image) {
        $colors = imagecolorstotal($image);
        for ($i = 0; $i < $colors; $i++) {
            $color = imagecolorsforindex($image, $i);
            array_push($c, array($color['red'], $color['green'], $color['blue']));
        }
    }
    imagedestroy($image);
    return $c;
}

/**
 * 
 */
function drawPaletteTable($palette) {
    echo '<table>';
    echo '<tr>';
        echo '<th>Indice</th>';
        echo '<th>Rosso</th>';
        echo '<th>Verde</th>';
        echo '<th>Blu</th>';
        echo '<th>Colore</th>';
    echo '</tr>';
    foreach($palette as $index => $color) {
        $r = $palette[$index][0];
        $g = $palette[$index][1];
        $b = $palette[$index][2];
        echo '<tr>';
            echo '<td>'.$index.'</td>';
            echo '<td>'.$r.'</td>';
            echo '<td>'.$g.'</td>';
            echo '<td>'.$b.'</td>';
            echo '<td style="background-color: rgb('.$r.','.$g.','.$b.');"></td>';
        echo '</tr>';
    }
    echo '</table>';
}

/**
 * 
 */
function drawComparisonTable($palette, $messageBits) {
    $messageList = implode('', $messageBits);
    $r_count = 0;
    $g_count = 0;
    $b_count = 0;

    echo '<table>';
    echo '<tr>';
        echo '<th>Indice</th>';
        echo '<th>Rosso</th>';
        echo '<th>Verde</th>';
        echo '<th>Blu</th>';
        echo '<th>Bit messaggio segreto</th>';
    echo '</tr>';

    foreach($palette as $index => $color) {
        $r = intToBinary($palette[$index][0]);
        $g = intToBinary($palette[$index][1]);
        $b = intToBinary($palette[$index][2]);
        $r_array = str_split($r);
        $g_array = str_split($g);
        $b_array = str_split($b);
        echo '<tr>';
            echo '<td>'.$index.'</td>';
            if ($index < strlen($messageList) && $r_array[7] == $messageList[$index]) {
                echo '<td class="highlight">'.$r.'</td>';
                ++$r_count;
            } else {
                echo '<td>'.$r.'</td>';
            }
            if ($index < strlen($messageList) && $g_array[7] == $messageList[$index]) {
                echo '<td class="highlight">'.$g.'</td>';
                ++$g_count;
            } else {
                echo '<td>'.$g.'</td>';
            }
            if ($index < strlen($messageList) && $b_array[7] == $messageList[$index]) {
                echo '<td class="highlight">'.$b.'</td>';
                ++$b_count;
            } else {
                echo '<td>'.$b.'</td>';
            }
            if ($index < strlen($messageList)) {
                echo '<td>'.$messageList[$index].'</td>';
            } else {
                echo '<td> - </td>';
            }
        echo '</tr>';
    }

    echo '<tr>';
        echo '<td><b>Tot</b></td>';
        echo '<td>'.$r_count.'</td>';
        echo '<td>'.$g_count.'</td>';
        echo '<td>'.$b_count.'</td>';
        echo '<td> - </td>';
    echo '</tr>';

    echo '</table>';
}

/**
 * 
 */
function hideMessageInGifPalette($palette, $inputGif, $outputGif, $binaryMessage) {
    array_push($binaryMessage, '1111111111111110');
    $binaryString = implode('', $binaryMessage);

    echo '<table>';
    echo '<tr>';
        echo '<th>Campione</th>';
        echo '<th>Campione in binario</th>';
        echo '<th>Bit da cambiare</th>';
        echo '<th>Campione cambiato in binario</th>';
        echo '<th>Campione cambiato</th>';
    echo '</tr>';

    $image = imagecreatefromgif($inputGif);

    foreach($palette as $index => $color) {
        if ($index < strlen($binaryString)) {
            $r = $palette[$index][0];
            $g = $palette[$index][1];
            $b = $palette[$index][2];
            $r_binary = intToBinary($r);
            $r_changed = changeLSB($r_binary, $binaryString[$index]);
            $r_watermarked = bindecSigned($r_changed);

            echo '<tr>';
            echo '<td>'.$r.'</td>';
            echo '<td>'.$r_binary.'</td>';
            echo '<td>'.$binaryString[$index].'</td>';
            echo '<td>'.$r_changed.'</td>';
            echo '<td>'.$r_watermarked.'</td>';
            echo '</tr>';

            imagecolorset($image, $index, $r_watermarked, $g, $b);
        }
    }
    echo '</table>';

    imagegif($image, $outputGif);
    imagedestroy($image);
}

?>