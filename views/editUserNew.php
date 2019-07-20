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
							<ul class="nav nav-tabs" style="background-color:white;">
                                 
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
                          	<fieldset style="padding: 2% 2%;">
							  <legend>Registration Details:</legend>	
							<input type="hidden" name="userId" value="<?php echo $id ?>">

                          		<div class="form-group">
								<div class=" col-sm-6">
									<label class="control-label">Date of Registation</label>
								</div>
									<div class=" col-sm-6">
									<div class="input-group date">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
										</span>		
									<input type="text" id="regDate" name="registeredOn" required value="<?php if(!empty($userById[0]['registeredOn']) && $userById[0]['registeredOn'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['registeredOn'])); }?>"  class="form-control">				
									</div>	  
								</div>
						
								</div> 
                                 
                               <div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Camp Code</label>
								       </div>
                                      <div class="col-sm-6">
                                      <?php $campCode = explode('/', $userById[0]['campCode']); ?>   
                                                <div class="col-sm-2"  >
                                                    
                                                    <input type="text" maxlength="2" minlength="2" onblur="checkUniqueCode()"  value="<?php echo $campCode[0] ?>" name="stateCode"  id="stateCode"  class="form-control">
                                                     <span style="width: 30% !important;color: red">State- 2 Character Code</span>
                                                    
                                                </div>
                                                
                                                <div class="col-sm-2" >
                                                    <input type="text" maxlength="2" minlength="2" onblur="checkUniqueCode()" value="<?php echo $campCode[1] ?>" name="districtCode"  id="districtCode" class="form-control">
                                                 <span style="color: red">District- 2 Character Code</span> 
                                                </div>
                                                
                                                <div class="col-sm-3">
                                                    <input type="text" onkeypress="return isNumberKey(event)" onblur="checkUniqueCode()" value="<?php echo $campCode[2]; ?>"  id="campCode1" name="campCode1" minlength="3" maxlength="3" class="form-control">
                                                <span style="color: red">3 digit sequence</span>    
                                                </div> 
										 <!--  <input type="text" name="campCode" value="<?php echo $userById[0]['campCode'] ?>" class="form-control">	 -->	
										
									</div>
									
							
									<div class="col-sm-6">
										<label class="control-label">Registered Done By</label>	
										
										 <select class="form-control" name="registeredBy">
										 	<option value="">-select-</option>
										 	<option <?php if($userById[0]['registeredBy'] == 'CRP'){echo 'selected';}  ?>>CRP</option>
										 	<option <?php if($userById[0]['registeredBy'] == 'SPC'){echo 'selected';}  ?>>SPC</option>
										 	<option <?php if($userById[0]['registeredBy'] == 'SPO'){echo 'selected';}  ?>>SPO</option>
										 	<option <?php if($userById[0]['registeredBy'] == 'Volunteer'){echo 'selected';}  ?>>Volunteer</option>
										 </select>
									</div>
									
                                 </div>

                                 <div class="form-group">
                                 	

                                 	<div class="col-sm-6">
                                 		<label class="control-label">Mode Of Contact</label>
                                 		<select class="form-control" name="modeOfContact">
                                 			<option value="">-select-</option>
                                 			<option <?php if($userById[0]['modeOfContact'] == 'Online'){echo 'selected';}  ?> >Online</option>
                                 			<option <?php if($userById[0]['modeOfContact'] == 'Offline one to one'){echo 'selected';}  ?> >Offline one to one</option>
                                 			<option <?php if($userById[0]['modeOfContact'] == 'Offline-Camps-CBS events'){echo 'selected';}  ?> >Offline-Camps-CBS events</option>
                                 		</select>
                                 	</div>
                                 </div>

                             </fieldset>

                               <div class="hr-line-dashed"></div>

                             <fieldset style="padding: 0 2%;">
                               <div class="form-group">
                                  <div class="col-sm-6">
                                     <label class="control-label">User Name<span class="required">*</span></label> 
                                      <input type="text" readonly  name="userName" tabindex="5" value="<?php echo $userById[0]['userName']?>" class="form-control" id="userName" >
                                  </div> 
                                  <div class="col-sm-6">
                                    <label class="control-label">Client Id<span class="required">*</span></label>  
                                    <input type="text" readonly  name="uniqueId" tabindex="5" value="<?php echo $userById[0]['client_id']?>" class="form-control" id="uniqueId" >
                                  </div>
                               </div> 

                             <div class="form-group">
                             	<div class="col-sm-6">
                             		  <label class="control-label">Name<span class="required">*</span></label>
                             		  <input type="text"  name="name" tabindex="5" value="<?php echo $userById[0]['name']?>" class="form-control" id="name" >
                             	</div>
                             	<div class="col-sm-6">
                             		  <label class="control-label">Name (Alias)</label>
                             		    <input type="text"  name="nameAlias" value="<?php echo $userById[0]['nameAlias']?>" id="nameAlias" tabindex="6" class="form-control" >  
                             	</div>
                             </div>
                             <div class="form-group">
                             	<div class="col-sm-6">
                             		 <label class="control-label">Date Of Birth
                                        <!-- <span class="required">*</span> -->
                                    </label>	
                             		  <input type="text"  name="dob" id="dob" value="<?php if(!empty($userById[0]['dob']) && $userById[0]['dob'] != '1970-01-01'){echo date('d/m/Y',strtotime($userById[0]['dob']));}?>" tabindex="7" class="form-control" > 
                             	</div>
                             	<div class="col-sm-6">
                             	 <label class="control-label">Age<span class="required">*</span></label>	
                             	 <input type="text"  name="age" readonly="" id="age" value="<?php echo $userById[0]['age'];?>" tabindex="7" class="form-control" required>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		 <label class="control-label">Gender<span class="required">*</span></label>	
                             		 <select class="form-control" name="gender">
                             		 	<option value="">-Select-</option>
                             		 	<option <?php if($userById[0]['gender'] == 'Male'){echo 'selected';}  ?> >Male</option>
                             		 	<option <?php if($userById[0]['gender'] == 'Female'){echo 'selected';}  ?> >Female</option>
                             		 	<option <?php if($userById[0]['gender'] == 'TG'){echo 'selected';}  ?> >TG</option>
                             		 </select>
                             	</div>
                             	<div class="col-sm-6">
                             		 <label class="control-label">Mobile Number (to receive OTP)</label>
                             		 <input style="width: 14%;float: left;margin-top: 5.5%;" type="text" id="" disabled="" name="" placeholder="+91-"  class="form-control" onkeypress="return isNumberKey(event)" required="">
                             		 <input type="text" value="<?php echo substr($userById[0]['mobileNo'],3) ?>" style="width: 80%" id="mobileNo" name="mobileNo" onchange="checkMobile()" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" tabindex="9" >
                             	</div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             	  <label class="control-label">Current Address</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="text" id="address"  name="address" value="<?php echo $userById[0]['address'];?>" tabindex="10" class="form-control" >
                             	</div>
                             </div>
                            
                               <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">State<span class="required">*</span></label>
                             	 <select class="form-control" onchange="getAddressDistrict()"  tabindex="11"  id="state1" name="addressState" required>
						 		       <option value="" >Select State</option>
									     <?php foreach($stateList as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>" <?php if($data['stateId'] == $userById[0]['addressState']){echo 'selected';}?> ><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>
                             	</div>
                             	<div class="col-sm-6">
                             		<label class="control-label">District<span class="required">*</span></label>
                             		<select name="addressDistrict" required tabindex="12" id="districtId1" class="form-control">
									<option value="" readonly>Select District</option>							
									</select>
                             	</div>
                             </div>
                             </fieldset>

                                 <div class="hr-line-dashed"></div>

                             <fieldset style="padding: 0 2%;">
                             	 <div class="form-group">
                             	<div class="col-sm-6">
                             	   <label class="control-label">Education</label>
                             	   <select name="education" tabindex="13" class="form-control" id="education" >
						 		        <option value="" readonly>Select Education</option>
						 		        <option value="Pre-Literate" <?php if($userById[0]['educationalLevel'] == 'Pre-Literate')echo 'selected';?> >Pre-Literate</option>
						 		        <option value="Primary(1-5)" <?php if($userById[0]['educationalLevel'] == 'Primary(1-5)')echo 'selected';?> >Primary(1-5)</option>
						 		        <option value="Secondary(6-10)" <?php if($userById[0]['educationalLevel'] == 'Secondary(6-10)')echo 'selected';?> >Secondary(6-10)</option>
						 		        <option value="Higher Secondary" <?php if($userById[0]['educationalLevel'] == 'Higher Secondary')echo 'selected';?> >Higher Secondary</option>
						 		      <!--   <option value="Secondary" ></option> -->
						 		        <option value="Graduation and above" <?php if($userById[0]['educationalLevel'] == 'Graduation and Above')echo 'selected';?> >Graduation and Above</option>
						 		        <option value="Non formal education" <?php if($userById[0]['educationalLevel'] == 'Non formal education')echo 'selected';?> >Non formal education</option>
						 	     </select>	
                             	</div>
                               <div class="col-sm-6">
                               	<label class="control-label">Monthly Income</label>
                               	<select name="monthlyIncome" tabindex="16"  class="form-control" id="monthly Income" >
						 		<option value="">Select Income</option>
						 		<option value=">1000" <?php if($userById[0]['monthlyIncome'] == '>1000'){echo 'selected';}?>>>1000</option>
						 		<option value="1001-5000" <?php if($userById[0]['monthlyIncome'] == '1001-5000'){echo 'selected';}?>>1001-5000</option>
						 		<option value="5001-10000" <?php if($userById[0]['monthlyIncome'] == '5001-10000'){echo 'selected';}?>>5001-10000</option>
						 		<option value="Above 10000" <?php if($userById[0]['monthlyIncome'] == 'Above 10000'){echo 'selected';}?>>Above 10000</option>

						 	</select>
                               </div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Marital Status</label>
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

                             	<div class="col-sm-6">
                             		 <label class="control-label">Marital Status-Others</label>

                             		<input type="text" value="<?php echo $userById[0]['maritalStatus_other'] ?>" class="form-control" id="maritalStatus1" name="maritalStatus1"> 
                             	</div>
                             </div>

                             <div class="form-group">
                             		<div class="col-sm-6">
                             		<label class="control-label">Occupation</label>
                             		 <select name="occupation" tabindex="14" class="form-control" id="occupation" >
						 		         <option value="" readonly>Select Occupation</option>
						 		          <option value="Salaried" <?php if($userById[0]['occupation'] == 'Salaried'){echo 'selected';}?>>Salaried</option>
						 		          <option value="Self employed" <?php if($userById[0]['occupation'] == 'Self employed'){echo 'selected';}?>>Self employed</option>
						 		        
						 		          <option value="Daily wage" <?php if($userById[0]['occupation'] == 'Daily wage'){echo 'selected';}?>>Daily wage</option>
						 		         
						 		          <option value="Student" <?php if($userById[0]['occupation'] == 'Student'){echo 'selected';}?>>Student</option>
						 		          <option value="Sex Work" <?php if($userById[0]['occupation'] == 'Sex Work'){echo 'selected';}?>> Sex Work</option>
						 		          
						 		          <option value="Badhai" <?php if($userById[0]['occupation'] == 'Badhai'){echo 'selected';}?>>Badhai</option>
						 		          <option value="Mangt" <?php if($userById[0]['occupation'] == 'Mangt'){echo 'selected';}?>>Mangt</option>
						 		          <option value="Dancing" <?php if($userById[0]['occupation'] == 'Dancing'){echo 'selected';}?>>Dancing</option>
						 		          <option value="Truckers" <?php if($userById[0]['occupation'] == 'Truckers'){echo 'selected';}?>>Truckers</option>
						 		           <option value="Migrant" <?php if($userById[0]['occupation'] == 'Migrant'){echo 'selected';}?>  >Migrant</option>
						 		          <option value="Drivers" <?php if($userById[0]['occupation'] == 'Drivers'){echo 'selected';}?> >Drivers</option>
						 		          <option value="Other" <?php if($userById[0]['occupation'] == 'Other'){echo 'selected';}?>>Other</option>
						 	          </select>
                             	</div>
                             	<div class="col-sm-6">
                             	 <label class="control-label">Occupation-Others</label>
                             	   <input type="text" name="occupation1" value="<?php echo $userById[0]['occupation_other']?>" tabindex="15" id="occupation1" class="form-control">
                             	</div>
                             </div>

                               <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="radio" id="hrgRadio" <?php if($userById[0]['hrg']){echo 'checked';} ?> onclick="hrgDisplay()" name="hrgDiv">HRG
                                    <input type="radio" <?php if($userById[0]['arg']){echo 'checked';} ?> id="argRadio" onclick="hrgDisplay()"  name="hrgDiv">ARG
                                    <input type="radio" <?php if(!$userById[0]['hrg'] && !$userById[0]['arg']){echo 'checked';} ?> name="hrgDiv" onclick="hrgDisplay()" id="Neither">Neither
                                </div>
                                
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6" id="hrgDiv" style="display: none;" >
                             	<label class="control-label">HRG</label>
                             	 <select name="hrg" tabindex="16" class="form-control" id="hrg" >
						 		      <option value="">-select-</option>
						 		      <option value="MSM" <?php if($userById[0]['hrg'] == 'MSM'){echo 'selected';}  ?> >MSM</option>
						 		      <option value="TG_M-F" <?php if($userById[0]['hrg'] == 'TG_M-F'){echo 'selected';}  ?> >TG_M-F</option>
						 		     
						 		      <option value="FSW" <?php if($userById[0]['hrg'] == 'FSW'){echo 'selected';}  ?> >FSW</option>
						 		      <option value="IDU" <?php if($userById[0]['hrg'] == 'IDU'){echo 'selected';}  ?> >IDU</option>
						 	          </select>
						 	      </div> 
						 	      <div class="col-sm-6" id="argDiv" style="display: none;" >
						 	      	<label class=" control-label">ARG</label>
						 	      	 <select name="arg" tabindex="17" class="form-control" id="arg" >
						 	    	<option value="">-select-</option>
						 	    	<option <?php if($userById[0]['arg'] == 'Single Male migrant'){echo 'selected';}  ?> >Single Male migrant</option>
						 	    	<option <?php if($userById[0]['arg'] == 'Trucker'){echo 'selected';}  ?> >Trucker</option>
						 	    	<option <?php if($userById[0]['arg'] == 'Partner / Spouse of FSW'){echo 'selected';}  ?> >Partner / Spouse of FSW</option>
						 	    	<option <?php if($userById[0]['arg'] == 'Have multiple partners'){echo 'selected';}  ?> >Have multiple partners </option>
						 	    	<!-- <option <?php// if($userById[0]['arg'] == 'Female partner (FPARG)'){echo 'selected';}  ?> >Female partner (FPARG)</option>
						 	    	<option <?php //if($userById[0]['arg'] == 'Female Partner (FMHRG)'){echo 'selected';}  ?> >Female Partner (FMHRG)</option> -->
                                    <option <?php if($userById[0]['arg'] == 'Female Partner-ARG'){echo 'selected';}  ?> >Female Partner-ARG</option>
                                    <option <?php if($userById[0]['arg'] == 'Female Partner-HRG'){echo 'selected';}  ?> >Female Partner-HRG</option>
                                     <option value="TG_F-M" <?php if($userById[0]['arg'] == 'TG_F-M'){echo 'selected';}  ?> >TG_F-M</option>
						 	    </select>
						 	      </div>   
                             </div>

                             	<div class="form-group">
								<div class="row">
								 <div class=" col-sm-4" >
								 	<label class="control-label">Male Children</label>
								 	<input type="text" id="malechildren" tabindex="20" name="malechildren" id="malechildren" class="form-control" value="<?php echo $userById[0]['male_children']?>" onkeypress="return isNumberKey(event)" >
								 </div>	
								 <div class=" col-sm-4" >
								 	<label class="control-label">Female Children</label>
								 	<input type="text" id="femalechildren" tabindex="21" name="femalechildren" id="femalechildren" class="form-control" value="<?php echo $userById[0]['female_children']?>" onkeypress="return isNumberKey(event)">
								 </div>
		                          <div class=" col-sm-4" >
								 	<label class="control-label">Total Chidren</label>
								 	<input type="text" id="totalchildren" value="<?php echo $userById[0]['total_children']?>" tabindex="22" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" readonly="">
								 </div>
									</div>
								</div> 

								<div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Native State</label>
                             	 <select class="form-control" onchange="getDistrict()" tabindex="23"  id="state" name="state">
						 		               <option value="" readonly >Select State</option>
									      <?php foreach($stateList as $data){ ?>
									         <option value="<?php echo $data['stateId']; ?>" <?php if($data['stateId'] == $userById[0]['state']){echo 'selected';}?>><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	       </select>
                             	</div>
                             	<div class="col-sm-6">
                             		<label class="control-label">Native District<span></span></label>
                             	   <select name="districtId" tabindex="24" id="districtId" class="form-control">
									     <option value="" readonly>Select District</option>							
								       </select>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Referral Points<span></span></label>
                             		<select class="form-control" onchange="getDistrict()" tabindex="23"  id="referralPoint" name="referralPoint">
					 		               <option value="">-select-</option>
								           <option <?php if($userById[0]['referralPoint'] == 'Construction Site'){echo 'selected';}  ?> >Construction Site</option>
								           <option  <?php if($userById[0]['referralPoint'] == 'Youth Club'){echo 'selected';}  ?> >Youth Club</option>
							               <option  <?php if($userById[0]['referralPoint'] == 'Hotspot'){echo 'selected';}  ?> >Hotspot</option> 	
							               <option  <?php if($userById[0]['referralPoint'] == 'Truckers Point'){echo 'selected';}  ?> >Truckers Point</option>					
							               <option  <?php if($userById[0]['referralPoint'] == 'Others'){echo 'selected';}  ?> >Others</option>				
						 	            </select>
                             	</div>
                             	<div class="col-sm-6">
                             		 <label class="control-label">Referral Points- Details<span></span></label>
                             		  <input type="text" value="<?php echo $userById[0]['referralPoint_others']?>" name="referralPoint1" class="form-control">
                             	</div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class=" control-label">Like to share information about sexual behaviour </label>
                             	</div>
                             	<div class="col-sm-6">
                             	 <select name="sexualBehaviour" tabindex="27" class="form-control" id="sexualBehaviour" >
						 		      <option value="">Select to share information</option>
						 		       <option value="Yes" <?php if($userById[0]['sexualBehaviour'] == 'Yes'){echo 'selected';}  ?> >Yes</option>
						 		        <option value="No" <?php if($userById[0]['sexualBehaviour'] == 'No'){echo 'selected';}  ?> >No</option>
						 	      </select>
                             	</div>
                             </div>
                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Have multiple sex partner</label>
                             	</div>
                             	<div class="col-sm-6">
                             	  <select name="multipleSexPartner" tabindex="28" class="form-control" id="multipleSexPartner" >
						 		      <option value="" readonly>Select</option>
						 		      <option value="Yes" <?php if($userById[0]['multipleSexPartner'] == 'Yes'){echo 'selected';}  ?> >Yes</option>
						 		      <option value="No" <?php if($userById[0]['multipleSexPartner'] == 'No'){echo 'selected';}  ?> >No</option>
						 	      </select>	
                             	</div>
                             </div>
                             	
                             <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Ever Sought paid sex</label>
                             	</div>
                             	<div class="col-sm-6">
                             	   <select name="sought" tabindex="29" class="form-control" id="sought" >
						 		      <option value="">-select-</option>
						 		      <option value="Yes" <?php if($userById[0]['sought'] == 'Yes'){echo 'selected';}  ?> >Yes</option>
						 		     <option value="No" <?php if($userById[0]['sought'] == 'No'){echo 'selected';}  ?> >No</option>
						 	      </select>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Preferred sexual act</label>
                             	</div>
                             	<div class="col-sm-6">
                             	   <select name="prefferedSexualAct[]" multiple="" tabindex="35" class="chosen-select" id="prefferedSexualAct" >
                             	   	<?php $prefferedSexualAct = explode(',',$userById[0]['prefferedSexualAct']); ?>
						 		       <option value="" readonly>Select</option>
						 		        <option <?php if(in_array('Oral',$prefferedSexualAct)) {echo 'selected';} ?> value="Oral">Oral</option>
						 		        <option <?php if(in_array('Anal',$prefferedSexualAct)) {echo 'selected';} ?>  value="Anal">Anal</option>
						 		        <option <?php if(in_array('Vaginal',$prefferedSexualAct)) {echo 'selected';} ?>  value="Vaginal">Vaginal</option>
						 	        </select>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class=" control-label">Preferred sex/Gender of sexual partner</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<?php $prefferedGender = explode(',',$userById[0]['prefferedGender']); ?>		
                             	<select name="prefferedGender[]" multiple="" tabindex="34" class="chosen-select" id="prefferedGender" >
						 		<option value="" readonly> Select</option>
						 		<option <?php if(in_array('Male',$prefferedGender)) {echo 'selected';} ?> value="Male">Male</option>
						 		<option <?php if(in_array('Female',$prefferedGender)) {echo 'selected';} ?> value="Female">Female</option>
						 		<option <?php if(in_array('TG',$prefferedGender)) {echo 'selected';} ?> value="TG">TG</option>-
						 		
						 	
						 	</select>	
                             	</div>
                             </div> 


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class=" control-label">Status of condom usage</label>
                             	</div>
                             	<div class="col-sm-6">
                             	  <select name="condomUsage" tabindex="30" class="form-control" id="condomUsage" >
						 		     <option value="" readonly>Select</option>
						 		     <option <?php if($userById[0]['condomUsage'] == 'In every sex'){echo 'selected';}  ?> value="In every sex">In every sex </option>
						 		     <option <?php if($userById[0]['condomUsage'] == 'In paid sex'){echo 'selected';}  ?> value="In paid sex">In paid sex</option>
						 		     <option <?php if($userById[0]['condomUsage'] == 'Sometime'){echo 'selected';}  ?> value="Sometime">Sometime</option>
						 		     <option <?php if($userById[0]['condomUsage'] == 'Never'){echo 'selected';}  ?> value="Never">Never</option>
						 		     <option <?php if($userById[0]['condomUsage'] == 'Not aware'){echo 'selected';}  ?> value="Not aware">Not aware</option>
						 		</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class=" control-label">Substance Use</label>


                             	</div>
                             	<div class="col-sm-6">
                             		<select name="substanceUse[]" multiple tabindex="31" class="chosen-select" id="substanceUse" >
                                        <?php $substanceUse = explode(',',$userById[0]['substanceUse']); ?>
									 		<option  value="" readonly>Select</option>
									 		<option <?php if(in_array('Tobacco',$substanceUse)){echo 'selected';}  ?> value="Tobacco">Tobacco</option>
									 		<option <?php if(in_array('Drug',$substanceUse)){echo 'selected';}  ?> value="Drug">Drug</option>

									 		<option <?php if(in_array('Alcohol',$substanceUse)){echo 'selected';}  ?> value="Alcohol">Alcohol</option>	
						 	           </select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Have you ever been tested for HIV before?</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		 <select name="hivTestResult" tabindex="32" class="form-control" id="testHiv" >
								 		<option value="" readonly>Select</option>
								 		<option <?php if($userById[0]['hivTestResult'] == 'Yes'){echo 'selected';}  ?> value="Yes">Yes</option>
								 		<option <?php if($userById[0]['hivTestResult'] == 'No'){echo 'selected';}  ?> value="No">No</option>
						 	       </select>
                             	</div>
                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">If yes, When (Please mention how many months / year before)</label>
                             	</div>
                             	<div class="col-sm-6">
                             		
                                    <input type="text" value="<?php echo $userById[0]['hivTestTime'] ?>" name="hivTestTime" value="" class="form-control">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Past HIV Test Result</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	 <select name="pastHivReport" tabindex="33" class="form-control" id="pastHivReport" >
								 		<option value="" readonly>Select</option>
								 		<option <?php if($userById[0]['pastHivReport'] == 'Reactive'){echo 'selected';}  ?> value="Reactive">Reactive</option>
								 		<option <?php if($userById[0]['pastHivReport'] == 'Not-reactive'){echo 'selected';}  ?> value="Not-reactive">Not-reactive</option>
                                      <option <?php if($userById[0]['pastHivReport'] == 'Result not collected'){echo 'selected';}?>  value="Result not collected">Result not collected</option>  
						 	       </select>	
                             	</div>
                             </div>	

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Date of Finger Prick Screening
                                    <span class="required">*</span></label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<div class="input-group date">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
								<input type="text"  onchange="checkdofps()" name="fingerDate"  value="<?php if(!empty($userById[0]['fingerDate']) && $userById[0]['fingerDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['fingerDate'])); }?>" id="data_5" class="form-control input-daterange" required>
							</div>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Referred to SA-ICTC
                                 <span class="required">*</span></label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<select class="form-control" id="saictcRefer" onchange="displayDiv1()" name="saictcRefer" required>
									<option value="">-select-</option>
									<option <?php if($userById[0]['saictcStatus'] == 'Yes'){echo 'selected';}  ?> >Yes</option>
									<option <?php if($userById[0]['saictcStatus'] == 'No'){echo 'selected';}  ?> >No</option>
								</select>	
                             	</div>
                             </div>

                           <div id="saictcReferDiv" style="display: none;" >  

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Date of Out-referral to SA-ICTC</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="saictcDate" id="SAICTCDATE" onchange="checkdofps()" value="<?php if(!empty($userById[0]['saictcDate']) && $userById[0]['saictcDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['saictcDate'])); }?>"  class="form-control">
								</div>
                             	</div>
                             </div>

                               <div class="form-group">
                                <div class="col-sm-6">
                                <label class="control-label">Upload Referral Slip </label>  
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-responsive" onclick="myfunction1();"  id="image1" src="<?php echo base_url();?>uploads/userReferralSlip/<?php if(!empty($userById[0]['referralSlip'])){echo $userById[0]['referralSlip'];}else{ echo 'noImage.png'; }?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >

                                    <input type="file" onchange="imageChange1(this,'image1')" style="display:none;" name="referralUpload" id="referralUpload" class="form-control">
                                </div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Place of SA-ICTC Referred</label>
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="text" name="saictcPlace" value="<?php echo $userById[0]['saictcPlace'] ?>" class="form-control">
                             	</div>
                             </div>

                               <div class="form-group">
                             	<div class="col-sm-6">
                             			<label class="control-label">ICTC -PID Number</label>
                             	</div>
                             	<div class="col-sm-6">
                             	<input type="text" name="ictcNumber" value="<?php echo $userById[0]['ictcNumber'] ?>" class="form-control"	
                             	</div>
                             </div>
                         </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Date of HIV Confirmation Test</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="hivDate" id="HIVDATE" onchange="checkdofps()" value="<?php if(!empty($userById[0]['hivDate']) && $userById[0]['hivDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['hivDate'])); }?>"  class="form-control">
								</div>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Result of HIV Confirmatory Test</label>	
                             	</div>
                             	<div class="col-sm-6">
                             			<select class="form-control" onchange="displayPositive()" id="hivStatus" name="hivStatus">
                             		<option value="">-select-</option>		
									<option <?php if($userById[0]['hivStatus'] == 'Reactive'){echo 'selected';}  ?> >Reactive</option>
									<option <?php if($userById[0]['hivStatus'] == 'Non-Reactive'){echo 'selected';}  ?> >Non-Reactive</option>
								</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Upload ICTC test report scan</label> 
                             	</div>
                             	<div class="col-sm-6">
                             	<img class="img-responsive" onclick="myfunction2();"  id="image2" src="<?php echo base_url();?>uploads/userIctcScan/<?php if(!empty($userById[0]['ictcReportScan'])){echo $userById[0]['ictcReportScan'];}else{ echo 'noImage.png'; }?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >
					
								<input type="file" onchange="imageChange2(this,'image2')" id="ictcUpload" style="display: none;" class="form-control" name="ictcUpload">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	   <label class="control-label">Date of Test Report Issued to Client</label> 	
                             	</div>
                             	<div class="col-sm-6">
                             	 <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="reportIssuedDate" id="TRITC" onchange="checkdofps()" value="<?php if(!empty($userById[0]['reportIssuedDate']) && $userById[0]['reportIssuedDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['reportIssuedDate'])); }?>"  class="form-control">
								</div>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Status Of HIV Confirmation on Report</label>
                             	</div>
                             	<div class="col-sm-6">
	                             	<select class="form-control" name="reportStatus">
									<option >-select</option>
									<option <?php if($userById[0]['reportStatus'] == 'Received By Community'){echo 'selected';}  ?> >Received by Community</option>
									<option <?php if($userById[0]['reportStatus'] == 'Migrated'){echo 'selected';}  ?> >Migrated</option>
									<option <?php if($userById[0]['reportStatus'] == 'Non Acceptance'){echo 'selected';}  ?> > Non Acceptance</option>
									<option <?php if($userById[0]['reportStatus'] == 'Died'){echo 'selected';}  ?> >Died</option>
								</select>
                             	</div>
                             </div>

                         </div>

                         <div id="positiveLineDiv" style="display: none;">

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Linked to ART</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<select class="form-control" name="artLink">
                             			<option value="">-select-</option>
                             			<option <?php if($userById[0]['linkToArt'] == 'Yes'){echo 'selected';}  ?> >Yes</option>
                             			<option <?php if($userById[0]['linkToArt'] == 'No'){echo 'selected';}  ?> >No</option>
                             		</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">ART Registration Date</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	 <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="artDate" id="ARTRD" onchange="checkdofps()" value="<?php if(!empty($userById[0]['artDate']) && $userById[0]['artDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['artDate'])); }?>"  class="form-control">
								</div>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">ART Registration Number</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="text" value="<?php echo $userById[0]['artNumber'] ?>" class="form-control" name="artNumber">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Baseline CD4 Count</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<input type="text" value="<?php echo $userById[0]['cd4Result'] ?>" name="cd4Result" class="form-control">	
                             	</div>
                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Upload ART Green Card scan / photo</label>	
                             	</div>
                             	<div class="col-sm-6">
                                  <img class="img-responsive" onclick="myfunction();"  id="image3" src="<?php echo base_url();?>uploads/userArt/<?php if(!empty($userById[0]['artUpload'])){echo $userById[0]['artUpload'];}else{ echo 'noImage.png'; }?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >
                                    <input  type="file" style="display:none;" name="eventImage" id="inputImage" class="" value=""  >  
                             	<input type="file" id="artUpload" onchange="imageChange(this,'image3')" style="display: none;" class="form-control" name="artUpload">	
                             	</div>
                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Other services provided</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<select class="chosen-select" multiple="" name="otherService[]">
                                        <?php  $otherService = explode(',',$userById[0]['otherService']); ?>
                             			<option value="">-select-</option>
                             			<option <?php if(in_array('Positive living counselling',$otherService)) {echo 'selected';} ?> > Positive living counselling  </option>
                                        <option <?php if(in_array('ART adherence counselling',$otherService)) {echo 'selected';} ?> >ART adherence counselling</option>
											<option <?php if(in_array('Linkage to Social protection',$otherService)) {echo 'selected';} ?> > Linkage to Social protection </option>
											<option <?php if(in_array('Other services',$otherService)) {echo 'selected';} ?> > Other services </option>
                             		</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Status of Client</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<select class="form-control" name="clientStatus" >
                             			<option value="">-select-</option>
                             			<option <?php if($userById[0]['clientStatus'] == 'New Detection'){echo 'selected';}  ?> >New Detection </option>
										<option <?php if($userById[0]['clientStatus'] == 'Known Positive'){echo 'selected';}  ?> > Known Positive </option>
										<option <?php if($userById[0]['clientStatus'] == 'LFU'){echo 'selected';}  ?> > LFU </option>
                             		</select>
                             	</div>
                             </div>

                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Remarks</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<textarea class="form-control" name="remark"><?php echo $userById[0]['remark'] ?></textarea>
                             	</div>
                             </div>
                             </fieldset>
						        

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
            $('#dob').datepicker({changeYear: true, changeMonth: true,format: 'dd-mm-yyyy', endDate: new Date()});
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
      	birthday_val = $('#dob').val().split("-");

      	todayYear = today.getFullYear();
      	todayMonth = today.getMonth();
      	todayDay = today.getDate();

      	var dob = new Date(birthday_val);

      	dobYear  = birthday_val[2];
        dobMonth = birthday_val[1];
        dobDay   = birthday_val[0];
        console.log(dobYear+" "+dobMonth+" "+dobDay);
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

               displayDiv1();

               displayPositive();

               hivDisplay1();

               hrgDisplay();
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

    function myfunction1(){
                $('#referralUpload').trigger('click');
            }

     function imageChange1(input,clickId)
     {
        if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+clickId).attr('src', e.target.result).width(126).height(114);
                };

                reader.readAsDataURL(input.files[0]);
            }            
             
     }

     function myfunction2()
     {
        $('#ictcUpload').trigger('click');
     }

     function imageChange2(input,clickId)
     {
        if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+clickId).attr('src', e.target.result).width(126).height(114);
                };

                reader.readAsDataURL(input.files[0]);
            } 

     }

     function myfunction(){
                
    $('#artUpload').trigger('click');
            
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


        function displayDiv1()
        {
             var saictcRefer = $('#saictcRefer').val();

             if(saictcRefer == 'Yes')
             {
                $('#saictcReferDiv').css('display','block');
             }else{
                $('#saictcReferDiv').css('display','none');
             }  
        }

        function displayPositive()
        {

            var hivStatus = $('#hivStatus').val();

            //alert(hivStatus);

            if(hivStatus == 'Reactive')
            {
                //alert('bnjbhj');
                $('#positiveLineDiv').css('display','block');
            }else{

                $('#positiveLineDiv').css('display','none');
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
            function hrgDisplay()
           {
              var hrg = '<?php echo $userById[0]['hrg'] ?>';

              var arg = '<?php echo $userById[0]['arg'] ?>';

             if($('#hrgRadio').prop('checked') == true )
             {
                $('#hrgRadio').prop('checked','checked');
                $('#hrgDiv').css('display','block');
                 $('#argDiv').css('display','none');    
                 $('#hrg').prop('required',true);
                 $('#arg').prop('required',false);
             }else if($('#argRadio').prop('checked') == true ){
                $('#argRadio').prop('checked','checked');
                  $('#argDiv').css('display','block');
                  $('#hrgDiv').css('display','none');
                  $('#arg').prop('required',true);
                  $('#hrg').prop('required',false);
             }else{
                    $('#hrgDiv').css('display','none');
                 $('#argDiv').css('display','none');    
                  $('#arg').prop('required',false);
                   $('#hrg').prop('required',false);
             }

           }

           function hivDisplay1()
           {
                  var hrg = '<?php echo $userById[0]['hrg'] ?>';

              var arg = '<?php echo $userById[0]['arg'] ?>';


               if(hrg)
               {
                 $('#hrgDIv').css('display','block');
               }else if(arg)
              {
                $('#argDiv').css('display','block');
              } 
           }
    


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

          function checkdofps(){
       //  alert("function");
            var dofps=$('#data_5').val();
            var regDate=$('#regDate').val();
            var saictcDate=$('#SAICTCDATE').val();
            var hivDate=$('#HIVDATE').val();
            var testreportDate=$('#TRITC').val();
            var artDate=$('#ARTRD').val();
           

            console.log($('#regDate').val());
            console.log(dofps);

            if(regDate!='' && dofps<regDate){
                alert("Date of Finger Prick Screening should be greater than"+"\n"+"Date of Registeration!!!");
                $('#data_5').val('');
                console.log('checked');
            }

            if(saictcDate!=''&& dofps!='' && saictcDate<dofps){
                alert("Date of Out-referral to SA-ICTC should be greater than\nDate of finger prick Screening!!!");
                $('#SAICTCDATE').val('');
            }

            if(saictcDate!='' && hivDate!='' && hivDate<saictcDate){
                    alert("Date of HIV Confirmation Test should be greater than\nDate of Out-referral to SA-ICTC!!!");
                    $('#HIVDATE').val('');      
            }

            if(testreportDate!='' && hivDate!='' && testreportDate<hivDate){
                alert("Date of Test Report Issued to Client should be greater than\nDate of HIV Confirmation Test!!!");
                $('#TRITC').val('');
            }

            if(hivDate!='' && artDate!='' && artDate<hivDate){
                alert("Art Registeration Date should be greater than\nDate of HIV Confirmation test!!!");
                $('#ARTRD').val('');
            }



       }

    </script>
 
		
		
		
		
