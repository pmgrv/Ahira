<!DOCTYPE html>
<html>
 <head>    
    <meta charset="UTF-8">
    <title>Health Is Wealth - Receptionist</title>
    <meta name="description" content="">
 
    
    <!-- Mobile Specific Meta -->   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- Bootstrap -->
    <link href="../assets/css/Custom/bootstrap.css" rel="stylesheet">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/TimeCircles.css">

    <!-- Font Awesome -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Added google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700|Lobster|Roboto+Slab:400,700' rel='stylesheet' type='text/css'>

    <!--Fav and touch icons-->
    <link rel="shortcut icon" href="../assets/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="../assets/images/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/icons/apple-touch-icon-114x114.png">

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
		.row{
			margin-right: 0px;
    margin-left: 0px;
		}
	</style>
  </head>
  <?php 
		include('../PHP/dbconfig.php');
		 	$url = $_SERVER['REQUEST_URI'];
		$url_components = parse_url($url);
		parse_str($url_components['query'],$params);
		$searchreceptionist = $params['searchreceptionist'];
		$getNextPatient = '';
		$hospitalID='';
		$doctorFN = '';
		?>
 <body>
<div class="bg">
 	<div class="bg-color">
	<div class="row"  style="color:#fff">
		<?php		
		$queryToGetreceptionistDetails = "SELECT * FROM `receptionistarea` WHERE receptionist_FirstName like ('%".$searchreceptionist."%') or  receptionist_LastName like ('%".$searchreceptionist."%') or  receptionist_ContactNu like ('%$searchreceptionist%')";
		// print_r($queryToGetreceptionistDetails);
		$result = $mysqli->query($queryToGetreceptionistDetails);
		if($result->num_rows>0){
			$result = $mysqli->query($queryToGetreceptionistDetails);
			while($row = $result->fetch_assoc()){
				$recID = $row['receptionist_ID'];
				$firstName = $row['receptionist_FirstName'];
				$lastName = $row['receptionist_LastName'];
				$receptionist_Gender = $row['receptionist_Gender'];

				if($receptionist_Gender=='male'){
					echo '<br> Mr. '.$fullName = $firstName.' '.$lastName;
				}
				else{
					echo '<br> Ms. '.$fullName = $firstName.' '.$lastName;	
				}
				$receptionistContactNumber = $row['receptionist_ContactNu'];
				$receptionistID = $row['receptionist_ID'];
				$queryToGetreceptionistHospital = "SELECT ha.hospitalID,ha.hospitalName,ha.hospitalAddress
				FROM ((`receptionisthospital` AS dh inner join `hospitalarea` AS ha on ha.hospitalID=dh.hospital_ID ) inner join `receptionistarea` as da on dh.receptionist_ID=da.receptionist_ID)
				where 
				da.receptionist_ContactNu='".$receptionistContactNumber."' GROUP by ha.hospitalName";
				// echo $queryToGetreceptionistHospital;
				$resultContactNo = $mysqli->query($queryToGetreceptionistHospital);
				if($resultContactNo->num_rows>0){
					$resultContactNo = $mysqli->query($queryToGetreceptionistHospital);
					while($rowContact = $resultContactNo->fetch_assoc()){
						echo '<br>'.$hospitalName = $rowContact['hospitalName'];
						echo '<br>'.$rowContact['hospitalAddress'];
						$hospitalID=$rowContact['hospitalID'];
					}
				}
				echo '<br>'.$searchreceptionist;
				?>
<!-- To Get patients list to be checking-->
				<div class="row"  style="color:#fff">
					<?php 
						$queryToGetCountOfPatient = "SELECT * FROM `patienthospital` as ph, `patientarea` as pa, `doctorarea` as da WHERE ph.hospitalID='".$hospitalID."' and (ph.book_flag=1 OR ph.book_flag=3) and pa.patient_ID=ph.patient_ID and da.doctor_ID=ph.doctor_ID ORDER BY allowedTime ASC";
						// echo $queryToGetCountOfPatient;
						$resultCountOfPatient = $mysqli->query($queryToGetCountOfPatient);
						$totalPatientAvailable = $resultCountOfPatient->num_rows;
						 if($totalPatientAvailable>0){
					?>

					<div class="clearfix attop">
						<div id="right-block" class="col-sm-12" >
						Total <?php echo $totalPatientAvailable ;?> patient in the QUEUE<br>
						<table id="hospital" >
						  	<tr>
							    <th style="font-weight: 20px; color:#fff;">Patient Name</th>
							    <th style="font-weight: 20px; color:#fff;">Age</th>		
							    <th style="font-weight: 20px; color:#fff;">Address</th>		
							    <th style="font-weight: 20px; color:#fff;">Blood Group</th>
							    <th style="font-weight: 20px; color:#fff;">Dr. Name</th>
							    <th style="font-weight: 20px; color:#fff;">Token</th>
						  	</tr>

								<?php
								if($resultCountOfPatient->num_rows>0){
								$tokenNoNext = 10000;
								$patientList = [];
								$resultCountOfPatient = $mysqli->query($queryToGetCountOfPatient);
								while($rowCountOfPatient = $resultCountOfPatient->fetch_assoc()){
									$reason =  $rowCountOfPatient['reason'];
									$doctor_FirstName =  $rowCountOfPatient['doctor_FirstName'];
									$doctor_LastName =  $rowCountOfPatient['doctor_LastName'];
									$doctorFN =  $rowCountOfPatient['doctor_FirstName'].' '.$doctor_LastName;
									$patientFN =  $rowCountOfPatient['patient_FirstName'];
									$patientLN =  $rowCountOfPatient['patient_LastName'];
									$patientDOB =  $rowCountOfPatient['patient_DOB'];
									$patientAdd =  $rowCountOfPatient['patient_At'];
									$token_no =  $rowCountOfPatient['token_no'];
									$getNextPatientID =  $rowCountOfPatient['patient_ID'];
									// $patientList[]=$token_no;
									array_push($patientList, $token_no);
									$patientFullName = $patientFN.' '.$patientLN;
									if($tokenNoNext>$token_no){
										$tokenNoNext = $token_no;
										$getNextPatient = $patientFullName;
										$getNextPatientID = $getNextPatientID;
									}
									$dob=$patientDOB; //date of Birth
									// echo $dob;
									// $dob='2021-9-8'; //date of Birth
									$condate=Date('y-m-d'); //Certain fix Date of Age 
									// $ageOfpatient = getAge($dob,$condate);
									$ageOfpatient=dateDifference($dob , $condate , $differenceFormat ='%y Year %m Month %d Day'  );
									?>
									<tr>
									    <td><?php echo $patientFullName; ?></td>
									    <td><?php echo $ageOfpatient;?></td>
									    <td><?php echo $patientAdd; ?></td>
									    <td>O+</td>
									    <td><?php echo $doctorFN ; ?></td>
									    <td><?php echo $token_no  ; ?></td>
									</tr>
									<?php
								} // End INSIDE WHILE
							}// End INSIDE IF
						?>
						</table>
						</div>
					</div>
				</div>
				<div class="row"  style="color:#fff">
						<!-- <form method="post" action="../PHP/receptionistAreaAPIs/setApprovalByreceptionistForm.php">
							<p id="removeOnceClickOnYes">
							<input type="hidden" name="patientList[]" value="<?php print_r($patientList); ?>"></input>
								<button href="#" class="btn btn-success" id="submitDataConfirmration" 
								data-approvedpatientlist="<?=$totalPatientAvailable?>"
								type="submit"
								>ALL <?php echo $totalPatientAvailable ;
								?></button>
							</p>
						</form> -->
						Next patient: <a href="" id="showpatientList" value="<?php echo $getNextPatient;?>"  class="btn btn-danger" ><?php echo $getNextPatient;?></a><br><br>
						<input type="hidden" id="nextPatientID" value="<?php echo $getNextPatientID; ?>"></input>						
						<input type="hidden" id="nextPatientToken" value="<?php echo $tokenNoNext; ?>"></input>
						<input type="hidden" id="receptionistID" value="<?php echo $receptionistID; ?>"></input>
						Doctor call <button href="#" class="btn btn-success" id="setSendNextPatient">PENDING...</button><br> <b style="color: orange;">OR</b><br> WAIT<a>
						<select id="timeList">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="5">5</option>
						  <option value="10">10</option>
						  <option value="15">15</option>
						  <option value="20">20</option>
						  <option value="30">30</option>
						  <option value="60">60</option>
						</select></a> MIN
						<input class="btn btn-success" id="waitingTime" type="submit" value="Submit">
						<br><br>
				</div>
				<?php }
					else{ echo "<b style='color: red;'>No patients in the queue!</b>" ;}
				?>
<!-- To Get Pending patients list -->
				<div class="row"  style="color:#fff">
					<?php 
						$queryToGetPendingPatient = "SELECT * 
									FROM 
									`patienthospital` as ph, 
									`patientarea` as pa, 
									`doctorarea` as da, 
									`doctorhospital` as dh
									WHERE 
									ph.hospitalID='".$hospitalID."' 
									and ph.book_flag=4 
									and pa.patient_ID=ph.patient_ID 
									and da.doctor_ID=ph.doctor_ID
									and dh.doctor_ID=ph.doctor_ID
									and dh.hospital_ID=ph.hospitalID ORDER BY allowedTime ASC";
						// echo $queryToGetPendingPatient;
						$resultCountOfPatientPending = $mysqli->query($queryToGetPendingPatient);
						$totalPatientPending = $resultCountOfPatientPending->num_rows;
					?>

					<div class="clearfix attop">
						<div id="right-block" class="col-sm-12" >
						Total <?php echo $totalPatientPending ;?> patient pending to be checked and paid!<br>
						<table id="hospital" >
						  	<tr>
							    <th style="font-weight: 20px; color:#fff;">Patient Name</th>
							    <th style="font-weight: 20px; color:#fff;">Age</th>		
							    <th style="font-weight: 20px; color:#fff;">Contact Number</th>
							    <th style="font-weight: 20px; color:#fff;">Status</th>		
						  	</tr>

								<?php
								if($resultCountOfPatientPending->num_rows>0){
								$tokenNoNext = 10000;
								$patientList = [];
								$resultCountOfPatientPending = $mysqli->query($queryToGetPendingPatient);
								while($rowCountOfPatientPending = $resultCountOfPatientPending->fetch_assoc()){
									$doctorIDSend = $rowCountOfPatientPending['doctor_ID'];
									$checkupfees =  $rowCountOfPatientPending['checkupfees'];
									$patientFN =  $rowCountOfPatientPending['patient_FirstName'];
									$patientLN =  $rowCountOfPatientPending['patient_LastName'];
									$patientDOB =  $rowCountOfPatientPending['patient_DOB'];
									$patient_ContactNu =  $rowCountOfPatientPending['patient_ContactNu'];
									$patientAdd =  $rowCountOfPatientPending['patient_At'];
									$token_no =  $rowCountOfPatientPending['token_no'];
									$getNextPatientID =  $rowCountOfPatientPending['patient_ID'];
									$getNextPatientIDsend =  $rowCountOfPatientPending['patient_ID'];
									$getReason =  $rowCountOfPatientPending['reason'];
									// $patientList[]=$token_no;
									array_push($patientList, $token_no);
									$patientFullName = $patientFN.' '.$patientLN;
									if($tokenNoNext>$token_no){
										$tokenNoNext = $token_no;
										$getNextPatient = $patientFullName;
										$getNextPatientID = $getNextPatientID;
									}
									$dob=$patientDOB; //date of Birth
									// echo $dob;
									// $dob='2021-9-8'; //date of Birth
									$condate=Date('y-m-d'); //Certain fix Date of Age 
									// $ageOfpatient = getAge($dob,$condate);
									$ageOfpatient=dateDifference($dob , $condate , $differenceFormat ='%y Year %m Month %d Day'  );
									?>
									<tr>
									    <td><?php echo $patientFullName; ?></td>
									    <td><?php echo $ageOfpatient;?></td>
									    <td><a href="tel:<?php echo $patient_ContactNu; ?>"><?php echo $patient_ContactNu; ?></a></td>
									    <td><b ><?php echo $getReason.' '; ?></b>
									    <input type="hidden" id="doctorIDSend" value="<?php echo $doctorIDSend; ?>"></input>	
									    <input type="hidden" id="PatientIDSend" value="<?php echo $getNextPatientIDsend; ?>"></input>						
										<input type="hidden" id="PatientToken" value="<?php echo $tokenNoNext; ?>"></input>
										<input type="hidden" id="receptionistID" value="<?php echo $receptionistID; ?>"></input>
									    <input type="hidden" id="checkupfeesDefault" value="<?php echo $checkupfees;?>"></input>
									    <button href="#" class="btn btn-success" id="setAmountOrReason"
										
									    > PAY</button><b id="testingReplace"></b><b id="submitAmount"></b></td>
									</tr>
									<?php
								} // End INSIDE WHILE
							}// End INSIDE IF
						?>
						</table>
						</div>
					</div>
				</div>


			
				<div class="row"  style="color:#fff">
					HISTORY
					<p>Total patients checked in the last WEEK : <b>300</b> <t>FREE: <b>5</b> PAID: <b>295</b></t></p>
					<p>Today 20 patients checked successfully! and <?php echo $totalPatientAvailable ;?> are in the QUEUE</p>
					<p>Yesterday, 30 patients have been checked successfully in 8 hours.</p>
					<p>On dated 28-10-2021 Tuesday 45 patienced have bee checked in 9 hours</p>
				</div>
				<?php

			}//Outsider WHILE Loop
		}//Outsider IF Loop
	?>
	</div>
	<div id="showDoctorToBeSelected"></div>
	<a href="index.php" class="btn btn-success" >HOME</a>
	<button href="" id="patientReg" class="btn btn-success">Register Patient
	<input type='hidden' id='hospitalIDTogetPatientDetails' value='<?php echo $hospitalID;?>'>
	</button><br>
	<div id="doctorlList"></div>
	<div id="patientRegArea">
		<form class="newsletter-signup" role="form">
		  <div class="input-group">
			<input type='hidden' id='hospitalIDToGetTotalPatient' value='<?php echo $hospitalID;?>'>
			<input type='hidden' id='receptionistID' value='<?php echo $recID;?>'>
			<input style="color:#000" type="text" placeholder="@9403148108/@patient_ID" class="form-control" id="searchPatientFromRec" required>
			<span class="input-group-btn">
			  <a href="#" id="searchHospitalNowFromReception" class="btn btn-default btn-sand">CHECK</a>
			</span>
		  </div><!-- /input-group -->
		</form>
		<div id="patientdetailsTest"></div>
	</div>
	<div id="right-block" class="col-sm-12">                  
		<p class="followus"></p>
		<ul class="social-icon" style="margin-top: -42px;">
			<li><a href="#"><i class="fa fa-camera-retro"></i></a></li>
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-youtube-square"></i></a></li>
		</ul>              
	</div>
	
		<!-- .container end here -->
 </div>
</div>
<?php
	function dateDifference($date_1 , $date_2 , $differenceFormat  )
	{
	    $datetime1 = date_create($date_1);
	    $datetime2 = date_create($date_2);
	    $interval = date_diff($datetime1, $datetime2);
	    return $interval->format($differenceFormat);
	}
?>
<!--************Registratin Start*************-->
	<div id="hospitalBooking" class="modal fade" role="dialog">
	  <div class="modal-dialog"> 
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">BOOKING BY RECEPTIONIST</h4>
		  </div>
		  <div class="modal-body">
			<form role="form" id="registerform">
			  <div class="form-group">
				<span>Full Name: <b id="fullnameBookByRec"></b></span>
			  </div>
			  <div class="form-group" >
				<span>Contact No.: <b id="contactBookByRec"></b></span>
			  </div>
		      <div class="form-group">
				<span>Age: <b id="ageBookByRec"></b></span>
			  </div>	
		      <div class="form-group">
				<span>Address: <b id="addressBookByRec"></b></span>
			  </div> 
			  <div>
				<span>Gender: <b id="genderBookByRec"></b></span><br><br>
				</div>
			  <div style="height: 100%; border: 2px solid #979797;";>
				<span>Selected Doctor: <b id="selectedDocBookByRec"></b></span><br>
				<span>Token: <b id="tokenBookByRec"></b></span><br>
				<span>Exp Time: <b id="expectedTimeBookByRec"></b></span><br>
			  </div>
			  <a href="#" class="btn btn-success" id="submitDataBookToAcknowledgeByRec">Accept</a><br>
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../assets/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/TimeCircles.js"></script>
<script src="../assets/js/jquery.ajaxchimp.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/jquery.placeholder.js"></script>
<script type="text/javascript">

$(document).ready(function(){

	//To set Fees input
	$(document).on("click",'#setAmountOrReason',function(){


	    // var doctorcheckupfees = $(this).data('doctorcheckupfees');
	    // alert(doctorcheckupfees);
		var input = document.createElement("input");
		input.setAttribute('type', 'text');
		input.setAttribute('id', 'getAmount');
		input.setAttribute('name', 'getAmount');
		input.setAttribute('value',$("#checkupfeesDefault").val());
		var parent = document.getElementById("testingReplace");
		parent.appendChild(input);
		$('#setAmountOrReason').attr("disabled","disabled");
		$('#setAmountOrReason').remove();


		var element = document.createElement("button");
	    element.appendChild(document.createTextNode("PAY NOW"));
		element.setAttribute('class', 'btn btn-success');
		element.setAttribute('id', 'setAmount');
	    var page = document.getElementById("submitAmount");
	    page.appendChild(element);

	    });
	//To Send Fees
	$(document).on("click",'#setAmount',function(){
	    var doctorIDSend = $("#doctorIDSend").val();
	    var getAmount = $("#getAmount").val();
        var PatientIDSend = $("#PatientIDSend").val();
        var receptionistIDChangedStatus = $("#receptionistID").val();
        var PatientToken = $("#PatientToken").val();
	  	var json_data = {
	    	"getAmount":getAmount,
	    	"PatientIDSend":PatientIDSend,
	    	"doctorIDSend":doctorIDSend,
	    	"PatientToken":PatientToken,
	    	"receptionistID":receptionistIDChangedStatus
	  	};
		$.ajax({
		  type:"POST",
		  url:"../PHP/receptionistAreaAPIs/collectingFeesByreceptionist.php",
		  data: {"DATA": JSON.stringify(json_data)},
		  beforeSend:function(data){
		  	alert(JSON.stringify(json_data));
		  	alert("Sending your data!!");
		  },
		  success:function(data){
		  	// alert(data);
		  	alert("Paid Successfully");
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

	
</script>

<script type="text/javascript">
	//Update Time by receptionist when patient is in the Hospital Queue 
	$(document).on("click",'#waitingTime',function(){
	        var timeList = $("#timeList").val();
	        var nextPatientID = $("#nextPatientID").val();
	        var receptionistIDChangedStatus = $("#receptionistID").val();
	        var nextPatientToken = $("#nextPatientToken").val();
		  	var json_data = {
		    	"waitingTimeSetByreceptionist":timeList,
		    	"nextPatientID":nextPatientID,
		    	"nextPatientToken":nextPatientToken,
		    	"receptionistID":receptionistIDChangedStatus
		  	};
			$.ajax({
			  type:"POST",
			  url:"../PHP/receptionistAreaAPIs/setWaitingTimeByreceptionist.php",
			  data: {"DATA": JSON.stringify(json_data)},
			  beforeSend:function(data){
			  	alert(JSON.stringify(json_data));
			  	alert("Sending your data!!");
			  },
			  success:function(data){
			  	alert(data['data']);
			  	alert("Registration successful!!");
			    // window.location.replace("index.php");
			  	// alert(JSON.stringify(json_data));
			  },
			  error:function(err){
			    alert(JSON.stringify(err));
			  }
			});
	    });
</script>

<script type="text/javascript">
	$(document).ready(function(){

		//Sending book_flag Approval From receptionist to patient directly
	    $(document).on('click','#submitDataConfirmration',function(){
		  	// $('#removeOnceClickOnYes').hide();
	        var countofApprovedPatient = $(this).data('countofpatientapprovedbyreceptionist');
		  	var json_data = {
		    	"countofApprovedPatient":countofApprovedPatient
		  	};
			$.ajax({
			  type:"POST",
			  url:"../PHP/setApprovalByreceptionist.php",
			  data: {"DATA": JSON.stringify(json_data)},
			  beforeSend:function(data){
			  	/*alert(JSON.stringify(json_data));*/
			  	alert("Sending your data!!");
			  },
			  success:function(data){
			  	alert("Registration successful!!");
			    window.location.replace("index.php");
			  	/*alert(JSON.stringify(json_data));*/
			  },
			  error:function(err){
			    alert(JSON.stringify(err));
			  }
			});
	    });
	    
	    $(document).on('click','#submitData',function(){
		  //alert("hey");
		  var json_data = {
		    "fullname":$("#fullname").val(),
		    "phoneNo":$("#phNo").val(),
		    "aadhar":$("#aadhar").val(),
		    "dob_receptionist":$("#dob_receptionist").val(),
		    "add_pin_code_receptionist":$("#add_pin_code_receptionist").val(),
		    "gender_receptionist":$("input[id=gender_receptionist]:checked").val(),
		    "add_at_receptionist":$("#add_at_receptionist").val()
		  };
		  $.ajax({
		  type:"POST",
		  url:"PHP/register.php",
		  data: {"DATA": JSON.stringify(json_data)},
		  beforeSend:function(data){
		  	/*alert(JSON.stringify(json_data));*/
		  	alert("Sending your data!!");
		  },
		  success:function(data){
		  	alert("Registration successful!!");
		    window.location.replace("index.php");
		  	/*alert(JSON.stringify(json_data));*/
		  },
		  error:function(err){
		    alert(JSON.stringify(err));
		  }
		  });
		});
	});
</script>

<script type="text/javascript">
	//Sending book_flag pending when patient is in the Hospital Queue 
	$(document).on("click",'#setSendNextPatient',function(){
	        var nextPatientID = $("#nextPatientID").val();
	        var receptionistIDChangedStatus = $("#receptionistID").val();
	        var nextPatientToken = $("#nextPatientToken").val();
	        // alert(nextPatientID);
		  	var json_data = {
		    	"nextPatientID":nextPatientID,
		    	"nextPatientToken":nextPatientToken,
		    	"receptionistID":receptionistIDChangedStatus
		  	};
			$.ajax({
			  type:"POST",
			  url:"../PHP/receptionistAreaAPIs/setPendingByreceptionist.php",
			  data: {"DATA": JSON.stringify(json_data)},
			  beforeSend:function(data){
			  	alert(JSON.stringify(json_data));
			  	alert("Sending your data!!");
			  },
			  success:function(data){
			  	alert(data);
			  	alert("Registration successful!!");
			    // window.location.replace("index.php");
			  	// alert(JSON.stringify(json_data));
			  },
			  error:function(err){
			    alert(JSON.stringify(err));
			  }
			});
	    });
</script>

<script type="text/javascript">
$(document).ready(function(){
			$("#patientRegArea").hide();
	//Patient registration by Receptionist
	$(document).on("click",'#patientReg',function(){
			$("#patientRegArea").show();
			var hospitalidtosend = $("#hospitalIDTogetPatientDetails").val();
/*To get list of Doctors*/
			var json_data = {
			    "hospitalidtosend":hospitalidtosend
			  };
			  $.ajax({
			  type:"POST",
			  url:"../PHP/getHospitalDetails.php",
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
	    });
});
</script>
<script type="text/javascript">
	$(document).on('click','#searchHospitalNowFromReception',function(){
		if($("#searchPatientFromRec").val()!=''){
			var json_data = {
			"searchPatientText":$("#searchPatientFromRec").val(),
			"hospitalIDToGetTotalPatient":$("#hospitalIDToGetTotalPatient").val(),
			"receptionistID":$("#receptionistID").val(),
			"selectedDoctorID":$("input[name=doctorName]:checked").val()
			};
			$.ajax({
				type:"POST",
				url:"../PHP/patientReceptionist/search_token_availibility.php",
				data: {"DATA": JSON.stringify(json_data)},
			beforeSend:function(data){
				//alert(JSON.stringify(json_data));
			},
			success:function(data){
				$('#patientdetailsTest').html(data);
			},
			error:function(err){
				alert(JSON.stringify(err));
			}
			});
		}
		else{alert("Please enter a value");}
	});
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
<script type="text/javascript">
	$(document).on('click','#registerFromReceptionist',function(){
        var hospitalnametosend = $(this).data('hospitalnametosend');
        var hospitalidtosend = $(this).data('hospitalidtosend');
        var patientidtosend = $(this).data('patientidtosend');
        var doctoridtosend = $(this).data('doctoridtosend');
        var receptionistID = $(this).data('receptionistID');
        var totalpatienttosend = $(this).data('totalpatienttosend');
        var totalestimatedtime = $(this).data('totalestimatedtime');
        var patientnametosend = $(this).data('patientnametosend');
        var patientagetosend = $(this).data('patientagetosend');
        var patientcontacttosend = $(this).data('patientcontacttosend');
        var patientaddresstosend = $(this).data('patientaddresstosend');
        var patientgendertosend = $(this).data('patientgendertosend');
        var doctornametosend = $(this).data('doctornametosend');
        $('#fullnameBookByRec').html(patientnametosend);
        $('#contactBookByRec').html(patientcontacttosend);
        $('#ageBookByRec').html(patientagetosend);
        $('#addressBookByRec').html(patientaddresstosend);
        $('#genderBookByRec').html(patientgendertosend);
        $('#estimatedTimeToArrive').html(totalestimatedtime);
        $('#selectedDocBookByRec').html(doctornametosend);
        $('#tokenBookByRec').html(totalpatienttosend);
        $('#expectedTimeBookByRec').html(totalestimatedtime);

		$("#hospitalRequest").text("1. *Please bring old examination file, if you have any! ");
		$("#hospitalRequestedTime").show();
		$('#hospitalLate').text("Then time may reframe and will let you know.")
	  	$('#hospitalRequest').css('color','#ff0000');
	  	$('#hospitalRequestedTime').css('color','#ff0000');
	  	$('#hospitalLate').css('color','#ff0000');
	  	$(document).on('click','#submitDataBookToAcknowledgeByRec',function(){
			var json_data = {
				"hospitalid":hospitalidtosend,
				"patientID":patientidtosend,
				"totalestimatedtime":totalestimatedtime,
				"token_no":totalpatienttosend,
				"doctor_ID":doctoridtosend
			};
			$.ajax({
			type:"POST",
			url:"../PHP/getPatientHospital.php",
			data: {"DATA": JSON.stringify(json_data)},
			beforeSend:function(data){
				alert(JSON.stringify(json_data));
				//alert("Sending your data!!");
			},
			success:function(data){
				setTimeout(() => { alert("Your slot Booked Succesfully!!"+data['data']); }, 200);
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
	});
</script>
</body>
</html>