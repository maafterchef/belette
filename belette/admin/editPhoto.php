<?php $configs = include('config.php');

try
{
	$bdd = new PDO("mysql:host=$configs->host;dbname=$configs->database", $configs->username, $configs->pass);
}
catch (Exception $e)
{

        die('Erreur : ' . $e->getMessage());

}
if(!isset($_FILES['titleFile'])) {
        header("location:list_photo.php");
}

$title = addslashes(htmlentities($_REQUEST['titleFile']));
$comments = addslashes(htmlspecialchars($_REQUEST['commentsFile']));
$id_photo = $_REQUEST['idFile'];
if (!isset($title) || !isset($id_photo))
    header("location:list_photo.php");
$bdd->query("UPDATE $configs->table_pic SET title = '$title', about = '$comments' WHERE id = '$id_photo'");

$tags_id = $bdd->query("SELECT * FROM $configs->table_tag");
 while($tag_id = $tags_id->fetch()) {
     $t_id_val = $tag_id['id'];
     $check_if_tagged = $bdd->query("SELECT * FROM $configs->table_pic_tag WHERE banane = '$id_photo' AND tag = '$t_id_val'");
     $check_tagged = $check_if_tagged->fetch();
     if (!$check_tagged && in_array($tag_id['name'], $_REQUEST['tagsFile'])) {
        $new_sql = "INSERT INTO $configs->table_pic_tag (banane, tag)
                    VALUES ('$id_photo', '$t_id_val')";
        $bdd->exec($new_sql);
    }
    else if ($check_tagged && !in_array($tag_id['name'], $_REQUEST['tagsFile'])) {
        $bdd->query("DELETE FROM $configs->table_pic_tag WHERE banane = '$id_photo' AND tag = '$t_id_val'");
    }
}
header("location:list_photo.php?act=2");

?>
