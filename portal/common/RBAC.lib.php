<?php

function getRole($id) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT role FROM emp_details where id = ?;");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	return($data['role']); 
	closeDB($conn); 
}

function userRole($id) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT role_id FROM user_role where user_id = ?;");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if (!empty($data)) {
		return($data['role_id']); 
	} else {
		return(false);
	}
	closeDB($conn); 
}

function hasRole($id, $role_id) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT role_id FROM user_role where user_id = ? and role_id IN (?, '2004');");
	$stmt->bind_param("ss", $id, $role_id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if (!empty($data)) {
    closeDB($conn); 
		return(true);
	} else {
    closeDB($conn); 
		return(false);
	}
}

function hasAttRole($id) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT role_id FROM user_role where user_id = ? and role_id IN (2001, 2002, 2003, 2004);");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if (!empty($data)) {
		return($data['role_id']); 
	} else {
		return(false);
	}
	closeDB($conn); 
}

function hasOnboardingRole($id) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT role_id FROM user_role where user_id = ? and role_id IN (2004, 2005);");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if (!empty($data)) {
		return($data['role_id']); 
	} else {
		return(false);
	}
	closeDB($conn); 
}

function hasRTRRole($id) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT id FROM login_table where id = ?;");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if (!empty($data)) {
		return($data['id']); 
	} else {
		return(false);
	}
	closeDB($conn); 
}

?>