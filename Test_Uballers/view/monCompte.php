<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="initial-scale=1, maximum-scale=1">
		<title>Mon Compte - Test Uballers</title>
	</head>
	<body>
		<div class="form-box">
			
			<?php
				echo "<h1> Mes informations </h1><br>";
				if(!$lesUtilisateurs == false) {
					foreach ($lesUtilisateurs as $utilisateur) {
						$prenom = $utilisateur->getPrenom();
						$nom = $utilisateur->getNom();
						$email = $utilisateur->getEmail();
						$dateNaissance = $utilisateur->getDateNaissance();
						$sexe = $utilisateur->getSexe();
						
						if(strlen($nom)>35) {
							$nom = substr($nom,0,30)." ....";
						}
						
						echo "<p>Prénom : $prenom</p>";
						echo "<br>";
						echo "<p>Nom : $nom</p>";
						echo "<br>";
						echo "<p>Email : $email</p>";
						echo "<br>";
						echo "<p>Date de naissance : $dateNaissance</p>";
						echo "<br>";
						echo "<p>Sexe : $sexe</p>";
						echo "<br><br>";
					}
				} else {
					echo "Vous n'avez pas de compte !";
				}
			?>
			
			<form action="routeur.php?action=u_main" method="post">
				<input type="submit" value="RETOUR">
			</form>
		</div>
	</body>
</html>