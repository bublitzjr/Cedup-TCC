<?php
    session_start();
	include 'conexao.php';
	$VARlogin = $_POST['login'];
	$VARsenha = $_POST['senha'];

    $query_select = "SELECT * FROM imobiliarias WHERE NomeImob = '".$VARlogin."' AND SenhaImob = '".$VARsenha."'";
    $result = mysqli_query($conexao, $query_select);


	if(mysqli_num_rows($result)<=0){
        echo "<script> alert('ERRO!!! DADOS INCORRETOS') </script>";
	       unset ($_SESSION['login']);
            unset ($_SESSION['senha']); 
        echo "<meta http-equiv=refresh content='0, url=index.php';>";
	}else{
        echo "<script> alert('PARABÉNS ".$VARlogin." LOGADO COM SUCESSO '); </script>";
	$_SESSION['login'] = $VARlogin;
	$_SESSION['senha'] = $VARsenha;
        echo "<meta http-equiv=refresh content='0, url=index.php';>";
}
