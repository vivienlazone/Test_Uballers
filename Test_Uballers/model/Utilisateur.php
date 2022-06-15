<?php
	require_once("/wamp64/www/Test_Uballers/conf/Connexion.php");
	Connexion::connect();
	
	/*Classe qui définit un utilisateur */
	class Utilisateur {
		
		//attribut
		private $identifiant;
		private $prenom;
		private $nom;
		private $email;
		private $motDePasse;
		private $dateNaissance;
		private $sexe;
		
		//getter
		public function getIdentifiant(){return $this->identifiant;}
		public function getPrenom(){return $this->prenom;}
		public function getNom(){return $this->nom;}
		public function getEmail(){return $this->email;}
		public function getMotDePasse(){return $this->motDePasse;}
		public function getDateNaissance(){return $this->dateNaissance;}
		public function getSexe(){return $this->sexe;}


		/* méthode pour voir tous les utilisateurs */
		public static function getAllUtilisateurs() {
			try {
				$requete = "SELECT * FROM UTILISATEUR;";
				$resultat = Connexion::pdo()->query($requete);
				$resultat->setFetchMode(PDO::FETCH_CLASS,'Utilisateur');
				$tableau = $resultat->fetchAll();
				
				return $tableau;
				
			} catch(PDOException $e){
				echo $e->getMessage()."<br>";
			}
		}
		
		/*méthode pour trouver un utilisateur et ses données avec son email*/
		public static function getUtilisateurByEmailUser($email) {
			$requetePreparee = "SELECT * FROM UTILISATEUR WHERE email = :tag_email;";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array("tag_email" => $email);
			try {
				$req_prep->execute($valeurs);
				$req_prep->setFetchMode(PDO::FETCH_CLASS,'Utilisateur');
				$v = $req_prep->fetchAll();
				if (!$v) 
					return false;
				return $v;
			} catch (PDOException $e) {
				echo "erreur : ".$e->getMessage()."<br>";
			}
			return false;
		}
		
		/*méthode pour trouver l'email et le mot de passe lors de la connexion*/
		public static function connectLogin($email,$pass) {
			try {
				$requetePreparee = "SELECT * FROM UTILISATEUR WHERE email = :tag_email AND motDePasse = :tag_motDePasse;";
				$req_prep = Connexion::pdo()->prepare($requetePreparee);
				$valeurs = array("tag_email" => $email,"tag_motDePasse" => $pass);
				$req_prep->execute($valeurs);
				$req_prep->setFetchMode(PDO::FETCH_CLASS,'Utilisateur');
				$tab = $req_prep->fetchAll();

				return count($tab);

			} catch(PDOException $e) {
				echo $e->getMessage()."<br>";
			}
		}
		
		/*méthode pour ajouter un utilisateur lors de l'inscription*/
		public static function inscription($prenom,$nom,$email,$pass,$dateNaissance,$sexe) {
			try {
				$requetePreparee = "INSERT INTO UTILISATEUR(prenom,nom,email,motDePasse,dateNaissance,sexe) VALUES (:tag_prenom,:tag_nom,:tag_email,:tag_motDePasse,:tag_dateNaissance,:tag_sexe);";
				$req_prep = Connexion::pdo()->prepare($requetePreparee);
				$valeurs = array("tag_prenom" => $prenom,"tag_nom" => $nom,"tag_email" => $email,"tag_motDePasse" => $pass,"tag_dateNaissance" => $dateNaissance,"tag_sexe" => $sexe);
				$req_prep->execute($valeurs);
				$req_prep->setFetchMode(PDO::FETCH_CLASS,'Utilisateur');
				$tab = $req_prep->fetchAll();

				return true;

			} catch(PDOException $e) {
				echo $e->getMessage()."<br>";
				return false;
			}
		}
		
		/*méthode pour vérifier l'email lors de l'inscription au cas où l'email serait déjà utilisé*/
		public static function verifEmail($email) {
			try {
				$requetePreparee = "SELECT * FROM UTILISATEUR WHERE email = :tag_email;";
				$req_prep = Connexion::pdo()->prepare($requetePreparee);
				$valeurs = array("tag_email" => $email);
				$req_prep->execute($valeurs);

				return true;

			} catch(PDOException $e) {
				echo $e->getMessage()."<br>";
				return false;
			}
		}
		
		/*méthode pour la déconnexion*/
		public static function disconnect() {
			session_unset();
			session_destroy();
			setcookie(session_name(), "", time()-1);
		}
	}
?>