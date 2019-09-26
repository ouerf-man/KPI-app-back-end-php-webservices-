<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 21/09/2019
 * Time: 14:43
 */
$art = $_POST['id'];
$votes = $_POST['vote'];
require_once('../includes/connextionBD.php');
include_once '../api/objects/Deputie.php';
$bd = connextionBD::getInstance();
$dep = new Deputie($bd);
// set all null
$getDepStmt = $dep->readAll();
while ($row=$getDepStmt->fetch()){
    $sql1 = "SELECT attributes FROM votes_articles WHERE elu_id=\"" . $row['elu_id'] . "\"";
    $key = $row['elu_id'];
    if ($bd->query($sql1)->rowCount() > 0) {
        $row = $bd->query($sql1)->fetch();
        $values = json_decode($row['attributes'], true);
        $values[$art] = "4";
        $values = json_encode($values);
        $sql = "UPDATE votes_articles SET attributes='$values' WHERE elu_id=\"" . $key . "\"";
        if ($bd->query($sql)) {

        } else {
            var_dump($bd>errotInfo());
            die('Unable to update record: ');
        }
    }else{
        $values = array();
        $values[$art] = "4";
        $values = json_encode($values);
        $sql = "INSERT INTO votes_articles (`elu_id`, `attributes`) VALUES('$key','$values')";
        if ($bd->query($sql)) {

        } else {
            var_dump($bd->errorInfo());
            die('Unable to update record: ');
        }
    }
}


// start setting values


foreach ($votes as $key=>$vote){
    $sql1 = "SELECT attributes FROM votes_articles WHERE elu_id=\"" . $key . "\"";


        $row = $bd->query($sql1)->fetch();
        $values = json_decode($row['attributes'], true);
        $values[$art] = $vote;
        $values = json_encode($values);
        $sql = "UPDATE votes_articles SET attributes='$values' WHERE elu_id=\"" . $key . "\"";
        if ($bd->query($sql)) {
            header("location:../articles");
        } else {
            var_dump($bd>errotInfo());
            die('Unable to update record: ');
        }

}