<?php
include("common/db.lib.php");
include("common/mail.lib.php");
require('vendor/autoload.php');

use Medoo\Medoo;

$db = medoo('lobalpun_portal');

$id = "GP1037";
$emp_data = [
  "ID" => $id,
  "firstname" => "Arun Kumar",
  "lastname" => "Kota",
  "officialid" => "arun@globalpundits.com",
  "designation" => "Executive",
  "role" => "Sr Recruiter",
  "joblevel" => "3A",
  "location" => "HYD",
  "country" => "INDIA",
  "doj" => "2019-09-09",
  "contact" => "9866799435",
  "emecontact" => "9985218487",
  "bloodgroup" => "B+",
  "status" => "Y"
];

$data = $db->insert("emp_details", $emp_data);

$login_table = [
  "id" => $id,
  "password" => "Welcome@123",
  "unique_key" => md5(uniqid($id, true))
];

$data1 = $db->insert("login_table", $login_table);

$login_book = [
  "id" => $id,
  "first_login" => "y"
];

$data2 = $db->insert("login_book", $login_book);

echo "<pre>";
print_r($data);
print_r($data1);
print_r($data2);
echo "</pre>";

?>