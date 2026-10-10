<?php
require "config.php";

//só executa o cadastro se o formulário tiver sido enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //pegar tudo o que o usuário preencheu no formulário
    $titulo = $_POST["titulo"];
    $solicitante = $_POST["solicitante"];
    $setor = $_POST["setor"];
    $prioridade = $_POST["prioridade"];
    $estado = $_POST["status"];
    $descricao = $_POST["descricao"];

    //comando pra cadastrar o chamado no banco
    $sql = "INSERT INTO chamados
    (titulo, solicitante, setor, prioridade, estado, descricao)
    VALUES (?, ?, ?, ?, ?, ?)";
    //Os ? são espaços reservados
    //eles ainda não possuem os valores reais

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $titulo,
        $solicitante,
        $setor,
        $prioridade,
        $estado,
        $descricao
    ]);

    header("Location: index.php");
    exit; //encerra a execução do php
}

?>

<!DOCTYPE html> 
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <!-- permite exibir corretamente símbolos e caracteres especiais -->
    <title>Novo chamado</title>
</head>

<body>
    <h1>Novo chamado</h1>
    <form method="post"> 
    <!-- define que os dados serão enviados usando o método post-->
     <label>Título: </label>
     <input type="text" name="titulo" require><br><br>

     <label>Solicitante: </label>
     <input type="text" name="solicitante" require><br><br>

     <label>Setor: </label>
     <input type="text" name="setor" require><br><br>

     <label>Prioridade: </label>
     <select name="prioridade">
        <option>Baixa</option>
        <option selected>Média</option>
        <option>Alta</option>
     </select><br><br>

     <label>Status: </label>
     <select name="status">
        <option selected>Aberto</option>
        <option>Em andamento</option>
        <option>Concluído</option>
     </select><br><br>

     <label>Descrição: </label>
     <textarea name="descricao" rows="6" require></textarea><br>
        <br>
        <button type="submit">Cadastrar</button><br><br>
    </form>

    <a href="index.php">
        <button>Voltar</button>
    </a>

</body>
</html>