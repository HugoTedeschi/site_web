<html>
	<head>
		<title> Catalogue</title>

		
		    <?php include("header.php"); ?>
	</head>


	<body>

		<?php


			$link = new mysqli('localhost', 'user', 'user', 'madata');
			if ($link->connect_errno) {
				die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
				}

			$sql_magasin="SELECT m.adresse, m.ville
			FROM Magasin m;";
			$result = $link->query( $sql_magasin )
				or die("SELECT Error: ".$link->error);
			  
			print "<table >\n";
			print "<form method='POST' action='magasinaction.php'";
			print "<tr>\n";
		    $value = "ville";
			print "\t<td>$value</td>\n";
			$value = "adresse";
			print "\t<td>$value</td>\n";
			print "</tr>\n";
			 
		
			while ($get_info = $result->fetch_row()){
				 print "<tr>\n";
				 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
				 foreach ($get_info as $field) {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
						print "\t<td> $field</td>\n";
				 }
				 print "\t<td> <input type='radio' name= 'adresse' value='$get_info[0]'></td>\n";
				 print "</tr>\n"; // permet de séparer les lignes de la table entres-elles.
			}
			
			print "<tr>\n";
				 print "\t<td></td>\n";
				 print "\t<td></td>\n";
				 print "\t<td><input type='submit' value='voir les détailles' name ='commande'style='width:350px; background:grey;'></td>\n";
           print "</tr>\n";


			print "</form>";
			print "</table>\n";

			$result->free();
			$link->close();
		?>
	</body>

</html>

