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

    for ($i = 1; $i < strlen($binaryString) + 1; $i++) {
        $binarySample = decbin($samples[$i]);
        $digits = str_split($binarySample);
        $lastDigit = count($digits) - 1;
        $digits[$lastDigit] = $binaryString[$i - 1];
        $samples[$i] = bindec(implode('', $digits));
    }

    $packedData = pack('s*', ...$samples);

    /*$wavOut = fopen($outputWav, 'wb');
    fwrite($wavOut, $header);
    fwrite($wavOut, $packedData);
    fclose($wavOut);*/
}
?>