<?php
	include "header.php";


	if(isset($_SESSION['identifiant'])){
		if($_SESSION['type']=='client'){
			include "modificationcompte.php";
		}
		else{ include "identification.php";}
	}



?>
