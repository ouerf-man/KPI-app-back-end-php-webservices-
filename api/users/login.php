<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 07/09/2019
 * Time: 17:32
 */
/*
 * data for api : email , password
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../includes/connextionBD.php';
// instantiate product object
include_once '../objects/User.php';

$db = connextionBD::getInstance();

$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->email = $data->email;
$email_exists = $user->emailExists();
if ($user->email != null) {
    if ($email_exists && $data->password == $user->password) {
        http_response_code(200);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "userId" => $user->id
            )
        );
    } else {
        http_response_code(400);
        echo json_encode(
            array(
                "message" => "login failed.",
            )
        );
    }
}else{
    http_response_code(400);
    echo json_encode(
        array(
            "message" => "login failed. email required",
        )
    );
}