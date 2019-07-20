<style>
.none{
	display:none !important;
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
                             
								<li class="active"><a data-toggle="tab" href="#tab-1">
								<i class="fa fa-user"></i>Update Entry</a>
								</li>
								  
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					
						 <div id="tab-1" class="tab-pane active">
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
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateCampReport" onsubmit="return checkRights() && checkDisVal() && checkCostVal() && checkConsumedOther();">

							<fieldset>
							  <legend>BASIC DETAILS:</legend>	
	
                          	<input type="hidden" name="campId" id="campId" value="<?php echo $campId ?>">
							  								
								<div class="hr-line-dashed"></div>
								  <div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Date Of Camp<span class="required">*</span></label>
											<div class="col-sm-10">
											  <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>		
												<input type="text" class="form-control" name="campDate" id=""  value="<?php if(!empty($campReport[0]['date_of_camp'])){echo date('d-m-Y',strtotime($campReport[0]['date_of_camp']));} ?>" required>
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
										<input type="text" class="form-control clockpicker" value="<?php if(!empty($campReport[0]['start_time'])){echo $campReport[0]['start_time'];} ?>" name="startTime" readonly  mousewheel="false">	
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
										<input type="text" class="form-control clockpicker" value="<?php if(!empty($campReport[0]['end_time'])){echo $campReport[0]['end_time'];} ?>" name="endTime" readonly  mousewheel="false">
									</div>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">State<span class="required">*</span></label>
										<div class="col-sm-10">
										 <select class="form-control" onchange="getDistrict();()"  tabindex="11"  id="state" name="state" required>
						 		       <option value="" >Select State</option>
									     <?php foreach($stateList as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>" <?php if($campReport[0]['state'] == $data['stateId']){ echo 'selected'; }?>><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>				
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">District<span class="required">*</span></label>
										<div class="col-sm-10">
										<select  name="district" tabindex="12" id="district" required class="form-control">
									     <option value="" readonly>Select District</option>							
							         </select>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								 <div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Camp Code<span class="required">*</span></label>
											<div class="col-sm-10">
											<?php $campCode = explode('/', $campReport[0]['camp_code']); ?>	
												<div class="col-sm-1" style="width: 12.499999995%">
													
													<input type="text" maxlength="2" minlength="2" onblur="checkUniqueCode()"  value="<?php echo $campCode[0] ?>" name="stateCode"  id="stateCode"  class="form-control">
													 <span style="width: 30% !important;color: red">State- 2 Character Code</span>
													
												</div>
												
												<div class="col-sm-1" style="width: 12.499999995%">
													<input type="text" maxlength="2" minlength="2" onblur="checkUniqueCode()" value="<?php echo $campCode[1] ?>" name="districtCode"  id="districtCode" class="form-control">
												 <span style="color: red">District- 2 Character Code</span>	
												</div>
												
												<div class="col-sm-2">
													<input type="text" onkeypress="return isNumberKey(event)" onblur="checkUniqueCode()" value="<?php echo $campCode[2]; ?>" required id="campCode1" name="campCode1" minlength="3" maxlength="3" class="form-control">
												<span style="color: red">3 digit sequence</span>	
												</div>
											
												<!-- <div class="col-sm-2">
													<input type="text" onblur="checkUniqueCode()" value="<?php echo substr($campCode[2],1,1); ?>" required id="campCode2" name="campCode2" maxlength="1" class="form-control">
												</div>
											
												<div class="col-sm-2">
													<input type="text" value="<?php echo substr($campCode[2],2,1); ?>" id="campCode3" required name="campCode3" onblur="checkUniqueCode()" maxlength="1" class="form-control">
												</div> -->
													<span id="campCodeSpan" style="display: none;color: red">Camp Code already used. Choose another</span>
												<!-- <input type="text" onchange="checkUniqueCode()" class="form-control" name="campCode" id="campCode"  value="<?php echo $campReport[0]['camp_code']?>" required>
												<span id="campCodeSpan" style="display: none;color: red">Camp Code already used. Choose another</span>	 -->
											</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Block</label>
										<div class="col-sm-10">
										<input type="text"   value="<?php echo $campReport[0]['block']?>" class="form-control" name="block">		
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Site<span class="required">*</span></label>
										<div class="col-sm-10">
										 <input type="text" value="<?php echo $campReport[0]['site']?>" class="form-control" required name="site">		
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Latitide<span class="required">*</span></label>
										<div class="col-sm-10">
										 <input type="text" onkeypress="return isNumberLatLong(event,this)" onchange="checkLat()" id="latitude"  class="form-control" required  value="<?php echo $campReport[0]['latitude']?>" name="latitude">	
										  <span id="latSpan" style="display: none;color: red">Latitude should be equal to or below 99.9999</span>	
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Longitude<span class="required">*</span></label>
										<div class="col-sm-10">
										<input type="text" required onkeypress="return isNumberLatLong(event,this)" onchange="checkLng()" id="longitude"  value="<?php echo $campReport[0]['longitude']?>"  class="form-control" name="longitude">	
										 <span id="lngSpan" style="display: none;color: red">Longitude should be equal to or below 99.9999</span>		
										</div>
									</div>
								</div>
						</fieldset>	
							<span onclick="viewPeoplePresentEdit('<?php echo $campId; ?>')" class="btn-primary btn">View People Present</span>		
    <!--  <div class="hr-line-dashed"></div>
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
										<input type="text" class="form-control" name="contact[]">		
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

                         -->     

                               <div class="hr-line-dashed"></div>
                               <fieldset style="padding: 0 2%;">
							  <legend>JUSTIFICATION OF CAMP LOCATION:</legend>	   
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Distance from Nearest ICTC in Kms<span class="required">*</span></label>
									<!-- </div>
									<div class="col-sm-6">	 -->
										<!-- <div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberDisFormat(event,this)"  onchange="checkDis(this)"  class="form-control" required id="ictcDistance"  value="<?php echo $campReport[0]['nearset_ictc']?>" name="ictcDistance">		
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
										 <input type="text" onkeypress="return isNumberDisFormat(event,this)" id="healthDistance" onchange="checkDis(this)"  class="form-control" required  value="<?php echo $campReport[0]['nearest_health_facility']?>" name="healthDistance">		
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
										 <input type="text" required onkeypress="return isNumberDisFormat(event,this)" id="providerDistance" onchange="checkDis(this)"   class="form-control"  value="<?php echo $campReport[0]['nearest_hiv_service_provider']?>" name="providerDistance">		
										</div>
									</div>
									
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Coordinated with<span class="required">*</span></label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										<!--  <select onchange="checkOption()" required class="chosen-select" multiple id="coordinated" name="coordinated[]" <?php if (strpos($campReport[0]['coordinated_with'],'DAPCU') !== false) {echo 'selected';}?>>
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
								<?php $array = explode(",",$campReport[0]['coordinated_with']); ?>		 

										 	<div class="checkbox"> 
										 <input type="checkbox" value="DAPCU" <?php if(in_array('DAPCU',$array)){echo 'checked';}?> name="coordinated[]">DAPCU	
										</div>
									<div class="checkbox">	 
										 <input type="checkbox" <?php if(in_array('ICTC',$array)){echo 'checked';}?> value="ICTC" name="coordinated[]">ICTC	
										</div>
									<div class="checkbox">	 
										  <input type="checkbox" <?php if(in_array('SACS',$array)){echo 'checked';}?> value="SACS" name="coordinated[]">SACS
									</div>
									<div class="checkbox">	  	
										 <input type="checkbox" <?php if(in_array('LWS',$array)){echo 'checked';}?> value="LWS" name="coordinated[]">LWS	
									</div>
									<div class="checkbox">	 
										 <input type="checkbox" <?php if(in_array('HIV Nodal',$array)){echo 'checked';}?> value="HIV Nodal" name="coordinated[]">HIV Nodal
								  </div>
								  <div class="checkbox">		 	
										 <input type="checkbox" <?php if(in_array('TI',$array)){echo 'checked';}?> value="TI" name="coordinated[]">TI	
								</div>
								<div class="checkbox">		 
										 <input type="checkbox" <?php if(in_array('ASHA',$array)){echo 'checked';}?> value="ASHA" name="coordinated[]">ASHA
								</div>
								<div class="checkbox">		 	
										 <input type="checkbox" <?php if(in_array('ANM',$array)){echo 'checked';}?> value="ANM" name="coordinated[]">ANM	
								</div>
								<div class="checkbox">		 
										  <input type="checkbox" <?php if(in_array('Others',$array)){echo 'checked';}?> value="Others" id="coodOth" onclick="checkOption()" name="coordinated[]">Others	 
								</div>		
									<div class="col-sm-7" style="display: none;color: red;" id="rightSpan">Select atleast one option</div>        
										</div>
									</div>
									
								 </div>
										<!-- </div> -->
									<!-- </div>
									
								</div> -->
						<?php //if($campReport[0]['coordinated_others']){?>		
							<div id="othercoor">	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Coordinated with Others Details</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										  <input type="text" value="<?php echo $campReport[0]['coordinated_others']?>" class="form-control" id="othercodetail" name="othercodetail">		
										</div>
									</div>
									
								</div>
							</div>
						<?php //}?>		
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
										 <input type="text" onkeypress="return isNumberKey1(event,this)"  class="form-control" required  value="<?php echo $campReport[0]['hrg_population']?>" name="hrg">		
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
										 <input type="text" onkeypress="return isNumberKey1(event,this)"  class="form-control" required value="<?php echo $campReport[0]['arg_population']?>" name="arg">		
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
										 <input type="text" maxlength="4" onkeypress="return isNumberKey1(event,this)"  class="form-control" required value="<?php echo $campReport[0]['in_migration']?>" name="inMigration">		
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
										 <input type="text" maxlength="4" onkeypress="return isNumberKey1(event,this)"  class="form-control" required  value="<?php echo $campReport[0]['out_migration']?>" name="outMigration">		
										<!-- </div> -->
									</div>
									
								</div>
                              <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">No Of Labourers</label>
								<!-- 	</div>
									 <div class="col-sm-6">	
										<div class="col-sm-10"> -->
										 <input type="text" onkeypress="return isNumberKey1(event,this)"  class="form-control"   value="<?php echo $campReport[0]['no_of_labourers']?>" name="labourers">		
										</div>
									</div>
									
							<!-- 	</div> -->
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
										<textarea name="activityDesc"  class="form-control"><?php echo $campReport[0]['activityDesc']?></textarea>		
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
										<input type="text" onkeypress="return isNumberKey(event,this)" value="<?php echo $campReport[0]['no_of_people_attended']?>" maxlength="3" required class="form-control" name="peopleAttened">
									</div>
                               	</div>

                               	  <div class="hr-line-dashed"></div>
 
 
                               	 <div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of people screened</label>
									</div>	
									<div class="col-sm-6">
										<input type="text" readonly="" value="<?php echo $campReport[0]['no_of_people_screened']?>" class="form-control" name="peopleScreend">
									</div>
                               	</div> 

                               	   <div class="hr-line-dashed"></div>
 
                               	 <div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of people found to be STR</label>
									</div>	
									<div class="col-sm-6">
										<input type="text" readonly="" value="<?php echo $campReport[0]['no_of_people_found_to_be_str']?>" class="form-control" name="peopleStr">
									</div>
                               	</div> 

                               	   <div class="hr-line-dashed"></div>

                               	 <div class="form-group">
                               		<div class="col-sm-6">
										<label class="control-label">No. of STR cases referred to ICTC<span class="required">*</span></label>
									</div>	
									<div class="col-sm-6">
										<input type="text" value="<?php echo $campReport[0]['no_of_str_cases_referred_to_ictc']?>" onkeypress="return isNumberKey(event,this)" maxlength="2" required class="form-control" name="strCases">
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
										<textarea name="challenges"  class="form-control"><?php echo $campReport[0]['challenges']?></textarea>		
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
										<textarea name="innovations"  class="form-control"><?php echo $campReport[0]['innovations']?></textarea>		
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
										<textarea name="learing"  class="form-control"><?php echo $campReport[0]['learing']?></textarea>		
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
										<textarea name="follow" required  class="form-control"><?php echo $campReport[0]['follow']?></textarea>		
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
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" id="rentingCost"  onchange="checkCost(this)" class="form-control"  value="<?php echo $campReport[0]['cost_for_renting']?>" name="rentingCost">		
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
										 <input type="text" onchange="calculateTotalCost()" value="<?php echo $campReport[0]['cost_of_consumables']?>" id="mobilisationCost" onkeypress="return isNumberCostFormat(event,this)"  onchange="checkCost(this)"  class="form-control" name="mobilisationCost">		
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
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)"  class="form-control" id="consumablesCost"  onchange="checkCost(this)"  value="<?php echo $campReport[0]['cost_of_mobilisation']?>" name="consumablesCost">		
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
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)"  class="form-control" id="transportingCost"  onchange="checkCost(this)"  value="<?php echo $campReport[0]['cost_of_transporting']?>" name="transportingCost">		
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
										 <input type="text" onchange="calculateTotalCost()" onkeypress="return isNumberCostFormat(event,this)" id="otherCost"  class="form-control"  onchange="checkCost(this)"  value="<?php echo $campReport[0]['other_major_cost']?>" name="otherCost">		
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
										 <input type="text"  value="<?php echo $campReport[0]['desc_for_other_cost']?>" class="form-control" name="otherCostDesc">		
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
										 <input type="text" readonly required  value="<?php echo $campReport[0]['cost_for_cbs']?>" id="cbsCost"  onchange="checkCost(this)" onkeypress="return isNumberCostFormat(event,this)"  class="form-control" name="cbsCost">		
										</div>
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
										 <input type="text" required value="<?php echo $campReport[0]['kits_name']?>" class="form-control" name="kitsName">		
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
										 <input type="text" required  value="<?php echo $campReport[0]['batch_no']?>" class="form-control" name="batch">		
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
										 <input type="text" required  value="<?php if(!empty($campReport[0]['expiry_date'])){echo date('d-m-Y',strtotime($campReport[0]['expiry_date']));} ?>" class="form-control" name="expiryDate">		
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
										 <input type="text" id="openingStock" maxlength="4" required onkeypress="return isWholeNumberKey(event,this)"  class="form-control"  value="<?php echo $campReport[0]['opening_stock']?>" name="openingStock">		
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
										 <input type="text" id="received" required maxlength="4" value="<?php echo $campReport[0]['received']?>" onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="received">		
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
												<input type="text" autocomplete="off" class="form-control" name="receivedDate" id=""  value="<?php if(!empty($campReport[0]['date_of_kits_received'])){echo date('d-m-Y',strtotime($campReport[0]['date_of_kits_received']));} ?>" required>
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
										 <input type="text" id="control" required maxlength="4" onkeypress="return isWholeNumberKey(event,this)"  class="form-control"  value="<?php echo $campReport[0]['control']?>" name="control">		
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
										 <input type="text" id="wastage" required maxlength="4" onkeypress="return isWholeNumberKey(event,this)"  class="form-control"  value="<?php echo $campReport[0]['wastage']?>" name="wastage">		
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
										 <input type="text"  id="kitsReturned" required maxlength="4" onkeypress="return isWholeNumberKey(event,this)"   value="<?php echo $campReport[0]['kits_returned']?>" class="form-control" name="kitsReturned">		
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
										 <input type="text" onchange="checkConsumed()" id="consumed" required maxlength="4"  value="<?php echo $campReport[0]['consumed']?>" onkeypress="return isWholeNumberKey(event,this)"  class="form-control" name="consumed">	
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
										 <input type="text" id="closingStock" readonly="readonly" required maxlength="4" onkeypress="return isWholeNumberKey(event,this)"  class="form-control"  value="<?php echo $campReport[0]['closing_stock']?>" name="closingStock">
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
										 <input type="text" required onkeypress="return isWholeNumberKey(event,this)"  class="form-control"  value="<?php echo $campReport[0]['quantity_indented']?>" name="quantityIndented">		
										</div>
									</div>
									
								</div>	

                              
                          
                           </fieldset>

                                  <div class="hr-line-dashed"></div>

                               <img class="img-responsive" onclick="myfunction('inputImage');"  id="image" src="<?php echo base_url().'uploads/campImage/'.$campReport[0]['image'];?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >
												<input  type="file" style="display:none;" name="Image[]" id="inputImage" class="image" value="" onchange="imageChange(this,'image')" >

								  <div class="hr-line-dashed"></div>				

                                    <input type="hidden" name="imageOld[]" value="1">
                                    <img class="img-responsive" onclick="myfunction('inputImage1');"  id="image1" src="<?php echo base_url().'uploads/campImage/'.$campReport[0]['image1'];?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >

									<input  type="file" style="display:none;" name="Image[]" id="inputImage1" class="image" value="" onchange="imageChange(this,'image1')" >

										  <input type="hidden" name="imageOld[]" value="2">
							  <div class="hr-line-dashed"></div>			  


									 <?php if(!$campReport[0]['image2']){?>
                                  	  <div class="hr-line-dashed"></div>	
							<div class="form-group">
                                   <div class="col-sm-2" >
                                     <span style="color:green;border-color:green;display: inline-block;" class="btn btn-white" id="addImage" onclick="appendInfoDivPhoto1('image2');">Add More Photograph</span>
                                        </div>
                                    </div>

                                  <?php }?>   


                                  <?php if($campReport[0]['image2']){?>
                                  	   <img class="img-responsive" onclick="myfunction('inputImage2');"  id="image2" src="<?php echo base_url().'uploads/campImage/'.$campReport[0]['image2'];?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >

									<input  type="file" style="display:none;" name="Image[]" id="inputImage2" class="image" value="" onchange="imageChange(this,'image2')" >
									  <input type="hidden" name="imageOld[]" value="3">

								  <div class="hr-line-dashed"></div>	  

									<div class="hr-line-dashed"></div>
										 <?php if(!$campReport[0]['image3']){?>
							<div class="form-group">
                                   <div class="col-sm-2" >
                                     <span style="color:green;border-color:green;display: inline-block;" class="btn btn-white" id="addImage" onclick="appendInfoDivPhoto('image3');">Add More Photograph</span>
                                        </div>
                                    </div>
                                   <?php }?>
                                  <?php }?>   

                                     <?php if($campReport[0]['image3']){?>
                                  	  <img class="img-responsive" onclick="myfunction('inputImage3');"  id="image3" src="<?php echo base_url().'uploads/campImage/'.$campReport[0]['image3'];?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >

									<input  type="file" style="display:none;" name="Image[]" id="inputImage3" class="image" value="" onchange="imageChange(this,'image3')" >
									  <input type="hidden" name="imageOld[]" value="4">

								  <div class="hr-line-dashed"></div>	  

									<div class="hr-line-dashed"></div>	
									 <?php if(!$campReport[0]['image4']){?>
							<div class="form-group">
                                   <div class="col-sm-2" >
                                     <span style="color:green;border-color:green;display: inline-block;" class="btn btn-white" id="addImage" onclick="appendInfoDivPhoto('image4');">Add More Photograph</span>
                                        </div>
                                    </div>
                                  <?php }?>
                                  <?php }?>   

                                     <?php if($campReport[0]['image4']){?>
                                  	    <img class="img-responsive" onclick="myfunction('inputImage4');"  id="image4" src="<?php echo base_url().'uploads/campImage/'.$campReport[0]['image4'];?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >

									<input  type="file" style="display:none;" name="Image[]" id="inputImage4" class="image" value="" onchange="imageChange(this,'image4')" >

								  <input type="hidden" name="imageOld[]" value="5">
                                  <?php }?>   

                                  <div id="dataId1"></div>	


					  <!--  <fieldset style="padding: 0 2%;">
							  <legend>UPLOAD PHOTOGRAPHS:</legend>	     
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Upload photograph</label>
									</div>
									<div class="col-sm-6">	
										<div class="col-sm-10">
										 <input type="file" class="form-control" name="image">		
										</div>
									</div>
									
								</div>	
                              </fieldset> -->
                         <input type="hidden" name="count" class="count">
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/campReport" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" id="saveBtn" name="save" type="submit">Save</button>
                                       <?php if($this->session->userdata('roleType') != 'User Data Manager Admin'){ ?>  
                                         <input type="submit" id="submitBtn" name="submit" value="SUBMIT" class="btn btn-primary">
                                        <?php }?> 
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

        <div class="modal inmodal" id="myModalEdit2" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="disClose()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 class="font-bold">View People Present</h3>
                        </div>
                        <div class="modal-body" id="1">
                         <!--  <button class="btn btn-primary" onclick="addCategory()">Add Category</button> -->
                         <div id="addEdit1">
                         	
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
                                                <tbody id="tableDataEdit1">
                                                  
        <!-- Data come from JS  -->
                              </tbody>
                            </table>
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
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/editPeopleEdit" >
                               <div class="form-group" style="margin:0px;">
                                   <div class="row">
                                       <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Name</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="name" class="form-control nameEdit">
                                           </div>
                                       </div>

                                        <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Designation</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="designation" class="form-control designationEdit">
                                           </div>
                                       </div>

                                                <div class="col-lg-12">
                                           <label class="col-sm-2 control-label"> Organisation</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="organisation" class="form-control organisationEdit">
                                           </div>
                                       </div>

                                               <div class="col-lg-12">
                                           <label class="col-sm-2 control-label">Contact Info</label>
                                           <div class="col-sm-10">
                                               <input type="text" name="contact" onkeypress="return isNumberKey(event,this)" maxlength="10"  class="form-control contactEdit">
                                           </div>
                                       </div>

                                        <input type="hidden" class="dataId" name="dataId" value="">
                                        <input type="hidden" name="campId" id="dataEditId" value="">
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
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addPeopleEdit" >
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
                                               <input type="text" name="contact" onkeypress="return isNumberKey(event,this)" maxlength="10" class="form-control contact">
                                           </div>
                                       </div>


                                        <input type="hidden" class="campId" name="campId" value="">

                           
                                        <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <!--  <button type="button" class="btn btn-white" data-dismiss="modal" onclick="disClose()">Cancel</button> -->
                                            <button class="btn btn-primary" name="save" type="submit">Save</button>
                                           
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

        window.onload = function() {
			  // alert('aaa');
			   getDistrict();
		};

      	var count = 0;
      	var i = 0;
      		var count1 = 0;
      	var k = 0;
      	function appendInfoDiv()
      	{
      		var ht = '';

      		var ht = '<div  id="campDetail'+(k+1)+'"><i number="'+(k+1)+'" id="campDetailCross'+(k+1)+'" class="fa fa-times" onclick="removeCampDetail(this)"></i><div class="form-group"><div class="col-sm-6"><label class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" name="presentName[]"></div></div><div class="col-sm-6"><label class="col-sm-2 control-label">Designation</label><div class="col-sm-10"><input type="text" class="form-control" name="presentDesignation[]"></div></div>				</div><div class="form-group"><div class="col-sm-6"><label class="col-sm-2 control-label">Organisation</label><div class="col-sm-10"><input type="text" class="form-control" name="presentOrganisation[]"></div></div><div class="col-sm-6"><label class="col-sm-2 control-label">Contact Info</label><div class="col-sm-10"><input type="text" onkeypress="return isNumberKey(event,this)" class="form-control" name="contact[]"></div></div></div><div class="hr-line-dashed"></div>';
                 
               count++;   
             $('.count').val(count);  

      		  $("#dataId").append(ht);
                k++;

      	}

      		function myfunction(id){
				
	$('#'+id).trigger('click');
			
		}
		
		function imageChange(input,clickId){
				if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+clickId).attr('src', e.target.result).width(126).height(114);
                };

                reader.readAsDataURL(input.files[0]);
            }			 
			 
			}

      	function removeCampDetail(val)
      	{
      		var id = $(val).attr('number');

      		 count--;   

      		   $('.count').val(count);  

      		$("#campDetail"+id).html('');       
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


      	function getDistrict()
		{
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
                                       if(result[i].districtId == '<?php if(!empty($campReport[0]['district'])){echo $campReport[0]['district'];} ?>'){
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

			/*function isNumberKey3(evt,element){
			/*var charCode = (evt.which) ? evt.which : event,this.keyCode
			//alert(charCode);
			if ((charCode != 46 && evt.srcElement.value.split('.').length==1) && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;*
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
			      if (CharAfterdot > 2) {
			        return false;
			      }
			    }

			  }
		}*/

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
				    if( $(element).val().charAt(2) == '.' || charCode == 46){

					    if (index > 0 && charCode == 46) {
					      return false;
					    }
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
			    if (index > 0) {
			      var CharAfterdot = (len + 1) - index;
			      if (CharAfterdot > 3) {
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

        if(latitude > 99.9999)
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

        if(longitude > 99.9999)
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
        alert("Distance cann't be more than 99.9 ");
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

	function checkUniqueCode()
      	{
      	  //var campCode = $('#campCode').val();

      	   	  var campCode = $('#stateCode').val().toUpperCase()+'/'+$('#districtCode').val().toUpperCase()+'/'+$('#campCode1').val();

      	  var campId = $('#campId').val();

      	 // alert(campCode);

      	   $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/checkCampUniqueCode",
						data: {campCode:campCode,campId:campId},
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

	function checkPeoplePresent(campId)
	{

		   $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/viewPeoplePresent",
						data: {campId:campId},
						success: function(data) {
					
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							if(len > 0)
							{
							   return true;
							}else{
								 alert('Fill atleast one form of people present');
								return false;

							}	
   
						   return false;
						}
					});

	}
 /* function viewPeoplePresentEdit(campId)
  {
  	 alert(campId);
  }

*/
		function viewPeoplePresentEdit(campId)
		{
			
     			     $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>index.php/home/viewPeoplePresentEdit",
						data: {campId:campId},
						success: function(data) {
					
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							   var htm = '';

                               var html = '';

                               html = '<button class="btn btn-primary" onclick="addPeople('+campId+')">Add 1 More</button>';

							       for(i = 0;i < len;i++)
					                {
					                    k = i+1;
					                 
					                    htm += '<tr id="rowId'+k+'"> <td>'+k+'</td><td>'+result[i].name+'</td><td>'+result[i].designation+'</td><td>'+result[i].organisation+'</td><td>'+result[i].contactInfo+'</td><td class="client-status"><span class="abel label-primary" style="cursor:pointer;" onclick = "editPeoplePresent('+result[i].id+')">Edit</span> <span class="label label-primary" style="cursor:pointer;" onclick="deletedTransDataNew('+result[i].id+','+"'id'"+','+"'tbl_camp_peoples'"+')">Delete</span></td></tr>';

					            
					               }

					               $('#tableDataEdit1').html(' ');
					                  
					                   $('#tableDataEdit1').html(htm);

					                      $('#addEdit1').html(' ');
					                  
					                   $('#addEdit1').html(html);

					                   $('#myModalEdit2').modal();

						
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
						$('.nameEdit').val(result[0].name);
						$('.designationEdit').val(result[0].designation);
						$('.organisationEdit').val(result[0].organisation);
						$('.contactEdit').val(result[0].contactInfo);
                        $('#dataEditId').val(result[0].campId); 

						$('#myModalEdit2').modal('hide');
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

	  	function appendInfoDivPhoto(imageNumber)
      	{
      		
      		
      		var ht = '';

      	    ht += '<div  id="photoDiv'+(i+1)+'"><i number="'+(i+1)+'" id="campDetailCross'+(i+1)+'" class="fa fa-times" onclick="removePhoto(this)"></i><div class="form-group"><div class="col-sm-6"><label class="control-label">Upload photograph</label></div><div class="col-sm-6"><div class="col-sm-10"><input type="file" class="form-control imageNew"  name="imageNew[]"><input type="hidden" value="'+imageNumber+'" class="form-control"  name="imageNumber[]"></div></div></div></div>'
                 
               count1++;   
             //$('.count').val(count);  

      		  $("#dataId1").append(ht);
                i++;

               if(($('.imageNew').length + $('.image').length) == 5)
               {
                 $('#addImage').css('display','none');
               }
               else
               {
                $('#addImage').css({'display':'inline-block'});
               }         

      	}
      	function appendInfoDivPhoto1(imageNumber1)
      	{
      		var a = imageNumber1;
      		var ht = '';

      	    ht += '<div  id="photoDiv'+(i+1)+'"><i number="'+(i+1)+'" id="campDetailCross'+(i+1)+'" class="fa fa-times" onclick="removePhoto(this)"></i><div class="form-group"><div class="col-sm-6"><label class="control-label">Upload photograph</label></div><div class="col-sm-6"><div class="col-sm-10"><input type="file" class="form-control imageNew"  name="imageNew[]"><input type="hidden" value="'+a+'" class="form-control"  name="imageNumber[]"></div></div></div></div>'
                 
               count1++;   
             //$('.count').val(count);  

      		  $("#dataId1").append(ht);
                i++;

               if(($('.imageNew').length + $('.image').length) == 5)
               {
                 $('#addImage').css('display','none');
               }
               else
               {
                $('#addImage').css({'display':'inline-block'});
               }   

               $a ++;      

      	}

      	function removePhoto(val)
      	{
      		var id = $(val).attr('number');

      		// count--;   

      		//   $('.count').val(count);  

      		$("#photoDiv"+id).html('');  


      		    if(($('.imageNew').length + $('.image').length) == 5)
               {
                 $('#addImage').css('display','none');
               }
               else
               {
                $('#addImage').css({'display':'inline-block'});
               }         
      	}


      function calculateCloseStock(){

    

			var closing_stock = (Number($('#openingStock').val()) + Number($('#received').val())) - (Number($('#wastage').val()) + Number($('#consumed').val()) + Number($('#kitsReturned').val()) + Number($('#control').val()));
			$('#closingStock').val(closing_stock);
			
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

      </script>  
		
		
		
