


		<div class="content">    
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>Forgot Password</h4>
					<!--<ol class="breadcrumb">
						
						<li class="active">
							<a href="#">Forget Password</a>
						</li>
						
					</ol>-->
				</div>
				
			</div>
			
			<div class="ibox-content one_half">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>homeweb/checkUser" >
					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="text" maxlength="10" name="username" id="username" class="form-control" required placeholder="ENTER YOUR USER NAME">
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