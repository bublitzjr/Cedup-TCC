<?php
    include 'conexao.php';
    
    $VARbtn = $_POST['btnenvia'];
    
if($VARbtn == "Enviar tipo"){  
    $VARtipoC = $_POST['tipoC'];
    $INSERT = "INSERT INTO tipo (NomeTipo) VALUES('$VARtipoC')";
    $conexao->query($INSERT);

    if (isset($conexao)){
        echo "<script> alert('Parabéns cadastrado com sucesso ');</script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
    }else{
         echo "<script> alert('ERRO!!!: CADASTRO NÃO REALIZADO') </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
}   
    }else{
        
    if($VARbtn == "Enviar cidade"){
      $VARCidade = $_POST['cidade'];
      $INSERT = "INSERT INTO cidade (NomeCidade) VALUES('$VARCidade')";
      $conexao->query($INSERT);

    if (isset($conexao)){
        echo "<script> alert('Parabéns cadastrado com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
    }else{
         echo "<script> alert('ERRO!!!: CADASTRO NÃO REALIZADO') </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
}   
        }else{
    
        if($VARbtn == "Enviar bairro"){
              $VARBairro = $_POST['bairro'];
            $INSERT = "INSERT INTO bairro (NomeBairro) VALUES('$VARBairro')";
    $conexao->query($INSERT);

    if (isset($conexao)){
        echo "<script> alert('Parabéns cadastrado com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
    
    }else{
         echo "<script> alert('ERRO!!!: CADASTRO NÃO REALIZADO') </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
                }      
            }               
        }
    }
    
?>