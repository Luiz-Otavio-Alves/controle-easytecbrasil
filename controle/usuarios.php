<?php
	$banco = new mysqli("localhost", "root", "Dodgef80206", "controleeasy");

	if ($banco->connect_errno != 0) {
		//Nao conseguiu conectar com o banco, "!=0" é o codigo de erro
		echo "<h4> Erro ao conectar com o Banco de Dados</h4> <h5>Erro: " . $banco->connect_errno . " </h5>";
	} else {
		//O codigo "0" indica que conseguiu conectar no banco
	}

    //Exclui usuario cadastrado
    if(isset($_REQUEST["id_excluir"])){
        $var_cod_int = $_REQUEST["id_excluir"];
        $sql2 = "DELETE FROM usuarios WHERE id = $var_cod_int";
        mysqli_query($banco, $sql2);
    }

    //CONFIRMA SESSÃO PARA AUTORIZAR ACESSO A PAGINA
    session_start();
    if (!isset($_SESSION["email"],$_SESSION["senha"])){ // aqui pega o valor do nome do campo da pagina de login
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

<body>
    <!--Inicio do Navbar-->
    <header>
        <nav class="navbar">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil" loading="Easytec Brasil" />
                    </a>
                    <div class="dropdown nav justify-content-end">
                        <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Gerenciamento
                        </a>
                        <a class="nav-link text-white relatorio" href="deslogando.php" role="button" aria-expanded="false">Sair <i class="bi bi-box-arrow-right"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../index.php">Empresas</a>
                            <a class="dropdown-item" href="equipamentos.php">Equipamentos</a>
                        </div>
                    </div>
                </div>
            </nav>
    </header>
    <!------------------->
    <!------------------->
    <!--Termina Navbar-->

    
    <div class="container" style="margin-top: 2%; margin-bottom: 2%; ">
        <h3>Usuários</h3>
        <div class="row">
            <!--inicia campo de pesquisa-->
            <form method="post" action="#" class="bg-light col-lg-6 busca-user" style="margin-left: 2%; padding:1%;">
                <div class="col">
                    <i class="bi-search"></i>
                    <label for="buscar">Buscar</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Nome do usuário, contato ou email" name="campo_pesquisa">
                </div>    
            </form>
            <!--termina campo de pesquisa-->    
            <div class="col-lg-2" style="padding:1%; margin-left:5%;">
                <!--inicia botoes-->
                <a class="btn btn-secondary bg-success mb-3" href="cadastra_usuario.php" style="margin: 1%">Cadastrar Usuário</a>
                <a class="btn btn-secondary px-5 mb-2" href="../index.php" style="margin: 1%">Voltar</a>
                <!--termina botoes-->
            </div>
        </div>    
    </div>        

    <?php
            echo "<div class='container bg-white' style='margin-bottom: 4%; border-radius:5px;'>";
                
            $sql = "SELECT * FROM usuarios";
            
            //Busca no campo de pesquisa por usuário, email ou contato
            if(isset($_POST["campo_pesquisa"])){
                $valor = $_POST["campo_pesquisa"];
                $sql = "SELECT * 
                        FROM usuarios 
                        WHERE (nome LIKE '%$valor%') OR (email LIKE '%$valor%') OR (contato LIKE '%$valor%')";
            }	
                
            $usuarios = mysqli_query($banco, $sql);
            
            /*Inicia Tabela de CHIPS*/
            echo "<table class='table table-striped table-hover' id='estilo-table'>";
                echo "<tr class='thead'>
                        <th class=''>ID</th>
                        <th class=''>Nome</th>
                        <th class=''>Empresa</th>
                        <th class=''>Contato</th>
                        <th class=''>E-mail</th>
                        <th class=''>--</th>
                        <th class=''>--</th></tr>";

                while($usuario = mysqli_fetch_array($usuarios)){
                    echo "<tr><th class=''>".$usuario["id"]."</th>
                            <td class=''>".$usuario["nome"]."</a></td>
                            <td class=''>".$usuario["empresa"]."</td>
                            <td class=''>".$usuario["contato"]."</td>
                            <td class=''>".$usuario["email"]."</td>
                            <td class=''><a href='edit_usuario.php?id_usuario=".$usuario["id"]."'><i class='material-icons'>edit</i></a></td>
                            <td><a data-confirm='Tem certeza que deseja excluir este usuário?' class='text-danger' 
                            href='usuarios.php?id_excluir=".$usuario["id"]."'><i class='material-icons'>delete</i></a></td></tr>";
                        }	
            echo "</table>";
            echo "</div>";
            /*Termina a tabela de USUARIOS*/  
    ?>

    <!-------------------->
	<!-------------------->
    <!--Inicio do footer-->
    <footer class="text-dark fixed-bottom">
        <div class="text-center p-2">
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
    <script src="../funcoes.js"></script>
</body>

</html>