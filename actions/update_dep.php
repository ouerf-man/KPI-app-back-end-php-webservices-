<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 17/09/2019
 * Time: 17:55
 */

$id = $_POST['autoid'];
$nomFr = $_POST['nomFr'];
$nomAr = $_POST['nomAr'];
$bio = $_POST['bio'];
$gov = $_POST['gov'];
$imgLink = $_POST['imgLink'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();

if (!empty($_FILES['img']["name"])) {
    $target_dir = "../img/";
    $imgLink = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($imgLink,PATHINFO_EXTENSION));
    $imgLink = $target_dir . explode('\'',$id,3)[1] .".". $imageFileType;
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {

        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($imgLink)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["img"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgLink)) {
            echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $imgLink = "img/".explode('\'',$id,3)[1];
}

$sql = "UPDATE elected SET  elu_nom_fr='$nomFr', elu_nom_ar='$nomAr' ,img='$imgLink', bio=:bio , gov='$gov'  WHERE elu_id=".$id."";
$stmt = $bd->prepare($sql);
$stmt->bindParam(":bio",$bio);
var_dump($stmt);
if($stmt->execute())
{
    header('location:../deputies.php');
}
else
{
    var_dump($bd->errorInfo());
    echo $sql;
    die('Unable to update record: ' );
}