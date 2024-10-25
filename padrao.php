<!-- GET -->
<?php
$url = 'rest.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
print_r($data);
?>
<!-- POST -->
<?php
$url = 'http://localhost/rest/rest.php';

$data = [
    'name' => 'Novo Pessoa',
    'email' => 'email@email.com'
];
//inicializa uma sessão
$ch = curl_init($url);
//Define uma opção para uma transferência cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Define o método da requisição
curl_setopt($ch, CURLOPT_POST, true);
//define o corpo (body) da requisição (conteúdo a ser trasnferido)
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//define o cabeçalho, nesse caso será uma aplicação json
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
//Executa uma sessão cURL
$response = curl_exec($ch);
//fecha uma sessão
curl_close($ch);

$data = json_decode($response, true);
print_r($data);
?>
<!-- PUT -->
<?php
$url = 'rest.php';

$data = [
    'id' => 1,
    'nome' => 'Nome Atualizado',
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data);
?>
<!-- DELETE -->
<?php
$url = 'rest.php';

$data = [
    'id' => 1 
];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data);
?>
<!-- PUT AUTENTICAÇÃO -->
<?php
$url = 'http://localhost/rest/rest.php';

$data = [
    'id' => 1,
    'nome' => 'Nome Atualizado',
    'email' => ''
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode('username:password')
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data);
?>
<!-- Token Bearer -->
<?php
$url = 'rest.php'; 

$data = [
    'id' => 1,
    'name' => 'Nome Atualizado',
    'age' => 30
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer SEU_TOKEN_AQUI' 
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data);
?>