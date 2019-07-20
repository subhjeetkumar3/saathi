
    <!-- Page Content 
	<div id="main-content" class="container"> -->
	<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>SERVICE PROVIDER</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">SERVICE PROVIDER</a>
                    </li>
					
                </ol>
            </div>
            
        </div>
		
						<?php if(!empty($serviceProviders)) { ?>
						<?php $i=1; foreach($serviceProviders as $list) { ?>
						<div style="line-height:13px;" class="well m-t">
                             <strong><?php echo $list['name']; ?>: </strong>
                              ,  
							  <?php echo $list['address']; ?> 
							  , <?php echo $list['mobile']; ?> 
							  ,  <?php echo $list['website']; ?> 
							   <strong>Days & Time: </strong><?php echo $list['dayAndTime']; ?><br>
							    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $list['stateName']; ?> <i class="fa fa-user" aria-hidden="true"></i><?php echo $list['services']; ?>
							  <p style="margin:4px 0;"></p>

                        </div>
							<?php $i++; } ?>
							<?php } ?>

			
	</div>
		
	
