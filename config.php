<?php
define("URL", "http://localhost/PROJETOS_24/rest/rest.php");
define("CHAVE_SECRETA", 'S3C43T*$CH@V3');

// Função para codificar em Base64 URL-safe
function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
// Função para decodificar Base64 URL-safe
function base64UrlDecode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}