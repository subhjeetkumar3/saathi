		<div class="content">    
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>File report verification</h4>
					<ol class="breadcrumb">
						
						<li class="active">
							<a href="#">File report verification</a>
						</li>
						
					</ol>
				</div>
				
			</div>
			
			<div class="ibox-content one_half">
				<?php if($this->session->flashdata('otpMessage') || $msg)  {?>
				<h4 style="color: red;"><?php 
				 //echo $this->session->flashdata('otpMessage'); 

                echo $msg;
				?>.</h4>
				<?php }?>
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>homeweb/verifyFileReport" >
					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="text" name="otp" id="otp" class="form-control" required placeholder="ENTER YOUR OTP">
						</div>
											

						
					</div>

					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="hidden" name="reportId" id="reportId" class="form-control" value="<?php echo $reportId; ?>" required>
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