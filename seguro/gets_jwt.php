<?php
include_once "../config.php";

$headers = null;
// Verifica se o cabeçalho Authorization foi enviado
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
} elseif (isset($_SERVER['Authorization'])) {
    $headers = trim($_SERVER["Authorization"]);
} elseif (function_exists('apache_request_headers')) {
    $requestHeaders = apache_request_headers();
    if (isset($requestHeaders['Authorization'])) {
        $headers = trim($requestHeaders['Authorization']);
    }
}

$jwt = "";
$matche = preg_match('/Bearer\s(\S+)/', $headers, $matches);
if ($headers && $matche) {
    // Obtém o token do cabeçalho de autorização
    $jwt = $matche[1];
}

$corpo = "";
$parts = explode('.', $jwt);
if (count($parts) !== 3) {
    return null; // Token malformado
}
list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = $parts;
// Recria a assinatura e compara com a recebida
$codificada = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, CHAVE_SECRETA, true);
$signature = base64UrlEncode($codificada);

if ($signature !== $base64UrlSignature) {
    $jwt = null;
}

$corpo = json_decode(base64UrlDecode($base64UrlPayload), true);
if ($payload['exp'] < time()) {
    $corpo = null; // Token expirado
}

if ($jwt) {
    if ($corpo) {
        http_response_code(200);
        echo json_encode(['message' => 'Autorizado', 'data' => $corpo]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido ou expirado']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Cabeçalho de autorização não encontrado']);
}
