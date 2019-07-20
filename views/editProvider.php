<style>
.none{
	display:none !important;
}
</style>


 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Service Provider</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Service Provider</strong>
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
                            <h5>Service Provider Update</h5>
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
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addServiceProvider/<?php if(!empty($serviceProviderById)){echo $serviceProviderById[0]['serviceProviderId']; }?>">
							   <div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Unique Id</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="uniqueId" id="uniqueId" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['uniqueId']; }else{ echo $serviceProviderUniqueId;} ?>" readonly required>
											<span style="color:red;" id="error"></span>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="name" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['name'];} ?>" required>
										</div>
									</div>

									
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Gender</label>
										<div class="col-sm-10">
											<select class="form-control" name="gender">
												<option value="">-Select Gender-</option>
												<option value="TG" <?php if($serviceProviderById[0]['gender'] == 'TG'){echo 'selected';}?>>TG</option>
												<option value="Male" <?php if($serviceProviderById[0]['gender'] == 'Male'){echo 'selected';}?>>Male</option>
												<option  value="Female" <?php if($serviceProviderById[0]['gender'] == 'Female'){echo 'selected';}?>>Female</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Qualification</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="qualification" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['qualification'];} ?>" >
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Address</label>
										<div class="col-sm-10">
											<textarea type="text" class="form-control" name="address" required><?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['address'];} ?></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Mobile</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="mobileNo" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['mobile'];} ?>" maxlength ="10" onkeypress="return isNumberKey(event)" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Landline</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="officePhone" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['officePhone'];} ?>" onkeypress="return isNumberKey(event)" >
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" name="email" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['email'];} ?>" >
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Other Mobile</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="otherMobile" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['otherMobile']; }?>" maxlength ="10" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Location</label>
										<div class="col-sm-10">
											<select name="location" class="form-control">
												<option value="">-Select location-</option>
												<option value="Village" <?php if($serviceProviderById[0]['location'] == 'Village'){echo 'selected';}?>>Village</option>
												<option value="Town" <?php if($serviceProviderById[0]['location'] == 'Town'){echo 'selected';}?>>Town</option>
												<option value="City" <?php if($serviceProviderById[0]['location'] == 'City'){echo 'selected';}?>>City</option>
											</select>
										</div>
									</div>
								</div>		
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">State</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="state" id="state" onchange="getDistrict()" required>
												<option value="" readonly>Select State</option>
												<?php foreach($stateList as $value){ ?>
												<option value="<?php echo $value['stateId'];?>" <?php if(!empty($serviceProviderById)){if($serviceProviderById[0]['state'] == $value['stateId']){echo "selected ='selected'";}}?>><?php echo $value['stateName'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">District</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="districtId" id="districtId" required>
												<!-- Data come from JS -->
											</select>
										</div>
									</div>
								</div>

                               <div class="hr-line-dashed"></div>
                               <div class="form-group">
								<div class="col-sm-6">
										<label class="col-sm-2 control-label">Queer friendly rating</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="rating" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['rating']; }?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Affiliation</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="affiliation" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['affiliation'];} ?>">
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<div class="col-sm-6">
										<label class="col-sm-2 control-label">Days</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="day" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['day'];} ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Time</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="time" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['time'];} ?>">
										</div>
									</div>
							  </div>
							  <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Linkage</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="linkage" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['linkage']; }?>">
										</div>
									</div>
								</div>
								 <div class="hr-line-dashed"></div>
								 <div class="form-group">
									<div class="col-sm-6">
									  <label class="col-sm-2 control-label">Face to face consultations</label>
											<div class="col-sm-10">
											<select name="conFace" class="form-control">
												<option value="">-Select-</option>
												<option value="Yes" <?php if($serviceProviderById[0]['conFace'] == 'Yes' || $serviceProviderById[0]['conFace'] == 'yes'){echo 'selected';}?>>Yes</option>
												<option value="No" <?php if($serviceProviderById[0]['conFace'] == 'No' || $serviceProviderById[0]['conFace'] == 'no'){echo 'selected';}?>>No</option>
											</select>
											</div>
										</div>
										<div class="col-sm-6">
										<label class="col-sm-2 control-label">Home Visits</label>
										<div class="col-sm-10">
										<select name="conHome" class="form-control">
											<option value="">-Select-</option>
											<option value="Yes" <?php if($serviceProviderById[0]['conHome'] == 'Yes' || $serviceProviderById[0]['conHome'] == 'yes'){echo 'selected';}?>>Yes</option>
											<option value="No" <?php if($serviceProviderById[0]['conHome'] == 'No' || $serviceProviderById[0]['conHome'] == 'no'){echo 'selected';}?>>No</option>
										</select>
										</div>
									</div>
	
									</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consultations on telephone</label>
										<div class="col-sm-10">
										 <select name="conTel" class="form-control">
										 	<option value="">-Select-</option>
										 	<option value="Yes" <?php if($serviceProviderById[0]['conTel'] == 'Yes' || $serviceProviderById[0]['conTel'] == 'yes'){echo 'selected';}?>>Yes</option>
										 	<option value="No" <?php if($serviceProviderById[0]['conTel'] == 'No' || $serviceProviderById[0]['conTel'] == 'no'){echo 'selected';}?>>No</option>
										 </select>	
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consultations through emails</label>
										<div class="col-sm-10">
											<select name="conEmail" class="form-control">
											<option value="">-Select-</option>
											<option value="Yes" <?php if($serviceProviderById[0]['conEmail'] == 'Yes' || $serviceProviderById[0]['conEmail'] == 'yes'){echo 'selected';}?>>Yes</option>
											<option value="No" <?php if($serviceProviderById[0]['conEmail'] == 'No' || $serviceProviderById[0]['conEmail'] == 'no'){echo 'selected';}?>>No</option>
											</select>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								 <div class="col-sm-12">
								 	<div class="col-sm-6">
								 	<label class="control-label">Consultations over Skype / video conference / other chat</label>
								 	</div>
								 	<div class="col-sm-6">
								 		<select name="conOnline" class="form-control">
								 			<option>-Select-</option>
								 			<option value="Yes" <?php if($serviceProviderById[0]['conOnline'] == 'Yes' || $serviceProviderById[0]['conOnline'] == 'yes'){echo 'selected';}?>>Yes</option>
								 			<option value="No" <?php if($serviceProviderById[0]['conOnline'] == 'No' || $serviceProviderById[0]['conOnline'] == 'no'){echo 'selected';}?>>No</option>
								 		</select>
								 	</div>
								 </div>	
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consulation Charges</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="conCharges" value="<?php if(!empty($serviceProviderById)){echo $serviceProviderById[0]['conCharges'];} ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Concession</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="concession" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['concession'];} ?>">
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Latitude</label>
										<div class="col-sm-10">
											<input type="text" title="Latitude should be equal to or below 99.9999" class="form-control" name="latitude" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['latitude'];} ?>" required  placeholder="Latitude should be equal to or below 99.9999" onkeypress="return isNumberLatLong(event,this)" id="lat">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Longitude</label>
										<div class="col-sm-10">
											<input type="text" title="Longitude should be equal to or below 99.9999" class="form-control" name="longitude" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['longitude'];} ?>" required onkeypress="return isNumberLatLong(event,this)" placeholder="Longitude should be equal to or below 99.9999" id="long">
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<?php $serviceType = explode(',',$serviceProviderById[0]['serviceType']); ?>
								<div class="form-group">
									<label class="col-sm-2 control-label">Service Focus</label>
									<div class="col-sm-4">
										<input type="checkbox" <?php if(in_array('1',$serviceType)){echo 'checked';} ?> value="1" id="serviceFocus1" name="serviceTypeId[]" onclick="showDivFirst()">Sexual Health
									</div>

									<div class="col-sm-4">
										<input type="checkbox" <?php if(in_array('2',$serviceType)){echo 'checked';} ?>  value="2" id="serviceFocus2" name="serviceTypeId[]" onclick="showDivSecond()">Mental Health
									</div>

									<div class="col-sm-4">
										<input type="checkbox" <?php if(in_array('3',$serviceType)){echo 'checked';} ?>  value="3" id="serviceFocus3" name="serviceTypeId[]" onclick="showDivThird()">Legal aid
									</div>
								</div>
								
								
								
							


								<!--<div class="hr-line-dashed"></div>

								<div>
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Sexual Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields" name="serviceFields[]" required>
												
												
											</select>
										</div>
									</div>
								</div>	
								</div> -->

								<div id="sexualServiceDiv" style="display: none;">
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Sexual Health Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields1" name="serviceFields[]" >
												
												<!-- Data Come from JS -->
											</select>
										</div>
									</div>
								</div>	
								</div>
								
								<div id="mentalServiceDiv" style="display: none;">
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Mental Health Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields2" name="serviceFields[]" >
												
												<!-- Data Come from JS -->
											</select>
										</div>
									</div>
								</div>	
								</div>
								
								<div id="legalServiceDiv" style="display: none;">
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Legal Aid Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields3" name="serviceFields[]" >
												
												<!-- Data Come from JS -->
											</select>
										</div>
									</div>
								</div>	
								</div>
																	
									
								<!--<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Skype Id</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="skypeId" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['skypeId'];} ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Website</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="website" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['website'];} ?>">
										</div>
									</div>
								</div>-->									
									
								<!--<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consulation Mode</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="conMode" required>
												<option value="" readonly>Select Consulation Mode</option>
												<?php foreach($modeList as $value){ ?>
												<option value="<?php echo $value['modeId'];?>" <?php if(!empty($serviceProviderById)){ if($serviceProviderById[0]['conMode'] == $value['modeId']){echo "selected ='selected'";}}?>><?php echo $value['modeName'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>-->	
																	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/serviceProvider" class="btn btn-white">Cancel</a>
                                       <!--  <button class="btn btn-primary" type="button" onclick="getServiceUniqueId('<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['serviceProviderId']; }?>');">Submit</button> -->
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
		<?php if(!empty($serviceProviderById)){ //if($serviceProviderById){ ?>
		<script>
			window.onload = function() {
			  // alert('aaa');
			   getDistrict();
			   getServiceFieldsEdit();

			   showDivFirst();

			   showDivSecond();

			   showDivThird();
			};
		</script>
		<?php //} 
	     } ?>
		<script>
		/*function submitForm(){
			//alert('aaa');
			$('#submit').trigger('click');
		}*/
		function getServiceUniqueId(serviceProviderId){
			//alert(serviceProviderId);
			var id = $('#uniqueId').val();
			//alert(id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceUniqueId",
				data: {id:id,serviceProviderId:serviceProviderId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					if(result[0].total == 0){
						$('#error').html('');
						$('#submit').trigger('click');
					}else{
						$('#error').html('Should be Unique Id');
						$('#uniqueId').focus();
					}
				}
			});
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
					      if (CharAfterdot > 5) {
					        return false;
					      }
					    }	
				    }else{
						return false;
				    }	
			    }
			    

			    

			    
				
			  }
		}
		
		function getServiceFields(){
			/*var pausecontent = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php
				foreach($serviceFields as $key => $val){ ?>
				pausecontent.push('<?php echo $val; ?>');
			<?php } ?>*/
			//console.log(pausecontent);
			var serviceTypeId = $('#serviceTypeId').val();
			//alert(serviceTypeId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:serviceTypeId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					//alert("Image Approved");
					htm = '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					//	var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent);
						//if (idx == -1) {
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						/*} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}*/
					}

					/*alert("1-"+serviceTypeId.indexOf("1"));

					alert("2-"+serviceTypeId.indexOf("2"));

                    alert("3-"+serviceTypeId.indexOf("3"));
*/

				/*	if(serviceTypeId.indexOf("1") == -1)
					{
						alert('ghyjghjg');
					}	*/



					if(serviceTypeId.indexOf("1") == 0)
					{
						$('#sexualServiceDiv').css('display','block');
						$('#serviceFields1').html('');
					$('#serviceFields1').html(htm);
					$('#serviceFields1').trigger("chosen:updated");
					}

					if(serviceTypeId.indexOf("2") == 0)
					{
						$('#mentalServiceDiv').css('display','block');
						$('#serviceFields2').html('');
					$('#serviceFields2').html(htm);
					$('#serviceFields2').trigger("chosen:updated");
					}

				    if(serviceTypeId.indexOf("3") == 0)
					{
						$('#legalServiceDiv').css('display','block');
						$('#serviceFields3').html('');
					$('#serviceFields3').html(htm);
					$('#serviceFields3').trigger("chosen:updated");
					}	
					//alert(htm);
					
				}
			});
			
		}
		
		function getServiceFieldsEdit(){
			var pausecontent = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php if(!empty($serviceFields)){
				foreach($serviceFields as $key => $val){ ?>
				pausecontent.push('<?php echo $val; ?>');
			<?php } } ?>
			//console.log(pausecontent);
			var serviceTypeId = $('#serviceTypeId').val();
			//alert(serviceTypeId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:serviceTypeId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					//alert("Image Approved");
					htm = '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
						var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent);
						if (idx == -1) {
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}
					}
					//alert(htm);
					$('#serviceFields').html('');
					$('#serviceFields').html(htm);
					$('#serviceFields').trigger("chosen:updated");
				}
			});
			
		}

		function showDivFirst()
		{
			var pausecontent = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php if(!empty($serviceFields)){
				foreach($serviceFields as $key => $val){ ?>
				pausecontent.push('<?php echo $val; ?>');
			<?php } } ?>

			if($('#serviceFocus1').is(':checked'))
			{
			 	$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:'1'},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].serviceTypeParameterId);
					//alert("Image Approved");
					var htm = ''; 
					htm += '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){

						var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent);
						if (idx == -1) {
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}
					
					
						
					}

						//alert(htm);
               $('#sexualServiceDiv').css('display','block');
					$('#serviceFields1').html('');
					$('#serviceFields1').html(htm);
					$('#serviceFields1').prop('required',true);
					$('#serviceFields1').prop('disabled',false).trigger("chosen:updated");	
					
				}
			});	

			 
			}
			else{
                $('#sexualServiceDiv').css('display','none');
                $('#serviceFields1').prop('required',false);
                $('#serviceFields1').prop('disabled',true);
						$('#serviceFields1').html('');
				/*	$('#serviceFields1').html(htm);
					$('#serviceFields1').trigger("chosen:updated");*/
			}
		}

		function showDivSecond()
		{
		  var pausecontent1 = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php if(!empty($serviceFields)){
				foreach($serviceFields as $key => $val){ ?>
				pausecontent1.push('<?php echo $val; ?>');
			<?php } } ?>	

			if($('#serviceFocus2').is(':checked'))
			{

			   $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:'2'},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].serviceTypeParameterId);
					//alert("Image Approved");
					var htm = ''; 
					htm += '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					
							//htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';

                       	var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent1);
						if (idx == -1) {

				              
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}

						
					}

			          $('#mentalServiceDiv').css('display','block');
						//$('#serviceFields2').html('');
					$('#serviceFields2').html(htm);
					$('#serviceFields2').prop('required',true);
					$('#serviceFields2').prop('disabled',false).trigger("chosen:updated");
					
				}
			});		

            
			}
			else{
                $('#mentalServiceDiv').css('display','none');
                $('#serviceFields1').prop('required',false);
                $('#serviceFields2').prop('disabled',true);
						$('#serviceFields2').html('');
				/*	$('#serviceFields2').html(htm);
					$('#serviceFields2').trigger("chosen:updated");*/
			}
		}

		function showDivThird()
		{
			var pausecontent2 = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php if(!empty($serviceFields)){
				foreach($serviceFields as $key => $val){ ?>
				pausecontent2.push('<?php echo $val; ?>');
			<?php } } ?>

           if($('#serviceFocus3').is(':checked'))
			{
			  $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:'3'},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].serviceTypeParameterId);
					//alert("Image Approved");
					var htm = ''; 
					htm += '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					
						/*	htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';*/

						  	var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent2);
						if (idx == -1) {

				              
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}
						
					}

			        $('#legalServiceDiv').css('display','block');
						$('#serviceFields3').html('');
					$('#serviceFields3').html(htm);
					$('#serviceFields3').prop('required',true);
					$('#serviceFields3').prop('disabled',false).trigger("chosen:updated");
				}
			});			
               
			}
			else{
                $('#legalServiceDiv').css('display','none');
                $('#serviceFields3').prop('disabled',true);
						$('#serviceFields3').html('');
					/*$('#serviceFields2').html(htm);
					$('#serviceFields2').trigger("chosen:updated");*/
			}
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
						
						if(result[i].districtId == '<?php echo $serviceProviderById[0]['districtId']; ?>'){
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
		
		
		
		
