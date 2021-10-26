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

$waitingTimeSetByDoctor = $rowData->waitingTimeSetByDoctor;
$nextPatientToken = $rowData->nextPatientToken;
$nextPatientID = $rowData->nextPatientID;
$doctorID = $rowData->doctorID;
if(!empty($nextPatientID) & !empty($doctorID)& !empty($nextPatientToken) & !empty($waitingTimeSetByDoctor))
{
$queryToUpdateTime = "SELECT * FROM `patienthospital` WHERE 
doctor_ID='".$doctorID."' 
and book_flag=1 
and token_no>='".$nextPatientToken."' 
";
// print_r($queryToGetNextPatient);
$resultToUpdate = $mysqli->query($queryToUpdateTime);

//printf("Select returned %d rows.\n", $result->num_rows);
	if($resultToUpdate->num_rows>0){
		while($updateTimeFor = $resultToUpdate->fetch_assoc()){
			$allowedTimeUpdate = $updateTimeFor['allowedTime'];
			$token_noUpdate = $updateTimeFor['token_no'];
			$doctor_IDForCondition = $updateTimeFor['doctor_ID'];
			$hospitalIDForCondition = $updateTimeFor['hospitalID'];
			$patient_IDForCondition = $updateTimeFor['patient_ID'];

			$UpdatedToken = $token_noUpdate - 1 ;
			// Current date and time
			$datetime = $allowedTimeUpdate;
			// Convert datetime to Unix timestamp
			$timestampas = strtotime($datetime);
			// Subtract time from datetime second : 60(Second)* 15 = 900second = 15 Minutes : TODOPK211022 
			$timeas = $timestampas + 60*$waitingTimeSetByDoctor;
			// Date and time after subtraction
			$Updateddatetime = date("Y-m-d H:i:s", $timeas);
			$udatePatientsTimeAndToken = "UPDATE `patienthospital` 
						  	SET 	allowedTime  = '".$Updateddatetime."'
							WHERE 	hospitalID='".$hospitalIDForCondition."'
									and patient_ID='".$patient_IDForCondition."' 
									and doctor_ID='".$doctor_IDForCondition."'
									and book_flag=1  
							";
											//book_flag = 1 - Booked, 2-Cancelled Book
			$res = $mysqli->query($udatePatientsTimeAndToken);
		}
		echo deliver_response("success","Updated Successfully","{$queryToUpdateTime}");
	}
	else
	{
		echo deliver_response("failure","Searched result not found.","{$searchdoctor}");
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