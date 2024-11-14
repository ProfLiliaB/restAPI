<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
        }

        .container {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 8px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            width: 500px;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="login-container">
            <?php
            include_once "conexao.php";
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['username'];
                $senha = $_POST['password'];
                $selectEmail = $conexao->prepare("SELECT * FROM usuario WHERE email = :email");
                $selectEmail->bindParam('email', $email);
                $selectEmail->execute();
                $rs = $selectEmail->fetch(PDO::FETCH_ASSOC);
                if ($rs) {
                    $senha_banco = $rs['senha'];
                    $email_banco = $rs['email'];
                    $nome = $rs['nome'];
                    $id =  $rs['id_usuario'];
                    if (($email == $email_banco) && ($senha == $senha_banco)) {
                        $_SESSION['email'] = $email_banco;
                        $_SESSION['nome'] = $nome;
                        $_SESSION['id'] = $id;
                    } else {
                        echo "Login ou senha inválidos.";
                    }
                    header("location: ./");
                } else {
                    echo "Login ou senha inválidos.";
                }
            }
            ?>
            <h2>Login para consumir API</h2>
            <form method="post">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </main>
</body>

</html>