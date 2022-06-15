<?php
	require_once("/wamp64/www/Test_Uballers/model/Utilisateur.php");
	
	/*Classe permettant de se vérifier les données saisies par l'utilisateur avec la base de données*/
	class ControllerUtilisateur {
		
		public static function connect() {
			include("/wamp64/www/Test_Uballers/view/Connexion/formConnexion.html");
		}

		public static function connected() {

			if(isset($_POST["email"]) AND isset($_POST["password"])) {
				$email = $_POST["email"];
				$password = $_POST["password"];
				$bool = Utilisateur::connectLogin($email,$password);
			
				if($bool == 1) {
					session_start();
					$_SESSION["email"] = $email;

					echo "Vous êtes connectés sous le login : ".$_SESSION["email"];

					sleep(1);
					header("Location: routeur.php");
				} else {
					echo "<p> Votre login ou mot de passe est incorrecte ! </p><br>";
					include("/wamp64/www/Test_Uballers/view/Connexion/formConnexion.html");
				}
			}
		}

		public static function inscrip() {
			include("/wamp64/www/Test_Uballers/view/Connexion/formInscription.html");
		}

		public static function inscriped() {

			if(isset($_POST["prenom"]) AND isset($_POST["nom"]) AND isset($_POST["email"]) AND isset($_POST["password"]) AND isset($_POST["dateNaissance"]) AND isset($_POST["sexe"])) {
				if($_POST["email"] == $_POST["emailConf"] AND $_POST["password"] == $_POST["passwordConf"]) {
					$prenom = $_POST["prenom"];
					$nom = $_POST["nom"];
					$email = $_POST["email"];
					$password = $_POST["password"];
					$dateNaissance = $_POST["dateNaissance"];
					$sexe = $_POST["sexe"];
					
					$verifEmail = Utilisateur::verifEmail($email);
					
					if($verifEmail == true) {
						$bool = Utilisateur::inscription($prenom,$nom,$email,$password,$dateNaissance,$sexe);
						if($bool == true) {
							Utilisateur::connectLogin($email,$password);
							sleep(1);
							echo "<p> Vous vous êtes bien inscrits sur notre site ! Connectez-vous ! </p>";
							include("/wamp64/www/Test_Uballers/view/Connexion/formConnexion.html");
						} else {
							echo "<strong> Informations incorrectes ! Veuillez réessayer ! </strong>";
							include("/wamp64/www/Test_Uballers/view/Connexion/formInscription.html");
						}
					} else {
						echo "<strong>Votre email est déjà utilisé !</strong>";
						include("/wamp64/www/Test_Uballers/view/Connexion/formInscription.html");
					}
					
				} else {
					echo "<p> Votre login ou mot de passe est invalide ! </p><br>";
					include("/wamp64/www/Test_Uballers/view/Connexion/formInscription.html");
				}
			}
		}

		public static function disconnect() {
			Utilisateur::disconnect();
			echo " Vous vous êtes bien déconnectés ...";
			sleep(1);
			header("Location: routeur.php");
		}
		
		public static function compteUtilisateur() {
			require_once("/wamp64/www/Test_Uballers/model/Utilisateur.php");
			$lesUtilisateurs = Utilisateur::getUtilisateurByEmailUser($_SESSION["email"]);
			include("/wamp64/www/Test_Uballers/view/monCompte.php");
		}
		
		public static function main() {
			include("/wamp64/www/Test_Uballers/view/accueil.php");
		}
	}
?>