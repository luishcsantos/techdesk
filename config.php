<?php
// Cria as variáveis para conexão
$host = "localhost:3316";
$banco = "techdesk";
$usuario = "root";
$senha = "123456";

// Tentar conectar no banco
try {
    $connect = new PDO(
        "mysql:host=$host;dbname=$banco",
        $usuario,
        $senha
    );
} catch (PDOException $erro) {
    die("Erro ao conectar com o banco: " . $erro);
}
?>