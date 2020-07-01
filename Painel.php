<?php
include 'conexao.php';
session_start();

    $VARrow = $_POST['btnn']; 
   

    //delete img
    $deleteIMG = "DELETE FROM imovel_img WHERE FKImovel = '".$VARrow."'";
    $result = mysqli_query($conexao, $deleteIMG);       

    //delete favoritos  
    $deleteHist = "DELETE FROM fav_imoveis WHERE FKImovel = '".$VARrow."'";
    $result = mysqli_query($conexao, $deleteHist);

    //delete historico
    $deleteHist = "DELETE FROM hist_imoveis WHERE FKImovel = '".$VARrow."'";
    $result = mysqli_query($conexao, $deleteHist);
    
    //delete IMOVEL
    $delete = "DELETE FROM imovel WHERE idIMOVEL = '".$VARrow."'";
    
    if(mysqli_query($conexao, $delete)){
    echo "<script> alert('Parabéns DELETADO com sucesso '); </script>";
    echo "<meta http-equiv=refresh content='0, url=index.php?modal=imoveisCadastrados.php';>";
    }else{
    echo "<script> alert('ERRO'); </script>";
    echo "<meta http-equiv=refresh content='0, url=index.php?modal=imoveisCadastrados.php   ';>";
        
    }

    

?>