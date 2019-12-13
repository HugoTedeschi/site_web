<html>
	<head>
		<title> Catalogue</title>
		<?php include("header.php"); ?>
	</head>


	<body>

<?php

	$link = new mysqli('localhost', 'user', 'user', 'madata');
	if ($link->connect_errno) 	die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
	
	
	print "<table width=300 border=1   style='background:black; color:white;'>\n";
		print "<tr>\n";

			  $value = "numéro d'instrument";
			  print "\t<td>$value</td>\n";
			  $value = "prix          ";
			  print "\t<td>$value</td>\n";
			  $value = "type";
			  print "\t<td>$value</td>\n";
			  $value = "modele";
			  print "\t<td>$value</td>\n";
			  $value = "marque";
			  print "\t<td>$value</td>\n";
		print "</tr>\n";
 
 
	$numero_facture=$_POST['no_facture'];
	$sql_detaille ="SELECT i.no_instrument, i.prix, i.type, i.modele, i.nom_fourn
					FROM Instrument i
					WHERE '$numero_facture'=i.no_facture";
					
	$result= $link->query($sql_detaille)
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

