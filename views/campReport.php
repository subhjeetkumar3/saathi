<style>
.none{
	display:none !important;
}

.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
    width: 200% !important;
}

fieldset{
border: 1px solid #1ab394 !important;
}

legend{
	text-align: center !important;
	padding: 0 10 !important;
	width: auto !important;
	color: #1ab394 !important;
	border-bottom: 0 !important;
}

.required{
	color: red;
}	


</style>
 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Camp Report</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>home/dashboard">Home</a>
			</li>
			<li class="active">
				<strong>Camp Report</strong>
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
                               	<li class="active" ><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>List</a></li>

                               

								<li class=""><a data-toggle="tab" href="#tab-1">
								<i class="fa fa-user"></i>New Entry</a>
								</li>
								  
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane active">
						   <div class="ibox-title">
                         	<h5>Please Add Camp Report Details</h5>
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
                           <div class="ibox-tools">
                            		<form method="POST" action="<?php echo base_url()?>index.php/home/downloadCampData">
								
									<input type="hidden" name="exceldaterange" value="<?php echo $daterange ?>">
								
									<input type="hidden" name="stateExcel" value="<?php echo $stateFilter?>">

									<?php if(!empty($districtFilter)) {
										foreach($districtFilter as $post) { ?>
									<input type="hidden" name="districtExcel[]" value="<?php echo $post?>">		

									<?php	}

									} ?>

									<input type="hidden" name="siteExcel" value="<?php echo $siteFilter; ?>">

									<input type="hidden" name="submitExcel" value="<?php echo $submitFilter ?>">
									
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> Camp Report</button>
                            	     </form>  
                                <!--<a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>-->
                              <form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterCampReport">
                        		<div class="form-group">
                        			<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="<?php echo $daterange ?>" readonly placeholder='Select "Create Date" daterange' required>
											</div>
											</div>
											<div class="col-sm-3">
											
												<select onchange="getDistrictFilter()" name="state" data-placeholder="choose state"  class="form-control" id="stateFilter">
													<option value="">-Select state-</option>
                                                 <?php foreach($stateList as $list ){?>
                                                 	<option <?php if($stateFilter == $list['stateId']){ echo 'selected'; }?> value="<?php echo $list['stateId']?>"><?php echo $list['stateName'];?></option>
                                                 <?php }?>	
												</select>

											</div>
											<div class="col-sm-3"  id="districtDiv">
												<?php $districtsData = $role_master->district_by_id($districtFilter); $districts = implode(',',array_column($districtsData,'districtName')); ?>
												<select data-placeholder="<?php if(!empty($districtFilter)){echo  $districts;}else{echo 'Select districts';} ?>" id="districtFilter" name="district[]" multiple class="chosen-select"></select>
											</div>
											
										</div>	
											<div class="form-group">
												<div class="col-sm-3" >
												<input type="text" value="<?php echo $siteFilter ?>" class="form-control" placeholder="Enter site" name="siteFilter">
											</div>

											
												<div class="col-sm-3" >
												<select name="submitFilter" class="form-control">
													<option value="">-Select submit status-</option>
													<option <?php if($submitFilter == 'Y'){ echo 'selected';} ?> value="Y" >Submitted</option>
													<option <?php if($submitFilter == 'N'){ echo 'selected';} ?> value="N">Not Submiited</option>
												</select>
											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit" id="submit" >Submit</button>
											</div>
                        		</div>
                        	</form>    
                            </div>

                        </div>


                        <div class="ibox-content">
                             <div class="table-responsive" >
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead>
												<tr>
													<th style="display: none">Sr. No</th>
												   <th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>	
													<th>Camp Code</th>
												   	<th>Date Of Camp</th>
												   	<th>State</th>
												   	<th>District</th>
												   	<th>Block</th>
												   	<th>Site</th>
												   	<th>Latitude</th>
												   	<th>Longitude</th>					
												   	<th>Start time</th>
												   	<th>End time</th>
												   	<th>Distance from Nearest ICTC in Kms</th>
												   	<th>Distance from nearest health facility</th>
												   	<th>Distance from nearest HIV service provider</th>
												   	<th>Coordinated with</th>
												   	<th>If 'Others'</th>
												   	<th>HRG Population</th>
												   	<th>ARG Population</th>
												   	<th>In-Migration</th>
												   	<th>Out-Migration</th>
												   	<th>No. of labourers</th>
												   	<th>Activity Description</th>
												   	<th>No. of people attended</th>
												   	<th>No. of people screened</th>
												   	<th>No. of people found to be STR</th>
												   	<th>No. of STR cases referred to ICTC</th>
												   	<th>Challenges</th>
												   	<th>Innovations</th>
												    	<th>Learnings</th>
												    <th>Follow</th>		 	
												   	<th>Total cost for conducting CBS</th>
												   	<th>Cost of renting locations/assets</th>
												   	<th>Cost of special mobilisation activities</th>
												   	<th>Cost of consumables</th>
												   	<th>Cost of transporting personnel and cold chain for kits</th>	
												   <th>Any other major cost involved</th>
												   	<th>Description of Other costs</th>
												   	<th>Name of the kits</th>
												   	<th>Batch No.</th>
												   	<th>Expiry date</th>	
												   <th>Opening stock</th>
												   	<th>No of kits received</th>
												   	<th>Date Of kits received</th>
												   	<th>Consumed</th>
												   	<th>Control</th>
												   	<th>Wastage/Damage</th>	
												   <th>Closing stock</th>
												   	<th>Quantity indented</th>
												   	<th>Kits returned, if any</th>
												   <th>Image1</th>	
												   <th>Image2</th>	
												   <th>Image3</th>	
												   <th>Image4</th>	
												   <th>Image5</th>	
												   	 <th>Create Date</th>
												   	<th>Create By</th>	
												   	<th>Update Date</th>
												   	<th>Update By</th>
												   	<!--<th></th>
												   	<th></th>
												   	<th></th>	 -->			
												   <!-- 																
											         -->
												</tr>
												</thead>
												  <div class="full-height-scroll">
												<tbody>	
												<?php $k = 1; foreach($campReportList as $value){?>	
												<tr id="row<?php echo $value['id']?>">
                                                <td style="display: none"><?php echo $k; ?></td>
												<td class="text-right footable-visible footable-last-column">
													<!-- <span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['id']; ?>,'id','tbl_camp_reports')">
													Delete</span> -->
												<?php     
												$roleType = explode(',',$this->session->userdata('roleType'));
												  $otherAccess = $this->session->userdata('otherAccess');
												if($this->session->userdata('userType') != 'admin')
												{
                                                   if($value['submit'] == 'N' || in_array('campReport',$otherAccess))
												{?>	
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['id']; ?>,'id','tbl_camp_reports')">
													Delete</span>
												
													<a href="<?php echo base_url().'home/editReport/'.$value['id']?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
												
												<?php } }else{?>
													<?php if($this->session->userdata('userType') == 'admin' || in_array('campReport',$otherAccess)){?>
														<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['id']; ?>,'id','tbl_camp_reports')">
													Delete</span>
												
													<a href="<?php echo base_url().'home/editReport/'.$value['id']?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
												<?php }
												   }?>	
													<span onclick="viewPeoplePresent('<?php echo $value['id']?>','<?php echo $value['submit'] ?>')" class="btn-white btn btn-xs">View People Present</span>
													<span onclick="viewUploadPhoto('<?php echo $value['id']?>','<?php echo $value['submit'] ?>')" class="btn-white btn btn-xs">View Upload Photograph</span>

												 	<a href="<?php echo base_url().'home/campReportPdf/'.$value['id']?>"> <span class="btn-white btn btn-xs">downlaod PDF</span>	</a>
													<?php if($value['submit'] == 'N'){?>
														<p>Not submitted</p>
												<?php }else{?>
													<p>Submitted</p>
												<?php }?>
													<!-- <a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a> -->
													</td>	
											    <td><?php echo $value['camp_code'] ?></td>
											    <td><?php echo $value['date_of_camp'] ?></td>
											     <td><?php echo $value['stateName'] ?></td>
											      <td><?php echo $value['districtName'] ?></td>
											       <td><?php echo $value['block'] ?></td>
											      <td><?php echo $value['site'] ?></td>
											    <td><?php echo $value['latitude'] ?></td>
											     <td><?php echo $value['longitude'] ?></td>
											      <td><?php echo $value['start_time'] ?></td>
											       <td><?php echo $value['end_time'] ?></td>
											      <td><?php echo $value['nearset_ictc'] ?></td>
											    <td><?php echo $value['nearest_health_facility'] ?></td>
											     <td><?php echo $value['nearest_hiv_service_provider'] ?></td>
											      <td><?php echo $value['coordinated_with'] ?></td>
											       <td><?php echo $value['coordinated_others'] ?></td>
											      <td><?php echo $value['hrg_population'] ?></td>
											    <td><?php echo $value['arg_population'] ?></td>
											     <td><?php echo $value['in_migration'] ?></td>
											      <td><?php echo $value['out_migration'] ?></td>
											       <td><?php echo $value['no_of_labourers'] ?></td>
											      <td title="<?php echo $value['activityDesc'] ?>"><p style="max-height: 99.4em;width: 200px;white-space: nowrap;overflow: hidden;display: inline-block;text-overflow: ellipsis;cursor: pointer;" ><?php echo $value['activityDesc'] ?></p></td>
											      <td><?php echo $value['no_of_people_attended'] ?></td>
											      <td><?php echo $value['no_of_people_screened'] ?></td>
											      <td><?php echo $value['no_of_people_found_to_be_str'] ?></td>
											      <td><?php echo $value['no_of_str_cases_referred_to_ictc'] ?></td>
											     <td><?php echo $value['challenges'] ?></td>
											     <td><?php echo $value['innovations'] ?></td>
											     <td><?php echo $value['learing'] ?></td>
											     <td><?php echo $value['follow'] ?></td>  
											      <td><?php echo $value['cost_for_cbs'] ?></td>
											    <td><?php echo $value['cost_for_renting'] ?></td>
											    <td><?php echo $value['cost_of_mobilisation']?></td>
											     <td><?php echo $value['cost_of_consumables'] ?></td>
											      <td><?php echo $value['cost_of_transporting'] ?></td>
											       <td><?php echo $value['other_major_cost'] ?></td>
											      <td><?php echo $value['desc_for_other_cost'] ?></td>
											    <td title="<?php echo $value['kits_name'] ?>" ><p style="width: 50px;white-space: nowrap;overflow: hidden;display: inline-block;text-overflow: ellipsis;cursor: pointer;"><?php echo $value['kits_name'] ?></p></td>
											     <td><?php echo $value['batch_no'] ?></td>
											      <td><?php echo $value['expiry_date'] ?></td>
											       <td><?php echo $value['opening_stock'] ?></td>
											       <td><?php echo $value['received'] ?></td>
											         <td><?php if(!empty($value['date_of_kits_received'])){ 
                                                     	echo date('d M Y',strtotime($value['date_of_kits_received'])); }?></td>
											    <td><?php echo $value['consumed'] ?></td>
											     <td><?php echo $value['control'] ?></td>
											      <td><?php echo $value['wastage'] ?></td>
											       <td><?php echo $value['closing_stock'] ?></td>
											     <td><?php echo $value['quantity_indented'] ?></td>
											   <td><?php echo $value['kits_returned'] ?></td>
											     <td><?php  if($value['image']){ ?>
											     	<img style="width:100px;height:100px;" src="<?php echo base_url().'uploads/campImage/'.$value['image']?>"> 
											     <?php }?></td>  
											     <td><?php  if($value['image1']){ ?>
											      	<img style="width:100px;height:100px;" src="<?php echo base_url().'uploads/campImage/'.$value['image1']?>"> 
											     <?php }?></td> 
											     <td><?php  if($value['image2']){ ?>
											      	<img style="width:100px;height:100px;" src="<?php echo base_url().'uploads/campImage/'.$value['image2']?>">
											     <?php }?></td> 
											     <td><?php  if($value['image3']){ ?>
											      	<img style="width:100px;height:100px;" src="<?php echo base_url().'uploads/campImage/'.$value['image3']?>">
											     <?php }?></td> 
											     <td><?php  if($value['image4']){ ?>
											     	 <img style="width:100px;height:100px;" src="<?php echo base_url().'uploads/campImage/'.$value['image4']?>"> 
											     <?php }?></td> 
											     <td><?php echo date('d M Y h:i a',strtotime($value['createDate']))?></td>
                                                    <td><?php if(!empty($value['createdBy'])){ 
                                                    	
                                                    $res = $role_master->userById($value['createdBy']); 

                                                    //print_r($res);
                                                    echo $res[0]['userName'];

                                                } 
                                                    ?>
                                                    	
                                                    </td>
                                                     <td><?php if(!empty($value['updateDate'])){ 
                                                     	echo date('d M Y h:i a',strtotime($value['updateDate'])); }?></td>
                                                
													 <td><?php if(!empty($value['updatedBy'])){ 
                                                    	
                                                    $res = $role_master->userById($value['updatedBy']); 

                                                    //print_r($res);
                                                    echo $res[0]['userName'];

                                                } 
                                                    ?>
                                                    	
                                                    </td>
											    </tr>    
											     <?php $k++; }?>                    
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						 <div id="tab-1" class="tab-pane">
						   <div class="ibox-title">
                            <h5>Camp Report Entry</h5>
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

                          <form method="post" class="form-horizontal"  enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/insertCampReport" onsubmit="return checkRights() && checkDisVal() && checkCostVal() && checkConsumedOther();">
                          	<fieldset>
							  <legend>BASIC DETAILS:</legend>	
							
							   							
								<div class="hr-line-dashed"></div>
								  <div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Date Of Camp<span class="required">*</span></label>
											<div class="col-sm-10">
											  <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>		
												<input type="text" autocomplete="off" class="form-control" name="campDate" id=""  value="" required>
											</div>	
											</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>

							   <div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Start Time</label>
										<div class="col-sm-10">
										<div class="input-group">	
												<span class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</span>
										<input type="text" class="form-control clockpicker" name="startTime" readonly  mousewheel="false">	
										</div>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">End Time</label>
										<div class="col-sm-10">
										<div class="input-group">	
												<span class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</span>	
										<input type="text" class="form-control clockpicker" name="endTime" readonly  mousewheel="false">
									</div>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">State<span class="required">*</span></label>
										<div class="col-sm-10">
										 <select class="form-control"  onchange="getDistrict()"  tabindex="11"  id="state" name="state" required>
						 		       <option value="" >Select State</option>
									     <?php foreach($stateList as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>				
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">District<span class="required">*</span></label>
										<div class="col-sm-10">
										<select  required name="district" tabindex="12" id="district" class="form-control">
									     <option value="" readonly>Select District</option>							
							         </select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Camp Code<span class="required">*</span></label>
											<div class="col-sm-10">
												<div class="col-sm-1" style="width: 12.499999995%" >
													
													<input type="text" onchange="checkUniqueCode()" maxlength="2" minlength="2" name="stateCode"  id="stateCode"  class="form-control">
												 <span style="width: 30% !important;color: red">State- 2 Character Code</span>	
												</div>
												
												<div class="col-sm-1"  onchange="checkUniqueCode()" style="width: 12.499999995%">
													<input type="text" maxlength="2" minlength="2" name="districtCode"  id="districtCode" class="form-control">
												 <span style="color: red">District- 2 Character Code</span>		
												</div>
												
												<div class="col-sm-2">
													<input type="text" onkeypress="return isNumberKey(event)" onchange="checkUniqueCode()" required id="campCode1" name="campCode1" minlength="3" maxlength="3" class="form-control">
												<span style="color: red">3 digit sequence</span>		
												</div>
											
												<!-- <div class="col-sm-2">
													<input type="text" onchange="checkUniqueCode()" required id="campCode2" name="campCode2" maxlength="1" class="form-control">
												</div>
											
												<div class="col-sm-2">
													<input type="text" id="campCode3" required name="campCode3" onchange="checkUniqueCode()" maxlength="1" class="form-control">
												</div> -->
													<span id="campCodeSpan" style="display: none;color: red">Camp Code already used. Choose another</span>
												<!-- <input type="text" onchange="checkUniqueCode()" autocomplete="off" class="form-control" name="campCode" id="campCode"  value="" required>
											<span id="campCodeSpan" style="display: none;color: red">Camp Code already used. Choose another</span>	 -->
											</div>
									</div>
								</div>		
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Block</label>
										<div class="col-sm-10">
										<input type="text" class="form-control" name="block">		
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Site<span class="required">*</span></label>
										<div class="col-sm-10">
										 <input type="text" required class="form-control" name="site">		
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Latitude<span class="required">*</span></label>
										<div class="col-sm-10">
										 <input type="text" onkeypress="return isNumberLatLong(event,this)" onchange="checkLat()" id="latitude" title="Latitude should be equal to or below 99.9999"  class="form-control" required name="latitude" placeholder="Latitude should be equal to or below 99.999999">
										 <span id="latSpan" style="display: none;color: red">Latitude should be equal to or below 99.999999</span>		
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Longitude<span class="required">*</span></label>
										<div class="col-sm-10">
										<input type="text" onkeypress="return isNumberLatLong(event,this)" onchange="checkLng()" id="longitude" title="Longitude should be equal to or below 99.9999"  class="form-control" required name="longitude" placeholder="Longitude should be equal to or below 99.999999">	
										 <span id="lngSpan" style="display: none;color: red">Longitude should be equal to or below 99.999999</span>	
										</div>
									</div>
								</div>
						</fieldset>		
     <div class="hr-line-dashed"></div>
                          <fieldset >
							  <legend>PEOPLE PRESENT:</legend>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                <div class="col-sm-6">
										<label class="col-sm-2 control-label">Name</label>
										<div class="col-sm-10">
										 <input type="text" class="form-control" name="presentName[]">		
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Designation</label>
										<div class="col-sm-10">
										<input type="text" class="form-control" name="presentDesignation[]">		
										</div>
									</div>									
								</div>
								<div class="form-group">
                                <div class="col-sm-6">
										<label class="col-sm-2 control-label">Organisation</label>
										<div class="col-sm-10">
										 <input type="text" class="form-control" name="presentOrganisation[]">		
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Contact Info</label>
										<div class="col-sm-10">
										<input type="text" maxlength="10" onkeypress="return isNumberKey(event,this)" class="form-control" name="contact[]">		
										</div>
									</div>									
								</div>
							<div id="dataId"></div>	
							<div class="hr-line-dashed"></div>	
							<div class="form-group">
                                   <div class="col-sm-2" style="float:right;">
                                     <span style="color:green;border-color:green" class="btn btn-white" id="rentedMobileButton" onclick="appendInfoDiv('tenantMobileDiv');">Add More</span>
                                        </div>
                                    </div>
                             </fieldset>

                             

                               <div class="hr-line-dashed"></div>
                               <fieldset style="padding: 0 2%;">
							  <legend>JUSTIFICATION OF CAMP LOCATION:</legend>	   
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Distance from Nearest ICTC in Kms<span class="required">*</span></label>
									<!-- </div>
									<div class="col-sm-6">	 -->
										<!-- <div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberDisFormat(event,this)" onchange="checkDis(this)"  class="form-control"  required name="ictcDistance" id="ictcDistance">		
										</div>
									<!-- </div> -->

								<!-- </div>   -->

	                             <!--   <div class="hr-line-dashed"></div>
								<div class="form-group"> -->
									<div class="col-sm-6">
										<label class="control-label">Distance from nearest health facility<span class="required">*</span></label>
									<!-- </div>
									<div class="col-sm-6"> -->	
									<!-- 	<div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberDisFormat(event,this)" onchange="checkDis(this)"   class="form-control"  required name="healthDistance" id="healthDistance">		
										</div>
									</div>
									
								<!-- </div> -->
								
	                            <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Distance from nearest HIV service provider<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" onkeypress="return isNumberDisFormat(event,this)" onchange="checkDis(this)"   class="form-control"  required name="providerDistance" id="providerDistance">		
										</div>
									</div>
									
								</div>
						</fieldset>	
						    <div class="hr-line-dashed"></div>
						      <fieldset style="padding: 0 2%;">
							  <legend>COORDINATED WITH:</legend>	  	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Coordinated with<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<!--  <select onchange="checkOption()" class="chosen-select" multiple id="coordinated" name="coordinated[]">
										 	<option>-select-</option>
										 	<option value="DAPCU">DAPCU</option>
										 	<option value="ICTC">ICTC</option>
										 	<option value="SACS">SACS</option>
										 	<option value="LWS">LWS</option>
										 <option value="HIV Nodal">HIV Nodal</option>
										 	<option value="TI">TI</option>
										 	<option value="ASHA">ASHA</option>
										 	<option value="ANM">ANM</option>
										 	<option value="Others">Others</option>
										 </select>	 -->
										<div class="checkbox"> 
										 <input type="checkbox" value="DAPCU" name="coordinated[]">DAPCU	
										</div>
									<div class="checkbox">	 
										 <input type="checkbox" value="ICTC" name="coordinated[]">ICTC	
										</div>
									<div class="checkbox">	 
										  <input type="checkbox" value="SACS" name="coordinated[]">SACS
									</div>
									<div class="checkbox">	  	
										 <input type="checkbox" value="LWS" name="coordinated[]">LWS	
									</div>
									<div class="checkbox">	 
										 <input type="checkbox" value="HIV Nodal" name="coordinated[]">HIV Nodal
								  </div>
								  <div class="checkbox">		 	
										 <input type="checkbox" value="TI" name="coordinated[]">TI	
								</div>
								<div class="checkbox">		 
										 <input type="checkbox" value="ASHA" name="coordinated[]">ASHA
								</div>
								<div class="checkbox">		 	
										 <input type="checkbox" value="ANM" name="coordinated[]">ANM	
								</div>
								<div class="checkbox">		 
										  <input type="checkbox" value="Others" id="coodOth" onclick="checkOption()" name="coordinated[]">Others	 
								</div>		
									<div class="col-sm-7" style="display: none;color: red;" id="rightSpan">Select atleast one option</div>        
										</div>
									</div>
									
								</div>
							<div id="othercoor" style="display: none;">	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Coordinated with Others Details</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										  <input type="text" class="form-control" id="othercodetail" name="othercodetail">		
										</div>
									</div>
									
								</div>
							</div>	
						</fieldset>
								<div class="hr-line-dashed"></div>

							  <fieldset style="padding: 0 2%;">
							  <legend>COMMUNITY PROFILE:</legend>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">HRG Population<span class="required">*</span></label>
									<!-- </div> -->
									<!-- <div class="col-sm-6">	
										<div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberKey(event,this)" maxlength="4"  class="form-control" required name="hrg">		
										<!-- </div> -->
									</div>
									
							<!-- 	</div> -->

							<!-- 	<div class="hr-line-dashed"></div> -->
								<!-- <div class="form-group"> -->
									<div class="col-sm-6">
										<label class="control-label">ARG Population<span class="required">*</span></label>
								<!-- 	</div>
									<div class="col-sm-6">	
										<div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberKey1(event,this)"  class="form-control" maxlength="4" required name="arg">		
										<!-- </div> -->
									</div>
									
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">IN Migration<span class="required">*</span></label>
								<!-- 	</div>	
									<div class="col-sm-6">	
										<div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberKeyMaxLimit(event,this)"  class="form-control" required name="inMigration">		
									<!-- 	</div> -->
									<!-- </div> -->
									
								</div>
 
							<!-- 	<div class="hr-line-dashed"></div>
								<div class="form-group"> -->
									<div class="col-sm-6">
										<label class="control-label">OUT Migration<span class="required">*</span></label>
									<!-- </div>
									  <div class="col-sm-6">	
										<div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberKeyMaxLimit(event,this)"  class="form-control" required name="outMigration">		
										<!-- </div> -->
									</div>
									
								</div>
                              <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">No Of Labourers</label>
									</div>
									 <div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" onkeypress="return isNumberKey1(event,this)"  class="form-control"  maxlength="4" name="labourers">		
										</div>
									</div>
									
								</div>
                               </fieldset>
 
								  <div class="hr-line-dashed"></div>
					   <fieldset style="padding: 0 2%;">
							  <legend>ACTIVITY DESCRIPTION:</legend>				  
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Activity Description</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<textarea name="activityDesc" class="form-control"></textarea>		
										</div>
									</div>

								</div>
                              </fieldset>

                               <div class="hr-line-dashed"></div>
                               <fieldset style="padding: 0 2%">
                               	<legend>KEY INDICATORS</legend>
                               	<div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of people attended<span class="required">*</span> </label>
									</div>	
									<div class="col-sm-6">
										<input type="text" onkeypress="return isNumberKey(event,this)" maxlength="3" required class="form-control" name="peopleAttened">
									</div>
                               	</div>

                               	  <div class="hr-line-dashed"></div>


                               	 <div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of people screened<span class="required">*</span></label>
									</div>	
									<div class="col-sm-6">
										<input type="text" onkeypress="return isNumberKey(event,this)" maxlength="3" required class="form-control" name="peopleScreened">
									</div>
                               	</div>

                               	  <div class="hr-line-dashed"></div>

                               	 <div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of people found to be STR<span class="required">*</span></label>
									</div>	
									<div class="col-sm-6">
										<input type="text" onkeypress="return isNumberKey(event,this)" maxlength="2" required class="form-control" name="peopleStr">
									</div>
                               	</div>

                               	   <div class="hr-line-dashed"></div>

                               	 <div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of STR cases referred to ICTC<span class="required">*</span></label>
									</div>	
									<div class="col-sm-6">
										<input type="text" onkeypress="return isNumberKey(event,this)" maxlength="2" required class="form-control" name="strCases">
									</div>
                               	</div>
                               	
                               </fieldset>


								  <div class="hr-line-dashed"></div>

						   <fieldset style="padding: 0 2%;">
							  <legend>CHALLENGES:</legend>			  
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Challenges</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<textarea name="challenges" class="form-control"></textarea>		
										</div>
									</div>

								</div>
                                  </fieldset>

								  <div class="hr-line-dashed"></div>

					   <fieldset style="padding: 0 2%;">
							  <legend>INNOVATIONS:</legend>				  
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Innovations</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<textarea name="innovations" class="form-control"></textarea>		
										</div>
									</div>

								</div>
                             </fieldset>

								  <div class="hr-line-dashed"></div>
							   <fieldset style="padding: 0 2%;">
							  <legend>LEARNINGS:</legend>		  
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Learnings</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<textarea name="learing" class="form-control"></textarea>		
										</div>
									</div>

								</div>
							</fieldset>	

								  <div class="hr-line-dashed"></div>
							   <fieldset style="padding: 0 2%;">
							  <legend>FOLLOW-UP:</legend>		  
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Follow Up<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<textarea name="follow" required class="form-control"></textarea>		
										</div>
									</div>

								</div>  
                               </fieldset>   

								  <div class="hr-line-dashed"></div>

						   <fieldset style="padding: 0 2%;">
							  <legend>TOTAL EXPENSES:</legend>			  
								
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Cost of renting location and assets</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" onchange="checkCost(this)"  class="form-control rentingCost" id="rentingCost" name="rentingCost">		
										</div>
									</div>
									
								</div>


									 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Cost of special mobilisation activities</label>
									</div>	
									 <div class="col-sm-6">
										<div class="col-sm-10">
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" onchange="checkCost(this)"  class="form-control mobilisationCost" id="mobilisationCost" name="mobilisationCost">		
										</div>
									</div>
									
								</div>


									 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Cost of consumables</label>
									</div>	
									 <div class="col-sm-6">
										<div class="col-sm-10">
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" onchange="checkCost(this)" id="consumablesCost" class="form-control consumablesCost" name="consumablesCost">		
										</div>
									</div>
									
								</div>

							 	 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Cost of transporting personnel and cold chain for kits</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" onchange="checkCost(this)" class="form-control transportingCost" id="transportingCost" name="transportingCost">		
										</div>
									</div>
									
								</div>	
								 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Any other major cost involved</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" onchange="checkCost(this)"  class="form-control otherCost" id="otherCost" name="otherCost">		
										</div>
									</div>
									
								</div>	

								 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Description of Other costs</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" class="form-control" name="otherCostDesc">		
										</div>
									</div>
									
								</div>	

								<div class="hr-line-dashed"></div>

								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Total Cost for conducting CBS<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" readonly="readonly" onkeypress="return isNumberCostFormat(event,this)" class="form-control cbsCost" id="cbsCost" required name="cbsCost">		
										</div>
										<!-- onchange="checkCost(this)" -->
									</div>
									
								</div>
                           

                         </fieldset>
								 <div class="hr-line-dashed"></div>

						   <fieldset style="padding: 0 2%;">
							  <legend>KITS STATUS:</legend>			 
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Name of the kits<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" required class="form-control" name="kitsName">		
										</div>
									</div>
									
								</div>	

								 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Batch No.<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" required class="form-control" name="batch">		
										</div>
									</div>
									
								</div>	

									 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Expiry date<span class="required">*</span></label>
									  </div>
									  <div class="col-sm-6">	
										<div class="col-sm-10">
										<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
										 <input type="text" autocomplete="off" required class="form-control" name="expiryDate">		
										</div>
										</div>
									</div>
									
								</div>	

								 <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Opening stock<span class="required">*</span></label>
									</div>
									 <div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" maxlength="4" id="openingStock" required onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="openingStock" >		
										</div>
									</div>
									
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">No of kits received<span class="required">*</span></label>
									</div>
									  <div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text"  maxlength="4" required id="received" onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="received">		
										</div>
									</div>
									
								</div>	

								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Date of Receiving kits<span class="required">*</span></label>
									</div>
									  <div class="col-sm-6">	
										<div class="col-sm-10">
										  <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>		
												<input type="text" autocomplete="off" class="form-control" name="receivedDate" id=""  value="" required>
											</div>		
										</div>
									</div>
									
								</div>

								

                                  <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Control<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text"   maxlength="4" required id="control" onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="control">		
										</div>
									</div>
									
								</div>	
                                
                                  <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Wastage/Damage<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" maxlength="4" required id="wastage" onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="wastage">		
										</div>
									</div>
									
								</div>                             

								   <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Kits returned,if any<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text"  maxlength="4" required class="form-control" id="kitsReturned" onkeypress="return isWholeNumberKey(event,this)" name="kitsReturned">		
										</div>
									</div>
									
								</div>	

								  <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Consumed<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text" onchange="checkConsumed()" maxlength="4" id="consumed" required onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="consumed">	
										 <span style="display: none;color: red" id="consumedSpan">Consumed can't be more than sum of Opening stock and Received</span>	
										</div>
									</div>
									
								</div>	

                               
                                  <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Closing Stock<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-8">
										 <input type="text" readonly="readonly" class="form-control" id="closingStock" name="closingStock" value="">	
										</div>
										<span class="btn btn-primary" onclick="calculateCloseStock()">Update</span>	
									</div>
									
								</div>	

								     <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Quantity indented<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="text"  maxlength="4" required onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="quantityIndented">		
										</div>
									</div>
									
								</div>	 

                           </fieldset>

                                  <div class="hr-line-dashed"></div>

                             <input type="hidden" name="count" class="count">      

					   <fieldset style="padding: 0 2%;">
							  <legend>UPLOAD PHOTOGRAPHS:</legend>	     
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Upload photograph<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="file" required class="form-control image"  name="image[]">		
										</div>
									</div>
									
								</div>	

									<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Upload photograph<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="file" required class="form-control image"  name="image[]">		
										</div>
									</div>
									
								</div>	

								<div id="dataId1"></div>	
							<div class="hr-line-dashed"></div>	
							<div class="form-group">
                                   <div class="col-sm-2" >
                                     <span style="color:green;border-color:green;display: inline-block;" class="btn btn-white" id="addImage" onclick="appendInfoDivPhoto();">Add More Photograph</span>
                                        </div>
                                    </div>
    

                              </fieldset>
                    
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/campReport" class="btn btn-white">Cancel</a>
                                       <!--  <button class="btn btn-primary" id="submitForm" type="submit">Submit</button> -->
                                       <button class="btn btn-primary" id="saveBtn" name="save" type="submit">Save</button>
                                       <?php if($this->session->userdata('roleType') != 'User Data Manager Admin'){ ?>
                                         <input type="submit" id="submitBtn" name="submit" value="SUBMIT" class="btn btn-primary">  
                                        <?php }?> 
                                    </div>
                                </div>
                            </form>
 
                        </div>
						 </div>

						
						<!-- </div>
                    </div>
                </div>
				
				
				
				
				
            </div>
        </div> -->

        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="disClose()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 class="font-bold">View People Present</h3>
                        </div>
                        <div class="modal-body" id="1">
                         <!--  <button class="btn btn-primary" onclick="addCategory()">Add Category</button> -->
                         <div id="add1">
                         	
                         </div>
                     
                          <div class="table-responsive">
                           <table class="table table-striped table-hover">
                                                <thead>
                                                <tr style="background-color: rgb(68, 68, 68);color: white;">
                                                 <td>Sr No</td>
                                                 <td>Name</td>
                                                 <td>Designation</td>
                                                 <td>Organisation</td>
                                                 <td>Contact Info</td>   
                                                 <td>Action</td>
                                                </tr>
                                                </thead>
                                                <tbody id="tableData1">
                                                  
        <!-- Data come from JS  -->
                              </tbody>
                            </table>
                         </div>
                       </div>
                   </div>
                </div>
            </div>
   
           <div class="modal inmodal" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="disClose()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 class="font-bold">View Upload Photographs</h3>
                        </div>
                        <div class="modal-body" id="1">
                         <!--  <button class="btn btn-primary" onclick="addCategory()">Add Category</button> -->
                         <div id="photoTable">
                         	
                         </div>
                     
                         
                       </div>
                   </div>
                </div>
            </div>


             <div class="modal inmodal" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="disClose()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 class="font-bold">Update People Present</h3>
                        </div>
                        <div class="modal-body" id="addFilterId" >
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/editPeople" >
                               <div class="form-group" style="margin:0px;">
                                   <div class="row">
                                       <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Name</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="name" class="form-control name">
                                           </div>
                                       </div>

                                        <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Designation</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="designation" class="form-control designation">
                                           </div>
                                       </div>

                                                <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Organisation</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="organisation" class="form-control organisation">
                                           </div>
                                       </div>

                                               <div class="col-lg-12">
                                           <label class="col-sm-2 control-label">Contact Info</label>
                                           <div class="col-sm-10">
                                               <input type="text" onkeypress="return isNumberKey(event,this)" maxlength="10"  name="contact" class="form-control contact">
                                           </div>
                                       </div>

                                        <input type="hidden" class="dataId" name="dataId" value="">

                                        <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <!--  <button type="button" class="btn btn-white" data-dismiss="modal" onclick="disClose()">Cancel</button> -->
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                        </div>
                                       
                                   </div>
                               </div>
                           </form>    
                       </div>
                   </div>
                </div>
            </div>

  


             <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="disClose()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 class="font-bold">Add People Present</h3>
                        </div>
                        <div class="modal-body" id="addFilterId" >
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addPeople" >
                               <div class="form-group" style="margin:0px;">
                                   <div class="row">
                                       <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Name</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="name" class="form-control name">
                                           </div>
                                       </div>

                                        <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Designation</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="designation" class="form-control designation">
                                           </div>
                                       </div>

                                                <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Organisation</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="organisation" class="form-control organisation">
                                           </div>
                                       </div>

                                               <div class="col-lg-12">
                                           <label class="col-sm-2 control-label">Contact Info</label>
                                           <div class="col-sm-10">
                                               <input type="text" maxlength="10" onkeypress="return isNumberKey(event,this)"  name="contact" class="form-control contact">
                                           </div>
                                       </div>


                                        <input type="hidden" class="campId" name="campId" value="">

                           
                                        <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <!--  <button type="button" class="btn btn-white" data-dismiss="modal" onclick="disClose()">Cancel</button> -->
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                        </div>
                                       
                                   </div>
                               </div>
                           </form>    
                       </div>
                   </div>
                </div>
            </div>

  
        <div class="footer">
            
        </div>

        </div>
        </div>
      <script type="text/javascript">

      	  <?php $otherAccess = $this->session->userdata('otherAccess');  //print_r($this->session->all_userdata()); exit(); ?>		
			var pausecontent=new Array();
           <?php 
           		if (is_array($otherAccess) || is_object($otherAccess)){
           foreach ($otherAccess as $key => $val) { ?>
           pausecontent.push('<?php echo $val?>');
          <?php  }}?>

				console.log(pausecontent)
				if(pausecontent.length > 0){
					var idx = $.inArray('campReport',pausecontent);
				}else{
					var idx = -1;
				}
               
             //  console.log(idx);
			// window.onload = function() {
			// 			   alert('aaa');
			// 			   getDistrictFilter();
			// 			   	getDistrict();
			// 			 //  getAddressDistrict();
			// 		};




      function setDistrictCode()
      {
          var districtId = $('#district').val();
    		
				     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/getDistrictInfo",
						data: {districtId:districtId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;
							  

							 if(len != 0)
							 {
							 	$('#districtCode').val(result[0].districtCode);
							 	checkUniqueCode();
							 }	
						}
					});
      }	

      	function setStateCode()
      	{
      			var stateId = $('#state').val();
    		
				     $.ajax({
				     	//async:true,
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/getStateInfo",
						data: {stateId:stateId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;
							

							 if(len != 0)
							 {
							 	$('#stateCode').val(result[0].stateCode);
							 	$('#districtCode').val('');
							 	checkUniqueCode();
							 }	
						}
					});
      	}


      	function calculateCloseStock(){

      	/*	alert(Number($('#wastage').val()) + Number($('#consumed').val()) + Number($('#kitsReturned').val()) + Number($('#control').val()));*/

			var closing_stock = (Number($('#openingStock').val()) + Number($('#received').val())) - (Number($('#wastage').val()) + Number($('#consumed').val()) + Number($('#kitsReturned').val()) + Number($('#control').val()));
			$('#closingStock').val(closing_stock);
      	}

      	function calculateTotalCost()
      	{
      		var totalCost = (Number($('#rentingCost').val()) + Number($('#mobilisationCost').val()) + Number($('#consumablesCost').val()) + Number($('#transportingCost').val()) + Number($('#otherCost').val()));

      		$('#cbsCost').val(totalCost);
      	}

      	function calculateConsumed()
      	{
      		var consumed = (Number($('#openingStock').val()) + Number($('#received').val())) - (Number($('#wastage').val()) + Number($('#kitsReturned').val()) + Number($('#control').val()) );

      		$('#consumed').val(consumed);

      	/*   	var closing_stock = (Number($('#openingStock').val()) + Number($('#received').val())) - (Number($('#wastage').val())  + Number($('#control').val())  + Number($('#kitsReturned').val())  + Number($('#consumed').val()));
			$('#closingStock').val(closing_stock);*/	
      	}

      	function checkConsumed()
      	{
      		/*alert(Number($('#consumed').val()));

      		alert(Number($('#openingStock').val()) + Number($('#received').val()));*/
      	   if(Number($('#consumed').val()) > (Number($('#openingStock').val()) + Number($('#received').val())) )
      	   {
      	   	 //alert('a');
      	   	  $('#consumedSpan').css('display','block');

              $('#saveBtn').attr('type','button');

              $('#submitBtn').attr('type','button');


      	   }else{
                 // alert('b');
                  $('#consumedSpan').css('display','none');

              $('#saveBtn').attr('type','submit');

              $('#submitBtn').attr('type','submit');
			}		
      	}

      	function checkUniqueCode()
      	{
      	  //var campCode = $('#campCode').val();

      	  var campCode = $('#stateCode').val().toUpperCase()+'/'+$('#districtCode').val().toUpperCase()+'/'+$('#campCode1').val();

      	// alert(campCode);

      	   $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/checkCampUniqueCode",
						data: {campCode:campCode},
						success: function(data) {
						     
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							// alert(result[0].camp_code);
							 
							   if(len != 0)
							   {
							   	 //alert('a');
							 
                                  $('#campCodeSpan').css('display','block');

                                  $('#saveBtn').attr('type','button');

                                  $('#submitBtn').attr('type','button');
							   }else{
							   	 //alert('b');
							 
                                      $('#campCodeSpan').css('display','none');

                                  $('#saveBtn').attr('type','submit');

                                  $('#submitBtn').attr('type','submit');
							   }	
						}
					});

      	  

      	}


      	var lt = 0;var lg = 0;
      	var count = 0;var count1 = 0;
      	var k = 0; var i =0;
      	function appendInfoDiv()
      	{
      		var ht = '';

      		var ht = '<div  id="campDetail'+(k+1)+'"><i number="'+(k+1)+'" id="campDetailCross'+(k+1)+'" class="fa fa-times" onclick="removeCampDetail(this)"></i><div class="form-group"><div class="col-sm-6"><label class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" name="presentName[]"></div></div><div class="col-sm-6"><label class="col-sm-2 control-label">Designation</label><div class="col-sm-10"><input type="text" class="form-control" name="presentDesignation[]"></div></div>				</div><div class="form-group"><div class="col-sm-6"><label class="col-sm-2 control-label">Organisation</label><div class="col-sm-10"><input type="text" class="form-control" name="presentOrganisation[]"></div></div><div class="col-sm-6"><label class="col-sm-2 control-label">Contact Info</label><div class="col-sm-10"><input type="text" class="form-control" onkeypress="return isNumberKey(event,this)"   maxlength="10" name="contact[]"></div></div></div><div class="hr-line-dashed"></div>';
                 
               count++;   
             $('.count').val(count);  

      		  $("#dataId").append(ht);
                k++;

      	}

      	function appendInfoDivPhoto()
      	{
      		var ht = '';

      	    ht += '<div  id="photoDiv'+(i+1)+'"><i number="'+(i+1)+'" id="campDetailCross'+(i+1)+'" class="fa fa-times" onclick="removePhoto(this)"></i><div class="form-group"><div class="col-sm-6"><label class="control-label">Upload photograph</label></div><div class="col-sm-6"><div class="col-sm-10"><input type="file" class="form-control image"  name="image[]"></div></div></div></div>'
                 
               count1++;   
             //$('.count').val(count);  

      		  $("#dataId1").append(ht);
                i++;

               if($('.image').length == 5)
               {
                 $('#addImage').css('display','none');
               }
               else
               {
                $('#addImage').css({'display':'inline-block'});
               }         

      	}


      	function removeCampDetail(val)
      	{
      		var id = $(val).attr('number');

      		 count--;   

      		   $('.count').val(count);  

      		$("#campDetail"+id).html('');       
      	}

        
      	function removePhoto(val)
      	{
      		var id = $(val).attr('number');

      		// count--;   

      		//   $('.count').val(count);  

      		$("#photoDiv"+id).html('');  


      		    if($('.image').length == 5)
               {
                 $('#addImage').css('display','none');
               }
               else
               {
                $('#addImage').css({'display':'inline-block'});
               }         
      	}

      	function getDistrict()
		{
			//alert("getDistrict");
				var stateId = $('#state').val();
    		
				     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/getDistrict",
						data: {state:stateId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;
							if(len==0){
								var htm = '';
									htm += '<option value="" readonly>No District</option>';

									
									$("#district").html(htm);
									
							}else{
								var htm = '';
									htm += '<option value="" readonly>Select District</option>';
									for(var i = 0; i < len; i++){
                                       if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['addressDistrict'];} ?>'){
							                   htm += '<option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option>';
						                  }else{
							                htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						                 }
						
									}
								
									$("#district").html(htm);
								
							} 
						}
					});

		}


		function isWholeNumberKey(evt,element){

			/*var charCode = (evt.which) ? evt.which : event,this.keyCode
			//alert(charCode);
			if ((charCode != 46 && evt.srcElement.value.split('.').length==1) && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;*/
			var charCode = (evt.which) ? evt.which : event.keyCode
			
			 // if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 8))
			    return false;
			  else {
			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');
			    if (index > 0 && charCode == 46) {
			      return false;
			    }
			    // if (index > 0) {
			    //   var CharAfterdot = (len + 1) - index;
			    //   if (CharAfterdot > 3) {
			    //     return false;
			    //   }
			    // }

			  }
		}


		function isNumberKeyMaxLimit(evt,element){
			/*var charCode = (evt.which) ? evt.which : event,this.keyCode
			//alert(charCode);
			if ((charCode != 46 && evt.srcElement.value.split('.').length==1) && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;*/
			var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 8))
			    return false;
			  else {
			    var len = $(element).val().length;
			    // var index = $(element).val().indexOf('.');
			    // if (index > 0 && charCode == 46) {
			    //   return false;
			    // }
			    // alert(len);
			    if (len === 4) {		     
			        return false;
			    }

			  }
		}


        function isNumberLatLong(evt,element){
			

			var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			    return false;
			  else {

			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');
			    //alert($(element).val().charAt(2));
			    
			    if (len > 1 ) {
				    if( $(element).val().charAt(2) == '.' || charCode == 46){

					    if (index > 0 && charCode == 46) {
					      return false;
					    }
					    if (index > 0) {
					      var CharAfterdot = (len + 1) - index;
					      if (CharAfterdot > 7) {
					        return false;
					      }
					    }	
				    }else{
						return false;
				    }	
			    }
			    

			    

			    
				
			  }
		}

		function isNumberCostFormat(evt,element){
			

			var charCode = (evt.which) ? evt.which : event.keyCode;
			var number = element.value.split('.');
			if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8)){
				return false;
			}

			if(number.length>1 && charCode == 46){
				return false;
			}


			var len = $(element).val().length;
			var index = $(element).val().indexOf('.');
		    
		    if (index > 0) {
		      var CharAfterdot = (len + 1) - index;
		      if (CharAfterdot > 3) {
		        return false;
		      }
		    }
		    
			if(number[0].length >= 4){
				if (charCode == 46 || $(element).val().charAt(4) == '.'){
					if (index > 0) {
						var CharAfterdot = (len + 1) - index;
						if (CharAfterdot > 3) {
							return false;
						}
				    }
				}else{
					return false;
				}
			}

		}

     	function isNumberDisFormat(evt,element){
			

			var charCode = (evt.which) ? evt.which : event.keyCode;
			var number = element.value.split('.');
			if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8)){
				return false;
			}

			if(number.length>1 && charCode == 46){
				return false;
			}


			var len = $(element).val().length;
			var index = $(element).val().indexOf('.');
		    
		    if (index > 0) {
		      var CharAfterdot = (len + 1) - index;
		      if (CharAfterdot > 2) {
		        return false;
		      }
		    }
		    
			if(number[0].length >= 2){
				if (charCode == 46 || $(element).val().charAt(2) == '.'){
					if (index > 0) {
						var CharAfterdot = (len + 1) - index;
						if (CharAfterdot > 2) {
							return false;
						}
				    }
				}else{
					return false;
				}
			}

		}



	
		function isNumberKey1(evt,element){
			/*var charCode = (evt.which) ? evt.which : event,this.keyCode
			//alert(charCode);
			if ((charCode != 46 && evt.srcElement.value.split('.').length==1) && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;*/
			var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			    return false;
			  else {
			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');
			    if (index > 0 && charCode == 46) {
			      return false;
			    }
			    
			    //alert(index);
			    if (index > 0) {
			      var CharAfterdot = (len + 1) - index;
			      if (CharAfterdot > 3) {
			        return false;
			      }
			    }
			    if (len > 4) {		     
			        return false;
			    }

			  }
		}

		function isNumberKey3(evt,element){
			/*var charCode = (evt.which) ? evt.which : event,this.keyCode
			//alert(charCode);
			if ((charCode != 46 && evt.srcElement.value.split('.').length==1) && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;*/
			var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			    return false;
			  else {
			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');


			    if (len > 1 ) {
				    if( $(element).val().charAt(3) == '.' || charCode == 46){

					    if (index > 0 && charCode == 46) {
					      return false;
					    }
					    if (index > 0) {
					      var CharAfterdot = (len + 1) - index;
					      if (CharAfterdot > 3) {
					        return false;
					      }
					    }	
				    }else{
						return false;
				    }	
			    }

			    // if (index > 0 && charCode == 46) {
			    //   return false;
			    // }
			    // if (index > 0) {
			    //   var CharAfterdot = (len + 1) - index;
			    //   if (CharAfterdot > 2) {
			    //     return false;
			    //   }
			    // }

			  }
		}

        function isNumberKey2(evt,element){
			/*var charCode = (evt.which) ? evt.which : event,this.keyCode
			//alert(charCode);
			if ((charCode != 46 && evt.srcElement.value.split('.').length==1) && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;*/
			var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			    return false;
			  else {
			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');
			    if (index > 0 && charCode == 46) {
			      return false;
			    }
			    if (index > 0) {
			      var CharAfterdot = (len + 1) - index;
			      if (CharAfterdot > 5) {
			        return false;
			      }
			    }

			  }
		}


		function checkOption()
		{     
          if( $('#coodOth').prop('checked') == true)
          {  
          	 $('#othercodetail').prop('required',true);
          	 $('#othercoor').css('display','block'); 
          }else{
          	$('#othercodetail').prop('required',false);
          	$('#othercoor').css('display','none'); 
          }
		}

		function viewPeoplePresent(campId,submit)
		{
			//var pausecontent = new Array();

			var userType = '<?php echo $this->session->userdata('userType')?>';
            
         
 									
			
			var roleType = '<?php echo $this->session->userdata('roleType'); ?>'
			
     			     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/viewPeoplePresent",
						data: {campId:campId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							    var htm = '';

                               var html = '';
                    
                       
                            if(userType != 'admin')   
                             {
                              if(submit == 'N' || idx == -1)	
                              {	
                               html = '<button class="btn btn-primary" onclick="addPeople('+campId+')">ADD 1 MORE</button>';
                             }
                            }else if(userType == 'admin' || idx == -1) {
                            	 html = '<button class="btn btn-primary" onclick="addPeople('+campId+')">ADD 1 MORE</button>';
                            }

							       for(i = 0;i < len;i++)
					                {
					                    k = i+1;
					                   /* var id = "id"; 
					                    var table = "tbl_item_subcategories";*/

					                    htm += '<tr id="rowId'+k+'"> <td>'+k+'</td><td>'+result[i].name+'</td><td>'+result[i].designation+'</td><td>'+result[i].organisation+'</td><td>'+result[i].contactInfo+'</td><td class="client-status">';

								  if(userType != 'admin')   
								     {
								            if(submit == 'N' || idx == -1)	
								            {	

					                   htm +=  '<span class="abel label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                
					                     htm +=  '<span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew('+result[i].id+','+"'id'"+','+"'tbl_camp_peoples'"+')">Delete</span></td></tr>';
					                 }
                                    }else if(userType == 'admin' || idx == -1){
                                    	
					                   htm +=  '<span class="abel label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                
					                     htm +=  '<span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew('+result[i].id+','+"'id'"+','+"'tbl_camp_peoples'"+')">Delete</span></td></tr>';
                                    }
					            
					               }

					               $('#tableData1').html(' ');
					                  
					                   $('#tableData1').html(htm);

					                      $('#add1').html(' ');
					                  
					                   $('#add1').html(html);

					                   $('#myModal2').modal();

						
						}
					});
		}

	  function editPeoplePresent(peopleId)
	  {
           $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/editPeoplePresent",
						data: {peopleId:peopleId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							    var htm = '';

							   

						/*	    $("#1").html(" ");
						$("#3").append('<input type="hidden" class="dataId" name="dataId" value="'+dataId+'"><input type="hidden" class="extra" name="extra" value="extra">');
						$("#1").append($("#2").html());*/
						$('.dataId').val(result[0].id);
						$('.name').val(result[0].name);
						$('.designation').val(result[0].designation);
						$('.organisation').val(result[0].organisation);
						$('.contact').val(result[0].contactInfo);


						$('#myModal2').modal('hide');
						$('#myModal3').modal();
						/*$('.remark').val(result[0].credits);
						$('.link').val(result[0].link);
						$('.package').val(result[0].packageName);
						$('.filter').val(result[0].filterId);
						$('.duration').val(result[0].timeDuartionId);
						$('.showImage').attr('src', result[0].image).width(126).height(114);
						$('.showImage1').attr('src', result[0].thumbnail).width(126).height(114);*/


							     
						
						}
					}); 
	  }

	  function addPeople(campId)
	  {
         $('#myModal2').modal('hide');
         $('.campId').val(campId);
         $('#myModal4').modal();
	  }

	 function checkRights()
	{
		if($(":checkbox:checked").length == 0)
		{
			//alert($(":checkbox:checked").length);
		  	alert('Select atleast one option in coordinated with');	
	
			$('#rightSpan').css({'display':'block'});
			//$('#submitForm').attr('type','button');
			return false;
		}
		else{
			//alert($(":checkbox:checked").length);
			$('#rightSpan').css({'display':'none'});
			//$('#submitForm').attr('type','submit');	

			return true;
		}	
		//return false;

	}

	function checkLat()
	{
      var latitude = $('#latitude').val()

        if(latitude > 99.999999)
        {
          $('#latSpan').css('display','block');
          $('#submitForm').attr('type','button');
          lt = 1;
        }
        else{
        	 $('#latSpan').css('display','none');
        	 $('#submitForm').attr('type','submit');
        	 lt = 0;	

        }	
	}


	function checkLng()
	{
      var longitude = $('#longitude').val()

        if(longitude > 99.999999)
        {
          $('#lngSpan').css('display','block');
          $('#submitForm').attr('type','button');
          lg = 1;
        }
        else{
        	 $('#lngSpan').css('display','none');
        	 $('#submitForm').attr('type','submit');
        	 lg = 0;	

        }	
	}

	

	function checkDis(distance)
	{
        disValue = $(distance).val();

        if(disValue > 99.9)
       { 	
       	
        //alert("Distance cann't be more than 99.9 ");
        alert("Error: A Distance field value cannot be more than 99.9");
           //$('#submitForm').attr('type','button');
       }else{
          //$('#submitForm').attr('type','button');
       } 
	}

	function checkDisVal()
	{
	 
       var ictcDistance = $('#ictcDistance').val();

       var healthDistance = $('#healthDistance').val();

       var providerDistance = $('#providerDistance').val();

      if((ictcDistance > 99.9) || (healthDistance > 99.9) || (providerDistance > 99.9)) 
      {
      	 alert("Distance cann't be more than 99.9");

      	 return false;
      }else{
      	 return true;
      }	
	}

	function checkConsumedOther()
	{
		   if(Number($('#consumed').val()) > (Number($('#openingStock').val()) + Number($('#received').val())) )
      	   {
      	   	 //alert('a');
      	   	  $('#consumedSpan').css('display','block');
/*
              $('#saveBtn').attr('type','button');

              $('#submitBtn').attr('type','button');*/

              return false;


      	   }else{
                 // alert('b');
                  $('#consumedSpan').css('display','none');

         /*     $('#saveBtn').attr('type','submit');

              $('#submitBtn').attr('type','submit');*/

              return true;
			}		
	}

	function checkCost(cost)
	{
		var costValue = $(cost).val();

		 if(costValue > 9999.99)
	       { 	
	        alert("Cost cann't be more than 9999.99");
	           //$('#submitForm').attr('type','button');
	       }else{
	          //$('#submitForm').attr('type','button');
	       } 
	}

	function checkCostVal()
	{
	 
       var cbsCost = $('#cbsCost').val();

       var rentingCost = $('#rentingCost').val();

       var mobilisationCost = $('#mobilisationCost').val();

       var consumablesCost  = $('#consumablesCost').val();

       var transportingCost = $('#transportingCost').val();

       var otherCost = $('#otherCost').val();

      if((cbsCost > 9999.99) || (rentingCost > 9999.99) || (mobilisationCost > 9999.99) || (consumablesCost > 9999.99) ||  (transportingCost > 9999.99) || (transportingCost > 9999.99)) 
      {
      	 alert("Cost cann't be more than 9999.99");

      	 return false;
      }else{
      	 return true;
      }	
	}

	function getDistrictFilter()
	{
      
				var stateId = $('#stateFilter').val();
    		
				     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/getDistrict",
						data: {state:stateId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;
							if(len==0){
								var htm = '';
									htm += '<option value="" readonly>No District</option>';

									
									  $('#districtFilter').html(''); 
									$("#districtFilter").html(htm);
									$('#districtFilter').trigger("chosen:updated");
									
							}else{
								var htm = '';
									htm += '<option value="" readonly>Select District</option>';
									for(var i = 0; i < len; i++){
                                       if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['addressDistrict'];} ?>'){
							                   htm += '<option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option>';
						                  }else{
							                htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						                 }
						
									}
								
									  $('#districtFilter').html(''); 
									$("#districtFilter").html(htm);
									$('#districtFilter').trigger("chosen:updated");
								
							} 
						}
					});
 
	}

	function getDistrictStock()
	{
		var stateId = $('#stateStock').val();
    		
				     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/getDistrict",
						data: {state:stateId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;
							if(len==0){
								var htm = '';
									htm += '<option value="" readonly>No District</option>';

									
									  $('#districtStock').html(''); 
									$("#districtStock").html(htm);
									$('#districtStock').trigger("chosen:updated");
									
							}else{
								var htm = '';
									htm += '<option value="" readonly>Select District</option>';
									for(var i = 0; i < len; i++){
                                       if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['addressDistrict'];} ?>'){
							                   htm += '<option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option>';
						                  }else{
							                htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						                 }
						
									}
								
									  $('#districtStock').html(''); 
									$("#districtStock").html(htm);
									$('#districtStock').trigger("chosen:updated");
								
							} 
						}
					});

	}

	function  viewUploadPhoto(campId)
	{
	  //alert(campId);
       var userType = '<?php echo $this->session->userdata('userType')?>';


			
		var roleType = '<?php echo $this->session->userdata('roleType'); ?>'		
			//alert(userType);
     			     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/viewUploadPhoto",
						data: {campId:campId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							    var htm = '';

                               var htm1 = '';

                               var htm2 = ' ';

                               var htm3 = ' ';

                               var htm4 = ' ';

                               var submit = result[0]['submit'];
                               

                           var htmlTable = '<div class="table-responsive"><table class="table table-striped table-hover"><thead><tr style="background-color: rgb(68, 68, 68);color: white;"><td>Photo</td><td>Action</td></tr></thead><tbody id="tableDataPhoto">';
                                                 
        
                     

                            var base_url_new  = '<?php echo base_url()."uploads/campImage/" ?>'
			  
							     if(result[0].image)
							     {
							     	   console.log(result[0].image);

							     	  htmlTable += "<tr><td><img style='width:50px;height:50px;' src = '"+base_url_new+result[0].image+"'></td>" ; 
							     

							     	  if(userType != 'admin')   
								     {
								            if(submit == 'N' || idx == -1)	
								            {	
/*
					                   htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editImage('+campId+',"++")">Edit</span>';
					                */
					                    /* htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';*/

					                    htmlTable += '<td></td></tr>';
					                 }
                                    }else{
                                    	
					                 /*  htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';*/
					                
					                     /*htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';*/

					                     htmlTable += '<td></td></tr>';
                                    }

                                    /*  $('#img1').html(' ');

                                    $('#img1').html(htm);


							     	$('#img1').css('display','inline');*/
							     }
                                  

							     if(result[0].image1)
							     {
							     	   //console.log(result[0].image);

							     	 htmlTable += "<tr><td><img style='width:50px;height:50px;' src = '"+base_url_new+result[0].image1+"'></td>" ; 
							     

							     	  if(userType != 'admin')   
								     {
								            if(submit == 'N' || idx == -1)	
								            {	

					                  /* htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                   /*  htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image1'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';*/
					                   htmlTable += '<td></td></tr>';
					                 }
                                    }else{
                                    	
					               /*    htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                    /* htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image1'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';*/

					                    htmlTable += '<td></td></tr>';
                                    }

                                /*    $('#img2').html(' ');

                                    $('#img2').html(htm1);


							     	$('#img2').css('display','block');*/
							     }


							     if(result[0].image2)
							     {
							     	 //  console.log(result[0].image);

							     	 htmlTable += "<tr><td><img style='width:50px;height:50px;' src = '"+base_url_new+result[0].image2+"'></td>" ; 
							     

							     	  if(userType != 'admin' )   
								     {
								     	

								            if(submit == 'N' || idx == -1)	
								            {	

					               /*    htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                     htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image2'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';
					                 }
                                    }else if(userType == 'admin' || idx == -1){
                                    	
					               /*    htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';*/
					                
					                     htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image2'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';
                                    }

                                   /*   $('#img3').html(' ');

                                    $('#img3').html(htm2);


							     	$('#img3').css('display','block');*/
							     }


							     if(result[0].image3)
							     {
							     	 //  console.log(result[0].image);

							     	 htmlTable += "<tr><td><img style='width:50px;height:50px;' src = '"+base_url_new+result[0].image3+"'></td>" ; 
							     

							     	  if(userType != 'admin')   
								     {
								            if(submit == 'N' || idx == -1)	
								            {	

					                  /* htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                     htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image3'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';
					                 }
                                    }else  if(userType == 'admin' || idx == -1){
                                    	
					                /*   htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                     htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image3'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';
                                    }

                                    /*  $('#img4').html(' ');

                                    $('#img4').html(htm3);


							     	$('#img4').css('display','block');*/
							     } 
							      

							       if(result[0].image4)
							     {
							     	 //  console.log(result[0].image);

							     	 htmlTable += "<tr><td><img style='width:50px;height:50px;' src = '"+base_url_new+result[0].image4+"'></td>" ; 
							     

							     	  if(userType != 'admin' )   
								     {
								            if(submit == 'N' || idx == -1)	
								            {	

					             /*      htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                     htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image4'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';
					                 }
                                    }else if(userType == 'admin' || idx == -1){
                                    	
					                  /* htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span>';
					                */
					                     htmlTable +=  '<td><span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew1('+campId+','+"'image4'"+','+"'tbl_camp_reports'"+')">Delete</span></td></tr>';
                                    }

                                    /*  $('#img5').html(' ');

                                    $('#img5').html(htm4);


							     	$('#img5').css('display','block');
*/							     }

							         htmlTable += '</tbody></table></div>'; 

							   /*   alert(htmlTable);   */

							     $('#photoTable').html(htmlTable);    
							     

							     $('#myModal5').modal();	
					               						
						}
					});
	}


	/*function checkLatlng(var)
	{
       alert('hajdhakj');
	}
*/
	/*  function checkCost()
	  {
	  	  var cbs = $('.cbsCost').val();

	  	  var
	  }
*/
      </script>  
		
		
		
