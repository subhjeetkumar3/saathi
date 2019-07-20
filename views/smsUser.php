<style>
.none{
	display:none !important;
}
</style>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>SMS User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>SMS User</strong>
                        </li>
                    </ol>
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
							<li class="<?php if(!empty($smsTemplateById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>SMS User List</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane <?php if(!empty($smsTemplateById)){ echo ''; }else { echo 'active'; } ?>">
								<div class="ibox-title">
									<h5>SMS User List</h5>
									<div class="ibox-tools">
										<!-- <a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a> -->
								<form method="POST" action="<?php echo base_url()?>index.php/home/downloadSmsUser">
									
									<input type="hidden" name="exceldaterange1" value="<?php echo $exceldaterange1;?>">
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i>SMS user</button>
                            	   </form>
									</div>
								</div>
								<div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>Mobile Number</th>
													<th>Latest CONSENT confirm date</th>
													<th>Latest CONSENT confirm time</th>
													<th>Latest STOP Request date</th>
													<th>Latest STOP Request time</th>
													<th>Current status</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($smsUser as $data){?>
												<tr>	
												<td><?php echo $data['mobileNo']?></td>
												<td><?php if(!empty($data['latestConsentConfirm'])){echo date('d M Y',strtotime($data['latestConsentConfirm']));}?></td>
												<td><?php if(!empty($data['latestConsentConfirm'])){echo date('h:i a',strtotime($data['latestConsentConfirm']));}?></td>
												<td><?php if(!empty($data['latestStopRequest'])){echo date('d M Y',strtotime($data['latestStopRequest']));}?></td>
												<td><?php if(!empty($data['latestStopRequest'])){echo date('h:i a',strtotime($data['latestStopRequest']));}?></td>
												<td><?php if(empty($data['current_status'])){echo 'UNCONFIRM';}else{echo $data['current_status'];}?></td>
												<td><?php echo $data['createdOn']?></td>
												</tr>	
												<?php }?>	
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							
						</div>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>