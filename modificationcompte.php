<html>


    <head>
        <title>Page de connexion </title>
        <meta charset="utf-8" />
      
        
    </head>

     
	
    <body>
		<?php include("header.php"); ?>	
        <h2>Connectez vous en un instant !</h2>

        <form method="POST" action="confirmationmodificationcompte.php">
            nouvelle ville   :<input type="text" name="ville" maxlength="50" placeholder="Ville" style="text-transform:capitalize;"></input></br>
            nouvelle adresse :<input type="text" name="adresse" maxlength="50"  placeholder="adresse"></input><br/>        
            <input type="submit" name="ok" value="Valider">
        </form>
        
        <form method="POST" action="confirmationmodificationcompte.php">
            nouvelle adresse email :<input type="email" name="mail" maxlength="50"  placeholder="mail"></input></br>
            confirmer l'adresse email :<input type="email" name="mailc" maxlength="50" placeholder="mail"></input><br/>        
            <input type="submit" name="ok" value="Valider">
        </form>
        
        <form method="POST" action="confirmationmodificationcompte.php">
            nouveau mot de passe :<input type="password" name="mdp" maxlength="50"  minlength="6" placeholder="mot de passe"></input></br>
            confirmer le nouveau mot de passe :<input type="password" name="mdpc" maxlength="50" minlength="6" placeholder="mot de passe"></input><br/>        
            <input type="submit" name="ok" value="Valider">
        </form>
		
		 <button onclick="window.location.href='deconnexion.php';">se déconnecter</button>
      
    </body>
     
</html>
