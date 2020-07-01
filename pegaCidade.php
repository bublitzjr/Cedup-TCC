<html>
<head>
 <meta charset="UTF-8">
</head>
</html>
    
<?php
include 'conexao.php';
$id = $_POST['id'];


$pegaBairro = mysqli_query($conexao,"SELECT * FROM bairro where FKCidade = $id");
 while($bairro = mysqli_fetch_array($pegaBairro)) { 
                       
                        echo"<option style='color: darkorange' name='bairro' value='".$bairro['idBAIRRO']."'>".$bairro['NomeBairro']."</option>";
                        
 
 }
?>