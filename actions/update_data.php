<?php
$autoid = $_POST['hid'];
$un = $_POST['txtusername'];
$pw = $_POST['txtpassword'];
$email = $_POST['txtemail'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();

$sql = "UPDATE users SET name='$un', Password='$pw', Email='$email' WHERE id='$autoid'";

if($bd->query($sql))
{
	header('location:../users.php');
}
else
{
	die('Unable to update record: ' );
}
?>