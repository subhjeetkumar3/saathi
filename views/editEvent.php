<style>
.required{
	color : red;
}

.increaseColumn{
	width: 500px;
}
</style>


<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Event</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Event</strong>
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
                             
								 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Update entry</a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
				
						 
						 
						<div id="tab-1" class="tab-pane  active">
							<div class="ibox-title">
								<h5>Please Update Events</h5>
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
								<form method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateEvent">
								<input type="hidden" name="eventId" value="<?php echo $id ?>">	
									<div class="form-group">
										<label class="col-sm-2 control-label">Event Name<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="eventName" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['eventName'];} ?>" required>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Venue<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="venu" value="<?php if(!empty($eventEditData)) {echo $eventEditData[0]['eventVenue'];} ?>" required>
										</div>
									</div>
									<!--<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Event Date<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="date" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['eventDate'];} ?>" >
											</div>
										</div>
									</div>-->
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Start Date<span class="required">*</span></label>
										<div class="col-sm-10">
											<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="startDate" value="<?php if(!empty($eventEditData)){echo date('d-m-Y',strtotime($eventEditData[0]['startDate']));} ?>" readonly required>
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Start Time<span class="required" >*</span></label>
										<div class="col-sm-10">
											<div class="input-group">	
												<span class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</span>
												<input type="text" id="startTime" name="startTime" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['startTime'];} ?>" data-format="hh:mm A" class="form-control clockpicker" readonly required mousewheel="false">
										</div>
									</div>
								</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">End Date</label>
										<div class="col-sm-10">
											<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="endDate" value="<?php if(!empty($eventEditData[0]['endDate'])){echo date('d-m-Y',strtotime($eventEditData[0]['endDate']));} ?>" readonly >
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">End Time</label>
										<div class="col-sm-10">
											<div class="input-group clockpicker" >
												<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
													<input type="text"  class="form-control readonly" name="endTime" value="<?php if(!empty($eventEditData)){
														echo $eventEditData[0]['endTime'];
													}?>" readonly required>
												</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Mobile No</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="mobile" id="mobile" onkeypress="return isNumberKey(event)" onchange="checkMobile()" maxlength="10" value="<?php if(!empty($eventEditData)){echo$eventEditData[0]['mobileNo']; }?>" >
											<span id="mobileSpan" style="color:red; display:none;">Mobile No. should be 10 digit</span>
										</div>
										
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Website</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="website" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['website'];} ?>" >
											<span style="color: red;">Make sure not to put https:// or http:// before the link</span>
										</div>
									</div>
									<!--<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Topic<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="topic" value="<?php if(!empty($eventEditData)){ echo $eventEditData[0]['topic'];}	 ?>" required>
										</div>
									</div>-->
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Other Info</label>
										<div class="col-sm-10">
											<!-- <input type="text" class="form-control" name="otherInfo" value="<?php if(!empty($eventEditData)){ echo $eventEditData[0]['otherInfo'];}	 ?>" > -->
											<textarea class="form-control" name="otherInfo"><?php if(!empty($eventEditData)){ echo $eventEditData[0]['otherInfo'];}	 ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Event Image</label>
										<div class="col-sm-10">
											<img class="img-responsive" onclick="myfunction();"  id="image1" src="<?php echo base_url();?>uploads/eventImage/<?php if(!empty($eventEditData[0]['eventImage'])){echo $eventEditData[0]['eventImage'];}else{ echo 'eventDefault.png'; }?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >
												<input  type="file" style="display:none;" name="eventImage" id="inputImage" class="" value="" onchange="imageChange(this,'image1')" >
										</div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2">
											<a href="<?php echo base_url(); ?>index.php/home/event" class="btn btn-white">Cancel</a>
											<button class="btn btn-primary" id="formSubmit" name ="submit" type="submit">Submit</button>
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

			function checkMobile()
			{
				var mobile = $('#mobile').val()

				if(mobile != '')
				{
					if(mobile.length < 10)
					{
						$('#mobileSpan').css('display','block');
                        $('#formSubmit').attr('type','button');

					}
					else{
						$('#mobileSpan').css('display','none');
						$('#formSubmit').attr('type','submit');
					}	
				}else{
						$('#mobileSpan').css('display','none');
						$('#formSubmit').attr('type','submit');
					}	
			}
		</script>
		
