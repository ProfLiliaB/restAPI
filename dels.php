<?php
include_once "config.php";
$data = [
    'id' => 19 
];
$ch = curl_init(URL_DEL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Jlc3Qvand0LnBocCIsImlhdCI6MTczMTk0NzE5MywiZXhwIjoxNzMxOTUwNzkzLCJkYXRhIjp7InVzZXJJZCI6MTIzLCJub21lIjoiSmhvbiBEb2UiLCJlbWFpbCI6ImVtYWlsQGVtYWlsLmNvbSJ9fQ.ifGodc9S8QXprWNRwEPxkrzxcsAAkxlcqSBvWx1Qy-I", 
    "Content-Type: application/json" 
]);
$response = curl_exec($ch);
$codigoResposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    echo "<h3>Código HTTP: $codigoResposta</h3>";
    echo "<pre>";
    print_r(json_decode($response, true));
}
curl_close($ch);