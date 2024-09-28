<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "learnhub";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}


if (isset($_GET['disciplina'])) {
    $disciplina = $_GET['disciplina'];
    

    $sql_perguntas_disciplina = "SELECT LPAD(id, 3, '0') AS id_formatado, texto, DATE(data_criacao) AS data_criacao FROM perguntas WHERE disciplina = ?";
    $stmt = $conn->prepare($sql_perguntas_disciplina);
    $stmt->bind_param("s", $disciplina);
    $stmt->execute();
    $result_perguntas_disciplina = $stmt->get_result();
} else {

    header("Location: perguntas.php");
    exit();
}


$resultsHTML = '';


while ($row_pergunta = $result_perguntas_disciplina->fetch_assoc()) {
    $resultsHTML .= "<li class='quest'>";
    $resultsHTML .= "<div class='quest-item'><span class='quest-label'>ID:</span><span class='quest-id'>" . $row_pergunta["id_formatado"] . "</span></div>";
    $resultsHTML .= "<div class='quest-item'><span class='quest-label'>Disciplina:</span><span class='quest-disc'>" . $disciplina . "</span></div>";
    $resultsHTML .= "<div class='quest-item'><span class='quest-label'>Descrição:</span><span class='quest-descr'>" . $row_pergunta["texto"] . "</span></div>";
    $resultsHTML .= "<div class='quest-item'><span class='quest-label'>Data:</span><span class='quest-date'>" . $row_pergunta["data_criacao"] . "</span></div>";
    $resultsHTML .= "</li>";
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Resposta pesquisa - LearnHub</title>

</head>
<body>
    <header>
        <div class="cabecalho">
            <img src="../images/logo.png">
            <h1><a href="../HTML/home.php">Home</a></h1>
            <h1 style="background-color: greenyellow;"><a style="color:black" href="../HTML/perguntas.php">Perguntas</a></h1>
            <h1><a href="../HTML/monitorias.php">Monitorias</a></h1>
            <h1><a href="../HTML/minha-conta.php">Minha conta</a></h1>
        </div>
    </header>

    <main>
        <div class="container-search">
            <div class="search">
                <form action="../PHP/search.php" method="get">
                    <input type="text" id="search" name="q" placeholder="Pesquisar...">
                    <button type="submit">Pesquisar</button>
                </form>
            </div>
        </div>

        <div class="container-main">
            <div class="container-my-quests">
                <div class="my-quests">
                    <h1>Perguntas da disciplina de <?php echo $disciplina; ?></h1>
                    <ul id="question-list">
                        <?php echo $resultsHTML; ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <div class="border"></div>

    <footer>
        <p>® LearnHub - Todos os direitos reservados</p>
    </footer>
</body>
</html>