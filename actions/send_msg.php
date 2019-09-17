<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 16/09/2019
 * Time: 16:01
 */

$email = $_POST['email'];
$subject = $_POST['subject'];
$msg = $_POST['message'];
mail($email, $subject, $msg);
header('location:../messages.php');
