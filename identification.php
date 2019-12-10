<html>


    <head>
        <title>Page de connexion </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>

     
	
    <body>
			
        <h2>Connectez vous en un instant !</h2>
		<?php include("menu.php"); ?>
        <form method="POST" action="identification1.php">
            <input type="text" name="login" maxlength="20" placeholder="Login" style="text-transform:capitalize;"></input></br>
            <input type="password" name="mdp" maxlength="20" placeholder="Mot de passe"></input><br/>        
            <input type="submit" name="ok" value="Valider" >
        </form>

      
    </body>
     
</html>
