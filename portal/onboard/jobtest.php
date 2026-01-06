<?php
include(__DIR__."/../common/bullhorn.lib.php");
include(__DIR__."/../common/db.lib.php");
require(__DIR__.'/../vendor/autoload.php');

use Medoo\Medoo;

$authCode = getAuthCode();

$auth = doBullhornAuth($authCode);
$tokens = json_decode($auth);

$session = doBullhornLogin($tokens->access_token);
$session = json_decode($session,true);

$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];

$curl5 = curl_init();
curl_setopt_array($curl5, array(
    CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $rest_url."search/JobOrder?query=isOpen:1&fields=id,address,dateAdded,dateEnd,dateLastPublished,employmentType,payRate,publicDescription,publishedCategory,salary,startDate,title,yearsRequired&count=500&start=0",
));

curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$rest_token.''));
curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);

$resp3 = curl_exec($curl5);
$resp3 = json_decode($resp3,true);

$err = curl_error($curl5);
curl_close($curl5);

if ($err) {
  print_r($err);
  die();
}
else {
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
      'payRate' => $resp3['data'][$i]['payRate'],
      'publicDescription' => $resp3['data'][$i]['publicDescription'],
      'publishedCategory' => $resp3['data'][$i]['publishedCategory']['name'],
      'salary' => $resp3['data'][$i]['salary'],
      'startDate' => gmdate('Y-m-d H:i:s', $resp3['data'][$i]['startDate']/1000),
      'title' => $resp3['data'][$i]['title'],
      'yearsRequired' => $resp3['data'][$i]['yearsRequired'],
    );
    
    $db = medoo('ckqotimy_careers');
    $db->insert('open_jobs', $data);
    
    echo"<pre>";
    print_r($date);
    echo"</pre>";
  }
}


?>
