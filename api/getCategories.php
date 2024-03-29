<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 21/09/2019
 * Time: 15:33
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// get database connection

include_once '../includes/connextionBD.php';
// instantiate product object
include_once 'objects/Category.php';

$db = connextionBD::getInstance();

$cate = new Category($db);


$stmt = $cate->getAll();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $categories_arr=array();
    $categories_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $category_item=array(
            "id" => $id,
            "category" => $cat

        );

        array_push($categories_arr["records"], $category_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show categories data in json format
    echo json_encode($categories_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no categories found
    echo json_encode(
        array("message" => "No Category found.")
    );
}

?>