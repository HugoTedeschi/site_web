<head>
<title> Catalogue</title>
 <link href='style.css' rel='stylesheet' type='text/css'>
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

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

$result = $link->query( "SELECT * FROM liste_stockes" )
or die("SELECT Error: ".$link->error);

print "<table width=200 border=1>\n";



$value = "Modèle";
 print "\t<td>$value</td>\n";
 $value = "Type           ";
  print "\t<td>$value</td>\n";
  $value = "Marque";
  print "\t<td>$value</td>\n";
  $value = "Adresse";
  print "\t<td>$value</td>\n";
  $value = "Ville";
  print "\t<td>$value</td>\n";
  $value = "Prix";
  print "\t<td>$value</td>\n";
  $value = "Nb";
  print "\t<td>$value</td>\n";
 print "<tr>\n";
 
//echo "<form action="commande" method="POST">";
while ($get_info = $result->fetch_row()){

 //print "<input type="checkbox" name="test" value="Boat"><br>";
 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
 foreach ($get_info as $field)  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
 print "\t<td> $field</td>\n";
 
 print "<tr>\n"; // permet de séparer les lignes de la table entres-elles.
}
//~ echo "<input type="submit value"="envoyer">";
echo "</form>";


print "</table>\n";
$result->free();



$link->close();
?>




</body>
