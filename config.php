<?php
//cria as variáveis para conexão
$host = "localhost";
$banco = "techdesk";
$usuario = "root";
$senha = "123456";

//tentar me conectar no banco
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco",
        $usuario,
        $senha
    );
} catch (PDOException $erro){
    die("Erro ao conectar com o banco: " . $erro);
}

?>