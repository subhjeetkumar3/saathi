<style>
.none{
	display:none !important;
}
</style>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Notification</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Notification</strong>
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
							<li class="<?php if(!empty($notificationById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Notification List</a></li>
							 <li class="<?php if(!empty($notificationById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane <?php if(!empty($notificationById)){ echo ''; }else { echo 'active'; } ?>">
								<div class="ibox-title">
									<h5>Notification List</h5>
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
													<th>User</th>
													<th>Title</th>
													<th>Description</th>
													<th>Date & Time</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($notificationList as $value) { ?>
                                                <tr id="row<?php echo $value['notificationId']; ?>">
													<td><?php echo $value['users']; ?></td>
													<td><?php echo $value['title']; ?></td>
													<td><?php echo $value['description']; ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['dateTime'])); ?></td>
													<?php if($value['sendStatus'] == 'Y') { ?>
													<td><button type="button" class="btn btn-sm btn-success">Sent</button></td>
													<?php } else { ?>
													<td><button type="button" class="btn btn-sm btn-danger">Not Send</button></td>
													<?php } ?>
													
													<?php if($value['sendStatus'] == 'Y') { ?>
														<td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['notificationId']; ?>,'notificationId','tbl_notification')">
														Delete</span>
														</td>
													<?php } else { ?>
														<td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['notificationId']; ?>,'notificationId','tbl_notification')">
														Delete</span>
														<a href="<?php echo base_url(); ?>index.php/home/notification/<?php echo $value['notificationId']; ?>"><span class="btn-white btn btn-xs">
														Edit</span></a>
														</td>
													<?php } ?>
													
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane <?php if(!empty($notificationById)){ echo 'active'; }else { echo ''; } ?>">
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
									<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addNotification/<?php if(!empty($notificationById)){echo $notificationById[0]['notificationId'];} ?>">
										<div class="form-group">
											<label class="col-sm-2 control-label">User</label>
											<div class="col-sm-10">
												<select data-placeholder="Choose User" class="chosen-select" multiple style="width:350px;" tabindex="4" id="user" name="user[]" required>
													<option value="All" <?php if($notificationById[0]['users'] == 'All') { echo 'selected'; }?>>All Users</option>
													<?php foreach($userList as $value){ ?>
													<option value="<?php echo $value['userId'];?>" <?php if(in_array($value['userId'],explode(',',$notificationById[0]['users']))){ echo 'selected'; }?>><?php echo $value['userName'];?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Title</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="title" value="<?php if(!empty($notificationById)){echo $notificationById[0]['title'];} ?>" required>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Description</label>
											<div class="col-sm-10">
												<textarea type="text" class="form-control" name="description"><?php if(!empty($notificationById)){ echo $notificationById[0]['description']; }?></textarea>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Date & Time</label>
											<div class="col-sm-5">
												<div class="input-group date">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="text" class="form-control" name="date" value="<?php if(!empty($notificationById)){echo $notificationById[0]['date'];} ?>">
												</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group clockpicker" data-autoclose="true">
													<input type="text" class="form-control" name="time" value="<?php if(!empty($notificationById)){echo $notificationById[0]['time'];} ?>">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
												</div>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<a href="<?php echo base_url(); ?>index.php/home/notification" class="btn btn-white">Cancel</a>
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
	</div>
</div>
		
		
		
