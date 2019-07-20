<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Edit Role</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>home/dashboard">Home</a>
			</li>
			<li class="active">
				<strong>Edit Role</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>

        <div class="wrapper wrapper-content animated fadeInRight">
			<?php if($this->session->flashdata('message')){ ?>
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="fa fa-check-circle fa-fw fa-lg"></i>
				<?php echo $this->session->flashdata('message'); ?>.
			</div>
			<?php } ?>
           
            <div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
                               
								<li class="active"><a data-toggle="tab" href="#tab-1">
								<i class="fa fa-user"></i>Update Entry</a>
								</li>
								  
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">

						 
						 <div id="tab-1" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Update role Entry</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
						
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateRole/<?php echo $id ?>" ">
							   <div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label"> Role </label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="role" id="role"  value="<?php echo $roleDetails[0]['userType']?>" required>
											</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
												<?php foreach($rights AS $rights){?>
								  	  		<div class="checkbox">
								  	  		<label>
								  	  		<input type="checkbox" name="rights[]" value="<?php echo $rights['rightId'];?>" <?php if(in_array($rights['rightId'],$roleRights)){echo 'checked';}?>>
								  	  		<?php echo $rights['rightName']?>
								  	  		</label>
								  	  		</div>
								  	  	<?php }?>
								  	  <!-- 	<input type="checkbox" <?php if($roleDetails[0]['otherAccess'] == 'campReport'){echo 'checked';} ?> name="campReport" value="campReport">Camp Report Admin	 -->
										</div>
									</div>
								</div>
								<?php $otherAccess = explode(',',$roleDetails[0]['otherAccess']);  ?>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Camp Report Admin</label>
										<div class="col-sm-10">
								  	  			<label><input type="checkbox" <?php if(in_array('campReport',$otherAccess)){echo 'checked';} ?> name="campReport[]" value="campReport"></label>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Violence Reporting Admin</label>
										<div class="col-sm-10">
								  	  			<label><input type="checkbox" <?php if(in_array('violenceReport',$otherAccess)){echo 'checked';} ?> name="campReport[]" value="violenceReport"></label>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/role" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
 
                        </div>
						 </div>
						
						</div>
                    </div>
                </div>
				
				
				
				
				
            </div>
        </div>
        <div class="footer">
            
        </div>

        </div>
        </div>
		
		
		
