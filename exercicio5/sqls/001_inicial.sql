CREATE DATABASE exercicio5 COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) UNIQUE NOT NULL,
    senha CHAR(60) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT,
    texto VARCHAR(255) NOT NULL,
    usuario_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)
ENGINE = InnoDB;
