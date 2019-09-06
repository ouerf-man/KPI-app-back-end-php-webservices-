<?php
$id = $_GET['delID'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();

$sql = "DELETE FROM users WHERE id=$id";
if($stmt = $bd->query($sql))
{
	header('location:../users.php');
}
else
{
	die('Could not delete record:' .mysqli_error());
}
?>