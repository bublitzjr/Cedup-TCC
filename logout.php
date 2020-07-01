<?php
include 'conexao.php'; 
$VARbotao = $_POST['btn'];
 
//SAIR DA CONTA
if($VARbotao == "Sair"){
    session_start();
    session_destroy();
    header('Location:/TCC%20-%20J_Jfodastico/index.php');
}

//EXCLUIR USUARIOS
if($VARbotao == "Excluir"){
    session_start();
	include 'conexao.php'; 
    
    $logado = $_SESSION['login'];
    
    $select = "SELECT idUSUARIO FROM usuario WHERE login = '".$logado."'";
            $result = mysqli_query($conexao, $select);
            if(mysqli_num_rows($result)>0){
            $resultados = mysqli_fetch_object($result);
            foreach ($resultados as $login){ }}
    
    //delete favoritos  
    $deleteHist = "DELETE FROM fav_imoveis WHERE FKUsuario = '".$login."'";
    $result = mysqli_query($conexao, $deleteHist);

    //delete historico
    $deleteHist = "DELETE FROM hist_imoveis WHERE FKUsuario = '".$login."'";
    $result = mysqli_query($conexao, $deleteHist);
                    
    $delete = "DELETE FROM usuario WHERE login = '".$logado."'";

    if(mysqli_query($conexao, $delete)){
        echo "<script> alert('Parabéns DELETADO com sucesso '); </script>";
        session_start();
        session_destroy();
        header('Location:/TCC%20-%20J_Jfodastico/index.php');
        
} else{
        echo "<script> alert('ERROR! USUARIO NÃO DELETADO'); </script>";
        echo "ERROR: Could not able to execute $delete. " . mysqli_error($conexao);
        
}
  
}

//ALTERAR USUARIO
if($VARbotao == "Alterar"){
    session_start();
	include 'conexao.php';
    $logado = $_SESSION['login'];
    $VARlogin = $_POST['loginUp'];
    $VARsenha = $_POST['senhaUp'];
    $VARemail = $_POST['emailUp'];
    $VARcpf = $_POST['cpfUp'];
    
    $up = "UPDATE usuario SET login = '".$VARlogin."', senha = '".$VARsenha."', email = '".$VARemail."', CPFCNPJ = '".$VARcpf."' WHERE login = '".$logado."'";
    
    if(mysqli_query($conexao, $up)){
        echo "<script> alert('Parabéns ALTERADO com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=perfil.php';>";
    }else{
         echo "<script> alert('ERRO USUARIO NÃO ALTERADO'); </script>";
    }
}




?>