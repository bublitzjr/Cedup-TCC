<?php
include 'conexao.php';


$VARbtnnn = $_POST['btnnn'];
$iT = 0;    
if($VARbtnnn == "Excluir tipos"){
    
    $delTipo = $_POST['delTipo'];
    while ($delTipo[$iT] != ""){    
            foreach($delTipo as $itemT) {
            $sql_deleta = "DELETE FROM tipo WHERE NomeTipo = '".$itemT."'";
            $iT++;    
            
          
        if(mysqli_query($conexao, $sql_deleta)){
        echo "<script> alert('Parabéns DELETADO com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
        }else{
        echo "<script> alert('ERROR! USUARIO NÃO DELETADO'); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
        }
            }  
                }
                    }

    
if($VARbtnnn == "Excluir cidades"){
      $iC = 0;
    $delCidade = $_POST['delCidade'];
    while ($delCidade[$iC] != ""){    
            foreach($delCidade as $itemC) {
            $sql_deleta = "DELETE FROM cidade WHERE NomeCidade = '".$itemC."'";
            $iC++;    
            
          
        if(mysqli_query($conexao, $sql_deleta)){
        echo "<script> alert('Parabéns DELETADO com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
        }else{
        echo "<script> alert('ERROR! USUARIO NÃO DELETADO'); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
        
        }
            }  
                }
                    }

if($VARbtnnn == "Excluir bairros"){
     $iB = 0;
$delBairro = $_POST['delBairro'];
     while ($delBairro[$iB] != ""){    
            foreach($delBairro as $itemB) {
            $sql_deleta = "DELETE FROM bairro WHERE NomeBairro = '".$itemB."'";
            $iB ++;    
            
          
        if(mysqli_query($conexao, $sql_deleta)){
        echo "<script> alert('Parabéns DELETADO com sucesso '); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
        }else{
        echo "<script> alert('ERROR! USUARIO NÃO DELETADO'); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php?modal=CadastraLocal.php';>";
        
        }
            }  
                }
                    }

 
?>