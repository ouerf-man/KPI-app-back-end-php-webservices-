<?php
// $un = $_POST['username'];
$pwd = $_POST['password'];

require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();
$sql="select * from tbladministrator where pass='".$pwd."'";
try {
  $stmt = $bd->query($sql);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  header('Location: ../login.php');
}

if ($stmt->fetch()) {
  session_start();
  $_SESSION['pwd']=$pwd;
  header('Location: ../index.php');
  exit(200);
}else
{
  session_start();
  $_SESSION['msg'] = '<h2>Invalid username or password!</h2>';
  header('location:../login.php');
}


?>
