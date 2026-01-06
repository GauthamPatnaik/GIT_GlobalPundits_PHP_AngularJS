<?php
header('Access-Control-Allow-Origin: *');  
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;

$db = medoo('lobalpun_careers');

$orderBy = [
  "ORDER" => [
    "dateAdded" => 'DESC',
  ]
];

$orderBy = [
  "ORDER" => "dateAdded"
];

// $data = $db->select('open_jobs', '*',$orberBy);
$data = $db->query("SELECT * FROM open_jobs ORDER BY dateAdded DESC")->fetchAll();

$data = json_encode($data);
echo($data);
?>
