<?php
session_start();
include 'conexao.php';       
?>
<html>
    <head>
        <title> J & J Imobiliárias</title>
        <meta charset="UTF-8">
        <!-- ICONE LOGO -->
        <link rel="icon" href="IMGS/icone%20(2).png"/>
        <!-- CSS -->
        <link href="IMGS/EstiloSite.css" rel="stylesheet" type="text/css"/>
        <!-- BOTSTRAP -->  
        <link href="bootstrap-4.0.0/js/dist/carousel.js" rel="stylesheet">
        <link href="bootstrap-4.0.0/dist/css/bootstrap-grid.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!-- ICONS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <!-- SCRIPT -->
        <script src="Script/JavaScript.js" type="text/javascript"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    </head>
  
    
    <body>

       <nav id="topo">
        <nav id="links-menu">
            <a href="index.php" id="imglogo"><img src="IMGS/icone%20(2).png" width="53px" style="margin-left: 20px; "></a>
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

                            $selectHist = "SELECT i.idIMOVEL, b.NomeBairro, t.NomeTipo, concat('R$ ', i.Preco) as Preco
                                            FROM hist_imoveis f
                                            LEFT JOIN usuario u ON f.FKUsuario = u.idUSUARIO
                                            LEFT JOIN imovel i ON f.FKImovel = i.idIMOVEL
                                            LEFT JOIN tipo t ON t.idTIPO = i.FKTipo
                                            LEFT JOIN bairro b ON b.idBAIRRO = i.FKBairro
                                            WHERE u.login = '$logado'
                                            ORDER BY f.dt_log ASC;";
                            $resultFav = mysqli_query($conexao, $selectHist);
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

      
        <!-- CONTEUDO -->
            
        <div id="div3" name="div3" class="container-fluid" style="margin: 0" >
            <div id="cont" class="col-sm-12">
                <?php
                        if(!isset ($_SESSION['login']) == true){
                            echo"<style>#btnVperfil{visibility: hidden;}</style>";
                        }else{
                             echo"<style>#btnLogin{visibility: hidden;}</style>";
                        }
                ?>
                <button onclick="abrepagina('login.html')" id="btnLogin">Login</button>
           
                <img src="IMGS/user%20(1).png" id="btnVperfil"  onclick="abrepagina('perfil.php')" width="80">  
      
                <!--<button onclick="abrepagina('perfil.php')" id="btnVperfil">Ver Perfil</button>-->
                 <h4 id="text"><strong>Onde fica sua casa dos sonhos ?</strong></h4>
              
                
                <form name="busca" method="post" action="imoveis.php">
                    <strong>
                        <select id="tipo" name="tipoC" >
                            <option style="color: darkorange" value="todos">Selecione o Tipo</option>
                            <?php 
                           
                            $query = mysqli_query($conexao, "SELECT * FROM tipo");
                            while($tipoC = mysqli_fetch_array($query)) { ?>
                            <option style="color: darkorange" value="<?php echo $tipoC['idTIPO'] ?>">
                            <?php echo $tipoC['NomeTipo'] ?>
                            </option>
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
                        </select><br>
                    </strong>
                    <input type="submit" id="btnBusca" value="Buscar">
                </form>
          </div>   
      </div>
        
    <!-- DESTAQUES -->    
    <div id="destaques">
    <h1 id="labelText">✮ Itens em Destaques ✮</h1>    
        <div id="labelDest">  
        </div>
        <div class="container">
            <div class="row" id="items">
        <?php
        $query_destaque = mysqli_query($conexao,"SELECT *, count(idIMOVEL) 
                          FROM hist_imoveis h
                          LEFT JOIN imovel i on h.FKImovel = i.idIMOVEL
                          LEFT JOIN bairro b on b.idBAIRRO = i.FKBairro
                          LEFT JOIN imovel_img c on c.FKImovel = i.idIMOVEL  
                          GROUP BY idIMOVEL DESC
                          LIMIT 0,6");
        if(mysqli_num_rows($query_destaque)==0){  
        echo "<div class='container-fluid'>
                <img src='IMGS/jjtriste.png' style='margin-top:0px;margin-bottom:10px;'>
                <h3>EM BREVE IMÓVEIS...</h3><br>
              </div>
                ";
      
        }else{
        while($destaques = mysqli_fetch_array($query_destaque)) {
        echo"<form method='POST' action='imovel.php'>
         
            <div class='col-md-4'>
	       <figure class='card card-product'>
		  <div class='img-wrap'><img src='IMGS/".$destaques['NomeOriginal']."'></div>
		  <figcaption class='info-wrap'>
				<h4 class='title'> ".$destaques['NomeBairro']."</h4>
				<p class='desc'>R$ ".$destaques['Preco']."</p>
				<div class='rating-wrap'>
					<div class='label-rating'>
                    <i class='fas fa-bed'> ".$destaques['Quartos']." Quartos </i>
                    <i class='fas fa-car'> ".$destaques['Vaga']." Vagas</i>
                    <i class='fas fa-hot-tub'> ".$destaques['Suites']." Suítes</i>
                    <i class='fas fa-arrows-alt'> ".$destaques['Tamanho']."²</i>
                    <button name='idIMOVEL' value='".$destaques['idIMOVEL']."'style='border:none; background-color:white;color:darkorange; font-size: 15'>
                    Ver mais</button>
                    </div>
				</div>
		</figcaption>

	</figure>
 
</div> 
</form>           
        ";
        
        }
        }
        
        ?>
                </div>
            
            </div>
         </div> 
    
        <div id="Obj" class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
            <h1>Simule seu financiamento</h1>
            <hr style="width: 400">
           <div class="container">
  <div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
      <h3>Com o Simulador Caixa Minha Casa Minha Vida o cidadão, cliente e futuro dono de sua casa própria, terá acesso a diversas maneiras de financiar sua casa própria, com valores reais e originais, sem falsas expectativas. 
          <strong><a href="https://programaminhacasaminhavida.net/simulador-caixa-minha-casa-minha-vida/?gclid=Cj0KCQjwgOzdBRDlARIsAJ6_HNn3B8XRbWHSQBlHGItnbxoHPef8RSthRdd-Rh8czXe5WVDuMQu_pZkaAuJOEALw_wcB" style="color: white">Simule aqui</a></strong></h3><br>

      </div>
    </div>
  </div>            
</div> 
</div>
          
        
        <div id="Anuncie" class="col-sm-12" style="text-align:center">
            <img src="IMGS/icone%20(2).png" width="100px" style="margin-top: 20px; ">
            <h2 style="font-family: Alcubierre;"> Quer anunciar seu imóvel, <a href="#" onclick="abrepagina('cadastraImovel.php')" style="color: orange">Clique aqui</a></h2>
         
            </div>
            </div>
        </div>
        
        <!-- VERIFICA SE EXISTE UM MODAL PARA FAZER O LOAD -->
        <?php if (isset($_GET['modal'])) : ?>
            <script>abrepagina('<?=$_GET['modal']?>')</script>
        <?php endif; ?> 
            </body>
</html>
