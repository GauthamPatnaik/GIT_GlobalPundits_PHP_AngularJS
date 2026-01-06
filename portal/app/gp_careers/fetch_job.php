<?php
header('Access-Control-Allow-Origin: *');  
// header('Access-Control-Allow-Origin: http://globalpundits.com');  
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;

$post_data = json_decode(file_get_contents("php://input"), true);

$db = medoo('lobalpun_careers');

$id = [
  'id' => $post_data['id']
];

$data = $db->select('open_jobs', '*', $id);

if ($data[0]['publishedCategory']=='' || $data[0]['publishedCategory']==null || !$data[0]['publishedCategory']) {
  $data[0]['publishedCategory'] = 'Other Area(s)';
}

$data1 = $db->query("SELECT id,title,city,state FROM open_jobs where publishedCategory = '".$data[0]['publishedCategory']."' AND id <> ".$data[0]['id']." ORDER BY dateAdded DESC LIMIT 5")->fetchAll();

$resp = [
  'job' => $data,
  'category' => $data[0]['publishedCategory'],
  'similar' => $data1,
];

$resp = json_encode($resp, true);
echo($resp);
?>
