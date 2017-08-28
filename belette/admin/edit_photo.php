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

        die('Erreur : ' . $e->getMessage());

}



$id_photo = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$photo = $bdd->query("SELECT * FROM $configs->table_pic WHERE id = '$id_photo'");
$donnees = $photo->fetch();
if (!$donnees)
{
    header("location:list_photo.php?err=1");
}
?>

<script type="text/javascript">
    function validateEdit() {
        var y = document.forms["editPhoto"]["editTitle"].value;
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
            <li><a href="create.php">Ajouter une photo</a></li>
            <li class="active"><a href="list_photo.php">Liste des photos</a></li>
            <li><a href="list_tag.php">Tags</a></li>
          </ul>
        </div>

    </div>
  </div>
 </div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <form method="post" action="editPhoto.php" enctype="multipart/form-data" name="editPhoto" onsubmit="return validateEdit()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <div style="text-align:center" class="form-group">
                <?php echo "<img  id='img' src='/photos/".$donnees['path_to_file']." 'style='width:450px' alt='Image' />";?>
            </div>
            <div class="form-group">
                <label for="inputTitle">Titre</label>
                <?php echo "<input type='title' class='form-control' id='editTitle' aria-describedby='titleHelp' placeholder='Titre de la photo' value='". stripslashes($donnees['title']) ."' name='titleFile'>";?>
            </div>
            <div class="form-group">
              <label for="inputTags">Tags</label>
              <select multiple class="form-control" id="exampleSelect1" aria-describedby="tagsHelp" size="8" name="tagsFile[]">
                  <?
                  $lst_tags = $bdd->query("SELECT * FROM $configs->table_tag");

                  $tags_id = $bdd->query("SELECT * FROM $configs->table_pic_tag WHERE banane = '$id_photo'");
                  while ($tag_list = $tags_id->fetch()) {
                      $id_tag_search = $tag_list['tag'];
                      $tags_nane = $bdd->query("SELECT * FROM $configs->table_tag WHERE id = '$id_tag_search'");
                      while($tag_name_list = $tags_nane->fetch()) {
                          $array_lst_tags[] = $tag_name_list['name'];
                      }
                  }


                 while ($tag_data = $lst_tags->fetch()) {
                     if (in_array($tag_data['name'], $array_lst_tags)) {
                         echo "<option selected>".$tag_data['name']."</option>";
                     }
                     else {
                         echo "<option>".$tag_data['name']."</option>";
                     }
                }
                  	$lst_tags->closeCursor();?>
              </select>
              <small id="tagsHelp" class="form-text text-muted">Choisir plusieurs tags en appuyant sur Ctrl.</small>
            </div>
            <div class="form-group">
              <label for="inputComments">Commentaires</label>
              <textarea class="form-control" id="inputComments" rows="4" placeholder="Commentaires additionnels" name="commentsFile"><?php if(isset($donnees['about'])) { echo stripslashes($donnees['about']);}?></textarea>
            </div>
            <div class="form-group hidden">
                <?php echo "<input type='id' id='inputId' name='idFile' value='" . $donnees['id'] . "'>" ?>
            </div>
            <button type="submit" class="btn btn-default">Envoi</button>

          </form>
          </div>
          </div>
    </div>
</div>
