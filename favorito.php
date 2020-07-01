<?php
session_start();
include 'conexao.php';

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
    echo "<script> alert('Você precisa estar logado para favoritar um imóvel'); </script>";
    echo "<meta http-equiv=refresh content='0, url=imoveis.php';>";
}else{

$logado = $_SESSION['login'];

$fav = $_POST['btnFavorito'];
$imovel = $_POST['idIMOVEL'];

if($fav=="❤"){
    
         $select = "SELECT idUSUARIO FROM usuario WHERE login = '".$logado."'";
         $result = mysqli_query($conexao, $select);
         $resultados = mysqli_fetch_object($result);
         foreach($resultados as $id){}
         
    
        $INSERT = "INSERT INTO fav_imoveis (FKUsuario, FKImovel, dt_log) VALUES('$id','$imovel',now())";
        $conexao->query($INSERT);   
    
    if (isset($conexao)){
        echo "<script> alert('Favoritado com Sucesso'); </script>";
        echo "<meta http-equiv=refresh content='0, url=imoveis.php';>";
    }else{
         echo "<script> alert('ERRO!!!') </script>";
         echo "<meta http-equiv=refresh content='0, url=imoveis.php';>";
}

}
}

?>