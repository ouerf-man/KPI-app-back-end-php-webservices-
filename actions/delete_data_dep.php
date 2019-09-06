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

$sql = "DELETE FROM delete WHERE elu_id=$id";
if($stmt = $bd->query($sql))
{
    header('location:../deputies.php');
}
else
{
    die('Could not delete record:' .mysqli_error());
}
