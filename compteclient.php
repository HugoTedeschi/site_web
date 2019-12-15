     <head>   
        <title>Page d'inscription </title>
        <meta charset="utf-8" />
        <?php include("header.php"); ?>
    </head>

    <body>
        <h2>Inscrivez vous en un instant !</h2>
<!--
		bare ou on cherche un client par son mail
-->
        <form method="POST">
			<input type="email" name="mail" maxlength="50" placeholder="identifiant" /input></br>
			<input type="submit" name="ok" value="Valider" >
        </form>
        
        <?php
       if(isset($_POST['mail'])){ $_SESSION['client']=$_POST['mail'];}
        if(isset($_SESSION['client']) && $_SESSION['client']==$_POST['mail']){
			
			$link = new mysqli('localhost', 'user', 'user', 'madata');
				if ($link->connect_errno) 	die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
			$login=$_SESSION['client'];
			$sql_client="SELECT c.nom, c.prenom, c.ddn, c.ville, c.adresse, c.mail , c1.mdp
						FROM Client c, compte_client c1
						WHERE c.mail=c1.identifiant AND c.mail='$login'";
			$result=$link->query($sql_client);
			if($result->num_rows){
			print "<table >\n";
			//pour afficher les informations sur le client
			print "<tr>\n";
		    $value = "nom";
			print "\t<td>$value</td>\n";
			$value = "prenom";
			print "\t<td>$value</td>\n";
			$value = "date de naissance";
			print "\t<td>$value</td>\n";
			$value = "ville";
			print "\t<td>$value</td>\n";
			$value = "adresse";
			print "\t<td>$value</td>\n";
			$value = "mail";
			print "\t<td>$value</td>\n";
			$value = "mot de passe";
			print "\t<td>$value</td>\n";
			print "</tr>\n";
			
			
			while ($get_info = $result->fetch_row()){
	  
					print "<tr>\n";
		 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
					 foreach ($get_info as $field)
					 { 
						print "\t<td> $field</td>\n";
						
					  }
					  print "</tr>\n";
		
				}
				
				print "</table >\n";

         
			$id=$_SESSION['client'];
			//facture acheter en magasin
			$sql_facture="SELECT f.no_facture, f.date, f.prix_total, v.nom_mag
			FROM facture_prix1 f, Facture f1, Vendeur v
			WHERE f.no_facture=f1.no_facture AND v.mail=f1.mail_vendeur AND f.mail='$id';";
			$result = $link->query( $sql_facture )
				or die("SELECT Error: ".$link->error);
				
			//facture commandé en ligne
			$sql_facture2="SELECT f.no_facture, f.date, f.prix_total
			FROM facture_prix1 f, Facture f1
			WHERE f.mail='$id' AND f.no_facture=f1.no_facture AND f1.mail_vendeur is NULL ;";
			//affiche la lsite des factures associées au client 
			  
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
			 
		//facture acchat physqiue
			while ($get_info = $result->fetch_row()){
				 print "<tr>\n";
	
				 foreach ($get_info as $field) {  
						print "\t<td> $field</td>\n";
				 }
				 print "\t<td> <input type='radio' name= 'no_facture' value='$get_info[0]'></td>\n";
				 print "</tr>\n"; 
			}
			
			
			
			$result = $link->query( $sql_facture2 )
				or die("SELECT Error: ".$link->error);
			//facture 	achat en ligne
			while ($get_info = $result->fetch_row()){
				 print "<tr>\n";
	
				 foreach ($get_info as $field) {
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

			}
				else {echo "pas de client corespondant à ce mail";}
			}
			
	$result->free();
	$link->close();
		
       ?>
       
       
  
    </body>
</html>
