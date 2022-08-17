CREATE DATABASE IF NOT EXISTS controleeasy;
USE controleeasy;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios(
	id int(10) unsigned NOT NULL AUTO_INCREMENT,
	nome varchar(45) NOT NULL,
	empresa varchar(45) NOT NULL,
	contato varchar(15) NOT NULL,
	email varchar(40) NOT NULL,
    senha varchar(15) NOT NULL,
  CONSTRAINT pk_usuarios PRIMARY KEY(id)
)ENGINE="InnoDB";
