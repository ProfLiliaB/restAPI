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
        $input = json_decode(file_get_contents('php://input'), true);
        if (is_array($input) && isset($input['nome'], $input['email'], $input['senha'])) {
            $novo = [
                'nome'  => $input['nome'],
                'email' => $input['email'],
                'senha' => password_hash($input['senha'], PASSWORD_DEFAULT)
            ];
            $insert = $conexao->prepare("INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)");
            if ($insert->execute($novo)) {
                echo json_encode(['message' => 'Usuário inserido com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Erro: não foi possível inserir']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados inválidos']);
        }
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido ou expirado']);
    }
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Cabeçalho de autorização ausente']);
}
