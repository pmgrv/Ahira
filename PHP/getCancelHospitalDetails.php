<?php 
include('dbconfig.php');
$rowData = json_decode($_POST['DATA']);

if(empty($rowData)){
	$rowData = json_decode($HTTP_RAW_POST_DATA);
}
// var_dump($rowData);
$hospitalidtosend = $rowData->hospitalidtosend;
$patientidtosend = $rowData->patientidtosend;
$totalestimatedtimecancel = $rowData->totalestimatedtimecancel;
$tokennotosendcancel = $rowData->tokennotosendcancel;

$queryGetbookedHospital = "SELECT * FROM `patienthospital` WHERE 
hospitalID='".$hospitalidtosend."' 
and patient_ID='".$patientidtosend."' 
and book_flag='1'
and allowedTime='".$totalestimatedtimecancel."'
";
// print_r($queryGetbookedHospital);
$result = $mysqli->query($queryGetbookedHospital);
// print_r($result->num_rows);
if($result->num_rows>0){
	$udateBookFlagToCancel = "UPDATE `patienthospital` 
							  	SET 	book_flag  = '0',
										reason     = 'Cancelled booking'
								WHERE 	hospitalID='".$hospitalidtosend."'
										and patient_ID='".$patientidtosend."' 
										and book_flag='1'	
								";
	//book_flag = 1 - Booked, 0-Cancelled Book
	$res = $mysqli->query($udateBookFlagToCancel);
	if($result->num_rows>0){
		// SELECT * FROM `patienthospital` WHERe hospitalID=1 and book_flag=1 and token_no > 2
		$queryGetPatientListToUpdateTime = "SELECT * FROM `patienthospital` 
									WHERE hospitalID='".$hospitalidtosend."'
									 and book_flag='1' 
									 and token_no > '".$tokennotosendcancel."'";
		$resultToUpdate = $mysqli->query($queryGetPatientListToUpdateTime);
		$numberOfPatientTobeupdated = $resultToUpdate->num_rows;
		// print_r($resultToUpdate->num_rows);
		if($resultToUpdate->num_rows>0){
			while($rowPatientToUpdate = $resultToUpdate->fetch_assoc()){
				$allowedTimeUpdate = $rowPatientToUpdate['allowedTime'];
				$token_noUpdate = $rowPatientToUpdate['token_no'];
				$doctor_IDForCondition = $rowPatientToUpdate['doctor_ID'];
				$hospitalIDForCondition = $rowPatientToUpdate['hospitalID'];
				$patient_IDForCondition = $rowPatientToUpdate['patient_ID'];

				$UpdatedToken = $token_noUpdate - 1 ;
				// Current date and time
				$datetime = $allowedTimeUpdate;
				// Convert datetime to Unix timestamp
				$timestampas = strtotime($datetime);
				// Subtract time from datetime second : 60(Second)* 15 = 900second = 15 Minutes : TODOPK211022 
				$timeas = $timestampas - 900;
				// Date and time after subtraction
				$Updateddatetime = date("Y-m-d H:i:s", $timeas);
				$udatePatientsTimeAndToken = "UPDATE `patienthospital` 
							  	SET 	allowedTime  = '".$Updateddatetime."',
							  	 		token_no = '".$UpdatedToken."'
								WHERE 	hospitalID='".$hospitalIDForCondition."'
										and patient_ID='".$patient_IDForCondition."' 
										and doctor_ID='".$doctor_IDForCondition."' 
								";
												//book_flag = 1 - Booked, 0-Cancelled Book
				$res = $mysqli->query($udatePatientsTimeAndToken);
			}
			echo deliver_response("success","Registration Successful","{$udatePatientsTimeAndToken}");
		}
	// echo deliver_response("success","Count of rows","{$queryGetPatientListToUpdateTime}");
	}
}
else{
	echo deliver_response("failure","Oops! Something went wrong, Please try again later","{$queryGetbookedHospital}");
}
//END While

function deliver_response($status,$status_msg,$data){
	//	header("HTTP/1.1 $status %status_message");
		$response['status'] = $status;
		$response['massage'] = $status_msg;
		$response['data'] = $data;
		
	$json_response=json_encode($response);
	return  $json_response;

	}
?>