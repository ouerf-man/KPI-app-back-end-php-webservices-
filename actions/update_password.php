<?php
// $AdminAutoId = $_POST['uAid'];
$pw = $_POST['txtpassword'];

include('../includes/connextionBD.php');
$bd = connextionBD::getInstance();
$sql = "UPDATE tbladministrator SET pass='$pw' WHERE id='1'";

if($bd->query($sql))
{
	header('location:../logout.php');
}
else
{
	die('Unable to update record: ' .mysqli_error());
}
?>