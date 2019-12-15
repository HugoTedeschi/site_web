<html>
	<head>
		<title> Catalogue</title>
		<?php include("header.php"); ?>
	</head>


	<body>

<?php

	$link = new mysqli('localhost', 'user', 'user', 'madata');
	if ($link->connect_errno) 	die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
	
	print "<p>contact :</p>";
	print "<table width=300 border=1   style='background:black; color:white;'>\n";
		print "<tr>\n";

			  $value = "Nom";
			  print "\t<td>$value</td>\n";
			  $value = "Prénom          ";
			  print "\t<td>$value</td>\n";
			  $value = "mail";
			  print "\t<td>$value</td>\n";

		print "</tr>\n";
 
 
	$adresse=$_POST['adresse'];
	$sql_contact ="SELECT v.nom, v.prenom, v.mail
					FROM Vendeur v
					WHERE '$adresse'=v.nom_mag";
					
	$result= $link->query($sql_contact)
		or die("SELECT Error: ".$link->error);

	
	while ($get_info = $result->fetch_row()){
		
		
		 print "<tr>\n";
			 
			 foreach ($get_info as $field)
			 {  
				print "\t<td> $field</td>\n";
			 }
		 print "</tr>\n"; 
	}
		
	print "</table>\n";
	
	
	print "<p>liste des raticles</p>";
	
	print "<table width=300 border=1   style='background:black; color:white;'>\n";
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
  
      print "</tr>\n";
 
 
	$adresse=$_POST['adresse'];
	$sql_magasin ="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
					FROM liste_stockes
					WHERE adresse_mag='$adresse'
					GROUP BY modele, type, nom_fourn
					ORDER BY prix)";
					
	$result= $link->query($sql_magasin)
		or die("SELECT Error: ".$link->error);
	var_dump($result);
	
	while ($get_info = $result->fetch_row()){
		
		print "<tr>\n";
			 
			 foreach ($get_info as $field)
			 {  
				print "\t<td> $field</td>\n";
			 }
		 print "</tr>\n"; 
	}
		
	print "</table>\n";

	$result->free();
	$link->close();
?>


	</body>

</html>
