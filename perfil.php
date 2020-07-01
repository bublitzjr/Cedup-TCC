<?php
session_start();
?>
<html>
    
    <head>
        <script src="Script/JavaScript.js" type="text/javascript"></script>
        <style>
        
        </style>    
    </head>
    
    <div id="containerLogin" class="container-fluid" >
        <div class="row">
            <div id="contLogin" class="" style="text-align:center; margin: 0 auto;">
                
                    <ul class="nav nav-tabs">
                    <li class="active"><a onclick="">Perfil Usuário</a></li>
                    
                    <ul class="nav nav-tabs">
                    <li class="active"><a onclick="abrepagina('imoveisCadastrados.php')">Imóveis cadastrados</a></li>
<!--
                        
                    <ul id="Painel" class="nav nav-tabs">
                    <li class="active"><a onclick="abrepagina('cadastralocal.php')">Painel de Controle</a></li>
                        
                        </ul>
-->
                        </ul>
                        </ul>
                
     
                 <form name="formPerfil" id="formPerfil" method="post" style="background-color: white" action="logout.php">
                     <h1 style="font-size: 50">PERFIL</h1>
                     <?php
                        include 'conexao.php';
                        if(!isset ($_SESSION['login']) == true){
                        echo "<script> alert('Você precisa estar logado para visualizar seu perfil'); </script>";
                        echo "<meta http-equiv=refresh content='0, url=index.php';>";
                        }else{
                        $logado = $_SESSION['login'];
                        echo "<h2>Seja bem vindo $logado</h2><br>";
                      
                      
                        $select = "SELECT login FROM usuario WHERE login = '".$logado."'";
                        $result = mysqli_query($conexao, $select);
                        
                        if(mysqli_num_rows($result)>0){
                        $resultados = mysqli_fetch_object($result);
                        foreach ($resultados as $login){
                            echo"<input type='text' readonly name='loginUp' value='$login'> ";          
                            }
                        }
                  
                        $selectSenha = "SELECT senha FROM usuario WHERE login = '".$logado."'";
                        $resultSenha = mysqli_query($conexao, $selectSenha);
                         if(mysqli_num_rows($resultSenha)>0){
                        $resultadosSenha = mysqli_fetch_object($resultSenha);
                        foreach ($resultadosSenha as $senha){
                            echo"<input type='text' name='senhaUp' value='$senha'> ";          
                            }
                        }
               
                        $selectEmail = "SELECT email FROM usuario WHERE login = '".$logado."'";
                        $resultEmail = mysqli_query($conexao, $selectEmail);
                         if(mysqli_num_rows($resultEmail)>0){
                        $resultadosEmail = mysqli_fetch_object($resultEmail);
                        foreach ($resultadosEmail as $Email){
                            echo"<input type='text' name='emailUp' value='$Email'> ";          
                            }
                        }
                            
                        $selectcpf = "SELECT CPFCNPJ FROM usuario WHERE login = '".$logado."'";
                        $resultcpf = mysqli_query($conexao, $selectcpf);
                         if(mysqli_num_rows($resultcpf)>0){
                        $resultadoscpf = mysqli_fetch_object($resultcpf);
                        foreach ($resultadoscpf as $cpf){
                            echo"<input type='text' name='cpfUp' readonly value='$cpf'>";          
                            }
                        }
                     
                    $selectU = "SELECT * FROM usuario WHERE login = '".$logado."'";
                    $resultU = mysqli_query($conexao, $selectU); 
                    
                    $resultados = mysqli_fetch_array($resultU);
        
                    foreach ($resultados as $Admin) {
                    
                    if($Admin == 1){
                     echo "<style>#Painel{visibility:visible;}</style>";
                    }else{
                     echo "<style>#Painel{visibility:hidden;}</style>";    
                    }
                        }
                           
                     ?>
                     
                     <!--   <button id="btnLogout">Sair</button> -->
                     <input type="submit" id="btnLogout" name="btn" value="Sair">
                     <input type="submit" id="btnLogout" name="btn" value="Excluir">
                     <input type="submit" id="btnCadastra" name="btn" value="Alterar">
                    <?php    
                     }
                     ?>
                </form>
  <!-- 
                 <form action="excluir_conta.php">
                 <button id="btnLogout" onclick="excluir_conta.php">Excluir</button> 
                    </form>
  -->
             
                 
            </div>
        </div>
    </div>
</html>
