<?php
require "config.php";

//pega o id enviado pela URL
//?? = se id for nulo atribuí 0
$id = $_GET["id"] ?? 0;

$sql = "SELECT * FROM chamados WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

//fetch pegar o registro
$chamado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chamado) {
    die("Chamado não encontrado");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Chamado</title>
</head>

<body>
    <h1><?= $chamado["titulo"] ?></h1>
    <p><strong>Solicitante:</strong><?= $chamado["solicitante"] ?></p>
    <p><strong>Setor:</strong><?= $chamado["setor"] ?></p>
    <p><strong>Prioridade:</strong><?= $chamado["prioridade"] ?></p>
    <p><strong>Status:</strong><?= $chamado["estado"] ?></p>
    <p><strong>Descrição:</strong><?= $chamado["descricao"] ?></p>

    <a href="editar.php?id=<?= $chamado["id"]?>"><button>Editar</button></a><br><br>
    <a href="index.php">
        <button>Voltar</button>
    </a>
</body>

</html>