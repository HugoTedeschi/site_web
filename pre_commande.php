
<head>
<title>Pré Commande</title>



<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
…
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link href='style.css' rel='stylesheet' type='text/css'>
  <?php include("header.php"); ?>

	
</head>




<?php


//~ function calcul_frais_port($adresse_mag){
	//~ //ici, pour chacun des magasins, on va déterminer les frais de port associés.
	//~ if($adresse_mag == '')
	//~ {
	//~ }
	//~ if($adresse_mag == '')
	//~ {
	//~ }
	//~ if($adresse_mag == '')
	//~ {
	//~ }
	//~ if($adresse_mag == '')
	//~ {
	//~ }
//~ }




if(!isset($_POST['formulaire'])){
	echo  " <p  style='color:white; text-align: center;'> Il semblerait que rien n'ait été selectionné !<br> voici les articles commandé: </p><br>";
	
print "<form id='FormulaireCommande'  method='POST' action='catalogue.php'";
print "<center><input type='submit' value='Recommencer la commande' style='width:1500px; font-size: 80px; background:grey;'></center>"; 
}

if(isset($_POST['commande'])){

    if(!empty($_POST['formulaire'])) { 
		
		
		$link = new mysqli('localhost', 'user', 'user', 'madata');
		if ($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
		}
		
		
		

		echo  "<p  style='color:white;'>Merci de valider la commande suivante en appyant sur \"valider la commande \".</p>";

		print "<table width=300 border=1   style='background:black; color:white;'>\n";
		print "<tr>\n";


		print "<form id='FormulaireCommande'  method='POST' action='catalogue.php'";
		print "\t<td><input type='submit' value='Recommencer la commande' style='width:1000px; font-size: 60px; background:grey;'></td>\n"; 


	 
		print "<form id='FormulaireCommande'  method='POST' action='commande.php'"; 
		print "\t<td><input type='submit' value='Valider la commande' name ='commande'style='width:1000px; font-size: 60px; background:grey;'></td>\n";
		
		
		print "</tr>\n";
		print "</form>";
		print "</table>";


		 //~ array_keys($_POST['formulaire']);   
		echo  " <p  style='color:white;'> Merci pour votre confiance en nous<br> voici les articles commandé: </p><br>";
		 print "<table width=300 border=1   style='background:black; color:white;'>\n";
		 
		 
		 $compteur = 0;
		 
		 
		 
    //========================================================================================================================================================
	// RECHERCHE D'UN NOUVEAU NUMERO DE FACTURE VALIDE			 
	   
			    $lignes_facture = "SELECT * FROM Facture";
				$result_facture = $link->query($lignes_facture); 
				
				while ($get_info = $result_facture->fetch_row())  
				// avant d'insérer dans la facture, on va parcourir l'ensemble des facture pour obtenir l'identifiant de la dernère commande +1. pour créer une 
				// nouvelle facture dont l'id n'est pas déjà utilisé.
				{  
					$no_facture = $get_info[0]; 
				
					
				}
				$no_facture = $no_facture+1;  
				echo  " <p  style='color:white; text-align: center;'>  Votre numéro de facture est $no_facture</p><br>";
				
			// maintenant il faut associé ce numéro de facture à tout les instruments selectionnés
			
	//===========================================================================================================================================================
	// RECHERCHE d'UN NOUVEAU NUMERO DE COMMANDE
					    
			    $lignes_commande = "SELECT * FROM Commande";
				$result_commande = $link->query($lignes_commande); 
			
				while ($get_info = $result_commande->fetch_row())  
				// avant d'insérer dans la commande, on va parcourir l'ensemble des commandes pour obtenir l'identifiant de la dernère commande +1
				{  
					$no_commande = $get_info[0]; 
					
				}
				$no_commande= $no_commande+1;
				echo  " <p  style='color:white; text-align: center;'> le numero de commande est: $no_commande </p><br>";
	
	//===========================================================================================================================================================
	//on va maintenant récupere les numéro d'isntruments et les lieu de stockage de ces instruments pour chacuns des modèles selectionnés, puis leur affecté un numéo de facture.
	

        foreach($_POST['formulaire'] as $ligne){  // on recupère l'ensemble des lignes contenus dans $_POST qui stockes les elements selectionnés
			// on créer un tableau qui stocke tout les modèles choisis précedemment. 
			   
				  echo"<tr>\n";
			      echo "\t<td></tr> <p  style='color:white;'> --> $ligne</p><br/></td>\n";
			      echo"</tr>\n";
	     
	 
	     
			      
			      
			    $lignes_instrument = "SELECT no_instrument, cout, prix, type, modele, nom_fourn, adresse_mag FROM Instrument WHERE modele='$ligne' and no_facture IS NULL";
				
				$result_instrument = $link->query($lignes_instrument) 
				   // on va récuperer la tables istruments, afin d'obtenir un instrument coorespondant à celui commandé, mais n'étant pas déjà vendu (donc pas associé à une facture), 
				// on va aisi pouvoir insérer dans commande, un instrument qui dont le no_instrument ne correspond pas à un instrument vendu. 
				
				or die("SELECT Error: ".$link->error);
					
				$i = 1;
				
				//---------------------------------------------------------------------
				//Maintenant pour chacun des modèles selectionné:
				//- 1)
				//- 2)
				while ($get_info = $result_instrument->fetch_row() and $i != 0)
				{
				
				echo"<tr>";
			      //1) on récupère le premier numéro d'instrument pas vendu de la table
					$no_instrument = $get_info[0];  
						print "\t<td>$no_instrument</td>\n";
						
						
						
						
					//2) on récupère l'adresse du magasin associé à cet instrument pas vendu de la table
					$adresse_mag = $get_info[6];  
						print "\t<td>$adresse_mag</td>\n";
    				
				echo"</tr>";
				$i = 0;
				 echo"</table>";
				
				}
		
		   }
		
	//===========================================================================================================================================================
	// INSRTION DES INSTRUMENTS DANS LE PANIER
	
		  //CREATION du panier
		    
		    //~ $link->query("INSERT INTO Commande VALUES('$no_commande','15','$date','$no_facture','$adresse_mag');");
			      
			      
			      
	    
	   
			  
			
		
		
	
		

  
  
	



	}

}
	
	
	
	
	
	
	
?>
