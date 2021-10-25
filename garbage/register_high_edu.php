<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');

header('Content-type:application/json');

include('PHP/dbconfig.php');

$DB = new Database();

 $rowData = json_decode($_POST['DATA']);
if(empty($rowData)){
$rowData = json_decode($HTTP_RAW_POST_DATA);
}
print_r($rowData);
/*error_reporting(1);
if(isset($_REQUEST))
extract($_REQUEST);
print_r($_REQUEST);*/

 /*$full_name = $rowData->full_name;
 $email_id = $rowData->email_id;
 $date_birth = $rowData->date_birth;
 $gender = $rowData->gender;
  $phNo = $rowData->phNo;
  // $phNo_wa = $rowData->phNo;
  $aadhar_card = $rowData->aadhar_card;
echo 'FN'.$full_name;*/
/*
if(!empty($fname)&&!empty($ph)&&!empty($aadhar)&&!empty($cmpny)&&!empty($work))
{
	$sqlInsert = "INSERT INTO serviceboxx_users SET 
												fullname = '".$fname."',
												aadhar   = '".$aadhar."',
												phone    = '".$ph."',
												company  = '".$cmpny."',
												work     = '".$work."'";
	$res = mysql_query($sqlInsert) or die(mysql_error());
	$id = mysql_insert_id();
	if($id>0){
		echo deliver_response("success","Registration Successful","{$id}");
	}
	else{
		echo deliver_response("failure","Oops! Something went wrong, Please try again later","{}");
	}
}
else
{
	echo deliver_response("failure","All Fields are mandatory","{}");
}
function deliver_response($status,$status_msg,$data){
//	header("HTTP/1.1 $status %status_message");
	$response['status'] = $status;
	$response['massage'] = $status_msg;
	$response['data'] = $data;
	
$json_response=json_encode($response);
return  $json_response;

}

*/

?>