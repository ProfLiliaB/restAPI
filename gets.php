<?php
require_once "config.php";
require_once "jwt.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, URL_GET);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Jlc3Qvand0LnBocCIsImlhdCI6MTczMTk0NzE5MywiZXhwIjoxNzMxOTUwNzkzLCJkYXRhIjp7InVzZXJJZCI6MTIzLCJub21lIjoiSmhvbiBEb2UiLCJlbWFpbCI6ImVtYWlsQGVtYWlsLmNvbSJ9fQ.ifGodc9S8QXprWNRwEPxkrzxcsAAkxlcqSBvWx1Qy-I", 
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
