<?php
    include_once("conexao.php");

    // Inicia sessão no navegador
    session_start();

    // Confere se tem sessão deste usuário e senha ativa
    // para dar acesso à página, caso contrário redireciona para ../login.php
    if (!isset($_SESSION["email"],$_SESSION["senha"])){
        echo "<script>window.location='../login.php'</script>";
    }

    // Verifica se o botão que passa o id da empresa foi clicado,
    // se sim, trunca esse ID para uma variável do tipo INT
    if(isset($_REQUEST["id_equipamento"]))
    {
        $var_cod = $_REQUEST["id_equipamento"];
        $var_cod_int = intval($var_cod);
    }

    // Faz uma consulta na tabela de empresas para buscar todas as 
    // informações através do ID encontrado no IF acima
    $sql = "SELECT * FROM equipamentos WHERE id_equipamentos = $var_cod_int";
    $equipamento = mysqli_query($conn, $sql);
    $equipamentos = mysqli_fetch_array($equipamento);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Easytec Brasil | Equipamentos</title>
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
    <!--Navbar-->
    <header>
        <nav class="navbar fixed-top">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="../assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil"
                        loading="Easytec Brasil" />
                </a>
            </div>
        </nav>
    </header>

    <div class="container" style="margin-top: 6%; margin-bottom: 2%;">
        <div class="container section row">
            <h5>Edição de equipamentos</h5>

            <!---Formulario--->
            <form method="post" action="registration_update.php?id_edita_equipamentos=<?php echo $var_cod_int; ?>" class="card col-12" id="card-form"
                style="margin-top:2%; padding:4%;">


                <div class="row" style=" margin-top:1%;">
                    <div class="form-outline mb-3 mx-4 col-5">
                        <label class="form-label" for="descricao">Descrição</label>
                        <input type="text" class="form-control form-control-sm required" value="<?php echo $equipamentos["descricao_equip"];?>" name="descricao_equip" />
                    </div>
                    <div class="form-group mb-3 mx-3 col-3">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control form-control-sm required" value="<?php echo $equipamentos["marca_equip"];?>" name="marca_equip" />
                    </div>
                    <div class="form-outline mb-3 mx-3 col-2">
                        <label class="form-label" for="modelo">Modelo</label>
                        <input type="text" class="form-control form-control-sm" value="<?php echo $equipamentos["modelo_equip"];?>" name="modelo_equip" />
                    </div>

                </div>
                <div class="row">
                    <div class="form-outline mb-3 mx-4 col-5">
                        <label class="form-label" for="endereco">Tipo de equipamento</label>
                        <select class="form-control" name="tipo_equip" id="empresa">
                            <option><?php echo $equipamentos["tipo_equip"];?></option>
                            <option>Telefone</option>
                            <option>Servidor</option>
                            <option>Routerboard</option>
                            <option>Ata</option>
                            <option>Gateway</option>
                            <option>Fone HeadSet</option>
                            <option>Computador</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <a class="ml-4 mt-4 px-4"><button class="btn btn-dark" type="submit" name="btAtualizaEquipamentosEmpresa"
                            value="Atualizar">Atualizar <i
                                        class="bi-repeat"></i></button></a>
                </div>
        </div>
        </form>
        <!---Termina formulario--->
        <div class="row">
            <a class="btn btn-secondary btn-sm mb-4 ml-4 mt-4 px-5" href="equipamentos.php">Voltar</a>
        </div>
    </div>
    </div>

    <footer class="text-secondary fixed-bottom">
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