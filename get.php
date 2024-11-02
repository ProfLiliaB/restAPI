<?php
include_once "config.php";

$ch = curl_init(URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$codigoResposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    echo "<h3>Código HTTP: $codigoResposta</h3>";
    echo "<pre>";
    print_r(json_decode($response, true));
}
curl_close($ch);