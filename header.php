	<link href='style2.css' rel='stylesheet'>
<html>
	<header>
		<center>
		<img src="logo.png" height=300px>
		<img src="header.jpg" height= 300px >
	
		</center>
	</header>
</html>


<?php 
session_start();
if (isset($_SESSION['identifiant'])) // On verifie qu'il y a bien un pseudo entré, si c'est la cas, affichage bouton déconnexion 
{ 	
	if(($_SESSION['type']=='client'))    
	include("menuclient.php");
	else{
	include("menuvendeur.php");
	}
}

	
else {  // Sinon on affiche le bouton connexion 
	
    include("menu.php");


	}
?>



