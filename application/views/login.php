<?php require 'loginHeader.php' ?> 	
		<table cellpadding="5" cellspacing="10" align="center">
		  <form method="post" action="<?php echo base_url() ?>ajaxc/login_validation">			
				<tr>
					<div class="form-group">
						<td><label>Enter email:</label></td>
						<td><input type="email" name="email" class="form-class" id="email" value="<?php echo set_value('email',$email) ?>" />
						</td>
						<span class="text-danger"><?php echo form_error('email') ?></span> 
					</div>	
				</tr>
				<tr>
					<div class="form-group">
						<td><label>Enter Password:</label></td>
						<td><input type="password" name="password" class="form-class" id="password" value="<?php echo set_value('password',$password) ?>"/></td>
						<span class="text-danger"><?php echo form_error('password') ?></span>
					</div>
				</tr>		
	 		<div id='cap'>
	 			<tr>
	 				<td></td>
	 				<td><?php echo $captcha['image'] ?></td>
	 			</tr>
	 			<tr>
	 				<td><label>Enter captcha:</label></td>
	 				<td><input type="text" name="captcha" id="captcha" /></td>
	 			</tr>	 		 				
	 		</div>
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
<?php require 'loginFooter.php' ?>