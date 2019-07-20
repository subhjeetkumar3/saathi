<style>
ol .active{
	font-weight: bold;
    
}
</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>FEEDBACK</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="#">FEEDBACK</a>
                    </li>
					<li class="">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">Go Back</a>
                    </li>
					
                </ol>
            </div>
            
        </div>
		
		<div class="ibox-content">
		
			<div class="well m-t"><strong><?php echo $serviceProviderFeedbackDetail[0]['name']; ?> </strong>
				  &nbsp;   <br> 
				  <?php echo $serviceProviderFeedbackDetail[0]['address']; ?> <br>
				  <strong> Mobile : </strong><?php echo $serviceProviderFeedbackDetail[0]['mobile']; ?> <br>
				  <strong> Skype : </strong><?php echo $serviceProviderFeedbackDetail[0]['skypeId']; ?> <br>
				  <strong> Website : </strong><?php echo $serviceProviderFeedbackDetail[0]['website']; ?> <br>
				  
			</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/homeweb/feedback">
					<div class="form-group">

						<div class="col-lg-12">
							<input type="hidden" name="serviceProviderId" value="<?php echo $serviceProviderId; ?>">
							<textarea class="form-control " name="feedback" id="feedback" placeholder="Add Feedback"  value="" required><?php echo $data['permanent_add'];?></textarea>
						</div>
						
					</div>
					
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-sm btn-white" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
			
			
						

			
		</div>
		
		<!-- <aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside> -->
	</div>
    <!-- /.Page Content -->