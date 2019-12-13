
<html>


    <head>
        <title>Page de confirmation </title>
        <meta charset="utf-8" />
    </head>
  

    <body>

    	<?php 
			
			$link = new mysqli("localhost","user","user");
			if ($link->connect_errno){
			  die("Couldn't connect to MySQL ".$link->connect_error);
			}

			$link->select_db("madata");
			$adresse_email = $_POST['adresse_email'];
			$sql_identifiant = "SELECT identifiant FROM Compte WHERE '$adresse_email' = identifiant";
			//var_dump($sql_pseudos);
			$identifiant_existants = $link->query($sql_identifiant)
				or die("pb de requetes ".$link->error);
				echo"abdel";

			if($identifiant_existants ->num_rows){
				//Si le pseudo est déjà pris, on affiche un message d'information et on propose un bouton de retour
				echo "Cet email semble déjà pris ... Essayez en un autre.";
				
			}

				if ($identifiant_existants ->num_rows) {
				$aa = "POST";
				$ab = "inscription.php";
				$ac = "submit";
				$ad = "retour";
				$ae = "< Retour à l'inscription";
			    $texte = "<form method='$aa'action='$ab'>
			    <input type='$ac' name='$ad' value='$ae' >
        		</form>";
        		echo "$texte";
				}

			else{
				//Si le pseudo n'est pas pris, ni le code compagnie, on affiche un message de confirmation et on ajoute la compagnie dans les données
				echo "Bienvenue parmi nous !";
				$mdp = $_POST['mdp'];
				$nom=$_POST['nom'];
				$prenom = $_POST['prenom'];
				$mail=$_POST['adresse_mail'];
				$date=$_POST['ddn'];
				$ville=$_POST['ville'];
				$adresse=$_POST['adresse'];
				echo "$mail";
				var_dump($mail);
				$link->query("INSERT INTO Compte VALUES ('client','$mail','$mdp');")
					or die("Probleme d'insertion de valeur: ".$link->error);
				$link->query("INSERT INTO Client VALUES ('$nom','$prenom','$date','$ville', '$adresse','$mail')")
					or die("Probleme d'insertion de valeur: ".$link->error);
			}
			$link->close();
			
			$essai = '<META HTTP-EQUIV="Refresh" CONTENT="2,accueil.php">';
				echo "$essai";
  		?>
        
    </body>
    
</html>
