<?php
include 'conexao.php';

$VARlogin = $_POST['nome'];
$VARsenha = $_POST['senha'];
$VARemail = $_POST['email'];
$VARcpf = $_POST['cpf'];

if(strlen($VARcpf) == 14){
//VERIFICAÇÃO EMAIL
$SELECT = mysqli_query($conexao, "SELECT * FROM usuario WHERE Email = '".$VARemail."'");
if(mysqli_num_rows($SELECT)>=1){
echo "<script> alert('Email já existe') </script>";
echo "<meta http-equiv=refresh content='0, url=index.php?modal=cadastra.html'';>";
}else{
    
    //VERIFICAÇÃO CPF
    $SELECT = mysqli_query($conexao, "SELECT * FROM usuario WHERE CPFCNPJ = '".$VARcpf."'");
    if(mysqli_num_rows($SELECT)>=1){
    echo "<script> alert('CPF já existe') </script>";
    echo "<meta http-equiv=refresh content='0, url=index.php?modal=cadastra.html'';>";
}else{

    //INSERINDO DADOS
$INSERT = "INSERT INTO usuario(Login, Senha, Email, CPFCNPJ, Admin) VALUES('$VARlogin','$VARsenha','$VARemail','$VARcpf','1')";
$conexao->query($INSERT);

if (isset($conexao)){
        echo "<script> alert('Parabéns ".$VARlogin." cadastrado com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php';>";
    }else{
         echo "<script> alert('ERRO!!!: '.$VARlogin.' CADASTRO NÃO REALIZADO') </script>";
         echo "<meta http-equiv=refresh content='0, url=index.php';>";
}
    }
}
}else{
     echo "<script> alert('CPF INVÁLIDO') </script>";
     echo "<meta http-equiv=refresh content='0, url=index.php?modal=cadastra.html'';>";
}


?>