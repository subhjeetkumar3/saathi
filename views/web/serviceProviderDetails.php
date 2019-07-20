<style type="text/css">
	p{
		margin: 4px 0;
	}

	ol .active{
	font-weight: bold;
    
}
</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>SERVICE PROVIDER DETAILS</h4>
                <ol class="breadcrumb">
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">SEARCH SERVICE PROVIDER</a>
                    </li>
					<li class="active">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/serviceProviderDetails/<?php echo $id;?>">SERVICE PROVIDER DETAILS</a>
                    </li>
					
                </ol>
            </div>
            
        </div>   
        <div class="ibox-content">
 
		  <?php foreach($serviceProviderDetails as $details) {?>
			<h3><?php echo $details['name']?></h3>
			<p>
				<b>Contact:</b>
				<span><?php echo $details['address'].','.$details['website']?></span>
			</p>
			<p>
				<b>Qualifications:</b>
				<span><?php echo $details['qualification']?></span>
			</p>
			<p>
				<b>Affliations:</b>
				<span><?php echo $details['affiliation']?></span>
			</p>
			<p>
				<b>Linkages:</b>
				<span><?php echo $details['linkage']?></span>
			</p>
			<p>
				<b>Days & Time:</b>
				<span><?php echo $details['day'].'  '.$details['time']?></span>
			</p>
			<p>
				<b>Consulation Mode:</b>
				<span><?php 
				  foreach ($conMode as $mode) 
				  {
				  	echo $mode['mode'];
				  }

				?></span>
			</p>
			<p>
				<b>Consulation Charge (Rs):</b>
				<span><?php echo $details['conCharges']?></span>
			</p>
			<p>
				<b>Services:</b>
				<span>
					<?php 
                  if(!empty($services)){
					foreach($services as $services){?>
					<p><?php echo $services['serviceTypeParameterName']; ?></p>
					<?php }?>
					<?php }else{?>
					<p>No Services</p>
					<?php }?>
				</span>
			</p>	
			<?php }?>
			<?php if(!empty($serviceProviderId)){?>
			<button class="btn btn-primary btn-xs" style="background: #00b050;" onclick="history.go(-1)">Go Back</button>
			<?php }?>
		</div>
		
						

	</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->