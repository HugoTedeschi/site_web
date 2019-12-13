        <title>Page d'inscription </title>
        <meta charset="utf-8" />
    </head>

    <body>
        <h2>Inscrivez vous en un instant !</h2>

        <form method="POST" action="confirmation_inscription.php">
			<input type="text" name="nom" maxlength="20" placeholder="nom" style="text-transform:capitalize;"></input></br>
			<input type="text" name="prenom" maxlength="20" placeholder="prenom" style="text-transform:capitalize;"></input></br>
			<input type="text" name="adresse" maxlength="50" placeholder="adresse"></input></br>
			<input type="text" name="ville" maxlength="50" placeholder="ville" style="text-transform:capitalize;"></input></br>
			<input type="text" name="adresse_email" maxlength="50" placeholder="email"> </input></br>
			<input type="password" name="mdp" maxlength="20" placeholder="Mot de passe"></input></br>
			<input type="date" name="ddn" maxlength="15" placeholder="date de naissance"> </input></br>

			<input type="submit" name="ok" value="Valider" >
        </form>
                <button onclick="window.location.href='acceuil.php';">retour à l'accueil</button>
                <button onclick="window.location.href='identification.php';">retour à l'identification</button>
    </body>
</html>
