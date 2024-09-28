<?php

if(isset($_POST['submit'])) {
    include_once('config.php');

    $nome_disciplina = $_POST['nome_disciplina'];
    $data_criacao = $_POST['data_criacao'];
    $descricao = $_POST['descricao'];

    if(!empty($nome_disciplina) && !empty($data_criacao) && !empty($descricao)) {
        
        $nome_disciplina = mysqli_real_escape_string($conexao, $nome_disciplina);
        $data_criacao = mysqli_real_escape_string($conexao, $data_criacao);
        $descricao = mysqli_real_escape_string($conexao, $descricao);

        
        $result = mysqli_query($conexao, "INSERT INTO relatorios(nome_disciplina, data_criacao, descricao) VALUES ('$nome_disciplina', '$data_criacao', '$descricao')");

        if($result) {
            echo "<div id='mensagem'>Relatório cadastrado com sucesso!</div>";        
            echo "<script>setTimeout(function() { window.location.href = '../HTML/relatorios.php'; }, 3000);</script>";
        } else {
            echo "<div id='mensagem-erro'>Erro ao cadastrar o relatório no banco de dados.</div>";
        }
    } else {
        echo "<div id='mensagem-erro'>Todos os campos devem ser preenchidos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Relatório</title>
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/style.css">

    <style>
        #mensagem {
            color: black;
            background-color: greenyellow;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        #mensagem-erro {
            background-color: red;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="new-quest">
    <div id="questionForm">
        <form action="../PHP/criar_relatorio.php" method="POST">
            <h1>Criar Novo Relatório</h1>
            <fieldset>
                <legend>Disciplina:</legend>
                <select id="nome_disciplina" name="nome_disciplina" required>
                    <option value="Matemática">Matemática</option>
                    <option value="Física">Física</option>
                    <option value="Química">Química</option>
                    <option value="Biologia">Biologia</option>
                    <option value="Português">Português</option>
                    <option value="Inglês">Inglês</option>
                    <option value="Geografia">Geografia</option>
                    <option value="História">História</option>
                    <option value="Ciências">Ciências</option>
                    <option value="Educação Física">Educação Física</option>
                    <option value="Artes">Artes</option>
                    <option value="Filosofia">Filosofia</option>
                    <option value="Sociologia">Sociologia</option>
                    <option value="Letras">Letras</option>
                    <option value="Literatura">Literatura</option>
                </select>
            </fieldset>
            <br>
            <label for="data_criacao">Data de Criação:</label><br>
            <input type="date" id="data_criacao" name="data_criacao" class="inputUser" required><br><br>
            <label for="descricao">Descrição:</label><br>
            <textarea id="descricao" name="descricao" rows="4" cols="50" class="inputUser" required></textarea><br><br>
            <input type="submit" name="submit" id="submit" value="Enviar">
        </form>
    </div>
</div>

</body>
</html>