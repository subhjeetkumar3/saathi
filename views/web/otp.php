<!--    <style>
   	@media only screen and (max-width: 600px) {
   .content {
    width: auto;
    padding: 0 15px;
}

#slider2_container_{
    width: auto;
    height: 660px;
}


}
.one_half .form-control{background:#F1f1f1 !important; }

@media only screen and (min-width: 800px) {
.re_marks {margin-left: -25px !important;}}
   </style>
   


	<div id="main-content" class="container">
		<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>OTP VERIFICATION</h4>
               
            </div>
            
        </div>

        	<?php if ($this->session->flashdata('errorMessage')) {
        		echo $this->session->flashdata('errorMessage');
        	} ?>
			<div class="ibox-content">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>homeweb/otpVerify/<?php echo  $this->uri->segment(3); ?>">
				<div style="border: 1px solid   #bfbaba;border-radius: 1%;">		
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">OTP<span>*</span></label>
						 	<input type="text" name="otp" id="otp" class="form-control" required placeholder="ENTER YOUR OTP">
						 	<input type="hidden" name="rId" value="<?=$regId?>">
						 </div>
						
						</div>
						
					</div>	
				</div>        
				<div class="form-group">
					
					<div class="one_half" style="margin-right: 2%; margin-top: 20px;">
					<input type="submit" name="submit" id="submit" value="SUBMIT" class="btn btn-sm btn-primary">
				   </div>
				</div>				

				</form>
			</div>
		</div>
	</div> -->


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
			
			<div class="ibox-content one_half">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>homeweb/otpVerify/<?php echo  $this->uri->segment(3); ?>" >
					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="text" name="otp" id="otp" class="form-control" required placeholder="ENTER YOUR OTP">
						</div>
						
						<?php if ($this->session->flashdata('errorMessage')) {
							echo $this->session->flashdata('errorMessage');
						} ?>
						
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-sm btn-white submit" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
			

			
		</div>