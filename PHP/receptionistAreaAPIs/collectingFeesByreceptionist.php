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

$getAmount = $rowData->getAmount;
$PatientIDSend = $rowData->PatientIDSend;
$doctorID = $rowData->doctorIDSend;
$PatientToken = $rowData->PatientToken;
$receptionistIDChangedStatus = $rowData->receptionistID;

if(!empty($getAmount) & !empty($PatientIDSend)& !empty($doctorID)& !empty($PatientToken)& !empty($receptionistIDChangedStatus))
{
$queryToGetPatientToBePaid = "SELECT * FROM `patienthospital` WHERE 
doctor_ID='".$doctorID."' 
and book_flag='4' 
and patient_ID='".$PatientIDSend."' 
and token_no='".$PatientToken."' 
";
print_r($queryToGetPatientToBePaid);
	$result = $mysqli->query($queryToGetPatientToBePaid);

//printf("Select returned %d rows.\n", $result->num_rows);
	if($result->num_rows>0){
		$result = $mysqli->query($queryToGetPatientToBePaid);
			$statusupdateNow = "UPDATE `patienthospital`
			SET `book_flag` = '5',
			receptionist_ID='".$receptionistIDChangedStatus."',
			checkupfees='".$getAmount."',
			reason='Paid'
			WHERE 
			doctor_ID='".$doctorID."' 
			and book_flag=4 
			and patient_ID='".$PatientIDSend."' 
			and token_no='".$PatientToken."' 
			";
		$mysqli->query($statusupdateNow);
		echo deliver_response("success","Subscribed Successfully","{$statusupdateNow}");
	}
	else
	{
		echo deliver_response("failure","Searched result not found.","{$queryToGetPatientToBePaid}");
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