<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Edit User</strong>
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
                                 
								 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Update Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">


						 <div id="tab-1" class="tab-pane active">
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
						
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" id="userForm" onsubmit="return checkAge() && formValidation();" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addUser/<?php if(!empty($userById)){echo $userById[0]['userId']; }?>">
                          	<?php if(empty($userById)){?><span style="color: red">User mobile number will be by default User login username</span><br><?php }?>
                          	<?php if(!empty($userById)){?>
                          	<div class="form-group">
									<div class="col-sm-12">
										<div class="col-sm-2">
										<label class="control-label">User Unique Id</label>
									</div>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="uniqueId" readonly id="uniqueId" value="<?php if(!empty($userById)){echo $userById[0]['userUniqueId'];} ?>" required>
										</div>
									</div>
									
								</div>
							<?php }?>

							<?php if(!empty($userById)){?>
                          				<div class="form-group">
									<div class="col-sm-12">
										<div class="col-sm-2">
										<label class="control-label">User Name</label>
									</div>
										<div class="col-sm-10">
											<input type="text" onchange="checkName()" readonly class="form-control"  name="userName" id="userName" value="<?php if(!empty($userById)){echo $userById[0]['userName'];} ?>" required>
											<span style="color:red;display: none;" id="spanUser">User Name already exist</span>
										</div>
									</div>
									
								</div>
							<?php }?>	
								<!-- <div class="form-group"> -->
									<!-- <div class="col-sm-6">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" name="password" id="password" value="<?php if(!empty($userById)){echo $userById[0]['password']; }?>" required>
										</div>
									</div> -->
								<?php //if(empty($userById)){?>	
									<!-- <div class="col-sm-6">
										<label class="col-sm-2 control-label">Confirm Password</label>
										<div class="col-sm-10">
                                         <input type="password" name="password" id="cpassword" tabindex="4" class="form-control"   required>
											<p style="display: none;color: red;" id="spanPassword">password does not match</p>
										</div>
									</div> -->
								<?php //}?>	
								<!-- </div> -->
								<div class="hr-line-dashed"></div>
								<div class="form-group">
						          <div class=" col-sm-6" >
						 	        <label class=" col-sm-2 control-label">Name<span>*</span></label>
						 	        <div class="col-sm-10">
						 	          <input type="text"  name="name" tabindex="5" value="<?php echo $userById[0]['name']?>" class="form-control" id="name" >
						 	      </div>
						         </div>	
						       <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Name (Alias)<span>*</span></label>
						 	      <div class="col-sm-10">
						 	         <input type="text" name="nameAlias" value="<?php echo $userById[0]['nameAlias']?>" id="nameAlias" tabindex="6" class="form-control" > 
						 	      </div>
						       </div>
					         </div>
							  
								
								<div class="hr-line-dashed"></div>
								 <div class="form-group">
							     <div class=" col-sm-6" >
                                  <label class="col-sm-2 control-label">Date Of Birth<span>*</span></label>
                                  <div class="col-sm-10">
						 	       <input type="text"  name="dob" id="dob" value="<?php if(!empty($userById[0]['dob'])){echo date('m/d/Y',strtotime($userById[0]['dob']));}?>" tabindex="7" class="form-control" required>
						 	     </div>
						       </div>	
							  <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Age<span>*</span></label>
						 	     <div class="col-sm-10">
						 	     <input type="text" name="age" value="<?php echo $userById[0]['age'];?>" readonly id="age" tabindex="8" class="form-control" required>
						 	 </div>
						    </div>		
					       </div>
								
							<div class="hr-line-dashed"></div>
							
							<div class="form-group"> 
						        <div class=" col-sm-6">
						 	      <label class="col-sm-2 control-label">Mobile Number (to receive OTP)<span>*</span></label>
						 	      <div class="col-sm-10">
						 	          <div class="row">
						 	     				<input style="width: 14%;float: left;" type="text" id="" disabled="" name="" placeholder="+91-"  class="form-control" onkeypress="return isNumberKey(event)" required="">
						 	      <input type="text" value="<?php echo substr($userById[0]['mobileNo'],3) 
						 	      ?>" style="width: 80%" id="mobileNo" name="mobileNo" onchange="checkMobile()" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" tabindex="9" required>
							  <p style="display: none;"  id="mobileSpan">Mobile number should have atleast 10 digits</p>
							</div>
							</div>
						 </div>
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Current Address<span>*</span></label>
						 	<div class="col-sm-10">
						 	<input type="text" id="address"  name="address" value="<?php echo $userById[0]['address'];?>" tabindex="10" class="form-control" required>
						 </div>
						 </div>	
					   </div>
															
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						          <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">State<span>*</span></label>
						 	         <div class="col-sm-10">
						 	          <select class="form-control" onchange="getAddressDistrict()"  tabindex="11"  id="state1" name="addressState" required>
						 		       <option value="" >Select State</option>
									     <?php foreach($stateList as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>" <?php if($data['stateId'] == $userById[0]['addressState']){echo 'selected';}?> ><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>
						 	     </div>
						          </div>
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">District<span>*</span></label>
						 	<div class="col-sm-10">	
						 	<select name="addressDistrict" tabindex="12" id="districtId1" class="form-control">
									<option value="" readonly>Select District</option>							
							</select>
							</div>	
						 </div>	
					</div>
								
								<!--<div class="hr-line-dashed"></div>
								<div class="form-group"> 
							   <div class="row">		
						 	     <div class=" col-sm-12" >
						 	     	<div class="col-sm-2">
						 	        <label class="control-label">Education</label>
						 	        </div>
						 	        <div class="col-sm-10">
						 	         <select name="education" tabindex="13" class="form-control" id="education" >
						 		        <option value="" readonly>Select Education</option>
						 		        <option value="Literate" <?php if($userById[0]['educationalLevel'] == 'Literate')echo 'selected';?>>Literate</option>
						 		        <option value="Primary(1-5)" <?php if($userById[0]['educationalLevel'] == 'Primary(1-5)')echo 'selected';?>>Primary(1-5)</option>
						 		        <option value="Secondary(6-10)" <?php if($userById[0]['educationalLevel'] == 'Secondary(6-10)')echo 'selected';?>>Secondary(6-10)</option>
						 		        <option value="Higher" <?php if($userById[0]['educationalLevel'] == 'Higher')echo 'selected';?>>Higher</option>
						 		        <option value="Secondary" <?php if($userById[0]['educationalLevel'] == 'Secondary')echo 'selected';?>>Secondary</option>
						 		        <option value="Graduation" <?php if($userById[0]['educationalLevel'] == 'Graduation')echo 'selected';?>>Graduation</option>
						 		        <option value="Non formal education" <?php if($userById[0]['educationalLevel'] == 'Non formal education')echo 'selected';?>>Non formal education</option>
						 	     </select>
						 	    </div>
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
						 		         <option value="Salaried" <?php if($userById[0]['occupation'] == 'Salaried'){echo 'selected';}?>>Salaried</option>
						 		          <option value="Self" <?php if($userById[0]['occupation'] == 'Self'){echo 'selected';}?>>Self</option>
						 		          <option value="employed" <?php if($userById[0]['occupation'] == 'employed'){echo 'selected';}?>>employed</option>
						 		          <option value="Daily" <?php if($userById[0]['occupation'] == 'Daily'){echo 'selected';}?>>Daily</option>
						 		          <option value="wage" <?php if($userById[0]['occupation'] == 'wage'){echo 'selected';}?>>wage</option>
						 		          <option value="Student" <?php if($userById[0]['occupation'] == 'Student'){echo 'selected';}?>>Student</option>
						 		          <option value="Sex" <?php if($userById[0]['occupation'] == 'Sex'){echo 'selected';}?>>Sex</option>
						 		          <option value="Work" <?php if($userById[0]['occupation'] == 'Work'){echo 'selected';}?>>Work</option>
						 		          <option value="Badhai" <?php if($userById[0]['occupation'] == 'Badhai'){echo 'selected';}?>>Badhai</option>
						 		          <option value="Mangt" <?php if($userById[0]['occupation'] == 'Mangt'){echo 'selected';}?>>Mangt</option>
						 		          <option value="Dancing" <?php if($userById[0]['occupation'] == 'Dancing'){echo 'selected';}?>>Dancing</option>
						 		          <option value="Truckers" <?php if($userById[0]['occupation'] == 'Truckers'){echo 'selected';}?>>Truckers</option>
						 		          <option value="Other" <?php if($userById[0]['occupation'] == 'Other'){echo 'selected';}?>>Other</option>
						 	          </select>
						 	      </div>
						         </div>
						     <div class=" col-sm-6" >
						 	   <label class="col-sm-2 control-label">Occupation-Others</label>
						 	   <div class="col-sm-10">
						 	    <input type="text" name="occupation1" value="<?php echo $userById[0]['occupation_other']?>" tabindex="15" id="occupation1" class="form-control">
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
						 		<option value=">1000" <?php if($userById[0]['userById'] == '>1000'){echo 'selected';}?>>>1000</option>
						 		<option value="1001-5000" <?php if($userById[0]['userById'] == '1001-5000'){echo 'selected';}?>>1001-5000</option>
						 		<option value="5001-10000" <?php if($userById[0]['userById'] == '5001-10000'){echo 'selected';}?>>5001-10000</option>
						 		<option value="Above 10000" <?php if($userById[0]['userById'] == 'Above 10000'){echo 'selected';}?>>Above 10000</option>
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
										 		<option value="Married" <?php if($userById[0]['maritalStatus'] == 'Married'){echo 'selected';}?>>Married</option>
										 		<option value="Divorced" <?php if($userById[0]['maritalStatus'] == 'Divcored'){echo 'selected';}?>>Divcored</option>
										 		<option value="Widow/Widower" <?php if($userById[0]['maritalStatus'] == 'Widow/Widower'){echo 'selected';}?>>Widow/Widower</option>
										 		<option value="Unmarried" <?php if($userById[0]['maritalStatus'] == 'Unmarried'){echo 'selected';}?>>Unmarried</option>
										 		<option value="Separated" <?php if($userById[0]['maritalStatus'] == 'Separated'){echo 'selected';}?>>Separated</option>
										 		<option value="Other" <?php if($userById[0]['maritalStatus'] == 'Other'){echo 'selected';}?>>Other</option>
						 	             </select>
						 	         </div>
						           </div>	
						         <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">Marital Status - Others</label>
						 	         <div class="col-sm-10">
						 	            <select name="" id="maritalStatus1" tabindex="19" class="form-control">
						 		           <option value="">Select Marital Status</option>
						 		           <option value="Married" <?php if($userById[0]['maritalStatus_other'] == 'Married'){echo 'selected';}?>>Married</option>
						 		           <option value="Divorced" <?php if($userById[0]['maritalStatus_other'] == 'Divcorced'){echo 'selected';}?>>Divcored</option>
						 		           <option value="Widow/Widower" <?php if($userById[0]['maritalStatus_other'] == 'Widow/Widower'){echo 'selected';}?>>Widow/Widower</option>
						 		           <option value="Unmarried" <?php if($userById[0]['maritalStatus_other'] == 'Unmarried'){echo 'selected';}?>>Unmarried</option>
						 		            <option value="Separated" <?php if($userById[0]['maritalStatus_other'] == 'Separated'){echo 'selected';}?>>Separated</option>
						 	          </select>
						 	      </div>
						         </div>
					         </div>
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						<div class="row">
						 <div class=" col-sm-4" >
						 	<label class="col-sm-2 control-label">Male Children</label>
						 	<input type="text" id="malechildren" tabindex="20" name="malechildren" id="malechildren" class="form-control" value="<?php echo $userById[0]['male_children']?>" onkeypress="return isNumberKey(event)" >
						 </div>	
						 <div class=" col-sm-4" >
						 	<label class="col-sm-2 control-label">Female Children</label>
						 	<input type="text" id="femalechildren" tabindex="21" name="femalechildren" id="femalechildren" class="form-control" value="<?php echo $userById[0]['female_children']?>" onkeypress="return isNumberKey(event)">
						 </div>-->
						<!--</div>
						</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
						<div class="row">--> 
					<!-- 	 <div class=" col-sm-4" >
						 	<label class="col-sm-2 control-label">Total Chidren</label>
						 	<input type="text" id="totalchildren" value="<?php echo $userById[0]['total_children']?>" tabindex="22" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" readonly="">
						 </div>
					
						</div>
					</div> -->
									
								<div class="hr-line-dashed"></div>

									<!--<div class="form-group">
						              <div class=" col-sm-6" >
						                <label class="col-sm-2 control-label">Native State<span></span></label>
						                <div class="col-sm-10">
						                  <select class="form-control" onchange="getDistrict()" tabindex="23"  id="state" name="state">
						 		               <option value="" readonly >Select State</option>
									      <?php foreach($stateList as $data){ ?>
									         <option value="<?php echo $data['stateId']; ?>" <?php if($data['stateId'] == $userById[0]['state']){echo 'selected';}?>><?php echo $data['stateName']; ?></option>
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
						 		<option value="TG">TG</option>-->
						 		<!--<option value=""></option>
						 		<option value=""></option>-->
						 	<!-- </select>
						 </div>
						 </div>
					</div> -->

								
							<!--<div class="hr-line-dashed"></div>
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
						 	        <select name="hivConfirmation" tabindex="33" class="form-control" id="hivConfirmation" >
						 		       <option value="" readonly>Select</option>
						 		       <option value="reactive">Reactive</option>
						 		       <option value="not-reactive">Not-reactive</option>
						 	        </select>
						 	       </div> 
						        </div>
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
					       </div>
							  
							 <div class="hr-line-dashed"></div> -->

							 <!-- <div class="form-group">
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
					</div> -->

					<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Date of Finger Prick Screening</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
									<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
								<input type="text" name="fingerDate"  value="<?php if(!empty($userById[0]['fingerDate']) && $userById[0]['fingerDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['fingerDate'])); }?>" id="data_5" class="form-control input-daterange">
							</div>
							</div>
							</div>
					    </div>

					    <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Referred to SA-ICTC</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="saictcRefer" value="<?php echo $userById[0]['saictcStatus'] ?>"  class="form-control">
							</div>
							</div>
					    </div>


					   <!-- <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Date of Out-referral to SA-ICTC</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="saictcDate" value="<?php if(!empty($userById[0]['saictcDate']) && $userById[0]['saictcDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['saictcDate'])); }?>"  class="form-control">
							</div>
							</div>
							</div>
					    </div>

					     <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Place of SA-ICTC Referred</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="saictcPlace" value="<?php echo $userById[0]['saictcPlace'] ?>" class="form-control">
							</div>
							</div>
					    </div>

					       <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">ICTC -PID Number</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="ictcNumber" value="<?php echo $userById[0]['ictcNumber'] ?>" class="form-control">
							</div>
							</div>
					    </div>

					      <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Date of HIV Confirmation Test</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="hivDate"  value="<?php if(!empty($userById[0]['hivDate']) && $userById[0]['hivDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['hivDate'])); }?>"  class="form-control">
							</div>
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
								<input type="text" name="hivStatus" value="<?php echo $userById[0]['hivStatus'] ?>" class="form-control">
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
								<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="reportIssuedDate" value="<?php if(!empty($userById[0]['reportIssuedDate']) && $userById[0]['reportIssuedDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['reportIssuedDate'])); }?>"  class="form-control">
							</div>
							</div>
							</div>
					</div>
							
							 
					<div class="hr-line-dashed"></div>

				  <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Status Of HIV Confirmation on Report</label>
					</div>
					<div class=" col-sm-6">
						<div class="col-sm-10">
						<input type="text" name="reportStatus" value="<?php echo $userById[0]['reportStatus'] ?>" class="form-control">
					</div>
					</div>
				</div>-->
							 
				<!-- <div class="hr-line-dashed"></div>

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Referred To ART Center</label>
					</div>
					<div class=" col-sm-6">
					<div class="col-sm-10">
					<input type="text" name="artCenter" class="form-control">
				   </div>
					</div>
				</div> -->
							 
				
					<div class="hr-line-dashed"></div>

				<!-- <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Created By</label>
					</div>
						<div class=" col-sm-6">
						 <select class="form-control" name="createdBy">
						 	<option>-select created by-</option>
						 	<option value="1" <?php if($userById[0]['createdBy'] == '1'){ echo 'selected'; }?>>admin</option>
                        	<?php foreach($empUser as $data){?>
                        	<option value="<?php echo $data['userId']?>" <?php if($userById[0]['createdBy'] == $data['userId']){ echo 'selected'; }?>><?php echo $data['userName']?></option>	
                        	<?php }?>
						 </select>
					   </div>
						
					</div>  -->
							 

				  <div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">ART Number</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="artNumber" class="form-control">
							</div>
							</div>
					</div>
							 
					<div class="hr-line-dashed"></div>

				<!--	<div class="form-group">
							<div class=" col-sm-6">
								<label class="col-sm-2 control-label">Status Of CD4 Test</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="cd4Status" class="form-control">
							</div>
						
					</div>
							  
					<div class="hr-line-dashed"></div>-->

				  <div class="form-group">
							<div class="col-sm-6">
								<label class="control-label">Baseline CD4 Count</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="cd4Result" class="form-control">
							</div>
					</div>
							  
				<div class="hr-line-dashed"></div>

				 <div class="form-group">
							<div class="col-sm-6">
								<label class="control-label">Status of Client</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="clientStatus" class="form-control">
							</div>
					</div>
							  
				<div class="hr-line-dashed"></div>


				<!--<div class="form-group">
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
							 --> 

			 <div class="form-group">
			 	<div class=" col-sm-6">
						<label class="control-label">Camp Code</label>
					</div>
						<div class=" col-sm-6">
						  <input type="text" name="campCode" value="<?php echo $userById[0]['campCode'] ?>" class="form-control">
					   </div>
			 </div>	

			 <div class="hr-line-dashed"></div>			 

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Registered By</label>
					</div>
						<div class=" col-sm-6">
						  <input type="text" name="registeredBy" value="<?php echo $userById[0]['registeredBy'] ?>" class="form-control">
					   </div>
						
					</div> 
        <div class="hr-line-dashed"></div>

						<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Registered On</label>
					</div>
						<div class=" col-sm-6">
						<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>		
						<input type="text" name="registeredOn" value="<?php if(!empty($userById[0]['registeredOn']) && $userById[0]['registeredOn'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['registeredOn'])); }?>"  class="form-control">				
						</div>	  
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
							 
							  
							 
															
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/user" class="btn btn-white">Cancel</a>
                                    <!--     <button class="btn btn-primary" type="button" onclick="getUserUniqueId('<?php if(!empty($userById)){echo $userById[0]['userId'];} ?>');">Submit</button> -->
										<button class="btn btn-primary" type="submit" id="submit" >Submit</button> 
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
             /* $('#dob').change(function(){
                var today = new Date(), 
               birthday_val = $("#dob").val().split('/'),
                birthday = new Date(birthday_val[0],birthday_val[1],birthday_val[2]),
                todayYear = today.getFullYear(),
                todayMonth = today.getMonth(),
                todayDay = today.getDate(),
                birthdayYear = birthday.getFullYear(),
                birthdayMonth = birthday.getMonth(),
                birthdayDay = birthday.getDate(),
               yearDifference = (todayMonth == birthdayMonth && todayDay > birthdayDay) ? 
               todayYear - birthdayYear : (todayMonth > birthdayMonth) ? todayYear - birthdayYear : todayYear - birthdayYear-1;

             $('#age').val(yearDifference);

              alert(birthday);
             //alert("Age: " + yearDifference);
      });*/

      $('#dob').change(function(){
      	var today = new Date();
      	birthday_val = $('#dob').val();

      	todayYear = today.getFullYear();
      	todayMonth = today.getMonth();
      	todayDay = today.getDate();

      	var dob = new Date(birthday_val);

      	dobYear = dob.getFullYear();
        dobMonth = dob.getMonth();
        dobDay = dob.getDate();

        if(dobMonth > todayMonth || dobDay < todayDay)
            {
               yearDifference = todayYear-dobYear;
               yearDifference = yearDifference-1;
            }
            else
            {	
             yearDifference = todayYear-dobYear;
            }

             if( yearDifference < 18)
            {
               $('#submit').attr('type','button');

               alert('You should be 18 years or above to register & view this website');
            }
            else{
            	$('#submit').attr('type','submit');
            }

           $('#age').val(yearDifference);
      })

      $('#password,#cpassword').change(function(){
           if($('#cpassword').val() != '')
       	   {
             if($('#password').val() != $('#cpassword').val())
             {
             	$('#spanPassword').css('display','block');
             	$('#submit').attr('type','button')
             }else{
             	$('#spanPassword').css('display','none');
             	$('#submit').attr('type','submit');
             }
       	   }

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

       	var checkUserMobile = 0;
		window.onload = function() {
			  // alert('aaa');
			   getDistrict();

			   getAddressDistrict();
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
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getDistrict",
				data: {state:state},
				success: function(data) {
					
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;

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

		function getAddressDistrict()
		{
				var stateId = $('#state1').val();
    		
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

									
									$("#districtId1").html(htm);
									
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
								
									$("#districtId1").html(htm);
								
							} 
						}
					});

		}

         function getAddressDistrict1()
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

									
									$("#districtFilter").html(htm);
									
							}else{
								var htm = '';
									htm += '<option value="" readonly>Select District</option>';
									for(var i = 0; i < len; i++){
                                       if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['addressDistrict'];} ?>'){
							                   htm += '<select name="districtFilter[]" multiple tabindex="12" id="districtFilter" class="chosen-select"><option value="" readonly>Select District</option><option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option><select>';
						                  }else{
							                htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						                 }
						
									}
								
									//$("#districtFilter").html(htm);
									  $('#districtFilter').html(''); 
									$("#districtFilter").html(htm);
									$('#districtFilter').trigger("chosen:updated");
								
							} 
						}
					});

		}


		function checkName()
		{
             var userName = $('#userName').val();

             $.ajax({
                type: "POST",
    	        url: "<?php echo base_url()?>index.php/homeweb/checkUserExist",
    	        data: {userName:userName},
    	        success:function(data){
                  var rslt = $.trim(data)
    		      var result = JSON.parse(rslt);
    		      var len =  result.length;

    		      if(len != 0)
    		      {
                    $('#spanUser').css('display','block');
                    $('#submit').attr('type','button');
    		      }
    		      else{
    		      	$('#spanUser').css('display','none');
    		      	$('#submit').attr('type','submit');
    		      }	
    	        }
             });
    	}

    	function checkAge()
    	{
    		var age = $('#age').val();

    		if(age < 18)
    		{
    			  alert('You should be 18 years or above to register & view this website'); 
    			return false;
    			
    		}
    		else{
    			return true;
    		}	
    	}

    	function checkMobile()
    	{
    		
    		var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '')
    		{
    			$.ajax({
    				type:"POST",
    				url : "<?php echo base_url().'index.php/home/checkUserMobile'?>",
    				data:{mobileNo:mobileNo},
    				success: function (data){
    					var rslt = $.trim(data);
    					result = JSON.parse(rslt);
				        var len = result.length;

				        if(len != '')
				        {
				        	checkUserMobile = 1;
                          alert('Mobile no already taken.choose another');
                          $('#submit').attr('type','button');
				        }
				         else{
    		      	        checkUserMobile = 0;
    		      	        $('#submit').attr('type','submit');
    		             }		
    				}
    			});
    		}
    		else{
    			checkUserMobile = 0;
    		}	
    	}

    	function formValidation()
    	{	
    		if(checkUserMobile == 1)
    		{
    			alert('Mobile no already taken.choose another');
    			return false;
    		}
    		else{

    			return true;
    		}	
    	}

    	/*function wildcardUsername()
    	{
    		var wildcard = $('#wildcard').val();

    		$.ajax({
    			type:"POST",
    				url : "<?php echo base_url().'index.php/home/wildcardUsername'?>",
    				data:{wildcard:wildcard},
    				success: function (data){
    					var rslt = $.trim(data);
    					result = JSON.parse(rslt);
				        var len = result.length;

				   $('#activeuserList').html(' ');

				   var html = " ";
				   
				  for (var i = 0; i < len; i++) {
				   	
				   } 
				             	
    		 }
    		});
    	}*/
		</script>
		 <script type="text/javascript">
    	   //$(document).ready(function(){

    		

/*       $('#cpassword').change(function(){
        
       	   if($('#cpassword').val() != '')
       	   {
             if($('#password').val() != $('#cpassword').val())
             {
             	$('#spanPassword').css('display','block');
             	$('#submit').attr('type','button')
             }else{
             	$('#spanPassword').css('display','none');
             	$('#submit').attr('type','submit');
             }
       	   }
       });

       $('#password').on('change',function(e){
           if($('#cpassword').val() != '')
       	   {
             if($('#password').val() != $('#cpassword').val())
             {
             	$('#spanPassword').css('display','block');
             	$('#submit').attr('type','button')
             }else{
             	$('#spanPassword').css('display','none');
             	$('#submit').attr('type','submit');
             }
       	   }
       });*/

      /* $('#dob').on('change',function(){
    		var today = new Date();
    		birthday_val = $("#dob").val();
    		todayYear = today.getFullYear();
    		todayMonth = today.getMonth();
    		todayDay = today.getDate();
            var dob = new Date(birthday_val);
            dobYear = dob.getFullYear();
            dobMonth = dob.getMonth();
            dobDay = dob.getDate();
            if(dobMonth > todayMonth || dobDay < todayDay)
            {
               yearDifference = todayYear-dobYear;
               yearDifference = yearDifference-1;
            }
            else
            {	
             yearDifference = todayYear-dobYear;
            }

            if( yearDifference < 18)
            {
               $('#submit').attr('type','button');

               alert('You should be 18 years or above to register & view this website');
            }
            else{
            	$('#submit').attr('type','submit');
            } 
       $('#age').val(yearDifference);

    	});
*/
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

       	$('#gender').change(function()
    	{
    		if($('#gender').val() == 'Others')
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
    	});

    	$('#name').change(function(){
    		var name = $('#name').val();

    		var nameAlias = $('#nameAlias').val();
 
               if(name != '')
               {
               	 $('#name').prop('required',true);
               	 $('#nameAlias').prop('required',false);
               }else{
               	$('#name').prop('required',false);
               	 $('#nameAlias').prop('required',false);
               }
    	});

    	$('#nameAlias').change(function(){
    		var name = $('#name').val();

    		var nameAlias = $('#nameAlias').val();
 
               if(nameAlias != '')
               {
               	 $('#name').prop('required',false);
               	 $('#nameAlias').prop('required',true);
               }else{
               	$('#name').prop('required',false);
               	 $('#nameAlias').prop('required',false);
               }
    	});

    	$('#mobileNo').change(function(){
    		var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
    			alert('Mobile Number should have atleast 10 digits');
    			checkMobile
    			$('#submit').attr('type','button');
    		}else{
    			//$('#mobileSpan').css('display','none');
    			$('#submit').attr('type','submit');
    		}	
    	});

    	$('#submit').click(function(){

    		var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
                 $('#submit').attr('type','button');
    			alert('Mobile Number should have atleast 10 digits')
    			
    		}else{
                $('#submit').attr('type','submit');
    		}	
    	});

       $("form[id='userForm']").submit(function(event){

           var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
    			event.preventDefault();
    			alert('Mobile Number should have atleast 10 digits')
    			
    		}

       if($('#name').val() == '' && $('#nameAlias').val() == '')
       {
       	  event.preventDefault();
       	  alert('you need to enter either Name or Name alias to register');
       }

      if($('#confirm').prop('checked') == false ||  $('#consent').prop('checked') == false)
      { 	
       	event.preventDefault();
         alert('click to agree with terms and conditions');
        } 
       });

    		
    	//});
    </script>
 
		
		
		
		
