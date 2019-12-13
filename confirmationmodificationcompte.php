<html>


    <head>
        <title>Page de confirmation </title>
        <meta charset="utf-8" />
         <?php include("header.php"); ?>
    </head>
  

    <body>

    	<?php 
			
			$link = new mysqli("localhost","user","user");
			if ($link->connect_errno){
			  die("Couldn't connect to MySQL ".$link->connect_error);
			}

			$link->select_db("madata");
			$login=$_SESSION['identifiant'];
			
			
			if((isset($_POST['mail'])) && ($_POST['mail']==$_POST['mailc'])){
				$adresse_email = $_POST['mail'];
				$sql_compte = "UPDATE Compte SET identifiant='$adresse_mail' WHERE '$login' = identifiant";
				$sql_client = "UPDATE Client SET mail='$adresse_mail' WHERE '$login' =mail";
				$link->query($sql_compte)
					or die("pb de requetes ".$link->error);
				$link->query($sql_client)
					or die("pb de requetes ".$link->error);
			}
			
			elseif((isset($_POST['mdp'])) && ($_POST['mdpc']==$_POST['mdp'])){
				$mdp = $_POST['mdp'];
				$sql_compte = "UPDATE Compte SET mdp='$mdp' WHERE '$login' = identifiant";
				$link->query($sql_compte)
					or die("pb de requetes ".$link->error);
			}
			
			elseif((isset($_POST['ville'])) && (isset($_POST['adresse'])) ){
				$ville = $_POST['ville'];
				$adresse= $_POST['adresse'];
				$sql_ville = "UPDATE Client SET ville='$ville' WHERE '$login' = identifiant";
				$sql_adresse = "UPDATE Client SET adresse='$adresse' WHERE '$login' = identifiant";
				$link->query($sql_ville)
					or die("pb de requetes ".$link->error);
				$link->query($sql_ville)
					or die("pb de requetes ".$link->error);
			}

		
			else{
				
				echo"erreur de saisie, vous allez être redirigé vers le formulaire.";
				$essai = '<META HTTP-EQUIV="Refresh" CONTENT="10,modificationcompte.php">';
				echo "$essai";
				
				}
			echo "modification réussi";
			
  		?>
        
    </body>
    
</html>
