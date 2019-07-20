<div <?php if(!empty($er)){?>style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/ongroundPartner"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php echo $total_error;  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>Name</th>
							<th>Address</th>
							<th>Office Phone</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Location</th>
							<th>State</th>
							<th>District</th>
							<th>Day and Time</th>
							<!--<th>Skype Id</th>
							<th>Website</th>-->
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color:red;"><?php echo $value['error']?></td>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['address']; ?></td>
							<td><?php echo $value['officePhone']; ?></td>
							<td><?php echo $value['mobile']; ?></td>
							<td><?php echo $value['email']; ?></td>
							<td><?php echo $value['latitude']; ?></td>
							<td><?php echo $value['longtitute']; ?></td>
							<td><?php echo $value['location'] ?></td>
							<td><?php echo $value['stateId']?></td>
							<td><?php echo $value['districtId']?></td>
							<td><?php echo $value['dayAndTime'] ?></td>
							<!--<td><?php echo $value['skypeId']; ?></td>
							<td><?php echo $value['website']; ?></td>-->
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/ongroundPartner"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Onground Partner</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Onground Partner</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
                                 <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Onground Partner List</a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane active">
						<div class="ibox-title">
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelOngroundPartner" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import Onground Partner Excel</label>
										   <div class="col-sm-8" style="display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/onground_partner_excel_format" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
						   <div class="ibox-title">
                            <h5>Onground Partner List</h5>
                            <div class="ibox-tools">
                            		<form method="POST" action="<?php echo base_url()?>index.php/home/downloadOngroundPartnerdata">
									<input type="hidden" name="exceldaterange" value="<?php echo $exceldaterange; ?>">
								<?php if(!empty($exceldataName)){?>	
								<?php foreach($exceldataName as $data){?>	
									<input type="hidden" name="exceldataName[]"  value="<?php echo $data;?>">
								<?php }?>	
								<?php }?>	
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> ongroundpatner data</button>
                            	     </form>  
                            		
                                <!--<a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>-->
                            </div>
                        </div>
                           <div class="ibox-content">
                        	<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterongroundPartner">
                        		<div class="form-group">
                        			<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange"  readonly value="<?php echo $daterange; ?>" placeholder='Select "Create Date" daterange' required>
											</div>
											</div>
											<div class="col-sm-6" id="dataDiv" >
											
												<select name="states[]"  data-placeholder="<?php if(!empty($states)){  $State = $role_master->state_by_id($states); echo implode(',',array_column($State,'stateName'));}else{ echo 'choose state';} ?>" multiple class="chosen-select" id="states">
                                                 <?php foreach($stateList as $list ){?>
                                                 	<option value="<?php echo $list['stateId']?>"><?php echo $list['stateName'];?></option>
                                                 <?php }?>	
												</select>

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
													<th>Unique Id</th>
													<th>Name</th>
													<th>Address</th>
													<th>Office Phone</th>
													<th>Mobile</th>
													<th>Email</th>
													<th>Latitude</th>
													<th>Longitude</th>
													<th>Location</th>
													<th>State Name</th>
													<th>District Name</th>
													<th>Day and Time</th>
													<th>Create Date</th>
													<th>Created By</th>
													<th>Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($ongroundPartnerList as $value) { ?>
                                                <tr id="row<?php echo $value['ongroundPartnerId'];?>">
                                                	<td><?php echo $value['ongroundPartnerUniqueId']?></td>
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['officePhone']; ?></td>
													<td><?php echo $value['mobile']; ?></td>
													<td><?php echo $value['email']; ?></td>
													<td><?php echo $value['latitude']; ?></td>
													<td><?php echo $value['longtitute']; ?></td>
													<td><?php echo $value['location']; ?></td>
													<td><?php echo $value['stateName']; ?></td>
													<td><?php $dis = explode(',',$value['districtId']);  
													//print_r($dis);
													foreach ($dis as $key => $val) {
													 $resNew =	$role_master->district_by_id($val);
													  
													  $districts[] =  ($resNew[0]['districtName']);
													}

													//print_r($districts);

													echo implode(',',$districts);

													$districts = array();
													 //echo implode(',',array_column($districts,'districtName')); 
                                                      
													?>
													</td>
													<td><?php echo $value['dayAndTime']?></td>
													<td><?php echo date('d M Y H:i a', strtotime($value['createdDate'])); ?></td>
													<td><?php echo $value['empName']?></td>
													<td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['ongroundPartnerId']; ?>,'ongroundPartnerId','tbl_onground_partner_data')">
														Delete</span>
														<a href="<?php echo base_url(); ?>index.php/home/ongroundPartnerById/<?php echo $value['ongroundPartnerId']?>"><span class="btn-white btn btn-xs">
														Edit</span></a>
													</td>
													
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
		
		
		
