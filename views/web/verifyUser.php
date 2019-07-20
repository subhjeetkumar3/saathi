		<div class="content">    
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>OTP VERIFICATION</h4>
					<ol class="breadcrumb">
						
						<li class="active">
							<a href="#">OTP VERIFICATION</a>
						</li>
						
					</ol>
				</div>
				
			</div>

			<?php $this->session->set_userdata('temp_userId',$userId);?>
			
			<div class="ibox-content one_half">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>homeweb/verifyUser" >
					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="text" name="otp" id="otp" class="form-control" required placeholder="ENTER YOUR OTP">
						</div>
											

						
					</div>

					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="hidden" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile?>" required>
						</div>

					</div>


					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="hidden" name="userId" id="userId" class="form-control" value="<?php echo $userId?>" required>
						</div>

					</div>


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