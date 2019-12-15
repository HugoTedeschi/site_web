  <html>
	<head>
		<title> Catalogue</title>
		<?php include("header.php"); ?>
	</head>


	<body>

<?php

	$link = new mysqli('localhost', 'user', 'user', 'madata');
	if ($link->connect_errno) 	die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
	
	print "<p>liste des articles</p>";
	
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
 
 
	$nom=$_POST['nom'];
	$sql_fournisseur ="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
					FROM liste_stockes
					WHERE nom_fourn='$nom'
					GROUP BY modele, type, nom_fourn
					ORDER BY prix)";
					
	$result= $link->query($sql_fournisseur)
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

	$result->free();
	$link->close();
?>

	</body>

</html>
