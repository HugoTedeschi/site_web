<head>
<title> Catalogue</title>
 <link href='style.css' rel='stylesheet' type='text/css'>
<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
…
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php include("menu.php"); ?>
<h2>Bienvenue sur notre catalogue en ligne !</h2>
<p    Vous retrouverez ici tous nos instruments !  text = center</p>
	




</head>

<body>

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
$marque ="";
$modele ="";

$result_prix = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);






$result_marque = $link->query( "(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque'
GROUP BY modele, type, nom_fourn
ORDER BY prix);" )
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


 <p2>
 
 <button onclick='envoyer(0);'> bouton test</button>
 </p2>
		<br>
		
        Voir les instruments d'une marque particulière:
        <form method='POST'>
		<select id='marque' name='marque' size='1' tabindex='5'>
		<option value='0'>pas de selection particulière
		<option value='1'>Fender
		<option value='2'>Gibson
		<option value='3'>Yamaha
		<option value='3'>Kumalae
		<option value='3'>Selmer
		<option value='3'>Hohner
		<option value='3'>Catania
		</select><br>
		<br>
		
		</form>
	
		<button onclick='envoyer(9);'></button>
		
		
       

";
if (isset($_POST['marque']))
{
	
	$choix = $_POST['marque'];
	if ($choix==1)
	{
		echo "on a ecrit fender";
	}
	elseif ($choix==2)
	{
		echo "on a ecrit gibson";
	}
	elseif ($choix==3)
	{
		echo "on a ecrit Yamaha";
	}
}

print "<table width=200 border=1>\n";

print "<form id='FormulaireCommande' method='POST' action='commande.php' 
 <input type='reset' value='Recommancer la commande'>
 <input type='reset' value='Recommancer la commande'>
		<input type='submit' value='Passer la commande'>    ";


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
 
 
       		
while ($get_info = $result_prix->fetch_row()){
 print "<tr>\n";
 
 
 
 
 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
 foreach ($get_info as $field)  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
 print "\t<td> $field</td>\n";
 
 print "\t<td> <input type='checkbox' name= 'test' value='$get_info[0]'></td>\n";
 print "</tr>\n"; // permet de séparer les lignes de la table entres-elles.
}


print "</form>";
print "</table>\n";

$result_prix-->free();



$link->close();
?>




</body>
