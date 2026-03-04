-- =============================================
-- BANCO DE DADOS: loja_ecotech
-- Descrição: Banco para o projeto coletivo do 3º ano
-- Tabelas: produtos, clientes e pedidos
-- =============================================

CREATE DATABASE IF NOT EXISTS loja_ecotech CHARACTER SET utf8mb4;
USE loja_ecotech;

-- TABELA PRODUTOS
-- Armazena os itens à venda (nome, preço, estoque e descrição)
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    descricao TEXT
);

-- TABELA CLIENTES
-- Armazena os dados dos clientes cadastrados
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20)
);

-- TABELA PEDIDOS
-- Registra os pedidos realizados (vincula ao cliente)
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);

-- INSERTS DE EXEMPLO - PRODUTOS
-- Dados iniciais para testes
INSERT INTO produtos (nome, preco, estoque, descricao) VALUES 
('Notebook EcoPro', 3299.90, 12, 'Notebook sustentável i7'),
('Fone Bluetooth Pro', 189.90, 35, 'Cancelamento de ruído'),
('Smartwatch Ultra', 899.90, 8, 'Monitoramento de saúde'),
('Teclado Mecânico RGB', 279.90, 20, 'Switches blue');

-- INSERTS DE EXEMPLO - CLIENTES
INSERT INTO clientes (nome, email, telefone) VALUES 
('Ana Silva', 'ana.silva@email.com', '51998765432'),
('Carlos Mendes', 'carlos.m@email.com', '51987654321');

-- INSERTS DE EXEMPLO - PEDIDOS
INSERT INTO pedidos (cliente_id, total) VALUES 
(1, 3489.80),
(2, 189.90);