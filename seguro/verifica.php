<?php
$jwt = ''; // o token recebido
$chaveSecreta = 'S3C43T*$CH@V3';

// Divide o token em suas partes com a função explode()
$parts = explode('.', $jwt);
if (count($parts) !== 3) {
    return null; // Token malformado
}
list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = $parts;
// Recria a assinatura e verifica se corresponde à recebida
$signature = base64UrlEncode(hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $chaveSecreta, true));
if ($signature !== $base64UrlSignature) {
    return null; // Assinatura inválida
}

// Decodifica o payload e verifica a expiração
$corpo = json_decode(base64UrlDecode($base64UrlPayload), true);
if ($corpo['exp'] < time()) {
    return null; // Token expirado
}
//Verifica se o token é válido
if ($corpo) {
    echo "Token válido. Dados do usuário: " . json_encode($corpo);
} else {
    echo "Token inválido ou expirado.";
}

// Função para decodificar Base64 URL Segura
function base64UrlDecode($data) {
    $subStr = strtr($data, '-_', '+/');
    return base64_decode($subStr);
}
function base64UrlEncode($data) {
    $base64 = base64_encode($data);
    $subsStr = strtr($base64, '+/', '-_');
    return rtrim($subsStr, '=');
}