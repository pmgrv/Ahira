<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('../dbconfig.php');
// $DB = new Database();

$rowData = json_decode($_POST['DATA']);
if(empty($rowData)){
$rowData = json_decode($HTTP_RAW_POST_DATA);
}

$nextPatientToken = $rowData->nextPatientToken;
$nextPatientID = $rowData->nextPatientID;
$doctorID = $rowData->doctorID;
if(!empty($nextPatientID) & !empty($doctorID)& !empty($nextPatientToken))
{
$queryToGetNextPatient = "SELECT * FROM `patienthospital` WHERE 
doctor_ID='".$doctorID."' 
and (book_flag=1 OR book_flag=3)
and patient_ID='".$nextPatientID."' 
and token_no='".$nextPatientToken."' 
";
// print_r($queryToGetNextPatient);
	$result = $mysqli->query($queryToGetNextPatient);

//printf("Select returned %d rows.\n", $result->num_rows);
	if($result->num_rows>0){
		$result = $mysqli->query($queryToGetNextPatient);
			$statusupdateNow = "UPDATE `patienthospital`
			SET `book_flag` = '4',
			reason='To be Paid' 
			WHERE 
			doctor_ID='".$doctorID."' 
			and (book_flag=1 OR book_flag=3)
			and patient_ID='".$nextPatientID."' 
			and token_no='".$nextPatientToken."' 
			";
		$mysqli->query($statusupdateNow);
		echo deliver_response("success","Subscribed Successfully","{$statusupdateNow}");
	}
	else
	{
		echo deliver_response("failure","Searched result not found.","{$nextPatientID}");
	}
}
function deliver_response($status,$status_msg,$data){
//	header("HTTP/1.1 $status %status_message");
	$response['status'] = $status;
	$response['massage'] = $status_msg;
	$response['data'] = $data;
	
$json_response=json_encode($response);
return  $json_response;
}


?>