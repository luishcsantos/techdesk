<?php
require "config.php"; //Carrega o arquivo config.php. 
//Que é o que cria a conexao com o banco

//Buscar todos os chamados cadastrados no banco
$sql = "SELECT * FROM chamados ORDER by id DESC"; 
//pegue todos os dados da tabela chamado, e ordene pelo campo id

//Executar o select e guardar os registros encontrados
$chamados = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//$pdo = é a conexao com o banco criada em config.php
//->query($sql) = executa o comando sql criado
//->fetchAll = pega todos os registros encontrados pelo SELECT
//PDO::FETCH_ASSOC = fazer com que cada registro seja organizado usando o nome das colunas

?>

<!DOCTYPE html> 
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <!-- permite exibir corretamente símbolos e caracteres especiais -->
    <title>TechDesk</title>
</head>

<body>
    <h1>Central de Chamados</h1>
    <a href="novo.php"><button>Novo Chamado</button></a>
    <br><br>

    <table border="1"><!-- inicia uma tabela com borda simples -->
        <tr> <!-- cria uma linha na tabela -->
            <!-- cria um cabeçalho -->
            <th>ID</th> 
            <th>Título</th>
            <th>Solicitante</th>
            <th>Setor</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th>Opções</th>
        </tr>
        <!-- estrutura de repetição: foreach -->
        <?php foreach($chamados as $chamado): ?>
          <!-- para cada chamado encontrado, ele guarda temporariamente os dados em chamado -->
        <tr>
            <td><?= $chamado["id"] ?></td>
            <td><?= $chamado["titulo"] ?></td>
            <td><?= $chamado["solicitante"] ?></td>
            <td><?= $chamado["setor"] ?></td>
            <td><?= $chamado["prioridade"] ?></td>
            <td><?= $chamado["estado"] ?></td>
            <td>
                <a href="ver.php?id=<?= $chamado["id"]?>"><button>Ver</button></a> |
                <a href="editar.php?id=<?= $chamado["id"]?>"><button>Editar</button></a> |
                <a href="excluir.php?id=<?= $chamado["id"]?>"><button>Excluir</button></a>
            </td>
        </tr>

        <?php endforeach; ?> <!-- finaliza o foreach -->

    </table>

</body>

</html>