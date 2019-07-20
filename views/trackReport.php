<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Violence Report</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Violence Report</strong>
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
                                 <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i> Violence Report List</a></li>
								
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Violence Report  List</h5>
                            <div class="ibox-tools">
                               <!--  <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a> -->

                                    <form method="POST" action="<?php echo base_url()?>index.php/home/downloadFileReport">
                                   <input type="hidden" name="reportIdExcel" value="<?php echo $reportId ?>" >
                                     <input type="hidden" name="stateExcel" value="<?php echo $state ?>">
                                      <input type="hidden" name="districtExcel" value="<?php echo $district ?>">
                                       <input type="hidden" name="mobileExcel" value="<?php echo $mobile ?>">
                                        <input type="hidden" name="datesExcel" value="<?php echo $daterange ?>">
                                    <button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> Violence Reports</button>
                                   </form> 
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/getTrackReport">
                          	<div class="form-group">
                        			<div class="col-sm-3">
                        				<select class="chosen-select" name="reportId" data-placeholder="Select Report Id" >
                        					<option value="">-Select Report Id-</option>
                        					  <?php foreach($reportList as $val ){?>
                                                 	<option value="<?php echo $val['report_unique_id']?>"><?php echo $val['report_unique_id'];?></option>
                                                 <?php }?>
                        				</select>
                        			</div>
                                    <div class="col-sm-3">
                                      <input type="text" placeholder="Mobile Number" name="mobile" class="form-control">  
                                    </div>
                                             <?php $otherAccess = $this->session->userdata('otherAccess'); ?>
											
											 <?php if($this->session->userdata('userType') == 'admin' ||  in_array('violenceReport',$otherAccess)){?>
                                              <div class="col-sm-3">  
												<select onchange="getDistrict()" name="state"  data-placeholder="Select State"  class="form-control" id="state">
													<option value="">-Select State-</option>
                                                 <?php foreach($stateList as $list ){?>
                                                 	<option value="<?php echo $list['stateId']?>"><?php echo $list['stateName'];?></option>
                                                 <?php }?>	
												</select>

											</div>
											<div class="col-sm-3"  id="districtDiv">
												
												<select data-placeholder="Select District" id="district"   name="district"  class="chosen-select"></select>
											</div>

                                            <?php } else {?>
                                                <div class="col-sm-3">  
                                                <input type="text" readonly name="stateName" class="form-control" value="<?php echo $stateDetails[0]['stateName']; ?>">
                                          </div>        
                                                <input type="hidden" name="state" value="<?php echo $this->session->userdata('stateId') ?>">
                                               <div class="col-sm-3"  > 
                                            <select data-placeholder="choose district" id="districtStock"   name="district"  class="chosen-select">
                                                <option readonly value="">-Select district-</option>
                                               <?php foreach($districtList as $list ){?>
                                                <option value="<?php echo $list['districtId']?>"><?php echo $list['districtName'];?></option>
                                             <?php }?>
                                            </select>
                                        </div>   
											<?php }?>
										</div>	

                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <div class="input-group calender">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" autocomplete="off" class="form-control" name="daterange" value=""  placeholder='Select "Date of incidence" daterange' >
                                            </div>
                                            </div>
                                        </div>
							 
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/trackReport" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                          <?php if($getReportList) { ?>  

                            <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="display: none;">S.no</th>
                                                    <th>Report Id</th>
                                                    <th>Status</th>
                                                    <th>Name </th>
                                                    <th>Guardian</th>
                                                    <th>Age</th>
                                                    <th>Mobile</th>
                                                    <th>Address</th>
                                                    <th>Address State</th>
                                                    <th>Address District</th>
                                                    <th>Date Of Incidence</th>
                                                    <th>Incidence State</th>
                                                    <th>Incidence District</th>
                                                    <th>Date of incidence  Reported</th>
                                                    <th>Type of incidence</th>
                                                    <th>Type of incidence Other</th>
                                                    <th>By Whom</th>
                                                    <th>By Whom Other</th>
                                                    <th>Support Required</th>
                                                    <th>Support Required Other</th>
                                                    <th>Description</th>
                                                    <th>Created Date</th>
                                                    <th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>     
                                                <?php $k = 1; foreach($getReportList as $value) { ?>
                                                <tr id="row<?php echo $value['id']; ?>">
                                                    <td style="display: none;" ><?php echo $k; ?></td>
                                                    <td><?php echo $value['report_unique_id']; ?></td>
                                                    <td><?php if($value['status']) echo $value['status']; else echo "OPEN"; ?></td>
                                                    <td><?php echo $value['firstName'].' '.$value['lastName'] ?></td>
                                                    <td><?php echo $value['guardian'] ?></td>
                                                    <td><?php echo $value['age'] ?></td>
                                                    <td><?php echo $value['mobile'] ?></td>
                                                    <td><?php echo $value['address'] ?></td>
                                                    <td><?php echo $value['addressState'] ?></td>
                                                    <td><?php echo $value['addressDistrict']?></td>
                                                    <td><?php echo $value['date_of_incidence'] ?></td>
                                                    <td><?php echo $value['incidenceState'] ?></td>
                                                    <td><?php echo $value['incidenceDistrict'] ?></td>
                                                    <td><?php echo $value['date_of_incidence_reported'] ?></td>
                                                    <td><?php echo $value['type_of_incidence'] ?></td>
                                                    <td><?php echo $value['type_of_incidence_other'] ?></td>
                                                    <td><?php echo $value['by_whom'] ?></td>
                                                    <td><?php echo $value['by_whom_other'] ?></td>
                                                    <td><?php echo $value['support_required'] ?></td>
                                                    <td><?php echo $value['support_required_other'] ?></td>
                                                    <td><?php echo $value['description']; ?></td>
                                                    <td><?php echo date('d-m-Y H:i:s', strtotime($value['createdDate'])); ?></td>
                                                    <td class="text-right footable-visible footable-last-column">
                                                   <?php $otherAccess = $this->session->userdata('otherAccess');
                                                    if($this->session->userdata('userType') == 'admin' || in_array('campReport',$otherAccess)) {?>     
                                                    <span class="btn-white btn btn-xs"
                                                    onclick="deletedTransData(<?php echo $value['id']; ?>,'id','tbl_file_reports')">
                                                    Delete</span>
                                                    <a href="<?php echo base_url(); ?>index.php/home/editTrackReport/<?php echo $value['id']; ?>"><span class="btn-white btn btn-xs">
                                                    Edit</span></a>
                                                   <?php }?> 
                                                    <a href="<?php echo base_url(); ?>index.php/home/trackReportHistory/<?php echo $value['id']; ?>"><span class="btn-white btn btn-xs">
                                                    View history</span></a>
                                                    </td>
                                                </tr>
                                                <?php $k++; } ?>
                                                
                                               </tbody>
                                            </table>
                                       </div>
                                   <?php } ?>    
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
        function getDistrict(){
            var state = $('#state').val();
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/home/getDistrict",
                data: {state:state},
                success: function(data) {
                    
                    var rslt = $.trim(data);
                    result = JSON.parse(rslt);
                    var len = result.length;

                    htm = '<option value="" readonly>Select District</option>';
                    for(var i = 0; i < len; i++){
                        
                            htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
                        
                        
                    }
                    
                    //alert(htm);
                    $('#district').html('');
                    $('#district').html(htm).trigger("chosen:updated");
                    
                }
            });
            
        }
</script>		
		
