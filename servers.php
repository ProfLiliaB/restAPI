<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require "config.php";
include_once "conexao.php";

$headers = getallheaders();
if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $assinatura = new Key(CHAVE_SECRETA, 'HS256');
    $usuario = JWT::decode($token, $assinatura);
    if ($usuario) {
        //inserir conteúdo do rest.php
        echo json_encode(['message' => 'Acesso autorizado', 'data' => $usuario->data]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido ou expirado']);
    }
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Cabeçalho de autorização ausente']);
}