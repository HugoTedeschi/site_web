

<?php

	if(isset($_SESSION['identifiant'])){
		
		if($_SESSION['type']=='client'){
			echo"<html>
			<center><p style = 'background-image:url(header.jpg); width: 900px; height:300px;
    font-size: 23px;
    border-radius: 50px;'>
   
             
               
			<TABLE >
					<TR>
						<TH> <a href='acceuil.php'>Accueil</a> </TH>
						<TH> <a href='catalogue.php'> Catalogue</a> </TH>
						<TH> <a href='fournisseurs.php'> Nos fournisseurs</a></TH>
						<TH> <a href='magasin.php'> Nos magasins </TH>
						<TH> <a href='facture.php'> Mes factures</a></TH>
						<TH> <a href='modificationcompte.php' >Mon compte</a></TH>
					</TR>
				</TABLE>
				</p></center>
				</html>
				";
				
			}
		else{
			echo"<html>
			<center><p style = 'background-image:url(header.jpg); width: 900px; height:300px;
		font-size: 23px;
		border-radius: 50px;'
		border-radius: 50px;'
		
			<TABLE>
				<TR>
					<TH> <a href='acceuil.php'>Accueil</a> </TH>
					<TH> <a href='catalogue.php'> Catalogue</a> </TH>
					<TH> <a href= 'fournisseurs.php'> Nos fournisseurs</a></TH>
					<TH> <a href='magasin.php'> Nos magasins </TH>
					<TH>  <a href='identification.php' >Mon compte</a></TH>
				</TR>
			</TABLE>
			</p></center>
			</html>";
			
			}
		}
	
	else{	
		echo"<html>
		<center><p style = 'background-image:url(header.jpg); width: 900px; height:300px;
    font-size: 23px;
    border-radius: 50px;'

			<TABLE>
				<TR>
					<TH> <a href='acceuil.php'>Accueil</a> </TH>
					<TH> <a href='catalogue.php'> Catalogue</a> </TH>
					<TH> <a href= 'fournisseurs.php'> Nos fournisseurs</a></TH>
					<TH> <a href='magasin.php'> Nos magasins </TH>
					<TH>  <a href='identification.php' >Mon compte</a></TH>
				</TR>
			</TABLE>
			 
		   </p></center>
		</html>";
	}
	
	 
	?>
