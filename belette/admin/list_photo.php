<link href="../css/bootstrap.min.css" rel="stylesheet">
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
            function confirmDelete() {
                var r = confirm("Supprimer la photo ?");
                if (r)
                {
                    return (true);
                }
                else {
                    return (false);
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

<?php $id_start = isset($_GET['id']) ? (int)$_GET['id'] : 0;
?>


<div class="row">
    <div class="col-md-10 col-md-offset-1">

			<?php $errors = array(
				1 => "Photo non trouvée");

		  $error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
		  if ($error_id != 0 && isset($errors[$error_id])) {

			  echo "<p style='text-align:center;color:red;font-size:220%;'><em>".$errors[$error_id]."</em></p>";
		  }

		  $messages = array(
			  1 => "Photo ajoutée",
			  2 => "Photo éditée");
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
                    <td>Image</td>
                    <td>Titre</td>
                    <td>Date</td>
                    <td colspan="2">Tags</td>
                </tr>
            		<?php
            		$lst_photos = $bdd->query("SELECT * FROM $configs->table_pic WHERE id > $id_start LIMIT 25");
					if ($lst_photos) {
            			while ($donnees = $lst_photos->fetch()) {
                			echo "<tr><td>".$donnees['id']."</td>";
                			echo "<td><img src='/photos/".$donnees['path_to_file']."' style='width:150px'/></td>
                			<td>".stripslashes($donnees['title'])."</td><td>";
                			$text_date = strtotime($donnees['date']);
                			echo date("G:i:s" , $text_date). "<br />". date("d-m-Y", $text_date). "</td>";
                			$id_search = $donnees['id'];
                			$tags_id = $bdd->query("SELECT * FROM $configs->table_pic_tag WHERE banane = '$id_search'");
                			echo "<td>";
                			while ($tag_list = $tags_id->fetch()) {
                    			$id_tag_search = $tag_list['tag'];
                    			$tags_nane = $bdd->query("SELECT * FROM $configs->table_tag WHERE id = '$id_tag_search'");
                    			while($tag_name_list = $tags_nane->fetch()) {
                                	echo $tag_name_list['name'] . "<br />";
                    			}

                			}
                			echo "</td>
                			<td>
                    		<a href='edit_photo.php?id=" . $id_search . "' role='button' class='btn btn-primary'>Editer</a>
                    		<a href='delete_photo.php?=" . $id_search. "' onclick='return confirmDelete()' type='button' class='btn btn-danger'>Supprimer</button>
                			</td>
            				</tr>";
        				}
					}
        	?>
        	</tbody>
        </table>
    </div>
</div>
	<div class="row">
    	<div class="col-md-2 col-md-offset-10">
			<?php if(isset($id_search)) {
        		echo "<a href='list_photo.php?id=" . $id_search . "' role='button' class='btn btn-primary'>Page suivante</a>";
			} ?>
    	</div>
	</div>
}
