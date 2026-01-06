<?php
include("../../common/bullhorn.lib.php");
include("../../common/testdb.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;


$session = getBullhornAccess();

$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];

$LastRecord=0;
$Count=0;

$db = medoo('karBan1_portal');

$conn=mysqli_connect("204.93.216.11","karBan1_gp_u","One@12359","karBan1_portal");
$sqlcount="SELECT * FROM schedule_jobs_tbl Where Id=1";
$resultcount=mysqli_query($conn,$sqlcount);       

  if (mysqli_num_rows($resultcount)>0) 
    {
  while($row=mysqli_fetch_assoc($resultcount))
         {
           $LastRecord=$row['Last_Start_From'];
           $Count=$row['Count']; 
           $StartValue= $LastRecord + 1; 
           $VerifyTotal=  $LastRecord + $Count;                                  
             
          }  
        }

    
$curl5 = curl_init();
curl_setopt_array($curl5, array(
    CURLOPT_RETURNTRANSFER => 1,
	  CURLOPT_URL => $rest_url."search/Candidate?query=isDeleted:0&fields=*&count=".$Count."&start=".$StartValue,

  ));

curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$rest_token.''));
curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);

$resp3 = curl_exec($curl5);
$resp3 = json_decode($resp3,true);

$err = curl_error($curl5);
curl_close($curl5);

if ($err) {
  print_r($err);
  die();
}
else {

    for ($i=0;$i<$resp3['count'];$i++) {
          
        if($resp3['data'][$i]['dateAvailable']==null || empty($resp3['data'][$i]['dateAvailable']))
        {
            $dateAvailable=null;
        }
        else{
            $dateAvailable=gmdate('Y-m-d H:i:s', $resp3['data'][$i]['dateAvailable']/1000);
        }

        if($resp3['data'][$i]['dateAvailable']==null || empty($resp3['data'][$i]['dateAvailableEnd']))
        {
            $dateAvailableEnd=null;
        }
        else{
            $dateAvailableEnd=gmdate('Y-m-d H:i:s', $resp3['data'][$i]['dateAvailableEnd']/1000);
        }

        if($resp3['data'][$i]['id']!=null)
        {       

            $data = array(
                'Bhid' => $resp3['data'][$i]['id'],
                'FirstName' => $resp3['data'][$i]['firstName'],
                'LastName' => $resp3['data'][$i]['lastName'],
                'Gender' => $resp3['data'][$i]['gender'],
                'Ethnicity' => $resp3['data'][$i]['ethnicity'],
                'Veteran' => $resp3['data'][$i]['veteran'],
                'Disability'=>$resp3['data'][$i]['disability'],
                'EEO'=>'',
                'Job_Category'=>'',
                'Current_Postion'=>$resp3['data'][$i]['occupation'],
                'Current_Location'=>$resp3['data'][$i]['address']['city'],
                'EmployeeType'=>'',
                'Date_Hired' => $dateAvailable,
                'Date_Term' => $dateAvailableEnd,             
              );
              $db = medoo('karBan1_portal');
              $db->insert('candidateinfo_tbl', $data);
        }

        if($resp3['total'] < $VerifyTotal){        
     
                 $LastInsertvalue= $resp3['total'];    
        }  
        else{
            $LastInsertvalue= $VerifyTotal;
        } 
              $newcount = $conn->query("Update schedule_jobs_tbl SET Last_Start_From = ".$LastInsertvalue.",Last_RunTime=now() Where Id=1");

        }
    }
     

?>
