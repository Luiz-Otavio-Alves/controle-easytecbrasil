CREATE DATABASE IF NOT EXISTS controle-easy;
USE controle-easy;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios(
	id int(10) unsigned NOT NULL AUTO_INCREMENT,
	nome varchar(45) NOT NULL,
	empresa varchar(45) NOT NULL,
	contato int(10) unsigned NOT NULL,
	email varchar(40) NOT NULL,
    senha int(10) unsigned NOT NULL,
  CONSTRAINT pk_usuarios PRIMARY KEY(id)
)ENGINE="InnoDB";