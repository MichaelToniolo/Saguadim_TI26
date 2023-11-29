CREATE DATABASE saguadim;
USE saguadim;

-- CRIAÇÃO DA TABELA DE USUARIOS
CREATE TABLE usuarios(
    usu_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usu_login VARCHAR(20) NOT NULL,
    usu_senha VARCHAR(50) NOT NULL,
    usu_status CHAR(1) NOT NULL,
    usu_key VARCHAR(10) NOT NULL,
    usu_email VARCHAR(100) NOT NULL
);

-- CRIAÇÃO DA TELA DE CLIENTE
CREATE TABLE clientes(
    cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cli_nome VARCHAR(50) NOT NULL,
    cli_email VARCHAR(100) NOT NULL,
    cli_telefone BIGINT NOT NULL,
    cli_cpf VARCHAR(20) NOT NULL,
    cli_curso VARCHAR(50) NOT NULL,
    cli_sala INT NOT NULL,
    cli_status CHAR(1) NOT NULL,
    cli_saldo FLOAT(10,2) NOT NULL
);

CREATE TABLE produtos(
    pro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pro_nome VARCHAR(100) NOT NULL,
    pro_descricao VARCHAR(150) NOT NULL,
    pro_custo DECIMAL(10,2) NOT NULL,
    pro_preco DECIMAL(10,2) NOT NULL,
    pro_quantidade INT NOT NULL,
    pro_validade DATE NOT NULL,
    fk_for_id INT NOT NULL,
    pro_status CHAR(1)
);

CREATE TABLE encomendas(
    enc_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    enc_emissao DATETIME NOT NULL,
    enc_entrega DATETIME NOT NULL,
    fk_pro_id INT NOT NULL,
    fk_cli_id INT NOT NULL,
    fk_ven_id INT NOT NULL,
    enc_status CHAR(1)
);

CREATE TABLE vendas(
    ven_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ven_data DATETIME NOT NULL,
    fk_cli_id INT NOT NULL,
    ven_total DECIMAL (10,2) NOT NULL,
    fk_iv_codigo VARCHAR(50) NOT NULL
);

-- OLHAR COM CALMA E PRECISÃO ANALÍTICA
CREATE TABLE item_venda(
    iv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    iv_quantidade INT NOT NULL,
    iv_total DECIMAL(10,2) NOT NULL,
    iv_codigo VARCHAR(50) NOT NULL ,
    fk_pro_id INT NOT NULL
);

CREATE TABLE tab_log(
    tab_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tab_query TEXT NOT NULL,
    tab_data DATETIME NOT NULL
);

CREATE TABLE fornecedores(
    for_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    for_nome VARCHAR(50) NOT NULL
);

-- CHAVES ESTRANGEIRAS
-- CHAVE PRODUTOS
ALTER TABLE produtos ADD CONSTRAINT fk_for_id_pro 
    FOREIGN KEY (fk_for_id) REFERENCES fornecedores(for_id);

-- CHAVE ENCOMENDAS
ALTER TABLE encomendas ADD CONSTRAINT fk_pro_id_enc
    FOREIGN KEY (fk_pro_id) REFERENCES produtos(pro_id);
ALTER TABLE encomendas ADD CONSTRAINT fk_cli_id_enc
    FOREIGN KEY (fk_cli_id) REFERENCES clientes(cli_id);
ALTER TABLE encomendas ADD CONSTRAINT fk_ven_id_ven
    FOREIGN KEY (fk_ven_id) REFERENCES vendas(ven_id);

-- CHAVE VENDAS
ALTER TABLE vendas ADD CONSTRAINT fk_cli_id_ven 
    FOREIGN KEY (fk_cli_id) REFERENCES clientes(cli_id);


-- CHAVES ITEM VENDAS
ALTER TABLE item_venda ADD CONSTRAINT fk_pro_id_iv
    FOREIGN KEY (fk_pro_id) REFERENCES produtos(pro_id);