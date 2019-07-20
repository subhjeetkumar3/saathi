<style>
.none{
	display:none !important;
}
</style>
<div <?php if(!empty($er)){?>display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/user"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 color:red;" class="modal-title"><?php if(!empty($total_error)){echo $total_error;}  ?></h4>
			</div>
			<div class="modal-body" height:65vh !important;">
				<div class="table-responsive" height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td><?php echo $value['error']?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/user"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>User</strong>
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
							<ul class="nav nav-tabs" background-color:white;">
                                 <li class="<?php if(!empty($userById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>User List</a></li>
								 <li class="<?php if(!empty($userById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($userById)){ echo ''; }else { echo 'active'; } ?>">
						   <div class="ibox-title">
                            <h5>User List</h5>
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
													<th>UniqueId</th>
                                                    <th>User Name</th>
													<th>Password</th>
													<th>Name</th>
													<th>Name Alias</th>
													<th>Domain of Work</th>
													<th>Monthly Income</th>
													<th>No of Children</th>
													<th>Address</th>
													<th>Primary Identity</th>
													<th>Secondary Identity</th>
													<th>HIV History</th>
													<th>Gender</th>
													<th>Email</th>
													<th>Age</th>
													<th>Occupation</th>
													<th>Educational Level</th>
													<th>District</th>
													<th>State</th>
													<th>Place Of Origin</th>
													<th>Mobile No</th>
													<th>Marital Status</th>
													<th>Sexual Behaviour</th>
													<th>Hardware</th>
													<th class="text-right footable-visible footable-last-column" background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($userList as $value) { ?>
                                                <tr id="row<?php echo $value['userId']; ?>">
													<td><?php echo $value['userUniqueId']; ?></td>
                                                    <td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['password']; ?></td>
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['nameAlias']; ?></td>
													<td><?php echo $value['domainOfWork']; ?></td>
													<td><?php echo $value['monthlyIncome']; ?></td>
													<td><?php echo $value['noOfChildren']; ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['primaryIdentity']; ?></td>
													<td><?php echo $value['secondaryIdentity']; ?></td>
													<td><?php echo $value['hivHistory']; ?></td>
													<td><?php echo $value['gender']; ?></td>
													<td><?php echo $value['emailAddress']; ?></td>
													<td><?php echo $value['age']; ?></td>
													<td><?php echo $value['occupation']; ?></td>
													<td><?php echo $value['educationalLevel']; ?></td>
													<td><?php echo $value['districtId']; ?></td>
													<td><?php echo $value['state']; ?></td>
													<td><?php echo $value['placeOforigin']; ?></td>
													<td><?php echo $value['mobileNo']; ?></td>
													<td><?php echo $value['maritalStatus']; ?></td>
													<td><?php echo $value['sexualBehaviour']; ?></td>
													<td><?php echo $value['hydc']; ?></td>
													
													<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['userId']; ?>,'userId','tbl_user')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>
												</tr>
												<?php } ?>
												
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						 <div id="tab-1" class="tab-pane <?php if(!empty($userById)){ echo 'active'; }else { echo ''; } ?>">
						   <div class="ibox-title">
                            <h5>User Entry</h5>
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelUser" >
							   <div class="form-group" margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import User Excel</label>
										   <div class="col-sm-8" display:flex;">
											   <label border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/user_excel_format" class="btn btn-primary" margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
                        
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addUser/<?php if(!empty($userById)){echo $userById[0]['userId']; }?>">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">User Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="userName" id="userName" value="<?php if(!empty($userById)){echo $userById[0]['userName'];} ?>" required>
											<span color:red;" id="error"></span>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="password" value="<?php if(!empty($userById)){echo $userById[0]['password']; }?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
						          <div class=" col-sm-6" >
						 	        <label class=" col-sm-2 control-label">Name<span>*</span></label>
						 	        <div class="col-sm-10">
						 	          <input type="text"  name="name" tabindex="5" class="form-control" id="name" >
						 	      </div>
						         </div>	
						       <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Name (Alias)<span>*</span></label>
						 	      <div class="col-sm-10">
						 	         <input type="text" name="nameAlias" id="nameAlias" tabindex="6" class="form-control" > 
						 	      </div>
						       </div>
					         </div>
							  
								
								<div class="hr-line-dashed"></div>
								 <div class="form-group">
							     <div class=" col-sm-6" >
                                  <label class="col-sm-2 control-label">Date Of Birth<span>*</span></label>
                                  <div class="col-sm-10">
						 	       <input type="date"  name="dob" id="dob" tabindex="7" class="form-control" required>
						 	     </div>
						       </div>	
							  <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Age<span>*</span></label>
						 	     <div class="col-sm-10">
						 	     <input type="text" name="age" id="age" tabindex="8" class="form-control" required>
						 	 </div>
						    </div>		
					       </div>
								
							<div class="hr-line-dashed"></div>
							
							<div class="form-group"> 
						        <div class=" col-sm-6">
						 	      <label class="col-sm-2 control-label">Mobile Number (to receive OTP)<span>*</span></label>
						 	      <div class="col-sm-10">	
						 	     				<input type="text" id="" disabled="" name="" placeholder="+91-"  class="form-control" onkeypress="return isNumberKey(event)" required="">
						 	      <input type="text" id="mobileNo" name="mobileNo"  class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" tabindex="9" required="">
							  <p  id="mobileSpan">Mobile number should have atleast 10 digits</p>
							</div>
						 </div>
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Current Address<span>*</span></label>
						 	<div class="col-sm-10">
						 	<input type="text" id="address"  name="address" tabindex="10" class="form-control" required>
						 </div>
						 </div>	
					   </div>
															
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						          <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">State<span>*</span></label>
						 	         <div class="col-sm-10">
						 	          <select class="form-control" tabindex="11"  id="state1" name="addressState" required>
						 		       <option value="" readonly >Select State</option>
									     <?php foreach($state as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>
						 	     </div>
						          </div>
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">District<span>*</span></label>
						 	<div id="aaaa1">
						 	<div class="col-sm-10">	
						 	<select name="addressDistrict" tabindex="12" id="districtId1" class="form-control">
									<option value="" readonly>Select District</option>							
							</select>
							</div>	
						 </div>	
						 </div>	
					</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"> 
						 	     <div class=" col-sm-6" margin-right: 2%;width: 98%;">
						 	        <label class="col-sm-2 control-label">Education</label>
						 	        <div class="col-sm-10">
						 	         <select name="education" tabindex="13" class="form-control" id="education" >
						 		        <option value=""readonly>Select Education</option>
						 		        <option value="Literate">Literate</option>
						 		        <option value="Primary(1-5)">Primary(1-5)</option>
						 		        <option value="Secondary(6-10)">Secondary(6-10)</option>
						 		        <option value="Higher">Higher</option>
						 		        <option value="Secondary">Secondary</option>
						 		        <option value="Graduation">Graduation</option>
						 		        <option value="Non formal education">Non formal education</option>
						 	     </select>
						 	    </div>
						     </div>
					     </div>
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
							      <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">Occupation</label>
						 	         <div class="col-sm-10">
						 	           <select name="" tabindex="14" class="form-control" id="occupation" >
						 		         <option value="" readonly>Select Occupation</option>
						 		         <option value="Salaried">Salaried</option>
						 		          <option value="Self">Self</option>
						 		          <option value="employed">employed</option>
						 		          <option value="Daily">Daily</option>
						 		          <option value="wage">wage</option>
						 		          <option value="Student">Student</option>
						 		          <option value="Sex">Sex</option>
						 		          <option value="Work">Work</option>
						 		          <option value="Badhai">Badhai</option>
						 		          <option value="Mangt">Mangt</option>
						 		          <option value="Dancing">Dancing</option>
						 		          <option value="Truckers">Truckers</option>
						 		          <option value="Other">Other</option>
						 	          </select>
						 	      </div>
						         </div>
						     <div class=" col-sm-6" >
						 	   <label class="col-sm-2 control-label">Occupation-Others</label>
						 	   <div class="col-sm-10">
						 	    <input type="text" name="occupation1" tabindex="15" id="occupation1" class="form-control">
						 	</div>
						    </div>
					    </div>
															
								<div class="hr-line-dashed"></div>
								<div class="form-group">
						<div class="row">
						<div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Monthly Income</label>
						 	<div class="col-sm-10">
						 	<select name="monthlyIncome" tabindex="16"  class="form-control" id="monthly Income" >
						 		<option value="">Select Income</option>
						 		<option value=">1000">>1000</option>
						 		<option value="1001-5000">1001-5000</option>
						 		<option value="5001-10000">5001-10000</option>
						 		<option value="Above 10000">Above 10000</option>
						 	</select>
						 </div>
						 </div>
							 	
						</div>
					</div>
								
					<div class="hr-line-dashed"></div>

								<div class="form-group">
						           <div class=" col-sm-6" >
						 	           <label class="col-sm-2 control-label">Marital Status</label>
						 	           <div class="col-sm-10">
						 	              <select name="maritalStatus"  class="form-control" tabindex="18" id="maritalStatus" >
										 		<option value="">Select Marital Status</option>
										 		<option value="Married">Married</option>
										 		<option value="Divorced">Divcored</option>
										 		<option value="Widow/Widower">Widow/Widower</option>
										 		<option value="Unmarried">Unmarried</option>
										 		<option value="Separated">Separated</option>
										 		<option value="Separated">Other</option>
						 	             </select>
						 	         </div>
						           </div>	
						         <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">Marital Status - Others</label>
						 	         <div class="col-sm-10">
						 	            <select name="" id="maritalStatus1" tabindex="19" class="form-control">
						 		           <option value="">Select Marital Status</option>
						 		           <option value="Married">Married</option>
						 		           <option value="Divorced">Divcored</option>
						 		           <option value="Widow/Widower">Widow/Widower</option>
						 		           <option value="Unmarried">Unmarried</option>
						 		            <option value="Separated">Separated</option>
						 	          </select>
						 	      </div>
						         </div>
					         </div>
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						<div class="row">
						 <div class=" col-sm-3" >
						 	<label class="control-label">Male Children</label>
						 	<input type="text" id="malechildren" tabindex="20" name="malechildren" id="malechildren" class="form-control"  onkeypress="return isNumberKey(event)" >
						 </div>	
						 <div class=" col-sm-3" >
						 	<label class="control-label">Female Children</label>
						 	<input type="text" id="femalechildren" tabindex="21" name="femalechildren" id="femalechildren" class="form-control" onkeypress="return isNumberKey(event)">
						 </div>
						<!--</div>
						</div>
						<div class="hr-line-dashed"></div>
								<div class="form-group">
						<div class="row">--> 
						 <div class=" col-sm-3" >
						 	<label class="control-label">Total Chidren</label>
						 	<input type="text" id="totalchildren" tabindex="22" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" readonly="">
						 </div>
					
						</div>
					</div>
									
								<div class="hr-line-dashed"></div>

									<div class="form-group">
						              <div class=" col-sm-6" >
						                <label class="col-sm-2 control-label">Native State<span></span></label>
						                <div class="col-sm-10">
						                  <select class="form-control" tabindex="23"  id="state" name="state">
						 		               <option value="" readonly >Select State</option>
									      <?php foreach($state as $data){ ?>
									         <option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	            </select>
						 	        </div>
						            </div>	
						             <div class=" col-sm-6" >
						 	           <label class="col-sm-2 control-label">Native District<span></span></label>
						 	           <div class="col-sm-10">
						               <div id="aaaa">	
						 	            <select name="districtId" tabindex="24" id="districtId" class="form-control">
									     <option value="" readonly>Select District</option>							
								       </select>
						              </div>
						              </div>		
						            </div>
					              </div>	
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						         <div class=" col-sm-6" >
						 	        <label class="col-sm-2 control-label">Secondary Identity</label>
						 	        <div class="col-sm-10">
						 	         <select name="secondaryIdentity" tabindex="25" class="form-control" id="secondaryIdentity" >
						 		       <option value="">Select Secondary Identity</option>
						 		       <option value="MSM">MSM</option>
						 		       <option value="TG(M-F)">TG(M-F)</option>
						 		       <option value="TG(F-M)">TG(F-M)</option>
						 		       <option value="Female Partner(ARG)">Female Partner(ARG)</option>
						 		       <option value="Female Partner(HRG)">Female Partner(HRG)</option>
						 		       <option value="FSW">FSW</option>
						 		       <option value="IDU">IDU</option>
						 		     <option value="Others">Others</option>
						 	   </select>
						 	  </div>
						    </div>		
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Secondary Identity-Others</label>
						 	<div class="col-sm-10">
						 	<input type="text" name="secondaryIdentity1" tabindex="26" id="secondaryIdentity1" class="form-control">
						 </div>
						 </div>
					</div>
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						         <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Like to share information about sexual behaviour </label>
						 	     <div class="col-sm-10">
						 	        <select name="sexualBehaviour" tabindex="27" class="form-control" id="sexualBehaviour" >
						 		      <option value="" readonly>Select to share information</option>
						 		       <option value="Yes">Yes</option>
						 		        <option value="No">No</option>
						 	      </select>
						 	     </div>
						      </div>	
						      <div class=" col-sm-6" >
						 	     <label class="control-label">Have multiple sex partner</label>
						 	     <div class="col-sm-10">
						 	       <select name="col-sm-2 multipleSexPartner" tabindex="28" class="form-control" id="multipleSexPartner" >
						 		      <option value="" readonly>Select</option>
						 		      <option value="Yes">Yes</option>
						 		      <option value="No">No</option>
						 	      </select>
						 	  </div>
						    </div>	
					     </div>
								
								<div class="hr-line-dashed"></div>	

							  <div class="form-group">
						         <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Ever Sought paid sex</label>
						 	       <div class="col-sm-10">
						 	       <select name="sought" tabindex="29" class="form-control" id="sought" >
						 		      <option value="" readonly></option>
						 		      <option value="Yes">Yes</option>
						 		     <option value="No">No</option>
						 	      </select>
						 	     </div>
						       </div>	
						   <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Preferred sex/Gender of sexual partner</label>
						 	<div class="col-sm-10">
						 	<select name="prefferedGender" tabindex="34" class="form-control" id="prefferedGender" >
						 		<option value="" readonly> Select</option>
						 		<option value="Male">Male</option>
						 		<option value="Female">Female</option>
						 		<option value="TG">TG</option>
						 		<!--<option value=""></option>
						 		<option value=""></option>-->
						 	</select>
						 </div>
						 </div>
					</div>

								
							<div class="hr-line-dashed"></div>
								<div class="form-group">
						         <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Preferred sexual act</label>
						 	       <div class="col-sm-10">
						 	         <select name="prefferedSexualAct" tabindex="35" class="form-control" id="prefferedSexualAct" >
						 		       <option value="" readonly>Select</option>
						 		        <option value="Oral">Oral</option>
						 		        <option value="Anal">Anal</option>
						 		        <option value="Vaginal">Vaginal</option>
						 	        </select>
						 	    </div>
						       </div>
                             <div class=" col-sm-6" >
						 	    <label class="col-sm-2 control-label">Status of condom usage</label>
						 	    <div class="col-sm-10">
						 	       <select name="condomUsage" tabindex="30" class="form-control" id="condomUsage" >
						 		     <option value="" readonly>Select</option>
						 		     <option value="every sex">In every sex </option>
						 		     <option value="paid sex">In paid sex</option>
						 		     <option value="sometime">Sometime</option>
						 		     <option value="never">Never</option>
						 		     <option value="not aware">Not aware</option>
						 	</select>
						 </div>
						 </div>	
					</div>
							  
							  <div class="hr-line-dashed"></div> 

							  	<div class="form-group">
						           <div class=" col-sm-6" >
						 	          <label class="col-sm-2 control-label">Substance Use</label>
						 	          <div class="col-sm-10">
						 	            <select name="substanceUse" tabindex="31" class="form-control" id="substanceUse" >
									 		<option value="" readonly>Select</option>
									 		<option value="tabcoo">Tabcoo</option>
									 		<option value="drug">Drug</option>
									 		<option value="alcohol">Alcohl</option>	
						 	           </select>
						 	       </div>
						          </div>	
						        <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Have you ever been tested for HIV before?</label>
						 	       <div class="col-sm-10">
						 	         <select name="testHiv" tabindex="32" class="form-control" id="testHiv" >
								 		<option value="" readonly>Select</option>
								 		<option value="Yes">Yes</option>
								 		<option value="No">No</option>
						 	       </select>
						 	   </div>
						      </div>	
					    </div>



							  							  	
							  <div class="hr-line-dashed"></div>

							  <div class="form-group">
					             <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">If yes, When (Please mention how many months / year before)</label>
						 	       <div class="col-sm-10">
						 	        <select name="hivConfirmation" tabindex="33" class="form-control" id="pastHivReport" >
						 		       <option value="" readonly>Select</option>
						 		       <option value="reactive">Reactive</option>
						 		       <option value="not-reactive">Not-reactive</option>
						 	        </select>
						 	       </div> 
						        </div>
						       <div class=" col-sm-6" >
						 	
						      </div>	
					       </div>
							  
							 <div class="hr-line-dashed"></div> 

							 <div class="form-group">
						         <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Past HIV Test Result</label>
						 	       <div class="col-sm-10">
						 	        <select name="pastHivReport" tabindex="33" class="form-control" id="pastHivReport" >
								 		<option value="" readonly>Select</option>
								 		<option value="reactive">Reactive</option>
								 		<option value="not-reactive">Not-reactive</option>
						 	       </select>
						 	   </div>
						        </div>
			                  <div class=" col-sm-6" >
							 	<label class="col-sm-2 control-label">Remarks</label>
							 	<div class="col-sm-10">
							 	<input type="text" name="remark" tabindex="17" id="remark" class="form-control">
							 	</div>					 
                              </div>		
					</div>
							 
					 <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Result of HIV Confirmatory Test</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="hidden" name="" class="form-control">
							</div>
							</div>
					    </div>
							 
					<div class="hr-line-dashed"></div>

				  <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Status Of Confirmation on Report</label>
					</div>
					<div class=" col-sm-6">
						<div class="col-sm-10">
						<input type="text" name="reportStatus" class="form-control">
					</div>
					</div>
				</div>
							 
				<div class="hr-line-dashed"></div>

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Referred To ART Center</label>
					</div>
					<div class=" col-sm-6">
					<div class="col-sm-10">
					<input type="text" name="artCenter" class="form-control">
				   </div>
					</div>
				</div>
							 
				 <div class="hr-line-dashed"></div>

				<div class="form-group">
							<div class=" col-sm-6">
								 <label class="control-label">Date of Test Report Issued to Client</label> 
							 </div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="hidden" name="reportStatus" class="form-control">
							</div>
							</div>
					</div>
							
					<div class="hr-line-dashed"></div>

				 <div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Pre-ART/ART NUmber</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="artNumber" class="form-control">
							</div>
							</div>
					</div>
							 
					<div class="hr-line-dashed"></div>

					<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Status Of CD4 Test</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="cd4Status" class="form-control">
							</div>
						
					</div>
							  
					<div class="hr-line-dashed"></div>

				  <div class="form-group">
							<div class="col-sm-6">
								<label class="control-label">Result Of CD4 Test</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="cd4Result" class="form-control">
							</div>
					</div>
							  
				<div class="hr-line-dashed"></div>

				<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Status Of ART Intake</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="artStatus" class="form-control">
							</div>
					</div>
							 
					<div class="hr-line-dashed"></div>

					<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Tested For Syphilis</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="syphilisTest" class="form-control">
							</div>
					</div>
							
					<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Result For TB Test</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="syphilisResult" class="form-control">
							</div>
						
					</div>
							
					<div class="hr-line-dashed"></div>

					<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Tested for TB</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="tbTest" class="form-control">
							</div>
					</div>
							
				<div class="hr-line-dashed"></div>
							   
				  <div class="form-group">
					<div class=" col-sm-6">
						<label class="col-sm-2 control-label">Result For TB Test</label>
					</div>
				  <div class=" col-sm-6">
					<input type="text" name="tbResult" class="form-control">
				</div>
			</div>
							 
				<div class="hr-line-dashed"></div>

				 <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">If Yes,Referred To RNTCP</label>
					</div>
					<div class=" col-sm-6">
						<input type="text" name="rntcpRefer" class="form-control">
					</div>
				</div> 
							 
							 
			  <div class="hr-line-dashed"></div>

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Remark	</label>
					</div>
						<div class=" col-sm-6">
						  <input type="text" name="remark" class="form-control">
					   </div>
						
					</div> 
							 
							  <!--<div class="hr-line-dashed"></div>
							  
							  <div class="hr-line-dashed"></div>
							 
							  <div class="hr-line-dashed"></div>
							 
							  <div class="hr-line-dashed"></div>-->
							  
							 
															
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/user" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="button" onclick="getUserUniqueId('<?php if(!empty($userById)){echo $userById[0]['userId'];} ?>');">Submit</button>
										<button class="btn btn-primary" type="submit" id="submit" display:none;">Submit</button>
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
        <script type="text/javascript">
        	$(function(){
            $('#dob').datepicker({changeYear: true, changeMonth: true});
              $('#dob').change(function(){
                var today = new Date(), 
               birthday_val = $("#dob").val().split('-'),
                birthday = new Date(birthday_val[2],birthday_val[1],birthday_val[0]-1),
                todayYear = today.getFullYear(),
                todayMonth = today.getMonth(),
                todayDay = today.getDate(),
                birthdayYear = birthday.getFullYear(),
                birthdayMonth = birthday.getMonth(),
                birthdayDay = birthday.getDate(),
               yearDifference = (todayMonth == birthdayMonth && todayDay > birthdayDay) ? 
               todayYear - birthdayYear : (todayMonth > birthdayMonth) ? todayYear - birthdayYear : todayYear - birthdayYear-1;

             $('#age').val(yearDifference);
             //alert("Age: " + yearDifference);
      });
   })
        </script>                
      <script type="text/javascript">    
    	$('#malechildren,#femalechildren').change(function(){
     
           if($('#malechildren').val() == 0)
           	var a = 0;
           else
           	var a = parseInt($('#malechildren').val(),10);

           if($('#femalechildren').val() == 0)
            var b = 0;
           else
           	var b = parseInt($('#femalechildren').val(),10);

           $('#totalchildren').val(a+b);
  
    	});

      </script>
  <script type="text/javascript">
  	$('#forOthers').change(function () {
    if(this.checked) 
    {
        $('#occupation1').prop('required', true);
        $('#occupation').prop('required',false);
        $('#referralPoint').prop('required',false);
        $('#referralPoint1').prop('required',true);
        $('#secondaryIdentity').prop('required',false);
        $('#secondaryIdentity1').prop('required',true);
        $('#primaryIdentity1').prop('required',true);
        $('#primaryIdentity').prop('required',false);
        $('#maritalStatus').prop('required',false);
        $('#maritalStatus1').prop('required',true);
    } 
    else 
    {
        $('#occupation1').prop('required',false);
        $('#occupation').prop('required',true);
        $('#referralPoint').prop('required',true);
        $('#referralPoint1').prop('required',false);
        $('#secondaryIdentity').prop('required',true);
        $('#secondaryIdentity1').prop('required',false);
        $('#primaryIdentity1').prop('required',false);
        $('#primaryIdentity').prop('required',true);
        $('#maritalStatus').prop('required',true);
        $('#maritalStatus1').prop('required',false);
    }
});

  </script>
       <script>
		window.onload = function() {
			  // alert('aaa');
			   getDistrict();
		};
		function getUserUniqueId(userId){
			//alert(serviceProviderId);
			var id = $('#userName').val();
			//alert(id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getUserUniqueId",
				data: {id:id,userId:userId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(resul         	t[0].total);
					if(result[0].total == 0){
						$('#error').html('');
						$('#submit').trigger('click');
					}else{
						$('#error').html('Should be Unique UserName');
						$('#userName').focus();
					}
				}
			});
		}
		function getDistrict(){
			var state = $('#state').val();
			//alert(serviceTypeId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getDistrict",
				data: {state:state},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					//alert("Image Approved");
					htm = '<option value="" readonly>Select District</option>';
					for(var i = 0; i < len; i++){
						
						if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['districtId'];} ?>'){
							htm += '<option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option>';
						}else{
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						
					}
					
					//alert(htm);
					$('#districtId').html('');
					$('#districtId').html(htm);
					
				}
			});
			
		}
		</script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		
		
		
		
