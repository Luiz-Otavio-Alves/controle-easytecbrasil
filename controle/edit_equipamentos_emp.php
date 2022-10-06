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
    if(isset($_REQUEST["id_empresa"]))
    {
        $var_cod = $_REQUEST["id_empresa"];
        $var_cod_int = intval($var_cod);
    }

    //Exclui equipamentos cadastrada
    if(isset($_REQUEST["id_excluir"])){
        $var_cod_int_excluir = $_REQUEST["id_excluir"];
        $sql = "DELETE FROM equipamentos_emp WHERE id_equipamentos_emp = $var_cod_int_excluir";
        mysqli_query($conn, $sql);
    }

    // Faz uma consulta na tabela de empresas para buscar todas as 
    // informações através do ID encontrado no IF acima
    $sql1 = "SELECT * FROM empresas WHERE id_empresas = $var_cod_int";
    $empresa = mysqli_query($conn, $sql1);
    $empresas = mysqli_fetch_array($empresa);
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
                <a class="navbar-brand" href="../index">
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
                        <a class="dropdown-item" href="equipamentos.php">Equipamentos</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container" style="margin-top: 6%; margin-bottom: 2%;">

        <div class="row justify-content-center">
            <h5 class="mb-2 p-2"><b>Equipamentos</b> - <?php echo $empresas['descricao']; ?></h5>
        </div>
        <div class="row ">
            <form method="post" action="" class="col-6 mx-5 mb-4">
                <div class="col">
                    <i class="bi-search"></i><label for="buscar">Buscar</label>
                    <input type="text" class="form-control form-control-sm busca-user"
                        placeholder="Pesquise pela descrição, tipo, marca, modelo, IP, MAC e patrimônio"
                        name="campo_pesquisa">
                </div>
            </form>
            <div class="col mb-4 justify-content-end">
                <a href="cadastra_equipamentos_emp.php?id_empresa=<?php echo $var_cod_int; ?>">
                    <button class="btn btn-success" type="submit" name="btCadastrarEquipamentos_emp"
                        value="Cadastrar">Cadastrar <i class="bi bi-plus-circle"></i></button></a>
                <a class="btn btn-sm btn-secondary mb-4 ml-4 mt-4 px-5" href="../index.php">Voltar</a>
            </div>
        </div>

        <?php
                echo "<div class='container bg-white table-wrapper-scroll-y my-custom-scrollbar' style='margin-bottom: 1%;'>";
                                        
                $sql = "SELECT a.tipo_equip, a.marca_equip, 
                            a.modelo_equip, a.descricao_equip, 
                            b.ip_equip, b.mac_addr_equip, b.patrimonio_equip, b.id_equipamentos_emp

                        FROM equipamentos a 
                        INNER JOIN equipamentos_emp b ON b.id_equipamentos = a.id_equipamentos
                        WHERE b.id_empresas = $var_cod_int";

                if(isset($_POST["campo_pesquisa"])){
                    $valor = $_POST["campo_pesquisa"];
                    $sql = "SELECT a.tipo_equip, a.marca_equip, 
                                    a.modelo_equip, a.descricao_equip, 
                                    b.ip_equip, b.mac_addr_equip, b.patrimonio_equip, b.id_equipamentos_emp 
                            FROM equipamentos a INNER JOIN equipamentos_emp b ON b.id_equipamentos = a.id_equipamentos
                            WHERE a.tipo_equip LIKE '%$valor%' OR a.marca_equip LIKE '%$valor%' OR a.modelo_equip LIKE '%$valor%'
                                OR a.descricao_equip LIKE '%$valor%' OR b.ip_equip LIKE '%$valor%' OR b.mac_addr_equip LIKE '%$valor%'
                                OR b.patrimonio_equip LIKE '%$valor%'";
                }	        
                                                    
                $equipamentos_emp = mysqli_query($conn, $sql);
                                                
                // Tabela de equipamentos
                echo "<table class='table table-striped table-hover 
                        table-bordered table-responsive-sm table-sm mb-0' id='estilo-table'>";
                echo "<tr class='thead bg-dark text-white'>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>IP</th>
                    <th>MAC</th>
                    <th>Patrimônio</th>
                    <th>Ações</th></tr>";

                while($equipamento_emp = mysqli_fetch_array($equipamentos_emp)){
                    echo "<tr><td>".$equipamento_emp["descricao_equip"]."</td>
                        <td>".$equipamento_emp["tipo_equip"]."</a></td>
                        <td>".$equipamento_emp["marca_equip"]."</td>
                        <td>".$equipamento_emp["modelo_equip"]."</td>
                        <td>".$equipamento_emp["ip_equip"]."</td>
                        <td>".$equipamento_emp["mac_addr_equip"]."</td>
                        <td>".$equipamento_emp["patrimonio_equip"]."</td>
                        <td><a class='text-dark' href='edit_equipamentos_uni.php?id_equipamento_emp=".$equipamento_emp["id_equipamentos_emp"]."&&id_empresa=".$empresas['id_empresas']."'><i class='bi-pencil-square'></i></a>
                            <a class='text-danger px-2' data-confirm='Tem certeza que deseja excluir este equipamento?' 
                                href='edit_equipamentos_emp.php?id_empresa=".$empresas['id_empresas']."&&id_excluir=".$equipamento_emp["id_equipamentos_emp"]."'><i class='bi-trash-fill'></i></a></td>
                        </tr>";
                }	
                echo "</table>";
                echo "</div>";
            ?>

        <div class="row">

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
    <script>
    //Alerta sobre exclusão de equipamentos
    $(document).ready(function() {
        $('a[data-confirm]').click(function(ev) {
            var href = $(this).attr('href');

            if (!$('#confirm-delete').lenght) {
                $('body').append(
                    '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title">Remoção de empresa</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja <strong>excluir</strong> este equipamento?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOKD">Excluir</a></div></div></div></div>'
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