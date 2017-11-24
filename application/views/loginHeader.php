<?php
if(isset($_COOKIE['email']) AND isset($_COOKIE['password'])){

			$email = $_COOKIE['email'];			
			$password = $_COOKIE['password'];
} else {
	$email = '';
	$password = '';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>COACHING CENTER</title>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
 	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
	<style type="text/css">

		form {
			
			width:345px;
			padding:0 50px 10px;
			
			font-family:'Marcellus',serif;
			float:left;
			margin-top:2px
		}

		label {
			margin: 20px 5px 20px 5px;

		}

		input {
			width:100%;
			padding:5px;
			margin:6px 0 6px;
			border:none;
			box-shadow:0 0 5px
		}
		input#submit {
			margin-top:20px;
			font-size:18px;
			background:linear-gradient(#22abe9 5%,#36caf0 100%);
			border:1px solid #0F799E;
			color:#fff;
			font-weight:700;
			cursor:pointer;
			text-shadow:0 1px 0 #13506D
		}
		input#submit:hover {
			background:linear-gradient(#36caf0 5%,#22abe9 100%)
		}
		#map{
			height:500px;
			width:500px;
		}
		</style>
<!-- 			<div class="g-recaptcha" data-sitekey="6LdKIygUAAAAAAAg9c1kL7qkKSLNQ6rZlcue_P0B"></div>
 --> 			<!--CAPTCHA--> 
</head>
<body>
	<p><p>
	<?php echo validation_errors() ?>
	
	<div class="row"> 
		<div class="col-lg-12">
			<nav class="navbar navbar-inverse">
			    <div class="navbar-header">
			      <a class="navbar-brand" href="<?php echo base_url('ajaxc/login');?>">COACHING CENTER</a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="<?php echo base_url('ajaxc/login');?>" id="home">HOME</a></li>
			      <li><a href='<?php echo base_url()."ajaxc/contact" ?>' id="contactUs">CONTACT US</a></li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right" style="margin-right: 5px;">  
			      <li id="signUp">
			      	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			      		<span class="glyphicon glyphicon-user"></span>&nbsp;SIGN-UP
			      		<span class="caret"></span>
			      		<ul class="choices dropdown-menu">
			      			<li><a href="" id="1"><h5>Student</h5></a></li>
			      			<li><a href="" id="2"><h5>Admin</h5></a></li>
			      		</ul>
			      	</a>
		      	  </li>
			      <li id="login" ><a href="<?php echo base_url('ajaxc/login'); ?> "><span class="glyphicon glyphicon-log-in"></span>&nbsp;LOGIN</a></li>		      
			    </ul>

			</nav>
		</div>	
	</div>
	<div class="container">		
		<div id="signUpModel" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
		  	<div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <div class="modal-header">
				    	<button type="button" class="close" data-dismiss="modal">&times;</button>
				    	<h4 class="modal-title">Sign-Up</h4>			        
				    </div>
				    <div class="modal-body">
				    	<div>
				        	<form  class="form-horizontal" method="post" action="" id="signUpForm">				       	
									<label for="fname" class="control-label">First Name</label>
							    <div>
							    	<input type="text" name="fname" id="fname" placeholder="Enter First Name" />  
							  	</div>
							  		<label for="lname" class="control-label">Last Name</label>
							    <div>
							    	<input type="text" name="lname" id="lname" placeholder="Enter Last Name" />
							  	</div>
							  		<label for="email" class="control-label">E-mail</label>
							    <div>	
							    	<input type="email" name="email" id="email" placeholder="Enter email" />
							  	</div>
							  		<label for="mobile" class="control-label">Mobile</label>
							    <div>
							    	<input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" />
							  	</div>
							  		<label for="password" class="control-label">Password</label>
							    <div>
							    	<input type="password" name="password" id="password" placeholder="Enter Password" />
							  	</div>
							  		<label for="rPass" class="control-label">Confirm Password</label>
							    <div>
							    	<input type="password" name="rPass" id="rPass" placeholder="Re-enter Password" />
							  	</div>
							  	<div>
							  		<input type="submit" name="btnSignUp" id="btnSignUp" value="SIGN UP" />
							  	</div>							  	
							</form>
						</div>						
				    </div>
				    <div class="modal-footer">			    	
				    </div>
				</div>
			</div>
		</div>