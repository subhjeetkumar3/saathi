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
			<h4>ONGROUND PARTNER</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="#">ONGROUND PARTNER</a>
                    </li>
					
					
                </ol>
            </div>
            
        </div>
		
		<?php //echo '<pre>';print_r($ongroundPartnersList); ?>
		<h3>Selected On Ground Parnter</h3>
		<?php foreach($ongroundPartnersList as $val){?>
			<div class="well m-t">
				<strong> Partner Name : </strong><?php echo $val['name']; ?> <br>
				<strong> Address : </strong><?php echo $val['address']; ?> <br>
				<strong> Contact Name : </strong><?php echo $val['mobile']; ?> <br>
				
				<a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/homeweb/ongroundPartnerLocation/<?php echo $val['ongroundPartnerId']; ?>">Click To See Location</a>  
			  
			</div>
		<?php } ?>
		

			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->
    <script type="text/javascript">
    	(function($) {
    		alert('Your gift coupon number is send to your number with ongroundPartner details');
    	})(jQuery);
    </script>