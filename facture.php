
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

			$id=$_SESSION['identifiant'];
			$sql_facture="SELECT f.no_facture, f.date, f.prix_total, v.nom_mag
			FROM facture_prix1 f, Facture f1, Vendeur v
			WHERE f.no_facture=f1.no_facture AND v.mail=f1.mail_vendeur AND f.mail='$id';";
			$result = $link->query( $sql_facture )
				or die("SELECT Error: ".$link->error);
			$sql_facture2="SELECT f.no_facture, f.date, f.prix_total
			FROM facture_prix1 f, Facture f1
			WHERE f.mail='$id' AND f.no_facture=f1.no_facture AND f1.mail_vendeur is NULL ;";

			  
			print "<table >\n";
			print "<form id='FormulaireCommande'  method='POST' action='detaille_facture.php'";
			print "<tr>\n";
			$value = "numéro de facture";
			print "\t<td>$value</td>\n";
		    $value = "date";
			print "\t<td>$value</td>\n";
			$value = "prix";
			print "\t<td>$value</td>\n";
			$value = "lieux";
			print "\t<td>$value</td>\n";
			print "</tr>\n";
			 
		
			while ($get_info = $result->fetch_row()){
				 print "<tr>\n";
				 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
				 foreach ($get_info as $field) {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
						print "\t<td> $field</td>\n";
				 }
				 print "\t<td> <input type='radio' name= 'no_facture' value='$get_info[0]'></td>\n";
				 print "</tr>\n"; // permet de séparer les lignes de la table entres-elles.
			}
			
			
			
			$result = $link->query( $sql_facture2 )
				or die("SELECT Error: ".$link->error);
				
			while ($get_info = $result->fetch_row()){
				 print "<tr>\n";
				 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
				 foreach ($get_info as $field) {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
						print "\t<td> $field</td>\n";
				 }
				 print "\t<td>achat en ligne</td>\n";
				 print "\t<td> <input type='radio' name= 'no_facture' value='$get_info[0]'></td>\n";
				 print "</tr>\n"; // permet de séparer les lignes de la table entres-elles.
			}
			 
			print "<tr>\n";
				 print "\t<td></td>\n";
				 print "\t<td></td>\n";
				 print "\t<td></td>\n";
				 print "\t<td><input type='submit' value='détaille de la commande' name ='commande'style='width:350px; background:grey;'></td>\n";
           print "</tr>\n";


			print "</form>";
			print "</table>\n";

			$result->free();
			$link->close();
		?>
	</body>

</html>
