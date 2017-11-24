<h3 class="navbar navbar-default" style="text-align: center; margin-top:0px;
padding-top: 10px;">Student List</h3>
<div class="container">	
	<div>
		<button type="button" id="btnAdd" class="btn btn-success" >
			<h4>Add New</h4>
		</button>

	
		<table class="table table-responsive table-bordered" style= "margin-top:20px">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Country</th>
					<th>State</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="show">	
			</tbody>
		</table>
		<div id="pagination"> 			
		</div>		
	</div>
</div>
<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		    	<h4 class="modal-title">Employee Form</h4>			        
		    </div>
		    <div class="modal-body">
		    	<div>
		        	<form method="post" action="" id="myform">
		        		<input type="hidden" name="id" id="id" value="0" />
						<label for="name">Name</label>
					    <div><input type="text" name="name" id="name" placeholder="Enter Name" />
					  	</div>
					  	<div class="form-group">
						    <label for="address">Address</label><br>
						    <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Address"></textarea>
					  	</div>						  	
			            <div class="form-group">
			                <label for="country_name">Select Country:</label>
			                <select name="country_name" id="country_name" class="form-control country">
			                    <option value="">--- Select Country ---</option>
			                    <?php
			                        foreach ($country as $value) {
			                            echo "<option value='".$value->country_id."'>".$value->country_name."</option>";
			                        }
			                    ?>
			                </select>
			            </div>
			            <div class="form-group">
			                <label for="state_name">Select State </label>
			                <select name="state_name" id="state_name" class="form-control state">
			                <option value="">Select State</option>
			                </select>
			            </div>
					  	<button name="btnSave" id="btnSave" class="btn btn-primary">Save</button>
					</form>
				</div>						
		    </div>
		    <div class="modal-footer">			    	
		    </div>
		</div>
	</div>
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		    	<h4 class="modal-title">DELETE</h4>
		        
		    </div>
		    <div class="modal-body">
		    	<p>ARE YOU SURE ?</p>			        				
		    </div>
		    <div class="modal-footer">
	         	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
	         	<button type="button" class="btn btn-danger" id="btn-delete">DELETE</button> 
	        </div>
		</div>
	</div>
</div>	

<script>
	$(document).ready(function(){		
		showAllData();		
		function showAllData()
		{
			$.ajax({
				url: '<?php echo base_url(); ?>ajaxc/showAllData',
				datatype: 'json',		
				success: function(data)
				{ 
					var html="";
					data = JSON.parse(data);					
					$.each(data.records, function(i, item) {
						html+= '<tr>'+
								'<td>'+item.id+'</td>'+
								'<td>'+item.name+'</td>'+
								'<td>'+item.address+'</td>'+
								'<td>'+item.country_name+'</td>'+
								'<td>'+item.state_name+'</td>'+
								'<td>'+
									'<a href="javascript:;" class="btn btn-info item-edit" data="'+item.id+'">EDIT</a>'+" "+
									'<a href="javascript:;" class="btn btn-danger item-delete" data="'+item.id+'">DELETE</a>'+
								'</td>'+
								'</tr>'
					});
					$("#show").html(html);
					$('#pagination').html(<?php echo "data.pagination" ?>);
				},
				error: function()
				{
					alert('...Cannot Not Display...');
				}
			});
		}

		$('#btnAdd').on('click',function(){			
			$('#mymodal').modal('show');
			$('#myform').attr('action','<?php echo base_url() ?>ajaxc/insertData');
		});
		
		$('.country').on('change',function(){
		var country_id = $(this).val();
		if(country_id== ''){
			$('select.state').prop('disabled',true);
		}else{
			$('select.state').prop('disabled',false);
			$.ajax({
				type: "POST",
				url: '<?php echo base_url() ?>ajaxc/getState',
				data: {'country_id' : country_id},
				datatype: 'html', 
				success: function(data){
					$('.state').html(data);
				},
				error: function(){
					alert('...error...');
				}
			});

			}	
		});		

		$('#myform').on('submit',function(event){
			event.preventDefault();
			var data = $("#myform").serialize();	           	
	    	var url = $("#myform").attr('action'); 
			$.ajax({				
				data: data,
				method: 'post',
				url: url,			
				dataType: 'json',				
				success: function(response){ 
					if(response.success){ 
					alert("Added data successfully");	
					$('#mymodal').modal('hide');
					showAllData();}
				},
				error: function(){
					alert("Data not added! ");
					$('#mymodal').modal('hide');	
					showAllData();
				}
			});
			$('#myform')[0].reset();
		});

		$('#show').on('click','.item-edit',function(event){	
			event.preventDefault();			
				var id = $(this).attr('data');
				$.ajax({				
					type: 'get',
					url: '<?php echo base_url(); ?>ajaxc/edit',			
					dataType: 'json',
					data: {id:id},				
					success: function(data){ 
						$('#mymodal').modal('show');
						$('#mymodal').find('.modal-title').text('Edit Employee Details');
						$('#myform').attr('action','<?php echo base_url() ?>ajaxc/editData');
						$.each(data, function(i,item){					
							$('#id').val(item.id);
							$('#name').val(item.name);
							$('#address').val(item.address);

							$('#country_name').val(item.country_name);
							$('#state_name').val(item.state_name);
						});
					},
					error: function(){
	 					alert("Data not added! ");					
					}
			});	
		
		});

		$('#show').on('click','.item-delete',function(){
			var id = $(this).attr('data');
			$('#deleteModal').modal('show');
			$('#btn-delete').on('click',function(event){
				
				$.ajax({									
					method:'get',
					url: '<?php echo base_url(); ?>ajaxc/deleteData',
					dataType: 'json',
					data: {id:id},				
					success: function(response){
						if(response.success){
							$('#deleteModal').modal('hide');							
							showAllData();
						}
					},
					error: function(){
						alert("...Could Not Delete...");	
						$('#deleteModal').modal('hide');
						showAllData();
					}
				});
			});
		});

		/*$('#links').on('click',function(){
			$(this).show('50000000000');
		});*/
		
	});	
</script>   