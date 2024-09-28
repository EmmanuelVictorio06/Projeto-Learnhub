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

    $disciplina = mysqli_real_escape_string($conn, $_GET['disciplina']);


    $sql = "SELECT * FROM monitorias WHERE disciplina = '$disciplina'";
    $result = $conn->query($sql);

 
    $monitoriasHTML = "";


    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $monitoriasHTML .= "<li class='monitoring'>";
            $monitoriasHTML .= "<div class='monitor-info'>";
            $monitoriasHTML .= "<h2 class='monitoring-title'>Monitoria de " . $row["disciplina"] . "</h2>";
            $monitoriasHTML .= "<br>";
            $monitoriasHTML .= "<div class='monitoring-item'>";
            $monitoriasHTML .= "<span class='monitoring-label'>Monitor: </span>";
            $monitoriasHTML .= "<span class='monitoring-name'>" . $row["nome_monitor"] . "</span>";
            $monitoriasHTML .= "</div>";
            $monitoriasHTML .= "<div class='monitoring-item'>";
            $monitoriasHTML .= "<span class='monitoring-label'>Horário: </span>";
            $monitoriasHTML .= "<span class='monitoring-hour'>" . $row["horario_inicio"] . " - " . $row["horario_fim"] . "</span>";
            $monitoriasHTML .= "</div>";
            $monitoriasHTML .= "<div class='monitoring-item'>";
            $monitoriasHTML .= "<span class='monitoring-label'>Dias: </span>";
            $monitoriasHTML .= "<span class='monitoring-day'>" . $row["dia_semana"] . "</span>";
            $monitoriasHTML .= "</div>";
            $monitoriasHTML .= "<div class='monitoring-item'>";
            $monitoriasHTML .= "<span class='monitoring-label'>Sala: </span>";
            $monitoriasHTML .= "<span class='monitoring-room'>" . $row["sala"] . "</span>";
            $monitoriasHTML .= "</div>";
            $monitoriasHTML .= "<div class='monitoring-item'>";
            $monitoriasHTML .= "<span class='monitoring-label'>Link: </span>";
            $monitoriasHTML .= "<a class='monitor-meet' href='" . $row["link"] . "'>Link para a Monitoria</a>";
            $monitoriasHTML .= "</div>";
            $monitoriasHTML .= "</div>";
            $monitoriasHTML .= "</li>";
        }
    } else {

        $monitoriasHTML = "<p>Nenhuma monitoria encontrada para esta disciplina.</p>";
    }
} else {

    $monitoriasHTML = "<p>Nenhuma disciplina selecionada.</p>";
}
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
    <title>Monitorias - LearnHub</title>
</head>
<body>
    <header>
        <div class="cabecalho">
            <img src="../images/logo.png">
            <h1><a href="../HTML/home.php">Home</a></h1>
            <h1><a href="../HTML/perguntas.php">Perguntas</a></h1>
            <h1 style="background-color: greenyellow;"><a style="color:black" href="../HTML/monitorias.html">Monitorias</a></h1>
            <h1><a href="../HTML/minha-conta.php">Minha conta</a></h1>
        </div>
    </header>
    <main>
        <div class="container-main">
            <div class="container-my-monitoring">
                <div class="monitors">
                    <h1>Monitorias de <?php echo $disciplina; ?></h1>
                    <ul class="monitoring-list">
                        <?php echo $monitoriasHTML; ?>
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

<?php
$conn->close();
?>