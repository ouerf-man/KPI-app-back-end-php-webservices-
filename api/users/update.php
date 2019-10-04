<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 07/09/2019
 * Time: 19:46
 */
/*
 * data for api userName , email , password
 */
// required headers
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

$user->id = $data->id;

if(isset($data->userName)){
    $user->name = $data->userName;
}

if(isset($data->userName)){
    $user->phone = $data->phone;
}

if(isset($data->email)){
    $user->email = $data->email;
}
if(isset($data->password)){
    $user->password = $data->password;
}

if($user->update()){
    // set response code
    http_response_code(200);

    // show error message
    echo json_encode(array("message" => "User was updated."));
}   else{
    // set response code
    http_response_code(401);

    // show error message
    echo json_encode(array("message" => "Unable to update user."));
}