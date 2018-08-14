CREATE DATABASE exercicio4 COLLATE 'utf8_unicode_ci';

CREATE TABLE carros (
    id INT NOT NULL AUTO_INCREMENT ,
    modelo VARCHAR(255) NOT NULL ,
    preco_de_compra DECIMAL NOT NULL ,
    preco_de_venda DECIMAL NOT NULL,
    descricao VARCHAR(255),
    PRIMARY KEY (id)
)
ENGINE = InnoDB;


modelo, preço de compra, preço de venda e descrição
