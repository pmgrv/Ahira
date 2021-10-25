<!DOCTYPE html>
<html>
  <head>    
    <meta charset="UTF-8">
    <title>ServiceBoxx</title>
    <meta name="description" content="">
 
    
    <!-- Mobile Specific Meta -->   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

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

	<!--[if IE 9]> 
    	<link rel="stylesheet" href="assets/css/ie9.css">
    <![endif]-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
	  #contact_details {
	  	width: 100%;
	  }
	  #education_details{
	  	width: 100%;
	  }
	  #work_details{
	  	width: 100%;
	  }
	  #exp_work_details{
	  	width: 100%;
	  }
	  .border_row{
	  	border-style: solid;
	  }
	</style>
	
  </head>
 <body>
 <div class="bg"> 
	 <div class="bg-color">
		  	<div class="container content">
				<div class="row">
					<div class="sun clearfix">
						<div class="col-sm-12">
						   <h1>Register Now</h1>
						  	<form role="form" id="registerform" onsubmit="return false;">
						  		<div class="form-group col-md-12" >
						  			<a href="#" class="btn btn-default " id="contact_details">Contact Details</a>
						  		</div>
						  		<div class="form-group col-md-12" >
						  			<a href="#" class="btn btn-default " id="education_details">Education Details</a>
						  		</div>
						  		<div class="form-group col-md-12" >
						  			<a href="#" class="btn btn-default " id="work_details">Work Details</a>
						  		</div>
						  		<div class="form-group col-md-12" >
						  			<a href="#" class="btn btn-default " id="exp_work_details"> Expected Work Area </a>
						  		</div>
						  		<div id="contact_details_toggle">
						  			  	
									  
									  	<div class="col-md-12">
										  	<div class="col-md-6">
											  <div class="form-group">
												<label style="color:white">Full Name<span class="mandatory" style="color:red">*</span>:</label>
												<input type="text" id="full_name" class="form-control" placeholder = "@Pravinkumar Raut" id="name" required="required">
											  </div>		
										  	</div>
										  	<div class="col-md-6">
											  	<div class="form-group">
													<label style="color:white">Email<span class="mandatory" style="color:red">*</span>:</label>
													<input type="email" id="email_id" class="form-control" placeholder = "@paraut5@gmail.com" required="required">
											  	</div></br>
										  	</div>
									  	</div>
									  	<div class="col-md-12">
										  	<div class="col-md-6">
											  <div class="form-group">
												<label style="color:white">Aadhar Card No<span class="mandatory" style="color:red">*</span>:</label>
												<input type="text" class="form-control" placeholder = "@410128972860" id="aadhar_card" required="required">
											  </div>		
										  	</div>
										  	<div class="col-md-6">
											  	<div class="form-group">
													<label style="color:white">Date Of Birth<span class="mandatory" style="color:red">*</span>:</label>
													<input type="date" class="form-control" id="date_birth" placeholder="@1991-12-28" required="required">
											  	</div></br>
										  	</div>
										  	
									  	</div>
									 	<div class="col-md-12">
						  			  		
						  			  		<div class="col-md-6">
									  			<div class="form-group">
													<label style="color:white">Gender:</label>

													<label ><!-- class="Gender" -->
													    <input type="radio" name="gender"  value="male" checked/>
													    <span style="color:#F5F5F5">Male</span>
													</label></br></br>
													<label  style="color:#F5F5F5; margin-left:163px"><!-- class="Gender" -->
													    <input type="radio" name="gender" value="female" />
													    <span>Female</span>
													</label>
												</div></br></br>
						  			  		</div>
						  			  		<div class="col-md-6">
								  			  <div class="form-group">
												<label style="color:white">Mobile No<span class="mandatory" style="color:red">*</span>:</label>
												<input type="text" class="form-control" placeholder="@8793236648" id="phNo" required="required">
												<input type="checkbox" class="form-control" id="phNo_wa" value="checked" >
												
												<span style="color:#F5F5F5">WhatsApp(Check it):</span>
											  </div>
						  			  		</div>
						  			  	</div>
									 
								      	<div class="form-group col-md-12 border_row" >
								  			<a href="#" class="btn btn-default " id="next_education_details">Next</a>
								  		</div>

									  
						  		</div>
							 	 

						  		<div id="education_details_toggle">
							  		<div class="col-md-12">
							  			<div class="form-group">
											<label style="color:white">Cources:</label>
											<input type="text" placeholder = "@B.Tech, MBBS, B.Arch, B.A, BSW, D.Ed etc." class="form-control" id="cources_edu">
										</div> <br/>
							  		</div>
							  		<div class="col-md-12">
										<div class="form-group">
											<label style="color:white">University/ Intstitute:</label>
											<input type="text" placeholder="@VNIT Nagpur, Nagpur University, Nanded University etc." class="form-control" id="university">
										</div> <br/>		
							  			<div class="form-group col-md-12 border_row" >
								  			<a href="#" class="btn btn-default " id="next_work_details">Next</a>
								  		</div>
							  		</div>
						  		</div> 

						  		<div id="work_details_toggle">
						  			<div class="col-md-12">
						  			<div class="form-group">
										<label style="color:white">Specifications:</label>
										<input type="text" placeholder = "@Driver, Carpenter, Teacher etc." class="form-control" id="specification">
									</div> <br/>	
						  			</div>
						  			<div class="col-md-12">
						  			<div class="form-group">
										<label style="color:white">Skills:</label>
										<input type="text" placeholder="@Carpenter, Driver, Nangarwala, Typing etc." class="form-control" id="skills">
									</div> <br/>			
						  			</div>
						  			<div class="col-md-12">
						  			<div class="form-group">
										<label style="color:white">Project(If any):</label>
										<input type="text" placeholder="@Education, Workshop, Campaign, Product etc." class="form-control" id="project_done">
									</div> <br/>			
						  			</div>
						  			
									<div class="form-group col-md-12 border_row" >
							  			<a href="#" class="btn btn-default " id="next_exp_work_details">Next</a>
							  		</div>
									
						  		</div> 

						  		<div id="exp_work_details_toggle">
							  		<div class="col-md-12">
							  			<div class="form-group">
											<label style="color:white">Education:</label>
											<input type="text" placeholder = "@Science, Art, Commerce,  etc." class="form-control" id="exp_education">
										</div> <br/>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="form-group">
											<label style="color:white">Social Work:</label>
											<input type="text" placeholder="@Law, Transport, Engineer, Doctor etc." class="form-control" id="exp_social">
										</div> <br/>		
							  		</div>
						  		</div>
							  			<a><span class="mandatory" style="color:red">*</span>Mandatory Fields</a>

						  		<div class="col-md-12">
							  		<div class="col-md-6">
							  			<button type="button" class="btn btn-default pull-right" id="submitData_edu">Submit</button>
							  		</div>		
							  		<div class="col-md-6">
							  			<a href="index.php" class="btn btn-default" id="#">Home</a><br/>			
							  		</div>
						  		</div>
								
								
							</form>
						</div>
						<div id="right-block" class="col-sm-8">
							                
							<p class="followus "></p>
							<ul class="social-icon pull-right" style="margin-top: -42px;">
								<li><a href="https://www.facebook.com/serviceboxx?fref=ts"><i class="fa fa-facebook"></i></a></li>
								<div class="col-md-12 col-sm-12" style="color:white" >
				 					 Call ( 24x7 ) on: +91-940-314-8108, +91-879-323-6648
				 				</div>
							</ul>              
						</div>
					</div>
				</div>
			</div>
	 </div>
 </div>
   
</body>    
  
</html>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/TimeCircles.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery.placeholder.js"></script>
    

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
		$(document).ready(function(){
			$("#next_education_details").click(function(){
				var full_name= $('#full_name').val();
			  	var email_id= $('#email_id').val();
			  	var date_birth= $('#date_birth').val();
			  	var aadhar_card = $('#aadhar_card').val();
			  	var gender = $('input[name=gender]:checked').val();
			  	var phNo = $('#phNo').val();

				document.getElementById("next_education_details").style.background='#c1ffc1';
				if(full_name!="" && email_id != "" && date_birth != "" && aadhar_card != "" && gender != "" && phNo != ""  ){
					// alert("I m in goodway"+ full_name);

					/*$("#next_education_details").click(function(){*/
						document.getElementById("contact_details").style.background='#c1ffc1';
						document.getElementById("education_details").style.background='#ffffff';
						$("#contact_details_toggle").hide();
		                $("#education_details_toggle").show();
		                $("#work_details_toggle").hide();
						$("#exp_work_details_toggle").hide();
					// });
				}
				else{
					// $("#next_education_details").click(function(){
					document.getElementById("next_education_details").style.background='#FFC1C1';
					alert("Please fill all mandatory fields.");
				/*alert('Fname-->'+full_name+'<-Email->'+email_id+'<-Dob->'+date_birth+'<-aadhar_card->'+aadhar_card+'<--gender-->'+gender+'<--PNW--->'+phNo_wa);

					});*/
				}
			});

			$("#next_work_details").click(function(){
				document.getElementById("contact_details").style.background='#c1ffc1';
				document.getElementById("education_details").style.background='#c1ffc1';
				document.getElementById("work_details").style.background='#ffffff';
				$("#contact_details_toggle").hide();
                $("#education_details_toggle").hide();
                $("#work_details_toggle").show();
				$("#exp_work_details_toggle").hide();
			});

			$("#next_exp_work_details").click(function(){
				document.getElementById("contact_details").style.background='#c1ffc1';
				document.getElementById("education_details").style.background='#c1ffc1';
				document.getElementById("work_details").style.background='#c1ffc1';
				document.getElementById("exp_work_details").style.background='#ffffff';
				document.getElementById("submitData_edu").style.background='#75FF75';
				$("#contact_details_toggle").hide();
                $("#education_details_toggle").hide();
                $("#work_details_toggle").hide();
				$("#exp_work_details_toggle").toggle();
			});

			$("#education_details_toggle").hide();
			$("#work_details_toggle").hide();
			$("#exp_work_details_toggle").hide();
			document.getElementById("education_details").style.background='#FFC1C1';
			document.getElementById("work_details").style.background='#FFC1C1';
			document.getElementById("exp_work_details").style.background='#FFC1C1';

            $("#contact_details").click(function(){
				// document.getElementById("contact_details").style.background='#c1ffc1';
                $("#contact_details_toggle").show();
                $("#education_details_toggle").hide();
                $("#work_details_toggle").hide();
				$("#exp_work_details_toggle").hide();
            });

            $("#education_details").click(function(){
                $("#contact_details_toggle").hide();
                $("#education_details_toggle").show();
                $("#work_details_toggle").hide();
				$("#exp_work_details_toggle").hide();

            });
            $("#work_details").click(function(){
                $("#contact_details_toggle").hide();
                $("#education_details_toggle").hide();
                $("#work_details_toggle").show();
				$("#exp_work_details_toggle").hide();

            });
            $("#exp_work_details").click(function(){
                $("#contact_details_toggle").hide();
                $("#education_details_toggle").hide();
                $("#work_details_toggle").hide();
				$("#exp_work_details_toggle").show();

            });

        
 });
           
	</script>
	<script type="text/javascript">
    	$(function() {
				// Invoke the plugin
				$('input, textarea').placeholder();
			});

			$(document).ready(function(){
			    $(document).on('click','#submitData_edu',function(){
				  // alert("hey");;
				  var full_name= $('#full_name').val();
				  var email_id= $('#email_id').val();
				  var date_birth= $('#date_birth').val();
				  var aadhar_card = $('#aadhar_card').val();
				  var gender = $('input[name=gender]:checked').val();
				  var phNo = $('#phNo').val();
				  var phNo_wa = $('#phNo_wa:checked').val();



				  var cources_edu = $('#cources_edu').val();
				  var university = $('#university').val();

				  var specification = $('#specification').val();
				  var skills = $('#skills').val();
				  var project_done = $('#project_done').val();

				  var exp_education = $('#exp_education').val();
				  var exp_social = $('#exp_social').val();


				  // alert("CE"+cources_edu+"university"+university);
				  // alert("specification"+specification+"skills"+skills+"project_done"+project_done);
				  // alert("exp_education"+exp_education+"exp_social"+exp_social);
				  //alert('Fn-->'+full_name+'<--gender-->'+gender+'<--PNW--->'+phNo_wa);
				  

				  /*if(full_name!="" && email_id != "" && date_birth != "" && aadhar_card != "" && gender != "" && phNo != ""  ){
				  	alert("I m in goodway"+ full_name);
				  }*/
				  if(full_name!="" && email_id != "" && date_birth != "" && aadhar_card != "" && phNo != "" ){
				  var json_data = {
				    "full_name":$('#full_name').val(),
				    "email_id":$('#email_id').val(),
				    "date_birth":$('#date_birth').val(),
				    "aadhar_card":$('#aadhar_card').val(),

				    "gender":$('input[name=gender]:checked').val(),
				    "phNo":$('#phNo').val(),
				    "phNo_wa":$('#phNo_wa:checked').val(),

				    "cources_edu":$('#cources_edu').val(),
				    "university":$('#university').val(),

				    "specification":$('#specification').val(),
				    "skills":$('#skills').val(),
				    "project_done":$('#project_done').val(),

				    "exp_education":$('#exp_education').val(),
				    "exp_social":$('#exp_social').val()

				  };
				  
				  $.ajax({
					  type:"POST",
					  url:"PHP/register_high_edu.php",
					  data: {"DATA": JSON.stringify(json_data)},
					  // data:formData,
					  beforeSend:function(data){
					   // alert(JSON.stringify(json_data));
					  },
					  success:function(data){
					  	alert(data);
					  	// if(success.data == "succ"){
					  	alert("Registration successful!!");
				    	window.location.replace("index.php");
					    // window.location.replace("index.php");
						// }
					  },
					  error:function(err){
					     alert(JSON.stringify(err));
					  }
				  });

				}
				else
				{
					alert("Please fill all mandatory fields")
				}
				});
				
			});
    </script>
    
