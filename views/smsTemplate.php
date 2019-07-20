<style>
.none{
	display:none !important;
}
</style>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>SMS Template</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>SMS Template</strong>
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
							<li class="<?php if(!empty($smsTemplateById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>SMS Template List</a></li>
							<li class="<?php if(!empty($smsTemplateById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane <?php if(!empty($smsTemplateById)){ echo ''; }else { echo 'active'; } ?>">
								<div class="ibox-title">
									<h5>SMS Template List</h5>
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
													<th>Template Name</th>
													<th>Content</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($smsTemplate as $value) { ?>
                                                <tr id="row<?php echo $value['smsTemplateId']; ?>">
													<td><?php echo $value['templateName']; ?></td>
													<td><?php echo $value['smsContent']; ?></td>
													<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['smsTemplateId']; ?>,'smsTemplateId','tbl_sms_templates')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/smsTemplate/<?php echo $value['smsTemplateId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane <?php if(!empty($smsTemplateById)){ echo 'active'; }else { echo ''; } ?>">
								<div class="ibox-title">
									<h5>Please Add SMS Template</h5>
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
									<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addSMSTemplate/<?php if(!empty($smsTemplateById)){echo $smsTemplateById[0]['smsTemplateId'];} ?>">
										<div class="form-group">
											<label class="col-sm-2 control-label">Template Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="templateName" value="<?php if(!empty($smsTemplateById)){echo $smsTemplateById[0]['templateName']; }?>" required>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Template Content</label>
											<div class="col-sm-10">
												<textarea type="text" class="form-control" name="smsContent" required><?php if(!empty($smsTemplateById)){echo $smsTemplateById[0]['smsContent'];} ?></textarea>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<a href="<?php echo base_url(); ?>index.php/home/smsTemplate" class="btn btn-white">Cancel</a>
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