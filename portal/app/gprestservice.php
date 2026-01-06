<?php
header('Access-Control-Allow-Origin: *');  
include("../common/db.lib.php");

// $method = $_SERVER['REQUEST_METHOD']
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

use Medoo\Medoo;
$db = medoo('lobalpun_portal');

$entity = $request['entity'];
$columns = $request['columns'];

if (isset($request['where'])) {
  $where = $request['where'];
  
  $data = $db->select($entity, $columns, $where);
} else {
  $data = $db->select($entity, $columns);  
}

$err = $db->error();
if ($err[1]!=null) {
  http_response_code(400);
  echo json_encode($err);
  die();
}

echo json_encode($data);

?>