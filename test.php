<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 05/09/2019
 * Time: 20:48
 */


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml;

$xls = new \PhpOffice\PhpSpreadsheet\Reader\Xml();

$xls->setReadDataOnly(true);
try {
    $spreadSheet = $xls->load("elected.xml");
} catch (Exception $e) {
    echo $e->getMessage();
}
try {
    $workSheet = $spreadSheet->getActiveSheet();
} catch (Exception $e) {
    echo $e->getMessage();
}

require_once('includes/connextionBD.php');
$bd = connextionBD::getInstance();

$sql = "DELETE from elected";

if ($stmt = $bd->query($sql)) {
    $stmt = $bd->prepare("INSERT INTO elected (elu_id,elu_nom_fr,elu_nom_ar) VALUES (:id, :nomFr,:nomAr)");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nomFr', $nameFr);
    $stmt->bindParam(':nomAr', $nameAr);
    $i = 2;
    while ($workSheet->cellExistsByColumnAndRow(1, $i)) {
        $id = $workSheet->getCellByColumnAndRow(1, $i)->getFormattedValue();
        $nameFr = $workSheet->getCellByColumnAndRow(2, $i)->getFormattedValue();
        $nameAr = $workSheet->getCellByColumnAndRow(3, $i)->getFormattedValue();
        $i++;
        if ($stmt->execute()) {
            echo '<h1>done  '.$i.'</h1><br>';
        }
    }
} else {
    die('Could not delete record:' . mysqli_error());
}

?>