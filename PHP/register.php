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
$fullname = $rowData->fullname;
$patient_name = explode(' ',$fullname);
$patient_FirstName = $patient_name[0];
$patient_LastName = $patient_name[1];
$patient_ContactNu = $rowData->phoneNo;
$patient_AadharNo = $rowData->aadhar;
$patient_DOB = $rowData->dob_patient;
$patient_At = $rowData->add_at_patient;
$add_pin_code_patient= $rowData->add_pin_code_patient;
$gender_patient=$rowData->gender_patient;
/*$query = "SELECT * FROM `patientarea` WHERE patient_FirstName like ('$patient_FirstName') and  patient_LastName like ('$patient_LastName') or  patient_ContactNu like ('$patient_ContactNu')";
print_r($query);*/
$result = $mysqli->query("SELECT * FROM `patientarea` WHERE patient_FirstName like ('$patient_FirstName') and  patient_LastName like ('$patient_LastName') or  patient_ContactNu like ('$patient_ContactNu')");
//printf("Select returned %d rows.\n", $result->num_rows);
if($result->num_rows<=0){
	if(!empty($patient_FirstName)&&!empty($patient_ContactNu)&&!empty($patient_DOB)&&!empty($patient_At))
	{
		$sqlInsert = "INSERT INTO patientarea SET 
												patient_FirstName = '".$patient_FirstName."',
												patient_LastName = '".$patient_LastName."',
												patient_AadharNo   = '".$patient_AadharNo."',
												patient_ContactNu    = '".$patient_ContactNu."',
												patient_DOB  = '".$patient_DOB."',
												patient_At  = '".$patient_At."',
												patient_Gender  = '".$gender_patient."',
												patient_pinCode     = '".$add_pin_code_patient."'";
		$res = $mysqli->query($sqlInsert);
		// $id = mysql_insert_id();
		// print_r($res . " <<<< Result ");
		if($res){
			echo deliver_response("success","Registration Successful","{$res}");
		}
		else{
			echo deliver_response("failure","Oops! Something went wrong, Please try again later","{}");
		}
	}
	else
	{
		echo deliver_response("failure","All Fields are mandatory","{}");
	}
	
}
else{
	while($row = $result->fetch_assoc()){
		$already_registered_number = $row['patient_ContactNu'];
		// $already_registered_name =  $row['patient_FirstName'];
	}
	echo deliver_response("failure","Patient is already registered with","{$already_registered_number}");
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