    <!-- Page Content 
	<div id="main-content" class="container">-->
		<div class="content">    
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>LOGIN</h4>
					<!--<ol class="breadcrumb">
						
						<li class="active">
							<a href="#">LOGIN</a>
						</li>
						
					</ol>-->
				</div>
				
			</div>
			
			<div class="ibox-content one_half">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/homeweb/login/<?php echo $serviceProviderId; ?>/<?php echo $quizId?>">
					<div class="form-group">
						
						<div class="col-lg-6">
							<input type="text" name="userName" placeholder="UserName" class="form-control" required> 
						</div>
						<div class="col-lg-6">
							<input type="password" name="password" placeholder="Password" class="form-control" required> 
						</div>
						<?php
							if (!empty($msg)){
								echo $msg;								
							} 
						?>
						
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-sm btn-white submit" type="submit">Login</button>
						</div>
					</div>
				</form>
			</div>
			
						
	
	
			

			
		</div>
		
	<!--	<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>
	</div>
     /.Page Content -->
