<?php
require "config.php"; // Carregar o arquivo config.php que cria a conexão com o banco de dados

// Buscar todos os chamados no banco de dados
$sql = "SELECT * FROM chamados ORDER BY id DESC";

// Executar o SELECT e guardar os registros encontrados
$chamados = $pdo->query($sql)->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TechDesk</title>
</head>

<body>
    <h1>Central de Chamados</h1>
    <a href="novo.php">Novo Chamado</a>
    <br><br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Solicitante</th>
            <th>Setor</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($chamados as $chamado) : ?>
            <tr>
                <td><?= $chamado['id']; ?></td>
                <td><?= $chamado['titulo']; ?></td>
                <td><?= $chamado['solicitante']; ?></td>
                <td><?= $chamado['setor']; ?></td>
                <td><?= $chamado['prioridade']; ?></td>
                <td><?= $chamado['estado']; ?></td>
                <td><a href="ver.php?id=<?= $chamado['id']; ?>">Ver</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>