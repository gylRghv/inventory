<script>
	$(document).ready(function(){


		$('.choices').on('click',function(){
				event.preventDefault();			
				$('#signUpModel').modal('show');
				$('#signUpForm').attr('action','<?php echo base_url() ?>ajaxc/signUp?id=');
			});
		$('#signUpForm').on('submit',function(event){
			event.preventDefault();
			var data = $("#signUpForm").serialize();	           	
	    	var url = $("#signUpForm").attr('action'); 
			$.ajax({				
				data: data,
				method: 'post',
				url: url,			
				dataType: 'json',				
				success: function(response){ 
					if(response.success){ 
					alert("Added data successfully");	
					$('#signUpModel').modal('hide');
					}
				},
				error: function(){
					alert("Data not added! ");
					$('#signUpModel').modal('hide');	
					
				}
			});
			$('#signUpForm')[0].reset();
		});
	});		

</script>