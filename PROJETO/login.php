<?php
$mensagem = "";
$mensagem_tipo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learnhub";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }


    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];


    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $mensagem = "Email não cadastrado";
        $mensagem_tipo = "erro";
    } else {

        $row = $result->fetch_assoc();
        if ($row['senha'] === $senha) {
            if (strpos($usuario, '@monitor.com') !== false) {
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'MONITOR/HTML/home-monitor.php';
                        }, 3000);
                      </script>";
            } else {
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'ALUNO/HTML/home.php';
                        }, 3000);
                      </script>";
            }
            $mensagem = "Login efetuado com sucesso!";
            $mensagem_tipo = "sucesso";
        } else {
            $mensagem = "Senha incorreta!";
            $mensagem_tipo = "erro";
        }
    }


    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            padding: 40px;
            background-color: black;
            border-radius: 10px;
            border: 2px solid greenyellow;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-size: 26px;
            text-align: center;
            color: greenyellow;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: greenyellow;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 2px solid greenyellow;
            border-radius: 4px;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: border-color 0.25s ease-in-out;
            background-color: #333;
            color: greenyellow;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: greenyellow;
            outline: none;
        }

        button {
            width: 100%;
            background-color: #333;
            border: 2px solid greenyellow;
            color: greenyellow;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            box-shadow: 6px 6px 8px #333;
            color: black;
            background-color: greenyellow;
        }

        #mensagem-erro, #mensagem-sucesso {
            color: #d9534f;
            margin-top: 15px;
            font-weight: bold;
            text-align: center;
        }

        #mensagem-sucesso {
            color: greenyellow;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Entrar</h1>
        <form action="login.php" method="post">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div id="mensagem-erro">
                    <?php if($mensagem_tipo == "erro") { echo $mensagem; } ?>
                </div>
                <div id="mensagem-sucesso">
                    <?php if($mensagem_tipo == "sucesso") { echo $mensagem; } ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
