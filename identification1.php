
<html>

    <head>
        <title>Page de confirmation </title>
        <meta charset="utf-8" />
    </head>

	
	
    <body>
		<?php include("header.php"); ?>
    	<?php 
			$link = new mysqli("localhost","user","user");
			if ($link->connect_errno){
			  die("Couldn't connect to MySQL ".$link->connect_error);
			}
			
			$link->select_db("madata");
	        $login=$_POST['login'];
	        $mdp=$_POST['mdp'];
	        
			$sql_pseudos = "SELECT identifiant FROM Compte WHERE '$login'= identifiant AND '$mdp' = mdp"; // On select le couple correspondant dans la BDD
			$pseudos_existants = $link->query($sql_pseudos) ;
		
			$sql_type="SELECT type FROM Compte WHERE '$login' = identifiant" ;
			$type=$link->query($sql_type);
	
				
			if($pseudos_existants ->num_rows){
				
				//Si le pseudo et le mot de passe correspondent tout va bien
				session_start(); // LANCEMENT SESSION
				 
				$_SESSION['identifiant'] = $login; // CREATION VARIABLE GLOBALE login
				$aa = $type->fetch_row();
				$_SESSION['type'] =$aa[0];  // CREATION VARIABLE GLOBALE CODE CIE

				echo "Bon retour parmis nous"; echo "$login"; echo"!"; 
			
			}

			else{
				//Si la combinaison n'existe pas on affiche un message d'erreur
				echo "Il semblerait que le mot de passe et le login ne correspondent pas !";
				$aa = "POST";
				$ab = "identification.php";
				$ac = "submit";
				$ad = "retour";
				$ae = "Retour au formulaire";
			    $texte = "<form method='$aa'action='$ab'>
			    <input type='$ac' name='$ad' value='$ae' >
        		</form>";
        		echo "$texte";
			}
			$link->close();
			
			$essai = '<META HTTP-EQUIV="Refresh" CONTENT="2,acceuil.php">';
				echo "$essai";
  		?>
        
    </body>
   
</html>
