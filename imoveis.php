<?php
include 'conexao.php';
session_start();
?>


<html>
    <head>
        <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <link href="IMGS/EstiloSite.css" rel="stylesheet" type="text/css"/>
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        
        <style>
        .collapsed-icon-toggle.collapsed .on-closed {
  display: initial;
}
.collapsed-icon-toggle.collapsed .on-opened {
  display: none;
}
.collapsed-icon-toggle .on-closed {
  display: none;
}
.collapsed-icon-toggle .on-opened {
  display: initial;
}
.scroll-v-250px {
  max-height: 250px;
  overflow-y: scroll;
}
.padding-v-xs {
  padding-top: 2px;
  padding-bottom: 2px;
}
.btn.ico span.icon {
  opacity: 0;
}
.btn.ico.active span.icon {
  opacity: 1;
}
            
.panel-group{
    margin-left:10px;
    margin-top: 20px;
    width: 300;
}
            
    #btnDet{      
    background-color: orange;
    color: white;
    font-size:20px;
    font-family: Alcubierre;
    padding: 15px 5px;
    border: none;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20;
    float: right;
    margin-right: 10px;
    margin-top: 80;
    
}
            #btnFav{
                background-color: orange;
                color: white;
                font-size:20px; 
                padding: 15px 20px;
                border: none;
                border-radius: 5px;
                float: right;
                margin-right: 20;
                margin-top: 80;
                width: 60px;
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
        <form id="faixaLogo" style="width: 100%; height: 150; background-color: orange;border-bottom:  solid; border-color: darkorange">
            <div class="col-sm-10">
            <a href="index.php"><img src="IMGS/thumbnail_arrasa%20nene02.png" style="width: 200px; margin-top: 25px; margin-left:100px; float: left"></a>
                <strong><h1 style="color: white; margin-top:60; margin-left: 415; font-family: Alcubierre; font-size:40">
                A casa dos seus sonhos pode estar aqui</h1></strong>
                </div>
            <div class="col-sm-2">
        
            </div>
                
        </form>
            </div> 

        
        <!-- IMOVEIS -->        
        <div class="container-fluid">
        <div class="col-sm-3" style="height:auto">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: orange">
                <h4 class="panel-title" style="color: white; ">
                    <a data-toggle="collapse" href="#filter1">
                        Como é a casa dos seus sonhos?
                    </a>
                    <a class="pull-right" data-toggle="collapse" href="#filter1">
                        <span style="color: white" class="glyphicon glyphicon-filter"></span>
                    </a>
                </h4>
            </div>
            <div id="filter1" class="panel-collapse collapse in" >
                <div class="panel-body">
                    <div class="filter-settings">
                    <form action="imoveis.php" method="POST">
                        <label style="color: black">Preço</label>
                        <a class="pull-right collapsed-icon-toggle" href="#coll-0" data-toggle="collapse">
                            <span style="color: orange" class="glyphicon glyphicon-minus on-opened"></span>
                            <span style="color: orange" class="glyphicon glyphicon-plus on-closed"></span>
                        </a>
                        <br/>
                        <div id="coll-0" class="collapse in">
                            <input type="text" name="valorMin" onkeyup="somenteNumeros(this);" placeholder="Valor minimo"/>
                            <input type="text" name="valorMax" name="preco" onkeyup="somenteNumeros(this);" placeholder="Valor maximo"/>
                            <!--FUNCÃO APENAS NUMEROS--> 
                            <script>
                            function somenteNumeros(num) {
                                var er = /[^0-9.]/;
                                er.lastIndex = 0;
                                var campo = num;
                                if (er.test(campo.value)) {
                                campo.value = "";
                                }      
                            }
                            </script>
                        </div>
                        <hr class="line"/>
                        <label style="color: black">Tipo Imóvel</label>
                        <a class="pull-right collapsed-icon-toggle" href="#coll-1" data-toggle="collapse">
                            <span style="color: orange" class="glyphicon glyphicon-minus on-opened"></span>
                            <span style="color: orange" class="glyphicon glyphicon-plus on-closed"></span>
                        </a>
                        <br/>
                        <!-- TIPO -->
                        <div id="coll-1" class="collapse in">
                            <div class="padding-v-xs" data-toggle="buttons">
                                   
                            <select id="tipoF" name="tipoC" >
                            <option style="color: darkorange" value="todos">Selecione o Tipo</option>
                            <?php 
                           
                            $query = mysqli_query($conexao, "SELECT * FROM tipo");
                            while($tipoC = mysqli_fetch_array($query)) { ?>
                            <option style="color: darkorange" value="<?php echo $tipoC['idTIPO'] ?>">
                            <?php echo $tipoC['NomeTipo'] ?>
                            </option>
                            <?php } ?>        
                            </select>

                               
                            </div>
                        </div>
                        
                        
                        <hr class="line"/>
                        
                        <label style="color: black">Cidade</label>
                        <a class="pull-right collapsed-icon-toggle" href="#coll-2" data-toggle="collapse">
                            <span style="color: orange" class="glyphicon glyphicon-minus on-opened"></span>
                            <span style="color: orange" class="glyphicon glyphicon-plus on-closed"></span>
                        </a>
                        <br/>
                        <div id="coll-2" class="scroll-v-250px collapse in">
                                    <select id="cidadeF" name="cidadeSelect">
                            <option style="color: darkorange" value="todos">Selecione a Cidade</option>
    
                        <?php 
                        $query = mysqli_query($conexao, "SELECT * FROM cidade ");
                        while($cidade = mysqli_fetch_array($query)) { ?>
                        <option style="color: darkorange" name="idcidade" id="idcidade" value="<?php echo $cidade['idCIDADE'] ?>">
                        <?php echo $cidade['NomeCidade'] ?>
                        </option>
                            

                        <?php } ?>  
                        </select>
                        </div>
                        
                        
                        <hr class="line"/>
                        <label style="color: black">Bairro</label>
                        <a class="pull-right collapsed-icon-toggle" href="#coll-3" data-toggle="collapse">
                            <span style="color: orange" class="glyphicon glyphicon-minus on-opened"></span>
                            <span style="color: orange" class="glyphicon glyphicon-plus on-closed"></span>
                        </a>
                        <br/>
                        <div id="coll-3" class="scroll-v-250px collapse in">
                            <div class="padding-v-xs" data-toggle="buttons">
                              <select id="bairroF" name="bairroSelect">
                           <option style="color: darkorange" value="todos">Selecione o Bairro</option> 
                            <script>
                        $("#cidadeF").on("change",function(){
                            var idEstado = $("#cidadeF").val();
                            
                            $.ajax({
                               url: 'pegaCidade.php',
                               type: 'POST',
                               data: {id:idEstado},
                               beforeSend: function(){
                                   $("#bairroF").html("Carregando...");
                               },
                                
                               success: function(data){
                                   $("#bairroF").html(data);
                               },
                                
                               Error: function(data){
                                   $("#bairroF").html("ERROR");     
                               }
                            });
                        });
                        </script>
                        </select>
                            </div>
                        </div>
                    
                        <hr class="line"/>
                        <button type="submit" class="btn btn-block btn-success" style="background-color: orange; border-color: orange">
                            
                            <span class="glyphicon glyphicon-search"></span>
                            
                        </button>
                    </form>
                        
                        
                    </div>
                </div>
            </div>
            
        </div>
          <div class="col-sm-20" style="height:auto">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: orange">
                <h4 class="panel-title" style="color: white; ">
                    <a data-toggle="collapse" href="#filter1">
                        Sobre programa social
                    </a>
                    <a class="pull-right" data-toggle="collapse" href="#filter1"> 
                    </a>
                </h4>
            </div>
             <div id="filter1" class="panel-collapse collapse in" >
                 <div class="panel-body">
                     <div class="filter-settings">
                         <label style="color: black">Operações Coletivas</label>
                         <p>Linha de crédito especial da CAIXA para pessoas com renda familiar de até R$ 1.750,00 adquirirem sua casa própria.</p>
                         <a style="color:darkorange">Saiba mais</a>
                         <hr>
                         <label style="color: black">Recursos FAR</label>
                         <p>Programa realizado em parceria com Distrito Federal, Estados e Municípios, que tem como objetivo a construção de 860 mil moradias para famílias, com renda até R$1.600,00.</p><a href="http://www.caixa.gov.br/poder-publico/programas-uniao/habitacao/minha-casa-minha-vida/Paginas/default.aspx/index.asp#como-funciona" style="color:darkorange">Saiba mais</a>
                         <hr>
                         <label style="color: black">Programa melhor morar</label>
                         <p>Mantido com recursos do Orçamento Geral da União - OGU, o Morar Melhor visa promover as condições de habitação e infraestrutura urbana, ampliando a cobertura de serviços de saneamento básico e ambiental. Além de promover o desenvolvimento urbano, dá a população carente, o direito à cidadania.</p><a href="http://www1.caixa.gov.br/gov/gov_social/municipal/programas_habitacao/morar_melhor/saiba_mais.asp" style="color:darkorange">Saiba mais</a> 
                         
                     </div>
                 </div>
            </div>
             </div>
        </div>
    </div>
            
    
    <form method="POST" action="imovel.php">
        <?php  
            // Setando os valores do post para viariaveis
            if (isset($_POST['valorMax']))
                $ValorMax = $_POST['valorMax'];
            else
                 $ValorMax = '9999999999';
                
            if (isset($_POST['valorMin']))
                $ValorMin = $_POST['valorMin'];
            else
                 $ValorMin = '1';
        
            if (isset($_POST['tipoC']))
                $tipo = $_POST['tipoC'];
            else
                $tipo = 'todos';
            
            if (isset($_POST['cidadeSelect']))
                $cidade = $_POST['cidadeSelect'];    
            else
                $cidade = 'todos';
        
            if (isset($_POST['bairroSelect']))
                $bairro = $_POST['bairroSelect'];    
            else
                $bairro = 'todos';
            
                $select = "SELECT * FROM imovel";
            
            if ($tipo!='todos' || $cidade!='todos' || $bairro!='todos' || $ValorMax!='9999999999' || $ValorMin!='1') :
                $select .= ' WHERE ';
            
                if ($tipo!='todos')
                    $select .= "FKTipo = '$tipo' AND ";
            
                if ($cidade!='todos')
                    $select .= "FKCidade = '$cidade' AND ";
            
                if ($bairro!='todos')
                    $select .= "FKBairro = '$bairro' AND ";
            
                if ($ValorMax!='')
                    $select .= "preco < '$ValorMax' AND ";
        
                 if ($ValorMin!='')
                    $select .= "preco > '$ValorMin' AND ";  
        
                $select .= ' 1=1';
            endif;
          
            
            

                $result = mysqli_query($conexao, $select);
                $rows = mysqli_num_rows($result);  
              if(isset($result)) {   
                        if ($rows > 0) {
                        while($rows = mysqli_fetch_array($result)) {
                    
            $selectNome = "SELECT NomeBairro FROM bairro INNER JOIN imovel ON bairro.idBAIRRO =  '".$rows['FKBairro']."'";       
            $resultNome = mysqli_query($conexao, $selectNome);
            $rowsNome = mysqli_fetch_object($resultNome);
             foreach ($rowsNome as $NomeB){
                          }
                        
                         ?>     
        <div class="col-sm-9" style="float: right">
            <div class="row" >
                  <div class="panel panel-default" style="height: 240px">
                <div class="col-sm-4" style="width: auto">
            <?php
              $selectIMG = "SELECT NomeOriginal FROM imovel_img INNER JOIN imovel ON imovel_img.FKImovel = '".$rows['idIMOVEL']."'";
              $resultIMG = mysqli_query($conexao, $selectIMG);
               $rowsIMG = mysqli_fetch_object($resultIMG);
             foreach ($rowsIMG as $IMG){
                
                 echo"<img src='IMGS/$IMG' style='width: 270; height:210; margin-top: 10px; margin-left: 10px; margin-bottom: 10px; margin-right: 10px'>";        
             }
            ?> 
         
                 
            </div>
                     
                    
                <div>
                <h3 class="title"><?php echo $NomeB ?></h3>
                <p class="desc">R$ <?php echo $rows['Preco'] ?>  </p>
                <i class="fas fa-bed"> <?php echo $rows['Quartos'] ?> Quartos  </i>
                <i class="fas fa-car"> <?php echo $rows['Vaga'] ?> Vaga </i>
                <i class="fas fa-hot-tub"> <?php echo $rows['Suites'] ?> Suíte  </i>
                <i class="fas fa-arrows-alt"> <?php echo $rows['Tamanho'] ?>²  </i>
                <button value="<?php echo $rows['idIMOVEL']?>" name="idIMOVEL" type="submit" id="btnDet">Ver Detalhes</button>
                </div>
                </div>
                </div>  
                
              
           </div>   
               <?php
                               }
                        }
              }
                      
                    ?>
            </form>
           </div>
      
        
        
        
        <div class="container-fluid" style="background-color: orange; height: 225px; border-top: solid; border-color: darkorange; text-align:center">
            <h1 style="color: white;font-family: Alcubierre">Possíveis parcerias</h1>
            <hr style="width:500">
             <img src="IMGS/minha-casa-minha-vida.png" width="110px" style="margin-right:60">
             <img src="IMGS/Caixa_Economica_Federal.png" width="120px" style="margin-right:60">
        </div>
            
        <div id="Anuncie" class="col-sm-12" style="text-align:center; border-top:  solid; border-color: darkorange">
            <img src="IMGS/icone%20(2).png" width="100px" style="margin-top: 20px; ">
            <h2 style="font-family: Alcubierre;"> J&J Imobiliárias</h2>
         
            </div>
            
        
    </body>
</html>


