<?php
/**
 * Genera una stringa casuale di una lunghezza specificata.
 *
 * @param int $length La lunghezza della stringa casuale da generare. Default è 10.
 * @return string La stringa casuale generata.
 */
function generateRandomString($length = 10) {
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[random_int(0, $charactersLength - 1)];
   }
   return $randomString;
}

/**
 * Valida un payload Altcha confrontando la sfida e la firma HMAC.
 *
 * @param string $payload Il payload codificato in base64 contenente i dati della sfida.
 * @param string $hmacKey La chiave HMAC utilizzata per generare la firma.
 * @return bool Ritorna true se la validazione ha successo, altrimenti false.
 */
function altchaValidation($payload, $hmacKey) {
   $data = json_decode(base64_decode($payload), true);
   $challenge = hash('sha256', $data['salt'].$data['number']);
   $signature = hash_hmac('sha256', $challenge, $hmacKey);

   if ($data['algorithm'] == 'SHA-256') {
      if($data['challenge'] == $challenge) {
         if ($data['signature'] == $signature) {
            return true;
         }
      }
   }
   return false;
}
?>