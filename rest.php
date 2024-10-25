<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
include_once "conexao.php";
$metodo = $_SERVER['REQUEST_METHOD'];
switch ($metodo) {
    case 'GET':
        try {
            $select = $conexao->prepare("SELECT * FROM usuario");
            $select->execute();
            $data = $select->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['nome']) && isset($input['email']) && isset($input['senha'])) {
            $novo = [
                'nome'  => $input['nome'],
                'email' => $input['email'],
                'senha' => $input['senha']
            ];
            $insert = $conexao->prepare("INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)");
            if ($insert->execute($novo)) {
                echo json_encode(['message' => 'Usuário inserido com sucesso']);
            } else {
                echo json_encode(['message' => 'Erro: não foi possível inserir']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados inválidos']);
        }
        break;
    case 'PUT':
        $in = json_decode(file_get_contents('php://input'), true);
        $atualiza = [
            'id'    => $in['id'],
            'nome'  => $in['nome'],
            'email' => $in['email'],
            'senha' => $in['senha']
        ];
        if (isset($in['id'])) {
            $update = $conexao->prepare("UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id_usuario = :id");
            if ($update->execute($atualiza)) {
                echo json_encode(['message' => 'Usuário atualizado com sucesso']);
            } else {
                echo json_encode(['message' => 'Erro: Não foi possível atualizar']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Id não encontrado']);
        }
        break;
    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['id'])) {
            $delete =  $conexao->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            if ($delete->execute([$input['id']])) {
                echo json_encode(['message' => 'Excluído com sucesso']);
            } else {
                echo json_encode(['message' => 'Erro: Não foi possível Excluir']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Id não encontrado']);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Método inválido']);
        break;
}
