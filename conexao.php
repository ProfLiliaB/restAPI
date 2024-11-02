<?php
$host = "localhost";
$banco = "lojatech";
$user = "root";
$senha = "";
$conexao = new PDO("mysql:host=$host;dbname=$banco", $user, $senha);
if (!$conexao) {
    echo "Eita, deu ruim";
}