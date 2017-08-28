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

<?php

	if (isset($_REQUEST['submit'])) {

		if (!isset($_REQUEST['name'])) {
			$error['name'] = "<p>Merci de renseigner votre nom.</p>";
		}
		if (!isset($_REQUEST['first_name'])) {
			$error['first_name'] = "<p>Merci de renseigner votre prénom.</p>";
		}
	if (!isset($_REQUEST['email']) || !filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
					$error['email'] = "<p>Merci de renseigner une adresse email valide.</p>";
		}
		if (!isset($_REQUEST['message'])) {
			$error['message'] = "<p>Merci de renseigner votre message.</p>";
		}
		if (!is_array($error)) {
			$dest = 'darkmaaf@gmail.com';
			$name = htmlspecialchars($_REQUEST['name']);
			$f_name = htmlspecialchars($_REQUEST['first_name']);
			if (isset($_REQUEST['company']))
				$company = htmlspecialchars($_REQUEST['company']);
				if (isset($_REQUEST['phone']))
				$phone = htmlspecialchars($_REQUEST['phone']);
			$subject = htmlspecialchars($_REQUEST['subject']);
			$msg = htmlspecialchars($_REQUEST['message']);


		$headers  = 'From:'.$f_name.' '.$name.' <'.$email.'>' . "\r\n";

		$msg = str_replace("&#039;","'",$msg);
		$msg = str_replace("&#8217;","'",$msg);
		$msg = str_replace("&quot;",'"',$msg);
		$msg = str_replace('&lt;br&gt;','',$msg);
		$msg = str_replace('&lt;br /&gt;','',$msg);
		$msg = str_replace("&lt;","&lt;",$msg);
		$msg = str_replace("&gt;","&gt;",$msg);
		$msg = str_replace("&amp;","&",$msg);

		if (isset ($company)) {
			$msg = '\n Entreprise : '  .$company. "\r\n" . $msg; }
		if (isset ($phone)) {
				$msg = '\n Telephone : '  .$phone. "\r\n" . $msg; }
		if (mail($dest, $subject, $msg, $headers)) {

			  header("/");
		}

		else {
			$error['mail'] = "<p>Echec lors de l'envoi du mail.</p>";
		}
	}
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
		<title>La Petite Belette - Photographe Paris - Contact</title>
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
    						<li><a href="/boutique">Boutique</a></li>
							<li><a href="/a-propos">A propos</a></li>
  							<li class="active"><a href="/contact">Contact</a></li>
							</ul>
					</div>
				</div>
			</div>
 		</header>
	<!--</div>-->
	<div id="content">
	<div class="container-fluid">

	<div class="row" id="contact-bg">
			<div class="col-xs-offset-1 col-md-offset-2 col-xs-5 col-md-4">
				<h3>Formulaire de contact</h3>


				<form id="contact" method="post" action="<?=$_SERVER['PHP_SELF']?>">
          <div class="form-group">
            <p>
                <input type="text" class="form-control" id="company" name="company" value placeholder="Entreprise" />
                <br />
                <input type="text" class="form-control" id="name" name="name" value placeholder="Nom *" required />
                <br />
                <input type="text" class="form-control" id="first_name" name="first_name" value placeholder="Prénom *" required />
                <br />
                <input type="email" class="form-control" id="email" name="email" value placeholder="Email *" required />
                <br />
                <input type="text" class="form-control" id="phone" name="phone" value placeholder="Téléphone"  />
                <br />
                <select class="form-control" id="subject" name="subject" required>
									<option value="" disabled>Sujet</option>
                  <option value="info" selected>Renseignements</option>
                  <option value="devis">Devis</option>
                  <option value="client">Service Client</option>
                  <option value="other">Autre</option>
                </select>
              </p>

              <p>
                <br />
								<?=$error['message'] ?? '' ?>
                <textarea class="form-control" id="message" name="message" placeholder="Message *" rows="6" required></textarea>
              </p>
            </div>
					<button type="submit" name="submit" class="btn btn-default">Envoyer</button>
				</form>
			</div>
			<div class="col-xs-5 col-md-4" id="contact_col">
					<img id="contact_pic" src="/photos/contact.jpg" alt="photo_contact">
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
