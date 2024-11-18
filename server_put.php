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
        $in = json_decode(file_get_contents('php://input'), true);
        if (is_array($in) && isset($in['id'], $in['nome'], $in['email'], $in['senha'])) {
            $atualiza = [
                'id'    => $in['id'],
                'nome'  => $in['nome'],
                'email' => $in['email'],
                'senha' => password_hash($in['senha'], PASSWORD_DEFAULT)
            ];
            $update = $conexao->prepare("UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            if ($update->execute($atualiza)) {
                echo json_encode(['message' => 'Usuário atualizado com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Erro: Não foi possível atualizar']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados inválidos ou id não encontrado']);
        }
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido ou expirado']);
    }
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Cabeçalho de autorização ausente']);
}
