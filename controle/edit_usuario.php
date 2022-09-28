<?php
    include_once("conexao.php");
    $mensagem = "";

    /////////Pega ID do usuário clicado na página usuarios.php////////////////////////////////////
    if(isset($_REQUEST["id_usuario"]))//Verifica se foi clicado onde pega id_usario
    {
        $var_cod = $_REQUEST["id_usuario"];
        $var_cod_int = intval($var_cod); //Passa o valor pra variável
    }
    /////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////
    //////Atualiza informações do usuário/////////////////////////////////////////////////////////
    if (isset($_POST["btAtualizar"])) 
    {
        $nome_usuario = $_POST["nome"];
        $nome_empresa = $_POST["empresa"];
        $contato_usuario = $_POST["contato"];
        $email_usuario = $_POST["email"];
        $senha_usuario = md5($_POST["senha"]);

        $sql1 = "UPDATE usuarios SET nome = '$nome_usuario', 
                                    empresa = '$nome_empresa', 
                                    contato = '$contato_usuario', 
                                    email = '$email_usuario', 
                                    senha = '$senha_usuario'
                WHERE id = $var_cod_int";

        if(mysqli_query($conn, $sql1)){
            $mensagem = "Informações atualizadas com sucesso!";
            echo '<script type="text/javascript">
                        alert("Informações atualizadas com sucesso");
                  </script>'; 
            echo "<script>window.location='usuarios.php'</script>";       
        }else{
            $mensagem = "Erro ao atualizar informações do usuário!";
        }  
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////Consulta informações do usuário do ID clicado//////////////////////////////////
    $sql = "SELECT * FROM usuarios WHERE id = $var_cod_int"; //Consulta informações do usuário
    $usuario = mysqli_query($conn, $sql);
    $usuarios = mysqli_fetch_array($usuario);
    //////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////
    /////Inicia a sessão e verifica se o usuário tem permissão para acessar esta página/////////////
    session_start();

    if (!isset($_SESSION["email"],$_SESSION["senha"])){//Compara se existe este usuário e senha em sessão
        echo "<script>window.location='../login.php'</script>";//caso não esteja em sessão, redireciona para página de login
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Easytec Brasil | Atualização</title>
        <!--Import Google Icon Font-->
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
        <!--Navbar-->
        <header>
            <nav class="navbar">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil"
                            loading="Easytec Brasil" />
                    </a>
                </div>
            </nav>
        </header>

        <div class="container" style="margin-top: 2%; margin-bottom: 2%;">
            <div class="container section row">
                <h5>Edição de usuários</h5>
                <!---Formulario--->
                <form method="POST" action="registration_update" class="card bg-white col-lg-12" id="card-form"
                    style="margin-top:2%; padding:4%;">
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="nome">Nome Completo</label>
                            <input type="text" class="form-control form-control-sm required" name="nome"
                                value="<?php echo $usuarios['nome']; ?>" />
                        </div>
                        <div class="form-group mb-4 mx-4 col">
                            <label for="empresa">Empresa</label>
                            <select class="form-control form-control-sm" name="empresa" id="empresa">
                                <option><?php echo $usuarios['empresa']; ?></option>
                            </select>
                        </div>
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="contato">Telefone</label>
                            <input type="text" class="form-control form-control-sm" name="contato"
                                placeholder="exemplo: (XX)9XXXX-XXXX" value="<?php echo $usuarios['contato']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="email" class="form-control form-control-sm" name="email"
                                placeholder="exemplo@exemplo.com.br" value="<?php echo $usuarios['email']; ?>" />
                        </div>
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="senha">Senha</label>
                            <input type="password" class="form-control form-control-sm" name="senha"
                                value="<?php echo $usuarios['senha']; ?>" />
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <a><button type="submit" name="btAtualizar" class="btn btn-dark btn-lg ml-4 mt-4 px-4"
                                value="Atualizar">Atualizar <i class="bi-repeat"></i></button></a>
                    </div>
                </form>
            </div>
            <div class="row">
                <a class="btn btn-secondary ml-4 mt-4 px-5" href="usuarios.php">Voltar</a>
            </div>
        </div>
    <!--Footer-->
    <footer class="text-dark fixed-bottom">
        <div class="text-center p-2">
            © 2022 Copyright Easytec Brasil
        </div>
    </footer>
    <!--Importacao do Jquery do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!--Importacao do Javascript do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>