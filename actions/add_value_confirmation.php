<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 12/09/2019
 * Time: 03:43
 */

$id= $_POST['id'];
$table = $_POST['table'];
$month = $_POST['month'];
$value = $_POST['val'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();
$sql1 = "SELECT attributes FROM ".$table." WHERE elu_id=".$id."";
$row= $bd->query($sql1)->fetch();
$values = json_decode($row['attributes'],true);
$values[$month]=$value;
$values=json_encode($values);
$sql = "UPDATE ".$table." SET attributes='$values' WHERE elu_id=".$id."";
if($bd->query($sql))
{
    header("location:../deputie.php?dID=".$id."");
}
else
{
    die('Unable to update record: ' );
}
?>