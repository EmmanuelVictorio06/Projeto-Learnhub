<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "learnhub";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta SQL para as perguntas dentro de container-my-quests
$sql = "SELECT LPAD(id, 3, '0') AS id_formatado, texto, disciplina, DATE(data_criacao) AS data_criacao FROM perguntas ORDER BY id ASC";
$result = $conn->query($sql);

// Consulta SQL para as perguntas dentro de container-last-quests
$sql_recent = "SELECT LPAD(id, 3, '0') AS id_formatado, texto, disciplina, DATE(data_criacao) AS data_criacao FROM perguntas ORDER BY id DESC";
$result_recent = $conn->query($sql_recent);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="..//CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Home - LearnHub</title>
    <style>
    .container-last-quests {
        padding: 30px;
        text-align: center; /* Centraliza o conteúdo da div horizontalmente */
    }

    #show-more-recent-btn {
        background-color: greenyellow;
        border: none;
        padding: 10px;
        margin: 0 auto; /* Centraliza o botão horizontalmente */
        cursor: pointer;
        align-items: center;
        justify-content: center;
        display: block; /* Garante que o botão é tratado como um elemento de bloco */
    }

        
    </style>
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="../images/logo.png">
            <h1 style="background-color: greenyellow;"><a style="color:black" href="../HTML/home.php">Home</a></h1>    
            <h1><a href="../HTML/perguntas.php">Perguntas</a></h1>   
            <h1><a href="../HTML/monitorias.php">Monitorias</a></h1>   
            <h1><a href="../HTML/minha-conta.php">Minha conta</a></h1>   
        </div>
    </header>

    <main>
        <div class="container-inf">
            <div class="inform">
                <p>Bem vindo(a) ao LearnHub, a plataforma de integração entre alunos, monitores e professores!</p>
            </div>
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

            <div class="container-last-quests">
                <div class="last-quests">
                    <h1>Perguntas recentes</h1>
                    <ul class="last-quests-list" id="recent-questions-list">
                        <?php
                            $count_recent = 0;
                            while ($row_recent = $result_recent->fetch_assoc()) {
                                if ($count_recent < 4) {
                                    echo "<li class='quest'>";
                                    echo "<div class='quest-item'><span class='quest-label'>ID:</span><span class='quest-id'>" . $row_recent["id_formatado"] . "</span></div>";
                                    echo "<div class='quest-item'><span class='quest-label'>Disciplina:</span><span class='quest-disc'>" . $row_recent["disciplina"] . "</span></div>";
                                    echo "<div class='quest-item'><span class='quest-label'>Descrição:</span><span class='quest-descr'>" . $row_recent["texto"] . "</span></div>";
                                    echo "<div class='quest-item'><span class='quest-label'>Data:</span><span class='quest-date'>" . $row_recent["data_criacao"] . "</span></div>";
                                    echo "</li>";
                                } else {
                                    echo "<li class='quest hidden'>";
                                    echo "<div class='quest-item'><span class='quest-label'>ID:</span><span class='quest-id'>" . $row_recent["id_formatado"] . "</span></div>";
                                    echo "<div class='quest-item'><span class='quest-label'>Disciplina:</span><span class='quest-disc'>" . $row_recent["disciplina"] . "</span></div>";
                                    echo "<div class='quest-item'><span class='quest-label'>Descrição:</span><span class='quest-descr'>" . $row_recent["texto"] . "</span></div>";
                                    echo "<div class='quest-item'><span class='quest-label'>Data:</span><span class='quest-date'>" . $row_recent["data_criacao"] . "</span></div>";
                                    echo "</li>";
                                }
                                $count_recent++;
                            }
                        ?>
                    </ul>
                    <button id="show-more-recent-btn">Mostrar Mais</button>
                </div>
            </div>
        </div>
    </main>

    <div class="border"></div>

    <footer>
        <p>® LearnHub - Todos os direitos reservados</p>
    </footer>
    <script>
    document.getElementById('show-more-btn').addEventListener('click', function() {
        var hiddenQuestions = document.querySelectorAll('#question-list .quest.hidden');
        if (hiddenQuestions.length > 0) {
            hiddenQuestions.forEach(function(question) {
                question.classList.remove('hidden');
            });
            this.textContent = 'Mostrar Menos'; 
        } else {
            var allQuestions = document.querySelectorAll('#question-list .quest');
            allQuestions.forEach(function(question, index) {
                if (index >= 4) {
                    question.classList.add('hidden');
                }
            });
            this.textContent = 'Mostrar Mais'; 
        }
    });

    document.getElementById('show-more-recent-btn').addEventListener('click', function() {
        var hiddenRecentQuestions = document.querySelectorAll('#recent-questions-list .quest.hidden');
        if (hiddenRecentQuestions.length > 0) {
            hiddenRecentQuestions.forEach(function(question) {
                question.classList.remove('hidden');
            });
            this.textContent = 'Mostrar Menos'; 
        } else {
            var allRecentQuestions = document.querySelectorAll('#recent-questions-list .quest');
            allRecentQuestions.forEach(function(question, index) {
                if (index >= 4) {
                    question.classList.add('hidden');
                }
            });
            this.textContent = 'Mostrar Mais'; 
        }
    });
    </script>
</body>
</html>