<?php
	if(!$_SESSION['ename'] OR !$_SESSION['EmployeeID']){redirect('inventory/inController/inlogin');}
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script type="text/javascript" src="<?php echo base_url('js/jquery.3.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/bootstrap-3.3.2.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/jquery-ui.css'); ?>"></link>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/jquery-ui.structure.css'); ?>"></link>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/jquery-ui.theme.css'); ?>"></link>
	<!-- <script type="text/javascript" src="<?php echo base_url('js/bootstrap-multiselect.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/bootstrap-multiselect.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/jquery.sumoselect.min.css'); ?>"></link>
	<script type="text/javascript" src="<?php echo base_url('js/jquery.sumoselect.min.js'); ?>"></script>
</head>
<body>
	<div class="container">
	<!-- <select id="demo" multiple="multiple">
    <option value="cheese">Cheese</option>
    <option value="tomatoes">Tomatoes</option>
    <option value="mozarella">Mozzarella</option>
    <option value="mushrooms">Mushrooms</option>
    <option value="pepperoni">Pepperoni</option>
    <option value="onions">Onions</option>
</select>			 -->
		<div class="row">
			<div class="well"><h3 align="center"> ADMIN REPORT </h3></div>
			<div class="col-lg-2" style="text-align: center;">
				<img src="<?php echo base_url();?>user.jpeg" class="img-circle img-responsive">
				ADMIN
				<br />
				<button style="margin-top: 10px;"><a href="<?php echo base_url().'inventory/inController/logout'; ?>">Log Out</a></button>
			</div>
			<div class="col-lg-10">
				<div class="well">
					<h3 align="center">Report</h3>					
					<div class="row">
						<div class="col-lg-4">					
							<label>
								Choose Office Name:
							</label>
							<select name="oCode[]" id="oCode" placeholder="Select Office Address" multiple="multiple">								
			                    <?php			                    	
                                	for ($i=0; $i < count($result); $i++)
                                	{
                                    	echo "<option id=".$result[$i]->{'officeID'}." value=".$result[$i]->{'officeID'}.">".$result[$i]->{'locationName'};
                                    	echo "</option>";
                                	}
			                    ?>
							</select>
						</div>
						<div class="form-group col-lg-3">
							<label>
								Start Date:
							</label>
	            			<div class='input-group date'>	            			
	                			<input type='text' size='10' class="form-control" id="startDate" placeholder="Enter Start Date" />            		
	                		</div>
	            		</div>
	            		<div class="form-group col-lg-3">
	            			<label>
	            				End Date:
	            			</label>	
	            			<div class='input-group date'>
	                			<input type='text' size="10" class="form-control" id="endDate" placeholder="Enter End Date" />	                			
	            			</div>							
	       				</div>    										
						<input type="submit" id="check" class="btn btn-info" onclick="items()" />						
					</div>
					<div>
						<table class="table table-responsive">
							<thead>
								<th>S.No</th>
								<th>OFFICE LOCATION</th>
								<th>ITEMS</th>
								<th>CATEGORY</th>
								<th>QUANTITY</th>
								<th>CONSUMED</th>
								<th>EMPLOYEE</th>
								<th>CREATED ON</th>
								<th></th>
							</thead>
							<tbody id="show">
								
							</tbody>
						</table>
					</div>					
				</div>					
			</div>
		</div>
	</div>	
</body>
</html>
<script>
var start = 0;
var end = 0;
var office = 0;
	$(document).ready(function(){
		/* Simple BOOTSTRAP JQUERY MULTISELECT
			$('#officeLocation').multiselect({
			nonSelectedText: 'none selected',
			selectAllValue: 'multiselect-all',
			enableFiltering: true
		});*/
		//using SUMOSELECT;
		$('#oCode').SumoSelect({okCancelInMulti: true,selectAll: true});
      	$('.btnOk').on('click', function() {
		    var obj = [],
		        items = '';
		    $('#oCode option:selected').each(function(i) {
		      obj.push($(this).val());
		     /* $('#oCode')[0].sumo.unSelectItem(i);*/
		    });
		    office = obj;
		    /*alert(office);*/		    
		    /*for (var i = 0; i < obj.length; i++) {
		      items += ' ' + obj[i] 
		    };*/
		    //alert(jQuery.type(obj));
		});	

		$('#startDate').datepicker({dateFormat: 'yy-mm-dd '});
	    $('#endDate').datepicker({dateFormat: 'yy-mm-dd'});

	    $('#startDate').datepicker("option", "onSelect", function(){
	    	start = $(this).datepicker().val();	    	
	    });
        
        $('#endDate').datepicker("option", "onSelect", function(){
	    	end = $(this).datepicker().val();	    	
	    });

        /*$('#oCode').on('change',function(){
        	office = $('#oCode option:selected').attr('id');        	        	
        });*/

       

       
    });

	/*function startDate(item){		
		var start = $(item).datepicker("option","onSelect",fun)
		$('#datepicker').datepicker("option", "onSelect", function(){alert('hi')});
		alert(start);		
	}

	function endDate(item){		
		var end = $(item).val();
		alert(end);		
	}*/

    function items(){			
    	$.ajax({
    		data: {'office': office,'start':start,'end':end},
    		url: '<?php echo base_url();?>inventory/inController/stock',
    		type: "get",
    		success: function(data){
    			var html="";
    			/*alert(data);*/
    			data = JSON.parse(data);
    			   			
    			/*alert(data.length);*/
    			if(data.length == 0){
    				$('#show').text('No Records Found!!');
    			}else{
    				$.each(data, function(i, key){
    				/*alert(key.createdOn);*/  					
 						 html += '<tr>'+
    									'<td>'+parseInt(parseInt(i)+1)+'</td>'+
    									'<td>'+key.locationName+'</td>'+
    									'<td>'+key.itemName+'</td>'+
    									'<td>'+key.categoryName+'</td>'+
    									'<td>'+key.quantity+'</td>'+
    									'<td>'+key.consumed+'</td>'+
    									'<td>'+key.EmployeeName+'</td>'+
    									'<td>'+key.createdOn+'</td>'+
    							'</tr>';
    					   					
    					
    				});    				
    				$('#show').html(html);		
    			}
    		},
    		error: function(){
    			alert('fail');
    		}
    	});
    }  
</script>