<?php
require 'vendor/autoload.php';
include_once "conexao.php";
require_once "config.php";

use Firebase\JWT\JWT;
if (isset($_SESSION['PHPSESSID'])) {
    session_start();
}
//Pegar dados do usuário logado
$userId = $_SESSION['id'] ?? 123;
$email = $_SESSION['email'] ?? 'email@email.com';
$nome = $_SESSION['nome'] ?? "Jhon Doe";
if ($userId) {
    $payload = [
        'iss' => 'http://localhost/rest/jwt.php',     // Emissor do token
        //'aud' => 'http://localhost/api/',     // Público (onde o token será usado)
        'iat' => time(),                // Emitido em
        'exp' => time() + 3600,         // Expira em 1 hora
        'data' => [
            'userId' => $userId,
            'nome'  => $nome,
            'email' => $email
        ]
    ];
    $API_KEY = JWT::encode($payload, CHAVE_SECRETA, 'HS256');
    //echo json_encode(['token' => $API_KEY]);
}