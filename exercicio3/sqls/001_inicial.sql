CREATE DATABASE exercicio3 COLLATE 'utf8_unicode_ci';

CREATE TABLE pedidos (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
    mesa VARCHAR(255) NOT NULL ,
    quantidade INT NOT NULL
)
ENGINE = InnoDB;
