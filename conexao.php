<?php
$host = "localhost"; 
$db = "lojatech";
$user = "root";
$senha = "";
 
try {
    $conexao = new PDO("mysql:host=$host;dbname=$db", $user, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "". $e->getMessage();
}