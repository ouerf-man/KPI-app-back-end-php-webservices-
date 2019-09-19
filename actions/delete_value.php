<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 19/09/2019
 * Time: 14:20
 */
$table = $_GET['table'];
$id = $_GET['id'];
$month=$_GET['month'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();
$sql1 = "SELECT attributes FROM ".$table." WHERE elu_id=".$id."";

$row= $bd->query($sql1)->fetch();
$values = json_decode($row['attributes'],true);
unset($values[$month]);
$values=json_encode($values);
$sql = "UPDATE ".$table." SET attributes='$values' WHERE elu_id=".$id."";
if($bd->query($sql))
{
    header("location:../deputie.php?dID=".$id."");
}
else
{
    die('Unable to delete record: ' );
}