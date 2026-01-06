<?php
include("../common/db.lib.php");
include("../common/session.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)){

$conn = connectDb("test");
$stmt = $conn->prepare("SELECT A.firstname, A.lastname, A.role, B.status FROM emp_details A, att_live B WHERE A.ID = B.ID AND (B.status = 'IN' OR B.status = 'Leave'); ");
// $stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$statistic[] = [];
while ($data = $result->fetch_assoc()) {
    $statistic[] = $data;
}

$row = json_encode($statistic, JSON_PRETTY_PRINT);

echo($row); 
}
else {
	echo "Session failed";
}
?>