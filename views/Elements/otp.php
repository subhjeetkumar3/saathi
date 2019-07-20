<style>
.none{
	display:none !important;
}
</style>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>OTP used</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>OTP used</strong>
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
							<li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Logs List</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane active">
								<div class="ibox-title">
									<h5>OTP List</h5>
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
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>Message Type</th>
													<th>User Unique Id</th>
													<th>Username</th>
													<th>OTP</th>
													<th>Created Time</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($otp as $value) { ?>
                                                <tr id="row<?php echo $value['id']; ?>">
                                                	<td>OTP</td>
                                                	<td><?php echo $value['userUniqueId']?></td>
													<td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['otp'] ?></td>
													<td><?php echo date('d M Y H:i a', strtotime($value['createdDate'])); ?></td>							
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane ">
								<div class="ibox-title">
									<h5>Please Add Notification</h5>
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
							
								</div>
							</div>
						</div>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>
		
		
		
