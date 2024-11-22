<?php
header("Content-Type: application/json; charset=UTF-8");
$headers = getallheaders();

if(!$headers['Authorization']){
    echo json_encode(['erro' => 'Acesso negado!']);
    exit;
}
$authorization = $headers['Authorization'];

$bearer = str_replace('Bearer ', '', $authorization);
$token = explode('.', $bearer);

$header = $token[0];
$payload = $token[1];
$signature = $token[2];

// $res['bearer'] = $bearer;
//$res['toekn'] = $token;

$chave_secreta = "dVIns6oTyVvsnYzmaTyh3YPS7alsyCFt";

$validate = base64_encode(hash_hmac('sha256', "$header.$payload", $chave_secreta, true));

if ($signature === $validate) {
    $res['status'] = 'success';
    $res['message'] = 'Você está autorizado a acessar à API.';
    echo json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    echo json_encode(['erro' => 'Assinatura inválida!'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
