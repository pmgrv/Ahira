<!DOCTYPE html>
<html>
  <head>    
    <meta charset="UTF-8">
    <title>Health Is Wealth</title>
    <meta name="description" content="">
 
    
    <!-- Mobile Specific Meta -->   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- Bootstrap -->
    <link href="assets/css/Custom/bootstrap.css" rel="stylesheet">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/TimeCircles.css">

    <!-- Font Awesome -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Added google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700|Lobster|Roboto+Slab:400,700' rel='stylesheet' type='text/css'>

    <!--Fav and touch icons-->
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="assets/images/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/icons/apple-touch-icon-114x114.png">

	<style>
	  #registerbutton {
			position: auto-absolute;
			z-index: 1;
			margin-left: -50px;
	  } 
	  #registerform label {
	    width:30%;
	  }
	  #registerform input {
	    width:60%;
		float:right;
		color:black;
	  }
	  #myModal {
	  	height: 100%;
	  }
	  .attop {
	  	position: relative;
    	top: 5%;
	  }
	  .forsamlldevices{
	  	   height: inherit;
	  }
	  .attop .table{
	  	position: absolute;
	  	top: 10%;
	  }
.w3-white, .w3-hover-white:hover {
    color: #000!important;
    background-color: #fff!important;
}
.w3-padding-16 {
    padding-top: 16px!important;
    padding-bottom: 16px!important;
}
.w3-padding {
    padding: 8px 16px!important;
}
table#hospital {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    text-align: center;

}
table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 2px;
    border-color: grey;
}
table, th, td {
  border: 1px solid black;
  border-radius: 10px;
  text-align: center;
}
th,td{
	color: greenyellow;
}
	</style>
  </head>
 <body class="forsamlldevices">
<div class="bg  ">
	<div class="bg-color">
	  	<div class="container content">
			<div class="row  col-md-12 col-lg-12 col-sm-12">
				<div class="sun clearfix attop">
					<div id="right-block" class="col-sm-12">
						<form class="newsletter-signup" role="form"><button type="button" class="close" data-dismiss="modal">&times;</button>
						  <div class="input-group">
							<input style="color:#000" type="text" placeholder="@9403148108/@patient_ID/@PravinkumarRaut" class="form-control" id="searchPatientText" placeholder="contact@yourdomain.com" required>
							<span class="input-group-btn">
							  <a href="#" class="btn btn-default btn-sand">Recheck</a>
							</span>
						  </div>
						</form> 
					</div>
				</div>
			</div>
<?php 
include('PHP\dbconfig.php');
$countPatient = 0;
// $url= 'http://localhost/AToZHealth/searched_result.php?searchPatientText=9403148108' ;
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'],$params);
$searchPatient = $params['searchPatientText'];
$queryToFetch = "SELECT * FROM `patientarea` WHERE patient_ContactNu ='".$searchPatient."'";
// echo $queryToFetch;
$resultPatient = $mysqli->query($queryToFetch);
if($resultPatient->num_rows>0){
	// $result = $mysqli->query("SELECT * FROM `hospitalarea`");
	while($rowPatient = $resultPatient->fetch_assoc()){
		$patient_ID = $rowPatient['patient_ID'];
		$patientName = $rowPatient['patient_FirstName'];
		$patient_ContactNu = $rowPatient['patient_ContactNu'];
		$patient_LastName = $rowPatient['patient_LastName'];
		$patient_DOB = $rowPatient['patient_DOB'];
		$patient_Gender = $rowPatient['patient_Gender'];
		$patient_At = $rowPatient['patient_At'];
	}
}

/*$fetchAllBookAbleHospital = "SELECT  ph.hospitalID,ha.hospitalName,ha.hospitalPhone,ha.hospitalAddress,ha.hospitalPinCode,ha.fees,count(ph.hospitalID) as countPatient FROM `hospitalarea` as ha, `patienthospital` as ph WHERE ha.hospitalID not in (SELECT hospitalID FROM `patienthospital` where patient_ID = '$patient_ID' and book_flag='1') and ha.hospitalID = ph.hospitalID and ph.allowedTime >CURRENT_TIMESTAMP() 
GROUP BY ph.hospitalID";//Actual Query*/
$fetchAllBookAbleHospital = "SELECT  ph.hospitalID,ha.hospitalName,ha.hospitalPhone,ha.hospitalAddress,ha.hospitalPinCode,ha.fees,count(ph.hospitalID) as countPatient FROM `hospitalarea` as ha, `patienthospital` as ph WHERE ha.hospitalID not in (SELECT hospitalID FROM `patienthospital` where patient_ID = '$patient_ID' and book_flag='1') and ha.hospitalID = ph.hospitalID and ph.book_flag='1' GROUP BY ph.hospitalID";//Temporary Query
 //echo $fetchAllBookAbleHospital;
$result = $mysqli->query($fetchAllBookAbleHospital);
if($result->num_rows>0){
	$result = $mysqli->query($fetchAllBookAbleHospital);
	
?>
			<div class="sun clearfix attop">
				<div id="right-block" class="col-sm-12" >

					<table id="hospital" >
					  <tr>
					    <th style="font-weight: 20px; color:#fff;">Hospital Name</th>
					    <th style="font-weight: 20px; color:#fff;">Total patient</th>
					    <th style="font-weight: 20px; color:#fff;">Fees(INR.)</th>					    
					    <th style="font-weight: 20px; color:#fff;">Book</th>					    
					    <th style="font-weight: 20px; color:#fff;">Your Expected Time</th>
					  </tr>
					  <?php 
					while($rowHospital = $result->fetch_assoc()){
					$countPatient= $rowHospital['countPatient']; 
					$fetchLatestBookedRegisterd = "SELECT * FROM `patienthospital` WHERE book_flag = 1 and hospitalID = '".$rowHospital['hospitalID']."' ORDER by allowedTime DESC LIMIT 1";
					//echo $fetchLatestBookedRegisterd.'<br>' ;

					$resultFetchAT = $mysqli->query($fetchLatestBookedRegisterd);
					if($resultFetchAT->num_rows>0){
						$resultFetchATValue = $mysqli->query($fetchLatestBookedRegisterd);
						while($latestPatient = $resultFetchATValue->fetch_assoc()){
							$latestPatientExpectedTime = $latestPatient['allowedTime'];
						}
					}
/*Calculating Timing to arrive*/
			  	//For assuming average time is 15 minute.. It'll vary on the basis of daily checkup patient : $numberAllotTime = $totalPatient * $averageTime
			  //$hospitalID - Change it with Total Number of patient in the Queue ~ $patientInTheQueue


					$averageTime = 15;
					/*$totalPatient = $countPatient + 1 ; //Buffer average time for doctor.
					echo $numberAllotTime = $totalPatient * $averageTime;
					$totalTimeRequired = '+'.$numberAllotTime;
					date_default_timezone_set('Asia/Kolkata');
					$d=strtotime("$totalTimeRequired Minutes");
					$totalTimeRequireds = "'".'+'.$numberAllotTime." Minutes'<br>";
					$allowedTime= date("Y-m-d H:i:s", $d);
					$to_time = strtotime($latestPatientExpectedTime);
					$from_time = strtotime($allowedTime);
					$expectedTimeToVisitOffice = round(abs($to_time - $from_time) / 60,0);
$latestPatientExpectedTime;
"<br>New Time>>> ".date('Y-m-d H:i:s',strtotime('+20 minutes',strtotime($latestPatientExpectedTime))).'<br>';
*/
$time = new DateTime($latestPatientExpectedTime);
$time->add(new DateInterval('PT' . $averageTime . 'M'));

$expectedTimeToVisitOffice  = $time->format('Y-m-d H:i:s');

// echo $numberAllotTime.'\t >>>'.$latestPatientExpectedTime.'<br> TimeToshow>>> '.$expectedTimeToVisitOffice .'<<<<<<br>'
/*End - Calculating Timing to arrive*/


					  	?>
					  <tr>
					    <td><?php echo $hospitalName = $rowHospital['hospitalName']; ?></td>
					    <td><?php echo $countPatient;?></td>
					    <td><?php print_r($rowHospital['fees']); ?></td>
					    <td>
					    <span class="input-group-btn" >
					    	<input type="hidden" id="patient_ID" value="<?php echo $patient_ID;?>">
							<input type="hidden" name="user_id" id="hospitalName" value="<?php echo $hospitalName;?>">
					    	<input type="hidden" id="countPatient" value="<?php echo $countPatient;?>">
							<a id="searchHospitalNow" class="btn btn-success testing" data-toggle="modal" data-target="#hospitalBooking" data-hospitalnametosend="<?=$rowHospital['hospitalName']?>" data-hospitalidtosend="<?=$rowHospital['hospitalID']?>" data-patientidtosend="<?=$patient_ID?>" data-totalpatienttosend="<?=$countPatient?>" data-totalestimatedtime="<?=$expectedTimeToVisitOffice?>">BOOK</a>
							</span>
						</td>
						<td><?php 
									echo $expectedTimeToVisitOffice;
						?></td>
					  </tr>
					  <?php }//End while?>
					</table>
					<a href="index.php" class="btn btn-success" >HOME</a><br>
<?php	
}//End If 
// $getBookedPatient = "SELECT * FROM `patienthospital` as ph, `hospitalarea` as ha where ph.hospitalID = ha.hospitalID and patient_ID = '$patient_ID' and book_flag='1' and allowedTime >= CURRENT_TIMESTAMP() ";//Actual
$getBookedPatient = "SELECT * FROM `patienthospital` as ph, `hospitalarea` as ha where ph.hospitalID = ha.hospitalID and patient_ID = '$patient_ID' and book_flag='1'";//Temporary
// print_r($getBookedPatient);
$result = $mysqli->query($getBookedPatient);
if($result->num_rows<=1){
	$result = $mysqli->query($getBookedPatient);
	if($result->num_rows>0){
?>
					<table id="hospital" >
					<?php if($result->num_rows==1) {?>
						<div id="limitOfHospitalRegistration">
						<input type="hidden" id="toShowErrorMessage" value="<?php echo $result->num_rows;?>"></input>
						<?php echo $result->num_rows ; ?></div>
						<?php }?>
					  <tr>
					    <th style="font-weight: 20px; color:#fff;">Hospital Name</th>
					    <th style="font-weight: 20px; color:#fff;">My Token No</th>
					    <th style="font-weight: 20px; color:#fff;">Fees(INR.)</th>
					    <th>Arriving Time</th>				    
					    <th style="font-weight: 20px; color:#fff;">Book</th>
					  </tr>
					  <?php 
					  	while($rowHospitalBooked = $result->fetch_assoc()){
							$hospitalID=$rowHospitalBooked['hospitalID'];
							$expectedTimeToVisitOfficeCancel=$rowHospitalBooked['allowedTime'];
					  		?>

					  <tr>
					    <td><?php echo $hospitalName = $rowHospitalBooked['hospitalName']; ?></td>
					    <td><?php echo $rowHospitalBooked['token_no']; ?></td>
					    <td><?php print_r($rowHospitalBooked['fees']); ?></td>
					    <td><div id="count-down" data-date="<?php echo $rowHospitalBooked['allowedTime']; ?>"></div>
					    <?php echo $rowHospitalBooked['allowedTime'];
    					date_default_timezone_set('Asia/Kolkata');
					    if($rowHospitalBooked['allowedTime']<=date("Y-m-d H:i:s", time())){
					    	/*$dt1 = date("Y-m-d H:i:s", time());
					    	echo "2nd >> ".$dt2 = $rowHospitalBooked['allowedTime']->format('d/m/Y');
					    	$interval = $dt1->diff($dt2);
					    	echo $elapsedTime = $interval->format('%i Minutes');*/
					    	?>
					    	
					    	<input type="hidden" name="reframeTime"id="reframeTime" value="<?php echo $allowedTime;?>">
							<div id="timestamp">Timer here too...</div>
						<?php 

					    }//End inside if
					    ?>
					    </td>
					    <td><span class="input-group-btn">
							<a id="searchHospitalNowCancel" class="btn btn-success " data-toggle="modal" 
							data-target="#hospitalBookingCancel"
							data-hospitalnametosendcancel="<?=$hospitalName?>" 
							data-hospitalidtosendcancel="<?=$hospitalID?>" 
							data-patientidtosendcancel="<?=$patient_ID?>"
							data-tokennotosendcancel="<?=$rowHospitalBooked['token_no']?>"
							data-totalestimatedtimecancel="<?=$expectedTimeToVisitOfficeCancel?>">CANCEL</a>
							</span>
						</td>
					  </tr>
					  <?php }//End While
					  }  
					  else { ?>
					  <tr style="font-weight: 20px; color:#fff;">
					  	<td > 
					  	Hospital Not booked yet! Please book hospital before you feel worst! 
					  	</td>
					  </tr>
					  <?php } //End if?>
					</table>
				</div>
			</div>
<?php	
}
else echo "User already exceeds the limit of registration today!";
//End If 
	

//Finding  the age:
 function getAge($dob,$condate){ 
    $birthdate = new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $dob))))));
    $today= new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $condate))))));
    $age = $birthdate->diff($today)->y;
    return $age;
}
function dateDifference($date_1 , $date_2 , $differenceFormat  )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}

$dob=$patient_DOB; //date of Birth
// echo $dob;
// $dob='2021-9-8'; //date of Birth
$condate=Date('y-m-d'); //Certain fix Date of Age 
// $ageOfpatient = getAge($dob,$condate);
$ageOfpatient=dateDifference($dob , $condate , $differenceFormat ='%y Year %m Month %d Day'  );
$fullName = $patientName .' '. $patient_LastName;
?>
		</div>
<!--************Registratin Start*************-->
	<div id="hospitalBooking" class="modal fade" role="dialog">
	  <div class="modal-dialog"> 
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">BOOKING</h4>
		  </div>
		  <div class="modal-body">
			<form role="form" id="registerform">
			  <div class="form-group">
				<label>Full Name:</label>
				<input type="text" value='<?php echo $fullName;  ?>' class="form-control" id="fullnameBook" required="required">
			  </div>
			  <div class="form-group" >
				<label>Contact No.:</label>
				<input type="text" class="form-control" value="<?php echo $patient_ContactNu; ?>" id="phNoBook" required="required">
			  </div>
		      <div class="form-group">
				<label>Age:</label>
				<input type="" class="form-control" value = "<?php echo $ageOfpatient; ?>" id="dob_patientBook" required="required">
			  </div>	
		      <div class="form-group">
				<label>Address:</label>
				<input type="text" class="form-control" value = "<?php echo $patient_At; ?>" id="add_at_patientBook" required="required">
			  </div>  Gender:
				<label>
		      	<?php
		      	if($patient_Gender=='male') {?>
				<input type="radio" name="gender_patient" id="gender_patientBook" value="male" checked="checked">Male
				<?php } else{?>
				<input type="radio" name="gender_patient" id="gender_patientBook" value="female" checked="checked">Female
				<?php }?>
			  </label><br><br>
			  <label><input type="checkbox"id="toOpenAcknowledgeForm" onclick="selectAllRow(this)"/><br>I have acknowledged</label><br/>
			  <div id="acknowledgementForm" style="height: 100%; border: 2px solid #979797; display: none";>
					<div class="form-group" id="doctorlList">Please select a doctor:<br>
						<input type="radio" name="doctorName" value="">Dr.Jula<br>
						<input type="radio" name="doctorName" value="">Dr.Netam 
					</div>
			  <?php echo "You have selected "?><b id="hospitalNameToShowTop"> 
			  <?php echo $hospitalName." ";?> </b>
			  <!-- For Hospital Id Do some more research on how Values can be reflected on Modal from the PHP file. TODO -->
			  <?php echo "Your token is ";?><b id="meranumberkabayega"> <?php echo $countPatient + 1 ;?> </b> <br>
			  <?php echo "Expected time is ";?><b id="expectedTimeToArrive"> 
			  </b>
			  	Hereby, I declare that above all the information is given by me is correct.<br> I'll be accepting all the rules and regulations mentioned by the <b id="hospitalNameToShowBottom"> <?php echo $hospitalName ;?> </b> 


			  </div>
			  <input type="hidden" id="allowedTime" value="<?php echo $allowedTime;?>">
			  <a href="#" class="btn btn-success" id="submitDataBookToAcknowledge">Accept</a><br>
			  <!-- <a href="#" class="btn btn-success" id="submitDataBookToAcknowledge" data-userid="">Accept</a><br> -->
			  <span id="hospitalRequest"></span><br>
			  <span id="hospitalRequestedTime">2. If you come after <b id="estimatedTimeToArrive"></b></span>
			  <span id="hospitalLate"></span>
			  
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
<!--************Registratin Ends*******************-->
<!--************Booking cancel Start*************-->
	<div id="hospitalBookingCancel" class="modal fade" role="dialog">
	  <div class="modal-dialog"> 
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">BOOKING CANCEL</h4>
		  </div>
		  <div class="modal-body">
		  	You want to cancel booking hospital, You'll need to re-register hospital again!
			<div id="hospitalcanceldetails"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
<!--************Booking cancel Ends*******************-->
    
			<!-- .container end here -->
	</div>
</div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/TimeCircles.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery.placeholder.js"></script>
    <script type="text/javascript">
	//Solemnly for Acknowledgemet form
		$(document).off('click').on('click','#toOpenAcknowledgeForm',function(){
			$("#acknowledgementForm").show();
			$("#submitDataBookToAcknowledge").removeAttr("disabled");
			$("#submitDataBookToAcknowledge").text("Acknowledged");
			$("#hospitalRequest").text("1. *Please bring old examination file, if you have any! ");
			$("#hospitalRequestedTime").show();
			$('#hospitalLate').text("Then time may reframe and will let you know.")
		  	$('#hospitalRequest').css('color','#ff0000');
		  	$('#hospitalRequestedTime').css('color','#ff0000');
		  	$('#hospitalLate').css('color','#ff0000');
		});
		$(document).ready(function(){
			if($('#toShowErrorMessage').val()==1){
		  		$('#searchHospitalNow').attr("disabled","disabled");
		  		$('.testing').attr("disabled","disabled");
		  		$('#limitOfHospitalRegistration').css('color','#f7c304');
				$('#limitOfHospitalRegistration').text("Maximum "+$('#toShowErrorMessage').val()+" hospital can be registered Today!");
			}
			$('#hospitalBooking').on('hidden.bs.modal', function () {
			  location.reload();
			})
//Initilization
			$("#hospitalRequestedTime").hide();
			$('#submitDataBookToAcknowledge').attr("disabled","disabled");
			var searchPatientText = getUrlParameter('searchPatientText');
			$('#searchPatientText').val(searchPatientText);
//Modal values
			$('#hospitalBooking').on('show.bs.modal', function(e) {
			    var userid = $(e.relatedTarget).data('userid');
			    $('#hospitalNameToShowTop').text(userid);
			    $('#hospitalNameToShowBottom').text(userid);
			    $(e.currentTarget).find('input[name="user_id"]').val(userid);
//Sending values to do finalization of Booking Slot
			    $(document).on('click','#submitDataBookToAcknowledgeTest',function(){
					// var hospitalName = $('#hospitalName').val();
					//alert(userid+" PID> "+ patient_ID);;
					
				  var json_data = {
				    "hospitalName":$('#hospitalID').val(),
				    "allowedTime":$('#allowedTime').val(),
				    "patientID":$('#patient_ID').val()
				  };
				  $.ajax({
				  type:"POST",
				  url:"PHP/getPatientHospital.php",
				  data: {"DATA": JSON.stringify(json_data)},
				  beforeSend:function(data){
				  	//alert(JSON.stringify(json_data));
				  	//alert("Sending your data!!");
				  },
				  success:function(data){
				  	alert("Your slot Booked Succesfully!!!");
					setTimeout(() => { location.reload(); }, 2000);
				    // window.location.replace("index.php");
				  	// alert(JSON.stringify(json_data));
				  },
				  error:function(err){
				    alert(JSON.stringify(err));
				  }
				  });
				});
			});
//To cancel Booking
		$(document).on('click','#searchHospitalNowCancel',function(){
		 	$('#hospitalBookingCancel').modal('show')//Opening model here...
	        var hospitalidtosendcancel = $(this).data('hospitalidtosendcancel');
	        var hospitalnametosendcancel = $(this).data('hospitalnametosendcancel');
	        var patientidtosendcancel = $(this).data('patientidtosendcancel');
	        var totalestimatedtimecancel = $(this).data('totalestimatedtimecancel');
	  //       var totalpatienttosend = $(this).data('totalpatienttosend')+1;
			// var searchBooking = getUrlParameter('searchPatientText');

		 	$('#hospitalcanceldetails').html(hospitalnametosendcancel+" "+hospitalidtosendcancel + " " + patientidtosendcancel);
		 	// $('#hospitalNameToShowBottom').html($(this).data('hospitalnametosend'));
		 	// $('#hospitalNameToShowTop').html($(this).data('hospitalnametosend'));
		 	// $('#hospitalIDToShowTop').html($(this).data('hospitalidtosend'));
		 	// $('#meranumberkabayega').html(totalpatienttosend);
/*To cancel booking*/
			var json_data = {
			    "hospitalidtosend":hospitalidtosendcancel,
			    "patientidtosend":patientidtosendcancel,
			    "totalestimatedtimecancel":totalestimatedtimecancel,
			    "tokennotosendcancel":$(this).data('tokennotosendcancel')

			  };
			  $.ajax({
			  type:"POST",
			  url:"PHP/getCancelHospitalDetails.php",
			  data: {"DATA": JSON.stringify(json_data)},
			  beforeSend:function(data){
			  	// alert(JSON.stringify(json_data));
			  	//alert("Sending your data!!");
			  },
			  success:function(data){
			  	$('#hospitalcanceldetails').html(data);
				setTimeout(() => { location.reload(); }, 5000);

			  	// alert(JSON.stringify(json_data));
			  },
			  error:function(err){
			    alert(JSON.stringify(err));
			  }
			  });
/*End to cancel booking*/
		 });
		//End to Cancel Booking
		$(document).on('click','#searchHospitalNow',function(){
	        var hospitalidtosend = $(this).data('hospitalidtosend');
	        var patientidtosend = $(this).data('patientidtosend');
	        var totalpatienttosend = $(this).data('totalpatienttosend')+1;
			var totalestimatedtime = $(this).data('totalestimatedtime');
			var searchBooking = getUrlParameter('searchPatientText');

		 	$('#hospitalIdToShow').html($(this).data('hospitalidtosend'));
		 	$('#hospitalNameToShowBottom').html($(this).data('hospitalnametosend'));
		 	$('#hospitalNameToShowTop').html($(this).data('hospitalnametosend'));
		 	$('#hospitalIDToShowTop').html($(this).data('hospitalidtosend'));
		 	$('#estimatedTimeToArrive').html($(this).data('totalestimatedtime'));
		 	$('#expectedTimeToArrive').html($(this).data('totalestimatedtime'));
		 	
		 	$('#meranumberkabayega').html(totalpatienttosend);

		 	$('#hospitalBooking').modal('show');
		 	$('#phNoBook').val(searchBooking);
		  	$('#phNoBook').css('color','#f7c304');
		  	$('#phNoBook').css('font-weight','bold');
		  	$('#phNoBook').attr("disabled","disabled");
		  	$('#fullnameBook').attr("disabled","disabled");
		  	$('#dob_patientBook').attr("disabled","disabled");
		  	$('#add_at_patientBook').attr("disabled","disabled");
		  	$('#gender_patientBook').attr("disabled","disabled");
/*To get list of Doctors*/
			var json_data = {
			    "hospitalidtosend":hospitalidtosend
			  };
			  $.ajax({
			  type:"POST",
			  url:"PHP/getHospitalDetails.php",
			  data: {"DATA": JSON.stringify(json_data)},
			  beforeSend:function(data){
			  	// alert(JSON.stringify(json_data));
			  	//alert("Sending your data!!");
			  },
			  success:function(data){
			  	$('#doctorlList').html(data);
			  	
				setTimeout(() => { alert("Make sure you have selected correct doctor!"); }, 2000);
			    // window.location.replace("index.php");
			  	// alert(JSON.stringify(json_data));
			  },
			  error:function(err){
			    alert(JSON.stringify(err));
			  }
			  });
/*End to Get List of Doctors*/

			 /*Value sending to API*/
			 //Sending values to do finalization of Booking Slot
		    $(document).on('click','#submitDataBookToAcknowledge',function(){
			  var json_data = {
			    "hospitalName":hospitalidtosend,
			    "patientID":patientidtosend,
			    "token_no":totalpatienttosend,
			    "doctor_ID":$("input[name=doctorName]:checked").val(),
			    "totalestimatedtime":totalestimatedtime
			  };
			  $.ajax({
			  type:"POST",
			  url:"PHP/getPatientHospital.php",
			  data: {"DATA": JSON.stringify(json_data)},
			  beforeSend:function(data){
			  	// alert(JSON.stringify(json_data));
			  	//alert("Sending your data!!");
			  },
			  success:function(data){
			  	
				setTimeout(() => { alert("Your slot Booked Succesfully!!"); }, 200);
		 		$('#hospitalBooking').modal('hide');
				setTimeout(() => { location.reload(); }, 2000);
			   // window.location.replace("index.php");
			  	// alert(JSON.stringify(json_data));
			  },
			  error:function(err){
			    alert(JSON.stringify(err));
			  }
			  });
			});
			 /*END API*/
		});
	});
		
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};
function selectAllRow(ele){
	var set = $('input[type="checkbox"]');
	var checked = $(ele).is(":checked");
	$(set).each(function(){
		$(this).prop("checked", checked);
	});
}
    </script>
<script type="text/javascript">
  		$(document).ready(function() {
		    setInterval(timestamp, 1000);
		});

		function timestamp() {
		    $.ajax({
		        url: 'PHP/timestamp.php',
		        success: function(data) {
		            $('#timestamp').html(data);
		        },
		    });
		}
</script>
    
<script>
      $("#count-down").TimeCircles(
       {   
           circle_bg_color: "#8a7f71",
           use_background: true,
           bg_width: 1.0,
           fg_width: 0.02,
           time: {
                Days: { color: "#fefeee" },
                Hours: { color: "#fefeee" },
                Minutes: { color: "#fefeee" },
                Seconds: { color: "#fefeee" }
            }
       }
    );

</script>
    <script type="text/javascript"></script>
  </body>
</html>