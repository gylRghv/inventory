<?php
if(isset($_COOKIE['ename']) AND isset($_COOKIE['code'])){

			$ename = $_COOKIE['ename'];			
			$code = $_COOKIE['code'];
} else {
	$ename = '';
	$code = '';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
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
		table {
		    width: 40%;
		    margin-left: auto;
		    margin-right: auto;
		}
		
		</style>
	</head>
	<body background='<?php echo base_url() ?>login.jpg'>
		<div class="container">		
		<table cellpadding="5" cellspacing="10" align="center" style=" margin-top: 150px;">
		  <form style="border:1px solid #000;" method="post" action="<?php echo base_url('inventory/inController/dash')?>">			
				<tr>
					<div class="form-group">
						<td style="width: 150px;"><label>Employee Name:</label></td>
						<td><input type="ename" name="ename" class="form-class" id="ename" value="<?php echo set_value('ename',$ename) ?>" />
						</td>
						<span class="text-danger"><?php echo form_error('ename') ?></span> 
					</div>	
				</tr>
				<tr>
					<div class="form-group">
						<td><label>Enter Employee Code:</label></td>
						<td><input type="text" name="code" class="form-class" id="code" value="<?php echo set_value('code',$code) ?>"/></td>
						<span class="text-danger"><?php echo form_error('code') ?></span>
					</div>
				</tr>
		 	<div id="remember">
			 	<tr>
		 			<!-- <td><label>Remember me</label></td>	 --> 			
		 			<td colspan="2" align="right">
					<input type="checkbox" name="remember" style="width:4%;
														padding:5px;
														margin:0px;
														border:none;
														box-shadow: none">Remember</input>								
					</td>	 			
		 		</tr>
	 		</div>		 			
	 			<tr>
					<div class="form-group">				
						<td></td>
						<td><input type="submit" name="login" value="LOGIN" class="form-class" /></td>
						<?php echo $this->session->flashdata("error"); ?>					
					</div>
				</tr>			
		  </form>
		</table>
		</div>			
	</body>	
</html>	