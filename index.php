<?php
	$banco = new mysqli("localhost", "root", "", "controleeasy");

	if ($banco->connect_errno != 0) {
		//Nao conseguiu conectar com o banco, "!=0" é o codigo de erro
		echo "<h4> Erro ao conectar com o Banco de Dados</h4> <h5>Erro: " . $banco->connect_errno . " </h5>";
	} else {
		//O codigo "0" indica que conseguiu conectar no banco
		//echo "<h3> Acesso concedido ao banco!! </h3>";
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
    <title>Easytec Brasil | Home</title>

    <link rel="shortcut icon" href="img/favicon.ico" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Importacao de Favicon-->
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <!--Importacao de CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
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
                        <img src="assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil" loading="Easytec Brasil" />
                    </a>
                    <div class="dropdown nav justify-content-end">
                        <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Gerenciamento
                        </a>
                        <a class="nav-link text-white" href="deslogando.php" role="button" aria-expanded="false">Sair 
                        <i class="bi bi-box-arrow-right"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="controle/usuarios.php">Usuários</a>
                            <a class="dropdown-item" href="#">Equipamentos</a>
                        </div>
                    </div>        
                </div>
                
            </nav>
    </header>
    <!------------------->
    <!------------------->
    <!--Termina Navbar-->

    
    <div class="container" style="margin-top: 2%; margin-bottom: 2%; ">
        <br>
        <div class="row">
            
            <!--inicia campo de pesquisa-->
            <form method="post" action="#" class="bg-light col-lg-6 busca-user" style="margin-left: 2%; padding:1%;">
                <div class="col">
                    <i class="bi-search"></i>
                    <label for="buscar">Buscar</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Pesquise pelo nome, serviço, IP ou cidade" name="campo_pesquisa">
                </div>    
            </form>
            <!--termina campo de pesquisa-->    
            <div class="col-lg-4" style="padding-bottom: 6%; margin-left:5%;">
                <!--inicia botoes-->
                <a class="btn btn-secondary" href="controle/cadastro_empresas.php" style="margin: 1%;">Cadastrar <i class="bi bi-plus-square"></i></a>
                <!--termina botoes-->
            </div>
        </div>    
    </div>        

    <?php
            echo "<div class='section bg-white' style='margin-left: 4%; margin-right: 4%; margin-bottom: 2%;'>";
                
            $sql = "SELECT * FROM empresas";
            
            /*Busca no banco o CHIP pesquisado*/
            if(isset($_POST["campo_pesquisa"])){
                $valor = $_POST["campo_pesquisa"];
                $sql = "SELECT * FROM empresas WHERE nome_emp LIKE '%$valor%' OR ip_pabx LIKE '%$valor%'
                        OR cidade_emp LIKE '%$valor%' OR tipo_servico LIKE '%$valor%' OR estado_emp LIKE '%$valor%'";
            }	
                
            $empresas = mysqli_query($banco, $sql);
            
            /*Inicia Tabela de CHIPS*/
            echo "<table class='table table-striped table-hover table-bordered' id='estilo-table'>";
                echo "<tr class='thead'>
                        <th class=''>ID</th>
                        <th class=''>Descrição</th>
                        <th class=''>CNPJ</th>
                        <th class=''>Serviço</th>
                        <th class=''>IP Pabx</th>
                        <th class=''>Responsável</th>
                        <th class=''>Contato</th>
                        <th class=''>Cidade</th>
                        <th class=''>UF</th>
                        <th class=''>--</th></tr>";

                while($empresa = mysqli_fetch_array($empresas)){
                    echo "<tr><th class=''>".$empresa["id_empresas"]."</th>
                            <td class=''><a class='cor-link' href='controle/edit_empresa.php?id_empresa=".$empresa["id_empresas"]."'>".$empresa["nome_emp"]."</a></td>
                            <td class=''>".$empresa["cnpj"]."</td>
                            <td class=''>".$empresa["tipo_servico"]."</td>
                            <td class=''><a class='cor-link' href='https://".$empresa["ip_pabx"]."'>".$empresa["ip_pabx"]."</a></td>
                            <td class=''>".$empresa["responsavel"]."</td>
                            <td class=''>".$empresa["tel_responsavel"]."</td>
                            <td class=''>".$empresa["cidade_emp"]."</td>
                            <td class=''>".$empresa["estado_emp"]."</td>
                            <td class=''><a class='cor-link' href=''><i class='material-icons'>delete</i></a></td></tr>";
                        }	
            echo "</table>";
            echo "</div>";
            /*Termina a tabela de CHIPS*/  
    ?>

    <!-------------------->
	<!-------------------->
    <!--Inicio do footer-->
    <footer class="text-white fixed-bottom">
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
</body>

</html>