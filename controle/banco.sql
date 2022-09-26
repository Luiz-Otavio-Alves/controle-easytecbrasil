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

USE controleeasy;
DROP TABLE IF EXISTS empresas;
CREATE TABLE empresas(
	id_empresas INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	descricao VARCHAR(100) NOT NULL,
	cnpj VARCHAR(18) NOT NULL,
	tipo_servico VARCHAR(35) NOT NULL,
	endereco_emp VARCHAR(100) NOT NULL,
	cidade_emp VARCHAR(25) NOT NULL,
	estado_emp VARCHAR(4) NOT NULL,
	responsavel VARCHAR(50) NOT NULL,
	mail_responsavel VARCHAR(60) NOT NULL,
	tel_responsavel VARCHAR(40) NOT NULL,
	ip_pabx VARCHAR(20) NOT NULL,
	anot_emp VARCHAR(150) NOT NULL,

	CONSTRAINT pk_empresas PRIMARY KEY(id_empresas)
)ENGINE="InnoDB";