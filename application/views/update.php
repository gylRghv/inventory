
	
	<h2>FORM UPDATE:</h2>
		<div class="container">
			<?php echo validation_errors(); ?>

		
				 <!-- <?php echo form_open_multipart('/myformcontroller'); ?> -->
			<form action="<?php echo base_url('myformcontroller/update'); ?>" method="post" enctype="multipart/form-data">

				<input type="hidden" name="hidden" value="<?php echo $posts->id; ?>"> 
				<h5>Username</h5>
				<input type="text" name="username1" value="<?php echo $posts->username; ?>" size="50" />
				<h5>Password</h5>
				<input type="text" name="password1" value="<?php echo $posts->password; ?>" size="50" />
				<h5>Password Confirm</h5>
				<input type="text" name="passconf1" size="50" /> 
				<!-- <?php echo form_password(); ?> -->
				<h5>Email Address</h5>
				<input type="email" name="email1" value="<?php echo $posts->email; ?>" size="50" placeholder="Please Enter Email" />
				
				<!-- <?php

					$data = array(
						'type' => 'file',
						'name' => 'image'

					);
					 echo form_upload($data);

				?> -->
				<div><input id="update" name="update" type="submit" value="UPDATE" class="btn btn-primary" /></div>
			</form>
		</div>
