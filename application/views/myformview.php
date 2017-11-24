

		<div id="myform" name="myform" class="container">
			<?php echo validation_errors(); ?>
				 <!-- <?php echo form_open_multipart('/myformcontroller'); ?> -->
			<form action="<?php echo base_url('myformcontroller')?>" name="myform" method="post" enctype="multipart/form-data">
				<h5>Username</h5>
				<input type="text" name="username" value="<?php echo set_value('username');?>" size="50" />
				<h5>Password</h5>
				<input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />
				<h5>Password Confirm</h5>
				<input type="text" name="passconf" size="50" /> 
				<!-- <?php echo form_password(); ?> -->
				<h5>Email Address</h5>
				<input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50" placeholder="Please Enter Email" />
				<div><input id="submit" name="submit" type="submit" value="Submit" /></div>
			</form>
		</div>
		<?php if(!validation_errors())
	{ ?>
		
		<div id="mytable" name="mytable" class="container">
			<table class="table table-responsive table-bordered">
				
	 			<thead>
	 				<tr>
	 					<th>ID</th>
	 					<th>USERNAME</th>
	 					<th>PASSWORD</th>
	 					<th>EMAIL</th>
	 					<th>ACTION</th>
	 				</tr>
	 			</thead>
	 			<tbody>
			 		<?php

			 			
							foreach($posts as  $post){ 
					?>			 			
		 				<tr>
		 					<td><?php echo $post->id; ?></td>
							<td><?php echo $post->username; ?></td>
							<td><?php echo $post->password; ?></td>
							<td><?php echo $post->email; ?></td> 
							<td> 
								<button class= "btn btn-info">
									<a href="<?php echo base_url() . "myformcontroller/update/" . $post->id; ?>">UPDATE</a>
								</button>
								<button class="btn btn-danger">
								<a href="<?php echo base_url() . "myformcontroller/delete/" . $post->id; ?>">DELETE</a>
								</button>
							</td>
						</tr>
					<?php   
						} 
					
					
					?>	
				</tbody>	 
					
			</table>
		</div>
<?php } ?>

 

