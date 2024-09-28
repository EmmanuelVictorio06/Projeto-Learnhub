<?php

if(isset($_POST['submit'])) {
    include_once('config.php');

    $texto = $_POST['texto'];
    $disciplina = $_POST['disciplina'];

    if(!empty($texto)) {

        $texto = mysqli_real_escape_string($conexao, $texto);
        $disciplina = mysqli_real_escape_string($conexao, $disciplina);


        $result = mysqli_query($conexao, "INSERT INTO perguntas(texto, disciplina) VALUES ('$texto', '$disciplina')");

        if($result) {
            echo "<div id='mensagem'>Pergunta cadastrada com sucesso!</div>";        
            echo "<script>setTimeout(function() { window.location.href = '../HTML/perguntas.php'; }, 3000);</script>";
        } else {
            echo "<div id='mensagem-erro'>Erro ao cadastrar a pergunta no banco de dados.</div>";
        }
    } else {
        echo "<div id='mensagem-erro'>O campo de descrição deve ser preenchido.</div>";
    }
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
            <form action="../PHP/formulario.php" method="POST">
                <h1> CRIAR NOVA PERGUNTA</h1>
                <fieldset>
                    <legend>Disciplina:</legend>

                    <select id="disciplina" name="disciplina" required>
                        <option value="Matemática">Matemática</option>
                        <option value="Física">Física</option>
                        <option value="Química">Química</option>
                        <option value="Biologia">Biologia</option>
                        <option value="Português">Português</option>
                        <option value="Inglês">Inglês</option>
                        <option value="Geografia">Geografia</option>
                        <option value="História">História</option>
                        <option value="Ciências">Ciências</option>
                        <option value="Educação Física">Educação Física</option>
                        <option value="Artes">Artes</option>
                        <option value="Filosofia">Filosofia</option>
                        <option value="Sociologia">Sociologia</option>
                        <option value="Letras">Letras</option>
                        <option value="Literatura">Literatura</option>
                    </select>
                    <br>
                </fieldset>
                <label for="texto">Descrição:</label><br>
                <textarea id="texto" name="texto" rows="4" cols="50" class="inputUser" required></textarea><br><br>
                <input type="submit" name="submit" id="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
</html>