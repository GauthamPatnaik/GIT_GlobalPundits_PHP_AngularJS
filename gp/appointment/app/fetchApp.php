<?php
header('Access-Control-Allow-Origin: *');  
include(__DIR__."/../../../portal/common/db.lib.php");
require(__DIR__.'/../../../portal/vendor/autoload.php');

use Medoo\Medoo;

$db = medoo('lobalpun_portal');

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['appID'];

$data = $db->query("SELECT * from app_scheduler WHERE id = '".$id."';")->fetchAll();

if ($data[0]['questions']){
    $data[0]['questions'] = unserialize($data[0]['questions']);
}

echo json_encode($data);
?>