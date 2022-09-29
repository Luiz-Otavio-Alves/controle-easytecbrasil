<?php
    // Inicia sessão no navegador
    session_start();

    // Confere se tem sessão deste usuário e senha ativa
    // para dar acesso à página, caso contrário redireciona para ../login.php
    if (!isset($_SESSION["email"],$_SESSION["senha"])){
        echo "<script>window.location='../login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Easytec Brasil | Cadastro Empresas</title>
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

    <body>
        <!--Navbar-->
        <header>
            <nav class="navbar fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="../index.php">
                        <img src="../assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil"
                            loading="Easytec Brasil" />
                    </a>
                    <div class="dropdown nav justify-content-end">
                        <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Gerenciamento
                        </a>
                        <a class="nav-link text-white relatorio" href="deslogando.php" role="button"
                            aria-expanded="false">Sair <i class="bi bi-box-arrow-right"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="usuarios.php">Usuários</a>
                            <a class="dropdown-item" href="#">Equipamentos</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container" style="margin-top: 6%; margin-bottom: 2%;">
            <div class="container section row">
                <h5>Cadastro de empresas</h5>

                <!---Formulario--->
                <form method="post" action="registration_update.php" class="card col-12" id="card-form" style="margin-top:2%; padding:4%;">
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col-5">
                            <label class="form-label" for="descricao">Descrição</label>
                            <input type="text" class="form-control form-control-sm required" name="nome_emp" />
                        </div>
                        <div class="form-group mb-4 mx-2 col-2">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control form-control-sm required" name="cnpj" />
                        </div>
                        <div class="form-group mb-4 mx-4 col-3">
                            <label for="cnpj">Tipo de Serviço</label>
                            <select class="form-control" name="tipo_servico" id="empresa">
                                <option>--</option>
                                <option>Virtual Dedicado</option>
                                <option>Virtual Compartilhado</option>
                                <option>Fisico Dedicado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col-5">
                            <label class="form-label" for="endereco">Endereço</label>
                            <input type="text" class="form-control form-control-sm" name="endereco_emp"
                                placeholder="Rua/N°, Bairro" />
                        </div>
                        <div class="form-outline mb-4 mx-2 col-3">
                            <label class="form-label" for="cidade">Cidade</label>
                            <input type="text" class="form-control form-control-sm" name="cidade_emp" />
                        </div>
                        <div class="form-outline mb-4 mx-4 col-2">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-control" name="estado_emp" id="empresa">
                                <option>--</option>
                                <option>MG</option>
                                <option>SP</option>
                                <option>RJ</option>
                                <option>BA</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="responsavel">Responsável</label>
                            <input type="text" class="form-control form-control-sm" name="responsavel" placeholder="TI" />
                        </div>
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="email" class="form-control form-control-sm" name="mail_responsavel"
                                placeholder="exemplo@exemplo.com.br" />
                        </div>
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="telefone">Telefone</label>
                            <input type="text" class="form-control form-control-sm" name="tel_responsavel"
                                placeholder="(XX)XXXXX-XXXX" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col-4">
                            <label class="form-label" for="ip">IP Pabx</label>
                            <input type="text" class="form-control form-control-sm" name="ip_pabx" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-outline mb-4 mx-4 col">
                            <label class="form-label" for="senha">Anotações</label>
                            <textarea type="text" class="form-control" name="anot_emp"
                                placeholder="Digite seu texto"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <a class="ml-4 mt-4 px-4"><button class="btn btn-dark" type="submit" name="btCadastrarEmpresa"
                                value="Cadastrar">Cadastrar
                                <i class="material-icons right">add_circle_outline</i></button></a>
                    </div>
                </form>
                <!---Termina formulario--->
                <div class="row justify-content-end">
                    <a class="btn btn-secondary mb-4 ml-4 mt-4 px-5" href="../index.php">Voltar</a>
                </div>
            </div>
        </div>

        <footer class="text-secondary">
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