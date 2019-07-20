<style>
.none{
	display:none !important;
}

.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
    width: 200% !important;
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
		<h2>Stock Register</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>home/dashboard">Home</a>
			</li>
			<li class="active">
				<strong>Stock Register</strong>
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
                               

                               	<li class="active"><a data-toggle="tab" href="#tab-3"><i class="fa fa-user"></i>Stock Register</a></li>

								
								  
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">

						 
						 

						 <div id="tab-3" class="tab-pane active">
						 	<div class="ibox-content">

						 		  <form method="post" class="form-horizontal"  enctype="multipart/form-data" action="<?php echo base_url()?>index.php/home/downloadStock"  >
						 		  	<div class="form-group">
                        			<div class="col-sm-6">
                        				<?php if($this->session->userdata('userType') == 'admin'){?>
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="" readonly placeholder='Select "Date of Camp" daterange' required>
											</div>
										<?php }else{ ?>
											<div class="col-sm-6">
												<select id='gMonth2' required="" name="month" class="form-control" >
											    <option value=''>--Select Month--</option>
											    <option  value='1'>Janaury</option>
											    <option value='2'>February</option>
											    <option value='3'>March</option>
											    <option value='4'>April</option>
											    <option value='5'>May</option>
											    <option value='6'>June</option>
											    <option value='7'>July</option>
											    <option value='8'>August</option>
											    <option value='9'>September</option>
											    <option value='10'>October</option>
											    <option value='11'>November</option>
											    <option value='12'>December</option>
											    </select> 
											  </div>  
											  <div class="col-sm-6">
											  	<input type="text" onkeypress="return isWholeNumberKey(event,this)" required="" minlength="4" maxlength="4" placeholder="Enter Year" name="year" class="form-control">
											  </div>
											<?php }?>
											</div>

											<?php if($this->session->userdata('userType') == 'admin'){?>

											<div class="col-sm-3">
											
												<select onchange="getDistrictStock()" name="state" required data-placeholder="choose state"  class="form-control" id="stateStock">
													<option value="">-Select state-</option>
                                                 <?php foreach($stateList as $list ){?>
                                                 	<option value="<?php echo $list['stateId']?>"><?php echo $list['stateName'];?></option>
                                                 <?php }?>	
												</select>

											</div>
											<div class="col-sm-3"  id="districtStockDiv">
												
												<select data-placeholder="" id="districtStock" required  name="district"  class="chosen-select"></select>
											</div>
											<?php } else {?>
							
											<div class="col-sm-3">	
												<input type="text" readonly name="stateName" class="form-control" value="<?php echo $stateDetails[0]['stateName']; ?>">
										  </div>		
												<input type="hidden" name="state" value="<?php echo $this->session->userdata('stateId') ?>">
											<!-- 	<input type="hidden" name="district" value="<?php echo $this->session->userdata('districtId') ?>"> -->
										<div class="col-sm-3"  >	
											<select data-placeholder="choose district" id="districtStock" required  name="district"  class="chosen-select">
												<option readonly value="">-Select district-</option>
											   <?php foreach($districtList as $list ){?>
                                             	<option value="<?php echo $list['districtId']?>"><?php echo $list['districtName'];?></option>
                                             <?php }?>
											</select>
										</div>	
										<?php }?>
										</div>	
											<div class="form-group">
											
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit" id="submit" >Submit</button>
											</div>
                        		</div>
						 		  </form>
						 	</div>
						 </div>
						
						<!-- </div>
                    </div>
                </div>
				
				
				
				
				
            </div>
        </div> -->

      
   
         



  

  
        <div class="footer">
            
        </div>

        </div>
        </div>
      <script type="text/javascript">	

	function getDistrictStock()
	{
		var stateId = $('#stateStock').val();
    		
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

									
									  $('#districtStock').html(''); 
									$("#districtStock").html(htm);
									$('#districtStock').trigger("chosen:updated");
									
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
								
									  $('#districtStock').html(''); 
									$("#districtStock").html(htm);
									$('#districtStock').trigger("chosen:updated");
								
							} 
						}
					});

	}


      </script>  
		
		
		
