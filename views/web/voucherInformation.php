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
			<h4>VOUCHER INFORMATION</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="#">VOUCHER INFORMATION</a>
                    </li>
					
					
                </ol>
            </div>
            
        </div>

        <h3>Please see details of all Service Access Vouchers and Gift Coupons that have been awarded to you for availing services of our listed Service Providers or for playing contests on our website. 
            <br>
           We look forward to continued interaction with you via our website.</h3>
		
		<?php //echo '<pre>';print_r($vouchersList); ?>
		<?php foreach($vouchersList as $val){?>
			<!-- <a href="<?php echo base_url(); ?>index.php/homeweb/voucherDeatil/<?php echo $val['voucherId']; ?>"> --><div class="well m-t">
				<strong><?php echo $val['voucherType']; ?> </strong><br> 
				<strong> Voucher Number : </strong><?php echo $val['voucherNumber']; ?> <br>
				<strong> Voucher Code : </strong><?php echo $val['voucherCode']; ?> <br>
				<strong> Voucher Date : </strong><?php echo $val['voucherDate']; ?> <br>
				<strong> Expiry Date : </strong><?php echo $val['voucherExpDate']; ?> <br>
				<?php if(!empty($val['ongroundPartnerName'])){?>
				<strong> Onground Partner Name: </strong><?php echo $val['ongroundPartnerName']?><br>
				<?php }?>
				<strong> Time: </strong><?php echo date('g:i A',strtotime($val['createdDate']));?><br>
				<strong> <?php if($val['voucherBackName'] == 'quiz'){ echo 'Quiz Name';
				}elseif($val['voucherBackName'] == 'service'){echo 'Service Provider'; }else{echo 'Game Name'; }?> : </strong><?php echo $val['categoryName']; ?> <br>
				
			  
			</div><!-- </a> -->
		<?php } ?>
		
	
			
						

			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->