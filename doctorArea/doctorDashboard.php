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
		$searchdoctor = $params['searchdoctor'];
		$getNextPatient = '';?>
 <body>
<div class="bg">
 	<div class="bg-color">
	<div class="row"  style="color:#fff">
		<?php		
		$queryToGetDoctorDetails = "SELECT * FROM `doctorarea` WHERE doctor_FirstName like ('%$searchdoctor%') or  doctor_LastName like ('%$searchdoctor%') or  doctor_ContactNu like ('%$searchdoctor%')";
		$result = $mysqli->query($queryToGetDoctorDetails);
		if($result->num_rows>0){
			$result = $mysqli->query($queryToGetDoctorDetails);
			while($row = $result->fetch_assoc()){
				$firstName = $row['doctor_FirstName'];
				$lastName = $row['doctor_LastName'];
				echo '<br> Dr. '.$fullName = $firstName.' '.$lastName;
				$doctorContactNumber = $row['doctor_ContactNu'];
				$doctorID = $row['doctor_ID'];
				$queryToGetDoctorHospital = "SELECT ha.hospitalName,ha.hospitalAddress
				FROM ((`doctorhospital` AS dh inner join `hospitalarea` AS ha on ha.hospitalID=dh.hospital_ID ) inner join `doctorarea` as da on dh.doctor_ID=da.doctor_ID)
				where 
				da.doctor_ContactNu='".$doctorContactNumber."' GROUP by ha.hospitalName";
				//echo $queryToGetDoctorHospital;
				$resultContactNo = $mysqli->query($queryToGetDoctorHospital);
				if($resultContactNo->num_rows>0){
					$resultContactNo = $mysqli->query($queryToGetDoctorHospital);
					while($rowContact = $resultContactNo->fetch_assoc()){
						echo '<br>'.$rowContact['hospitalName'];
						echo '<br>'.$rowContact['hospitalAddress'];
					}
				}
				echo '<br>'.$searchdoctor;
				?>
<!-- To Get patients list to be checking-->
				<div class="row"  style="color:#fff">
					<?php 
						$queryToGetCountOfPatient = "SELECT * FROM `patienthospital` as ph, `patientarea` as pa WHERE ph.doctor_ID='".$doctorID."' and ph.book_flag=1 and pa.patient_ID=ph.patient_ID ORDER BY token_no DESC";
						// echo $queryToGetCountOfPatient;
						$resultCountOfPatient = $mysqli->query($queryToGetCountOfPatient);
						$totalPatientAvailable = $resultCountOfPatient->num_rows;
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
						  	</tr>

								<?php
								if($resultCountOfPatient->num_rows>0){
								$tokenNoNext = 10000;
								$patientList = [];
								$resultCountOfPatient = $mysqli->query($queryToGetCountOfPatient);
								while($rowCountOfPatient = $resultCountOfPatient->fetch_assoc()){
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
					<?php if($totalPatientAvailable>0){?>
						<form method="post" action="../PHP/doctorAreaAPIs/setApprovalByDoctorForm.php">
							<p id="removeOnceClickOnYes">
							<input type="hidden" name="patientList[]" value="<?php print_r($patientList); ?>"></input>
							Want to allow to check-up <button href="#" class="btn btn-success" id="submitDataConfirmration" 
								data-approvedpatientlist="<?=$totalPatientAvailable?>"
								type="submit"
								>ALL <?php echo $totalPatientAvailable ;
								?></button>
							</p>
						</form>
						Next patient: <a href="" id="showpatientList" value="<?php echo $getNextPatient;?>"  class="btn btn-danger" ><?php echo $getNextPatient;?></a><br><br>
						<input type="hidden" id="nextPatientID" value="<?php echo $getNextPatientID; ?>"></input>						
						<input type="hidden" id="nextPatientToken" value="<?php echo $tokenNoNext; ?>"></input>
						<input type="hidden" id="doctorID" value="<?php echo $doctorID; ?>"></input>
						Let get in <button href="#" class="btn btn-success" id="setSendNextPatient">YES</button><br> <b style="color: orange;">OR</b><br> WAIT<a>
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
						<input type="hidden" id="nextPatientIDWait" value="<?php echo $getNextPatientID; ?>"></input>	
						<input type="hidden" id="nextPatientTokenWait" value="<?php echo $tokenNoNext; ?>"></input>
						<input type="hidden" id="doctorIDWait" value="<?php echo $doctorID; ?>"></input>
						<input class="btn btn-success" id="waitingTime" type="submit" value="Submit">
						<br><br>
					<?php }
					else{ echo "<b style='color: red;'>No patients in your hospital!</b>" ;}
					?>
				</div>
<!-- To Get Pending patients list -->
				<div class="row"  style="color:#fff">
					<?php 
						$queryToGetPendingPatient = "SELECT * FROM `patienthospital` as ph, `patientarea` as pa WHERE ph.doctor_ID='".$doctorID."' and ph.book_flag=4 and pa.patient_ID=ph.patient_ID ORDER BY token_no DESC";
						// echo $queryToGetPendingPatient;
						$resultCountOfPatientPending = $mysqli->query($queryToGetPendingPatient);
						$totalPatientPending = $resultCountOfPatientPending->num_rows;
					?>

					<div class="clearfix attop">
						<div id="right-block" class="col-sm-12" >
						Total <?php echo $totalPatientPending ;?> patient pending<br>
						<table id="hospital" >
						  	<tr>
							    <th style="font-weight: 20px; color:#fff;">Patient Name</th>
							    <th style="font-weight: 20px; color:#fff;">Age</th>		
							    <th style="font-weight: 20px; color:#fff;">Contact Number</th>
							    <th style="font-weight: 20px; color:#fff;">Pending</th>		
						  	</tr>

								<?php
								if($resultCountOfPatientPending->num_rows>0){
								$tokenNoNext = 10000;
								$patientList = [];
								$resultCountOfPatientPending = $mysqli->query($queryToGetPendingPatient);
								while($rowCountOfPatientPending = $resultCountOfPatientPending->fetch_assoc()){
									$patientFN =  $rowCountOfPatientPending['patient_FirstName'];
									$patientLN =  $rowCountOfPatientPending['patient_LastName'];
									$patientDOB =  $rowCountOfPatientPending['patient_DOB'];
									$patient_ContactNu =  $rowCountOfPatientPending['patient_ContactNu'];
									$patientAdd =  $rowCountOfPatientPending['patient_At'];
									$token_no =  $rowCountOfPatientPending['token_no'];
									$getNextPatientID =  $rowCountOfPatientPending['patient_ID'];
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
									    <td><?php echo $getReason; ?></td>
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
	<a href="index.php" class="btn btn-success" >HOME</a><br>
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
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog"> 
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Registration</h4>
			<h6>New User Registration</h6>
		  </div>
		  <div class="modal-body">
			<form role="form" id="registerform">
			  <div class="form-group">
				<label>Full Name:</label>
				<input type="text" placeholder='@Pravinkumar Raut (No middle Name please)' class="form-control" id="fullname" required="required">
			  </div><br/>
			  <div class="form-group" >
				<label>Contact No.:</label>
				<input type="text" class="form-control" placeholder="@8793236648" id="phNo" required="required">
			  </div><br/> 
		      <div class="form-group">
				<label>Aadhar Card Number:</label>
				<input type="text" class="form-control" placeholder = "@410128972860" id="aadhar">
			  </div> <br/>	
		      <div class="form-group">
				<label>DOB:</label>
				<input type="date" class="form-control" placeholder = "@28-12-1991" id="dob_doctor" required="required">
			  </div> <br/>	
		      <div class="form-group">
				<label>Address:</label>
				<input type="text" class="form-control" placeholder = "@Dewalgaon" id="add_at_doctor" required="required">
			  </div> <br/>  	
		      <div class="form-group">
				<label>Pin Code:</label>
				<input type="text" class="form-control" placeholder = "@441901" id="add_pin_code_doctor" required="required">
			  </div> <br/>   
				<label>Gender:
		      <div class="form-group">
				<input type="radio" name="gender_doctor" id="gender_doctor" value="male">Male
				<input type="radio" name="gender_doctor" id="gender_doctor" value="female">Female
			  </div> 
			  </label> <br/>  
			  <a href="#" class="btn btn-success" id="submitData">Submit</a>
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
//Update Time by Doctor when patient is in the Hospital Queue 
	$(document).on("click",'#waitingTime',function(){
	        var timeList = $("#timeList").val();
	        var nextPatientID = $("#nextPatientID").val();
	        var doctorIDChangedStatus = $("#doctorID").val();
	        var nextPatientToken = $("#nextPatientToken").val();
		  	var json_data = {
		    	"waitingTimeSetByDoctor":timeList,
		    	"nextPatientID":nextPatientID,
		    	"nextPatientToken":nextPatientToken,
		    	"doctorID":doctorIDChangedStatus
		  	};
			$.ajax({
			  type:"POST",
			  url:"../PHP/doctorAreaAPIs/setWaitingTimeByDoctor.php",
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

		//Sending book_flag Approval From Doctor to patient directly
	    $(document).on('click','#submitDataConfirmration',function(){
		  	// $('#removeOnceClickOnYes').hide();
	        var countofApprovedPatient = $(this).data('countofpatientapprovedbydoctor');
	        alert(<?php print_r($patientList) ;?>);
		  	var json_data = {
		    	"countofApprovedPatient":countofApprovedPatient
		  	};
			$.ajax({
			  type:"POST",
			  url:"../PHP/setApprovalByDoctor.php",
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
		    "dob_doctor":$("#dob_doctor").val(),
		    "add_pin_code_doctor":$("#add_pin_code_doctor").val(),
		    "gender_doctor":$("input[id=gender_doctor]:checked").val(),
		    "add_at_doctor":$("#add_at_doctor").val()
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
		
		$(document).on('click','#searchHospitalNow',function(){
		  var json_data = {
		    "searchdoctorText":$("#searchdoctorText").val() 
		  };
		  $.ajax({
		  type:"POST",
		  url:"../PHP/doctorAreaAPIs/getDoctorDetails.php",
		  data: {"DATA": JSON.stringify(json_data)},
		  beforeSend:function(data){
		    // alert(JSON.stringify(json_data));
		  },
		  success:function(data){
		  	if(data['status']=='failure'){
			  	$('#myModal').modal('show');
			  	$('#phNo').val(data['data']+" Register with new number!");
			  	$('#phNo').css('color','#f7c304');
			  	$('#phNo').css('font-weight','bold');
			  	$('#phNo').attr("disabled","disabled");
				
		    }else{
		    	alert("Checking hospital for you! ");
			    window.location.replace("searched_result.php?searchdoctor="+data['data']);
		    }

		  },
		  error:function(err){
		    //alert(JSON.stringify(err));
		  }
		  });
		});
	});
</script>

<script type="text/javascript">
//Sending book_flag pending when patient is in the Hospital Queue 
	$(document).on("click",'#setSendNextPatient',function(){
	        var nextPatientID = $("#nextPatientID").val();
	        var doctorIDChangedStatus = $("#doctorID").val();
	        var nextPatientToken = $("#nextPatientToken").val();
	        // alert(nextPatientID);
		  	var json_data = {
		    	"nextPatientID":nextPatientID,
		    	"nextPatientToken":nextPatientToken,
		    	"doctorID":doctorIDChangedStatus
		  	};
			$.ajax({
			  type:"POST",
			  url:"../PHP/doctorAreaAPIs/setPendingByDoctor.php",
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
    
  </body>
</html>