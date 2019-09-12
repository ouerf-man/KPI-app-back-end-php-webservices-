<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 07/09/2019
 * Time: 21:13
 */
/*
 * data for api : subject, email , message
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
include_once '../objects/Message.php';

$db = connextionBD::getInstance();

$message = new Message($db);
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->subject) &&
    !empty($data->email) &&
    !empty($data->message)
) {
    // set product property values
    $message->subject=$data->subject;
    $message->message=$data->message;
    $message->email=$data->email;

    if ($message->create()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "created"));
        // if unable to create the product, tell the user
    } else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create user. missing data."));
}
