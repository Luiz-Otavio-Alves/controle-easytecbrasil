<?php
	$banco = new mysqli("localhost", "root", "", "bd_disparo_marketing");

	if ($banco->connect_errno != 0) {
		//Nao conseguiu conectar com o banco, "!=0" é o codigo de erro
		echo "<h4> Erro ao conectar com o Banco de Dados</h4> <h5>Erro: " . $banco->connect_errno . " </h5>";
	} else {
		//O codigo "0" indica que conseguiu conectar no banco
		//echo "<h3> Acesso concedido ao banco!! </h3>";
	}

    //CADASTRA EMPRESA
    if (isset($_POST["btCadastrar"])) {
        //DADOS PARA CADASTRAR
        $nome_empresa = $_POST["nome_empresa"];
        $cnpj_empresa = $_POST["cnpj_empresa"];
        $cidade_empresa = $_POST["cidade_empresa"];
        $endereco_empresa = $_POST["endereco_empresa"];
        $telefone_empresa = $_POST["telefone_empresa"];
        $responsavel_ti_empresa = $_POST["responsavel_ti_empresa"];
        $plano_linha_chip = $_POST["plano_linha_chip"];
        $portador_chip = $_POST["portador_chip"];
        $departamento_chip = $_POST["departamento_chip"];
        $pin2_chip = $_POST["pin2_chip"];
        $puk2_chip = $_POST["puk2_chip"];
        $obs_chip = $_POST["obs_chip"];
        //INSERE NO BANCO DE DADOS
        $sql = "INSERT INTO chips VALUES (null, '$nome_empresa', '$cnpj_empresa', '$cidade_empresa', '$endereco_empresa', '$telefone_empresa', '$responsavel_ti_empresa', 
        '$plano_linha_chip', '$portador_chip', '$departamento_chip', '$pin2_chip', '$puk2_chip', '$obs_chip')";
        //CONFERE SE FOI CADASTRADO COM ÊXITO
        if(mysqli_query($banco, $sql)){
            $msg = "CHIP cadastrado com sucesso!";
        }else{
            $msg = "Erro ao cadastrar CHIP!";
        }

        $sql1 = "SELECT * FROM chips";
    }

    session_start();

    if (!isset($_SESSION["email"],$_SESSION["senha"])){ // aqui péga o valor do nome do campo da pagina de login
        echo "<script>window.location='login.php'</script>"; //caso não esteja correto ela envia para a pagina determianda
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Easytec Brasil | Dashboard</title>

    <link rel="shortcut icon" href="img/logo.png" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Importacao de Favicon-->
    <link rel="shortcut icon" href="../assets/img/favicon.ico" />
    <!--Importacao de CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <!--Importacao do Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body style="background-color:#ced4da;">
   <!--Inicio do Navbar-->
   <header>
        <nav class="navbar navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/LogoSemFundo.png" width="200" alt="Easytec Brasil" loading="Easytec Brasil" />
                </a>
            </div>
        </nav>
    </header>
	<!------------------->
    <!------------------->
    <!--Termina Navbar-->
        

    <div class="container" style="margin-top: 2%; margin-bottom: 2%;">
        
    </div>

    <!-------------------->
	<!-------------------->
    <!--Inicio do footer-->
    <footer class="text-center text-white bg-light fixed-bottom">
        <div class="text-center p-3 text-body bg-light">
            © 2022 Copyright Easytec Brasil
        </div>
    </footer>
    <!------------------->
	<!-------------------->
    <!--Importacao do JS do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>