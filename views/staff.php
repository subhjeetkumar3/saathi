<style>
.none{
	display:none !important;
}

.required{
	color: red;
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
                                 <li class="<?php if(!empty($importantLinkById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Staff Member List</a></li>
								 <li class="<?php if(!empty($importantLinkById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($importantLinkById)){ echo ''; }else { echo 'active'; } ?>">
						   <div class="ibox-title">
                            <h5>Staff Member List</h5>
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
                        	<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterStaff">
                        		
                        		<div class="form-group">
                        			<div class="col-sm-3">
                        				<select class="chosen-select"  name="userBy">
                        				 	<option value="">-Choose created By-</option>
                        				 		<option value="1">admin</option>
                        				 	<?php foreach($empUser as $data){?>
                        				 	<option value="<?php echo $data['userId']?>"><?php echo $data['userName']?></option>	
                        				 	<?php }?>
                        				 		<!-- <?php foreach($websiteUser as $data){?>
                        				 	<option value="<?php echo $data['userId']?>"><?php echo $data['userName']?></option>		
                        				 	<?php }?>	 -->	
                        				</select>
                        			</div>
                        			<div class="col-sm-3">
                        		<input type="text" name="wildcard" placeholder="search username" value="<?php echo $wildcard ?>" id="wildcard" class="form-control">
                        	    </div>
                        			<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="<?php echo $exceldaterange1 ?>" readonly placeholder='Select "Create Date" daterange' required>
											</div>
											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit"  >Submit</button>
											</div>
                        		</div>
                        	</form>
                        </div>
                        <div class="ibox-content">
                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
													<th>User Name</th>
													<th>User Type</th>
													<th>Full Name</th>
													<th>Mobile Number</th>
													<th>Email Address</th>
													<th>Role</th>
													<th>Created Date</th>
													<th>Created By</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>		
												<?php foreach($staffMember as $value){ ?>
													<tr id="row<?php echo $value['userId']; ?>">
													<td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['userType']; ?></td>
													<td><?php echo $value['name']; ?></td>
                                                    <td><?php echo $value['mobileNo']?></td> 
                                                    <td><?php echo $value['emailAddress']?></td>
                                                    <?php //echo $value['roleId']; 
                                                    //$getUserType = $role_master->groupRoleById($value['roleId']); ?>
                                                    <td><?php  $value['roleId']; 
                                                     $resultNew = $role_master->groupRoleById($value['roleId']);
                                                     echo $resultNew[0]['userType'];   ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['createdDate'])); ?></td>
													<td><?php echo $value['empName'];?></td>
													<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['userId']; ?>,'userId','tbl_user')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/editStaff/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													<?php if($this->session->userdata('userType') == 'admin'){?>
														<span class="btn-white btn btn-xs"
													onclick="changePassword(<?php echo $value['userId']; ?>)">
													Change Password</span>
													<?php }?>	
													</td>
												</tr>
												<?php }?>
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						 <div id="tab-1" class="tab-pane <?php if(!empty($importantLinkById)){ echo 'active'; }else { echo ''; } ?>">
						   <div class="ibox-title">
                            <h5>Staff Member Entry</h5>
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
                          <form method="post" onsubmit="return  formValidation();" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/createStaff">
							   <div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">User Name<span class="required">*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control uname" name="uname" onblur="checkEmpUnameN()" value="" required>
												<span style="color:red;display: none;" id="spanUser">User Name already used. Choose another</span>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Role<span class="required">*</span></label>
										<div class="col-sm-10">
											<select name="role" class="form-control"  required="">
												<option>-Select Role-</option>
												<?php foreach($roles as $data){?>
												<option value="<?php echo $data['userTypeId']?>"><?php echo $data['userType']?></option>	
												<?php }?>	
											</select>
										</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Full Name<span class="required">*</span></label>
										<div class="col-sm-10">
												<input type="text" class="form-control" name="name" value="" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Mobile Number<span class="required">*</span></label>
										<div class="col-sm-10">
												<input type="text" class="form-control mobile" onkeypress="return isNumberKey(event)"  name="mobile" value="" maxlength="10" required>
												<span style="color: red;display: none" id="spanMobile">Mobile number already exist.</span>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Email Address</label>
										<div class="col-sm-10">
												<input type="text" class="form-control" name="email" value="" >
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Password<span class="required">*</span></label>
										<div class="col-sm-10">
												<input type="password" class="form-control" name="password" value="" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Assigned with<span class="required">*</span></label>
										<div class="col-sm-10">
												<input type="radio" onclick="assignedWithRole()" required="" name="userTypeNew" value="partner" id="partnerRadio" >Partner
												<input type="radio"onclick="assignedWithRole()" required="" name="userTypeNew" value="serviceProvider" id="serviceProviderRadio" >Service Provider
												<input type="radio" onclick="assignedWithRole()" id="noneRadio" required="" name="userTypeNew" value="">None of them
										</div>
									</div>
									<div class="col-sm-6">
										
										<div class="col-sm-10">
											<select name="assignedWith" style="display: none"  id="assignedWith" class="form-control">
												<option>-select-</option>
											</select>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/staff" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" id="submit" type="submit">Submit</button>
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


<div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-hidden="true" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			<div class="modal-body">
			<form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>home/changeEmpPassword">
				<input type="hidden" name="userId" id="userId" value="">
					<div class="form-group">
							<div class="row">
								<div class="col-lg-12">
									<label class="col-sm-4 control-label">Change Password</label>
									<div class="col-sm-8">
									<input type="password" name="password" class="form-control">
									</div>
								</div>
								
							</div>
						</div>
					
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Set password</button>
				</div>
			</form>
		</div>
		</div>
	</div>
</div>

        <script type="text/javascript">
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

      /*  function assignedWith()
        {
        	if($('#partnerRadio').is(':checked'))
        	{	
	             $.ajax({
	                type: "GET",
	    	        url: "<?php echo base_url()?>index.php/home/getPartnerList",
	    	        success:function(data){
	                  var rslt = $.trim(data)
	    		      var result = JSON.parse(rslt);
	    		      var len =  result.length;
                      
                      alert(data);
	    		     
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

	    		     alert(data);
	    		     
	    	        }
	             });
        	}else if($('#noneRadio').is(':checked')){
        		
        	}	
        }	*/

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
        <script type="text/javascript">
        	function checkEmpMobile()
        	{
        		var mobileNo = $('.mobile').val();

    		if(mobileNo != '')
    		{
    			$.ajax({
    				type:"POST",
    				url : "<?php echo base_url().'index.php/home/checkEmpMobile'?>",
    				data:{mobileNo:mobileNo},
    				success: function (data){
    					var rslt = $.trim(data);
    					result = JSON.parse(rslt);
				        var len = result.length;

				        if(len != '')
				        {
				          var	checkEmpMobile = 1;
                          $('#spanMobile').css('display','block');
                          $('#submit').attr('type','button');
				        }
				         else{
    		      	          checkEmpMobile = 0;
    		      	        $('#spanMobile').css('display','none');
    		      	        $('#submit').attr('type','submit');
    		             }		
    				}
    			});
    		}
    		else{
    			
    			  $('#spanMobile').css('display','none');
    		      	        $('#submit').attr('type','submit');
    		 }	
        	}

        	function changePassword(userId)
        	{
        		//alert(userId);
              $('#userId').val(userId);
              $('#myModal').modal();
        	}

        
        </script>
        <script type="text/javascript">
        	function formValidation()
        	{
        		 var mobileNo = $('.mobile').val();

	    		if(mobileNo != '' && mobileNo.length != 10)
	    		{
	    			//$('#mobileSpan').css('display','block');
	    			alert('Mobile Number should have atleast 10 digits');
	    			return false;
	    			
	    		}

	    		//alert('hjkhj');

	    		if(checkEmpUname == 1)
	    		{
	    			//alert('h');
	    			    $('#spanUser').css('display','block');
	    			    return false;
	    		}else{
	    			//alert('u');
	    			 $('#spanUser').css('display','none');
	    			    return true;
	    		}

	    		if(checkEmpMobile == 1)
	    		{
                   //  alert('a');
	    			  $('#spanMobile').css('display','block');
	    			   return false;
	    		}else{
	    			 //alert('b');
	    			  $('#spanMobile').css('display','true');
	    			   return true;
	    		}	
        	}
        </script>
          <script type="text/javascript">
    	function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			//alert(charCode);
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
    </script>
		
		
		
