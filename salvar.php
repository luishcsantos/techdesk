<?php
// filepath: c:\xampp\htdocs\techdesk\salvar.php

require "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Método não permitido.");
}

$titulo = trim($_POST["titulo"] ?? "");
$solicitante = trim($_POST["solicitante"] ?? "");
$setor = trim($_POST["setor"] ?? "");
$prioridade = trim($_POST["prioridade"] ?? "");

if ($titulo === "" || $solicitante === "" || $setor === "" || $prioridade === "") {
    http_response_code(400);
    exit("Preencha todos os campos obrigatórios.");
}

$sql = "INSERT INTO chamados (titulo, solicitante, setor, prioridade, estado)
        VALUES (:titulo, :solicitante, :setor, :prioridade, :estado)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ":titulo" => $titulo,
    ":solicitante" => $solicitante,
    ":setor" => $setor,
    ":prioridade" => $prioridade,
    ":estado" => "Aberto",
]);

header("Location: index.php");
exit;