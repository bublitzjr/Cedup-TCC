<?php
include 'conexao.php';
session_start();
    
    if(!isset ($_SESSION['login']) == true){
        echo "<script> alert('Você precisa estar logado para visualizar seu perfil'); </script>";
        echo "<meta http-equiv=refresh content='0, url=index.php';>";
    }
?>
<html>
    <head>
        <style>
#checkRow
{
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     display: inline-block;
     position: relative;
     background-color: #f1f1f1;
     color: white;
     top: 10px;
     height: 30px;
     width: 30px;
     border: 0;
     border-radius: 5px;
     cursor: pointer;     
     margin-right: 7px;
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
            #btnRowA{   
    background-color: royalblue;
    color: white;
    font-size: 22;
    font-family: Alcubierre;
    padding: 12px 10px;
    border: none;
    border-radius: 5px;
    margin-top: 15px;
    margin-right: 10px;
}
        </style>
        
    </head>
<body>
<div id="divPainel" class="container-fluid">
<div class="row">
  
    <!-- NAVS -->
    <div style="width: 100%"> 
    
    <ul class="nav nav-tabs" style="margin-top: 20px">
    <li class="active"><a onclick="abrepagina('perfil.php')">Perfil Usuário</a></li> 

    <ul class="nav nav-tabs">
    <li class="active"><a onclick="abrepagina('imoveisCadastrados.php')">Imoveis cadastrados</a></li>
         
    <ul id="Painel" class="nav nav-tabs">
    <li class="active"><a onclick="abrepagina('cadastralocal.html')">Painel de Controle</a></li>
     
    </ul>
    </ul> 
    </ul>   
        
   
    <form id="frmCL">   
        <h1 style="font-size: 50">Painel de Controle</h1>
    </form>   
    </div>  
    
<!-- TIPO -->
  <div class="col-sm-4">   
      <form id="frmTipo" method="post" action="Cadastra_Local_Tipo.php">
<h2>Tipo</h2><br>
<input type="text" name="tipoC" required placeholder="Adicionar um Tipo..." style="font-size: 18">
<br>
<input id="btnCL" type="submit"  name="btnenvia" value="Enviar tipo" >  
</form>
      </div> 
    
<!-- CIDADE --> 
    <div class="col-sm-4">
    <form id="frmCidade" method="post" action="Cadastra_Local_Tipo.php">
  <h2>Cidade</h2><br>
  <input type="text" name="cidade" required placeholder="Adicionar um Cidade..." style="font-size: 18">
  <br>
 <input id="btnCL" type="submit"  name="btnenvia" value="Enviar cidade">
          </form>
        </div>
   

    
<!-- BAIRRO --> 
    
    <div class="col-sm-4">
       <form id="frmBairro" method="post" action="Cadastra_Local_Tipo.php">    
    <h2>Bairro</h2><br>
    <input type="text" name="bairro" required placeholder="Adicionar um Bairro..." style="font-size: 18">
    <br>    
    <input id="btnCL" type="submit" name="btnenvia" value="Enviar bairro"> 
    </form>
        </div>
   
    <div class="col-sm-12">
     <form id="frmCL" style="height: 500px" action="PainelLocais.php" method="post">
         <h1>Locais cadastrados</h1>
         <div class="col-sm-4">
         <h2>Tipos</h2>
         <?php
           
            $selectTipo = "SELECT * FROM tipo";
            $resultTipo = mysqli_query($conexao, $selectTipo); 
                         
            if(mysqli_num_rows($resultTipo)>0){
            while ($rowTipo = $resultTipo->fetch_assoc()) {
           echo "<input id='txtRow' name='altTipo[]' type='text' value='".$rowTipo['NomeTipo']."' > ";
            echo "<input id='checkRow' name='delTipo[]' readonly type='checkbox' value='".$rowTipo['NomeTipo']."'><br>";            
            }        
        }  
         ?>
             <input type="submit" id="btnRowA" name="btnnn" value="Alterar tipos">
            <input type="submit" id="btnRow" name="btnnn" value="Excluir tipos">
         </div>
         
         <div class="col-sm-4">
         <h2>Cidades</h2>
             <?php
           
            $selectCidade = "SELECT * FROM cidade";
            $resultCidade = mysqli_query($conexao, $selectCidade); 
                         
            if(mysqli_num_rows($resultCidade)>0){
            while ($rowCidade = $resultCidade->fetch_assoc()) {
            echo "<input id='txtRow' type='text' value='".$rowCidade['NomeCidade']."' > ";
            echo "<input id='checkRow' name='delCidade[]' readonly type='checkbox' value='".$rowCidade['NomeCidade']."'><br>";
          
            }        
        }  
         ?>
              <input type="submit" id="btnRowA" name="btnnn" value="Alterar cidades">
             <input type="submit" id="btnRow" name="btnnn" value="Excluir cidades">
         </div>
         
         
         <div class="col-sm-4">
         <h2>Bairros</h2>
                <?php
        
            $selectBairro = "SELECT * FROM bairro";
            $resultBairro = mysqli_query($conexao, $selectBairro); 
                         
            if(mysqli_num_rows($resultBairro)>0){
            while ($rowBairro = $resultBairro->fetch_assoc()) {
           echo "<input id='txtRow' type='text' value='".$rowBairro['NomeBairro']."' > ";
            echo "<input id='checkRow' name='delBairro[]' readonly type='checkbox' value='".$rowBairro['NomeBairro']."'><br>";            
            }        
        }  
         ?>
             <input type="submit" id="btnRowA" name="btnnn" value="Alterar bairros">
             <input type="submit" id="btnRow" name="btnnn" value="Excluir bairros">
         </div>
         
         <!-- VERIFICA SE EXISTE UM MODAL PARA FAZER O LOAD -->
        <?php if (isset($_GET['modal'])) : ?>
            <script>abrepagina('<?=$_GET['modal']?>')</script>
        <?php endif; ?>
    </form>
    </div>

   </div>
    </div>
    
    </body>
</html>