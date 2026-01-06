<?php
include("../common/db.lib.php");
include("../common/session.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)){

$conn = connectDb();
$stmt = $conn->prepare("SELECT * FROM att_live WHERE ID = ?;");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

$row = json_encode($data, JSON_PRETTY_PRINT);

echo($row); 
}
else {
	echo "Session failed";
}
?>