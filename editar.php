<?php
require "config.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    die("ID inválido");
}

$stmt = $pdo->prepare("SELECT * FROM chamados WHERE id = ?");
$stmt->execute([$id]);
$chamado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chamado) {
    http_response_code(404);
    die("Chamado não encontrado");
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST["titulo"] ?? "");
    $solicitante = trim($_POST["solicitante"] ?? "");
    $setor = trim($_POST["setor"] ?? "");
    $prioridade = trim($_POST["prioridade"] ?? "");
    $estado = trim($_POST["estado"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");

    if ($titulo === "") {
        $erro = "O título é obrigatório.";
    } else {
        $sql = "UPDATE chamados
                SET titulo = ?, solicitante = ?, setor = ?,
                    prioridade = ?, estado = ?, descricao = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $titulo,
            $solicitante,
            $setor,
            $prioridade,
            $estado,
            $descricao,
            $id
        ]);

        header("Location: ver.php?id=" . $id);
        exit;
    }

    // Mantém os valores preenchidos caso haja erro.
    $chamado = array_merge($chamado, [
        "titulo" => $titulo,
        "solicitante" => $solicitante,
        "setor" => $setor,
        "prioridade" => $prioridade,
        "estado" => $estado,
        "descricao" => $descricao
    ]);
}

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar chamado</title>
</head>
<body>
    <h1>Editar chamado</h1>

    <?php if ($erro !== ""): ?>
        <p><?= e($erro) ?></p>
    <?php endif; ?>

    <form method="post" action="editar.php?id=<?= e($id) ?>">
        <label>
            Título:
            <input type="text" name="titulo" value="<?= e($chamado["titulo"]) ?>" required>
        </label>
        <br><br>

        <label>
            Solicitante:
            <input type="text" name="solicitante" value="<?= e($chamado["solicitante"]) ?>">
        </label>
        <br><br>

        <label>
            Setor:
            <input type="text" name="setor" value="<?= e($chamado["setor"]) ?>">
        </label>
        <br><br>

        <label>
            Prioridade:
            <input type="text" name="prioridade" value="<?= e($chamado["prioridade"]) ?>">
        </label>
        <br><br>

        <label>
            Status:
            <input type="text" name="estado" value="<?= e($chamado["estado"]) ?>">
        </label>
        <br><br>

        <label>
            Descrição:
            <textarea name="descricao"><?= e($chamado["descricao"]) ?></textarea>
        </label>
        <br><br>

        <button type="submit">Salvar alterações</button><br><br>
    </form>

    <a href="ver.php?id=<?= e($id) ?>"><button>Cancelar</button></a>
</body>
</html>