<?php
include_once "../config.php";
$usuarioLogado = [
    'id' => 123,
    'nome' => 'Jhon Doe'
];
$header = json_encode([
    'typ' => 'JWT',
    'alg' => 'HS256'
]);
$base64UrlHeader = base64UrlEncode($header);

$Corpo['userId'] = $usuarioLogado['id'];
$Corpo['name'] = $usuarioLogado['nome'];
$Corpo['exp'] = time() + 3600;
$base64UrlCorpo = base64UrlEncode(json_encode($Corpo));

$assinatura = hash_hmac('SHA256', $base64UrlHeader . "." . $base64UrlCorpo, CHAVE_SECRETA, true);
$base64UrlAssinatura = base64UrlEncode($assinatura);

$API_KEY = $base64UrlHeader . "." . $base64UrlCorpo . "." . $base64UrlAssinatura;
