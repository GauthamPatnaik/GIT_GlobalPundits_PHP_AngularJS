<?php
include("../common/db.lib.php");
include("../common/session.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)) {
$conn = connectDb();
$stmt = $conn->prepare("SELECT A.ID, firstname, lastname, designation, role, B.first_login FROM emp_details A, login_book B WHERE A.ID = B.ID and A.ID = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
// if ($result->num_rows > 0) {
// 	$row = $result->fetch_assoc();
// }
$row = json_encode($row);
echo($row); 
}
?>