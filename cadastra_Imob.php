<?php
include 'conexao.php';

    $VARloginImob = $_POST['nomeImob'];
    $VARsenhaImob = $_POST['senhaImob'];
    $VARemailImob = $_POST['emailImob'];
    $VARcnpjImob  = $_POST['cpf_cnpj'];

if(strlen($VARcnpjImob) == 19){
    //VERIFICAÇÃO EMAIL
    $SELECT = mysqli_query($conexao, "SELECT * FROM usuario WHERE Email = '".$VARemailImob."'");
    if(mysqli_num_rows($SELECT)>=1){
        echo "<script> alert('Email já existe') </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=cadastra.html'';>";
    }else{
    
    //VERIFICAÇÃO CPF
    $SELECT = mysqli_query($conexao, "SELECT * FROM usuario WHERE CPFCNPJ = '".$VARcnpjImob."'");
    if(mysqli_num_rows($SELECT)>=1){
    echo "<script> alert('CNPJ já existe') </script>";
    echo "<meta http-equiv=refresh content='0, url=index.php?modal=cadastra.html'';>";
}else{
    
    //INSERÇÃO DOS DADOS
    $INSERT = "INSERT INTO usuario(Login, Senha, Email, CPFCNPJ, Admin) VALUES('$VARloginImob','$VARsenhaImob','$VARemailImob','$VARcnpjImob','2')";
        $conexao->query($INSERT); 
    
    if (isset($conexao)){
         echo "<script> alert('Parabéns ".$VARloginImob." cadastrado com sucesso '); </script>";
         echo "<meta http-equiv=refresh content='0, url=index.php';>";
    }else{
         echo "<script> alert('ERRO!!!: '.$VARloginImob.' CADASTRO NÃO REALIZADO') </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php';>";
        
        }
    }
}
}else{
     echo "<script> alert('CNPJ INVÁLIDO') </script>";
     echo "<meta http-equiv=refresh content='0, url=index.php?modal=cadastraImob.html'';>";
}
?>