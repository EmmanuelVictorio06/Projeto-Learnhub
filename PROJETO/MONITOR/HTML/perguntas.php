<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "learnhub";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}


$sql = "SELECT LPAD(id, 3, '0') AS id_formatado, texto, disciplina, DATE(data_criacao) AS data_criacao FROM perguntas";
$result = $conn->query($sql);
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
    <script type ="text/javascript" src="../JS/form.js"></script>
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Perguntas - LearnHub</title>
 
    <style>
        .container-my-quests{
            padding: 30px;
        }
        .container-subjects{
            
            width:40%;
        }
    </style>

</head>

<body>
    <header>

        <div class="cabecalho">

            <img src="../images/logo.png">
            <h1>     <a href="../HTML/home-monitor.php">  Home        </a>   </h1>    
            <h1 style="background-color: greenyellow;">     <a style="color:black" href="../HTML/perguntas.php">  Perguntas   </a>   </h1>   
            <h1>     <a href="../HTML/monitorias.php">  Monitorias  </a>   </h1>   
            <h1>     <a href="../HTML/relatorios.php">  Relatórios  </a>   </h1> 
            <h1>     <a href="../HTML/minha-conta.php">  Minha conta </a>   </h1>   

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

    
    <div class="new-quest-container">
        
        <form action="../PHP/formulario.php" method="POST">
            <input type="submit" value="Criar nova pergunta" id="create-new-quest">
           
        </form>
    
    </div> 

    <div class="container-main">


    <div class="container-my-quests">
        <div class="my-quests">
            <h1>Minhas perguntas</h1>
            <ul id="question-list">
                <?php

                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        if ($count < 4) {
                            echo "<li class='quest'>";
                            echo "<div class='quest-item'><span class='quest-label'>ID:</span><span class='quest-id'>" . $row["id_formatado"] . "</span></div>";
                            echo "<div class='quest-item'><span class='quest-label'>Disciplina:</span><span class='quest-disc'>" . $row["disciplina"] . "</span></div>";
                            echo "<div class='quest-item'><span class='quest-label'>Descrição:</span><span class='quest-descr'>" . $row["texto"] . "</span></div>";
                            echo "<div class='quest-item'><span class='quest-label'>Data:</span><span class='quest-date'>" . $row["data_criacao"] . "</span></div>";
                            echo "</li>";
                        } else {

                            echo "<li class='quest hidden'>";
                            echo "<div class='quest-item'><span class='quest-label'>ID:</span><span class='quest-id'>" . $row["id_formatado"] . "</span></div>";
                            echo "<div class='quest-item'><span class='quest-label'>Disciplina:</span><span class='quest-disc'>" . $row["disciplina"] . "</span></div>";
                            echo "<div class='quest-item'><span class='quest-label'>Descrição:</span><span class='quest-descr'>" . $row["texto"] . "</span></div>";
                            echo "<div class='quest-item'><span class='quest-label'>Data:</span><span class='quest-date'>" . $row["data_criacao"] . "</span></div>";
                            echo "</li>";
                        }
                        $count++;
                    }
                ?>
            </ul>

            <button id="show-more-btn">Mostrar Mais</button>
        </div>
    </div>

    <div class="container-subjects">

        <h1>Disciplinas</h1>
           
    
            <ul class="subjects-list">

            <?php

                    $sql_disciplinas = "SELECT * FROM disciplinas";
                    $result_disciplinas = $conn->query($sql_disciplinas);
                    if ($result_disciplinas->num_rows > 0) {

                        while ($row_disciplina = $result_disciplinas->fetch_assoc()) {

                            echo "<li class='subject'>";
                            echo "<a href='#' class='subject-link' data-disciplina='" . $row_disciplina["nome_disciplina"] . "'>" . $row_disciplina["nome_disciplina"] . "</a>";
                            echo "</li>";
                        }}
                        ?>
            </ul>
        </div>
    </div>

    </main>

    <div class="border"></div>

    <footer>

        <p> ® LearnHub - Todos os direitos reservados </p>

    </footer>

    <script>
    document.getElementById('show-more-btn').addEventListener('click', function() {
        var hiddenQuestions = document.querySelectorAll('.quest.hidden');
        if (hiddenQuestions.length > 0) {

            hiddenQuestions.forEach(function(question) {
                question.classList.remove('hidden');
            });
            this.textContent = 'Mostrar Menos'; 
        } else {

            var allQuestions = document.querySelectorAll('.quest');
            allQuestions.forEach(function(question, index) {
                if (index >= 4) {
                    question.classList.add('hidden');
                }
            });
            this.textContent = 'Mostrar Mais'; 
        }
    });




document.addEventListener('DOMContentLoaded', function() {

    var disciplinaLinks = document.querySelectorAll('.subject-link');
    

    disciplinaLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {

            event.preventDefault();
            

            var disciplina = this.getAttribute('data-disciplina');
            

            window.location.href = '../PHP/perguntas_disciplina.php?disciplina=' + encodeURIComponent(disciplina);
        });
    });
});
</script>

</body>

</html>

<?php

$conn->close();
?>