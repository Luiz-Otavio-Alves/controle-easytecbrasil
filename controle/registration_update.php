<?php include_once("conexao.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Easytec Brasil</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Importacao de Favicon-->
    <link rel="shortcut icon" href="../assets/img/favicon.ico" />
    <!--Importacao de CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <!--Importacao do Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!--Importação de Jquery-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!--Importação de Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</head>

<body>
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

    <div class="container theme-showcase" role="main" style="margin-top: 2%; margin-bottom: 2%;">
        <?php
                //CADASTRA USUARIO
                if (isset($_POST["btCadastrar"])) {
                    //DADOS PARA CADASTRAR
                    $nome_usuario = $_POST["nome"];
                    $nome_empresa = $_POST["empresa"];
                    $contato_usuario = $_POST["contato"];
                    $email_usuario = $_POST["email"];
                    $senha_usuario = md5($_POST["senha"]);
                    //INSERE NO BANCO DE DADOS
                    $sql = "INSERT INTO usuarios VALUES (null, '$nome_usuario', '$nome_empresa', '$contato_usuario', '$email_usuario', '$senha_usuario')";
                    $result_sql = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn) > 0){ ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
            style="margin-top: 10%;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Cadastro de Usuário</h5>
                    </div>
                    <div class="modal-body">
                        Usuário <b><?php echo $email_usuario; ?></b> cadastrado com sucesso!
                    </div>
                    <div class="modal-footer">
                        <a href="usuarios.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                    </div>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
        </script>
        <?php }else{
                        echo "Erro ao cadastrar usuário";
                    }
                }

                //////////////////////////////////////////////////////
                //////Atualiza informações do usuário////////////////

                if (isset($_POST["btAtualizar"])) 
                {   
                    $var_cod = $_REQUEST["id_editar"];
                    $var_cod_int = intval($var_cod);

                    //$codigo = $_POST["id"];
                    $nome_usuario = $_POST["nome"];
                    $nome_empresa = $_POST["empresa"];
                    $contato_usuario = $_POST["contato"];
                    $email_usuario = $_POST["email"];
                    $senha_usuario = md5($_POST["senha"]);
                    echo $var_cod_int;

                    $sqlAtualiza = "UPDATE usuarios SET nome = '$nome_usuario', 
                                                empresa = '$nome_empresa', 
                                                contato = '$contato_usuario', 
                                                email = '$email_usuario', 
                                                senha = '$senha_usuario'
                            WHERE id = $var_cod_int";
                    $result_sqlAtualiza = mysqli_query($conn, $sqlAtualiza);
                    
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                            style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Atualização de Usuário</h5>
                                    </div>
                                    <div class="modal-body">
                                        Usuário <b><?php echo $email_usuario; ?></b> atualizado com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="usuarios.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script>
                    <?php }else{ ?>
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                            style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Atualização de Usuário</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao atualizar usuário <b><?php echo $email_usuario; ?></b>!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="usuarios.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script>
                    <?php  }
                }                    
?>
    </div>

    <footer class="text-dark fixed-bottom">
        <div class="text-center p-2">
            ©2022 Copyright Easytec Brasil
        </div>
    </footer>
</body>

</html>