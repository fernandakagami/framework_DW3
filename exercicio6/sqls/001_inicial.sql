CREATE DATABASE exercicio6 COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE fotos (
    id INT NOT NULL AUTO_INCREMENT ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE votos (
	nota DECIMAL(10,1) NOT NULL ,
	usuario_id INT NOT NULL ,  
	foto_id INT NOT NULL ,
    PRIMARY KEY (usuario_id, foto_id) ,
	FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ,
	FOREIGN KEY (foto_id) REFERENCES fotos(id)
)
ENGINE = InnoDB;