<?php 
    include_once("conexao.php");

    // Inicia sessão no navegador
    session_start();

    // Confere se tem sessão deste usuário e senha ativa
    // para dar acesso à página, caso contrário redireciona para ../login.php
    if (!isset($_SESSION["email"],$_SESSION["senha"])){
        echo "<script>window.location='../login.php'</script>";
    }

    // Exclui usuario cadastrado
    if(isset($_REQUEST["id_excluir"])){
        $var_cod_int = $_REQUEST["id_excluir"];
        $sql2 = "DELETE FROM equipamentos WHERE id_equipamentos = $var_cod_int";
        mysqli_query($conn, $sql2);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Easytec Brasil | Equipamentos</title>
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
            <nav class="navbar">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil"
                            loading="Easytec Brasil" />
                    </a>
                    <div class="dropdown nav justify-content-end">
                        <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Gerenciamento
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../index.php">Empresas</a>
                            <a class="dropdown-item" href="usuarios.php">Usuários</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container" style="margin-top: 2%; margin-bottom: 2%; ">
            <h4>Equipamentos</h4>
            <div class="row">
                <!--Campo de pesquisa-->
                <form method="post" action="#" class="bg-light col-lg-6 busca-user" style="margin-left: 2%; padding:1%;">
                    <div class="col">
                        <i class="bi-search"></i>
                        <label for="buscar">Buscar</label>
                        <input type="text" class="form-control form-control-sm"
                            placeholder="Tipo, marca, modelo, descrição" name="campo_pesquisa">
                    </div>
                </form>
                <div class="col-lg-2" style="padding:1%; margin-left:5%;">
                    <!--Botoes-->
                    <a class="btn btn-outline-success mb-3" href="cadastra_equipamentos.php" style="margin: 1%">Cadastrar <i
                            class="bi-person-plus-fill"></i></a>
                    <a class="btn btn-secondary px-4" href="../index.php" style="margin: 1%">Voltar</a>
                </div>
            </div>
        </div>

        <?php
            echo "<div class='container bg-white' style='margin-bottom: 4%; border-radius:5px;'>";
                    
            $sql = "SELECT * FROM equipamentos";
                
            //Busca no campo de pesquisa por equipamento
            if(isset($_POST["campo_pesquisa"])){
                $valor = $_POST["campo_pesquisa"];
                $sql = "SELECT * 
                        FROM equipamentos 
                        WHERE (tipo_equip LIKE '%$valor%') OR (marca_equip LIKE '%$valor%') OR (modelo_equip LIKE '%$valor%')
                                OR (descricao_equip LIKE '%$valor%')";
            }	
                    
            $equipamentos = mysqli_query($conn, $sql);
                
                // Tabela de equipamentos
                echo "<table class='table table-striped table-hover table-responsive-sm' id='estilo-table'>";
                echo "<tr class='thead'>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Descrição</th>
                        <th>Ações</th></tr>";

                while($equipamento = mysqli_fetch_array($equipamentos)){
                    echo "<tr><th>".$equipamento["id_equipamentos"]."</th>
                            <td>".$equipamento["tipo_equip"]."</a></td>
                            <td>".$equipamento["marca_equip"]."</td>
                            <td>".$equipamento["modelo_equip"]."</td>
                            <td>".$equipamento["descricao_equip"]."</td>
                            <td><a class='text-dark' href='edit_equipamento.php?id_equipamento=".$equipamento["id_equipamentos"]."'><i class='bi-pencil-square'></i></a>
                                <a class='text-danger px-2' data-confirm='Tem certeza que deseja excluir este equipamento?' 
                                    href='equipamentos.php?id_excluir=".$equipamento["id_equipamentos"]."'><i class='bi-trash-fill'></i></a></td>
                            </tr>";
                }	
                echo "</table>";
                echo "</div>";
        ?>

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
        <script>
            //Alerta sobre exclusão de equipamentos
            $(document).ready(function() {
                $('a[data-confirm]').click(function(ev) {
                    var href = $(this).attr('href');

                    if (!$('#confirm-delete').lenght) {
                        $('body').append(
                            '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title">Remoção de equipamentos</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja <strong>excluir</strong> este equipamento?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOKD">Excluir</a></div></div></div></div>'
                        );
                    }

                    $('#dataConfirmOKD').attr('href', href);
                    $('#confirm-delete').modal({
                        shown: true
                    });

                    return false;
                });
            });
        </script>
    </body>

</html>