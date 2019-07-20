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
			<h4>VOUCHER DETAILS</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="#">VOUCHER DETAILS</a>
                    </li>
					<li class="">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/voucherInformation">VOUCHER INFORMATION</a>
                    </li>
					
					
                </ol>
            </div>
            
        </div>
		
		<?php //echo '<pre>';print_r($voucheDetail); ?>
		
			<div class="well m-t">
				<strong><?php echo $voucheDetail[0]['voucherType']; ?> </strong><br> 
				<strong> Voucher Number : </strong><?php echo $voucheDetail[0]['voucherNumber']; ?> <br>
				<strong> Voucher Code : </strong><?php echo $voucheDetail[0]['voucherCode']; ?> <br>
				<strong> Voucher Date : </strong><?php echo $voucheDetail[0]['voucherDate']; ?> <br>
				<strong> Expiry Date : </strong><?php echo $voucheDetail[0]['voucherExpDate']; ?> <br>
				<strong> <?php if($voucheDetail[0]['voucherBackName'] == 'quiz'){ echo 'Quiz Name';
				}elseif($voucheDetail[0]['voucherBackName'] == 'service'){echo 'Service Provider'; }else{echo 'Game Name'; }?> : </strong><?php echo $voucheDetail[0]['categoryName']; ?> <br>
				
			  
			</div>
		
		
			<?php if($voucheDetail[0]['voucherBackName'] == 'service'){?>
				<iframe width="660" height="500" frameborder="0" style="border:0"  src="https://maps.google.com/maps?q=<?php echo $voucheDetail[0]['latitude']; ?>,<?php echo $voucheDetail[0]['longitude']; ?>&hl=es;z=14&amp;output=embed" allowfullscreen></iframe>		
			
			<?php } ?>
			
	

			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->