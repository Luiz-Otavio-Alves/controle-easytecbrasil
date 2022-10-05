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
                        <a class="dropdown-item" href="controle/equipamentos.php">Equipamentos</a>
                        <a class="dropdown-item" href="controle/usuarios.php">Usuários</a>
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
                <a class="btn btn-outline-success btn-lg ml-4 px-3" href="controle/cadastra_empresas.php"
                    style="margin: 1%;">Cadastrar <i class="bi bi-plus-circle"></i></a>
                <!--termina botoes-->
                <label for="cnpj" style="margin:2%;"><i class="bi-person-fill"></i> <b
                        class="text-dark"><?php echo $_SESSION['nome'];?></b></label>
            </div>
        </div>
    </div>

    <?php // Trecho em PHP para mostrar a tabela com as empresas cadastradas
        echo "<div class='section bg-white' style='margin-top: 1%; margin-left: 4%; margin-right: 4%; margin-bottom: 2%;'>";
                        
        $sql = "SELECT * FROM empresas";

        if(isset($_POST["campo_pesquisa"])){
            $valor = $_POST["campo_pesquisa"];
            $sql = "SELECT * FROM empresas WHERE descricao LIKE '%$valor%' OR ip_pabx LIKE '%$valor%'
                    OR cidade_emp LIKE '%$valor%' OR tipo_servico LIKE '%$valor%' OR estado_emp LIKE '%$valor%'";
        }	
                        
        $empresas = mysqli_query($conn, $sql);
                    
        echo "<table class='table table-striped table-hover table-bordered table-responsive-sm' id='estilo-table'>";
        echo "<tr class='thead'>
            <th>#</th>
            <th>Descrição</th>
            <!--th class=''>CNPJ</th-->
            <th>Serviço</th>
            <th>IP Pabx</th>
            <th>Responsável</th>
            <th>Contato</th>
            <th>Cidade</th>
            <th>UF</th>
            <th>Ações</th></tr>";

        while($empresa = mysqli_fetch_array($empresas)){
            echo "<tr><th>".$empresa["id_empresas"]."</th>
                <td>".$empresa["descricao"]."</td>
                <!--td>".$empresa["cnpj"]."</td-->
                <td>".$empresa["tipo_servico"]."</td>
                <td><a class='text-info' target='_blank' 
                        href='https://".$empresa["ip_pabx"]."'>".$empresa["ip_pabx"]."</a></td>
                <td>".$empresa["responsavel"]."</td>
                <td>".$empresa["tel_responsavel"]."</td>
                <td>".$empresa["cidade_emp"]."</td>
                <td>".$empresa["estado_emp"]."</td>
                <td><a class='text-secondary px-1' data-toggle='modal' href='' 
                        data-target='#myModal".$empresa["id_empresas"]."'><i class='bi-eye-fill'></i></a>
                    <a class='text-success px-2' href='controle/edit_equipamentos_emp.php?id_empresa=".$empresa["id_empresas"]."''>
                        <i class='bi bi-pc-display-horizontal'></i></a>    
                    <a class='text-dark' href='controle/edit_empresa.php?id_empresa=".$empresa["id_empresas"]."'>
                        <i class='bi-pencil-square'></i></a>
                    <a class='text-danger px-3' data-confirm='Tem certeza que deseja excluir esta empresa?' 
                        href='index.php?id_excluir=".$empresa["id_empresas"]."'>
                        <i class='bi-trash-fill'></i></a></td></tr>";                                             

            echo '<div class="modal fade" id="myModal'.$empresa['id_empresas'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$empresa['descricao'].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" id="myTab'.$empresa["id_empresas"].'" role="tablist">
                                <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home'.$empresa["id_empresas"].'" type="button" role="tab" aria-controls="home" aria-selected="true">Administrativo</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile'.$empresa["id_empresas"].'" type="button" role="tab" aria-controls="profile" aria-selected="false">Técnico</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!----------------------------------------------->
                                <!----------------ADMINISTRATIVO----------------->
                                <!----------------------------------------------->
                                <div class="tab-pane fade show active" id="home'.$empresa["id_empresas"].'" 
                                    role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row" style="margin-top:3%;">
                                        <div class="form-outline mb-4 mx-4 col-5">
                                            <label for="descricao"><b>Empresa: </b></label>
                                            '.$empresa['descricao'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-4 col-3">
                                            <label for="cnpj"><b>CNPJ: </b></label>
                                            '.$empresa['cnpj'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-4 col">
                                            <label class="form-label" for="telefone"><b>Telefone: </b></label>
                                            '.$empresa['tel_responsavel'].'
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
                                        <div class="form-outline mb-4 mx-4 col-5">
                                            <label class="form-label" for="responsavel"><b>Resposável/TI: </b></label>
                                            '.$empresa['responsavel'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-4 col-5">
                                            <label class="form-label" for="email"><b>Email: </b></label>
                                            '.$empresa['mail_responsavel'].'
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-4 col">
                                            <label class="form-label" for="anot"><b>Anotações</b></label><br>
                                            <textarea type="text" class="form-control bg-white" name="anot_emp"
                                                placeholder="'.$empresa["anot_emp"].'" disabled></textarea>
                                        </div>
                                    </div> 
                                </div>
                                <!----------------------------------------------->
                                <!------------------TÉCNICO---------------------->
                                <!----------------------------------------------->
                                <div class="tab-pane fade" id="profile'.$empresa["id_empresas"].'" 
                                    role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row" style="margin-top:3%;">
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label for="codigo"><b>Código de ligação: </b></label>
                                            '.$empresa['cod_ligacao'].'
                                        </div>    
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label for="servico"><b>Tipo de Serviço: </b></label>
                                            '.$empresa['tipo_servico'].'
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label class="form-label" for="ip"><b>IP do PABX: </b></label>
                                            <a class="text-info" target="_blank" 
                                                href="https://'.$empresa['ip_pabx'].'">'.$empresa['ip_pabx'].' 
                                                <i class="bi bi-arrow-up-right-square-fill"></i></button></a>
                                        </div>
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label class="form-label" for="ip"><b>Senha do PABX: </b></label>
                                            '.$empresa['password_pabx'].'
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label class="form-label" for="ip_mikrotik"><b>IP do Mikrotik: </b></label>
                                            '.$empresa['ip_mikrotik'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label class="form-label" for="password_mikrotik"><b>Senha do Mikrotik: </b></label>
                                            '.$empresa['password_mikrotik'].'
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="form-outline mb-4 mx-3 col-4">
                                            <label class="form-label" for="num_entrada"><b>Número(s) de entrada: </b></label>
                                            '.$empresa['num_entrada'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-3 col-3">
                                            <label class="form-label" for="num_saida"><b>Número(s) de saída: </b></label>
                                            '.$empresa['num_saida'].'
                                        </div>
                                        <div class="form-outline mb-4 mx-3 col-2">
                                            <a class="btn btn-warning text-dark" href="controle/edit_empresa.php?id_empresa='.$empresa['id_empresas'].'">
                                            Editar <i class="bi-pencil-square"></i></a>
                                        </div>
                                    </div>   
                                </div>
                                        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
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