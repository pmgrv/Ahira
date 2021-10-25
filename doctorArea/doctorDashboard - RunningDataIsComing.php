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
	</style>
  </head>
 <body>
<div class="bg">
 <div class="bg-color">
	<div class="row"  style="color:#fff">
		I will serve 24x7<br>
		<?php 
		include('../PHP/dbconfig.php');
		 	$url = $_SERVER['REQUEST_URI'];
		$url_components = parse_url($url);
		parse_str($url_components['query'],$params);
		$searchdoctor = $params['searchdoctor'];

		$queryToGetDoctorDetails = "SELECT * FROM `doctorarea` WHERE doctor_FirstName like ('%$searchdoctor%') or  doctor_LastName like ('%$searchdoctor%') or  doctor_ContactNu like ('%$searchdoctor%')";
		$result = $mysqli->query($queryToGetDoctorDetails);
		if($result->num_rows>0){
			$result = $mysqli->query($queryToGetDoctorDetails);
			while($row = $result->fetch_assoc()){
				$firstName = $row['doctor_FirstName'];
				$lastName = $row['doctor_LastName'];
				echo '<br>'.$fullName = $firstName.' '.$lastName;
				$doctorContactNumber = $row['doctor_ContactNu'];
				$doctorID = $row['doctor_ID'];
				$queryToGetDoctorHospital = "SELECT ha.hospitalName,ha.hospitalAddress
				FROM ((`hospitalarea` AS ha
				inner join `doctorhospital` AS dh on ha.hospitalID=dh.hospital_ID )
				inner join  `doctorarea` as da on ha.hospitalID=da.doctor_ID)
				where 
				da.doctor_ContactNu='".$doctorContactNumber."' GROUP by ha.hospitalName";
				$resultContactNo = $mysqli->query($queryToGetDoctorHospital);
				if($resultContactNo->num_rows>0){
					$resultContactNo = $mysqli->query($queryToGetDoctorHospital);
					while($rowContact = $resultContactNo->fetch_assoc()){
						echo '<br>'.$rowContact['hospitalName'];
						echo '<br>'.$rowContact['hospitalAddress'];
				}}
				echo '<br>'.$searchdoctor;
				?>
				<div class="row"  style="color:#fff">
					<?php 
						$queryToGetCountOfPatient = "SELECT * FROM `patienthospital` as ph, `patientarea` as pa WHERE ph.doctor_ID='".$doctorID."' and ph.book_flag=1 and pa.patient_ID=ph.patient_ID";
						$resultCountOfPatient = $mysqli->query($queryToGetCountOfPatient);
						$totalPatientAvailable = $resultCountOfPatient->num_rows;
						?>

						<div class="clearfix attop">
							<div id="right-block" class="col-sm-12" >
							<table>
							  	<tr>
								    <th style="font-weight: 20px; color:#fff;">Hospital Name</th>
								    <th style="font-weight: 20px; color:#fff;">Patient Name</th>
								    <th style="font-weight: 20px; color:#fff;">Age</th>					    
								    <th style="font-weight: 20px; color:#fff;">Address</th>					    
								    <th style="font-weight: 20px; color:#fff;">Blood Group</th>
							  	</tr>

							<?php
							if($resultCountOfPatient->num_rows>0){
							$resultCountOfPatient = $mysqli->query($queryToGetCountOfPatient);
							while($rowCountOfPatient = $resultCountOfPatient->fetch_assoc()){
								$patientFN =  $rowCountOfPatient['patient_FirstName'];
								$patientLN =  $rowCountOfPatient['patient_LastName'];
								$patientDOB =  $rowCountOfPatient['patient_DOB'];
								$patientAdd =  $rowCountOfPatient['patient_At'];

								$patientFullName = $patientFN.' '.$patientLN;
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
								    <td>O+
								    </td>
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
					Total <?php echo $totalPatientAvailable ;?> patient are in the QUEUE<br>
					Want to allow to check-up <a href="#" class="btn btn-success" id="submitDataBookToAcknowledge">ALL <?php echo $totalPatientAvailable ;?></a><br><br>
					

					Let get in next patient <a href="#" class="btn btn-success" id="submitDataBookToAcknowledge">YES</a> or <a href="#" class="btn btn-success" id="submitDataBookToAcknowledge">WAIT 5 MINUTES</a><br><br>
				</div>
				<div class="row"  style="color:#fff">
					HISTORY
					<p>Total patients checked in the last WEEK : <b>300</b> <t>FREE: <b>5</b> PAID: <b>345</b></t></p>
					<p>Today 20 patients checked successfully! and <?php echo $totalPatientAvailable ;?> are in the QUEUE</p>
					<p>Yesterday, 30 patients have been checked successfully in 8 hours</p>
					<p>On dated 28-10-2021 Tuesday 45 patienced have bee checked in 9 hours</p>
				</div>
				<?php

			}
		}

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
	$(document).ready(function(){
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