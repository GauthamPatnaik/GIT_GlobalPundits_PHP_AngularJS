<?php
require(__DIR__.'/../vendor/autoload.php');

use Medoo\Medoo;
//Production DB

// $DBHOST = '162.241.182.158';
// $DBUSER = 'lobalpun_gp';
// $DBPWD = 'Gpundits5$';
// $DBNAME = 'lobalpun_portal';




//Dev DB
$DBHOST = '204.93.216.11';
$DBUSER = 'karBan1_gp_u';
$DBPWD = 'One@12359';
$DBNAME = 'karBan1_portal';
 
function connectDb() {

    // connect and set the
    // working db
    if (mysqli_connect( $GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'])) {
    	$con = new mysqli($GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'], $GLOBALS['DBNAME']);

    	return $con;
    }
}

function connectDbCron() {
  $con = new mysqli('205.178.146.173', $GLOBALS['DBUSER'], $GLOBALS['DBPWD'], $GLOBALS['DBNAME']);

  //  $con = new mysqli($GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'], $GLOBALS['DBNAME']);

   if($con->connect_error) 
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

   return $con;
}

function connectMutliDb() {

    // connect and set the
    // working db
    if (mysqli_connect( $GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'])) {
    	$con = new mysqli($GLOBALS['DBHOST'], $GLOBALS['DBUSER'], $GLOBALS['DBPWD'], $GLOBALS['DBNAME'], 65536);

    	return $con;
    }
}

function closeDB($con) {
	$con->close();
}

function medoo($db) {

  // $database = new Medoo([
  //   'database_type' => 'mysql',
  //   'database_name' => $db,
  //   'server' => '162.241.182.158',
  //   'username' => 'lobalpun_gp',
  //   'password' => 'Gpundits5$',
  // ]);
  

  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => $db,
    'server' => '204.93.216.11',
    'username' => 'karBan1_gp_u',
    'password' => 'One@12359',
  ]);
  
  return $database;
}

?>
