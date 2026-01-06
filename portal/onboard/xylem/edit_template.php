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
	
	$template = new \PhpOffice\PhpWord\TemplateProcessor('template/Xylem_COC_Acknowledgement.docx');

	$template->setValue('candidate_name', $data['name']);    
	$template->setValue('employer', 'Globalpundits');    
	$template->setValue('current_date', date('M d, Y', time()));   

	$template->saveAs('converted/Xylem_COC_Acknowledgement_'.$candidateID.'.docx'); 

	$template1 = new \PhpOffice\PhpWord\TemplateProcessor('template/ASSIGNMENT ACKNOWLEDGMENT AND CONFIDENTIALITY AGREEMENT.docx');

	$template1->setValue('gp_name', 'Globalpundits');    
	$template1->setValue('gp_location', 'South Carolina');
	$template1->setValue('client_name', 'Xylem Sensus');    
	$template1->setValue('gp_name1', 'Globalpundits');    
	$template1->setValue('gp_location1', 'South Carolina');
	$template1->setValue('candidate_name', $data['name']);
	$template1->setValue('current_date', date('M d, Y', time()));   

	$template1->saveAs('converted/ASSIGNMENT ACKNOWLEDGMENT AND CONFIDENTIALITY AGREEMENT_'.$candidateID.'.docx'); 

	$docx = array('Xylem_COC_Acknowledgement_'.$candidateID.'.docx', 'ASSIGNMENT ACKNOWLEDGMENT AND CONFIDENTIALITY AGREEMENT_'.$candidateID.'.docx');
	$pdf = array('onboarding_checklist.pdf', 'Xylem_CoC.pdf');

	$response = array('docx'=>$docx, 'pdf'=>$pdf);
	$response = json_encode($response);
	echo $response;

}
?>