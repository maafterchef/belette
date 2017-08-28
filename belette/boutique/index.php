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
		<title>La Petite Belette - Photographe Paris</title>
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
    						<li ><a href="/">Accueil</a></li>
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
    						<li><a class="active" href="/boutique">Boutique</a></li>
							<li><a href="/a-propos">A propos</a></li>
  							<li><a href="/contact">Contact</a></li>
  						</ul>
					</div>
				</div>
			</div>
 		</header>
  <div id="content">
  <div class="container-fluid">
  <div id="boutiqueBody">
      <div class="row">
          <div class="col-xs-offset-1 col-md-offset-2 col-xs-10 col-md-8">
              <br />
              <h2>EN CONSTRUCTION</h2>
          </div>
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
