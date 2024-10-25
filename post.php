<?php
$url = 'http://localhost/classes/rest.php';

$data = [
    'nome'  => 'Pessoa 2',
    'email' => 'pessoa2@email.com',
    'senha' => '123'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
echo "<pre>";
print_r($data);