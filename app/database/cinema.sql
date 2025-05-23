-- Apagar todas as configuração do banco que tiver, para roda novamente do inicio
drop database if exists cinema;

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS cinema;
USE cinema;

-- Tabela de categorias de filmes
CREATE TABLE IF NOT EXISTS categoria_filmes
(
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_categoria ENUM ('Ação', 'Aventura', 'Comédia', 'Drama', 'Ficção Científica', 'Terror', 'Romance', 'Animação'),
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at     TIMESTAMP NULL
);

-- Tabela de filmes
CREATE TABLE IF NOT EXISTS filmes
(
    id                 INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_filme_id INT UNSIGNED,
    nome_filme         VARCHAR(100),
    descricao_filme    VARCHAR(500),
    duracao_filme      TIME,
    created_at         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at         TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at         TIMESTAMP NULL,
    FOREIGN KEY (categoria_filme_id) REFERENCES categoria_filmes (id)
    );

-- Tabela de salas
CREATE TABLE IF NOT EXISTS salas
(
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_sala       ENUM ('A', 'B', 'C'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Tabela de sessões de filmes
CREATE TABLE IF NOT EXISTS sessoes_filmes
(
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filme_id   INT UNSIGNED,
    sala_id    INT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (filme_id) REFERENCES filmes (id),
    FOREIGN KEY (sala_id) REFERENCES salas (id)
);

-- Tabela de horários das sessões
CREATE TABLE IF NOT EXISTS horario_sessoes
(
    id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sessoes_filmes_id INT UNSIGNED,
    tempo_sessoes     TIME,
    created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at        TIMESTAMP NULL,
    FOREIGN KEY (sessoes_filmes_id) REFERENCES sessoes_filmes (id)
);

-- Tabela de cadeiras
CREATE TABLE IF NOT EXISTS cadeiras
(
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sala_id        INT UNSIGNED,
    numero_cadeira INT,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at     TIMESTAMP NULL,
    FOREIGN KEY (sala_id) REFERENCES salas (id)
);

-- Tabela de formas de pagamento
CREATE TABLE IF NOT EXISTS forma_pagamento
(
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pagamento  ENUM ('dinheiro', 'cartao debito', 'cartao credito', 'bitcoin'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Tabela de ingressos (vendas)
CREATE TABLE IF NOT EXISTS ingressos
(
    id                 INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sessao_id          INT UNSIGNED,
    cadeira_id         INT UNSIGNED,
    forma_pagamento_id INT UNSIGNED,
    preco              DECIMAL(6, 2),
    status             ENUM ('pago', 'cancelado') DEFAULT 'pago',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
    FOREIGN KEY (sessao_id) REFERENCES sessoes_filmes (id),
    FOREIGN KEY (cadeira_id) REFERENCES cadeiras (id),
    FOREIGN KEY (forma_pagamento_id) REFERENCES forma_pagamento (id)
);

-- Inserindo categorias de filmes
INSERT INTO categoria_filmes (nome_categoria)
VALUES ('Ação'),
       ('Comédia');

-- Inserindo filmes (usando os IDs das categorias 1 e 2)
INSERT INTO filmes (categoria_filme_id, nome_filme, descricao_filme, duracao_filme)
VALUES (1, 'Missão Impossível', 'Filme de ação com espionagem.', '02:10:00'),
       (2, 'O Máskara', 'Comédia com Jim Carrey.', '01:45:00');

-- Inserindo salas
INSERT INTO salas (nome_sala)
VALUES ('A'),
       ('B');

-- Inserindo sessões de filmes (filmes 1 e 2, salas 1 e 2)
INSERT INTO sessoes_filmes (filme_id, sala_id)
VALUES (1, 1),
       (2, 2);

-- Inserindo horários das sessões (para sessões 1 e 2)
INSERT INTO horario_sessoes (sessoes_filmes_id, tempo_sessoes)
VALUES (1, '18:30:00'),
       (2, '20:00:00');

-- Inserindo cadeiras (sala 1 e 2)
INSERT INTO cadeiras (sala_id, numero_cadeira)
VALUES (1, 1),
       (2, 2);

-- Inserindo formas de pagamento
INSERT INTO forma_pagamento (pagamento)
VALUES ('dinheiro'),
       ('cartao credito');