<?php
include(__DIR__."/../../common/db.lib.php");
include(__DIR__."/../../common/session.php");

require_once '../vendor/autoload.php';

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$data = $post_data['c_data'];
$candidateID = $post_data['candidateID'];

if (checkSession($id, $session_key)) {
	
	$template = new \PhpOffice\PhpWord\TemplateProcessor('template/Confidentiality agreement.docx');

	$template->setValue('name', $data['name']);    
	$template->setValue('sub_con_num', 'Globalpundits');    
	$template->setValue('name_1', $data['name']);
	$template->setValue('date', date('M d, Y', time()));   

	$template->saveAs('converted/Confidentiality agreement_'.$candidateID.'.docx'); 

	$template1 = new \PhpOffice\PhpWord\TemplateProcessor('template/SRNS Workforce Substance Abuse Program Acknowledgement.docx');

	$template1->setValue('name', $data['name']);    
	$template1->setValue('date', date('M d, Y', time()));   
	$template1->setValue('footer_date', date('M, Y', time()));   

	$template1->saveAs('converted/SRNS Workforce Substance Abuse Program Acknowledgement_'.$candidateID.'.docx'); 

	$docx = array('Confidentiality agreement_'.$candidateID.'.docx', 'SRNS Workforce Substance Abuse Program Acknowledgement_'.$candidateID.'.docx');
	$pdf = array();

	$response = array('docx'=>$docx, 'pdf'=>$pdf);
	$response = json_encode($response);
	echo $response;

}
?>