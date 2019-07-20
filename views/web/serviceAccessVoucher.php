<style>
ol .active{
	font-weight: bold;
    
}
button{    background: #f43d2a !important;
    color: #fff !important;
    margin-top: 10px;}


</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>SERVICE ACCESS VOUCHER</h4>
                <!--<ol class="breadcrumb">
                    
					<li class="">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">SEARCH SERVICE PROVIDER</a>
                    </li>
					<li class="active">
                        <a href="">SERVICE ACCESS VOUCHER
						</a>
                    </li>
					
                </ol>-->
            </div>
            
        </div>
		
		<div>Your Service Access Voucher ,<span style="font-weight: bold;"><?php echo $accessVoucherDetail[0]['voucherNumber']; ?></span> has been sent on your registered mobile for the following service provider</div>
		<div class="well m-t" style="line-height: 15px;">
							<strong><?php echo $accessVoucherDetail[0]['name']; ?>: </strong>
                                
							  <?php echo $accessVoucherDetail[0]['address']; ?> 
							  , <?php echo $accessVoucherDetail[0]['mobile']; ?> 
							    <?php //echo $accessVoucherDetail[0]['website']; ?> 
							  <p style="margin:1.5px 0;"></p>
							  <strong>Days & Time: </strong><?php echo $accessVoucherDetail[0]['dayAndTime']; ?><br>
							  <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $accessVoucherDetail[0]['stateName']; ?> <i class="fa fa-user" aria-hidden="true"></i><?php echo $accessVoucherDetail[0]['serviceTypeName']; ?>		  
                        </div>
                    <!--<p><?php print_r($this->session->userdata('last_link'));?></p>--> 

             <?php if(!$this->session->userdata('last_link')){?>           
              <button class="btn btn-primary btn-xs" onclick="history.go(-1)">Go Back</button>  
            <?php }else{?>
            <button class="btn btn-primary btn-xs" onclick="history.go(-2)">Go Back</button>	
            <?php }?> 
            <?php 	$this->session->unset_userdata('last_link');?> 
           
						
	


			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->
	
	<script type = "text/javascript">
	//window.open ("<?php echo base_url();?>/serviceAccessVoucher","mywindow","status=1,toolbar=0");

    window.onload = function () {
		
        document.onkeydown = function (e) {
			
			if(e.keyCode==116){
				return (e.which || e.keyCode) != 116 ;
			}
			if(e.keyCode== 82){
				return (e.which || e.keyCode) != 82 ;
			}
			if(e.button==2)
			{
			alert(status);
			return false;	
			}
			
           
        };
    }
</script>