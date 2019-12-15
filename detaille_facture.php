<html>
	<head>
		<title> Catalogue</title>
		<?php include("header.php"); ?>
	</head>


	<body>

<?php

	$link = new mysqli('localhost', 'user', 'user', 'madata');
	if ($link->connect_errno) 	die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
 
			 $a = $_SESSION['client'];
			echo "<p>$a</p>";

		
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
	var_dump($numero_facture);
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
	
	$sql_detaille ="SELECT date
					FROM Commande
					WHERE '$numero_facture'= no_facture";
					
	$result= $link->query($sql_detaille)
		or die("SELECT Error: ".$link->error);
		
	if ($result->num_rows){
		$get_info = $result->fetch_row();
		echo "achat effectué en ligne, livré le "; echo "$get_info[0]";
	}
	
	else{  
		
		echo "achat effectué en magasin";
		
	}
	
	print "</table>\n";
   
	$result->free();
	$link->close();
?>


	</body>

</html>

