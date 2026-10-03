<?php
require "config.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $solicitante = $_POST['solicitante'];
    $setor = $_POST['setor'];
    $prioridade = $_POST['prioridade'];
    $estado = $_POST['estado'];

    // Inserir o novo chamado no banco de dados
    $sql = "INSERT INTO chamados (titulo, solicitante, setor, prioridade, estado) VALUES (:titulo, :solicitante, :setor, :prioridade, :estado)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':solicitante', $solicitante);
    $stmt->bindParam(':setor', $setor);
    $stmt->bindParam(':prioridade', $prioridade);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();

    // Redirecionar para a página principal após o cadastro
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>TechDesk</title>
</head>
<body>
    <h1>Cadastrar Novo Chamado</h1>
    <form action="salvar.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>
        <label for ="setor">Setor:</label>
        <textarea id="setor" name="setor" required></textarea>
        <br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
        <br><br>
        <select id="status" name="status">
            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>
        </select>
        <br><br>
        <select id="estado" name="estado">
            <option value="aberto">Aberto</option>
            <option value="em_andamento">Em Andamento</option>
            <option value="fechado">Fechado</option>
        </select>
        <br><br>
        <input type="submit" value="Cadastrar" href="index.php">
    </form>
</body>