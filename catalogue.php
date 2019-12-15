<head>
<title> Catalogue</title>



<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
…
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link href='style2.css' rel='stylesheet' type='text/css'>
 	<?php include("header.php"); ?>

	
</head>


<body style='background:black; color:white;'>

	<h2>Bienvenue sur notre catalogue en ligne !</h2>
		<form action="catalogue.php" >
		<center>	<input type="submit" value="Revenir au catalogue"  style='width:500px; background:grey; padding : 20px; font-size: 40px; text-align: center;' /></center>
		</form>
	<p style='text-align: center;font-size: 25px'>  Vous retrouverez ici tous nos instruments ! </p>


	
<?php
//============================================================================================================================================================================================================
// LA FONCTION CLIENT CORRESPOND AU CATALOGUE AFFICHE POUR UN CLIENT ( IL PEUT Y PASSER UNE COMMANDE AUSSI)
function client(){

// on instancie la variable lient, qui relie la base de donnée. ici notre base de donnée s'appelle "madata"
$link = new mysqli('localhost', 'user', 'user', 'madata');
if ($link->connect_errno) {
 die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
}

// on utilisera des variables pour les checkbox et les select/option: en fonction de leur valeur associé par les formulaire, on afficherais des tables particulières.
$prix=0;
$marque ='rien';
$modele ='rien';
$type ='rien';

// $catalogue correspond à la requette de notre vue "liste_stocke" c'est à dire l'affichage de l'ensemble de nos instruments disponible à la vente, classé par prix, et avec connaissance du stock disponible 
$catalogue = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);


// on va proposer au client de chercher une marque particulière ou bien un type d'instrument au client. 
print "

	<center> <table style='background:black; color:white;'>
		<tr>
		
         <form method = 'post'>  
         <tr>
             <td>Trier par marque</td>
               <td>Trier par type</td>
                 <td>Chercher un modele </td>
                 </tr>
                 
                 
               <tr>  
              <td><input type='text' name='marque'  placeholder='marque' > </input></br></td>
              <td>  <input type='text' name='type'  placeholder='type'> </input><br/>  </td>
               <td> <input type='text' name='modele'  placeholder='modele'></input><br/>  </td>
              </tr>
              
            
          
       
	   
		
       
        <br>
        </tr>
        </table></center>
        
      <center>  <p>  <input type = 'submit' name = 'submitTRI' value = 'Appliquer la selection' style='background:grey; color:white; width:800;'> </form>  ;</p></center>
		
       

";

// en fontion du choix du formulaire, on allouera des valeur différentes aux varaibles $marque, $type et modèle.
  if(isset($_POST['submitTRI']))  
    { 
        // Check if any option is selected 
        if(!empty($_POST['marque']))  
        { 
			
			$marque = $_POST['marque'];
			 echo "Recherche des instruments de la marque $marque: <br>";
              
                
        } 
        if(!empty($_POST['type']))  
        { 
			$type = $_POST['type'];
               echo "Recherche des instruments du type $type:  <br>";
                
        } 
        if(!empty($_POST['modele']))  
        { 
			$modele = $_POST['modele'];
			 echo "Recherche des isntrument correspondant au modèle $modèle:  <br>";
              
                
        }
        if( !empty($_POST['marque']) and !empty($_POST['modele']) and !empty($_POST['type']))
        {
			// si le bouton a été enclenché pour lancer un tri mais rien n'a été écris dans le forumlaires pour trier
			
		}
   }
  else
  { 
		echo "<center><p>Aucun paramètre précisé, affichage du catalogue.</p></center>";
  }

//================================================================================================================================================================================================================
// on instancie ici les bouton pour passer la commande, ou bien la recommancer ( réinitialisé les checkbox cochés)
print "<table width=300 border=1   style='background:black; color:white;'>\n";

print "<tr>\n";
 
 
 
 print "\t<td> <form id='FormulaireCommande'  method='POST' action='pre_commande.php'\t</td>";
 print "\t<td><input type='reset' value='Recommencer la commande' style='width:350px; background:grey;'></td>\n";
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
 
 
 //================================================================================================================================================================================================================
 // requete pour instruments par type
$sql_type = "(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE type = '$type'
GROUP BY modele, type, nom_fourn
ORDER BY modele)"; 

$result_type = $link->query( $sql_type )
or die("SELECT Error: ".$link->error);
 
 //requette pour instrument par marque
$sql_marque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_marque = $link->query( $sql_marque )
or die("SELECT Error: ".$link->error);
//requete pour instrument par modèle
$sql_modele="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$modele'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_modele = $link->query( $sql_modele)
or die("SELECT Error: ".$link->error);

//requete pour instrument par type et marque
$sql_typeETmarque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque' and type='$type'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmarque= $link->query( $sql_typeETmarque)
or die("SELECT Error: ".$link->error);

//requete pour instrument par type et modèle
$sql_typeETmodele="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE type = '$type' and modele='$modele'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmodele= $link->query( $sql_typeETmodele)
or die("SELECT Error: ".$link->error);

//requete pour instrument par marque et par modele
$sql_marqueETmodele="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque' and modele='$modele'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmodele= $link->query( $sql_typeETmodele)
or die("SELECT Error: ".$link->error);


//requette pour nstrument par modèle, par marque et par type
$sql_typeETmodeleETmarque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque' and modele='$modele' and type='$type'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmodeleETmarque= $link->query( $sql_typeETmodeleETmarque)
or die("SELECT Error: ".$link->error);

//=================================================================================================================================================================================================================
 // maintenant on va associer à result ( cest à dire la requete à executer) la bonne requete sql correpondant à la lsite d'instruments demandé, aussi en fonction de ce que recherche le client
 if($marque == 'rien' and $modele == 'rien' and $type =='rien')
 {
	 $result = $catalogue;
	 echo "<center><p>Vous pouvez trier ce tableau par marque, modele et par type avec le formulaire ci-dessus ! N'hesitez pas.</p></center>";
	 
 }
  if($marque != 'rien' and $modele == 'rien' and $type =='rien')
 {
	 $result = $result_marque;
	 echo "<center><p>Triage des instrument selon la marque! $marque</p></center>";
	 
 }
  if($marque == 'rien' and $modele != 'rien' and $type =='rien')
 {
	 $result = $result_modele;
	 echo "<center><p>Triage des instruments , recherche du modèle: $modele</p></center>";
	 
 }
  if($marque == 'rien' and $modele == 'rien' and $type !='rien')
 {
	 $result = $result_type;
	 echo "<center><p>Triage des instruments, recherche des instrument de la famille des $type</p></center>";
	 
 }
  if($marque != 'rien' and $modele == 'rien' and $type !='rien')
 {
	 $result = $result_typeETmarque;
	 echo "<center><p>Triage des instrulents selon la marque $marque et du type $type</p></center>";
	 
 }
  if($marque == 'rien' and $modele != 'rien' and $type !='rien')
 {
	 $result = $result_typeETmodele;
	 echo "<center><p>Triage des instruments selon le modele $modele et de type $type</p></center>";
	 
 } 
 if($marque != 'rien' and $modele != 'rien' and $type =='rien')
 {
	 $result = $result_marqueETmodele;
	 echo "<center><p>Triage des instruments selon la marque $marque et le modele $modele</p></center>";
	 
 }
 
  if($marque != 'rien' and $modele != 'rien' and $type !='rien')
 {
	 $result = $result_typeETmodeleETmarque;
	 echo "<center><p>Triage des instruments selon la marque $marque, le type $type et le modele $modele</p></center>";
	 
 }
 
 
//================================================================================================================================================================================================================
   
   

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
}

//============================================================================================================================================================================================================
//LA FONCTION USER CORESPOND AU SIMPLE AFFICHAGE DU CATALOGUE DES INSTRUMENTS DISPONIBLES? IL NE PEUT CEPENDANT PAS PASSER DE COMMANDE
function user(){
// on instancie la variable lient, qui relie la base de donnée. ici notre base de donnée s'appelle "madata"
$link = new mysqli('localhost', 'user', 'user', 'madata');
if ($link->connect_errno) {
 die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
}

// on utilisera des variables pour les checkbox et les select/option: en fonction de leur valeur associé par les formulaire, on afficherais des tables particulières.
$prix=0;
$marque ='rien';
$modele ='rien';
$type ='rien';

// $catalogue correspond à la requette de notre vue "liste_stocke" c'est à dire l'affichage de l'ensemble de nos instruments disponible à la vente, classé par prix, et avec connaissance du stock disponible 
$catalogue = $link->query( "SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
GROUP BY modele, type, nom_fourn
ORDER BY prix;" )
or die("SELECT Error: ".$link->error);


// on va proposer au client de chercher une marque particulière ou bien un type d'instrument au client. 
print "

	<center> <table style='background:black; color:white;'>
		<tr>
		
         <form method = 'post'>  
         <tr>
             <td>Trier par marque</td>
               <td>Trier par type</td>
                 <td>Chercher un modele </td>
                 </tr>
                 
                 
               <tr>  
              <td><input type='text' name='marque'  placeholder='marque' > </input></br></td>
              <td>  <input type='text' name='type'  placeholder='type'> </input><br/>  </td>
               <td> <input type='text' name='modele'  placeholder='modele'></input><br/>  </td>
              </tr>
              
            
          
       
	   
		
       
        <br>
        </tr>
        </table></center>
        
      <center>  <p>  <input type = 'submit' name = 'submitTRI' value = 'Appliquer la selection' style='background:grey; color:white; width:800;'> </form>  ;</p></center>
		
       

";

// en fontion du choix du formulaire, on allouera des valeur différentes aux varaibles $marque, $type et modèle.
  if(isset($_POST['submitTRI']))  
    { 
        // Check if any option is selected 
        if(!empty($_POST['marque']))  
        { 
			
			$marque = $_POST['marque'];
			 echo "Recherche des instruments de la marque $marque: <br>";
              
                
        } 
        if(!empty($_POST['type']))  
        { 
			$type = $_POST['type'];
               echo "Recherche des instruments du type $type:  <br>";
                
        } 
        if(!empty($_POST['modele']))  
        { 
			$modele = $_POST['modele'];
			 echo "Recherche des isntrument correspondant au modèle $modèle:  <br>";
              
                
        }
        if( !empty($_POST['marque']) and !empty($_POST['modele']) and !empty($_POST['type']))
        {
			// si le bouton a été enclenché pour lancer un tri mais rien n'a été écris dans le forumlaires pour trier
			
		}
   }
  else
  { 
		echo "<center><p>Aucun paramètre précisé, affichage du catalogue.</p></center>";
  }

//================================================================================================================================================================================================================
// on instancie ici les bouton pour passer la commande, ou bien la recommancer ( réinitialisé les checkbox cochés)
print "<table width=300 border=1   style='background:black; color:white;'>\n";



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
 
 print "</tr>\n";
 
 
 //================================================================================================================================================================================================================
 // requete pour instruments par type
$sql_type = "(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE type = '$type'
GROUP BY modele, type, nom_fourn
ORDER BY modele)"; 

$result_type = $link->query( $sql_type )
or die("SELECT Error: ".$link->error);
 
 //requette pour instrument par marque
$sql_marque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_marque = $link->query( $sql_marque )
or die("SELECT Error: ".$link->error);
//requete pour instrument par modèle
$sql_modele="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$modele'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_modele = $link->query( $sql_modele)
or die("SELECT Error: ".$link->error);

//requete pour instrument par type et marque
$sql_typeETmarque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque' and type='$type'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmarque= $link->query( $sql_typeETmarque)
or die("SELECT Error: ".$link->error);

//requete pour instrument par type et modèle
$sql_typeETmodele="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE type = '$type' and modele='$modele'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmodele= $link->query( $sql_typeETmodele)
or die("SELECT Error: ".$link->error);

//requete pour instrument par marque et par modele
$sql_marqueETmodele="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque' and modele='$modele'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmodele= $link->query( $sql_typeETmodele)
or die("SELECT Error: ".$link->error);


//requette pour nstrument par modèle, par marque et par type
$sql_typeETmodeleETmarque="(SELECT modele, type, nom_fourn, prix, SUM(en_stock) AS Nombre
FROM liste_stockes
WHERE nom_fourn = '$marque' and modele='$modele' and type='$type'
GROUP BY modele, type, nom_fourn
ORDER BY prix)";

$result_typeETmodeleETmarque= $link->query( $sql_typeETmodeleETmarque)
or die("SELECT Error: ".$link->error);

//=================================================================================================================================================================================================================
 // maintenant on va associer à result ( cest à dire la requete à executer) la bonne requete sql correpondant à la lsite d'instruments demandé, aussi en fonction de ce que recherche le client
 if($marque == 'rien' and $modele == 'rien' and $type =='rien')
 {
	 $result = $catalogue;
	 echo "<center><p>Vous pouvez trier ce tableau par marque, modele et par type avec le formulaire ci-dessus ! N'hesitez pas.</p></center>";
	 
 }
  if($marque != 'rien' and $modele == 'rien' and $type =='rien')
 {
	 $result = $result_marque;
	 echo "<center><p>Triage des instrument selon la marque! $marque</p></center>";
	 
 }
  if($marque == 'rien' and $modele != 'rien' and $type =='rien')
 {
	 $result = $result_modele;
	 echo "<center><p>Triage des instruments , recherche du modèle: $modele</p></center>";
	 
 }
  if($marque == 'rien' and $modele == 'rien' and $type !='rien')
 {
	 $result = $result_type;
	 echo "<center><p>Triage des instruments, recherche des instrument de la famille des $type</p></center>";
	 
 }
  if($marque != 'rien' and $modele == 'rien' and $type !='rien')
 {
	 $result = $result_typeETmarque;
	 echo "<center><p>Triage des instrulents selon la marque $marque et du type $type</p></center>";
	 
 }
  if($marque == 'rien' and $modele != 'rien' and $type !='rien')
 {
	 $result = $result_typeETmodele;
	 echo "<center><p>Triage des instruments selon le modele $modele et de type $type</p></center>";
	 
 } 
 if($marque != 'rien' and $modele != 'rien' and $type =='rien')
 {
	 $result = $result_marqueETmodele;
	 echo "<center><p>Triage des instruments selon la marque $marque et le modele $modele</p></center>";
	 
 }
 
  if($marque != 'rien' and $modele != 'rien' and $type !='rien')
 {
	 $result = $result_typeETmodeleETmarque;
	 echo "<center><p>Triage des instruments selon la marque $marque, le type $type et le modele $modele</p></center>";
	 
 }
 
 
//================================================================================================================================================================================================================
   
   

while ($get_info = $result->fetch_row()){
	  
	
	
 print "<tr>\n";
 // en gros faudrait pouvoir récupérer la valeur de get_info[0], correspondant à l'indice de l'instru.
 foreach ($get_info as $field)
 {  // on fait indice par indice pour le sous tableau (une ligne de la table en gros)
	print "\t<td> $field</td>\n";
    
	
 }
 
 
 
 
 print "</tr>\n"; // permet de séparer les lignes de la table entres elles.

}


print "</table>\n";

$result->free();
$link->close();
}
if (isset($_SESSION['identifiant'])) // On verifie qu'il y a bien un pseudo entré, si c'est la cas, affichage bouton déconnexion 
{ 	
	if(($_SESSION['type']=='client'))   
	{
		client();
		
	} 
	
	else{
	
	}
}

// si ce n'est pas un client.
else{
	user();
}
?>




</body>

