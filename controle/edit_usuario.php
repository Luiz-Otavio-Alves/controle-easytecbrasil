<?php

$msg = "";

    $banco = new mysqli("localhost", "root", "", "controleeasy");

    if ($banco->connect_errno != 0) 
    {
        echo "<h4> Erro ao conectar com o Banco de Dados</h4> <h5>Erro: " . $banco->connect_errno . "</h5>";
    } else {
        //echo "<h3> Acesso concedido ao banco!! </h3>";
    }

    if(isset($_GET["id_usuario"]))
    {
        $var_cod = $_GET["id_usuario"];
        $var_cod_int = intval($var_cod);
    }

    //Atualiza Cliente
    if (isset($_POST["btCadastrar"])) 
    {
        echo $var_cod_int;
        $nome_usuario = $_POST["nome"];
        $nome_empresa = $_POST["empresa"];
        $contato_usuario = $_POST["contato"];
        $email_usuario = $_POST["email"];
        $senha_usuario = $_POST["senha"];

        $sql1 = "UPDATE usuarios SET nome = '$nome_usuario', 
                                    empresa = '$nome_empresa', 
                                    contato = '$contato_usuario', 
                                    email = '$email_usuario', 
                                    senha = '$senha_usuario'
                WHERE id = $var_cod_int";

        if(mysqli_query($banco, $sql1)){
            $msg = "Usuário atualizado com sucesso!";
        }else{
            $msg = "Erro ao atualizar usuário!";
        }  
    }

    $sql = "SELECT * FROM usuarios WHERE id = $var_cod_int";
    $usuario = mysqli_query($banco, $sql);
    $usuarios = mysqli_fetch_array($usuario);

    session_start();

    if (!isset($_SESSION["email"],$_SESSION["senha"])){ // aqui péga o valor do nome do campo da pagina de login
        echo "<script>window.location='../login.php'</script>"; //caso não esteja correto ela envia para a pagina determianda
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

    <div class="container" style="margin-top: 2%; margin-bottom: 2%;">
    <main>
    <div class="container section row">
        <h5>Edição de usuários</h5>

         <!--Pop-UP de aviso de exclusão-->
         <div id="popup2" class="popup2 container card modal grey darken-4">
                <div class="row">
                    <div class="card-content white-text">
                        <span class="card-title"><?php echo $msg; ?></span>
                    </div>      
                </div>
        </div>
        <!--Termina Pop-UP-->

        <!---inicia formulario--->
        <form method="POST" action="" class="card bg-white col-lg-12" style="margin-top:2%; padding:4%;">
            <div class="row">
                <div class="form-outline mb-4 mx-4 col">
                    <label class="form-label" for="nome">Nome Completo</label>
                    <input type="text" class="form-control form-control-lg required" name="nome" value="<?php echo $usuarios['nome']; ?>"/>
                </div>
                <div class="form-group mb-4 mx-4 col">
                    <label for="empresa">Empresa</label>
                    <select class="form-control" name="empresa" id="empresa">
                        <option><?php echo $usuarios['empresa']; ?></option>
                        <option>EASYTEC BRASIL</option>
                    </select>
                </div>
                <div class="form-outline mb-4 mx-4 col">
                    <label class="form-label" for="contato">Telefone</label>
                    <input type="text" class="form-control form-control-lg" name="contato" placeholder="exemplo: (00)0000-0000" value="<?php echo $usuarios['contato']; ?>"/>
                </div>
            </div>    
            <div class="row">
                <div class="form-outline mb-4 mx-4 col">
                    <label class="form-label" for="email">E-mail</label>
                    <input type="email" class="form-control form-control-lg" name="email" placeholder="exemplo@exemplo.com.br" value="<?php echo $usuarios['email']; ?>"/>
                </div>
                <div class="form-outline mb-4 mx-4 col">
                    <label class="form-label" for="senha">Senha</label>
                    <input type="password" class="form-control form-control-lg" name="senha" value="<?php echo $usuarios['senha']; ?>"/>
                </div>
            </div>

            <div class="row">
                <a class="btn btn-dark btn-lg ml-4 mt-4 px-5" href="usuarios.php">Voltar</a>
                <a class="mx-4 mt-4"><button class="btn btn-dark btn-lg" type="submit" name="btCadastrar" value="Salvar">Salvar 
                    <i class="material-icons right">add_circle_outline</i></button></a>
            </div>
        </form>
        <!---termina formulario--->
    </div>
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

