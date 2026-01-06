<?php
include("../../common/bullhorn.lib.php");
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;

$authCode = getAuthCode();

$auth = doBullhornAuth($authCode);
$tokens = json_decode($auth);

$session = doBullhornLogin($tokens->access_token);
$session = json_decode($session,true);

$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];

  $flag = medoo('lobalpun_careers');
  $data = $flag->query("SELECT * FROM job_submissions")->fetchAll();

$res = parseResume($rest_token, $rest_url, $data[2]['resumeData'], $data[2]['resumeExtension'], $data[2]['resumeFileType']);

echo"<pre>";
print_r($res);
echo"</pre>";
?>
