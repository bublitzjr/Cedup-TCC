<?php
    include 'conexao.php';
    session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
         <link href="IMGS/EstiloSite.css" rel="stylesheet" type="text/css"/>
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
        <style>
                   #btnContato{
          
    background-color: orange;
    color: white;
    font-size:20px;
    font-family: Alcubierre;
    padding: 15px 5px;
    border: none;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20
    
}
        </style>
    
    
    </head>
    
  <body style="background: white">
             <nav id="topo">
           <div class="container">
           <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#links-menu" style="background-color: white;">
					<i class="fas fa-align-right" style="font-size:21; color: darkorange"></i>
           </button>
           </div>
           </div>
        
        <nav id="links-menu" class="collapse navbar-collapse">
           <!--FAVORITOS-->   
                <div id="favHover">
                    <h4 id="fav" class="fas fa-heart">Favoritos</h4>
                    <div class="dropdown-content1">
                       <?php
                    
                        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
                            echo"Você precisa estar logado para favoritar";
                        } else {
                            $logado = $_SESSION['login'];

                            $selectFav = "SELECT i.idIMOVEL, b.NomeBairro, t.NomeTipo, concat('R$ ', i.Preco) as Preco
                                            FROM fav_imoveis f
                                            LEFT JOIN usuario u ON f.FKUsuario = u.idUSUARIO
                                            LEFT JOIN imovel i ON f.FKImovel = i.idIMOVEL
                                            LEFT JOIN tipo t ON t.idTIPO = i.FKTipo
                                            LEFT JOIN bairro b ON b.idBAIRRO = i.FKBairro
                                            WHERE u.login = '$logado'
                                            ORDER BY f.dt_log ASC;";
                            $resultFav = mysqli_query($conexao, $selectFav);
                            $numRow = mysqli_num_rows($resultFav);
                            if ($numRow != 0) {
                                while($rows = mysqli_fetch_object($resultFav)) {
                                    $historicoF[] = "<form method='POST' action='imovel.php'>
                                        <div id='Favoritos'>
                                        <h5 style='margin-top:20px; font-size:18; font-family: italic'>".$rows->NomeBairro."</h5>
                                        <h6>".$rows->NomeTipo." - ".$rows->Preco."</h6>
                                
                                        <button id='btnfav2' value='$rows->idIMOVEL' name='idIMOVEL'>Ver mais</button>
                                        <hr>
                                      </div></form>";
                                }
                                if ($numRow==1)
                                    $historicoF[] = 'Exibindo seu último favorito:<br>'; 
                                else
                                    $historicoF[] = 'Exibindo seus '.(($numRow<3) ? $numRow : '3').' últimos favoritos:<br>';
                            }
                                                                                
                            if (isset($historicoF) && !empty($historicoF)) {
                                $countLimit = -1;
                                if (count($historicoF)<4)
                                    $count = count($historicoF)-1;
                                else if (count($historicoF)==4)
                                    $count = 3;
                                else {
                                    $count = count($historicoF)-1;
                                    $countLimit = count($historicoF)-5;
                                }                            
                                for ($i=$count; $i>$countLimit; $i--)
                                    echo $historicoF[$i];
                            } else
                                echo "Sem Favoritos, favorite um imóvel";
                        }
                        
                   ?>
                        
                        
                    </div>
                </div>
           
        <!--HISTÓRICO -->   
            <div id="Favhover2">
                    <h4 id="hist" class="fas fa-history">Histórico</h4>
                    <div class="dropdown-content">
                    <?php
                    
                        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
                             echo"Você precisa estar logado para possuir um Historico.";
                        } else {
                            $logado = $_SESSION['login'];

                            $selectFav = "SELECT i.idIMOVEL, b.NomeBairro, t.NomeTipo, concat('R$ ', i.Preco) as Preco
                                            FROM hist_imoveis f
                                            LEFT JOIN usuario u ON f.FKUsuario = u.idUSUARIO
                                            LEFT JOIN imovel i ON f.FKImovel = i.idIMOVEL
                                            LEFT JOIN tipo t ON t.idTIPO = i.FKTipo
                                            LEFT JOIN bairro b ON b.idBAIRRO = i.FKBairro
                                            WHERE u.login = '$logado'
                                            ORDER BY f.dt_log ASC;";
                            $resultFav = mysqli_query($conexao, $selectFav);
                            $numRow = mysqli_num_rows($resultFav);
                            if ($numRow != 0) {
                                while($rows = mysqli_fetch_object($resultFav)) {
                                    $historico[] = "<form method='POST' action='imovel.php'>
                                        <div id='Historico'>
                                        <h5 style='margin-top:20px; font-size:18; font-family: italic'>".$rows->NomeBairro."</h5>
                                        <h6>".$rows->NomeTipo." - ".$rows->Preco."</h6>
                                
                                        <button id='btnhist' value='$rows->idIMOVEL' name='idIMOVEL'>Ver mais</button>
                                        <hr>
                                      </div></form>";
                                }
                                if ($numRow==1)
                                    $historico[] = 'Exibindo sua última visita:<br>'; 
                                else
                                    $historico[] = 'Exibindo suas '.(($numRow<3) ? $numRow : '3').' últimas visitas:<br>';
                            }
                                                                                
                            if (isset($historico) && !empty($historico)) {
                                $countLimit = -1;
                                if (count($historico)<4)
                                    $count = count($historico)-1;
                                else if (count($historico)==4)
                                    $count = 3;
                                else {
                                    $count = count($historico)-1;
                                    $countLimit = count($historico)-5;
                                }                            
                                for ($i=$count; $i>$countLimit; $i--)
                                    echo $historico[$i];
                            } else
                                echo "Sem histórico de busca, visite um imóvel ;)";
                        }
                        
                   ?>
                    </div>
                </div> 
        
           </nav>
       </nav>
        
        <div class="container-fluid" style="padding-left: 0px;padding-right: 0">
        <form id="faixaLogo" style="width: 100%; height: 150; background-color: orange;border-bottom: solid; border-color: darkorange">
            <div class="col-sm-10" >
            <a href="index.php">
                <img src="IMGS/thumbnail_arrasa%20nene02.png" style="width: 200px; margin-top: 25px; margin-left:100px; float: left">
                </a>
                <strong><h1 style="color: white; margin-top:60; margin-left: 520; font-family: Alcubierre; font-size:40">Essa é sua casa dos sonhos?</h1></strong>
                </div>
            <div class="col-sm-2">
           
            </div>
             
        </form>
            </div> 
      
      <div class="container-fluid">
          <div class="row">
      <div class="panel panel-default" style="height:436px; ">
        
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <div class="col-sm-5" style="width: 650px">
    <?php
       
        $imovel = $_POST['idIMOVEL'];
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
        }else{   
       
        
        $logado = $_SESSION['login'];
        
         $select = "SELECT idUSUARIO FROM usuario WHERE login = '".$logado."'";
         $result = mysqli_query($conexao, $select);
         $resultados = mysqli_fetch_object($result);
         foreach($resultados as $id){}
                                
        $INSERT = "INSERT INTO hist_imoveis (FKUsuario, FKImovel, dt_log) VALUES('$id','$imovel',now())";
        $conexao->query($INSERT);
        
        }
        $select = "SELECT * FROM imovel WHERE idIMOVEL = '$imovel'";
        $result = mysqli_query($conexao, $select);
                $rows = mysqli_num_rows($result);  
              if(isset($result)) {   
                        if ($rows > 0) {
                        while($rows = mysqli_fetch_array($result)) {
                            
             $selectNome = "SELECT NomeBairro FROM bairro INNER JOIN imovel ON bairro.idBAIRRO =  '".$rows['FKBairro']."'";       
            $resultNome = mysqli_query($conexao, $selectNome);
            $rowsNome = mysqli_fetch_array($resultNome);
             foreach ($rowsNome as $NomeB){
                          }          
      ?>
  
      <?php
              $selectIMG = "SELECT NomeOriginal FROM imovel_img INNER JOIN imovel ON imovel_img.FKImovel = '".$rows['idIMOVEL']."'";
              $resultIMG = mysqli_query($conexao, $selectIMG);
               $rowsIMG = mysqli_fetch_object($resultIMG);
             foreach ($rowsIMG as $IMG){
                
                 echo "<img src='IMGS/$IMG' style='width:100%;'>";        
             }
            ?> 
     
        
    
        
        </div>
      

   </div>
         
       <div class="col-sm-12" style="width: 600;">
            <h1 class="title"><?php echo $NomeB ?></h1>
            <p class="desc">R$ <?php echo $rows['Preco'] ?>  </p>
            <i class="fas fa-bed"> <?php echo $rows['Quartos'] ?> Quartos  </i>
            <i class="fas fa-car"> <?php echo $rows['Vaga'] ?> Vaga </i>
            <i class="fas fa-hot-tub"> <?php echo $rows['Suites'] ?> Suíte  </i>
            <i class="fas fa-arrows-alt"> <?php echo $rows['Tamanho'] ?>²  </i><br><br><br>
            <i style="font-size: 18">Descrição: </i><i style="font-size: 17"><?php echo $rows['descricao']?></i>
            
           <a href="imoveis.php"><input type="submit" value="Voltar" id="btnContato" style="float: right ;margin-right: 30px; margin-top:64;width:80px"></a>
            <form method="POST" action="favorito.php">
                <?php
                   $imovel = $_POST['idIMOVEL'];
                    echo"<input name='idIMOVEL' value='$imovel' style='visibility: hidden;'>"
                ?>
           <input type="submit" value="❤" id="btnContato" name="btnFavorito" style="float: right ;margin-right: 5px; margin-top:40;width:60px">
            
           </form>
    
          </div>
       
    
  </div>
          
              
</div>
         <?php
                    }
                 }
              }
    
          ?>
      </div>
     
        <div class="container-fluid" style="background-color: orange; height: 225px; border-top: solid; border-color: darkorange; text-align:center">
            <h1 style="color: white;font-family: Alcubierre">Parcerias</h1>
            <hr style="width:500">
             <img src="IMGS/minha-casa-minha-vida.png" width="110px" style="margin-right:60">
             <img src="IMGS/Caixa_Economica_Federal.png" width="120px" style="margin-right:60">
            <img src="IMGS/logo-mrv.png" width="120px">
        </div>
            
        <div id="Anuncie" class="col-sm-12" style="text-align:center; border-top:  solid; border-color: darkorange">
            <img src="IMGS/icone%20(2).png" width="100px" style="margin-top: 20px; ">
            <h2 style="font-family: Alcubierre;"> J&J Imobiliárias</h2>
         
            </div>
      
    </body>

</html>