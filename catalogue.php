<head>
<title> Catalogue</title>
 <link href='style.css' rel='stylesheet' type='text/css'>
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <?php include("menu.php"); ?>
<h2>Bienvenue sur notre catalogue en ligne !</h2>
<p> Vous retrouverez ici tous nos instruments !</p>
</head>
<body>

<?php


$link = new mysqli('localhost', 'user', 'user', 'Projet');
if ($link->connect_errno) {
 die ("Erreur de connexion : errno: " . $link->errno . " error: " . $link->error);
}

$result = $link->query( "SELECT * FROM liste_stockes" )
or die("SELECT Error: ".$link->error);
print "<table width=200 border=1>\n";
while ($get_info = $result->fetch_row()){
 print "<tr>\n";
 foreach ($get_info as $field)
 print "\t<td>$field</td>\n";

}
print "</table>\n";
$result->free();





$link->close();
?>




</body>
