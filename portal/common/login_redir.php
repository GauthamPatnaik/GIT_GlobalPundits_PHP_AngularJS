<?php
include("../common/db.lib.php");
include("../common/session.php");

require_once '../google-api-php-client/vendor/autoload.php';

$post_data = json_decode(file_get_contents("php://input"), true);

if (isset($post_data['type'])) {
	$type = $post_data['type'];	
	$username = $post_data['id'];
	$password = $post_data['password'];
}
if (isset($_POST['type'])) {
	$type = $_POST['type'];
	$CLIENT_ID = '1067019098654-9v3qri5u07rhjo9c8a6jpea24ecf19vk.apps.googleusercontent.com';
	$id_token = $_POST['id_token'];
}

if ($type == 'GP') {
	echo loginUsername($username, $password);
}
if ($type == 'Google') {
	$client = new Google_Client(['client_id' => $CLIENT_ID]);
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
	  if (isset($payload['hd']) && ($payload['hd'] == "globalpundits.com")) {
	  	if (checkEmail($payload['email'])) {
	  		echo "index.php";
	  	} else {
	  		echo "Error";
	  	}
	  } else {
	  	echo "Use your GP email account to login via Google sign in or use GP Portal credentials below to continue";	
	  }
	  
	} else {
	  // Invalid ID token
	  echo "Error signing in using Google, use GP Portal credentials to continue";
	}
}
?>