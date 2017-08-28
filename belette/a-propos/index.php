<?php
$configs = include('../admin/config.php');

try
{
	$bdd = new PDO("mysql:host=$configs->host;dbname=$configs->database", $configs->username, $configs->pass);
}
catch (Exception $e)
{

        die('Erreur : ' . $e->getMessage());

}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="Sarah Godereaux, photographe professionnel à Paris. Reportage photo, événementiel, tourisme, photos d’entreprise, environnement et urbanisme." />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />
		<link href="/css/petite-belette.css" rel="stylesheet">
		<link rel="icon" type="image/png" href="/img/favicon.png" />
		<title>La Petite Belette - Photographe Paris - A propos</title>
	</head>
	<body>
		<header class="navbar navbar-default navbar-fixed-top">
			<div class="containter-fluid">
 				<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#topNavbar">
  							<span class="icon-bar"></span>
  							<span class="icon-bar"></span>
  							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
   					<a class="navbar-left" href="/"><img src="/photos/logo_petite_belette.png" alt="logo_petite_belette" style="width:80px"></a>
 				</div>
				<div class="col-lg-offset-4">
					<div class="collapse navbar-collapse" id="topNavbar">
   						<ul class="nav navbar-nav">
    						<li><a href="/">Accueil</a></li>
    						<li class="dropdown">
								<a href="/galerie" class="dropdown-toggle" data-toggle="dropdown">Galerie<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="/galerie">Menu</a></li>
									<li><a href="/galerie/entreprises">Entreprises</a></li>
									<li><a href="/galerie/event">Événementiel</a></li>
									<li><a href="/galerie/portrait">Portrait</a></li>
									<li><a href="/galerie/flora">Faune / Flore</a></li>
									<li><a href="/galerie/esport">Esport</a></li>
									<li><a href="/galerie/concert">Concert</a></li>
		  							<li><a href="/galerie/tourisme">Tourisme</a></li>
								</ul>
							</li>
    						<li><a href="/boutique">Boutique</a></li>
							<li class="active"><a href="/a-propos">A propos</a></li>
  							<li><a href="/contact">Contact</a></li>
  						</ul>
						</div>
					</div>
				</div>
	 		</header>
		<!--</div>-->
		<div id="content">
		<div class="container-fluid">
	<div class="row" id="mentions">
			<div class="col-xs-offset-1 col-md-offset-2 col-xs-4 col-md-3">
				<img id="whois_pic" src="/photos/who_am_i.jpg" alt="photo_whois">
			</div>
			<div class="col-xs-6 col-md-5">
				<h3>Qui suis-je ?</h3>
				<p>Photographe autodidacte depuis 2010, j’ai appris le métier en écumant les rues de Paris et les concerts.<br/><br/>
        Si je me suis naturellement tournée vers la photo d’événementiel, j’ai également une prédilection à aborder certains sujets tels que le reportage, le tourisme, l’urbanisme, l’environnement et la faune.<br/><br/>
Plus qu’un métier, la photographie est pour moi une véritable passion que je mettrai au service de tous vos projets avec plaisir.
</p>
			</div>
	</div>
	</div>
</div>

	<footer class="footer">
   		<div class="container">
	 		<p class="pull-left">© Sarah Godereaux 2011-<?php echo date('Y');?>.</p>
			<div class="pull-right">
				<a href="/mentions-legales">Mentions légales</a>
			</div>
		</div>
	</footer>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</body>
</html>
