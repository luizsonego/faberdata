<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET,OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../../config/database.php';
include_once '../../class/task.php';

$database = new Database();
$db = $database->getConnection();

$items = new Task($db);

$stmt = $items->getTasks();
$itemCount = $stmt->rowCount();


// echo json_encode($itemCount);

if ($itemCount > 0) {

  $taskArr = array();
  $taskArr["data"] = array();
  $taskArr["itemCount"] = $itemCount;

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $e = array(
      "id" => $id,
      "title" => $title,
      "description" => $description,
      "status" => $status,
      "timelimit" => $timelimit,
      "created_at" => $created_at
    );

    array_push($taskArr["data"], $e);
  }
  echo json_encode($taskArr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "No record found.")
  );
}
