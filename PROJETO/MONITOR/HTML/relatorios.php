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
    <title>Relatórios - LearnHub</title>

    <style>
        .relatorio-box {
            background-color: #232323;
            border: 2px solid greenyellow;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
            color: white;
            box-shadow: 5px 5px 10px black;
        }

        .relatorio-box:hover {
            box-shadow: 5px 5px 10px greenyellow;
        }

        .relatorio-box h2 {
            margin-top: 0;
            color: greenyellow;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .relatorio-box p {
            color: white;
            margin-bottom: 10px;
        }

        .relatorio-box p strong {
            color: greenyellow;
            font-weight: bold;
        }

        .relatorio-box .relatorio-id {
            color: white;
            font-size: 14px;
            margin-top: 5px;
        }

        .container-relatorios h1 {
            font-size: 26px;
            color: greenyellow;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 20px;
            text-transform: uppercase;
        }

        .btn-criar-relatorio {
            display: block;
            width: 200px;
            margin: 0 auto 20px 30px;
            background-color: black;
            color: greenyellow;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
        }

        .btn-criar-relatorio:hover {
            background-color: greenyellow;
            color: black;
            box-shadow: 10px 10px 10px black;
        }
    </style>
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="../images/logo.png">
            <h1><a href="../HTML/home-monitor.php">Home</a></h1>
            <h1><a href="../HTML/perguntas.php">Perguntas</a></h1>
            <h1><a href="../HTML/monitorias.php">Monitorias</a></h1>
            <h1 style="background-color: greenyellow;"><a style="color:black" href="../HTML/relatorios.php">Relatórios</a></h1>
            <h1><a href="../HTML/minha-conta.php">Minha conta</a></h1>
        </div>
    </header>
    <main>
        <div class="container-search">
            <div class="search">
                <form action="relatorios_search.php" method="get">
                    <input type="text" id="search" name="q" placeholder="Pesquisar...">
                    <button type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
        <div class="container-main">
            <div class="container-relatorios">
                <h1>Relatórios</h1>
                <a class="btn-criar-relatorio" href="../PHP/criar_relatorio.php">Criar Novo Relatório</a>
                <div class="relatorios-list">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "learnhub";


                    $conn = new mysqli($servername, $username, $password, $dbname);


                    if ($conn->connect_error) {
                        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                    }


                    $sql_relatórios = "SELECT * FROM relatorios";
                    $result_relatórios = $conn->query($sql_relatórios);

                    if ($result_relatórios->num_rows > 0) {

                        while ($row_relatorio = $result_relatórios->fetch_assoc()) {
                            echo "<div class='relatorio-box'>";
                            echo "<h2>" . $row_relatorio["nome_disciplina"] . "</h2>";
                            echo "<p><strong>ID:</strong> <span class='relatorio-id'>" . $row_relatorio["id_relatorio"] . "</span></p>";
                            echo "<p><strong>Data de Criação:</strong> <span>" . $row_relatorio["data_criacao"] . "</span></p>";
                            echo "<p><strong>Descrição:</strong> <span>" . $row_relatorio["descricao"] . "</span></p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Nenhum relatório encontrado.</p>";
                    }

                    $conn->close();
                    ?>
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


