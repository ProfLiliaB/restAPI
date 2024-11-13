<?php
require 'vendor/autoload.php';
include_once "conexao.php";
use Firebase\JWT\JWT;
//Pegar dados do usuário logado
$userId = 123; // ID do usuário
$secretKey = 'S3NH@53C43T@';
$payload = [
    'iss' => 'http://localhost/api/jwt.php',     // Emissor do token
    //'aud' => 'http://localhost/api/',     // Público (onde o token será usado)
    'iat' => time(),                // Emitido em
    'exp' => time() + 3600,         // Expira em 1 hora
    'data' => [
        'userId'=> $userId,
        'nome'  => 'Jhon Doe'
    ]
];
$API_KEY = JWT::encode($payload, $secretKey, 'HS256');
//echo json_encode(['token' => $API_KEY]);