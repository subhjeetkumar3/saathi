<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Positive Line</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Positive Line</strong>
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
                                 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Positive Line</a></li>
								 
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					
						 
						 <div id="tab-1" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Positive Line List</h5>
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
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/getPositiveReport ">
                          	<div class="form-group">
                        			<div class="col-sm-6">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="" readonly placeholder='Select "Date of HIV Confirmation Test" daterange' required>
											</div>
											</div>

											<div class="col-sm-3">
											
												<select onchange="getDistrictPositive()" name="state" required data-placeholder="choose state"  class="form-control" id="statePositive">
													<option value="">-Select state-</option>
                                                 <?php foreach($stateList as $list ){?>
                                                 	<option value="<?php echo $list['stateId']?>"><?php echo $list['stateName'];?></option>
                                                 <?php }?>	
												</select>

											</div>
											<div class="col-sm-3"  id="districtStockDiv">
												
												<select data-placeholder="" id="districtPositive" required  name="district"  class="chosen-select"></select>
											</div>
											
										</div>	
							 
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/positiveLine" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
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
        <script type="text/javascript">
        	function getDistrictPositive() {
        		var stateId = $('#statePositive').val();
    		
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

									
									  $('#districtPositive').html(''); 
									$("#districtPositive").html(htm);
									$('#districtPositive').trigger("chosen:updated");
									
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
								
									  $('#districtPositive').html(''); 
									$("#districtPositive").html(htm);
									$('#districtPositive').trigger("chosen:updated");
								
							} 
						}
					});
        	}
        </script>
		
		
		
