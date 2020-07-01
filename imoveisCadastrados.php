<?php
session_start();
?>

<html>
    
    <head>
     <style>
       #checkRow{
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     display: inline-block;
     position: relative;
     background-color: #f1f1f1;
     color: white;
     top: 15px;
     height: 40px;
     width: 40px;
     border: 0;
     border-radius: 5px;
     cursor: pointer;     
     margin-left: 7px;
     outline: none;
           
}
#checkRow:checked::before
{
     position: absolute;
     font: 15px/1 'Open Sans', sans-serif;
     left: 11px;
     top: 7px;
     content: '\02143';
     transform: rotate(40deg);
}
#checkRow:hover
{
     background-color: indianred;
}
#checkRow:checked
{
     background-color: indianred;
} 
         
         #btnExclui{
             background-color: indianred;
             border-style: none;
             color: white;
             padding: 7 12;
             border-radius: 5px;
         }
        </style>
    </head>
    <body>
<div id="containerLogin" class="container-fluid" >
        <div class="row">
            <div id="contLogin" class="" style="text-align:center; margin: 0 auto;">
                
                    <ul class="nav nav-tabs">
                    <li class="active"><a onclick="abrepagina('perfil.php')">Perfil Usuário</a></li>
                    
                    <ul class="nav nav-tabs">
                    <li class="active"><a onclick="">Imóveis cadastrados</a></li>
                        
                        </ul>
                        </ul>
                
     
                 <form id="formPerfil" method="post" style="background-color: white" action="Painel.php">
                     <h1 style="font-size: 50px">Imóveis cadastrados</h1>
                     
                     
                      <?php
                        include 'conexao.php';
                        
                        if(!isset ($_SESSION['login']) == true){
                        echo "<script> alert('Você precisa estar logado para visualizar seu perfil'); </script>";
                        echo "<meta http-equiv=refresh content='0, url=index.php';>";
                        }else{
                        $logado = $_SESSION['login'];

                        $select = "SELECT idUSUARIO FROM usuario WHERE login = '".$logado."'";
                        $result = mysqli_query($conexao, $select);
                        
                        if(mysqli_num_rows($result)>0){
                        $resultados = mysqli_fetch_object($result);
                        foreach ($resultados as $loginID){
                                
                        }
                    }
                        $selectImovel = "SELECT * FROM imovel WHERE FKUsuario = '".$loginID."'";
                        $resultImovel = mysqli_query($conexao, $selectImovel);
                        
                    
                        $selectImoveis = "SELECT u.Login, b.NomeBairro, t.NomeTipo,idIMOVEL FROM imovel i
                                            LEFT JOIN usuario u ON idUSUARIO = FKUsuario
                                            LEFT JOIN bairro b ON b.idBAIRRO = i.FKBairro
                                            LEFT JOIN tipo t ON t.idTIPO = i.FKTipo 
                                                
                                        WHERE u.login = '$logado'";
                        $resultImovel = mysqli_query($conexao, $selectImoveis);
                            $numRow = mysqli_num_rows($resultImovel);
                            if ($numRow != 0) {
                                while($rows = mysqli_fetch_object($resultImovel)) {
                                    echo"
                                    <div class='row'>
                                        <div class='col-sm-4'>
				                        <h3 class='title'>$rows->NomeBairro</h3>
                                        </div>
                                        <div class='col-sm-4'>
				                       <h3 class='title'>$rows->NomeTipo</h3>
                                       </div>
                                       <div class='col-sm-4' style='margin-top:20px'>
                                        <button value='$rows->idIMOVEL' id='btnExclui' name='btnn'>X</button>
                                        </div>
                                        </div>
                                           <hr style='border-style:solid; border-color:orange;'>
                                            ";
                                    
                           
                       //echo "<input id='checkRow' name='idImovel' readonly type='checkbox' value='".$row['idIMOVEL']."'><br>";
                      //echo"<input type='submit' id='btnLogout' name='btnn' value='Excluir selecionados' style='margin-right: 39%'>";
    
                            
                        }
                            
                        }else{
                                echo"<h3>Você não possui imóveis cadastrados</h3>";
                                echo "<img src='IMGS/jjtriste.png' width='100px' style='margin-top: 10px;margin-bottom:10px '>";
                                echo"<h3>Se você possui um imóvel de baixo custo para ajudar famílias que necessitam de um imóvel Cadastre já</h3>";
                               
                            }
                     
                        
                        
                        
                     
                     
                    $selectU = "SELECT * FROM usuario WHERE login = '".$logado."'";
                    $resultU = mysqli_query($conexao, $selectU); 
                    
                    $resultadoss = mysqli_fetch_object($resultU);
        
                    foreach ($resultadoss as $Admin) {
                    
                    if($Admin == 1){
                     echo "<head><style>#Painell{visibility:visible;}</style></head>";
                    }else{
                     echo "<head><style>#Painell{visibility:hidden;}</style></head>";    
                    }
                        }
                    
      
                        }
                     
                     
                 ?>
                     
                </form>
                
            </div>
    </div>
        </div>
    </body>
</html>