<?php 
session_start();
session_destroy();?>

<html>
	<?php include("header.php"); 
	$essai = '<META HTTP-EQUIV="Refresh" CONTENT="2,acceuil.php">';
				echo "$essai";?>
	<p>Vous avez été déconnecté avec succès</p>
</html>
