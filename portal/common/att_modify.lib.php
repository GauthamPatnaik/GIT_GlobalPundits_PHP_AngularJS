<?php

function getAttModRecordByRole($role) {
	$conn = connectDb();
	$roleType = '';

	if ($role == 2001) {
		$stmt = $conn->prepare('SELECT A.req_id, C.firstname, C.lastname, A.type, A.emp_id, A.date_in, B.att_in "og_att_in", A.att_in, B.date_out "og_date_out", A.date_out, B.att_out "og_att_out", A.att_out, A.status, A.role from att_modify_request A, att_record B, emp_details C where A.emp_id = C.ID and A.emp_id = B.ID and A.date_in = B.date_in and A.role = ? and A.status NOT IN ("Rejected", "Approved") ORDER BY A.req_id DESC;');
		$roleType = 'Recruiter';
		$stmt->bind_param("s", $roleType);
	} else if ($role == 2002) {
		$stmt = $conn->prepare('SELECT A.req_id, C.firstname, C.lastname, A.type, A.emp_id, A.date_in, B.att_in "og_att_in", A.att_in, B.date_out "og_date_out", A.date_out, B.att_out "og_att_out", A.att_out, A.status, A.role from att_modify_request A, att_record B, emp_details C where A.emp_id = C.ID and A.emp_id = B.ID and A.date_in = B.date_in and A.role = ? and A.status NOT IN ("Rejected", "Approved") ORDER BY A.req_id DESC;');
		$roleType = 'Sourcer';
		$stmt->bind_param("s", $roleType);
	} else {
		$stmt = $conn->prepare('SELECT A.req_id, C.firstname, C.lastname, A.type, A.emp_id, A.date_in, B.att_in "og_att_in", A.att_in, B.date_out "og_date_out", A.date_out, B.att_out "og_att_out", A.att_out, A.status, A.role from att_modify_request A, att_record B, emp_details C where A.emp_id = C.ID and A.emp_id = B.ID and A.date_in = B.date_in and A.status NOT IN ("Rejected", "Approved") ORDER BY A.req_id DESC;');
	}
	

	$stmt->execute();
	$result = $stmt->get_result();
	
	$statistic = [];
	while ($data = $result->fetch_assoc()) {
	    $statistic[] = $data;
	}

	$row = json_encode($statistic, JSON_PRETTY_PRINT);
	closeDB($conn);
	return $row;
}

function getAttModRecordByID($id) {
	$conn = connectDb();

	$stmt = $conn->prepare('SELECT A.req_id, A.type, A.emp_id, A.date_in, B.att_in "og_att_in", A.att_in, B.date_out "og_date_out", A.date_out, B.att_out "og_att_out", A.att_out, A.status, A.role, A.remark from att_modify_request A, att_record B where A.emp_id = B.ID and A.date_in = B.date_in and A.emp_id = ? ORDER BY A.req_id DESC;');
	$stmt->bind_param("s", $id);

	$stmt->execute();
	$result = $stmt->get_result();
	
	$statistic = [];
	while ($data = $result->fetch_assoc()) {
	    $statistic[] = $data;
	}

	$row = json_encode($statistic, JSON_PRETTY_PRINT);
	closeDB($conn);
	return $row;
}

function acceptAttModRequest($req_id, $remark) {
	$conn = connectDb();

	$stmt1 = $conn->prepare('SELECT * from att_modify_request where req_id = ?');
	$stmt1->bind_param("s", $req_id);
	$stmt1->execute();
	$result1 = $stmt1->get_result();

	$data1 = $result1->fetch_assoc();

	if ($data1['type'] == 'in') {
		$stmt2 = $conn->query('UPDATE att_record SET att_in = "'.$data1['att_in'].'", status = "Present" WHERE ID = "'.$data1['emp_id'].'" AND date_in = "'.$data1['date_in'].'";');
		// $stmt2->bind_param("sss", $data1['att_in'], $data1['emp_id'], $date1['date_in']);
	} else if ($data1['type'] == 'out') {
		$stmt2 = $conn->query('UPDATE att_record SET date_out = "'.$data1['date_out'].'", att_out = "'.$data1['att_out'].'", status = "Present" WHERE ID = "'.$data1['emp_id'].'" AND date_in = "'.$data1['date_in'].'";');
		// $stmt2->bind_param("ssss", $data1['date_out'], $data1['att_out'], $data1['emp_id'], $date1['date_in']);
	} else {
		$stmt2 = $conn->query('UPDATE att_record SET att_in = "'.$data1['att_in'].'", date_out = "'.$data1['date_out'].'", att_out = "'.$data1['att_out'].'", status = "Present" WHERE ID = "'.$data1['emp_id'].'" AND date_in = "'.$data1['date_in'].'";');
		// $stmt2->bind_param("sssss", $data1['att_in'], $data1['date_out'], $data1['att_out'], $data1['emp_id'], $date1['date_in']);
	}
	
	// $stmt2->execute();
	if ($stmt2) {
		$stmt3 = $conn->query('UPDATE att_modify_request SET status = "Approved", remark = "'.$remark.'" WHERE req_id = "'.$req_id.'";');
	}

	$row = json_encode($stmt2, JSON_PRETTY_PRINT);
	closeDB($conn);
	return $row;
}

function rejectAttModRequest($req_id, $remark) {
	$conn = connectDb();

	// $stmt2->execute();
	$stmt3 = $conn->query('UPDATE att_modify_request SET status = "Rejected", remark = "'.$remark.'" WHERE req_id = "'.$req_id.'";');

	$row = json_encode($stmt3, JSON_PRETTY_PRINT);
	closeDB($conn);
	return $row;
}
?>