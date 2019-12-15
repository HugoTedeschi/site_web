

<?php

	if(isset($_SESSION['identifiant'])){
		
		if($_SESSION['type']=='client'){
			echo"<html>

				<TABLE>
					<TR>
						<TH> <a href='acceuil.php'>Accueil</a> </TH>
						<TH> <a href='catalogue.php'> Catalogue</a> </TH>
						<TH> <a href='fournisseurs.php'> Nos fournisseurs</a></TH>
						<TH> <a href='magasin.php'> Nos magasins </TH>
						<TH> <a href='facture.php'> Mes facture</a></TH>
						<TH> <a href='modificationcompte.php' >Mon compte</a></TH>
					</TR>
				</TABLE>
				</html>";
				
			}
		else{
			echo"<html>

			<TABLE>
				<TR>
					<TH> <a href='acceuil.php'>Accueil</a> </TH>
					<TH> <a href='catalogue.php'> Catalogue</a> </TH>
					<TH> <a href= 'fournisseurs.php'> Nos fournisseurs</a></TH>
					<TH> <a href='magasin.php'> Nos magasins </TH>
					<TH>  <a href='identification.php' >Mon compte</a></TH>
				</TR>
			</TABLE>
			</html>";
			
			}
		}
	
	else{	
		echo"<html>

			<TABLE>
				<TR>
					<TH> <a href='acceuil.php'>Accueil</a> </TH>
					<TH> <a href='catalogue.php'> Catalogue</a> </TH>
					<TH> <a href= 'fournisseurs.php'> Nos fournisseurs</a></TH>
					<TH> <a href='magasin.php'> Nos magasins </TH>
					<TH>  <a href='identification.php' >Mon compte</a></TH>
				</TR>
			</TABLE>
			 
		   
		</html>";
	}
	
	 
	?>
