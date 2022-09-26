<?php
	session_start();

	$conn = new mysqli("localhost", "root", "Dodgef80206", "controleeasy");
	$sql = "SELECT * FROM usuarios WHERE email ='" .$_POST['email']."' and senha='".$_POST['senha']."'";

	$result = $conn->query($sql);

	//verifico as variáveis de usuario e senha passadas pelo formulario
	if ($result->num_rows > 0) {

		$result = $result->fetch_all(MYSQLI_ASSOC);
		  
		//define a variavel de sessão logado como true (verdadeiro)
		$_SESSION['logado'] = true;  
		$_SESSION['nome']=$result[0]['nome'];
		$_SESSION['email']=$result[0]['email'];
		$_SESSION['senha']=$result[0]['senha'];
		$_SESSION['id']=$result[0]['id'];

		header("location: index.php");
		
		if ((isset($_POST['salvar_chave'])) && ($_POST['salvar_chave']==1)) {
			//setcookie define um cookie - o tempo é definido em segundos
			setcookie("id_u", $_POST['email'] , time()+(60*60*24*365));
			setcookie("senha_u", $_POST['senha'], time()+(60*60*24*365));
		} else {
			echo("teste");
			setcookie ("id_u", "", time() - 3600);
			setcookie ("senha_u", "", time() - 3600);	
		}	
	}

//se nao aparece usuários e senha incorretos
	else {
		echo '<script text="javascript"> alert("Usuário e/ou senha incorretos");</script>';
		echo "<script>window.location='login.php'</script>";
	}
	
?>