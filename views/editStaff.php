<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Staff Member</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Staff Member</strong>
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
                              
								 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Update Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
				
						 
						 <div id="tab-1" class="tab-pane active">
						   <div class="ibox-title">
                            <h5>Important Link Entry</h5>
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
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateStaff">
                          	<input type="hidden" name="staffId" value="<?php echo $staffId;?>">
							   <div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">User Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" onblur="checkEmpUnameN()" readonly="" name="uname" value="<?php echo $staffData[0]['userName']?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Role</label>
										<div class="col-sm-10">
											<select name="role" class="form-control"  required="">
												<option>-Select Role-</option>
												<?php $rolestaff = explode(',',$staffData[0]['roleId']); ?>
												<?php foreach($roles as $data){?>
												<option value="<?php echo $data['userTypeId']?>" <?php if(in_array($data['userTypeId'],$rolestaff)){echo 'selected';}?>><?php echo $data['userType']?></option>	
												<?php }?>	
											</select>
										</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Full Name</label>
										<div class="col-sm-10">
												<input type="text" class="form-control" name="name" value="<?php echo $staffData[0]['name']?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Mobile Number</label>
										<div class="col-sm-10">
												<input type="text" class="form-control" name="mobile" value="<?php echo $staffData[0]['mobileNo']?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Email Address</label>
										<div class="col-sm-10">
												<input type="text" class="form-control" name="email" value="<?php echo $staffData[0]['emailAddress']?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
												<input type="password" class="form-control" name="password" value="<?php echo $staffData[0]['password']?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Assigned with</label>
										<div class="col-sm-10">
												<input type="radio" <?php if($staffData[0]['userType'] == 'partner'){ echo 'checked';} ?>  onclick="assignedWithRole()" required="" name="userTypeNew"  value="partner" id="partnerRadio" >Partner
												<input type="radio" <?php if($staffData[0]['userType'] == 'serviceProvider'){ echo 'checked';} ?>  onclick="assignedWithRole()" required="" name="userTypeNew" value="serviceProvider" id="serviceProviderRadio" >Service Provider
												<input type="radio" <?php if($staffData[0]['userType'] == 'employee'){ echo 'checked';} ?> onclick="assignedWithRole()" id="noneRadio" required="" name="userTypeNew" value="">None of them
										</div>
									</div>
									<div class="col-sm-6">
										
										<div class="col-sm-10">

											<select name="assignedWith" style="display: none;"  id="assignedWith" class="form-control">
											<?php if($staffData[0]['userType'] == 'partner') { ?>	
												<option>-Select Onground Partner-</option>
												<?php foreach ($ongroundPartnerList as $key => $value) { ?>
													<option value="<?php echo $value['ongroundPartnerId']?>" <?php if($staffData[0]['assignedId'] ==  $value['ongroundPartnerId']){echo 'selected';}?>><?php echo $value['name']?></option>
											 <?php	} ?>
											<?php  } ?>

											<?php if($staffData[0]['userType'] == 'serviceProvider') { ?>	
												<option>-Select Service Provider -</option>
												<?php foreach ($serviceProviderList as $key => $value1) { ?>
													<option <?php if($staffData[0]['assignedId'] ==  $value['serviceProviderId']){echo 'selected';}?> value="<?php echo $value['serviceProviderId']?>"><?php echo $value1['name']?></option>
											 <?php	} ?>
											<?php  } ?>
											</select>

											

										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/staff" class="btn btn-white">Cancel</a>
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
      
               window.onload = function() {
               	showAssignedWith();
               }

               function showAssignedWith()
               {
               	  var assignedWith = '<?php echo $staffData[0]['userType'] ?>';

               	  if(assignedWith == 'partner' || assignedWith == 'serviceProvider')
               	  {
               	  	$('#assignedId').prop('required',true);
               	  	$('#assignedWith').css('display','block');
               	  }else{
               	  	$('#assignedId').prop('required',false);
               	  	$('#assignedWith').css('display','none');
               	  }	
               }

       

			     var checkEmpUname = 1;
        	function checkEmpUnameN()
        	{
        	
        		 var userName = $('.uname').val();

             $.ajax({
                type: "POST",
    	        url: "<?php echo base_url()?>index.php/home/checkUserExist",
    	        data: {userName:userName},
    	        success:function(data){
                  var rslt = $.trim(data)
    		      var result = JSON.parse(rslt);
    		      var len =  result.length;

    		   
    		      if(len != 0)
    		      {
    		        checkEmpUname = 1;
                    $('#spanUser').css('display','block');
                    $('#submit').attr('type','button');
    		      }
    		      else{
    		        checkEmpUname = 0;
    		      	$('#spanUser').css('display','none');
    		      	$('#submit').attr('type','submit');
    		      }	
    	        }
             });

        	}

          function assignedWithRole()
        {
        	var htm = ' ';

        	if($('#partnerRadio').is(':checked'))
        	{	
	             $.ajax({
	                type: "GET",
	    	        url: "<?php echo base_url()?>index.php/home/getPartnerList",
	    	        success:function(data){
	                  var rslt = $.trim(data)
	    		      var result = JSON.parse(rslt);
	    		      var len =  result.length;

	    		      htm += '<option>-Select Onground Partner-</option>';
                      
                      for (var i = 0; i < len; i++) {
                      	htm += '<option value="'+result[i].ongroundPartnerId+'">'+result[i].name+'</option>' ;
                      }

                      $('#assignedWith').html(' ');

                      $('#assignedWith').html(htm);

                      $('#assignedWith').css('display','block');

                      $('#assignedWith').prop('required',true);
	    		     
	    	        }
	             });
        	}
        	else if($('#serviceProviderRadio').is(':checked'))
        	{
        		  $.ajax({
	                type: "GET",
	    	        url: "<?php echo base_url()?>index.php/home/getProviderList",
	    	        success:function(data){
	                  var rslt = $.trim(data)
	    		      var result = JSON.parse(rslt);
	    		      var len =  result.length;


	    		      htm += '<option>-Select Service Provider-</option>';

	    		    	for (var i = 0; i < len; i++) {
                      	htm += '<option value="'+result[i].serviceProviderId+'">'+result[i].name+'</option>' ;
                      }

                      $('#assignedWith').html(' ');

                      $('#assignedWith').html(htm);

                         $('#assignedWith').css('display','block');

                           $('#assignedWith').prop('required',true);
	    		     
	    	        }
	             });
        	}else{
                
                 $('#assignedWith').prop('required',false);

                 $('#assignedWith').css('display','none');
        	}
        }	

		</script>
		
		
