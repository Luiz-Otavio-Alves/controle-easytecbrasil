<?php 
	$hostname = "localhost";
	$user = "root";
	$password = "Dodgef80206";
	$database = "controleeasy";
	
	$conn = mysqli_connect($hostname, $user, $password, $database);
	
    if ($conexao->connect_errno != 0) {
		//Nao conseguiu conectar com o banco, "!=0" é o codigo de erro
		echo "<h4> Erro ao conectar com o Banco de Dados</h4> <h5>Erro: " . $banco->connect_errno . " </h5>";
	} else {
		//O codigo "0" indica que conseguiu conectar no banco
	}
?>