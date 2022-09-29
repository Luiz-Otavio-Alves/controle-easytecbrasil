<?php
    include_once("conexao.php");

    // Inicia sessão no navegador
    session_start();

    // Confere se tem sessão deste usuário e senha ativa
    // para dar acesso à página, caso contrário redireciona para ../login.php
    if (!isset($_SESSION["email"],$_SESSION["senha"])){
        echo "<script>window.location='../login.php'</script>";
    }

    // Verifica se o botão que passa o id do usuário foi clicado,
    // se sim, trunca esse ID para uma variável do tipo INT
    if(isset($_REQUEST["id_usuario"])){
        $var_cod = $_REQUEST["id_usuario"];
        $var_cod_int = intval($var_cod);
    }

    // Faz uma consulta na tabela de usuários para buscar todas as 
    // informações através do ID encontrado no IF acima
    $sql = "SELECT * FROM usuarios WHERE id = $var_cod_int";
    $usuario = mysqli_query($conn, $sql);
    $usuarios = mysqli_fetch_array($usuario);
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Easytec Brasil | Edição</title>
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

                <!---Início do formulario--->
                <form method="POST" action="registration_update.php?id_edition=<?php echo $var_cod_int; ?>" 
                        class="card bg-white col-lg-12" id="card-form" style="margin-top:2%; padding:4%;">
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
                <!--Términino do formulário-->
                
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