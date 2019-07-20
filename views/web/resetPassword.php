		<div class="content">    
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>RESET PASSWORD</h4>
					<ol class="breadcrumb">
						
						<li class="active">
							<a href="#">RESET PASSWORD</a>
						</li>
						
					</ol>
				</div>
				
			</div>
			
			<div class="ibox-content one_half">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>homeweb/setPassword" >
					<div class="form-group">
						<div class="col-lg-6">
							<input type="password" name="password" id="password" class="form-control" required placeholder="ENTER PASSWORD">
						</div>								
					</div>
					<div class="form-group">
						<div class="col-lg-6">
							<input type="password" name="cpassword" id="cpassword" class="form-control" required placeholder="CONFIRM PASSWORD">
						</div>								
					</div>


					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="hidden" name="userId" id="userId" class="form-control" value="<?php echo $userId?>" required>
						</div>

					</div>
           
                   <p id="spanPass" style="display: none;color: red">Confirm Password does not match</p>             
					<?php if (!empty($errorMessage)) {
							echo $errorMessage;
						} ?>

					<div class="clear"></div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-sm btn-white submit" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
			

			
		</div>

<script type="text/javascript">
	(function ($) {


		$('form').submit(function(event){

         var pass = $('#password').val();

         var cpass = $('#cpassword').val();

         if(pass != cpass)
         {
         	alert('Password does not match');
         	event.preventDefault();
         }	
		});

	})(jQuery);
</script>		