<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('dbconfig.php');
// $DB = new Database();
$already_registered_number = '';
$already_registered_name = '';
$rowData = json_decode($_POST['DATA']);

// var_dump($rowData)
if(empty($rowData)){
	$rowData = json_decode($HTTP_RAW_POST_DATA);
}

// var_dump($rowData);
$hospitalid = $rowData->hospitalid;
$patientID = $rowData->patientID;
$allowedTime = $rowData->totalestimatedtime;
$token_no = $rowData->token_no;
$doctor_ID = $rowData->doctor_ID;
// $totalestimatedtime = $rowData->totalestimatedtime;
$queryGets = "SELECT ha.hospitalID, pa.patient_ID FROM `patientarea` as pa, `hospitalarea` as ha 
WHERE pa.patient_ID like ('$patientID') and  ha.hospitalID like ('$hospitalid') ";
// print_r($queryGets);
$result = $mysqli->query($queryGets);
while($row = $result->fetch_assoc()){
	$hospitalID = $row['hospitalID'];
	$patient_ID = $row['patient_ID'];
}
if($result->num_rows>0){
	if(!empty($hospitalid)&&!empty($patientID)&&!empty($allowedTime))
	{
		
		$sqlInsert = "INSERT INTO `patienthospital` SET 
												`hospitalID` = '".$hospitalid."',
												`patient_ID` = '".$patientID."',
												`book_flag` = '1',
												`reason` = 'In QUEUE',
												`token_no` = '".$token_no."',
												`doctor_ID`='".$doctor_ID."',
												`allowedTime`   = '".$allowedTime."'";
		// print_r($sqlInsert);
		$res = $mysqli->query($sqlInsert);
		if($res){
			echo deliver_response("success","Registration Successful","{$queryGets}");
		}
		else{
			echo deliver_response("failure","Oops! Something went wrong, Please try again later","{$sqlInsert}");
		}
	}
	else
	{
		echo deliver_response("failure","All Fields are mandatory","{$queryGets}");
	}
	
}
else{
	echo deliver_response("failure","Patient is already registered with","{$queryGets}");
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