<?php

function createSession($id, $unique_key) {

	$conn = connectDb();

	$session = md5(uniqid($unique_key, true));

	$sql = "UPDATE login_book SET session_key='".$session."', last_login=CURRENT_TIMESTAMP WHERE id='".$id."'";

	setcookie('session_key', '', time()-3600, '/');
	setcookie('userid', '', time()-3600, '/');

	if ($conn->query($sql) === TRUE) {
		closeDB($conn);
	    return $session;
	}
}

function checkSession($id, $session_key) {
	$conn = connectDb();

	$sql = "SELECT * FROM login_book where id = '".$id."'";
	$result = $conn->query($sql);
	$rows = array();

	while($r = $result->fetch_assoc()) {
	  $rows[] = $r;
	}

	closeDB($conn);

	if (sizeof($rows)>0) {
		if ($rows[0]["session_key"] == $session_key) {
			return TRUE;
		} else {
			setcookie('session_key', '', time()-3600, '/');
			setcookie('userid', '', time()-3600, '/');
			return FALSE;
		}
	} else {
		return FALSE;
	}
	
}

function loginAgain() {

	if(isset($_COOKIE['session_key']) && isset($_COOKIE['userid'])) {
    	$userid = $_COOKIE['userid'];
    	$conn = connectDb();

		$sql = "UPDATE login_book SET session_key= NULL WHERE id='".$userid."'";

		$conn->query($sql);
		closeDB($conn);
	}

	setcookie('session_key', '', time()-3600, '/');
	setcookie('userid', '', time()-3600, '/');

	echo "<script>";
	echo "window.location.replace('/login.php');";
	echo "</script>";
}

function loginUsername($id, $pass) {
	$conn = connectDb();

	$username = $id;
	$password = $pass;

	$response = array('status'=>'', 'message'=>'');

	$sql = "SELECT A.* from login_table A, emp_details B where A.id='".$username."' and B.status='Y' and A.id=B.ID";
	$result = $conn->query($sql);

	$rows = array();

	while($r = $result->fetch_assoc()) {
	  $rows[] = $r;
	}

	if (sizeof($rows)>0) {
		if ($username == $rows[0]["id"] && $password == $rows[0]["password"]) {
			$session = createSession($username, $rows[0]["unique_key"]);
      
      setcookie('session_key', '', time()-3600, '/');
			setcookie('userid', '', time()-3600, '/');

			setcookie("session_key", $session, 0, '/');
			setcookie("userid", $username, 0, '/');

			$response['status'] = '11';
			$response['message'] = "index.php";
		} else {
			$response['status'] = '01';
			$response['message'] = "Invalid password";
		}
	} else {
		$response['status'] = '10';
		$response['message'] = "Username does not exist or is inactive";
	}
	$response = json_encode($response);

	closeDB($conn);
	echo $response;
}

function checkEmail($email) {
	$conn = connectDb();
	$response = FALSE;

	$sql = "SELECT A.*, B.unique_key FROM emp_details A, login_table B WHERE A.ID = B.id AND A.officialid = '".$email."';";
	$result = $conn->query($sql);

	$rows = array();
	while($r = $result->fetch_assoc()) {
	  $rows[] = $r;
	}

	if (sizeof($rows)>0) {
		if ($email == $rows[0]["officialid"]) {
			$session = createSession($rows[0]["ID"], $rows[0]["unique_key"]);
      
      setcookie('session_key', '', time()-3600, '/');
			setcookie('userid', '', time()-3600, '/');

			setcookie("session_key", $session, 0, '/');
			setcookie("userid", $rows[0]["ID"], 0, '/');

			$response = TRUE;
		}
	} 

	closeDB($conn);
	return $response;
}
?>