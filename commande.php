
<head>
<title>Commande</title>

	
	

<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
…
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link href='style.css' rel='stylesheet' type='text/css'>
  <?php include("header.php"); ?>

	
</head>




<?php

echo  " <p  style='color:white;'> Merci pour votre confiance en nous<br> voici les articles commandé: </p><br>";

if(isset($_POST['commande'])){

    if(!empty($_POST['formulaire'])) {    
        foreach($_POST['formulaire'] as $value){
			
            echo " <p  style='color:white;'> article commandé: $value </p><br/>";
        }
    }

}
echo  " <p  style='color:white;'>Merci de valider la commande suivante en appyant sur \"valider la commande \".</p>";

















print "<table width=300 border=1   style='background:black; color:white;'>\n";


print "<form id='FormulaireCommande'  method='POST' action='commande.php'";



print "<tr>\n";

 print "\t<td><input type='reset' value='Recommancer la commande' style='width:350px; background:grey;'></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td><input type='submit' value='Passer la commande' name ='commande'style='width:350px; background:grey;'></td>\n";
    
  
 print "</tr>\n";
 
 


print "<tr>\n";

$value = "Modèle";
 print "\t<td>$value</td>\n";
 $value = "Type           ";
  print "\t<td>$value</td>\n";
  $value = "Marque";
  print "\t<td>$value</td>\n";
  $value = "Prix";
  print "\t<td>$value</td>\n";
  $value = "Nb";
  print "\t<td>$value</td>\n";
  $value = "Commander:";
  print "\t<td>$value</td>\n";
  
 print "</tr>\n";
 
 
$sql_marque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_marque = $link->query( $sql_marque )
or die("SELECT Error: ".$link->error);
 
 if($marque == 'rien')
 {
	 $result = $catalogue;
 }
 else
 {
	 $result = $result_marque ;
	 
	
 }
       		
while ($get_info = $result->fetch_row()){
 print "<tr>\n";
 
 
 
 
 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
 foreach ($get_info as $field)
 {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
	print "\t<td> $field</td>\n";
 }
 print "\t<td> <input type='checkbox' name= 'formulaire[]' value='$get_info[0]'></td>\n";
 
 
 
 print "</tr>\n"; // permet de séparer les lignes de la table entres-elles.
}


print "</form>";
print "</table>\n";


//~ CREATE TABLE PreCommande( modele VARCHAR(128) , type VARCHAR(128), nom_fourn VARCHAR(128), prix INT(10), nombre INT(10) )
?>
