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
	</style>
  </head>
 <body>
 <div class="bg">
	 <div class="bg-color">
		  <div class="container content">
	 			
				<div class="row">
					
					<div class="sun clearfix">
						<div class="col-md-12 col-sm-12"  style="color:#fff">
		 					 I will serve 24x7
		 				</div>
						<div class="col-sm-12">
						   <h1 >ServiceBoxx</h1>  
						  
						</div>
						
						<div id="left-block" class="col-sm-12 text-center">
						     <a href="#" id="registerbutton" data-toggle="modal" data-target="#myModal" class="btn  btn-success">Receptionist Area</a>
						</div>
						<div id="right-block" class="col-sm-12">
							<div class="row">
							  <div class="col-sm-offset-2 col-sm-8">
								<p class="alert-success"></p>
								<p class="alert-warning"></p>
								<form class="newsletter-signup" role="form">
								  <div class="input-group">
									<input style="color:#000" type="text" placeholder="@9403148108" class="form-control" id="searchreceptionist" placeholder="contact@yourdomain.com" required>
									<span class="input-group-btn">
									  <a href="#" id="searchHospitalNow" class="btn btn-default btn-sand">CHECK</a>
									</span>
								  </div><!-- /input-group -->
								</form>
							  </div>
							</div>                    
							<p class="followus"></p>
							<ul class="social-icon" style="margin-top: -42px;">
								<li><a href="#"><i class="fa fa-camera-retro"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube-square"></i></a></li>
							</ul>              
						</div>
					</div>
				</div>
			</div>
			<!-- .container end here -->
	 </div>
 </div>
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
				<input type="date" class="form-control" placeholder = "@28-12-1991" id="dob_receptionist" required="required">
			  </div> <br/>	
		      <div class="form-group">
				<label>Address:</label>
				<input type="text" class="form-control" placeholder = "@Dewalgaon" id="add_at_receptionist" required="required">
			  </div> <br/>  	
		      <div class="form-group">
				<label>Pin Code:</label>
				<input type="text" class="form-control" placeholder = "@441901" id="add_pin_code_receptionist" required="required">
			  </div> <br/>   
				<label>Gender:
		      <div class="form-group">
				<input type="radio" name="gender_receptionist" id="gender_receptionist" value="male">Male
				<input type="radio" name="gender_receptionist" id="gender_receptionist" value="female">Female
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
		
		$(document).on('click','#searchHospitalNow',function(){
		  var json_data = {
		    "searchreceptionist":$("#searchreceptionist").val() 
		  };
		  $.ajax({
		  type:"POST",
		  url:"../PHP/receptionistAreaAPIs/getreceptionistDetails.php",
		  data: {"DATA": JSON.stringify(json_data)},
		  beforeSend:function(data){
		    //alert(JSON.stringify(json_data));
		  },
		  success:function(data){
		  	//alert(data['data']);
		  	if(data['status']=='failure'){
			  	$('#myModal').modal('show');
			  	$('#phNo').val(data['data']+" Register with new number!");
			  	$('#phNo').css('color','#f7c304');
			  	$('#phNo').css('font-weight','bold');
			  	$('#phNo').attr("disabled","disabled");
				
		    }else{
		    	alert("Logging inside");
			    window.location.replace("receptionistDashboard.php?searchreceptionist="+data['data']);
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