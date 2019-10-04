<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 02/10/2019
 * Time: 20:50
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

$data = json_decode(file_get_contents("php://input"));

$id = $data->user;
$gov= $data->gov;

$sql = "INSERT INTO govs_clicked (userId,gov) values (:id, :gov)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id',$id);
$stmt->bindParam(':gov',$gov);
if($stmt->execute()){
    http_response_code(201);

    // tell the user
    echo json_encode(array("message"=>"value added"));
}else {

    // set response code - 503 service unavailable
    http_response_code(503);
    // tell the user
    echo json_encode(array("message" => "Unable to create"));
}