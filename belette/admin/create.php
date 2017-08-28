<link href="../css/bootstrap.min.css" rel="stylesheet">
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<?php $configs = include('config.php');

try
{
	$bdd = new PDO("mysql:host=$configs->host;dbname=$configs->database", $configs->username, $configs->pass);
}
catch (Exception $e)
{

        echo 'Erreur : ' . $e->getMessage();

}?>


<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#prev')
                    .attr('src', e.target.result)
                    .width(600);

                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<script type="text/javascript">
    function validateCreate() {
        var x = document.forms["addPhoto"]["inputFile"].value;
        var y = document.forms["addPhoto"]["inputTitle"].value;
        if (x == "")
        {
            alert("Aucune photo saisie");
            return false;
        }
        if (y == "")
        {
            alert("Aucun titre saisi.");
            return false;
        }

    }
</script>

<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-static-top">

        <div class="navbar-header">

        <a class="navbar-brand" href="index.php">Belette.com</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Admin</a></li>
            <li class="active"><a href="create.php">Ajouter une photo</a></li>
            <li><a href="list_photo.php">Liste des photos</a></li>
            <li><a href="list_tag.php">Tags</a></li>
          </ul>
        </div>

    </div>
  </div>
  </div>



    <div class="container-fluid">
        <div class="col-md-11 col-md-offset-1">

            <?php $errors = array(
                1 => "Erreur lors du transfert du fichier.",
                2 => "Type de fichier non supporté.",
                3 => "Ficher déjà existant.");

          $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
          if ($error_id != 0 && isset($errors[$error_id])) {

              echo "<p style='text-align:center;color:red;font-size:220%;'><em>".$errors[$error_id]."</em></p>";
          }?>
<form method="post" action="addPhoto.php" enctype="multipart/form-data" name="addPhoto" onsubmit="return validateCreate()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <div style="text-align:center" class="form-group">
        <label style="text-align:justify" for="inputImg">Fichier</label>
        <input style="text-align:center" type="file" class="form-control-file" onchange="readURL(this)" id="inputFile" name="inputFile" aria-describedby="fileHelp">
        <img  id="prev" src="#" alt="Image" />
        <small id="fileHelp" class="form-text text-muted">Previsualisation image</small>
    </div>
    <div class="form-group">
        <label for="inputTitle">Titre</label>
        <input type="title" class="form-control" id="inputTitle" aria-describedby="titleHelp" placeholder="Titre de la photo" name="titleFile">
    </div>
    <div class="form-group">
      <label for="inputTags">Tags</label>
      <select multiple class="form-control" id="exampleSelect1" aria-describedby="tagsHelp" size="8" name="tagsFile[]">
          <?php
          $lst_tags = $bdd->query("SELECT * FROM $configs->table_tag");
          while ($donnees = $lst_tags->fetch()) {
          echo "<option>".$donnees['name']."</option>";
        }
          	$lst_tags->closeCursor();?>
      </select>
      <small id="tagsHelp" class="form-text text-muted">Choisir plusieurs tags en appuyant sur Ctrl.</small>
    </div>
    <div class="form-group">
      <label for="inputComments">Commentaires</label>
      <textarea class="form-control" id="inputComments" rows="4" placeholder="Commentaires additionnels" name="commentsFile"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Envoi</button>

  </form>
  </div>
  </div>
