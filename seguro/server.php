<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once "../conexao.php";

$tokenAutorizado = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEyMywibmFtZSI6Ikpob24gRG9lIiwiZXhwIjoxNzMxNDYxNDQwfQ.5Shi69bkfBwmDPlaQ4eItU-sibjUKChA4ir5tOPdjBw";

// Verifica o token do cabeçalho Authorization
$headers = getallheaders();
if (isset($headers['Authorization'])) {
    $token = $headers['Authorization'];
    
    if ($token === $tokenAutorizado) {
        try {
            $select = $conexao->prepare("SELECT * FROM usuario");
            $select->execute();
            $data = $select->fetchAll(PDO::FETCH_ASSOC);

            enviaResposta(200, "Autorizado", $data);
            
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        enviaResposta(401, "Token de autorização inválido");
    }
} else {
    enviaResposta(401, "Cabeçalho de autorização ausente");
}

function enviaResposta($status, $message, $data = null) {
    http_response_code($status);
    echo json_encode([
        'message' => $message,
        'data' => $data
    ]);
}