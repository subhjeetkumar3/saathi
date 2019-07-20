<style>
.none{
	display:none !important;
}
</style>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Logs</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Logs</strong>
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
							 <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Logged In logs List</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane active">
								<div class="ibox-title">
									<h5>Logs List</h5>
									<div class="ibox-tools">
										<!-- <a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a> -->
									</div>
								</div>
								<div class="ibox-title">
									<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterLogs">
										<div class="form-group">
											<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="" readonly placeholder="select date range" required>
											</div>
											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit" id="submit" >Submit</button>
											</div>
										</div>
									</form>
								</div>
								<div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>User Name</th>
													<th>Log In to</th>
													<!--<th>Log In</th>-->
													<th>Log In Time</th>
													<!--<th>Log Out</th>-->
													<th>Log Out Time</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($logsList as $value) { ?>
                                                <tr id="row<?php echo $value['logId']; ?>">
													<td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['logInto'];?></td>
													<!--<td><?php echo $value['login'] ?></td>-->
													<td><?php echo date('d M Y H:i a', strtotime($value['loginTime'])); ?></td>	
													<!--<td><?php echo $value['logout']?></td>-->
													<td><?php if(!empty($value['logoutTime'])){echo date('d M Y H:i a', strtotime($value['logoutTime'])); }?></td>							
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane ">
								<div class="ibox-title">
									<h5>Logged In User List</h5>
									<div class="ibox-tools">
										<!-- <a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a> -->
									</div>
								</div>
								<div class="ibox-content">
							      	<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>User Name</th>
													<th>Log In Time</th>
													<th>Log Into</th>
												</tr>
											</thead>
											
											<tbody>
												<?php foreach($loggedInLogs as $value) { ?>
												<?php $arr = unserialize($value['user_data']);date_default_timezone_set("Asia/Kolkata");?>	
                                                <tr>
													<td><?php echo $arr['userName']; ?></td>
													<td><?php echo date('d M Y H:i a',$value['last_activity'])?></td>
													<td><?php echo $arr['logInto']?></td>	
												</tr>
												<?php } ?>
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
		
		
		
