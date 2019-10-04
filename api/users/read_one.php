<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 08/09/2019
 * Time: 21:31
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
include_once '../objects/User.php';

$db = connextionBD::getInstance();

$user = new User($db);

// set ID property of record to read
$user->id = isset($_GET['id']) ? intval($_GET['id']) : die();

// read the details of user to be edited

if($user->readOne()){
    // create array
    $user_arr = array(
        "id" =>  $user->id,
        "name" => $user->name,
        "email" => $user->email,
        "phone" => $user->phone,
        "isActive" => $user->isActive,
        "createdAt"=> $user->createdAt
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($user_arr);
} else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "user does not exist."));
}