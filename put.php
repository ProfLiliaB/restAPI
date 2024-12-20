<?php
include_once "config.php";

$data = [
    'id'    => 7,
    'nome'  => 'Nome Atualizado',
    'email' => 'email@atualizado.com',
    'senha' => '321'
];
$ch = curl_init(URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
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