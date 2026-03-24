

CREATE DATABASE loja_eletronica;
USE loja_eletronica;

CREATE TABLE fornecedores (
    id_fornecedor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cidade VARCHAR(100)
);

CREATE TABLE pecas (
    id_peca INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2),
    quantidade INT,
    id_fornecedor INT,
    CONSTRAINT fk_fornecedor
    FOREIGN KEY (id_fornecedor)
    REFERENCES fornecedores(id_fornecedor)
);
