<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 21/09/2019
 * Time: 13:51
 */


require_once('../includes/connextionBD.php');
include_once '../api/objects/Article.php';

$bd = connextionBD::getInstance();
$art = new Article($bd);
$art->cat = $_POST['cat'];
$art->title = $_POST['title'];
$art->file = "";

if (!empty($_FILES['file']["name"])) {
    $art->file="files/".basename( $_FILES['file']['name']);
}
if (move_uploaded_file($_FILES['file']['tmp_name'], "../".$art->file)) {

    echo "The file " . basename($_FILES['file']['name']) . " is uploaded";
    $art->addOne();
} else {

    die ("Problem uploading file");

}


?>
}