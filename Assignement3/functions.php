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
 * 
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
 * 
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
 * 
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

    /*$wavOut = fopen($outputWav, 'wb');
    fwrite($wavOut, $header);
    fwrite($wavOut, $packedData);
    fclose($wavOut);*/
}
?>