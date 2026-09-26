CREATE DATABASE IF NOT EXISTS techdesk
CHARACTER SET utf8mb4; -- permite caracteres especiais (emoji, acentos, etc)
USE techdesk;

-- criação tabela chamados
CREATE TABLE IF NOT EXISTS chamados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    solicitante VARCHAR(100) NOT NULL,
    setor VARCHAR(100) NOT NULL,
    prioridade ENUM('Baixa', 'Média', 'Alta') NOT NULL DEFAULT 'Média',
    estado ENUM('Aberto', 'Em andamento', 'Concluído') NOT NULL DEFAULT 'Aberto',
    descricao TEXT NOT NULL,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO chamados
(titulo, solicitante, setor, prioridade, estado, descricao)
VALUES
(
    'Instalação de impressora de rede',
    'Carlos Lima',
    'RH',
    'Média',
    'Em andamento',
    'Necessário instalar e configurar a impressora'
);