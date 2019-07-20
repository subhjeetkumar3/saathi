<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>STR Report</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>STR Report</strong>
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
                                 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>STR Report</a></li>
								 
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					
						 
						 <div id="tab-1" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>STR Report Filter</h5>
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
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/getStrReport ">
                          	<div class="form-group">
                        			<div class="col-sm-6">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="" readonly placeholder='Select "Date of Finger Prick Screening" daterange' required>
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


							
							   <div class="ibox-content">
                             <div class="table-responsive">
                             				




                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
												<!-- <th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th> -->
												   <th style="text-align: center;" rowspan="2">State</th>
                                                    <th style="text-align: center;" rowspan="2">District</th>
	                                                 <th style="text-align: center;" rowspan="2">Date of Finger Prick Screening</th>
	                                                	<th style="text-align: center;" colspan="15">Screened for HIV through WBFPS</th>

	                                                	<th style="text-align: center;" colspan="15">STR Reactive through WBFPS</th>

	                                                	<th style="text-align: center;" colspan="15">STR clients underwent confirmatory tests</th>

	                                                	<th style="text-align: center;" colspan="15">STR found HIV + through confirmatory tests </th>

	                                                	<th style="text-align: center;" colspan="15">Confirmed HIV+ clients linked to ART </th>



	                                             </tr>


	                                             <tr>
													
													
															<th>ARG(Driver)</th>
															<th>ARG(Migrants)</th>
															<th>ARG(Students)</th>
															<th>ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)</th>
															<th>ARG (Others i.e. salesman, vendor, salaried employ, etc.)</th>
															<th>ARG (Partner/ Spouse of HRG)</th>
															<th>ARG (Partner/ Spouse of ARG)</th>
															<th>ARG (TG (F-M))</th>
															<th>Total Screening (ARG)</th>
															<th>HRG (MSM)</th>
															<th>HRG (TG)</th>
															<th>HRG (FSW)</th>
															<th>(HRG) (IDU)</th>
															<th>Total Screening (HRG)</th>
															<th>Total clients screened (ARG+HRG)</th>
													
												
													
												
													
													
															<th>ARG(Driver)</th>
															<th>ARG(Migrants)</th>
															<th>ARG(Students)</th>
															<th>ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)</th>
															<th>ARG (Others i.e. salesman, vendor, salaried employ, etc.)</th>
															<th>ARG (Partner/ Spouse of HRG)</th>
															<th>ARG (Partner/ Spouse of ARG)</th>
															<th>ARG (TG (F-M))</th>
															<th>Total Screening (ARG)</th>
															<th>HRG (MSM)</th>
															<th>HRG (TG)</th>
															<th>HRG (FSW)</th>
															<th>(HRG) (IDU)</th>
															<th>Total Screening (HRG)</th>
															<th>Total clients screened (ARG+HRG)</th>
													
												
													
												
													
													
															<th>ARG(Driver)</th>
															<th>ARG(Migrants)</th>
															<th>ARG(Students)</th>
															<th>ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)</th>
															<th>ARG (Others i.e. salesman, vendor, salaried employ, etc.)</th>
															<th>ARG (Partner/ Spouse of HRG)</th>
															<th>ARG (Partner/ Spouse of ARG)</th>
															<th>ARG (TG (F-M))</th>
															<th>Total Screening (ARG)</th>
															<th>HRG (MSM)</th>
															<th>HRG (TG)</th>
															<th>HRG (FSW)</th>
															<th>(HRG) (IDU)</th>
															<th>Total Screening (HRG)</th>
															<th>Total clients screened (ARG+HRG)</th>
													
												
													
												
													
													
															<th>ARG(Driver)</th>
															<th>ARG(Migrants)</th>
															<th>ARG(Students)</th>
															<th>ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)</th>
															<th>ARG (Others i.e. salesman, vendor, salaried employ, etc.)</th>
															<th>ARG (Partner/ Spouse of HRG)</th>
															<th>ARG (Partner/ Spouse of ARG)</th>
															<th>ARG (TG (F-M))</th>
															<th>Total Screening (ARG)</th>
															<th>HRG (MSM)</th>
															<th>HRG (TG)</th>
															<th>HRG (FSW)</th>
															<th>(HRG) (IDU)</th>
															<th>Total Screening (HRG)</th>
															<th>Total clients screened (ARG+HRG)</th>
													
												
													
												
													
													
															<th>ARG(Driver)</th>
															<th>ARG(Migrants)</th>
															<th>ARG(Students)</th>
															<th>ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)</th>
															<th>ARG (Others i.e. salesman, vendor, salaried employ, etc.)</th>
															<th>ARG (Partner/ Spouse of HRG)</th>
															<th>ARG (Partner/ Spouse of ARG)</th>
															<th>ARG (TG (F-M))</th>
															<th>Total Screening (ARG)</th>
															<th>HRG (MSM)</th>
															<th>HRG (TG)</th>
															<th>HRG (FSW)</th>
															<th>(HRG) (IDU)</th>
															<th>Total Screening (HRG)</th>
															<th>Total clients screened (ARG+HRG)</th>
													
												
													
												</tr>






												</thead>
												<tbody>
												<?php if(!empty($strreport)){?>	
												<?php foreach($strreport as $value) { ?>
                                             			<tr>
                                             				<td><?php echo $value['stateName']; ?></td>
                                             				<td><?php echo $value['districtName']; ?></td>
                                             				<td><?php echo $value['fingerDate']; ?></td>
                                             				<td><?php echo $value['arg1']; ?></td>
                                             				<td><?php echo $value['arg2']; ?></td>
                                             				<td><?php echo $value['arg3']; ?></td>
                                             				
                                             				<td><?php echo $value['arg4']; ?></td>
                                             				<td><?php echo $value['arg5']; ?></td>
                                             				<td><?php echo $value['arg6']; ?></td>
                                             				<td><?php echo $value['arg7']; ?></td>
                                             				<td><?php echo $value['arg8']; ?></td>
                                             				<td><?php echo $value['AtotalScreeningArg']; ?></td>
                                             				<td><?php echo $value['arg9']; ?></td>
                                             				<td><?php echo $value['arg10']; ?></td>
                                             				<td><?php echo $value['arg11']; ?></td>
                                             				<td><?php echo $value['arg12']; ?></td>
                                             				<td><?php echo $value['AtotalScreeningHrg']; ?></td>
                                             				<td><?php echo $value['ASum']; ?></td>
                                             				<td><?php echo $value['arg13']; ?></td>
                                             				<td><?php echo $value['arg14']; ?></td>
                                             				<td><?php echo $value['arg15']; ?></td>
                                             				<td><?php echo $value['arg16']; ?></td>
                                             				<td><?php echo $value['arg17']; ?></td>
                                             				<td><?php echo $value['arg18']; ?></td>
                                             				<td><?php echo $value['arg19']; ?></td>
                                             				<td><?php echo $value['arg20']; ?></td>
                                             				<td><?php echo $value['BtotalScreeningArg']; ?></td>
                                             				<td><?php echo $value['arg21']; ?></td>
                                             				<td><?php echo $value['arg22']; ?></td>
                                             				<td><?php echo $value['arg23']; ?></td>
                                             				<td><?php echo $value['arg24']; ?></td>
                                             				<td><?php echo $value['BtotalScreeningHrg']; ?></td>
                                             				<td><?php echo $value['BSum']; ?></td>
                                             				<td><?php echo $value['arg25']; ?></td>
                                             				<td><?php echo $value['arg26']; ?></td>
                                             				<td><?php echo $value['arg27']; ?></td>
                                             				<td><?php echo $value['arg28']; ?></td>
                                             				<td><?php echo $value['arg29']; ?></td>
                                             				<td><?php echo $value['arg30']; ?></td>
                                             				<td><?php echo $value['arg31']; ?></td>
                                             				<td><?php echo $value['arg32']; ?></td>
                                             				<td><?php echo $value['CtotalScreeningArg']; ?></td>
                                             				<td><?php echo $value['arg33']; ?></td>
                                             				<td><?php echo $value['arg34']; ?></td>
                                             				<td><?php echo $value['arg35']; ?></td>
                                             				<td><?php echo $value['arg36']; ?></td>
                                             				<td><?php echo $value['CtotalScreeningHrg']; ?></td>
                                             				<td><?php echo $value['CSum']; ?></td>
                                             				<td><?php echo $value['arg37']; ?></td>
                                             				<td><?php echo $value['arg38']; ?></td><td><?php $value['arg39']; ?></td>
                                             				<td><?php echo $value['arg40']; ?></td>
                                             				<td><?php echo $value['arg41']; ?></td>
                                             				<td><?php echo $value['arg42']; ?></td>
                                             				<td><?php echo $value['arg43']; ?></td>
                                             				<td><?php echo $value['arg44']; ?></td>
                                             				<td><?php echo $value['DtotalScreeningArg']; ?></td>
                                             				<td><?php echo $value['arg45']; ?></td>
                                             				<td><?php echo $value['arg46']; ?></td>
                                             				<td><?php echo $value['arg47']; ?></td>
                                             				<td><?php echo $value['arg48']; ?></td>
                                             				<td><?php echo $value['DtotalScreeningHrg']; ?></td>
                                             				<td><?php echo $value['DSum']; ?></td>
                                             				<td><?php echo $value['arg49']; ?></td>
                                             				<td><?php echo $value['arg50']; ?></td>
                                             				<td><?php echo $value['arg51']; ?></td>
                                             				<td><?php echo $value['arg52']; ?></td>
                                             				<td><?php echo $value['arg53']; ?></td>
                                             				<td><?php echo $value['arg54']; ?></td>
                                             				<td><?php echo $value['arg55']; ?></td>
                                             				<td><?php echo $value['arg56']; ?></td>
                                             				<td><?php echo $value['EtotalScreenigArg']; ?></td>
                                             				<td><?php echo $value['arg57']; ?></td>
                                             				<td><?php echo $value['arg58']; ?></td>
                                             				<td><?php echo $value['arg59']; ?></td>
                                             				<td><?php echo $value['arg60']; ?></td>
                                             				<td><?php echo $value['EtotalScreenigHrg']; ?></td>
                                             				<td><?php echo $value['ESum']; ?></td>
                                             			</tr>
										
												<?php } ?>
											<?php }?>
                                               </tbody>
                                            </table>
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
		
		
		
