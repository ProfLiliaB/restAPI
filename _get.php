<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/loja/api/server.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c3VhcmlvIjoidGlsaXZlIiwic2VuaGEiOiIxMjM0In0=.ZTxJ5X5QJpiFhGlXtcmXySK7TFHZcYD9z3tj2UthuiE=",
    "Content-Type: application/json" 
]);
$response = curl_exec($ch);
$responseData = json_decode($response, true);
echo "<pre>";
print_r($responseData);

curl_close($ch);