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
        $input = json_decode(file_get_contents('php://input'), true);
        if (is_array($input) && isset($input['id'])) {
            $delete = $conexao->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            if ($delete->execute([$input['id']])) {
                echo json_encode(['message' => 'Excluído com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Erro: Não foi possível Excluir']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Id não encontrado']);
        }
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido ou expirado']);
    }
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Cabeçalho de autorização ausente']);
}
