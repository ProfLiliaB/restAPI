<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

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
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;
        
    case 'POST':
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
        break;
        
    case 'PUT':
        $in = json_decode(file_get_contents('php://input'), true);
        if (is_array($in) && isset($in['id'], $in['nome'], $in['email'], $in['senha'])) {
            $atualiza = [
                'id'    => $in['id'],
                'nome'  => $in['nome'],
                'email' => $in['email'],
                'senha' => password_hash($in['senha'], PASSWORD_DEFAULT)
            ];
            $update = $conexao->prepare("UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            if ($update->execute($atualiza)) {
                echo json_encode(['message' => 'Usuário atualizado com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Erro: Não foi possível atualizar']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados inválidos ou id não encontrado']);
        }
        break;
        
    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        if (is_array($input) && isset($input['id'])) {
            $delete = $conexao->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            if ($delete->execute([$input['id']])) {
                echo json_encode(['message' => 'Excluído com sucesso']);
            } else {
                http_response_code(500);
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
