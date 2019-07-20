<style>
.none{
	display:none !important;
}
</style>
<div <?php if(!empty($er)){?>style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/importantLink"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php echo $total_error;  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>Link</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color:red;"><?php echo $value['error']?></td>
							<td><?php echo $value['linkUrl']?></td>
							<td><?php echo $value['description']?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/importantLink"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Important Link</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Important Link</strong>
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
                                 <li class="<?php if(!empty($importantLinkById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Important Link List</a></li>
								 <li class="<?php if(!empty($importantLinkById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($importantLinkById)){ echo ''; }else { echo 'active'; } ?>">
						   <div class="ibox-title">
                            <h5>Important Link List</h5>
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
													<th>Link</th>
													<th>Description</th>
													<th>Created Date</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>		
												<?php foreach($importantLinkList as $value) { ?>
                                                <tr id="row<?php echo $value['id']; ?>">
													<td><?php echo $value['linkUrl']; ?></td>
													<td><?php echo $value['description']; ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['createdDate'])); ?></td>
													<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['id']; ?>,'id','tbl_usefull_link')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/importantLink/<?php echo $value['id']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>
												</tr>
												<?php } ?>
												
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						 <div id="tab-1" class="tab-pane <?php if(!empty($importantLinkById)){ echo 'active'; }else { echo ''; } ?>">
						   <div class="ibox-title">
                            <h5>Important Link Entry</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
						<div class="ibox-title">
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelImportantLink" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import Important Link Excel</label>
										   <div class="col-sm-8" style="display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/important_link_excel_format" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addImportantLink/<?php if(!empty($importantLinkById)){echo $importantLinkById[0]['id'];} ?>">
							   <div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Link Url</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="linkUrl" value="<?php if(!empty($importantLinkById)){echo $importantLinkById[0]['linkUrl'];} ?>" required>
										</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea type="text" class="form-control" name="description" required><?php if(!empty($importantLinkById)){echo $importantLinkById[0]['description']; }?></textarea>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/importantLink" class="btn btn-white">Cancel</a>
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
		
		
		
