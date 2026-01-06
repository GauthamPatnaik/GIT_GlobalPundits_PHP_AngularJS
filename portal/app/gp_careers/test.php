<?php
include("../../common/bullhorn.lib.php");
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;


$session = getBullhornAccess();

echo"<pre>";
print_r($session);
echo"</pre><br><br><br>";

$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];

echo"<pre>";
print_r(addNote($rest_token, $rest_url, 201555, "Testing", "Testing"));
echo"</pre>";
?>
