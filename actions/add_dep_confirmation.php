<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 14/09/2019
 * Time: 13:58
 */

$id = $_POST['id'];
$nomFr = $_POST['nomFr'];
$nomAr = $_POST['nomAr'];
$bio = $_POST['bio'];
$gov = $_POST['gov'];
$imgLink = "";

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();
if (isset($_FILES['img'])) {
    $imgLink = "img/" . $id;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($imgLink, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            die("File is not an image.");
            $uploadOk = 0;
        }
    }
}
$sql = "INSERT INTO elected(elu_id,elu_nom_fr,elu_nom_ar,img,bio,gov) values ('$id','$nomFr','$nomAr','$imgLink','$bio','$gov')";

if($bd->query($sql)){
    header("location:../deputies.php");
}else{
    die("unable to add deputie");
}
?>