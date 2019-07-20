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
			<h4>ADD SERVICE PROVIDER LOCATION</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/addServiceProviderLocation">ADD SERVICE PROVIDER LOCATION</a>
                    </li>
					
                </ol>
            </div>
            
        </div>
		
		
			<div class="ibox-content">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/homeweb/serviceProviderLocation">
					<div class="form-group">

						<div class="col-lg-6">
						<input type="text" name="searchText" placeholder="Name, Address" class="form-control"> 
						</div>
						<div class="col-lg-6">
							<select class="form-control" name="serviceTypeId" id="serviceTypeId" onchange="subCategory();">
								<option value="" readonly>Select Service Provider</option>
								<?php foreach($serviceProviderType as $val){ ?>
									<option value="<?php echo $val['serviceTypeId']; ?>" <?php if($val['serviceTypeId'] == $search['serviceTypeId']){ echo 'selected';}?>><?php echo $val['serviceTypeName']; ?></option>
								<?php } ?>
								
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button class="btn btn-sm btn-white" type="submit">Search</button>
						</div>
					</div>
				</form>
			</div>
			
						
						<?php //print_r($serviceProviderList);?>
						<?php if(!empty($serviceProviderList)) { ?>
						<?php $i=1; foreach($serviceProviderList as $list) { ?>
						<a href="<?php echo base_url(); ?>index.php/homeweb/addServiceProviderLocation/<?php echo $list['serviceProviderId']; ?>/<?php echo $list['latitude']; ?>/<?php echo $list['longitude']; ?>"><div class="well m-t"><strong><?php echo $list['name']; ?> </strong>
                              &nbsp;   <br> 
							  <?php echo $list['address']; ?> <br>
							  <strong> mobile  : </strong><?php echo $list['mobile']; ?> <br>
							  <strong> Skype   : </strong><?php echo $list['skypeId']; ?> <br>
							  <strong> Website : </strong><?php echo $list['website']; ?> <br>
							 
                        </div></a>
							<?php $i++; } ?>
							<?php } ?>


			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img class="mySlides" src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->
