<?php
require "config.php";
function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if (!$id) {
        http_response_code(400);
        die("ID inválido");
    }

    $stmt = $pdo->prepare("DELETE FROM chamados WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    die("ID inválido");
}

$stmt = $pdo->prepare("SELECT titulo FROM chamados WHERE id = ?");
$stmt->execute([$id]);
$chamado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chamado) {
    http_response_code(404);
    die("Chamado não encontrado");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir chamado</title>
</head>
<body>
    <h1>Excluir chamado</h1>
    <p>Deseja realmente excluir o chamado “<?= e($chamado["titulo"]) ?>”?</p>

    <form method="post" action="excluir.php">
        <input type="hidden" name="id" value="<?= e($id) ?>">
        <button type="submit">Confirmar exclusão</button><br><br>
    </form>

    <a href="ver.php?id=<?= e($id) ?>"><button>Cancelar</button></a>
</body>
</html>