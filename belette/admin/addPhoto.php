<?php $configs = include('config.php');

try
{
	$bdd = new PDO("mysql:host=$configs->host;dbname=$configs->database", $configs->username, $configs->pass);
}
catch (Exception $e)
{

        echo 'Erreur : ' . $e->getMessage();

}?>

<?php

if(isset($_FILES['inputFile']) && $_FILES['inputFile']['error'] == 0)
{
    $infos = pathinfo($_FILES['inputFile']['name']);
    $extension = $infos['extension'];
    $allowed_extension = array('jpg', 'JPG', 'jpeg', 'JPEG', 'cr2', 'CR2', 'png', 'PNG');
    $dir = '/opt/lampp/htdocs/photos/';
    $title = addslashes(htmlentities($_REQUEST['titleFile']));
    $comments = addslashes(htmlspecialchars($_REQUEST['commentsFile']));
    $path_to_file = htmlspecialchars(basename($_FILES['inputFile']['name']));
   if(in_array($extension, $allowed_extension))
    {
        if (!file_exists($dir.basename($_FILES['inputFile']['name']))) {
            try {
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO $configs->table_pic (title, path_to_file, about)
                VALUES ('$title', '$path_to_file', '$comments')";
                $bdd->exec($sql);
                $last_id = $bdd->query("SELECT id FROM $configs->table_pic WHERE id =(SELECT max(id) FROM $configs->table_pic)");
                while($id = $last_id->fetch()) {
                            $id_val = $id['id'];
                     }
                foreach ($_REQUEST['tagsFile'] as $tags) {

                    $tags_id = $bdd->query("SELECT * FROM $configs->table_tag t WHERE name LIKE '$tags'");
                     while($tag_id = $tags_id->fetch()) {
                         $t_id_val = $tag_id['id'];
                         $new_sql = "INSERT INTO $configs->table_pic_tag (banane, tag)
                         VALUES ('$id_val', '$t_id_val')";
                         $bdd->exec($new_sql);
                     }
            }
        }
            catch(PDOException $e)
            {
        echo $sql . "<br>" . $e->getMessage();
        }
            move_uploaded_file($_FILES['inputFile']['tmp_name'], $dir.basename($_FILES['inputFile']['name']));
			header("location:list_photo.php?act=1");
        }
        else {
            header("location:create.php?err=3");
        }
    }
    else {
        header("location:create.php?err=2");
    }
}
else
    header("location:create.php?err=1");
?>
