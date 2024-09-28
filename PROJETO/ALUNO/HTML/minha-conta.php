<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learnhub";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}


$sql = "SELECT id_usuario, nome, email, curso FROM usuarios WHERE id_usuario = 1"; // Substitua '1' pelo ID do usuário desejado

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $id_usuario = str_pad($row["id_usuario"], 3, '0', STR_PAD_LEFT);
        $nome = $row["nome"];
        $email = $row["email"];
        $curso = $row["curso"];
    }
} else {
    echo "Nenhum resultado encontrado";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Perguntas - LearnHub</title>
    <style>
         #update-info-btn, #change-password-btn {
            font-size: 20px;
            color: black;
            background-color: greenyellow;
            display: block;
            margin: 20px auto; 
            box-shadow: 4px 8px 8px black;
            border: 2px solid black;
            border-radius: 10px;
        }

        #update-info-btn:hover, #change-password-btn:hover {
            box-shadow: 2px 4px 8px greenyellow;
            border-color: greenyellow;
        }

        .container-account {
            width: 80%;
        }

        .container-main-my-account {
            display: flex;
            justify-content: center; /* Centraliza o conteúdo horizontalmente */
            align-items: center; /* Alinha o conteúdo verticalmente */
            margin: 10px;
        }

        .container-account h1{
            font-size: 32px;
            text-transform: uppercase;
            text-align: center;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="../images/logo.png">
            <h1><a href="../HTML/home.php">Home</a></h1>    
            <h1><a href="../HTML/perguntas.php">Perguntas</a></h1>   
            <h1><a href="../HTML/monitorias.php">Monitorias</a></h1>   
            <h1 style="background-color: greenyellow;"><a style="color:black" href="../HTML/minha-conta.php">Minha conta</a></h1>   
        </div>
    </header>

    <main>
        <div class="container-main-my-account">
            <div class="container-account">
                <h1>Minha conta</h1>
                <div class="my-account">
                    <div class="image-account">
                        <img src="https://img.freepik.com/fotos-gratis/homem-bonito-posando-e-sorrindo_23-2149396133.jpg" alt="Imagem do usuário">
                    </div>
                    <div class="account-details">
                        <div class="account-info">
                            <span class="account-label">ID:</span>
                            <span class="account-id"><?php echo $id_usuario; ?></span>
                        </div>
                        <div class="account-info">
                            <span class="account-label">Nome:</span>
                            <span class="account-name"><?php echo $nome; ?></span>
                        </div>
                        <div class="account-info">
                            <span class="account-label">Email:</span>
                            <span class="account-email"><?php echo $email; ?></span>
                        </div>
                        <div class="account-info">
                            <span class="account-label">Curso:</span>
                            <span class="account-couse"><?php echo $curso; ?></span>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <form action="../PHP/formulario-conta.php" method="GET" id="update-info-form" style="display: none;">
                    </form>
                    <form action="../PHP/alterar-senha.php" method="GET" id="change-password-form" style="display: none;">
                    </form>
                </div>  
                <button id="update-info-btn" onclick="document.getElementById('update-info-form').submit();">Atualizar Informações</button>
                <button id="change-password-btn" onclick="document.getElementById('change-password-form').submit();">Alterar Senha</button>
            </div>
        </div>
    </main>

    <div class="border"></div>

    <footer>
        <p> ® LearnHub - Todos os direitos reservados </p>
    </footer>
</body>
</html>