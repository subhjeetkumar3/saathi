   <style>
   	@media only screen and (max-width: 600px) {
   .content {
    width: auto;
    padding: 0 15px;
}

#slider2_container_{
    width: auto;
    height: 660px;
}


}
.one_half .form-control{background:#F1f1f1 !important; }

   </style>



    <!-- Page Content 
	<div id="main-content" class="container">-->
	<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>Register Yourself</h4>
                <!--<ol class="breadcrumb">
                    
					<li class="active">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">CREATE USER</a>
                    </li>
					
                </ol>-->
            </div>
            
        </div>
		
		
			<div class="ibox-content">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/homeweb/addUser">
				<div style="border: 1px solid   #bfbaba;padding-left: 2%;border-radius: 1%;">	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;width: 98%;">
						 	<label class="control-label">UserName<span>*</span></label>
						 	<input type="text" name="userName" id="userName" class="form-control" tabindex="2" onchange="checkUserExist()" required>
						 </div>
						 <div class="one_half"></div>	
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Password<span>*</span></label>
						 	<input type="text" name="password" id="password" class="form-control"   required>
						 </div>
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Confirm Password<span>*</span></label>
						 	<input type="text" name="password" id="cpassword" class="form-control"   required>
						 	<p style="color: red;display: none;" id="spanPassword">password does not match</p>
						 </div>
						</div>
					</div>
					
						<p style="color: red;display:none;" id="spanUser">Username  already exist.choose another</p>
					
					<div class="clear"></div>	


						<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Phone No.<d<span>*</span></label>
						 	<input type="text" name="Phone" id="Phone" class="form-control"   required>
						 </div>
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Email<span>*</span></label>
						 	<input type="text" name="Email" id="Email" class="form-control"   required>
						 
						 </div>
						</div>
					</div>
					<p style="color: red;display:none;" id="spanUser">Username  already exist.choose another</p>
					
					<div class="clear"></div>	

					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Name<span>*</span></label>
						 	<input type="text" tabindex="2" name="name" class="form-control" id="name" required>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Name (Alias)<span>*</span></label>
						 	<input type="text" name="nameAlias" id="nameAlias" class="form-control" required> 
						 </div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Email Address<span>*</span></label>
						 	<input type="text" tabindex="2" name="emailAddress" id="emailAddress" class="form-control" required >
						 </div>	
						  <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Contact Number<span>*</span></label>
						 	<input type="text" id="mobileNo" name="mobileNo" class="form-control" onkeypress="return isNumberKey(event)" required>
						 </div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
                            <label class="control-label">Date Of Birth<span>*</span></label>
						 	<input type="date" tabindex="2" name="dob" id="dob" class="form-control" required >
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Age<span>*</span></label>
						 	<input type="text" name="age" id="age" class="form-control" required>
						 </div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
							 <label class="control-label">Gender<span>*</span></label>
							 <select name="gender" tabindex="2" id="gender" class="form-control" >
							 	<option value="">Select Gender</option>
							 	<option value="Male">Male</option>
							 	<option value="Female">Female</option>
							 	<option value="TG">TG</option>
							 	<option value="Others">Others</option>
							 </select>	
							</div>
							<!--<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Current Address<span>*</span></label>
						 	<input type="text" id="address" tabindex="2" name="address" class="form-control">
						 </div>-->
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							<h4>Current Address</h4>
						</div>
					</div>	
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
                            <label class="control-label">State</label>
							<select class="form-control" tabindex="2" onchange="getAddressDistrict(this.value);" id="state" name="state" required >
						 		<option value="" readonly>Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								<?php } ?>									
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">District<span>*</span></label>
						  <div id="aaaa1">	
						 	<select name="districtId" id="districtId" class="form-control" required>
									<option value="" readonly>Select District</option>							
								</select>
						 </div>
						 </div>
						</div>
					</div>

					<div class="clear"></div>
					<div class="form-group">
						<div class="row"> 
							<div class="one_half" style="margin-right: 2%;width: 98%;">
								<label class="control-label">Address</label>
								<input type="text" name="" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div style="border: 1px solid   #bfbaba;padding-left: 2%;margin-top: 3%;padding-bottom: 2%;border-radius: 1%;">

					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Native State<span>*</span></label>
						 	<select class="form-control" tabindex="2" onchange="getDistrict(this.value);" id="state" name="state" required >
						 		<option value="" readonly>Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								<?php } ?>									
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Native District<span>*</span></label>
						  <div id="aaaa">	
						 	<select name="districtId" id="districtId" class="form-control" required>
									<option value="" readonly>Select District</option>							
								</select>
						 </div>		
						 </div>
						</div>
					</div>
					<div class="clear"></div>			
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Place Of Origin</label>
						 	<input type="text" name="placeoforigin" id="placeoforigin" class="form-control" >
						 </div>						
					
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Education Level</label>
								<input type="text" name="educationalLevel" class="form-control" >
							</div>
						</div>
					</div>
					<div class="clear"></div>	
					
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Occupation</label>
						 	<input type="text"  tabindex="2" name="occupation" id="occupation" class="form-control" >
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Occupation-Others</label>
						 	<input type="text" name="occupation1" id="occupation1" class="form-control">
						 </div>
						</div>
					</div>
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Domain Of Work</label>
						 	<input type="text" tabindex="2" name="domainOfWork" id="domainOfWork" class="form-control" >
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Monthly Income</label>
						 	<input type="text"  name="monthlyIncome" id="monthlyIncome" class="form-control" onkeypress="return isNumberKey(event)">
						 </div>
						</div>
					</div>
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Marital Status</label>
						 	<select name="maritalStatus" tabindex="2" class="form-control" id="maritalStatus" >
						 		<option value="">Select Marital Status</option>
						 		<option value="Married">Married</option>
						 		<option value="Divorced">Divcored</option>
						 		<option value="Widow/Widower">Widow/Widower</option>
						 		<option value="Unmarried">Unmarried</option>
						 		<option value="Separated">Separated</option>
						 	</select>
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Marital Status (For Others)</label>
						 	<select name="maritalStatus1" id="maritalStatus1" class="form-control">
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
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="col-lg-4" style="width: 98%;">
						 	<label class="control-label">Male Children</label>
						 	<input type="text" id="malechildren" name="malechildren" id="malechildren" class="form-control" tabindex="2" onkeypress="return isNumberKey(event)" >
						 </div>	
						 <div class="col-lg-4" style="width: 98%;">
						 	<label class="control-label">Female Children</label>
						 	<input type="text" id="femalechildren" name="femalechildren" id="femalechildren" class="form-control" onkeypress="return isNumberKey(event)">
						 </div>
						 <div class="col-lg-4" style="width: 98%;">
						 	<label class="control-label">Total Chidren</label>
						 	<input type="text" id="totalchildren" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" >
						 </div>
						</div>
					</div>
					<!--<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
					  	</div>
					</div>-->
					
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Primary Identity</label>
						 	<input type="text" tabindex="2" name="primaryIdentity" id="primaryIdentity" class="form-control">
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Primary Identity-Others</label>
						 	<input type="text" name="primaryIdentity1" id="primaryIdentity1" class="form-control">
						 </div>
						</div>
					</div>
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Secondary Identity</label>
						 	<input type="text" tabindex="2" name="secondaryIdentity" id="secondaryIdentity" class="form-control">
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Secondary Identity-Others</label>
						 	<input type="text" name="secondaryIdentity1" id="secondaryIdentity1" class="form-control">
						 </div>
						</div>
					</div>
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Referral Point</label>
						 	<input type="text" tabindex="2" name="referralPoint" id="referralPoint" class="form-control">
						 </div>	
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Referral Point-Others</label>
						 	<input type="text" name="referralPoint1" id="referralPoint1" class="form-control">
						 </div>
						</div>
					</div>
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 	<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Have You Ever Been Tested For HIV Before</label>						   
								<input type="text" name="hivTest" class="form-control">
						    </div>
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">If Yes,When (months/year before)</label>						 
								<input type="text" name="hivTestTime" class="form-control">
						 </div>
						</div>
					</div>
					<div class="clear"></div>	
					<div class="form-group">
						<div class="row">
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Past HIV Test Result</label>						
						 	<input type="text" name="hivTestResult" class="form-control">
						 </div>						
						 <div class="one_half" style="margin-right: 2%;">
						 	<label class="control-label">Date Of Finger Prick Screening</label>						 
						 	<input type="date" name="fingerDate" class="form-control">
						 </div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							 <div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Finger Prick Screening Report</label>						 
								<input type="text" name="fingerReport" class="form-control">
							 </div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Status Of Referral To SA-ICTC</label>							
								<input type="text" name="saictcStatus" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Date Of Out-Referral To SA-ICTC</label>							
								<input type="date" name="saictcDate" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Place Of SA-ICTC Referred</label>							
								<input type="text" name="saictcPlace" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
                    <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">ICTC-PID Number</label>							
								<input type="text" name="ictcNumber" class="form-control" onkeypress="return isNumberKey(event)">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Date Of HIV Confirmation Test</label>							
								<input type="date" name="hivDate" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Status Of HIV Confirmation Test</label>							
								<input type="text" name="hivStatus" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Date Of Test Report Issued To Client</label>							
								<input type="date" name="reportIssuedDate" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
                    <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Status Of Confirmation on Report</label>							
								<input type="text" name="reportStatus" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Referred To ART Center</label>							
								<input type="text" name="artCenter" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
                   <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Pre-ART/ART NUmber</label>							
								<input type="text" name="artNumber" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Status Of CD4 Test</label>							
								<input type="text" name="cd4Status" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Result Of CD4 Test</label>							
								<input type="text" name="cd4Result" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Status Of ART Intake</label>							
								<input type="text" name="artStatus" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Tested For Syphilis</label>							
								<input type="text" name="syphilisTest" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Result For TB Test</label>							
								<input type="text" name="syphilisResult" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
                    <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Tested for TB</label>							
								<input type="text" name="tbTest" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Result For TB Test</label>							
								<input type="text" name="tbResult" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
                   <div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">If Yes,Referred To RNTCP</label>							
								<input type="text" name="rntcpRefer" class="form-control">
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<label class="control-label">Remark	</label>							
								<input type="text" name="remark" class="form-control">
							</div>
						</div>
					</div>
					<div class="clear"></div>
				
					<div class="form-group">						
						<!--<div class="one_half" style="margin-right: 2%; text-align:center;">-->
						<div class="one" style="text-align:center;margin-top: 30px;">
							<input type="submit" name="submit" id="submit" value="SUBMIT" class="btn btn-sm btn-primary">
					    <!--</div>
						<div class="one_half" style="margin-right: 2%;text-align:left;">-->
							&nbsp; &nbsp;
							<a href="<?php echo base_url();?>index.php/homeweb" class="btn btn-default" style="    width: auto;
    position: relative;
    background-color: #0371d2;
    color: #FFF;
    padding: 5px 12px;
    font: 14px Tahoma;
    display: inline-block;
    line-height: 22px;
    border: 0 none;
    cursor: pointer;
    text-decoration: none;">Cancel</a>
					    </div>
					</div>

                </div>


					<!--<div class="form-group">
					<div class="row" style="margin-right: -14px; margin-left: 1px;">
						<div class="one_half" style="margin-right: 2%;">
							<div class="input-group">
								<select data-placeholder="Choose a Country..." name="stateId" class="chosen-select" id="stateId" style="width:300px;" tabindex="2" onchange="getDistrict(this.value);" >
									<option value="" readonly>Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
									<?php } ?>
									
								</select>
							</div>
						</div>
						
						<div class="one_half" style="margin-right: 2%;">
							<div class="input-group" id="aaaa">
								<select data-placeholder="Choose a Country..." name="districtId" id="districtId" class="chosen-select" style="width:300px;" tabindex="2" >
									<option value="" readonly>Select District</option>							
								</select>
							</div>
						</div>
						</div>
						
						
					</div>-->
				
					<!--<div class="form-group">
							
						<div class="one_half" style="margin-right: 2%;">
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

	<p id="demo"></p>
	
<script>

var jq = jQuery.noConflict();	

function checkUserExist()
{
    var userName = jq('#userName').val();

    //var password = jq('#password').val();

    jq.ajax({
    	type: "POST",
    	url: "checkUserExist",
    	data: {userName:userName},
    	success:function(data){
    		var rslt = jq.trim(data)
    		 var result = JSON.parse(rslt);
    		 var len =  result.length;
    		 if(len != 0)
    		 {
    		 	//alert(len);
    		 	//alert('User with  username '+userName+' already exist');
    		 	jq('#aaa').html(userName);
    		 	jq('#spanUser').css('display','block');
    		 	jq('#submit').attr('type','button'); 
    		 }
    		 else
    		 {
                  jq('#spanUser').css('display','none');
    		 	  jq('#submit').attr('type','submit'); 
    		 }	
    	}
    });
}

jQuery('#cpassword').change(function(){
	if(jQuery('#cpassword').val() != '')
	{
		if(jQuery('#password').val() != jQuery('#cpassword').val())
		{
			jQuery('#spanPassword').css('display','block');
			jQuery('#submit').attr('type','button');
		}
		else{
			jQuery('#spanPassword').css('display','none');
			jQuery('#submit').attr('type','submit');
		}
	}
});


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

function getAddressDistrict(stateId){
	//alert(stateId);
	jq("#aaaa1").html('');
	jq.ajax({
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

						//alert(htm);
						jq("#aaaa1").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select class="form-control"  name="districtId"  id="sl2"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						//alert(htm);
						jq("#aaaa1").html(htm);
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
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
    </script>
    <script>
		function searchPara(){
			if($("#currentLat").prop("checked") == true){
				var aas='';
			}else{
				$("#currentLat").val('');
			}''
//alert('msgAlert');
if($("#stateId").val()!='' || $("#districtId").val()!='' || $("#serviceTypeId").val()!='' ||$("#serviceTypeParameterId").val()!='' || $("#currentLat").val()!=''){
	//alert("kkk");
	$("#msgAlert").css({'display':'none'});
	$("#subSearch").trigger("click");
	
	
}else{
	//alert("jjjj");
	$("#msgAlert").css({'display':'block'});
}
}


    </script>
<?php //} ?>