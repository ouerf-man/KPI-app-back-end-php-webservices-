<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 23/09/2019
 * Time: 17:39
 */


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection

include_once '../../includes/connextionBD.php';
// instantiate product object
include_once '../objects/User.php';

$db = connextionBD::getInstance();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->user) &&
    !empty($data->rating)
) {
    // set product property values
    $user->id = $data->user;
    $user->rating = $data->rating;


    if ($user->createRating()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "rating created"));
        // if unable to create the product, tell the user
    } else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "cannot create rating"));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create rating. missing data."));
}