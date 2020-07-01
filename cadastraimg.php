 <?php
 include 'conexao.php';

    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    $novoNome = md5(time()).$extensao;
    $diretorio = "IMGS/";
        
    move_uploaded_file($_FILES['arquivo']['tmp_name'],$diretorio.$novoNome);

    $selectid = "SELECT idIMOVEL FROM imovel INNER JOIN imovel_img ON imovel.idIMOVEL = imovel_img.FKImovel";
    $resultid = mysqli_query($conexao, $selectid);
    if(mysqli_num_rows($resultid)>=0){
                    $resultadosid = mysqli_fetch_object($resultid);
                     
       
                         
    $sql_code = "INSERT INTO imovel_img (NomeOriginal, NomeServidor, FKImovel) VALUES ('$novoNome','$diretorio','$resultadosid')";
    }
                         
                           if (isset($conexao)){
      echo "<script> alert('Parabéns seu IMOVEL foi cadastrado com sucesso '); </script>";
    }else{
       echo "<script> alert('ERRO!!!: CADASTRO NÃO REALIZADO') </script>";
         
   
                        }  
?>