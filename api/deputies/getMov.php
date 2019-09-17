<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 15/09/2019
 * Time: 18:31
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


$stmt = $dep->getAvg('mouvement');
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    $result = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $mouvement = json_decode($attributes, true);
        $keys = array_keys($mouvement);
        foreach (array_keys($keys) AS $k) {
            $arr=array();
            $arr['parti'] = $mouvement[$keys[$k]];
            $arr['mandatIn'] = $keys[$k];
            if(isset($keys[$k+1])){
            $arr['mandatOut'] = $keys[$k+1];
            }else $arr['mandatOut'] = null;
            array_push($result,$arr);
        }
    }

    // set response code - 200 OK
    http_response_code(200);
    // show categories data in json format
    echo json_encode(array(
        "mouvement" => $result,
    ));
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no categories found
    echo json_encode(
        array("message" => "No data found.")
    );
}
