<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="view/CSS/index.css"/>
		<link rel="icon" href="view/Images/basket_logo.png"/>
	</head>
	<body>
		<div class="bg">
			<header>
				<ul class="dropdown">
					<?php
						if(!isset($_SESSION["email"])) {
							echo "<li>";
								echo "<a class=\"boutonprincipal\"> &#9776 </a>";
								echo "<ul class=\"dropdown-child\">";
									echo "<li class=\"mhovert\"><a href=\"routeur.php\">ACCUEIL</a></li>";
									echo "<li class=\"mhover\"><a href=\"routeur.php?action=u_connect\">CONNEXION</a></li>";
									echo "<li class=\"mhoverb\"><a href=\"routeur.php?action=u_inscrip\">INSCRIPTION</a></li>";
								echo "</ul>";
							echo "</li>";
						} else {
							echo "<li>";
								echo "<a class=\"boutonprincipal\"> &#9776 </a>";
								echo "<ul class=\"dropdown-child\">";
									echo "<li class=\"mhovert\"><a href=\"routeur.php?action=u_main\">ACCUEIL</a></li>";
									echo "<li class=\"mhover\"><a href=\"routeur.php?action=u_compteUtilisateur\">MON COMPTE</a></li>";
									echo "<li class=\"mhoverb\"><a href=\"routeur.php?action=u_disconnect\">DÉCONNEXION</a></li>";
								echo "</ul>";
							echo "</li>";
						}	
					?>
				</ul>
				<div class="bar">
					<?php
						if(!isset($_SESSION["email"])) {
							echo "<div class=\"barright\">";
								echo "<a href=\"routeur.php\" class=\"mhover padtop\">ACCUEIL</a>";
							echo "</div>";
							
							echo "<div class=\"barright\">";
								echo "<a href=\"routeur.php?action=u_connect\" class=\"mhover padtop\">CONNEXION</a>";
							echo "</div>";
						
							echo "<div class=\"barright\">";
								echo "<a href=\"routeur.php?action=u_inscrip\" class=\"mhover padtop\">INSCRIPTION</a>";
							echo "</div>";
							
						} else {
							echo "<div class=\"barright\">";
								echo "<a href=\"routeur.php?action=u_main\" class=\"mhover padtop\">ACCUEIL</a>";
							echo "</div>";
						
							echo "<div class=\"barright\">";
								echo "<a href=\"routeur.php?action=u_compteUtilisateur\" class=\"mhover padtop\">MON COMPTE</a>";
							echo "</div>";

							echo "<div class=\"barright\">";
								echo "<a href=\"routeur.php?action=u_disconnect\" class=\"mhover padtop\">DÉCONNEXION</a>";
							echo "</div>";
						}
					?>
				</div>
			</header>

			<div class="main">
				<div class="p1">
					<?php 
						if(isset($_GET["action"])) {
							$car = substr($_GET["action"],0,1);
							if(strcmp($car,"u") == 0) {	// si la valeur de action commence par un u, ex: u_connect
								include("/wamp64/www/Test_Uballers/controller/ControllerUtilisateur.php");
								$action = substr($_GET["action"],2);
								ControllerUtilisateur::$action();
								
							} else {
								include("/wamp64/www/Test_Uballers/controller/ControllerUtilisateur.php");
								$action = "main";
								ControllerUtilisateur::$action();
							}
						} else {
							echo"<h1>Bienvenue sur notre site</h1>";
						}
					?>
				</div>
			</div>
		</div>
		<footer>
				<p class="vivien"> Vivien LAZONE </p>
		</footer>
	</body>
</html>