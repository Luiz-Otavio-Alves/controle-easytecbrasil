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
	password_pabx VARCHAR(60) NOT NULL,////////////////////
	ip_mikrotik VARCHAR(20) NOT NULL,//////////////////////
	password_mikrotik VARCHAR(60) NOT NULL,////////////////
	cod_ligacao INT(4) NOT NULL,///////////////////////////
	num_entrada VARCHAR(70) NOT NULL,//////////////////////
	num_saida VARCHAR(70) NOT NULL,////////////////////////
	anot_emp VARCHAR(150) NOT NULL,

	CONSTRAINT pk_empresas PRIMARY KEY(id_empresas)
)ENGINE="InnoDB";

USE controleeasy;
DROP TABLE IF EXISTS equipamentos;
CREATE TABLE equipamentos(
	id_equipamentos INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	marca_equip VARCHAR(100) NOT NULL,
	modelo_equip VARCHAR(100) NOT NULL,
	descricao_equip VARCHAR(150) NOT NULL,
	mac_addr_equip VARCHAR(40) NOT NULL,
	n_serie_equip VARCHAR(80) NOT NULL,
	patrimonio_equip VARCHAR(30) NOT NULL,
	anotacoes_equip VARCHAR(150) NOT NULL, 
	
	CONSTRAINT pk_equipamentos PRIMARY KEY(id_equipamentos)
)ENGINE="InnoDB";

USE controleeasy;
DROP TABLE IF EXISTS equipamentos_emp;
CREATE TABLE equipamentos_emp(
	id_equipamentos_emp INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	marca_equip_emp VARCHAR(100) NOT NULL,
	modelo_equip_emp VARCHAR(100) NOT NULL,
	descricao_equip_emp VARCHAR(150) NOT NULL,
	mac_addr_equip_emp VARCHAR(40) NOT NULL,
	n_serie_equip_emp VARCHAR(80) NOT NULL,
	patrimonio_equip_emp VARCHAR(30) NOT NULL,
	anotacoes_equip_emp VARCHAR(150) NOT NULL, 
	
	CONSTRAINT pk_equipamentos_emp PRIMARY KEY(id_equipamentos_emp)
)ENGINE="InnoDB";