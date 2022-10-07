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
                    <a class="navbar-brand" href="../index.php">
                        <img src="../assets/img/easytec_logo_mini_2.png" width="130" alt="Easytec Brasil" loading="Easytec Brasil"/>
                    </a>
                </div>
            </nav>
        </header>

        <div class="container theme-showcase" role="main" style="margin-top: 2%; margin-bottom: 2%;">
            
            <?php // Bloco PHP que faz cadastro, exclusão e alerta de itens
                
                 /////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////CADASTRA EQUIPAMENTOS EMPRESA///////////////////////////////////

                if (isset($_POST["btCadastrarEquipamentos_emp"])) {
                    $var_cod_emp = $_REQUEST["cadastra_equip_emp"];
                    $var_cod_int = intval($var_cod_emp); //Passa o valor pra variável

                    $id_equipamentos = $_POST["id_equipamentos"];
                    $id_empresas = $var_cod_int;
                    $ip_equip = $_POST["ip_equip"];
                    $mac_addr_equip = $_POST["mac_addr_equip"];
                    $patrimonio_equip = $_POST["patrimonio_equip"];
                    $user_equip_emp = $_POST["user_equip_emp"];
                    $pass_equip_emp = $_POST["pass_equip_emp"];
                    $anotacoes_equip = $_POST["anotacoes_equip"];

                    $rest = substr($id_equipamentos, 0, 2);
                    //echo $rest;
                    
                    $sqlCadastraEquipamentos_emp = "INSERT INTO equipamentos_emp VALUES (null, 
                                                    '$rest', '$id_empresas', '$ip_equip','$user_equip_emp', 
                                                    '$pass_equip_emp', '$mac_addr_equip',
                                                    '$patrimonio_equip','$anotacoes_equip')";

                    $result_sql = mysqli_query($conn, $sqlCadastraEquipamentos_emp);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Cadastro de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        Equipamento cadastrado com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="edit_equipamentos_emp.php?id_empresa=<?php echo $var_cod_int; ?>"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Cadastro de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao cadastrar equipamento!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="edit_equipamentos_emp.php?id_empresa=<?php echo $var_cod_int; ?>"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    } 
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////ATUALIZA EQUIPAMENTOS EMPRESA//////////////////////////////////
                if (isset($_POST["btAtualizarEquipamentos_emp"])) {
                    $var_cod_emp = $_REQUEST["edita_equip_emp"];
                    $var_cod_int = intval($var_cod_emp); //Passa o valor pra variável
                    //echo $var_cod_int;

                    $var_cod_id_emp = $_REQUEST["pega_id_emp"];
                    $var_cod_int_id_emp = intval($var_cod_id_emp);
                    //echo $var_cod_int_id_emp;

                    //$id_equipamentos = $_POST["id_equipamentos"];
                    //$id_empresas = $var_cod_int_id_emp;
                    $ip_equip = $_POST["ip_equip"];
                    $mac_addr_equip = $_POST["mac_addr_equip"];
                    $patrimonio_equip = $_POST["patrimonio_equip"];
                    $user_equip_emp = $_POST["user_equip_emp"];
                    $pass_equip_emp = $_POST["pass_equip_emp"];
                    $anotacoes_equip = $_POST["anotacoes_equip"];

                    //$rest = substr($id_equipamentos, 0, 2);
                    //echo $rest;

                    $sqlAtualizaEquipamentos = "UPDATE equipamentos_emp SET 
                                                                        ip_equip = '$ip_equip', 
                                                                        user_equip_emp = '$user_equip_emp',
                                                                        pass_equip_emp = '$pass_equip_emp',
                                                                        mac_addr_equip = '$mac_addr_equip',
                                                                        patrimonio_equip = '$patrimonio_equip',
                                                                        anotacoes_equip = '$anotacoes_equip'
                                                    WHERE id_equipamentos_emp = $var_cod_int";

                    $result_sql = mysqli_query($conn, $sqlAtualizaEquipamentos);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Atualização de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        Equipamento atualizado com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="edit_equipamentos_emp.php?id_empresa=<?php echo $var_cod_int_id_emp; ?>"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Atualização de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao atualizar equipamento!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="edit_equipamentos_emp.php?id_empresa=<?php echo $var_cod_int_id_emp; ?>"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    } 
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////CADASTRA EQUIPAMENTOS///////////////////////////////////////////////

                if (isset($_POST["btCadastrarEquipamentos"])) {
                    $tipo_equip = $_POST["tipo_equip"];
                    $marca_equip = $_POST["marca_equip"];
                    $modelo_equip = $_POST["modelo_equip"];
                    $descricao_equip = $_POST["descricao_equip"];
                    
                    $sqlCadastraEquipamentos = "INSERT INTO equipamentos VALUES (null, '$tipo_equip', '$marca_equip', '$modelo_equip', 
                                            '$descricao_equip')";

                    $result_sql = mysqli_query($conn, $sqlCadastraEquipamentos);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Cadastro de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        <b><?php echo $descricao_equip; ?></b> cadastrado com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="equipamentos.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Cadastro de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao cadastrar equipamento <b><?php echo $descricao_equip; ?></b>!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="equipamentos.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    } 
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////ATUALIZA EQUIPAMENTOS//////////////////////////////////////////
                if (isset($_POST["btAtualizaEquipamentos"])) {
                    $tipo_equip = $_POST["tipo_equip"];
                    $marca_equip = $_POST["marca_equip"];
                    $modelo_equip = $_POST["modelo_equip"];
                    $descricao_equip = $_POST["descricao_equip"];

                    $var_cod = $_REQUEST["id_edita_equipamentos"];
                    $var_cod_int = intval($var_cod); //Passa o valor pra variável

                    $sqlAtualizaEquipamentos = "UPDATE equipamentos SET tipo_equip = '$tipo_equip', 
                                                                        marca_equip = '$marca_equip', 
                                                                        modelo_equip = '$modelo_equip', 
                                                                        descricao_equip = '$descricao_equip'
                                                    WHERE id_equipamentos = $var_cod_int";

                    $result_sql = mysqli_query($conn, $sqlAtualizaEquipamentos);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Atualização de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        <b><?php echo $descricao_equip; ?></b> atualizado com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="equipamentos.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Atualização de Equipamentos</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao atualizar equipamento <b><?php echo $descricao_equip; ?></b>!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="equipamentos.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    } 
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////CADASTRA EMPRESA///////////////////////////////////////////////

                if (isset($_POST["btCadastrarEmpresa"])) {
                    $descricao = $_POST["descricao"];
                    $cnpj = $_POST["cnpj"];
                    $tipo_servico = $_POST["tipo_servico"];
                    $cidade_emp = $_POST["cidade_emp"];
                    $endereco_emp = $_POST["endereco_emp"];
                    $estado_emp = $_POST["estado_emp"];
                    $responsavel = $_POST["responsavel"];
                    $mail_responsavel = $_POST["mail_responsavel"];
                    $tel_responsavel = $_POST["tel_responsavel"];
                    $ip_pabx = $_POST["ip_pabx"];
                    $pass_pabx = $_POST["password_pabx"];
                    $ip_mikrotik = $_POST["ip_mikrotik"];
                    $pass_mikrotik = $_POST["password_mikrotik"];
                    $cod_ligacao = $_POST["cod_ligacao"];
                    $num_entrada = $_POST["num_entrada"];
                    $num_saida = $_POST["num_saida"];
                    $anot_emp = $_POST["anot_emp"];

                    $sqlCadastraEmpresa = "INSERT INTO empresas VALUES (null, '$descricao', '$cnpj', '$tipo_servico', 
                                            '$endereco_emp', '$cidade_emp', '$estado_emp', '$responsavel', '$mail_responsavel', 
                                            '$tel_responsavel', '$ip_pabx', '$pass_pabx', '$ip_mikrotik', '$pass_mikrotik', 
                                            '$cod_ligacao', '$num_entrada', '$num_saida', '$anot_emp')";

                    $result_sql = mysqli_query($conn, $sqlCadastraEmpresa);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Cadastro de Empresas</h5>
                                    </div>
                                    <div class="modal-body">
                                        Empresa <b><?php echo $descricao; ?></b> cadastrada com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../index.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Cadastro de Empresas</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao cadastrar empresa <b><?php echo $descricao; ?></b>!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../index.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    } 
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////ATUALIZAÇÃO DE EMPRESA/////////////////////////////////////////

                // Verifica se o botão btAtualizarEmpresa foi clicado no arquivo edit_empresa.php
                // se sim, recebe o POST dos campos para as variáveis para atualizar no banco
                if (isset($_POST["btAtualizarEmpresa"])) {
                    $var_cod = $_REQUEST["id_edita_empresa"];
                    $var_cod_int = intval($var_cod); //Passa o valor pra variável

                    $descricao = $_POST["descricao"];
                    $cnpj = $_POST["cnpj"];
                    $tipo_servico = $_POST["tipo_servico"];
                    $cidade_emp = $_POST["cidade_emp"];
                    $endereco_emp = $_POST["endereco_emp"];
                    $estado_emp = $_POST["estado_emp"];
                    $responsavel = $_POST["responsavel"];
                    $mail_responsavel = $_POST["mail_responsavel"];
                    $tel_responsavel = $_POST["tel_responsavel"];
                    $ip_pabx = $_POST["ip_pabx"];
                    $password_pabx = $_POST["password_pabx"];
                    $ip_mikrotik = $_POST["ip_mikrotik"];
                    $password_mikrotik = $_POST["password_mikrotik"];
                    $cod_ligacao = $_POST["cod_ligacao"];
                    $num_entrada = $_POST["num_entrada"];
                    $num_saida = $_POST["num_saida"];
                    $anot_emp = $_POST["anot_emp"];

                    $sqlAtualizaEmpresa = "UPDATE empresas SET descricao = '$descricao', 
                                                    cnpj = '$cnpj', 
                                                    tipo_servico = '$tipo_servico', 
                                                    cidade_emp = '$cidade_emp', 
                                                    endereco_emp = '$endereco_emp',
                                                    estado_emp = '$estado_emp',
                                                    responsavel = '$responsavel',
                                                    mail_responsavel = '$mail_responsavel',
                                                    tel_responsavel = '$tel_responsavel',
                                                    ip_pabx = '$ip_pabx',
                                                    password_pabx = '$password_pabx',
                                                    ip_mikrotik = '$ip_mikrotik',
                                                    password_mikrotik = '$password_mikrotik',
                                                    cod_ligacao = '$cod_ligacao',
                                                    num_entrada = '$num_entrada',
                                                    num_saida = '$num_saida',
                                                    anot_emp = '$anot_emp'

                                            WHERE id_empresas = $var_cod_int";
                    $result_sqlAtualiza = mysqli_query($conn, $sqlAtualizaEmpresa);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Atualização de Empresa</h5>
                                    </div>
                                    <div class="modal-body">
                                        Informações de  <b><?php echo $descricao; ?></b> atualizadas com sucesso!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../index.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Atualização de Empresa</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao atualizar informações de <b><?php echo $descricao; ?></b>!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../index.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////CADASTRO DE USUÁRIO/////////////////////////////////////////

                // Verifica se o botão btCadastrar foi clicado no arquivo cadastra_usuario.php
                // se sim, recebe o POST dos campos para as variáveis para inserir no banco
                if (isset($_POST["btCadastrar"])) {
                    $nome_usuario = $_POST["nome"];
                    $nome_empresa = $_POST["empresa"];
                    $contato_usuario = $_POST["contato"];
                    $email_usuario = $_POST["email"];
                    $senha_usuario = md5($_POST["senha"]);
                    
                    $sql = "INSERT INTO usuarios VALUES (null, '$nome_usuario', '$nome_empresa', '$contato_usuario', '$email_usuario', '$senha_usuario')";
                    $result_sql = mysqli_query($conn, $sql);

                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
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
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }else{ ?>
                        <!--Modal que indica falha no cadastro-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Cadastro de Usuário</h5>
                                    </div>
                                    <div class="modal-body">
                                        Erro ao cadastrar usuário <b><?php echo $email_usuario; ?></b>!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="usuarios.php"><button type="button" class="btn btn-secondary">Fechar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script><?php
                    }
                }

                /////////////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////ATUALIAZAÇÃO DE USUÁRIO/////////////////////////////////////////

                // Verifica se o botão btAtualizar foi clicado, se sim, faz um POST 
                // para as variáveis correspondentes às colunas do banco para inserir
                if (isset($_POST["btAtualizar"])) 
                {       
                    $var_cod = $_REQUEST["id_edition"];
                    $var_cod_int = intval($var_cod); //Passa o valor pra variável
                    
                    $nome_usuario = $_POST["nome"];
                    $nome_empresa = $_POST["empresa"];
                    $contato_usuario = $_POST["contato"];
                    $email_usuario = $_POST["email"];
                    $senha_usuario = md5($_POST["senha"]);

                    $sqlAtualiza = "UPDATE usuarios SET nome = '$nome_usuario', 
                                                    empresa = '$nome_empresa', 
                                                    contato = '$contato_usuario', 
                                                    email = '$email_usuario', 
                                                    senha = '$senha_usuario'
                                WHERE id = $var_cod_int";
                    $result_sqlAtualiza = mysqli_query($conn, $sqlAtualiza);
                    
                    // Confere se teve alteração com sucesso no banco de dados
                    // quando é retornado 0, indica que sim, assim então, mostra o modal de sucesso
                    if(mysqli_affected_rows($conn) > 0){ ?>
                        <!--Modal que indica sucesso na atualização-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
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
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script> <?php
                    }else{ ?>
                        <!--Modal que indica falha na atualização do usuário-->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
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
                        <!--Função em Javascript que chama o Modal para ser aberto-->
                        <script>
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        </script> <?php
                    }
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