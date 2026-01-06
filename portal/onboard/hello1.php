<?php
include(__DIR__."/../common/bullhorn.lib.php");

$session = getBullhornAccess();
$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];

$result = getCandidateByID($rest_token, $rest_url, '192276');

echo"<pre>";
print_r(json_decode($result, true));
echo"</pre>";

?>
