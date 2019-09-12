<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 09/09/2019
 * Time: 18:41
 */
// expected prop : gov

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

$dep->gov = isset($_GET['gov']) ? $_GET['gov'] : die();


$stmt = $dep->readByGov();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $deputies_arr=array();
    $deputies_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $deputie_item=array(
            "id" => $elu_id,
            "nomFr" => $elu_nom_fr,
            "nomAr" => $elu_nom_ar,
            "gov" => $gov,
            "bio" => $bio
        );

        array_push($deputies_arr["records"], $deputie_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show categories data in json format
    echo json_encode($deputies_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no categories found
    echo json_encode(
        array("message" => "No Deputies found.")
    );
}

?>