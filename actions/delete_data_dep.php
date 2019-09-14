<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 06/09/2019
 * Time: 19:47
 */

$id = $_GET['delID'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();

$sql = "DELETE FROM elected WHERE elu_id=".$id."";
echo $sql;
if($stmt = $bd->query($sql))
{
    header('location:../deputies.php');
}
else
{
    var_dump($bd->errorInfo());
    die('Could not delete record:' );
}
