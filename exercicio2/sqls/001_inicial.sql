CREATE DATABASE exercicio2 COLLATE 'utf8mb4_unicode_ci';

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT ,
    mesa VARCHAR(255) NOT NULL ,
    quantidade INT(55) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;
