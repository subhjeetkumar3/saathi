<style>
.required{
	color : red;
}
</style>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Onground Partner</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Onground Partne</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
		<?php if($this->session->flashdata('success_message')){?>
		   <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <?php echo $this->session->flashdata('success_message');?>
                            </div>
		   <?php }?>
			<div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
								 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Update Entry</a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">	 
						<div id="tab-1" class="tab-pane active">
							<div class="ibox-title">
								<h5>Update Onground Partner</h5>
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
						   
					   </div>
							<div class="ibox-content">
								<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updatePartner">
									<div class="form-group">
										<div class="row">
											<input type="hidden" name="partnerId" value="<?php echo $ongroundPartnerId;?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Unique ID</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" readonly name="uniqueId" value="<?php echo $ongroundPartnerById[0]['ongroundPartnerUniqueId']?>">
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Name<span class="required">*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" required  name="name" value="<?php echo $ongroundPartnerById[0]['name']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Address</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="address" value="<?php echo $ongroundPartnerById[0]['address']?>">
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Office Phone</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="officePhone" value="<?php echo $ongroundPartnerById[0]['officePhone']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Mobile<span class="required">*</span></label>
												<div class="col-sm-10">
													<input type="text" required class="form-control"  name="mobile" value="<?php echo $ongroundPartnerById[0]['mobile']?>">
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="email" value="<?php echo $ongroundPartnerById[0]['email']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Latitude</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="latitude" value="<?php echo $ongroundPartnerById[0]['latitude']?>">
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Longitude</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="longitude" value="<?php echo $ongroundPartnerById[0]['longtitute']?>">
												</div>
											</div>
										</div>
										<!--<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Latitude</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="latitude" value="<?php echo $ongroundPartnerById[0]['latitude']?>">
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Longitude</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="longitude" value="<?php echo $ongroundPartnerById[0]['longtitute']?>">
												</div>
											</div>
										</div>-->
										<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">State<span class="required">*</span></label>
												<div class="col-sm-10">
													<select class="form-control" onchange="getDistrict()" id="state" required name="state">
														<option value="">-Select a state-</option>
														<?php foreach($stateList as $value){?>
															<option value="<?php echo $value['stateId']?>" <?php if($value['stateId'] == $ongroundPartnerById[0]['stateId']){echo 'selected';}?> ><?php echo $value['stateName']?> </option>
														<?php }?>	
													</select>
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">District<span class="required">*</span></label>
												<div class="col-sm-10">
													<select class="chosen-select" multiple="" name="district[]" id="district" required>
									
														<option value="">-Select a district-</option>
														
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Location</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="location" value="<?php echo $ongroundPartnerById[0]['location']?>">
												</div>
											</div>
											<div class="col-sm-6">
												<label class="col-sm-2 control-label">Day and Time</label>
												<div class="col-sm-10">
													<input type="text" class="form-control"  name="dayAndTime" value="<?php echo $ongroundPartnerById[0]['dayAndTime']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
                                         <div class="col-sm-4 col-sm-offset-5">
                                              <a href="<?php echo base_url(); ?>index.php/home/ongroundPartner" class="btn btn-white">Cancel</a>
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
				
				
				
				
				
            </div>
        </div>
        <div class="footer">
            
        </div>

        </div>
        </div>
<script type="text/javascript">
	window.onload = function(){
		getDistrict();
	}
</script>		
<script>
	function isNumberKey(evt){
	//alert(evt);
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}    
</script>	
<script>
		function minlength(val){
			var count = val.length;
			if(count<10){
				$("#mobileSpan").css({'display':'block'});
				$("#formSubmit").attr('type','button');
				$("#mobile").focus();
			}else{
				$("#mobileSpan").css({'display':'none'});
				$("#formSubmit").attr('type','submit');
				//$("#formSubmit").trigger('click');
			}
			
		}
</script>	

<script>
		function myfunction(){
				
	$('#inputImage').trigger('click');
			
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
		</script>
<script type="text/javascript">
function getDistrict(){

	var pausecontent = new Array();
			<?php $districts = explode(',',$ongroundPartnerById[0]['districtId']); ?>
			<?php if(!empty($districts)){
				foreach($districts as $key => $val){ ?>
				pausecontent.push('<?php echo $val; ?>');
			<?php } } ?>

		var state = $('#state').val();
         
		$.ajax({
			type: "POST",
			url : "<?php echo base_url();?>index.php/home/getDistrict",
			data:{state:state},
			success: function(data){
                 var rslt = $.trim(data);
				 result = JSON.parse(rslt);
				 var len = result.length; 

				 htm = "<option>-Select a district-</option>";  

				 for(var i = 0;i < len;i++){

				 	var idx = $.inArray(result[i].districtId,pausecontent);

				 	if(idx == -1){
				 		htm += '<option value="'+result[i].districtId+'" >'+result[i].districtName+'</option>';
						}else{
							htm += '<option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option>';
						}
				 	}

				 	$('#district').html('');

				 	$('#district').html(htm).trigger("chosen:updated");
				 }


   
		});

}
</script>
