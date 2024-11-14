<?php
require_once "jwt.php";
require_once "config.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, URLS);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $API_KEY", 
    "Content-Type: application/json" 
]);
$response = curl_exec($ch);
if ($response === false) {
    $error = curl_error($ch);
    echo "Erro na requisição: $error";
} else {
    $responseData = json_decode($response, true);
    echo "<pre>";
    print_r($responseData);
}
curl_close($ch);
