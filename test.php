<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 05/09/2019
 * Time: 20:48
 */


require 'vendor/autoload.php';


require_once('includes/connextionBD.php');
$bd = connextionBD::getInstance();

$sql = "Select elu_id from elected where bio=''";

$stmt = $bd->query($sql);
$arr = array();
while ($row=$stmt->fetch()){
    array_push($arr,$row['elu_id']);
}
$sql = "DELETE from votes where elu_id = :id";
$stmt=$bd->prepare($sql);
$stmt->bindParam(':id', $id);

foreach ($arr as $val){
    $id = $val;
    $stmt->execute();
}