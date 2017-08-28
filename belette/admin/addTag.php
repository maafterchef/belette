<?php $configs = include('config.php');

try
{
	$bdd = new PDO("mysql:host=$configs->host;dbname=$configs->database", $configs->username, $configs->pass);
}
catch (Exception $e)
{

        die('Erreur : ' . $e->getMessage());

}
if(isset($_REQUEST['newTag']))
{
    $name = $_REQUEST['newTag'];
    $tag_exists = $bdd->query("SELECT * FROM $configs->table_tag WHERE name = '$name'");
    $donnees = $tag_exists->fetch();
    if (!$donnees)
    {
        $bdd->query("INSERT INTO $configs->table_tag (name) VALUES ('$name')");
        header("location:list_tag.php?act=1");
    }
    else {
        header("location:list_tag.php?err=1");
    }
}
