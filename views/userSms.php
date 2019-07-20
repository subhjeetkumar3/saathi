<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>CONSENT SMS Logs</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong> CONSENT SMS Logs</strong>
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
                                 <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Consent SMS List</a></li>
								
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Consent SMS List</h5>
                            <div class="ibox-tools">
                                <!-- <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a> -->
                                <form method="POST" action="<?php echo base_url()?>index.php/home/downloadUserSms">
									
									<input type="hidden" name="exceldaterange1" value="<?php echo $exceldaterange1;?>">
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i>Consent SMS logs</button>
                            	   </form>
                            </div>
                        </div>
                        <div class="ibox-content">
                         <form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterUserSms">
                        		
                        		<div class="form-group">
                        	
                        			<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="<?php echo $exceldaterange; ?>" readonly placeholder="select  create date daterange" required>
											</div>
											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit"  >Submit</button>
											</div>
                        		</div>
                        	</form>	
                        </div>
                        <div class="ibox-content">
                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
												<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
													<th>SMS Content</th>
													<th>Mobile</th>
													<th>Created Date</th>
												
												</tr>
												</thead>
												<tbody>		
												<?php foreach($smsList as $value) { ?>
                                                <tr id="row<?php echo $value['smsCommunicationId']; ?>">
                                                	<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['smsCommunicationId']; ?>,'smsCommunicationId','tbl_sms_communication')">
													Delete</span>
													
													</td>
													<td><?php echo $value['smsContent']; ?></td>
													<td><?php echo $value['mobile']; ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['createDate'])); ?></td>
													
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
        <div class="footer">
            
        </div>

        </div>
        </div>
		
		
		
