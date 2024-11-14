<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

include_once "config.php";
include_once "conexao.php";

$headers = getallheaders();
if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $assinatura = new Key(CHAVE_SECRETA, 'HS256');
    $usuario = JWT::decode($token, $assinatura);
    if ($usuario) {
        //echo json_encode(['message' => 'Acesso autorizado', 'data' => $usuario->data]);
        try {
            $select = $conexao->prepare("SELECT * FROM usuario");
            $select->execute();
            $data = $select->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido ou expirado']);
    }
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Cabeçalho de autorização ausente']);
}