<?php
$url = 'http://localhost/classes/rest.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die('Erro na requisição cURL: ' . $error);
}
curl_close($ch);
$data = json_decode($response, true);
echo "<pre>";
print_r($data);
?>