
   <style>
   	@media only screen and (max-width: 600px) {
   		.pre_number{width: 16% !important;}
   		.content2 {
    width: 100%;
    padding: 0 15px;
    float: left;
}
   .content {
    width: auto;
    padding: 0 15px;
}

#slider2_container_{
    width: auto;
    height: 660px;
}
.ibox_form{padding: 10px !important;}

.second_form{    height: 1840px;
    border: 1px solid #bfbaba;
    border-radius: 1%;
    width: 98%;
    margin-top: 10px;
    padding: 10px;}


}
.one_half .form-control{background: #ccc !important; }

@media only screen and (min-width: 800px) {
.re_marks {margin-left: -25px !important;}

.ibox_form{    height: 437px !important;
    padding-left: 25px;    width: 98%;}
.user_alert{color: red;display:none;position: absolute;
    left: 42px;
    top: 130px;"
}
.second_form{border: 1px solid #f1f1f1;height: 1080px;
    border: 1px solid #bfbaba;
    border-radius: 1%;
    width: 98%;
    margin-top: 10px;
    padding-left: 25px;}}


    .control-label{font-weight: bold;}
h3{font-size: 20px;line-height: 50px;}

   </style>

    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>Register Yourself</h4>
                <!--<ol class="breadcrumb">
                    
					<li class="active">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">Register Yourself</a>
                    </li>
					
                </ol>-->
            </div>
            
        </div>
		
		
			<div class="ibox-content">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/homeweb/addUser">
				<div class="ibox_form" style="border: 1px solid   #bfbaba;border-radius: 1%;">		
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">User Name<span>*</span></label>
						 	<input type="text" name="userName" id="userName" class="form-control" tabindex="1" required>
						 </div>
						 <p class="user_alert"style="color: red;display:none;" id="spanUser">Username  already exist.choose another</p>
						 </div>
						 <div class="one_half" style="margin-right: 2%;">
							 <label class="control-label">Gender<span>*</span></label>
							 <select name="gender" tabindex="2" id="gender" class="form-control" required>
							 	<option value="">Select Gender</option>
							 	<option value="Male">Male</option>
							 	<option value="Female">Female</option>
							 	<option value="TG">TG</option>
							 	
							 </select>	
							</div>
						 </div>	
					 <div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Password<span>*</span></label>
						 	<input type="password" name="password" id="password" tabindex="3" class="form-control" required>
						 </div>
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Confirm Password<span>*</span></label>
						 	<input type="password" name="password" id="cpassword" tabindex="4" class="form-control"   required>
						 	<p style="color: red;display: none;" id="spanPassword">password does not match</p>
						 </div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Name<span>*</span></label>
						 	<input type="text"  name="name" tabindex="5" class="form-control" id="name" required >
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Name (Alias)</label>
						 	<input type="text" name="nameAlias" id="nameAlias" tabindex="6" class="form-control" > 
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">

							<div class="one_half" style="margin-right: 2%;">
                            <label class="control-label">Date Of Birth</label>
						 	<input type="date"  name="dob" id="dob" tabindex="7" class="form-control" >
						 </div>	
							 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Age<span>*</span></label>
						 	<input type="text" name="age" id="age" readonly tabindex="8" class="form-control" required>
						 </div>
							
							
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 
						  <div class="one_half" style="margin-right: 2%; clear: both;">
						 	<label class="control-label">Mobile Number (to receive OTP)</label>

							<div>						 	
							<input type="text" id="" disabled="" name="" placeholder="+91-" style="width:14%;font-weight: bold;color: #000000;" class="form-control pre_number" onkeypress="return isNumberKey(event)" required=""><input type="text" id="mobileNo" name="mobileNo" onkeypress="return isNumberKey(event)" style="margin-left: -16px;width: 89%;font-weight: bold;color: #000000;border-left: none;" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" tabindex="9" >
							<p style="display: none;color: red" id="mobileSpan">Mobile number should have atleast 10 digits</p>
							</div>
						 	<!-- <input type="text" id="mobileNo" name="mobileNo" placeholder="+91-" style="font-weight: bold;color: #000000;" class="form-control" onkeypress="return isNumberKey(event)" required> -->
						 </div>
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Current Address</label>
						 	<input type="text" id="address"  name="address" tabindex="10" class="form-control" >
						 </div>	
						 
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">State<span>*</span></label>
						 	<select class="form-control" tabindex="11"  id="state1" name="addressState" required>
						 		<option value="" readonly >Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								<?php } ?>									
						 	</select>
						 </div>
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">District<span>*</span></label>
						 	<div id="aaaa1">	
						 	<select name="addressDistrict" tabindex="12" id="districtId1" class="form-control">
									<option value="" readonly>Select District</option>							
								</select>
						 </div>	
						 </div>	
						 
						</div>
					</div>
				</div>

				<div class="second_form">
					<div class="form-group">
						<div class="row">
						 
						
						 	<div class="one_half" style="margin-right: 2%;width: 98%;">
						 	<label class="control-label">Education</label>
						 	<select name="education" tabindex="13" class="form-control" id="education" >
						 		<option value=""readonly>Select Education</option>
						 		<option value="Pre-Literate">Pre-Literate</option>
						 		<option value="Primary(1-5)">Primary(1-5)</option>
						 		<option value="Secondary(6-10)">Secondary(6-10)</option>
						 		<option value="Higher Secondary">Higher Secondary</option>
						 		
						 		<option value="Graduation and Above">Graduation and Above</option>
						 		<option value="Non formal education">Non formal education</option>
						 	</select>
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Occupation</label>
						 	<select name="occupation" tabindex="14" class="form-control" id="occupation" >
						 		<option value="" readonly>Select Occupation</option>
						 		<option value="Salaried">Salaried</option>
						 		<option value="Self employed">Self employed</option>
						 		
						 		<option value="Daily wage">Daily wage</option>
						 		
						 		<option value="Student">Student</option>
						 		<option value="Sex work">Sex work</option>
						 		
						 		<option value="Badhai">Badhai</option>
						 		<option value="Mangt">Mangt</option>
						 		<option value="Dancing">Dancing</option>
						 		<option value="Truckers">Truckers</option>
						 		<option value="Migrant">Migrant</option>
						 		<option value="Drivers">Drivers</option>
						 		<option value="Other">Other</option>
						 	</select>
						 </div>
						 	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Occupation-Others</label>
						 	<input type="text" name="occupation1" tabindex="15" id="occupation1" class="form-control">
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<div class="one_half" style="width: 98%;">
						 	<label class="control-label">Monthly Income</label>
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
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Marital Status</label>
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
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Marital Status - Others</label>
						 	<!-- <select name="" id="maritalStatus1" tabindex="19" class="form-control">
						 		<option value="">Select Marital Status</option>
						 		<option value="Married">Married</option>
						 		<option value="Divorced">Divcored</option>
						 		<option value="Widow/Widower">Widow/Widower</option>
						 		<option value="Unmarried">Unmarried</option>
						 		<option value="Separated">Separated</option>
						 	</select> -->
						 	<input type="text" id="maritalStatus1" class="form-control" tabindex="19" name="maritalStatus1">
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="float: right;margin-right: 2%;">
						 	<label class="control-label">Male Children</label>
						 	<input type="text" id="malechildren" tabindex="20" name="malechildren" id="malechildren" class="form-control"  onkeypress="return isNumberKey(event)" >
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Female Children</label>
						 	<input type="text" id="femalechildren" tabindex="21" name="femalechildren" id="femalechildren" class="form-control" onkeypress="return isNumberKey(event)">
						 </div>
						</div>
						</div>

						<div class="form-group">
						<div class="row"> 
						 <div class="one_half" style="margin-right: 2%; width: 98%;">
						 	<label class="control-label">Total Chidren</label>
						 	<input type="text" id="totalchildren" tabindex="22" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" readonly="">
						 </div>
						  <div class="one_half" style="margin-right: 2%;">
						 	
						 </div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%">
						 	<label class="control-label">HRG</label>
						 	 <select class="form-control" name="hrg">
						 	 	  <option value="" readonly >-Select-</option>
						 	 	     <option value="MSM" >MSM</option>
						 		      <option value="TG(M-F)" >TG(M-F)</option>
						 		    
						 		      <option value="FSW" >FSW</option>
						 		      <option value="IDU" >IDU</option>
						 	 </select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">ARG</label>
						   <select class="form-control" name="arg">
						   	       <option value="">-select-</option>
						 	    	<option>Single Male migrant</option>
						 	    	<option>Trucker</option>
						 	    	<option>Partner / Spouse of FSW</option>
						 	    	<option>Have multiple partners </option>
						 	    	<!-- <option>Female partner (FPARG)</option>
						 	    	<option>Female Partner (FPHRG)</option> -->
						 	    <option>Female Partner-ARG</option>
						 	    	<option>Female Partner-HRG</option>	
						 	     <option value="TG(F-M)" >TG(F-M)</option>
						   </select>
						 </div>	
							
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 <label class="control-label">Native State<span></span></label>
						 <select class="form-control" tabindex="23"  id="state" name="state">
						 		<option value="" readonly >Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								<?php } ?>									
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Native District<span></span></label>
						  <div id="aaaa">	
						 	<select name="districtId" tabindex="24" id="districtId" class="form-control">
									<option value="" readonly>Select District</option>							
								</select>
						 </div>		
						 </div>
						</div>
					</div>
					
				
						<div class="form-group">
						<div class="row">
						<div class="one_half" style="margin-right: 2%;width: 98%;">
						 	<label class="control-label">Like to share information about sexual behaviour </label>
						 	<select name="sexualBehaviour" tabindex="27" class="form-control" id="sexualBehaviour" >
						 		<option value="" readonly>Select to share information</option>
						 		<option value="Yes">Yes</option>
						 		<option value="No">No</option>
						 		
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Have multiple sex partner</label>
						 	<select name="multipleSexPartner" tabindex="28" class="form-control" id="multipleSexPartner" >
						 		<option value="" readonly>Select</option>
						 		<option value="Yes">Yes</option>
						 		<option value="No">No</option>
						 	
						 	</select>
						 </div>	
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Ever Sought paid sex</label>
						 	<select name="sought" tabindex="29" class="form-control" id="sought" >
						 		<option value="" readonly></option>
						 		<option value="Yes">Yes</option>
						 		<option value="No">No</option>
						 		
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Preferred sex/Gender of sexual partner</label>
						 	<select name="prefferedGender[]" multiple="" tabindex="34" class="form-control" id="prefferedGender" style="overflow: -webkit-paged-x;">
						 		<option value="" > Select</option>
						 		<option value="Male">Male</option>
						 		<option value="Female">Female</option>
						 		<option value="TG">TG</option>
						 		<!--<option value=""></option>
						 		<option value=""></option>-->
						 	</select>
						 </div>
						</div>
					</div>



					<div class="form-group">
					<div class="row">
						
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Preferred sexual act</label>
						 	<select name="prefferedSexualAct[]" multiple="" tabindex="35" class="form-control" id="prefferedSexualAct" style="overflow: -webkit-paged-x;">
						 		<option value="">Select</option>
						 		<option value="Oral">Oral</option>
						 		<option value="Anal">Anal</option>
						 		<option value="Vaginal">Vaginal</option>
						 		
						 	</select>

						 </div>
                              <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Status of condom usage</label>
						 	<select name="condomUsage" tabindex="30" class="form-control" id="condomUsage" >
						 		<option value="" readonly>Select</option>
						 		<option value="In every sex">In every sex </option>
						 		<option value="In paid sex">In paid sex</option>
						 		<option value="Sometime">Sometime</option>
						 		<option value="Never">Never</option>
						 		<option value="Not aware">Not aware</option>
						 	</select>
						 </div>	



						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Substance Use</label>
						 	<select name="substanceUse[]" multiple="" tabindex="31" class="form-control" id="substanceUse" style="overflow: -webkit-paged-x;">
						 		<option value="" readonly>Select</option>
						 		<option value="Tobacco">Tobacco</option>
						 		<option value="Drug">Drug</option>
						 		<option value="Alcohol">Alcohol</option>
						 		
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Have you ever been tested for HIV before?</label>
						 	<select name="hivTestResult" tabindex="32" class="form-control" id="testHiv" >
						 		<option value="" readonly>Select</option>
						 		<option value="Yes">Yes</option>
						 		<option value="No">No</option>
						 		
						 	</select>
						 </div>	
						</div>
					</div>



	
	<div class="form-group">
					<div class="row">
						<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">If yes, When (Please mention how many months / year before)</label>
						 	<!-- <select name="hivConfirmation" tabindex="33" class="form-control" id="hivConfirmation" >
						 		<option value="" readonly>Select</option>
						 		<option value="reactive">Reactive</option>
						 		<option value="not-reactive">Not-reactive</option>
						 	</select> -->
						 	<input type="text" class="form-control" name="">
						 </div>
						

	

						<div class="one_half" style="margin-right: 2%;">
						 	
						 </div>	
						</div>
					</div>

					<div class="form-group">
					<div class="row">
						<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Past HIV Test Result</label>
						 	<select name="pastHivReport" tabindex="33" class="form-control" id="pastHivReport" >
						 		<option value="" readonly>Select</option>
						 		<option value="Reactive">Reactive</option>
						 		<option value="Not-reactive">Not-reactive</option>
						 		<option value="Result not collected">Result not collected</option>
						 	</select>
						 </div>
						
			 <div class="one_half" style="margin-right: 2%;">
						 
							 	<label class="control-label">Remarks</label>
							 	<input type="text" name="remark" tabindex="17" id="remark" class="form-control">
							 
</div>

	

							
						</div>
					</div>




					





					
	







				</div>
						  <!-- <div class="one_half">
						 	<label class="control-label">Email Address</label>
						 	<input type="text" tabindex="2" name="emailAddress" id="emailAddress" class="form-control">
						 </div> -->		

					
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
                      <!--	<label class="control-label">Referral Point</label> -->
						 	<input type="hidden"  name="referralPoint" id="referralPoint" class="form-control">
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<!-- <label class="control-label">Referral Point-Others</label> -->
						 	<input type="hidden" name="referralPoint1" id="referralPoint1" class="form-control">
						 </div>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="row">
						 
						 <div class="one_half">
						 	<label class="control-label">Place Of Origin</label>
						 	<input type="text" name="placeoforigin" id="placeoforigin" class="form-control">
						 </div>
						</div>
					</div> -->
					<!-- <div class="form-group">
						<div class="row">
						 	<div class="one_half">
						 	<label class="control-label">Have You Ever Been Tested For HIV Before</label>
						   </div> 
						   <div class="one_half">
						 	<input type="text" name="hivTest" class="form-control">
						  </div>	 	
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half">
						 	<label class="control-label">If Yes,When(months/year before)</label>
						 </div>	
						 <div class="one_half">
						 	<input type="text" name="hivTestTime" class="form-control">
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half">
						 	<label class="control-label">Past HIV Test Result</label>
						 </div>	
						 <div class="one_half">
						 	<input type="text" name="hivTestResult" class="form-control">
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half">-->
						 	<!-- <label class="control-label">Date Of Finger Prick Screening</label> -->
					<!-- 	 </div>	
						 <div class="one_half">
						 	<input type="hidden" name="fingerDate" class="form-control">
						 </div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half">
						 	<label class="control-label">Finger Prick Screening Report</label>
						 </div>	
						 <div class="one_half">
						 	<input type="text" name="fingerReport" class="form-control">
						 </div>
						</div>
					</div> -->


						<div class="form-group">
					<div class="row">
						 <div class="one_half" style="margin-right: 2%; width:98%;">
						 	<br>
						 	
<input type="checkbox" name="confirm" value="confirm" id="confirm" required>I agree that I am above 18 years of age
                     <br><br>
					<input type="checkbox" name="consent" value="consent"  id="consent" required>By signing up, I agree to your Terms, Privacy Policy and agree to receive calls, messages, emails from the website
						 </div>

						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<!-- <label class="control-label"> Referral To SA-ICTC</label> -->
							</div>
							<div class="one_half" style="margin-right: 2%;">
								<input type="hidden" name="saictcStatus" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<!-- <label class="control-label">Date Of Out-Referral To SA-ICTC</label> -->
							</div>
							<div class="one_half" style="margin-right: 2%;">
								<input type="hidden" name="saictcDate" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<!-- <label class="control-label">Place Of SA-ICTC Referred</label> -->
							</div>
							<div class="one_half" style="margin-right: 2%;">
								<input type="hidden" name="saictcPlace" class="form-control">
							</div>
						</div>
					</div>
                  <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<!-- <label class="control-label">ICTC-PID Number</label> -->
							</div>
							<div class="one_half" style="margin-right: 2%;">
								<input type="hidden" name="ictcNumber" class="form-control" onkeypress="return isNumberKey(event)">
							</div>
						</div>
					</div>
                   <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<!-- <label class="control-label">Date Of HIV Confirmation Test</label> -->
							</div>
							<div class="one_half" style="margin-right: 2%;">
								<input type="hidden" name="hivDate" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<!-- <label class="control-label">Status Of HIV Confirmation Test</label> -->
							</div>
							<div class="one_half" style="margin-right: 2%;">
								<input type="hidden" name="hivStatus" class="form-control">


							</div>

						</div>

						
					</div>


					
                    <!-- <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Result of HIV Confirmatory Test</label>
							</div>
							<div class="one_half">
								<input type="hidden" name="" class="form-control">
							</div>
						</div>
					</div>
                  <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Status Of Confirmation on Report</label>
							</div>
							<div class="one_half">
								<input type="text" name="reportStatus" class="form-control">
							</div>
						</div>
					</div>
                   <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Referred To ART Center</label>
							</div>
							<div class="one_half">
								<input type="text" name="artCenter" class="form-control">
							</div>
						</div>
					</div>
					  <div class="form-group">
						<div class="row">
							<div class="one_half">-->
								<!-- <label class="control-label">Date of Test Report Issued to Client</label> -->
							<!-- </div>
							<div class="one_half">
								<input type="hidden" name="reportStatus" class="form-control">
							</div>
						</div>
					</div>
                   <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Pre-ART/ART NUmber</label>
							</div>
							<div class="one_half">
								<input type="text" name="artNumber" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Status Of CD4 Test</label>
							</div>
							<div class="one_half">
								<input type="text" name="cd4Status" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Result Of CD4 Test</label>
							</div>
							<div class="one_half">
								<input type="text" name="cd4Result" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Status Of ART Intake</label>
							</div>
							<div class="one_half">
								<input type="text" name="artStatus" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Tested For Syphilis</label>
							</div>
							<div class="one_half">
								<input type="text" name="syphilisTest" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Result For TB Test</label>
							</div>
							<div class="one_half">
								<input type="text" name="syphilisResult" class="form-control">
							</div>
						</div>
					</div>
                    <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Tested for TB</label>
							</div>
							<div class="one_half">
								<input type="text" name="tbTest" class="form-control">
							</div>
						</div>
					</div>
                  <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Result For TB Test</label>
							</div>
							<div class="one_half">
								<input type="text" name="tbResult" class="form-control">
							</div>
						</div>
					</div>
                   <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">If Yes,Referred To RNTCP</label>
							</div>
							<div class="one_half">
								<input type="text" name="rntcpRefer" class="form-control">
							</div>
						</div>
					</div>  -->
              <!--      <div class="form-group">
						<div class="row">
							<div class="one_half">
								<label class="control-label">Remark	</label>
							</div>
							<div class="one_half">
								<input type="text" name="remark" class="form-control">
							</div>
						</div>
					</div> -->
					<div class="form-group">
						<div class="one_half" style="margin-right: 2%;margin-top: 20px;">
						<a href="http://101.53.136.41/sahya" class="btn btn-default pull-right" style="    background: green;color: #fff;padding: 8.5px 13px;border-radius: 3px;">Cancel</a>
					   </div>
						<div class="one_half" style="margin-right: 2%; margin-top: 20px;">
						<input type="submit" name="submit" id="submit" value="SUBMIT" class="btn btn-sm btn-primary">
					   </div>
					</div>




					<!--<div class="form-group">
					<div class="row" style="margin-right: -14px; margin-left: 1px;">
						<div class="one_half">
							<div class="input-group">
								<select data-placeholder="Choose a Country..." name="stateId" class="chosen-select" id="stateId" style="width:300px;" tabindex="2" onchange="getDistrict(this.value);" >
									<option value="" readonly>Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
									<?php } ?>
									
								</select>
							</div>
						</div>
						
						<div class="one_half">
							<div class="input-group" id="aaaa">
								<select data-placeholder="Choose a Country..." name="districtId" id="districtId" class="chosen-select" style="width:300px;" tabindex="2" >
									<option value="" readonly>Select District</option>							
								</select>
							</div>
						</div>
						</div>
						
						
					</div>-->
				
					<!--<div class="form-group">
							
						<div class="one_half">
						<input type="text" name="searchText" placeholder="Name, Address" class="form-control"> 
						</div>
						<div class="col-lg-12">
							<select class="form-control" name="serviceTypeId" id="serviceTypeId" onchange="subCategory();">
								<option value="" readonly>Select Service Focus</option>
								<?php foreach($serviceProviderType as $val){ ?>
									<option value="<?php echo $val['serviceTypeId']; ?>" <?php if($val['serviceTypeId'] == $search['serviceTypeId']){ echo 'selected';}?>><?php echo $val['serviceTypeName']; ?></option>
								<?php } ?>
								
							</select>
						</div>
					</div>-->
					<!--<div class="form-group">

						<div class="col-lg-12">
							<select class="form-control" name="serviceTypeParameterId" id="serviceTypeParameterId">
								<option value="" readonly>Select Service Area</option>
							</select>
						</div>
					</div>-->
					<!--<div class="form-group">
						<div class="col-lg-12">
							<input type="checkbox" name="latLong" id="currentLat" value=""> Click here to find service provider in the neighbourhood (5Km radius)
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button onclick="searchPara();" class="btn btn-sm btn-white" type="button">Search</button>
							<input type="submit" name="" id="subSearch" style="display:none;">
						</div>
					</div>-->
				</form>
			</div>
		</div>
	
		

		
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
	<p id="demo"></p>
	
<script>

var jq = jQuery.noConflict();	



function getDistrict(stateId){
	//alert(stateId);
	jq("#aaaa").html('');
	jq.ajax({
			type: "POST",
			url: "getDistrict",
			data: {stateId:stateId},
			success: function(data) {
				//alert(data);
				var rslt = jq.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					
					var htm = '';
						htm += '<select class="form-control"  name="districtId" id="sl2"><option value="" readonly>No District</option></select>';
						jq("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select class="form-control"  name="districtId"  id="sl2"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						jq("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
		
					
					
				}
			}
		});
}


</script>
<?php //echo json_encode($serviceProviderList); ?>

<?php //if($serviceProviderList) { ?>
     <script type="text/javascript">
    	function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			//alert(charCode);
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
    </script>

    <script type="text/javascript">
    	/*$('#dob').on('change',function(){
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
       $('#age').val(yearDifference);

    	});
*/
    	

    
    </script>
    
    <script type="text/javascript">
    	(function($){

        $('#userName').keypress(function( e ) {
        	 var regex = new RegExp("^[_a-zA-Z0-9]+$");

        	 var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      /* if(e.which === 32 || e.key == '@'  || e.key == '#' || e.key == '$' || e.key == '%' || e.key == '^' || e.key == '*' || e.key == '(' || e.key == ')' || e.key == '-' || e.key == '-' || e.key == '+' || e.key == '|' || e.key == '/' || e.key == '<' || e.key == '>' || e.key == '&' || e.key == '!' || e.key == '`' || e.key == '~') 
         return false;*/

         if(e.which === 32 || !regex.test(key))
         	return false;
       });

 

      var checkUser = 0;

      var checkUserMobile = 0;

    		$('#userName').change(function(){
             var userName = $('#userName').val();
           //alert(userName);
             $.ajax({
                type: "POST",
    	        url: "<?php echo base_url()?>index.php/homeweb/checkUserExist",
    	        data: {userName:userName},
    	        success:function(data){
    	        	//alert(data);
                  var rslt = $.trim(data)
    		      var result = JSON.parse(rslt);
    		      var len =  result.length;

    		      if(len != 0)
    		      {
    		      	//alert(userName);
    		      	//$('#aaaa').html(userName);
    		      	checkUser = 1;
                    $('#spanUser').css('display','block');
                    $('#submit').attr('type','button');
    		      }
    		      else{
    		      	checkUser = 0;
    		      	$('#spanUser').css('display','none');
    		      	$('#submit').attr('type','submit');
    		      }	
    	        }
             });
    		});

       $('#cpassword').change(function(){
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
       });

       $('#dob').on('change',function(){
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
    			alert('Mobile Number should have atleast 10 digits')
    			$('#submit').attr('type','button');
    		}else{
    			//$('#mobileSpan').css('display','none');
    			$('#submit').attr('type','submit');
    		}

    		if(mobileNo != '')
    		{
    			$.ajax({
    				type:"POST",
    				url : "<?php echo base_url().'index.php/homeweb/checkUserMobile'?>",
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
    	});

    	$('#submit').click(function(){
    		age = $('#age').val();

    		if(age < 18)
    		{
              $('#submit').attr('type','button');

               alert('You should be 18 years or above to register & view this website');
    		}
    		else{
    			$('#submit').attr('type','submit');
    		}

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

    	$('#state1').change(function(){

    		var stateId = $('#state1').val();
    		$("#aaaa1").html('');
	   $.ajax({
			type: "POST",
			url: "getDistrict",
			data: {stateId:stateId},
			success: function(data) {
				//alert(data);
				var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					
					var htm = '';
						htm += '<select class="form-control"  name="addressDistrict" id="sl23"><option value="" readonly>No District</option></select>';

						//alert(htm);
						$("#aaaa1").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select class="form-control"  name="addressDistrict"  id="sl23"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						//alert(htm);
						$("#aaaa1").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
		
					
					
				}
			}
		});
    	});

    	$('#state').change(function(){
    		var stateId = $('#state').val();

    		//alert(stateId);
	     $("#aaaa").html('');
	  $.ajax({
			type: "POST",
			url: "getDistrict",
			data: {stateId:stateId},
			success: function(data) {
				//alert(data);
				var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					
					var htm = '';
						htm += '<select class="form-control"  name="districtId" id="sl2"><option value="" readonly>No District</option></select>';
						$("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select class="form-control"  name="districtId"  id="sl2"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						$("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
		
					
					
				}
			}
		});
    	});


       $('form').submit(function(event){

           var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
    			event.preventDefault();
    			alert('Mobile Number should have atleast 10 digits')
    			
    		}

    		var age = $('#age').val();

    		if(age < 18)
    		{
    			event.preventDefault();
    			alert('You should be 18 years or above to register & view this website')
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

     if(checkUser == 1)
     {
     	event.preventDefault();
     	alert('User name already exist.choose another');
     }

     if(checkUserMobile == 1)
     {
     	event.preventDefault();
     	alert('Mobile no already taken.choose another');
     }	

       });

    		
    	})(jQuery);
    </script>
