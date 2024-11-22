<?php
header("Content-Type: application/json; charset=UTF-8");
$usuario = $_POST['usuario'] ?? 'tilive';
$senha = $_POST['senha'] ?? '1234';
// if (key_exists($usuario, $autorizados) || $autorizados[$usuario] != $senha) {
//     $res['status'] = 'sucesso';
//     $res['message'] = 'Acesso autorizado para '.$usuario;
//     $autorizados[$usuario] = JWT($usuario, $senha);
//     $res['emissao'] = time();
//     echo json_encode($res);
// } else {
//     $res['status'] = 'erro';
//     $res['message'] = 'Access negado!';
//     $res['emissao'] = time();
//     echo json_encode($res);
// }

$senha_secreta = "dVIns6oTyVvsnYzmaTyh3YPS7alsyCFt";
$header = base64_encode(json_encode([
    'typ' => 'JWT',
    'alg' => 'HS256'
]));

$payload = base64_encode(json_encode([
    'usuario' => $usuario,
    'senha' => $senha
]));

$assinatura = base64_encode(hash_hmac('sha256', "$header.$payload", $senha_secreta, true));

$res['status'] = 'success';
$res['emissao'] = time();
$res['token'] = "$header.$payload.$assinatura";

echo json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
