<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Track Report History</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Track Report</strong>
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
                                 <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i> Report History</a></li>
								
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Report  History</h5>
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
                                                    <th style="display: none;">S.no</th>
                                                     <td>Date of report received </td>
                                                     <td>Incidence addressed by whom – (Internal)</td>
                                                     <td>Incidence addressed by whom (External)</td>
                                                      <td>Incidence addressed by whom (External) History</td>
                                                     <td>Date of incidence addressed</td>
                                                     <td>Types of services provided </td>
                                                     <td>Types of services provided Other</td>
                                                     <td>Method of resolving (Formal / Informal) </td>
                                                     <td>Status </td>
                                                     <td>Brief description </td>
                                                     <td>If pending , reason/s? </td>
                                                   
                                                   
                                                    <th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>     
                                                <?php $k = 1; foreach($reportHistory as $value) { ?>
                                                <tr id="row<?php echo $value['id']; ?>">
                                                    <td style="display: none;" ><?php echo $k; ?></td>
                                                    <td><?php echo date('d-m-Y H:i:s',strtotime($value['createdDate'])) ; ?></td>
                                                    <td><?php echo $value['incidence_addressed_internal'] ?></td>
                                                    <td><?php echo $value['incidence_addressed_external'] ?></td>
                                                     <td><?php echo $value['incidence_addressed_external_other'] ?></td>
                                                    <td><?php echo $value['date_of_incidence_addressed'] ?></td>
                                                    <td><?php echo $value['type_of_services'] ?></td>
                                                    <td><?php echo $value['type_of_services_other'] ?></td>
                                                    <td><?php echo $value['method_of_resolving'] ?></td>
                                                    <td><?php if($value['status']) echo $value['status']; else echo "OPEN"; ?></td>
                                                    <td><?php echo $value['description']?></td>
                                                    <td><?php echo $value['reason'] ?></td>
                                                   
                                                    <td class="text-right footable-visible footable-last-column">
                                                   <?php $otherAccess = $this->session->userdata('otherAccess');
                                                    if($this->session->userdata('userType') == 'admin' || in_array('campReport',$otherAccess)) {?>     
                                                    <span class="btn-white btn btn-xs"
                                                    onclick="deletedTransData(<?php echo $value['id']; ?>,'id','report_audit')">
                                                    Delete</span>
                                                <?php }?>
                                                   <!--  <a href="<?php echo base_url(); ?>index.php/home/editTrackReport/<?php echo $value['id']; ?>"><span class="btn-white btn btn-xs">
                                                    Edit</span></a> -->
                                                    
                                                    </td>
                                                </tr>
                                                <?php $k++; } ?>
                                                
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
		
