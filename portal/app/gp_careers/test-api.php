<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

$post_data = json_decode(file_get_contents("php://input"), true);

if(empty($post_data)){

    echo json_encode("Found Empty Data");
}

else{
    echo json_encode($post_data);
}

?>

