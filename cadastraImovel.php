<style>
#formCadastra{
    background-color: white;
    height: 750; 
    font-family: Alcubierre;
    width:77%;
    margin-top: 15px;
    border-radius: 15px;
    margin-left: 15%    
}
    
    #tipoCAD{
    width:20%;
    font-family: Alcubierre;
    font-size:17px;
    background-color: transparent;
    color: black;
    border-width: 2px;
   border: 1px solid #ccc;
}
    
    input[type=text]{
    width: 15%;
    padding: 12px 20px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 15px;
}
    
    #btnEntra{
        float: right;
        margin-right: 30px;
    }
    #cidade{
    width:20%;
    font-family: Alcubierre;
    font-size:17px;
    background-color: transparent;
    color: black;
    border-width: 2px;
    border: 1px solid #ccc;
    text-shadow:none;
    }
    
    #bairro{
    width:20%;
    font-family: Alcubierre;
    font-size:17px;
    background-color: transparent;
    color: black;
    border-width: 2px;
    border: 1px solid #ccc;
    text-shadow:none;
    }
    
    #btnSugeste{
    font-size: 16;
    background-color: royalblue;
    color: white;
    font-family:Alcubierre;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    margin-right: 15px;  
    }
    
</style>

<?php
session_start();

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
    echo "<script> alert('Você precisa estar logado para cadastrar um imóvel'); </script>";
    echo "<meta http-equiv=refresh content='0, url=index.php';>";
}else{
?>

<div class="container-fluid" >

    <div class="col-sm-12">

    <form id="formCadastra" method="post" enctype="multipart/form-data" action="cadastra_imovel.php">
  <br><br><h1 style="font-size:45">Cadastro de imóveis</h1><hr style="border-top: 3px solid orange; width: 450"><br>
  
        <h2 style="">Caracteristicas do imóvel</h2>
  <input type="text" name="vagas" placeholder="Vagas" required>
   
  <input type="text" name="quartos" placeholder="Quartos" required>
   
  <input type="text" name="suites" placeholder="Suites" required>
 
    <script>
            function sugestao(form) {
            var area = (eval(form.tamanho.value*1200));
            form.preco.value = area;
            }
    </script>
        
  <input type="text" name="tamanho" placeholder="Tamanho" required>
  <input type="text" name="preco" placeholder="Preco" required>
  <input id="btnSugeste" type="button" value="Sugerir" onClick="sugestao(this.form);" /><p/>
  

  
  <h2 style="">Tipo e local do imóvel</h2>     
<select id="tipoCAD" name="tipoSelect">
    <option style="color: darkorange">Selecione o tipo</option>
     <?php 
                    include 'conexao.php';
                    $query = mysqli_query($conexao, "SELECT * FROM tipo");
                    while($tipoC = mysqli_fetch_array($query)) { ?>
                    <option value="<?php echo $tipoC['idTIPO'] ?>">
                    <?php echo $tipoC['NomeTipo'] ?>
                    </option>value
                    <?php } ?>               
      
  </select>
   
            <select id="cidade" name="cidadeSelect">
            <option style="color: darkorange" value="todos">Selecione a Cidade</option>
    
                        <?php 
                        $query = mysqli_query($conexao, "SELECT * FROM cidade ");
                        while($cidade = mysqli_fetch_array($query)) { ?>
                        <option style="color: darkorange" name="idcidade" id="idcidade" value="<?php echo $cidade['idCIDADE'] ?>">
                        <?php echo $cidade['NomeCidade'] ?>
                        </option>
                            

                        <?php } ?>  
                        </select>
                        
                        
                        <select id="bairro" name="bairroSelect">
                           <option style="color: darkorange" value="todos">Selecione o Bairro</option> 
                            <script>
                        $("#cidade").on("change",function(){
                            var idEstado = $("#cidade").val();
                            
                            $.ajax({
                               url: 'pegaCidade.php',
                               type: 'POST',
                               data: {id:idEstado},
                               beforeSend: function(){
                                   $("#bairro").html("Carregando...");
                               },
                                
                               success: function(data){
                                   $("#bairro").html(data);
                               },
                                
                               Error: function(data){
                                   $("#bairro").html("ERROR");     
                               }
                            });
                        });
                        </script>
                        </select>
    <br><br>
    
    <h2 style="">Descrição do imóvel</h2>  
   <textarea name="descricao" rows="5" cols="90"></textarea>
  
         <br><br>
    <button id="btnEntra" name="btnenvia">Enviar</button>    
   <input style="margin-left:30;" name="arquivo" type=file multiple required/>
       
 
    
  
    
</form>
    
    </div>
    <div class="col-sm-3"></div>
    
<?php
}
    ?>