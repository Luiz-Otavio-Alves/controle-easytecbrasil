<?php
	include_once("controle/conexao.php");

    // Inicia sessão no navegador
    /*session_start();

    // Confere se tem sessão deste usuário e senha ativa
    // para dar acesso à página, caso contrário redireciona para login.php
    if (!isset($_SESSION["email"],$_SESSION["senha"])){
        echo "<script>window.location='login.php'</script>";
    }*/

    
    $id_empresa = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    echo $id_empresa;

    if(!empty($id_empresa)){

        $dados = "Casa: ".$id_empresa;

        $retorna = ['erro' => true, 'dados' => $dados];

    }else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'
            role='alert'>Erro: Nenhuma empresa encontrada!</div>"]
    }
    
    echo json_encode($retorna);               
?>
