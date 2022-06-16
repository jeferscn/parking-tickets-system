<?php
	/*
	CREATE TABLE cliente (id INT(4) AUTO_INCREMENT, nome VARCHAR(30), idade INT(3), sexo CHAR(1), telefone VARCHAR(15), PRIMARY KEY (id));
	CREATE TABLE funcionario (id INT(4) AUTO_INCREMENT, nome VARCHAR(30), idade INT(3), sexo CHAR(1), telefone VARCHAR(15), email varchar(40), ctps int(8), cep int(8), endereco VARCHAR(40), bairro VARCHAR(30), cidade VARCHAR(30), estado VARCHAR(2), PRIMARY KEY (id));
	CREATE TABLE usuario (id INT(4) AUTO_INCREMENT, nome VARCHAR(30), login VARCHAR(30), senha VARCHAR(80), nivel varchar(15), PRIMARY KEY (id));
	CREATE TABLE cliente (id INT(20) AUTO_INCREMENT, nome VARCHAR(50), documento VARCHAR(30), telefone varchar(15), tipo_cliente varchar(20), PRIMARY KEY (id));
	
	CREATE TABLE anuncio (id_anuncio INT(4) AUTO_INCREMENT, descricao VARCHAR(200), categoria VARCHAR(100), preco VARCHAR(10), status VARCHAR(40), PRIMARY KEY (id_anuncio));
	CREATE TABLE categorias (id_categoria INT(4) AUTO_INCREMENT, nome_categoria VARCHAR(50), PRIMARY KEY (id_categoria));
	
	Adicionar chave estrangeira:
	ALTER TABLE anuncios ADD CONSTRAINT usuario FOREIGN KEY (fk_usuario) REFERENCES usuario(id_usuario);

	Alterar o nome de uma coluna e/ou tipo de dados :
	ALTER TABLE anuncio CHANGE preco preco DECIMAL(7,2);

	Alterar o nome de uma tabela:
	RENAME TABLE categorias to categoria;
	
	Excluir uma coluna de uma tabela:
	ALTER TABLE anuncio DROP COLUMN data;

	Alterar dados de uma coluna por ID:
	UPDATE anuncio SET status='aguardando aprovação' where status='anúncio ativo';

	Adicionar coluna em uma tabela:
	ALTER TABLE anuncio ADD fk_id_usuario int(4) AFTER preco;

	Remover todas as linhas que tiver x dado:
	DELETE FROM anuncio where fk_id_usuario='0';

	Selecionar tudo de anúncio, o usuario.id_usuario e 
	SELECT anuncio.*, usuario.id_usuario, usuario.telefone from anuncio INNER JOIN usuario WHERE usuario.id_usuario='3';
	*/


	$con = mysqli_connect('localhost','root','');
	$db = mysqli_select_db($con, 'estacionamento');
	mysqli_set_charset($con, "utf8");
	
	if( !$con || !$db )
	{
		echo "<pre>";
		echo mysqli_error($con);
		echo "</pre>";
	}
?>