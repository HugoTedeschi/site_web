<html>


    <head>
        <title>Page de connexion </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        
    </head>

     
	
    <body>
		<?php include("header.php"); ?>	
        <h2>Connectez vous en un instant !</h2>

        <form method="POST" action="identification1.php">
            <input type="text" name="login" maxlength="50" placeholder="login" ></input></br>
            <input type="text" name="mdp" maxlength="50" placeholder="mot de passe"></input><br/>        
            <input type="submit" name="ok" value="Valider">
        </form>
        <button onclick="window.location.href='inscription.php';">s'inscrire</button>

      
    </body>
     
</html>
