<?php
require __DIR__ . '/../vendor/autoload.php';
include("../common/bullhorn.lib.php");

$result = getAuthCode();

// $authCode = getAuthCode();
// $auth = doBullhornAuth($authCode);
// $result = json_decode($auth, true);
// $result = json_decode(bullhornRefreshToken($result['refresh_token']), true);

// $result = doBullhornLogin('31:b4e2eca6-ca6e-441d-b1ee-6943fcc39dbc');

echo"<pre>";
print_r($result);
echo"<br>----------------<br>";
echo"<pre>";
?>