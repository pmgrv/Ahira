<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('dbconfig.php');
$rowData = json_decode($_POST['DATA']);

if(empty($rowData)){
	$rowData = json_decode($HTTP_RAW_POST_DATA);
}

// var_dump($rowData);
$hospitalidtosend = $rowData->hospitalidtosend;
$queryGetsDoctors = "SELECT * FROM `doctorarea` as da, `doctorhospital` as dh WHERE da.doctor_ID=dh.doctor_ID and dh.hospital_ID='".$hospitalidtosend."'";
// print_r($queryGets);
$result = $mysqli->query($queryGetsDoctors);
while($row = $result->fetch_assoc()){
	$doctor_FirstName = $row['doctor_FirstName'];
	$doctor_LastName = $row['doctor_LastName'];
	$doctorFullName= $doctor_FirstName.' '.$doctor_LastName;
/*if($result->num_rows<=0){
	if(!empty($hospitalName)&&!empty($patientID)&&!empty($allowedTime))
	{
		
		$sqlInsert = "INSERT INTO `patienthospital` SET 
												`hospitalID` = '".$hospitalName."',
												`patient_ID` = '".$patientID."',
												`book_flag` = '1',
												`token_no` = '".$token_no."',
												`allowedTime`   = '".$allowedTime."'";
		// print_r($sqlInsert);
		$res = $mysqli->query($sqlInsert);
		if($res){
			echo deliver_response("success","Registration Successful","{$sqlInsert}");
		}
		else{
			echo deliver_response("failure","Oops! Something went wrong, Please try again later","{$sqlInsert}");
		}
	}
	else
	{
		echo deliver_response("failure","All Fields are mandatory","{$allowedTime}");
	}*/
	
/*}
else{
	echo deliver_response("failure","Patient is already registered with","{$allowedTime}");
}*/
}
echo deliver_response("success","Registration Successful","{$queryGetsDoctors}");

function deliver_response($status,$status_msg,$data){
	//	header("HTTP/1.1 $status %status_message");
		$response['status'] = $status;
		$response['massage'] = $status_msg;
		$response['data'] = $data;
		
	$json_response=json_encode($response);
	return  $json_response;

	}
?>