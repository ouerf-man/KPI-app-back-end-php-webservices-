<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 19/09/2019
 * Time: 20:42
 */

$id = $_POST['id'];
$table = $_POST['table'];
$val = $_POST['val'];


require_once('../includes/connextionBD.php');
$bd = connextionBD::getInstance();
$sql1 = "SELECT attributes FROM " . $table . " WHERE elu_id=" . $id . "";

if ($bd->query($sql1)->rowCount() > 0) {
    die('<h2 style="color: tomato">WHOOPS, Deputie '.$id.' have values already in database</h2>');
}

$months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
$years = ['2015','2016','2017','2018','2019'];

$values = array();
$values['2014-12']=$val;
for($i=0;$i<5;$i++){
    for($j=0;$j<12;$j++){
        $values[$years[$i].'-'.$months[$j]]= $val;
    }
}

$values = json_encode($values);
$sql = "INSERT INTO ".$table."(`elu_id`, `attributes`) VALUES(".$id.",'$values')";
if ($bd->query($sql)) {
    header("location:../deputie.php?dID=" . $id . "");
} else {
    die('Unable to add records: ');
}
