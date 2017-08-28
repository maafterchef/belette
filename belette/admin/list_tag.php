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

}
?>

<script type="text/javascript">
    function validateTag() {
        var x = document.forms["addTag"]["newTag"].value;

        if (x == "")
        {
            alert("Nom invalide");
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
            <li><a href="list_photo.php">Liste des photos</a></li>
            <li class="active"><a href="list_tag.php">Tags</a></li>
          </ul>
        </div>

    </div>
  </div>
 </div>

 <div class="row">
     <div class="col-md-10 col-md-offset-1">

         <?php $errors = array(
             1 => "Tag déjà existant");

       $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
       if ($error_id != 0 && isset($errors[$error_id])) {

           echo "<p style='text-align:center;color:red;font-size:220%;'><em>".$errors[$error_id]."</em></p>";
       }

       $messages = array(
           1 => "Tag ajouté");
       $msg_id = isset($_GET['act']) ? (int)$_GET['act'] : 0;

       if ($msg_id != 0 && isset($messages[$msg_id])) {
           echo "<p style='text-align:center;color:green;font-size:220%;'><em>".$messages[$msg_id]."</em></p>";
       }


     ?>





         <h1 style="text-align:center">Liste des photos</h1>
         <table class="table table-striped table-hover">
             <tbody>
                 <tr style="text-align:justify">
                     <td>ID</td>
                     <td>Nom du tag</td>
                 </tr>
                 <?php
                 $lst_tags = $bdd->query("SELECT * FROM $configs->table_tag");
                 if ($lst_tags) {
                     while ($donnees = $lst_tags->fetch()) {
                         echo "<tr><td>".$donnees['id']."</td>";
                         echo "<td>".$donnees['name']."</td></tr>";
                     }
                 }?>
            </tbody>
        </table>
        <form method="post" action="addTag.php" enctype="multipart/form-data" name="addTag" onsubmit="return validateTag()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="inputTitle">Nouveau tag</label>
                <input type="title" class="form-control" id="inputTag" aria-describedby="titleHelp" placeholder="Nom du tag" name="newTag">
            </div>
            <button type="submit" class="btn btn-default">Envoi</button>

        </form>
    </div>
</div>
