<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 12/09/2019
 * Time: 04:17
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// get database connection

include_once '../../includes/connextionBD.php';
// instantiate product object
include_once '../objects/Deputie.php';

$db = connextionBD::getInstance();
$dep = new Deputie($db);
$dep->id = isset($_GET['id']) ? $_GET['id'] : die();


$stmt = $dep->getAvg('com_spec');
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {


    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $ple = json_decode($attributes, true);
        $sum=0;
        foreach ($ple as $item) {
            $sum+=floatval($item);
        }
        $result = $sum/sizeof($ple);
    }

    // set response code - 200 OK
    http_response_code(200);
    foreach ($dep->getTopAvg("com_spec") as $key=>$val){
    }
    // show categories data in json format
    echo json_encode(array(
        "spec" => $result,
        "topSpec" =>$val,
        "topSpecId"=>$key,
        "avg" => $dep->avgAll('com_spec')
    ));
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no categories found
    echo json_encode(
        array("message" => "No data found.")
    );
}
