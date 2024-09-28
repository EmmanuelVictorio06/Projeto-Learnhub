<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "learnhub";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica se há erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta SQL para obter as monitorias
$sql = "SELECT * FROM monitorias";
$result = $conn->query($sql);

// Inicializa a variável para armazenar o HTML das monitorias
$monitoriasHTML = "";

// Verifica se há monitorias
if ($result->num_rows > 0) {
    // Itera sobre as monitorias e cria o HTML correspondente
    while ($row = $result->fetch_assoc()) {
        $monitoriasHTML .= "<li class='monitoring'>";
        $monitoriasHTML .= "<div class='monitor-picture'>";
        // Você pode adicionar a imagem do monitor aqui, se estiver armazenada no banco de dados
        $monitoriasHTML .= "</div>";
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
    // Se não houver monitorias
    $monitoriasHTML = "<p>Nenhuma monitoria encontrada.</p>";
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
    <title>Perguntas - LearnHub</title>


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
        <div class="container-search">
            <div class="search">
                <form action="../PHP/monitoring-search.php" method="get">
                    <input type="text" id="search" name="q" placeholder="Pesquisar...">
                    <button type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
        <div class="container-main">
            <div class="container-subjects">
                <h1>Disciplinas</h1>
                <ul class="subjects-list">              
                <?php
                    // Consulta SQL para obter as disciplinas
                    $sql_disciplinas = "SELECT * FROM disciplinas";
                    $result_disciplinas = $conn->query($sql_disciplinas);
                    if ($result_disciplinas->num_rows > 0) {
                        // Loop para exibir as disciplinas como links
                        while ($row_disciplina = $result_disciplinas->fetch_assoc()) {
                            // Para cada disciplina, cria um link que chama a função para buscar perguntas por disciplina
                            echo "<li class='subject'>";
                            echo "<a href='#' class='subject-link' data-disciplina='" . $row_disciplina["nome_disciplina"] . "'>" . $row_disciplina["nome_disciplina"] . "</a>";
                            echo "</li>";
                        }}
                        ?>
                </ul>
            </div>
            <div class="container-my-monitoring">
                <div class="monitors">
                    <h1>Monitorias matriculadas</h1>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecione todos os links de disciplina
    var disciplinaLinks = document.querySelectorAll('.subject-link');
    
    // Para cada link, adicione um evento de clique
    disciplinaLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Impedir o comportamento padrão do link (não recarregar a página)
            event.preventDefault();
            
            // Obter o nome da disciplina do atributo 'data-disciplina' do link
            var disciplina = this.getAttribute('data-disciplina');
            
            // Redirecionar para a página de monitorias com a disciplina como parâmetro
            window.location.href = '../PHP/monitorias_disciplina.php?disciplina=' + encodeURIComponent(disciplina);
        });
    });
});
</script>

<?php
$conn->close();
?>