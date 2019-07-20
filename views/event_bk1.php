<style>
.required{
	color : red;
}
</style>

<div <?php if(!empty($er)){?>style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/event"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php echo $total_error;  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>Event Name</th>
							<th>Event Venue</th>
							<th>Event Date</th>
							<th>Mobile</th>
							<th>Website</th>
							<th>Topic</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color:red;"><?php echo $value['error']; ?></td>
							<td><?php echo $value['eventName']; ?></td>
							<td><?php echo $value['eventVenue']; ?></td>
							<td><?php echo $value['eventDate']; ?></td>
							<td><?php echo $value['mobileNo']; ?></td>
							<td><?php echo $value['website']; ?></td>
							<td><?php echo $value['topic']; ?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/event"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
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
                               <?php if(empty($id)){?>  <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Event List</a></li>
							   <?php } ?>
								 <li class="<?php if(!empty($id)){ echo 'active'; }?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i><?php if(!empty($id)){ echo 'Update Entry'; }else{ echo 'New Entry'; }?></a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					<div id="tab-2" class="tab-pane <?php if(empty($id)){ echo 'active'; } ?> ">
						
						   <div class="ibox-title">
                            <h5>Event List</h5>
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
													<th>Event Name</th>
													<th>Venue</th>
													<th>Event Date</th>
													<th>Mobile</th>
													<th>Website</th>
													<th>Topic</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($eventList as $value) { ?>
                                                <tr id="row<?php echo $value['eventId']; ?>">
													<td><?php echo $value['eventName']; ?></td>
													<td><?php echo $value['eventVenue']; ?></td>
													<td><?php echo date('d-m-Y', strtotime($value['eventDate'])); ?></td>
													<td><?php echo $value['mobileNo']; ?></td>
													<td><?php echo $value['website']; ?></td>
													<td><?php echo $value['topic']; ?></td>
													<td class="text-right footable-visible footable-last-column">
												<a href="<?php echo base_url();?>index.php/home/event?id=<?php echo $value['eventId']; ?>"><span class="btn-white btn btn-xs">Edit</span></a>
												<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['eventId']; ?>,'eventId','tbl_event_data')">
													Delete</span>
											</td>
												</tr>
												<?php } ?>
												
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						<div id="tab-1" class="tab-pane <?php if(!empty($id)){ echo 'active'; }else { echo ''; } ?>">
							<div class="ibox-title">
								<h5>Please <?php if(!empty($id)){ echo 'Update'; }else { echo 'Add'; } ?> Events</h5>
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelEvent" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import Event Excel</label>
										   <div class="col-sm-8" style="display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/event_excel_format" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
							<div class="ibox-content">
								<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/event/<?php if(!empty($id)){echo $id;} ?>">
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
												<input type="text" class="form-control" name="startDate" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['startDate'];} ?>" >
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
												<input type="text" id="startTime" name="startTime" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['startTime'];} ?>" data-format="hh:mm A" class="form-control clockpicker" mousewheel="false">
										</div>
									</div>
								</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">End Date<span class="required">*</span></label>
										<div class="col-sm-10">
											<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="endDate" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['endDate'];} ?>" >
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">End Time<span class="required">*</span></label>
										<div class="col-sm-10">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</span>
												<input type="text" class="form-control clockpicker" mousewheel="false" name="endTime" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['endTime'];} ?>" >
											</div>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Mobile No.<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="mobile" id="mobile" onkeypress="return isNumberKey(event)" onblur ="minlength(this.value);" maxlength="10" value="<?php if(!empty($eventEditData)){echo$eventEditData[0]['mobileNo']; }?>" required>
											<span id="mobileSpan" style="color:red; display:none;">Mobile No. should be 10 digit</span>
										</div>
										
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Website<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="website" value="<?php if(!empty($eventEditData)){echo $eventEditData[0]['website'];} ?>" required>
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
										<label class="col-sm-2 control-label">Other Info<span class="required">*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="otherInfo" value="<?php if(!empty($eventEditData)){ echo $eventEditData[0]['otherInfo'];}	 ?>" >
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
		</script>
		
