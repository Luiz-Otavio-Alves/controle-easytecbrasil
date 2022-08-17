<?php
	$banco = new mysqli("localhost", "root", "", "controleeasy");

	if ($banco->connect_errno != 0) {
		//Nao conseguiu conectar com o banco, "!=0" é o codigo de erro
		echo "<h4> Erro ao conectar com o Banco de Dados</h4> <h5>Erro: " . $banco->connect_errno . " </h5>";
	} else {
		//O codigo "0" indica que conseguiu conectar no banco
		//echo "<h3> Acesso concedido ao banco!! </h3>";
	}

    //Exclui Usuario Cadastrado
    if (isset($_GET["id_u"])) {
        $codigo_cliente = $_GET["ud"];
        $var_chip_d = intval($codigo_cliente);

        $sql = "DELETE FROM clientes WHERE codigo_chip = $var_chip_d";        
        mysqli_query($banco, $sql);
    }  

    //CONFIRMA SESSÃO PARA AUTORIZAR ACESSO A PAGINA
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
    <title>Easytec Brasil | Usuários</title>

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
    <!--Importacao de icones do bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">        
</head>

<body style="background-color:#ced4da;">
    <!--Inicio do Navbar-->
    <header>
        <nav class="navbar navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/LogoSemFundo.png" width="200" alt="Easytec Brasil"
                        loading="Easytec Brasil" />
                </a>
            </div>
            <ul class="nav justify-content-end">
                <li class="nav-item relatorio">
                    <a class="nav-link text-dark" href="../index.php" role="button" aria-expanded="false">Voltar</a>
                </li>
            </ul>
        </nav>
    </header>
    <!------------------->
    <!------------------->
    <!--Termina Navbar-->


    <div class="container bg-white" style="margin-top: 2%; margin-bottom: 2%; border-radius:20px;">
        <main>
            <!--inicia campo de pesquisa-->
            <form method="post" action="#" class="" style="margin-top:2%; border-radius:8%;">
                <div class="col">
                    <i class="bi-search"></i>
                    <label for="buscar">Buscar</label>
                    <input type="text" class="form-control " placeholder="Nome do Usuário" name="campo_pesquisa">
                </div>
            </form>
            <!--termina campo de pesquisa-->

            <!--Pop-UP de aviso de exclusão-->
            <!--div id="popup" class="popup container card modal grey darken-4">
                <div class="row">
                    <div class="card-content white-text">
                        <span class="card-title">Aviso e Confirmação</span>
                        <p>Tem certeza de que realmente deseja EXCLUIR este CHIP?</p>
                    </div>
                    <div class="card-action">
                        <button class="waves-effect waves-light btn">
                            <a class="white-text" href="javascript: excluirItem();">Sim, EXCLUIR</a></button>
                        <button class="waves-effect waves-light btn">
                            <a class="white-text" href="javascript: fechar();">CANCELAR</a></button>
                    </div>
                </div>
            </div>
            <Termina Pop-UP>

            <Pop-UP de aviso de exclusão>
            <div id="popup1" class="popup container card modal grey darken-4">
                <div class="row">
                    <div class="card-content white-text">
                        <span class="card-title">ITEM excluído com sucesso!</span>
                    </div>
                    <div class="card-action">
                        <button class="waves-effect waves-light btn">
                            <a class="white-text" href="javascript: fechar();">FECHAR</a></button>
                    </div>
                </div>
            </div>
            <Termina Pop-UP-->

            <!--inicia botoes-->
            <a class="btn btn-dark" href="../index.php" style="margin: 2%">Voltar</a>
            <a class="btn btn-dark" href="cadastra_usuario.php" style="margin: 2%">Cadastrar Usuário</a>
            <!--termina botoes-->
    </div>

    <?php
            echo "<div class='section  bg-white' style='margin-left: 6%; margin-right: 6%; margin-bottom: 4%; border-radius:5px;'>";
                
            $sql = "SELECT * FROM usuarios";
            
            /*Busca no banco o CHIP pesquisado*/
            if(isset($_POST["campo_pesquisa"])){
                $valor = $_POST["campo_pesquisa"];
                $sql = "SELECT * FROM usuarios WHERE nome LIKE '%$valor%'";
            }	
                
            $usuarios = mysqli_query($banco, $sql);
            
            /*Inicia Tabela de CHIPS*/
            echo "<table class='table table-striped table-hover'>";
                echo "<tr class='thead-dark'>
                        <th class=''>ID</th>
                        <th class=''>Nome</th>
                        <th class=''>Empresa</th>
                        <th class=''>Contato</th>
                        <th class=''>E-mail</th>
                        <th class=''>Senha</th>
                        <th class=''>--</th></tr>";

                while($usuario = mysqli_fetch_array($usuarios)){
                    echo "<tr><th class=''>".$usuario["id"]."</th>
                            <td class=''><a style='color:brown;' href='edit_usuario.php?id_usuario=".$usuario["id"]."'>".$usuario["nome"]."</a></td>
                            <td class=''>".$usuario["empresa"]."</td>
                            <td class=''>".$usuario["contato"]."</td>
                            <td class=''>".$usuario["email"]."</td>
                            <td class=''><input type='password' class='form-control' value='".$usuario["senha"]."' disabled/></td>
                            <td class=''><a style='color:brown;' href='javascript: abrir();'><i class='material-icons'>delete</i></a></td></tr>";
                        }	
            echo "</table>";
            echo "</div>";
            /*Termina a tabela de CHIPS*/  
        ?>
    </main>
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