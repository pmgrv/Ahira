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

$doctorID = $rowData->doctorID;
$doctorInterest = $rowData->doctorInterest;

if(!empty($doctorID) && !empty($doctorInterest))
{
$queryToFindDoctor = "SELECT * FROM `patienthospital` as ph, `patientarea` as pa WHERE ph.doctor_ID='".$doctorID."' and ph.book_flag=1 and pa.patient_ID=ph.patient_ID ORDER BY token_no DESC";
	$result = $mysqli->query($queryToFindDoctor);

//printf("Select returned %d rows.\n", $result->num_rows);
	if($result->num_rows>0){

	if($doctorInterest=='interested'){
		$result = $mysqli->query($queryToFindDoctor);
			$statusupdateNow = "UPDATE `patienthospital`
			SET `book_flag` = '3',
			reason='Will Check' 
			WHERE 
			doctor_ID='".$doctorID."' 
			and book_flag=1 
			";

	}else{
		$result = $mysqli->query($queryToFindDoctor);
			$statusupdateNow = "UPDATE `patienthospital`
			SET `book_flag` = '2',
			reason='Cancel By Doctor' 
			WHERE 
			doctor_ID='".$doctorID."' 
			and book_flag=1 
			";
	}
		$mysqli->query($statusupdateNow);
		echo deliver_response("success","Allowed Successfully","{$statusupdateNow}");
	}
	else
	{
		echo deliver_response("failure","Already allowed. Can't allowe again to same patients","{$doctorID}");
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