<head>
<title> Catalogue</title>


 	<?php include("header.php"); ?>

	
</head>


<body style='background:black; color:white;'>

	<h2>Bienvenue sur notre catalogue en ligne !</h2>
		<form action="catalogue.php" >
		<center>	<input type="submit" value="Revenir au catalogue"  style='width:500px; background:grey; padding : 20px; font-size: 40px; text-align: center;' /></center>
		</form>
	<p style='text-align: center;font-size: 25px'>  Vous retrouverez ici tous nos instruments ! </p>


	
<?php


$link = new mysqli('localhost', 'user', 'user', 'madata');
if ($link->connect_errno) {
 die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
}
/*
 * 1) Ici, il faut d'abord afficher liste stocké
 * 2) Il faut proposer un selection/option pour recpurer quelle marque est voulue
 * 3) il faut recupere la valeur du select option et afficher le tableau correspondant
 * 4) il faut proposer un formulaire pour recharcher un objet par son nom, magasin, prix etc. 
 * 
 * 
 */

$prix=0;
$marque ='rien';
$modele ='rien';
$type ='rien';

$catalogue = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);






$result_inf = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE prix<$prix
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);

$result_sup = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE prix>$prix
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);



print "

	<table style='background:black; color:white;'>
		<br>
		<td>
         <form method = 'post'>  
           
              
            <select name = 'choix_marque'style='background:black; color:white;'>   
                <option value = 'rien'>Aucune marque selectionnée</option> 
                <option value = 'Fender'>Fender</option> 
                <option value = 'Gibson'>Gibson</option> 
                <option value = 'Kumalae'>Kumalae</option> 
                <option value = 'Selmer'>Selmer</option> 
                <option value = 'Yamaha'>Yamaha</option> 
                <option value = 'Hohner'>Hohner</option> 
             
            </select> 
            <input type = 'submit' name = 'submit' value = Appliquer   style='background:grey; color:white;'> 
        </form> 
	    </td>
		
		<br>
		<td>
         <form method = 'post'>  
           
              
            <select name = 'choix_type'style='background:black; color:white;'>   
                <option value = 'rien'>Aucun type selectionnée</option> 
                <option value = 'flute'>Flute</option> 
                <option value = 'guitare'>Guitare</option> 
                <option value = 'basse'>Basse</option> 
                <option value = 'ukulele'>Ukulele</option> 
                <option value = 'clarinette'>Clarinette</option> 
             
            </select> 
            <input type = 'submit' name = 'submit2' value = Appliquer style='background:grey; color:white;'> 
        </form> 
	    </td>
	
	</table>
		
		
       

";
  if(isset($_POST['submit']))  
    { 
        // Check if any option is selected 
        if(isset($_POST['choix_marque']))  
        { 
			$marque = $_POST['choix_marque'];
              
                
        } 
    else
        echo "Aucune marque selectionnée, retour au catalogue des instruments."; 
    } 
    
      if(isset($_POST['submit2']))  
    { 
        // Check if any option is selected 
        if(isset($_POST['choix_type']))  
        { 
			$type = $_POST['choix_type'];
              
                
        } 
    else
        echo "Aucune type d'instruments selectionné, retour au catalogue des instruments."; 
    } 
    
    
      //~ if(isset($_POST['submit2']) and isset($_POST['submit']))  
    //~ { 
        //~ // Check if any option is selected 
        //~ if(isset($_POST['choix_type']) and isset($_POST['choix_type']))  
        //~ { 
			//~ $marque = $_POST['choix_marque'];
			//~ $type = $_POST['choix_type'];
              
                
        //~ } 
    //~ else
        //~ echo "Aucune marque selectionnée, ni de type spécifiques: retour au catalogue des instruments."; 
    //~ } 



print "<table width=300 border=1   style='background:black; color:white;'>\n";


print "<form id='FormulaireCommande'  method='POST' action='pre_commande.php'";



print "<tr>\n";

 print "\t<td><input type='reset' value='Recommancer la commande' style='width:350px; background:grey;'></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td></td>\n";
 print "\t<td><input type='submit' value='Passer la commande' name ='commande'style='width:350px; background:grey;'></td>\n";
    
  
 print "</tr>\n";
 
 


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
  $value = "Commander:";
  print "\t<td>$value</td>\n";
  
 print "</tr>\n";
 
$sql_type = "(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE type = '$type'
GROUP BY modele, type, nom_fourn
ORDER BY modele)"; 

$result_type = $link->query( $sql_type )
or die("SELECT Error: ".$link->error);
 
$sql_marque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_marque = $link->query( $sql_marque )
or die("SELECT Error: ".$link->error);


//~ $sql_marqueEttype=$result_inf = "(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
//~ FROM liste_stockes
//~ WHERE type='$type' and nom_fourn='$marque'
//~ GROUP BY modele, type, nom_fourn
//~ ORDER BY prix);" 
//~ or die("SELECT Error: ".$link->error);

//~ $resut_marqueEttype = $link->query( $sql_marqueEttype )
//~ or die("SELECT Error: ".$link->error);




 
 if($marque == 'rien' and $type=='rien')
 {
	 $result = $catalogue;
 }
 if($marque == 'rien' and $type != 'rien')
 {
	 $result = $result_type ;
	 
	
 }
 if($marque != 'rien' and $type == 'rien')
 {
	 $result = $result_marque;
	 
	
 }
 //~ if($marque != 'rien' and $type != 'rien')
 //~ {
	 //~ $result = $result_marqueEttype;
	 
	
 //~ }
 
   
   

while ($get_info = $result->fetch_row()){
	  
	
	
 print "<tr>\n";
 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
 foreach ($get_info as $field)
 {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
	print "\t<td> $field</td>\n";
    
	
 }
 print "\t<td> <input type='checkbox' name='formulaire[]' value='$get_info[0]'></td>\n";
 
 
 
 print "</tr>\n"; // permet de séparer les lignes de la table entres elles.

}

print "</form>";
print "</table>\n";

$result->free();
$link->close();
?>




</body>
