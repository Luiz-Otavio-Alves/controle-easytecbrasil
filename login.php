<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Easytec Brasil | Login</title>
    <!--Importacao de Favicon-->
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <!--Importacao de CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
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
                    <img src="assets/img/LogoSemFundo.png" width="200" alt="Easytec Brasil" loading="Easytec Brasil" />
                </a>
            </div>
        </nav>
    </header>
	<!------------------->
    <!------------------->
    <!--Inicio Cartao de Login-->
    <div class="container">
        <div class="card bg-white col-lg-5" style="margin-top: 4%; margin-left: auto; margin-right: auto;">
            <div class="row">
                <div class="card-body">
					<!------------------------>
					<!------------------------>
					<!--Inicio do formulario-->
                    <form action="logando.php" method="post">
                        <div class="align-items-center mb-6">
                            <span class="h2 fw-bold">LOGIN</span>
                        </div><br>
						<!------------------>
						<!------------------>
						<!--Campo do Email-->
                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="email" class="form-control form-control-lg" required
                                value=<?php  if (isset($_COOKIE["id_u"])) 
                                {echo($_COOKIE["id_u"]);} 
                            else {echo "";}?>>
                            <label class="form-label" for="email">Email address</label>
                        </div>
						<!------------------>
						<!------------------>
						<!------------------>
						<!--Campo da Senha-->
                        <div class="form-outline mb-4">
                            <input type="password" id="senha" name="senha" class="form-control form-control-lg" required
                                value=<?php  if (isset($_COOKIE["senha_u"])) 
                                    {echo($_COOKIE["senha_u"]);} 
                                else {echo "";}?>>
                            <label class="form-label" for="password">Password</label>
                        </div>
						<!------------------------------>
						<!------------------------------>
						<!--Caixa de selecao memorizar-->
                        <label>
                            <input type="checkbox" id="salvar_chave" name="salvar_chave" value="1" <?php if (isset($_COOKIE["senha"])){echo("checked");} 
                            else {echo "";}?> />
                            <span>Memorizar o usuário neste computador</span>
                        </label>
						<!------------------->
						<!------------------->
						<!--Botao de enviar-->
                        <div class="pt-1 mb-4">
                            <a><button class="btn btn-dark btn-lg btn-block" href="#"> Entrar
                                </button></a>
                        </div>
						<!-------------------->
						<!-------------------->
                        <a class="small text-muted" href="#!">Esqueceu sua senha?</a>
                    </form>
					<!-------------------->
					<!-------------------->
                </div>
            </div>
        </div>
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