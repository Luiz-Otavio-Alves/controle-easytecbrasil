<?php
	include_once("controle/conexao.php");

    // Inicia sessão no navegador
    session_start();

    // Confere se tem sessão deste usuário e senha ativa
    // para dar acesso à página, caso contrário redireciona para login.php
    if (!isset($_SESSION["email"],$_SESSION["senha"])){
        echo "<script>window.location='login.php'</script>";
    }

    //Exclui empresa cadastrada
    if(isset($_REQUEST["id_excluir"])){
        $var_cod_int = $_REQUEST["id_excluir"];
        $sql = "DELETE FROM empresas WHERE id_empresas = $var_cod_int";
        mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Easytec Brasil | Home</title>
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
        <nav class="navbar fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil"
                        loading="Easytec Brasil" />
                </a>
                <div class="dropdown nav justify-content-end">
                    <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
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

    <div class="container" style="margin-top: 5%; margin-bottom: 2%; ">
        <br>
        <div class="row">

            <!--inicia campo de pesquisa-->
            <form method="post" action="#" class="bg-light col-lg-5 busca-user" style="margin-left: 2%; padding:1%;">
                <div class="col">
                    <i class="bi-search"></i>
                    <label for="buscar">Buscar</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Pesquise pelo nome, serviço, IP ou cidade" name="campo_pesquisa">
                </div>
            </form>
            <!--termina campo de pesquisa-->
            <div class="col-lg-5" style="padding-bottom: 6%; margin-left:5%;">
                <!--inicia botoes-->
                <a class="btn btn-success btn-lg ml-4 px-3" href="controle/cadastro_empresas.php"
                    style="margin: 1%;">Cadastrar <i class="bi bi-plus-circle"></i></a>
                <!--termina botoes-->
                <label for="cnpj" style="margin:2%;"><i class="bi-person-fill"></i> <b class="text-warning"><?php echo $_SESSION['nome'];?></b></label>
            </div>
        </div>
    </div>
    <?php // Trecno em PHP para mostrar a tabela com as empresas cadastradas
        echo "<div class='section bg-white' style='margin-top: 1%; margin-left: 4%; margin-right: 4%; margin-bottom: 2%;'>";
                        
            $sql = "SELECT * FROM empresas";

            if(isset($_POST["campo_pesquisa"])){
                $valor = $_POST["campo_pesquisa"];
                $sql = "SELECT * FROM empresas WHERE nome_emp LIKE '%$valor%' OR ip_pabx LIKE '%$valor%'
                        OR cidade_emp LIKE '%$valor%' OR tipo_servico LIKE '%$valor%' OR estado_emp LIKE '%$valor%'";
            }	
                        
            $empresas = mysqli_query($conn, $sql);
                    
            echo "<table class='table table-striped table-hover table-bordered' id='estilo-table'>";
            echo "<tr class='thead'>
                    <th class=''>#</th>
                    <th class=''>Descrição</th>
                    <!--th class=''>CNPJ</th-->
                    <th class=''>Serviço</th>
                    <th class=''>IP Pabx</th>
                    <th class=''>Responsável</th>
                    <th class=''>Contato</th>
                    <th class=''>Cidade</th>
                    <th class=''>UF</th>
                    <th class=''>Ações</th></tr>";

            while($empresa = mysqli_fetch_array($empresas)){
                echo "<tr><th class=''>".$empresa["id_empresas"]."</th>
                    <td class=''>".$empresa["nome_emp"]."</td>
                    <!--td class=''>".$empresa["cnpj"]."</td-->
                    <td class=''>".$empresa["tipo_servico"]."</td>
                    <td class=''><a class='text-info' target='_blank' href='https://".$empresa["ip_pabx"]."'>".$empresa["ip_pabx"]."</a></td>
                    <td class=''>".$empresa["responsavel"]."</td>
                    <td class=''>".$empresa["tel_responsavel"]."</td>
                    <td class=''>".$empresa["cidade_emp"]."</td>
                    <td class=''>".$empresa["estado_emp"]."</td>
                    <td class=''><a class='text-secondary px-2' data-toggle='modal' href='' 
                                    data-target='#myModal".$empresa["id_empresas"]."'><i class='bi-eye-fill'></i></a>
                                <a class='text-dark' href='controle/edit_empresa.php?id_empresa=".$empresa["id_empresas"]."'>
                                    <i class='bi-pencil-square'></i></a>
                                <a class='text-danger px-3' data-confirm='Tem certeza que deseja excluir esta empresa?' 
                                    href='index.php?id_excluir=".$empresa["id_empresas"]."'><i class='bi-trash-fill'></i></a></td></tr>";                                            
                
                echo '<div class="modal" id="myModal'.$empresa['id_empresas'].'" tabindex="-1" 
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">'.$empresa['nome_emp'].'</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-4 col-5">
                                            <label for="descricao"><b>Empresa: </b></label>
                                            '.$empresa['nome_emp'].'
                                        </div>
                                        <div class="form-outline col-3">
                                            <label for="cnpj"><b>CNPJ: </b></label>
                                            '.$empresa['cnpj'].'
                                        </div>
                                        <div class="form-outline col-3">
                                            <label for="servico"><b>Tipo de Serviço: </b></label>
                                            '.$empresa['tipo_servico'].'
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-4 col-5">
                                            <label for="endereco"><b>Endereço: </b></label>
                                            '.$empresa['endereco_emp'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-4 col-3">
                                            <label for="cidade"><b>Cidade: </b></label>
                                            '.$empresa['cidade_emp'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-4 col-2">
                                            <label for="estado"><b>Estado: </b></label>
                                            '.$empresa['estado_emp'].'
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-outline mb-4 mx-4 col">
                                            <label class="form-label" for="responsavel"><b>Resposável/TI: </b></label>
                                            '.$empresa['responsavel'].'
                                        </div>
                                        <div class="form-outline mb43 mx-4 col">
                                            <label class="form-label" for="email"><b>Email: </b></label>
                                            '.$empresa['mail_responsavel'].'
                                        </div>
                                        <div class="form-outline mb-2 mx-2 col">
                                            <label class="form-label" for="telefone"><b>Telefone: </b></label>
                                            '.$empresa['tel_responsavel'].'
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-4 col-4">
                                            <label class="form-label" for="ip"><b>IP do PABX: </b></label>
                                            <a class="text-secondary" target="_blank" href="https://'.$empresa['ip_pabx'].'">'.$empresa['ip_pabx'].'</a>
                                        </div>
                                        <div class="form-outline mb-4 mx-4 col-4">
                                            <a class="btn btn-warning mb-4 ml-4 mt-4 px-5" href="equipamentos.php">Equipamentos</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-4 col">
                                            <label class="form-label" for="senha"><b>Anotações</b></label><br>
                                            '.$empresa['anot_emp'].'
                                        </div>
                                    </div>

                                </div>    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>';     
            }	
            echo "</table>";
            echo "</div>";
        ?>

        

    <footer class="text-secondary">
        <div class="text-center p-2">
            © 2022 Copyright Easytec Brasil
        </div>
    </footer>
    <!--Importacao do Jquer do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!--Importacao do Javascript do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <!--Trecho em Javascript para exclusão de item-->
    <script>
    //Alerta sobre exclusão de usuários
    $(document).ready(function() {
        $('a[data-confirm]').click(function(ev) {
            var href = $(this).attr('href');

            if (!$('#confirm-delete').lenght) {
                $('body').append(
                    '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title">Remoção de empresa</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja <strong>excluir</strong> esta empresa?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOKD">Excluir</a></div></div></div></div>'
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