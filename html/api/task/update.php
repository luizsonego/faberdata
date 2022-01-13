<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/task.php';

$database = new Database();
$db = $database->getConnection();

$item = new Task($db);

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

$item->title = $data->title;
$item->description = $data->description;
$item->status = $data->status;
$item->timelimit = $data->timelimit;

if ($item->updateTask()) {
  echo json_encode(201);
} else {
  echo json_encode(400);
}
