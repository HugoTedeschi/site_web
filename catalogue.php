<head>
<title> Catalogue</title>



<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
…
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link href='style.css' rel='stylesheet' type='text/css'>
  <?php include("menu.php"); ?>

	
</head>


<body style='background:black; color:white;'>
	
	<h2>Bienvenue sur notre catalogue en ligne !</h2>
		<form action="catalogue.php" >
		<center>	<input type="submit" value="Revenir au catalogue"  style='width:500px; background:grey; padding : 20px; font-size: 40px; text-align: center;' /></center>
		</form>
	<p style='text-align: center;font-size: 25px'>  Vous retrouverez ici tous nos instruments ! </p>


	
<?php


$link = new mysqli('localhost', 'user', 'user', 'madata');
if ($link->connect_errno) {
 die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
}
/*
 * 1) Ici, il faut d'abord afficher liste stocké
 * 2) Il faut proposer un selection/option pour recpurer quelle marque est voulue
 * 3) il faut recupere la valeur du select option et afficher le tableau correspondant
 * 4) il faut proposer un formulaire pour recharcher un objet par son nom, magasin, prix etc. 
 * 
 * 
 */
 
 
$prix=0;
$marque ='rien';
$modele ='rien';

$catalogue = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);


$result_modele = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE modele = '$modele'
GROUP BY modele, type, nom_fourn
ORDER BY modele;" )
or die("SELECT Error: ".$link->error);

$result_inf = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE prix<$prix
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);

$result_sup = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE prix>$prix
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);



print "

	<table style='background:black; color:white;'>
		<br>
		<td>
         <form method = 'post'>  
           
              
            <select name = 'choix_marque'style='background:black; color:white;'>   
                <option value = 'rien'>Aucune marque selectionnée</option> 
                <option value = 'Fender'>Fender</option> 
                <option value = 'Gibson'>Gibson</option> 
                <option value = 'Kumalae'>Kumalae</option> 
                <option value = 'Selmer'>Selmer</option> 
                <option value = 'Yamaha'>Yamaha</option> 
                <option value = 'Hohner'>Hohner</option> 
             
            </select> 
            <input type = 'submit' name = 'submit' value = Submit> 
        </form> 
	    </td>
		
	
	</table>
		
		
       

";
  if(isset($_POST["submit"]))  
    { 
        // Check if any option is selected 
        if(isset($_POST['choix_marque']))  
        { 
			$marque = $_POST['choix_marque'];
              
                print "vous avez choisis de voir les instruments de la marque $marque<br/>"; 
        } 
    else
        echo "Aucune marque selectionnée, retour au catalogue des instruments."; 
    } 



print "<table width=300 border=1   style='background:black; color:white;'>\n";


print "<form id='FormulaireCommande' method='POST' action='commande.php'";



print "<tr>\n";

 print "\t<td><input type='reset' value='Recommancer la commande' style='width:350px; background:grey;'></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td><input type='submit' value='Passer la commande' style='width:350px; background:grey;'></td>\n";
    
  
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
var_dump($result_marque);
 
 if($marque == 'rien')
 {
	 $result = $catalogue;
 }
 else
 {
	 $result = $result_marque ;
	 
	 echo "else, on affecte $marque à la table";
	 
 }
       		
while ($get_info = $result->fetch_row()){
 print "<tr>\n";
 
 
 
 
 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
 foreach ($get_info as $field)
 {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
	print "\t<td> $field</td>\n";
 }
 print "\t<td> <input type='checkbox' name= 'test' value='$get_info[0]'></td>\n";
 
 
 
 print "</tr>\n"; // permet de séparer les lignes de la table entres-elles.
}


print "</form>";
print "</table>\n";

$result-->free();
$link->close();
?>




</body>
