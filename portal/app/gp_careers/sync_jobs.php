<?php
include("../../common/bullhorn.lib.php");
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;


$session = getBullhornAccess();
$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];
echo"<br> REST Tokan - ".$rest_token;
echo"<br> REST URL - ".$rest_url;

$curl5 = curl_init();
curl_setopt_array($curl5, array(
CURLOPT_RETURNTRANSFER => 1,
//CURLOPT_URL => $rest_url."search/JobOrder?query=isPublic:1%20AND%20isOpen:1&fields=id,address,dateAdded,dateEnd,dateLastPublished,employmentType,payRate,publicDescription,description,publishedCategory,customText5,salary,startDate,title,yearsRequired&count=500&start=0",
 CURLOPT_URL => $rest_url."search/JobOrder?query=isOpen:1%20AND%20isPublic:1%20AND%20isDeleted:0%20NOT%20status:Archive&fields=id,address,dateAdded,dateEnd,dateLastPublished,employmentType,payRate,publicDescription,description,publishedCategory,customText5,salary,startDate,title,yearsRequired&count=500&start=0",
));


curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$rest_token.''));
curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);

$resp3 = curl_exec($curl5);
echo"<br> REST - ".$rest_token;
print_r($resp3);
$resp3 = json_decode($resp3,true);
$err = curl_error($curl5);
curl_close($curl5);

if ($err) {
  print_r($err);
  die();
}
else {

  $trunc = medoo('lobalpun_careers');
  $trunc->query("TRUNCATE TABLE last_open_jobs");
  $trunc->query("INSERT INTO last_open_jobs (SELECT id, title from open_jobs)");
  $trunc->query("TRUNCATE TABLE open_jobs");
  
  for ($i=0;$i<$resp3['count'];$i++) {
    $date = gmdate("Y-m-d H:i:s", $resp3['data'][$i]['dateAdded']/1000);
        $data = array(
      'id' => $resp3['data'][$i]['id'],
      'address1' => $resp3['data'][$i]['address']['address1'],
      'city' => $resp3['data'][$i]['address']['city'],
      'state' => $resp3['data'][$i]['address']['state'],
      'countryID' => $resp3['data'][$i]['address']['countryID'],
      'zip' => $resp3['data'][$i]['address']['zip'],
      'dateAdded' => gmdate('Y-m-d H:i:s', $resp3['data'][$i]['dateAdded']/1000),
      'dateEnd' => gmdate('Y-m-d H:i:s', $resp3['data'][$i]['dateEnd']/1000),
      'dateLastPublished' => gmdate('Y-m-d H:i:s', $resp3['data'][$i]['dateLastPublished']/1000),
      'employmentType' => $resp3['data'][$i]['employmentType'],
//       'payRate' => $resp3['data'][$i]['payRate'],
      'payrate' => '',
      'publicDescription' => $resp3['data'][$i]['publicDescription'],
      'description' => '',
      'publishedCategory' => $resp3['data'][$i]['publishedCategory']['name'],
      'jobCategory' => $resp3['data'][$i]['customText5'][0],
//       'salary' => $resp3['data'][$i]['salary'],
      'salary' => '',
      'startDate' => gmdate('Y-m-d H:i:s', $resp3['data'][$i]['startDate']/1000),
      'title' => $resp3['data'][$i]['title'],
      'yearsRequired' => $resp3['data'][$i]['yearsRequired'],
    );
    
    $db = medoo('lobalpun_careers');
    $db->insert('open_jobs', $data);
    
//     echo"<pre>";
//     print_r($date);
//     echo"</pre>";
    
  }
  $flag = medoo('lobalpun_careers');
  $flag->query("UPDATE cron_flag SET count = ".$resp3['count'].",lastRun = CURRENT_TIMESTAMP WHERE id = 100");
  
  echo("<pre>");
  print_r($flag->error());
  echo"<br> Count - ".$resp3['count'];
  echo"<br> REST - ".$rest_token;
  echo("</pre>");
}


// Google indexing API calls

$client = new Google_Client();

$client->setAuthConfig('My Project-18c8852e08b8.json');
$client->addScope('https://www.googleapis.com/auth/indexing');

$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

$data = $db->query("SELECT title FROM open_jobs WHERE publicDescription IS NOT NULL AND dateLastPublished > '".date('Y-m-d H:i:s', strtotime("-5 mins"))."';")->fetchAll();

if(count($data)==0) {
  echo "<br> No jobs to update";
}
for($i=0;$i<count($data);$i++) {
  $content = [
    "url" => "https://www.globalpundits.com/careers/#/jobs/".$data[$i]['id'],
    "type" => "URL_UPDATED"
  ];
  $content = json_encode($content);

  $response = $httpClient->post($endpoint, [ 'body' => $content ]);
  $status_code = $response->getStatusCode();

  echo"<pre>";
  print_r("id ".$data[$i]['id']." updated -> ".$status_code);
//   print_r("https://www.globalpundits.com/careers/#/jobs/".$data[$i]['id']);
  echo"</pre>";
}

// URLs to be deleted
$data1 = $db->query("SELECT id from last_open_jobs WHERE id NOT IN (SELECT id FROM open_jobs)")->fetchAll();

if(count($data1)==0) {
  echo "<br> No jobs to delete";
}
for($i=0;$i<count($data1);$i++) {
  $content = [
    "url" => "https://www.globalpundits.com/careers/#/jobs/".$data1[$i]['id'],
    "type" => "URL_DELETED"
  ];
  $content = json_encode($content);

  $response = $httpClient->post($endpoint, [ 'body' => $content ]);
  $status_code = $response->getStatusCode();

  echo"<pre>";
  print_r("id ".$data[$i]['id']." deleted -> ".$status_code);
//   print_r("https://www.globalpundits.com/careers/#/jobs/".$data[$i]['id']);
  echo"</pre>";
}
?>
