<?php
$DBHOST = 'localhost';
$DBUSER = 'lobalpun_gp';
$DBPWD = 'Gpundits5$';
$DBNAME = 'lobalpun_portal';

function connectDb() {
    if (mysqli_connect( $GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'])) {
    	$con = new mysqli($GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'], $GLOBALS['DBNAME']);

    	return $con;
    } else {
        return false;
    }
}

function closeDB($con) {
	$con->close();
}

function insertReferral($post_data) {

    $r_name = $post_data['r_name'];
    $r_mail = $post_data['r_mail'];
    $r_phn = $post_data['r_phn'];

    $c_name = $post_data['c_name'];
    $c_mail = $post_data['c_mail'];
    $c_phn = $post_data['c_phn'];

    $fb="";
    $li="";

    if ($conn = connectDb()) {
        
        $stmt = $conn->prepare("INSERT INTO referrals (r_name, r_mail, r_phn, c_name, c_mail, c_phn, fb, li, date, last_upd, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), CURRENT_TIMESTAMP, 'new')");
        $stmt->bind_param("ssssssss", $r_name, $r_mail, $r_phn, $c_name, $c_mail, $c_phn, $fb, $li);
        $stmt->execute();
        
        $res = array(
            'message' => '',
            'status' => '',
        );  
      
        if ($stmt->affected_rows == 1) {
            $res['status'] = true;
            $res['message'] = 'Thank you for your referral! We will send the tracking details via e-mail shortly';
            
            closeDB($conn); 
            return $res;
        } else {
            $res['status'] = false;
            $res['message'] = "You've already referred this candidate to us, thank you!";
            
            closeDB($conn); 
            return $res;
        }
    } else {
        $res['status'] = false;
        $res['message'] = "Oops! Something has gone wrong, please try again later";
            
        return $res;
    }
}

function checkTrackID($bhid) {

    if ($conn = connectDb()) {
        $res = array(
            'message' => '',
            'status' => ''
        );
        $stmt = $conn->prepare("SELECT * FROM referrals WHERE bh_id = ?");
        $stmt->bind_param("s", $bhid);
        $stmt->execute();

        $result = $stmt->get_result();

        $data = false;
        if ($result) {
            $data = $result->fetch_assoc();
            $data = $data['bh_id'];
        }

        closeDB($conn); 
        if ($data) {
            $res['status'] = true;
            $res['message'] = 'ID found';

            return $res;
        } else {
            $res['status'] = false;
            $res['message'] = 'ID not found';

            return $res;
        }
    } else {
        $res['status'] = false;
        $res['message'] = "Oops! Something has gone wrong, please try again later";
            
        return $res;
    }
}
?>