<?php
require "config.php";

// Pega o id enviado pela URL
// Se id for nulo atribui 0
$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM chamados WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

// Fetch pegar um registro
$chamado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chamado) {
    die("Chamado não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Chamado</title>
</head>

<body>
    <h1><strong>Título:</strong> <?= $chamado['titulo']; ?></h1>
    <p><strong>Solicitante:</strong> <?= $chamado['solicitante']; ?></p>
    <p><strong>Setor:</strong> <?= $chamado['setor']; ?></p>
    <p><strong>Prioridade:</strong> <?= $chamado['prioridade']; ?></p>
    <p><strong>Status:</strong> <?= $chamado['estado']; ?></p>
    <a href="index.php">
        <button>Voltar</button>
    </a>
</body>