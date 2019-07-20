<style>
.none{
	display:none !important;
}
</style>
<div <?php if(!empty($er)){?> style="display:block;" <?php } ?> class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/smsModule"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php echo $total_error;  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>User Name</th>
							<th>Mobile No</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color:red;"><?php echo $value['error']?></td>
							<td><?php echo $value['userName']?></td>
							<td><?php echo $value['mobile']?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/importantLink"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>SMS</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>SMS</strong>
                        </li>
                    </ol>
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
							<li class="<?php if(!empty($smsById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>SMSes List</a></li>
							<li class="<?php if(!empty($smsById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane <?php if(!empty($smsById)){ echo ''; }else { echo 'active'; } ?>">
								<div class="ibox-title">
									<h5>Send SMSes List</h5>
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
													<th>To</th>
													<th>User</th>
													<th>Text</th>
													<th>Date & Time</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($smsList as $value) { ?>
                                                <tr id="row<?php echo $value['smsId']; ?>">
													<td><?php  switch ($value['to']) {
														case 'webUser':
															echo 'Only Backend';
															break;

													  case 'webSmsUser'	:
													  
													   echo 'Backend registered who are also SMS consented';

													   break;

													  case 'smsUser': 

													   echo 'Only SMS registered';

													   break;

													   case 'smsWebUser':
								
													   echo 'SMS consented who are also Backend registered';	

													   break; 
														
														default:
															echo 'Both Backend + SMS registered';
															break;
													} ?></td>
													<td><?php echo $value['users']; ?></td>
													<td><?php echo $value['smsText']; ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['createdDate'])); ?></td>
													<?php if($value['sendStatus'] == 'Y') { ?>
													<td><button type="button" class="btn btn-sm btn-success">Sent</button></td>
													<?php } else { ?>
													<td><button type="button" class="btn btn-sm btn-danger">Not Send</button></td>
													<?php } ?>
													
													<?php if($value['sendStatus'] == 'Y') { ?>
														<td class="text-right footable-visible footable-last-column">
															<span class="btn-info btn btn-xs"
														onclick="smsReport(<?php echo $value['smsId']; ?>)">
														See Info</span>
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['smsId']; ?>,'smsId','tbl_sms')">
														Delete</span>
														</td>
													<?php } else { ?>
														<td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['smsId']; ?>,'smsId','tbl_sms')">
														Delete</span>
														<!-- <a href="<?php echo base_url(); ?>index.php/home/smsModule/<?php echo $value['smsId']; ?>"><span class="btn-white btn btn-xs">
														Edit</span></a> -->
														</td>
													<?php } ?>
													
												</tr>
												<?php } ?>
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane">
								<div class="ibox-title">
									<h5>Please Define SMS to be sent + identify recipients</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a>
									</div>
								
						   <!--<form method="post"  class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelSms" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <h2>Import SMS Excel</h2>
										  
											
											<div class="col-md-4">
												<span>Send Via:</span><select class="form-control m-b ff" name="sendVia" id="sendVia1" required onchange="sendMode1()">
													<option value="" readonly>Select</option>
													<option value="text" >Text</option>
													<option value="template" >Template</option>
												</select>
											</div>
									
										<div id="sendMode1">
											 Data come from JS 
										</div>
										   <div class="col-md-2" display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:35px;margin-top: 18px;">
											   <input type="file" name="importExcel" required style="padding: 5px;">
											   </label>
											 	</div>  
											   <button class="btn btn-primary btn-lg" type="submit" style="padding: 4px 10px;margin-top: 18px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/sms_excel_format" class="btn btn-primary" style="margin-left: 5px; margin-top: 18px;">Download Format</a>
										   </div>
									   </div>
								   </div>
								   </form>-->
							   </div>
						   
					  
								<div class="ibox-content">
									<form method="post" id="smsModuleForm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addSMS/<?php if(!empty($smsById)){echo $smsById[0]['smsId'];} ?>">
										<div class="form-group">
											<label class="col-sm-2 control-label">Create SMS</label>
											<div class="col-sm-10">
												<select class="form-control m-b ff" name="sendVia" id="sendVia" required onchange="sendMode()">
													<option value="" readonly>Select</option>
													<option value="text" <?php if(!empty($smsById[0]['sendVia'])){if($smsById[0]['sendVia'] == 'text'){echo "selected ='selected'";}}?>>Text</option>
													<option value="template" <?php if(!empty($smsById[0]['sendVia'])){if($smsById[0]['sendVia'] == 'template'){echo "selected ='selected'";}}?>>Template</option>
												</select>
											</div>
										</div>
										<div id="sendMode">
											<!-- Data come from JS -->
										</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group">
											  <label class="col-sm-2 control-label">Select SMS Recipients</label>
											  <div class="radio-inline">
															  <label><input type="radio" onclick="getImportFormat()" name="optradio" >Upload From Excel File</label>
															</div>
															<div class="radio-inline">
															  <label><input type="radio" onclick="getFormFormat()" name="optradio">Select From Filter Setting</label>
															</div>	
											</div>
                                        
                                         <div id="importSmsFile" style="display: none;">
											<div class="col-md-2"  >
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:35px;margin-top: 18px;">
											   <input type="file" name="importExcel" id="importExcel"  style="padding: 5px;">
											   </label>
											 	</div>  
											   <button class="btn btn-primary btn-lg" type="submit" style="padding: 4px 10px;margin-top: 18px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/sms_excel_format" class="btn btn-primary" style="margin-left: 5px; margin-top: 18px;">Download Format</a>
                                         </div>

                                          <div id="formSms" style="display: none;">
                                          	      <div class="form-group">
											<label class="col-sm-2 control-label">State</label>
											<div class="col-sm-10">
												<select data-placeholder="Choose State"  onchange="getDistrict()" class="chosen-select"  style="width: 350px;" id="state" name="state" >
													<option value="">Choose State</option>
													<?php foreach($stateList as $data){?>
													<option value="<?php echo $data['stateId']?>"><?php echo $data['stateName'];?></option>	
													<?php }?>
												</select>
											</div>
										
										</div>
										<div class="form-group">
										    <label class="col-sm-2 control-label">District</label>
											<div class="col-sm-10">
												<select name="district[]" data-placeholder="Choose District" multiple class="chosen-select" id="district">

												</select>
											</div>
										
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">To</label>
											<div class="col-sm-10">
												<select class="form-control m-b ff" name="to" id="to"  onclick="getUsersList();">
													<option value="" readonly>Select</option>
												<!-- <option value="verified" <?php if(!empty($smsById[0]['to'])){if($smsById[0]['to'] == 'verified'){echo "selected ='selected'";}}?>>Backend Verified</option> -->
													<!-- <option value="agreed" <?php if(!empty($smsById[0]['to'])){if($smsById[0]['to'] == 'agreed'){echo "selected ='selected'";}}?>>SMS Agreed</option> 
												 	<option value="webUser">Only Backend</option>
													<option value="webSmsUser">Backend registered who are also SMS consented</option> --> 
													<option value="smsUser">Only SMS registered </option>
													<option value="smsWebUser">SMS consented who are also Backend registered</option>
													<option value="common">Both Backend + SMS registered</option>
												</select>
											</div>
                                          </div>

                                          <div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">User</label>
											<div class="col-sm-10">
												<select data-placeholder="Choose User" class="chosen-select" multiple style="width:350px;" tabindex="4" id="user" name="user[]" >
													<!--Data come from js-->
												</select>
											</div>
										</div>

										<input type="hidden" name="dataTable[]" id="dataTable">
										
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<a href="<?php echo base_url(); ?>index.php/home/smsModule" class="btn btn-white">Cancel</a>
												<button class="btn btn-primary" type="submit">Send SMS</button>
											</div>
										</div>
                                          </div>

									</form>	
									<!--<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addSMS/<?php if(!empty($smsById)){echo $smsById[0]['smsId'];} ?>">
										

                                         <div class="form-group">
											<label class="col-sm-2 control-label">State</label>
											<div class="col-sm-10">
												<select data-placeholder="Choose State"  onchange="getDistrict()" class="chosen-select"  style="width: 350px;" id="state" name="state" >
													<option value="">Choose State</option>
													<?php foreach($stateList as $data){?>
													<option value="<?php echo $data['stateId']?>"><?php echo $data['stateName'];?></option>	
													<?php }?>
												</select>
											</div>
										
										</div>
										<div class="form-group">
										    <label class="col-sm-2 control-label">District</label>
											<div class="col-sm-10">
												<select name="district[]" data-placeholder="Choose District" multiple class="chosen-select" id="district">

												</select>
											</div>
										
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">To</label>
											<div class="col-sm-10">
												<select class="form-control m-b ff" name="to" id="to" required onclick="getUsersList();">
													<option value="" readonly>Select</option>
												<option value="verified" <?php if(!empty($smsById[0]['to'])){if($smsById[0]['to'] == 'verified'){echo "selected ='selected'";}}?>>Backend Verified</option>
													<option value="agreed" <?php if(!empty($smsById[0]['to'])){if($smsById[0]['to'] == 'agreed'){echo "selected ='selected'";}}?>>SMS Agreed</option> 
												 	<option value="webUser">Only Backend</option>
													<option value="webSmsUser">Backend registered who are also SMS consented</option> 
													<option value="smsUser">Only SMS registered </option>
													<option value="smsWebUser">SMS consented who are also Backend registered</option>
													<option value="common">Both Backend + SMS registered</option>
												</select>
											</div>
                                          </div>

										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">User</label>
											<div class="col-sm-10">
												<select data-placeholder="Choose User" class="chosen-select" multiple style="width:350px;" tabindex="4" id="user" name="user[]" required>
													Data come from js
												</select>
											</div>
										</div>
										
										<div class="hr-line-dashed"></div>
										
										 <div class="hr-line-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Date & Time</label>
											<div class="col-sm-5">
												<div class="input-group date">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="text" class="form-control" name="date" value="<?php if(!empty($smsById)){echo $smsById[0]['date'];} ?>">
												</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group clockpicker" data-autoclose="true">
													<input type="text" class="form-control" name="time" value="<?php if(!empty($smsById)){echo $smsById[0]['time'];} ?>">
													<span class="input-group-addon">
														<span class="fa fa-clock-o"></span>
													</span>
												</div>
											</div>
										</div> 
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<a href="<?php echo base_url(); ?>index.php/home/smsModule" class="btn btn-white">Cancel</a>
												<button class="btn btn-primary" type="submit">Send SMS</button>
											</div>
										</div>
									</form>-->
								</div>
							</div>
						</div>
                    </div>
                </div>
			</div>
        </div>
	</div>
</div>

<div class="modal fade" id="smsReport" tabindex="-1" role="dialog"  aria-hidden="true" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">SMS Report</h4>
			</div>
			<div class="modal-body">
			<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>SMS Way</th>
													<th>Text</th>
								                     <th>To</th>
								                     <th>User</th>
													
												</tr>
												<tbody>
													<tr>
														<td id='smsWay'></td>
														<td id="smsMsg"></td>
														<td id="smsGrp"></td>
														<td></td>
													</tr>
												</tbody>
											</thead>
							</table>


			</div>								
		</div>
		</div>
	</div>
</div>
<?php if(!empty($smsById)){ ?>
	<script>
		window.onload = function() {
		  // alert('aaa');
		   getUsersList();
		   sendMode();
		};
	</script>
<?php } ?>
<script>
function getUsersList(){
	var pausecontent = new Array();
	<?php $users = explode(',',$smsById[0]['users']);
		foreach($users as $key => $val){ ?>
		pausecontent.push('<?php echo $val; ?>');
	<?php } ?>
	//console.log(pausecontent);
	var to = $('#to').val();
	var state = $('#state').val();

	var district = $('#district').val();
	//alert(pausecontent[0]);

	if(to != '')
    {		
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>index.php/home/getUsersList",
		data: {to:to,state:state,district:district},
		success: function(data) {
	
			var rslt = $.trim(data);
			result = JSON.parse(rslt);
			var len = result.length;
			console.log(result);
			//alert("Image Approved");
			if(pausecontent[0] == 'All'){
				htm = '<option value="All" selected>All Users</option>';
			}else{
				htm = '<option value="All">All Users</option>';
			}
			for(var i = 0; i < len; i++){
				var idx = $.inArray(result[i].userId,pausecontent);
				//alert(idx);
				if (idx == -1) {
           
                   /* if(to == 'webUser')
                    {*/
                    	htm += '<option value="'+result[i].userId+'">'+result[i].userName+'</option>';

                    	$('#dataTable').val(result[i].dataTable);
                   /* }
                    else if(to == 'agreed')  
                    {
                    	htm += '<option value="'+result[i].userId+'" >'+result[i].userName+'</option>';
                    	
                    }*/  
					
				} else {
					htm += '<option value="'+result[i].userId+'" selected>'+result[i].userName+'</option>';
				}
			}
			//alert(htm);
			$('#user').html('');
			$('#user').html(htm);
			$('#user').trigger("chosen:updated");
		}
	}); }
}
function sendMode(){
	//alert('ss');
	var id = $('#sendVia').val();
	//alert(id);
	$('#sendMode').html('');
	if(id == 'text'){
		$('#sendMode').html('<div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Text</label><div class="col-sm-10"><textarea type="text" class="form-control" name="smsText"><?php echo $smsById[0]['smsText']; ?></textarea></div></div>');
	}else{
		$('#sendMode').html('<div class="hr-line-dashed"></div><div class="form-group"><label class="col-sm-2 control-label">Choose Template</label><div class="col-sm-10"><select class="form-control m-b ff" name="smsText" required><option value="" readonly>Choose Template</option><?php foreach($smsTemplate as $val) { ?><option value="<?php echo $val['smsContent']; ?>" <?php if($smsById[0]['smsText'] == $val['smsContent']) { echo "selected"; }?>><?php echo $val['templateName']; ?></option><?php } ?></select></div></div>');
	}
}

function sendMode1(){
	//alert('ss');
	var id = $('#sendVia1').val();
	//alert(id);
	$('#sendMode1').html('');
	if(id == 'text'){
		$('#sendMode1').html('<div class="col-md-4"><span>Text</span><textarea style="height:35px;" type="text" class="form-control" name="smsText1"></textarea></div>');
	}else{
		$('#sendMode1').html('<div class="col-md-4"><select  style="margin-top:18px;" class="form-control m-b ff" name="smsText1" required><option value="" readonly>Choose Template</option><?php foreach($smsTemplate as $val) { ?><option value="<?php echo $val['smsContent']; ?>" ><?php echo $val['templateName']; ?></option><?php } ?></select></div>');
	}
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

									
									$("#districtId").html(htm);
									
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


								    $('#district').html(''); 
									$("#district").html(htm);
									$('#district').trigger("chosen:updated");
								
							} 
						}
					});

		}


function getImportFormat()
{
	$('#importSmsFile').css('display','flex');

	$('#formSms').css('display','none');

	$('#smsModuleForm').attr('action','<?php echo base_url(); ?>index.php/home/uploadExcelSms');
}

function getFormFormat()
{
		$('#importSmsFile').css('display','none');
	$('#formSms').css('display','block');
	$('#to').prop('required',true);
	$('#user').prop('required',true);
	$('#importExcel').prop('required',false);
		$('#smsModuleForm').attr('action','<?php echo base_url(); ?>index.php/home/addSMS');

}

function smsReport(smsId)
{
	  $.ajax({
				type: "POST",
						url: "<?php echo base_url()?>index.php/home/smsReport",
						data: {smsId:smsId},
						success: function(data) {
						
							var rslt = $.trim(data);
							result = JSON.parse(rslt);
							var len = result.length;

							if(result[0].smsPath = 'formFill')
							{
								$('#smsWay').html(result[0].smsPath);
								$('#smsMsg').html(result[0].smsText);
								$('#smsGrp').html(result[0].to);
                               $('#smsReport').modal();
							}	
						}
					});
}		
</script>
		
		
		
