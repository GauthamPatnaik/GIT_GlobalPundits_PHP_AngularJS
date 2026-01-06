<?php
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

$db = medoo('lobalpun_careers');

$client = new Google_Client();

// service_account_file.json is the private key that you created for your service account.
$client->setAuthConfig('My Project-18c8852e08b8.json');
$client->addScope('https://www.googleapis.com/auth/indexing');

// Get a Guzzle HTTP Client
$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

// Define contents here. The structure of the content is described in the next step.

$data = $db->query("SELECT * FROM `open_jobs` WHERE `dateAdded` > '2017-10-30' AND publicDescription IS NOT NULL AND title IS NOT NULL")->fetchAll();

for($i=0;$i<count($data);$i++) {
  $content = [
    "url" => "https://www.globalpundits.com/careers/#/jobs/".$data[$i]['id'],
    "type" => "URL_UPDATED"
  ];
  $content = json_encode($content);

  $response = $httpClient->post($endpoint, [ 'body' => $content ]);
  $status_code = $response->getStatusCode();

  echo"<pre>";
  print_r("id ".$data[$i]['id']." -> ".$status_code);
//   print_r("https://www.globalpundits.com/careers/#/jobs/".$data[$i]['id']);
  echo"</pre>";
}


?>