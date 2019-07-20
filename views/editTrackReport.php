<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Update Violence Report</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Update Violence Report</strong>
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
                                 <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i> Update Violence Report </a></li>
								
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Update Violence Report</h5>
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
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateTrackReport">
                              <?php print_r($reportData[0]['report_unique_id']);  ?>
                                <input type="hidden" name="reportId" value="<?php echo $reportId ?>">
                                <div class="form-group">
                                  <div class="col-sm-6">
                                    <label class="control-label">Incidence ID</label>
                                    <input type="text" class="form-control" readonly="" value="<?php echo($reportData[0]['report_unique_id']);  ?>">
                                  </div>
                                  <div class="col-sm-6">
                                    <label class="control-label">Support Required</label>
                                      <input type="text" class="form-control" readonly="" value="<?php echo($reportData[0]['support_required']);  ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-6">
                                    <label class="control-label">First Name</label>
                                      <input type="text" class="form-control" readonly="" value="<?php echo($reportData[0]['firstName']);  ?>">
                                  </div>
                                   <div class="col-sm-6">
                                    <label class="control-label">last Name</label>
                                      <input type="text" class="form-control" readonly="" value="<?php echo($reportData[0]['lastName']);  ?>">
                                  </div>
                                </div>

                                   <div class="form-group">
                                  <div class="col-sm-6">
                                     <label class="control-label">Date of Incidence</label>
                                     <div class="input-group date"> 
                                           <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>  
                                        <input autocomplete="off" type="text" disabled value="<?php if($reportData[0]['date_of_incidence'])
                                       echo  date('d-m-Y',strtotime($reportData[0]['date_of_incidence']))  ;  ?>" class="form-control">
                                        </div>
                                  </div>

                                  <div class="col-sm-6">
                                     <label class="control-label">Date of Incidence Reporting </label>
                                     <div class="input-group date"> 
                                           <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>  
                                        <input autocomplete="off" type="text" disabled value="<?php if($reportData[0]['date_of_incidence_reported'])
                                       echo  date('d-m-Y',strtotime($reportData[0]['date_of_incidence_reported']))  ;  ?>" class="form-control">
                                        </div>
                                  </div>
                                  
                                </div>


                              <div class="hr-line-dashed"></div>    
                          	<div class="form-group">
                        			<div class="col-sm-6">
                                        <label class="control-label">Incidence addressed by whom(Internal)</label> 
                                      
                        			<!-- 	<input type="text" name="incidenceAddressInternal" class="form-control"> -->

                                    <select class="form-control" name="incidenceAddressInternal">
                                        <option value="">-Select-</option>
                                      <!--   <option> One to choose from Crisis Support Peer</option> -->
                                      <option>Crisis Support Peer</option>
                                        <option> Training and Advocacy Coordinator</option>
                                        <option> State Program Manager</option>
                                    </select>
                                  
                        			</div>
                                    <div class="col-sm-6">
                                      <label class="control-label">Incidence addressed by whom(External)</label> 
                                        
                                        <!-- <input type="text" name="incidenceAddressExternal" class="form-control"> -->

                                        <select onchange="checkAddressExternal()" class="form-control" id="incidenceAddressExternal" name="incidenceAddressExternal">
                                       <option value="">-Select-</option>
                                       <!-- <option>Another to chosse from Law </option> -->
                                      <option>Law</option> 
                                     <option>Police</option>
                                     <option>CBOs </option>
                                     <option>Boards </option>
                                     <option>Commission </option>
                                      <option>Others </option>

                                    </select> 
                                    
                                    </div>
                                    </div>

                                    <div class="form-group">
                                	  <div class="col-sm-6" id="addressExternalOtherDiv" style="display: none;">
                                  	<label class="control-label">Incidence addressed by whom(External) Other</label>
                                  	 <input type="text" class="form-control" id="addressExternalOther" name="addressExternalOther">
                                  </div>
                                    </div>

                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="control-label"> Date of incidence addressed</label> 
                                        <div class="input-group date"> 
                                           <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>  
                                        <input autocomplete="off" type="text" name="dateIncidenceAddress" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="control-label">Types of services provided</label> 
                                       
                                       <!--  <input type="text" name="serviceType" class="form-control"> -->
                                   <select name="serviceType[]" id="serviceType" onchange="checkServiceType()" class="chosen-select" multiple="">
                                       <option>Counseling </option>
                                        <option>Legal Support </option>
                                        <option>Police Intervention </option>
                                        <option>Community Support </option>
                                        <option>Others</option>
                                   </select>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="col-sm-6"  id="serviceTypeOtherDiv" style="display: none;" >
                                        <label class="control-label">Types of services provided - Others</label>
                                        <input type="text" class="form-control" id="serviceTypeOther" name="serviceTypeOther">
                                      </div>
                                    
                                    </div>    

                                   <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="control-label">Method of resolving (Formal / Informal)  </label> 
                                      <!-- 
                                        <input type="text" name="methodResolve" class="form-control"> -->
                                        <select name="methodResolve" class="form-control">
                                           <option value="">-select-</option> 
                                           <option>Formal</option>
                                           <option>Informal</option>
                                        </select>
                                  
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="control-label">Status</label> 
                                     
                                      <select class="form-control" name="status">
                                          <option value="">-Select Status-</option>
                                          <option value="OPEN">Open</option>
                                          <option value="SOLVED">Solved</option>
                                          <option value="IN-PROGRESS">In-progress</option>
                                          <option value="REVOKED">Revoked</option>
                                      </select>
                                    
                                    </div>
                                    </div>        		


                                   <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="control-label">Brief description  </label> 
                                       
                                        <input type="text" name="description" class="form-control">
                                   
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="control-label">If pending. reason/s ?</label> 
                                        
                                        <input type="text" name="reason" class="form-control">
                                    
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


        function checkServiceType()
        {
          serviceType =  $('#serviceType').val();

          var idx = $.inArray('Others',serviceType);

           if(idx !== -1)
           {
             $('#serviceTypeOtherDiv').css('display','block');
             $('#serviceTypeOther').prop('required',true);
              
           }else{
            $('#serviceTypeOtherDiv').css('display','none');

             $('#serviceTypeOther').prop('required',false);
           } 
        }

      function checkAddressExternal()
      {
         var addressExternal = $('#incidenceAddressExternal').val();

         if(addressExternal == 'Others')
         {
         	 $('#addressExternalOtherDiv').css('display','block');
             $('#addressExternalOther').prop('required',true);
           
         }else{
              $('#addressExternalOtherDiv').css('display','none');
             $('#addressExternalOther').prop('required',false);
         }	
      }  
</script>		
		
