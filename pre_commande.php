
<head>
<title>Pré Commande</title>



<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
…
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link href='style.css' rel='stylesheet' type='text/css'>
  <?php include("menu.php"); ?>

	
</head>




<?php
if(!isset($_POST['formulaire'])){
	echo  " <p  style='color:white; text-align: center;'> Il semblerait que rien n'ait été selectionné !<br> voici les articles commandé: </p><br>";
	
print "<form id='FormulaireCommande'  method='POST' action='catalogue.php'";
print "<center><input type='submit' value='Recommancer la commande' style='width:1500px; font-size: 80px; background:grey;'></center>"; 
}

if(isset($_POST['commande'])){

    if(!empty($_POST['formulaire'])) { 
		

echo  "<p  style='color:white;'>Merci de valider la commande suivante en appyant sur \"valider la commande \".</p>";

print "<table width=300 border=1   style='background:black; color:white;'>\n";
print "<tr>\n";


print "<form id='FormulaireCommande'  method='POST' action='catalogue.php'";
print "\t<td><input type='submit' value='Recommancer la commande' style='width:1000px; font-size: 60px; background:grey;'></td>\n"; 


 
print "<form id='FormulaireCommande'  method='POST' action='commande.php'"; 
print "\t<td><input type='submit' value='Valider la commande' name ='commande'style='width:1000px; font-size: 60px; background:grey;'></td>\n";
    
    
 print "</tr>\n";
print "</form>";
print "</table>";


$link = new mysqli('localhost', 'user', 'user', 'madata');
if ($link->connect_errno) {
 die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
}
		 //~ array_keys($_POST['formulaire']);   
		echo  " <p  style='color:white;'> Merci pour votre confiance en nous<br> voici les articles commandé: </p><br>";
		 print "<table width=300 border=1   style='background:black; color:white;'>\n";
        foreach($_POST['formulaire'] as $ligne){
			   
				  echo"<tr>\n";
			      echo "\t<td></tr> <p  style='color:white;'> --> $ligne</p><br/></td>\n";
			      echo"</tr>\n";
			      
			    $catalogue = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
				FROM liste_stockes
				GROUP BY modele, type, nom_fourn
				ORDER BY prix
				WHERE modele='$ligne';" )
				or die("SELECT Error: ".$link->error);
  
			    
					
				
			}
		
		print "</table>\n";
		
	$result_marque = $link->query( $sql_marque )
	or die("SELECT Error: ".$link->error);
		
	$catalogue = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
	FROM liste_stockes
	GROUP BY modele, type, nom_fourn
	ORDER BY prix
	WHERE modele='$ligne';" )
	or die("SELECT Error: ".$link->error);
  
  
  
	


//~ CREATE TABLE PreCommande( modele VARCHAR(128) , type VARCHAR(128), nom_fourn VARCHAR(128), prix INT(10), nombre INT(10) )
	}

	}
?>
