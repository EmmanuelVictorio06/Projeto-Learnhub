<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "learnhub";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $senha_antiga = $_POST['senha_antiga'];
    $nova_senha = $_POST['nova_senha'];

    $sql_verificar_email = "SELECT senha FROM usuarios WHERE email='$email'";
    $result_verificar_email = $conn->query($sql_verificar_email);

    if ($result_verificar_email->num_rows == 0) {
        $message = "Erro: o email não está cadastrado.";
    } else {
        $row = $result_verificar_email->fetch_assoc();
        if ($senha_antiga !== $row['senha']) {
            $message = "Erro: a senha antiga está incorreta.";
        } else {
            $sql = "UPDATE usuarios SET senha='$nova_senha' WHERE email='$email'";

            if ($conn->query($sql) === TRUE) {
                $message = "Senha atualizada com sucesso!";
                // Redirecionar para minha-conta.php após 3 segundos
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "../HTML/minha-conta.php";
                        }, 3000); // 3000 milissegundos = 3 segundos
                      </script>';
            }else {
                $message = "Erro ao atualizar senha: " . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        #container-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid greenyellow;
            box-shadow: 4px 8px 8px black;
            color: greenyellow;
            width:50%;
            margin: 50px auto;
            padding: 30px;
        }
        #container-form:hover{
            box-shadow: 4px 8px 8px greenyellow;
        }

        #container-form h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 30px;
            font-weight: bold;
        }

        #container-form label {
            font-size: 24px;
        }

        #container-form input {
            margin-bottom: 20px;
            margin-top: 20px;
            padding: 10px;
            border: 2px solid greenyellow;
            border-radius: 10px;
            font-size: 20px;
            background-color: black;
            color: greenyellow;
            width:100%;
        }

        #container-form button {
            font-size: 20px;
            color: black;
            background-color: greenyellow;
            display: block;
            margin: 20px auto; 
            box-shadow: 4px 8px 8px black;
        }

        #container-form button:hover{
            box-shadow: 2px 4px 8px greenyellow;
            border-color: greenyellow;
        }

        #mensagem {
            background-color: greenyellow;
            color: black;
            padding: 10px;
            margin-bottom: 20px;
            width: 50%;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div id="container-form">
        <?php if ($message): ?>
            <div id="mensagem"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="alterar-senha.php" method="POST">
            <h1>Alterar Senha</h1>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha_antiga">Senha Antiga:</label>
            <input type="password" id="senha_antiga" name="senha_antiga" required><br><br>

            <label for="nova_senha">Nova Senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required><br><br>
            
            <button type="submit">Atualizar Senha</button>
        </form>
    </div>
</body>

</html>
