<?php
$message = '';

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

    $sql_verificar_email = "SELECT * FROM usuarios WHERE email='$email'";
    $result_verificar_email = $conn->query($sql_verificar_email);

    if ($result_verificar_email->num_rows == 0) {
        $message = "Erro: o email não está cadastrado.";
    } else {
        $nome = $_POST['nome'];
        $curso = $_POST['curso'];

        $sql = "UPDATE usuarios SET nome='$nome', curso='$curso' WHERE email='$email'";

        if ($conn->query($sql) === TRUE) {
            $message = "Informações atualizadas com sucesso!";
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "../HTML/minha-conta.php";
                    }, 3000); // 3000 milissegundos = 3 segundos
                  </script>';
        } else {
            $message = "Erro ao atualizar informações: " . $conn->error;
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
    <title>Cadastro de Texto</title>
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
            width: 50%;
            margin: 50px auto;
            padding: 30px;
        }
        #container-form:hover {
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

        #container-form input, #container-form select {
            margin-bottom: 20px;
            margin-top: 20px;
            padding: 10px;
            border: 2px solid greenyellow;
            border-radius: 10px;
            font-size: 20px;
            background-color: black;
            color: greenyellow;
            width: 100%;
        }

        #container-form button {
            font-size: 20px;
            color: black;
            background-color: greenyellow;
            display: block;
            margin: 20px auto; 
            box-shadow: 4px 8px 8px black;
        }

        #container-form button:hover {
            box-shadow: 2px 4px 8px greenyellow;
            border-color: greenyellow;
        }

        #container-form legend {
            font-size: 24px;
            margin-bottom: 20px;
        }

        #mensagem {
            background-color: greenyellow;
            color: black;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>

</head>
<body>
    <div id="container-form">
        <?php if ($message): ?>
            <div id="mensagem"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="../PHP/formulario-conta.php" method="POST">
            <h1>Atualizar dados da conta</h1>
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <fieldset>
                <legend>Curso:</legend>
                <select id="curso" name="curso" required>
                    <option value="Engenharia Civil">Engenharia Civil</option>
                    <option value="Engenharia de Computação">Engenharia de Computação</option>
                    <option value="Engenharia de Software">Engenharia de Software</option>
                    <option value="Engenharia Elétrica">Engenharia Elétrica</option>
                    <option value="Engenharia Mecânica">Engenharia Mecânica</option>
                    <option value="Administração">Administração</option>
                    <option value="Direito">Direito</option>
                    <option value="Medicina">Medicina</option>
                    <option value="Arquitetura e Urbanismo">Arquitetura e Urbanismo</option>
                    <option value="Economia">Economia</option>
                    <option value="Psicologia">Psicologia</option>
                    <option value="Ciências Contábeis">Ciências Contábeis</option>
                    <option value="Design Gráfico">Design Gráfico</option>
                    <option value="Nutrição">Nutrição</option>
                    <option value="Jornalismo">Jornalismo</option>
                    <option value="Publicidade e Propaganda">Publicidade e Propaganda</option>
                </select>
                <br>
            </fieldset>
            
            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>
