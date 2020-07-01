<?php
    session_start();
    include 'conexao.php';
    
    $VARvagas = $_POST['vagas'];
    $VARquartos = $_POST['quartos'];
    $VARsuites = $_POST['suites'];
    $VARtamanho = $_POST['tamanho'];
    $VARpreco = $_POST['preco'];
    $VARcidade = $_POST['cidadeSelect'];  
    $VARbairro = $_POST['bairroSelect'];
    $VARtipo = $_POST['tipoSelect'];
    $VARdesc = $_POST['descricao'];
    
    
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    $novoNome = md5(time()).$extensao;
    $diretorio = "IMGS/";
        
    move_uploaded_file($_FILES['arquivo']['tmp_name'],$diretorio.$novoNome);

    
    $select = "SELECT idUSUARIO FROM usuario WHERE login = '".$_SESSION['login']."'";
    $result = mysqli_query($conexao, $select);

     if(mysqli_num_rows($result)>=0){
                        $resultados = mysqli_fetch_object($result);
                        foreach ($resultados as $dados){
                          }
                        }        
                        
   $INSERT = "INSERT INTO imovel(Vaga, Quartos, Suites, Tamanho, Preco, descricao, FKCidade, FKBairro, FKTipo, FKUsuario) VALUES 
   ('$VARvagas','$VARquartos','$VARsuites','$VARtamanho','$VARpreco','$VARdesc','$VARcidade','$VARbairro','$VARtipo','$dados')";
   $conexao->query($INSERT);
       
     $selectid = "SELECT idIMOVEL FROM imovel order by idIMOVEL desc";
                $resultid = mysqli_query($conexao, $selectid);
                $resultadoid = mysqli_fetch_object($resultid);  
                 foreach ($resultadoid as $id){   
                        
    $sql_code = "INSERT INTO imovel_img(NomeOriginal, NomeServidor, FKImovel) VALUES ('$novoNome','$diretorio', '$id')";
    $conexao->query($sql_code);
                     
            }
    

   if (isset($conexao)){
      echo "<script> alert('Parabéns seu IMOVEL foi cadastrado com sucesso '); </script>";
    }else{
       echo "<script> alert('ERRO!!!: CADASTRO NÃO REALIZADO') </script>";
         
    }    
   

 
?>