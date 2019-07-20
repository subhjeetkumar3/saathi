<style>
.none{
	display:none !important;
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

input[type="radio"]{
  margin: 0 10px 0 10px;
}

.input-groups {
    position: relative;
    display: table;
    border-collapse: separate;
}
</style>
<div <?php if(!empty($er)){?> style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/user"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 color:red;" class="modal-title"><?php if(!empty($total_error)){echo $total_error; }  ?></h4>
			</div>
			<div class="modal-body" >
				<form method="POST" action="<?php echo base_url()?>index.php/userexcelupload/excelErrorFormat">
				<input type="hidden" name="errorExcel" value="<?php echo htmlspecialchars(json_encode($er,JSON_UNESCAPED_SLASHES)) ; ?>">
				<?php   //$this->session->set_userdata('userUploadError', json_encode($er)); ?>
				<!-- <a href="<?php echo base_url(); ?>index.php/userexcelupload/excelErrorFormat"><span class="btn btn-primary">Download Error</span></a> -->
				<input type="submit" class="btn btn-primary" name="submit" value="Download Error">
				</form>
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>Registration Number</th>
							<th>Username</th>
							<th>Name</th>
							<th>Name Alias</th>
							<th>Date Of Birth</th>
							<th>Age</th>
							<th>Mobile No</th>
							<th>Address</th>
							<th>State</th>
							<th>District</th>
							<th>Education</th>
							<th>Occupation</th>
							<th>Occupation Others</th>
							<th>Monthly Income</th>
							<th>Marital Status</th>
							<th>Marital Status Other</th>
							<th>Male Children</th>
							<th>Female Children</th>
							<th>Total Children</th>
							<th>Native State</th>
							<th>Native District</th>
							
							<th>Like to share information about sexual behaviour</th>
							<th>Have Multiple Sex Partner</th>
							<th>Ever Sought Paid Sex</th>
							<th>Preferred sex/Gender of sexual partner</th>
							<th>Preferred sexual act</th>
							<th>Status of condom usage</th>
							<th>Substance Use</th>
							<th>Have you ever been tested for HIV before? </th>
							<th>If yes, When (Please mention how many months / year before)</th>
							<th>Past HIV Test Result</th>
							<th>Date of Finger Prick Screening</th>
							<th>Referred to SA-ICTC</th>
							<th>Date Of Out-referral To SA-ICTC</th>
							<th>Place Of SA-ICTC Referred</th>
							<th>ICTC-PID Number</th>
							<th>Date Of HIV Confirmation Test</th>
							<th>Result Of HIV Confirmatory Test</th>
							<th>Date Of Test Reports Issued To Client</th>
							<th>Status Of HIV Confirmation Test</th>
							<th>Linked To ART</th>
							<th>ART Registration Date</th>
							<th>ART Registration Number</th>
							<th>Baseline CD4 Count</th>
							<th>Other services provided</th>
							<th>Status of client</th>
							<th>Remarks</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color: red;"><?php echo $value['error']?></td>
							<td><?php echo $value['client_id']?></td>
							<td><?php echo $value['userName'] ;?></td>
							
							<td><?php echo $value['name'] ?></td>
							<td><?php echo  $value['nameAlias'] ; ?></td>
							<td><?php echo  $value['dob']  ?></td>
							<td><?php echo  $value['age']?></td>
							<td><?php echo  str_replace('+91',' ',$value['mobileNo']); ?></td>
							<td><?php echo  $value['address'] ?></td>
							<td><?php echo  $value['state'];?></td>
							<td><?php echo  $value['districtId'] ?></td>
							<td><?php echo  $value['educationalLevel']  ?></td>
							<td><?php echo $value['occupation'] ?></td>
							<td><?php echo $value['occupation_other']?></td>
							<td><?php echo $value['monthlyIncome']?></td>
							<td><?php echo $value['maritalStatus'] ?></td>
							<td><?php echo $value['maritalStatus_other']  ?></td>
							<td><?php echo $value['male_children']  ?></td>
							<td><?php echo  $value['female_children'] ?></td>
							<td><?php echo $value['total_children']  ?></td>
							
							<td><?php echo $value['addressState']  ?></td>
							<td><?php echo $value['addressDistrict'] ?></td>
									 
						  
							<td><?php echo $value['sexualBehaviour']  ?></td>
							<td><?php echo  $value['multipleSexPartner']  ?></td>
							<td><?php echo  $value['sought'] ?></td>
						    <td><?php echo $value['sexualBehaviour']  ?></td>
							<td><?php echo $value['prefferedSexualAct'] ?></td>
						    <td><?php echo $value['condomUsage']?></td>
							<td><?php echo  $value['substanceUse']  ?></td>
							<td><?php echo $value['hivTestResult']  ?></td>
							<td><?php echo $value['hivTestTime'] ?></td>
							<td><?php echo $value['pastHivReport']  ?></td>

							<td><?php echo $value['fingerDate']  ?></td>
							<td><?php echo  $value['saictcStatus']  ?></td>
							<td><?php echo  $value['saictcDate'] ?></td>
						    <td><?php echo $value['saictcPlace']  ?></td>
							<td><?php echo $value['ictcNumber'] ?></td>
						    <td><?php echo $value['hivDate']?></td>
							<td><?php echo  $value['hivStatus']  ?></td>
							<td><?php echo $value['reportIssuedDate']  ?></td>
							<td><?php echo $value['reportStatus'] ?></td>
							<td><?php echo $value['linkToArt']  ?></td>

							<td><?php echo $value['artDate']?></td>
							<td><?php echo  $value['artNumber']  ?></td>
							<td><?php echo $value['cd4Result']  ?></td>
							<td><?php echo $value['otherService'] ?></td>
							<td><?php echo $value['clientStatus']  ?></td>
							<td><?php echo $value['remark']?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/user"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>User</strong>
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
							<ul class="nav nav-tabs" background-color:white;">
                                <li class="<?php if($userType == 'active' || empty($userType)){ echo 'active'; }?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Active User List</a></li>

                                 <li class="<?php if($userType == 'inactive'){ echo 'active';}else{ echo ' ';}?>"><a data-toggle="tab" href="#tab-3"><i class="fa fa-user"></i>Inactive User List</a></li>

								 <li class="<?php if(!empty($userById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i><?php if(empty($userById)){echo 'New Entry';}else{echo 'Edit Entry';}?></a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if($userType == 'active' || empty($userType)){ echo 'active'; }?>">
						   <div class="ibox-title">
                            <h5>Active User List </h5>
                            <div class="ibox-tools">
                            		<form method="POST" action="<?php echo base_url()?>index.php/home/downloadUserData">
									<input type="hidden" name="excelPage" value="active">
									<input type="hidden" name="exceldaterange" value="<?php echo $exceldaterange;?>">
									<input type="hidden" name="wildcard" value="<?php echo $wildcard ?>">
									<input type="hidden" name="userBy" value="<?php echo $userBy ?>">
									<input type="hidden" name="stateExcel" value="<?php echo $stateFilter ?>">
									<?php $districts = explode(',',$districtFilter); foreach ($districts as $key => $value) { ?>
										<input type="hidden" name="districtExcel[]" value="<?php echo $value ?>">
								     <?php	} ?>
								     <input type="hidden" name="campCode" value="<?php echo $campCode ?>">	<!-- added by subhjeet 05-06-2019 -->
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> user Data</button>
                            	     </form>  
                                <!--<a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>-->
                            </div>
                        </div>
                          <div class="ibox-content">
                          	<div class="row">
                          
                        	<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterUser">
                        		<input type="hidden" name="userType" value="active">
                        			
                        		<div class="form-group">
                        		<?php if($this->session->userdata('userType') == 'admin'){?>	
                        			<div class="col-sm-3">
                        				<select class="chosen-select"  name="userBy">
                        				 	<option value="">-Choose created By-</option>
                        				 	<option value="1" <?php if($userBy == 1){echo 'selected'; }?>>admin</option>
                        				 	<?php foreach($empUser as $data){?>
                        				 	<option value="<?php echo $data['userId']?>" <?php if($userBy == $data['userId']){echo 'selected'; }?>><?php echo $data['userName']?></option>	
                        				 	<?php }?>
                        				 	<!-- <?php foreach($websiteUser as $data){?>
                        				 	<option value="<?php echo $data['userId']?>"><?php echo $data['userName']?></option>		
                        				 	<?php }?>	 -->
                        				</select>
                        			</div>
                        		<?php }?>
                        		<div class="col-sm-3">
                        		<input type="text" name="wildcard" placeholder="search username" value="<?php echo $wildcard ?>" id="wildcard" class="form-control">
                        	    </div>
                        	    <div class="col-sm-3">
                        		<input type="text" name="searchData" placeholder="Search" value="<?php echo $searchData ?>" id="searchData" class="form-control">
                        	    </div>
                        			<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="<?php echo $exceldaterange; ?>" readonly placeholder='Select  "Create Date" daterange' required>
											</div>
											</div>
										
											
                        		</div>
                        		<div class="form-group">
                        				<div class="col-sm-3">
											<select id="stateFilter" name="stateFilter" class="chosen-select" onchange="getAddressDistrict1()"  name="userBy">
                        				 	<option value="">-Choose State-</option>
                        				   <option>-Choose State-</option>
                        				 	<?php foreach($stateList as $data){?>
                        				 	<option value="<?php echo $data['stateId']?>" ><?php echo $data['stateName']?></option>	
                        				 	<?php }?>
                        				 
                        				</select>	
											</div>
											<div class=" col-sm-3" >	
									 	<select name="districtFilter[]" multiple tabindex="12" id="districtFilter" class="chosen-select">
												<option value="" readonly>Select District</option>							
										</select>
											

						                 </div>	
						                 <div class="col-sm-3">
						                 	 <input type="text" id="campcode" name="campCode" placeholder="seach camp code" value="<?php echo $campCode ?>" class="form-control">		<!-- added by subhjeet 05-06-2019 -->
						                 </div>

                        		</div>

                        		<!-- <div class="form-group">
                        			<div class="col-sm-3">
                        				<input type="text" id="campcode" name="campCode" placeholder="seach camp code">
                        			</div>
                        		</div>
 -->
                        		<div class="col-sm-3">
												<button class="btn btn-primary" type="submit"  >Submit</button>
											</div>
                        	</form>
                        	</div>
                        </div>
                        <div class="ibox-content">
                        	<i style="color: red;">Most recent 20 records are displayed by default.</i>
                        	<i style="color: red;float: right;">This will search only in data displayed on screen here</i>
                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
													<th>Date of Registraion</th>
                                                    <!-- <th>Registration Number</th> -->
                                                    <th>Registration Number</th>
	                                                 <th>Camp code</th>
													
													<th>User Name</th>
													<th>Name</th>
													<th>Name Alias</th>
													<th>Date Of Birth</th>
													<th>Age</th>
													<th>Gender</th>
													<th>HRG</th>
											       <th>ARG</th>
											       
												
													<th>Address</th>
													<th>State</th>
													<th>District</th>
													
													<th>Mobile No</th>
													<th>Date of Finger Prick Screening</th>
													<th>Referred to SA-ICTC</th>

													<th>ART Registration Number</th>
													<th>Baseline CD4 Count</th>
													<th>Status Of Client</th>
													<th>Remarks</th>
                                                    <th>Create By</th>
													<th>Create Date</th>
												</tr>
												</thead>
												<tbody id="activeuserList">
												<?php if(!empty($activeuserList)){?>	
												<?php foreach($activeuserList as $value) { ?>
                                                <tr id="row<?php echo $value['userId']; ?>">
                                                	<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['userId']; ?>,'userId','tbl_user')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>

													<td><?php if(!empty($value['registeredOn']))
													{ echo date('d M Y',strtotime($value['registeredOn'])) ; } ?></td>
												<!-- 	<td><?php echo $value['userUniqueId']; ?></td> -->
													<td><?php echo $value['client_id'];  ?></td>
													 <td><?php echo $value['campCode']?></td>
													 
													 <td><?php echo $value['userName']; ?></td>
													 <td><?php echo $value['name']; ?></td>
													<td><?php echo $value['nameAlias']; ?></td>
													<td><?php if(!empty($value['dob']))
													{ echo date('d M Y',strtotime($value['dob'])); }?></td>
													<td><?php echo $value['age']; ?></td>
													<td><?php echo $value['gender']?></td>
												  <td><?php echo $value['hrg']; ?></td>
												  <td><?php echo $value['arg']; ?></td>
												  <td><?php echo $value['address']; ?></td>
												<td><?php echo $value['addressState1']?></td>
												<td><?php echo $value['addressDistrict1']?></td>
											  	<td><?php echo $value['mobileNo']; ?></td>		
												<td><?php if(!empty($value['fingerDate']))
													{ echo date('d M Y',strtotime($value['fingerDate'])) ; }  ?></td>		
											  <td><?php echo $value['saictcStatus']?></td>
											  <td><?php echo $value['artNumber'] ?></td>
											   <td><?php echo $value['cd4Result'] ?></td>
												<td><?php echo $value['clientStatus'] ?></td>
											 <td><?php echo $value['remarks']?></td>
											<td><?php if(!empty($value['createdBy'])){ $res = $role_master->userById($value['createdBy']); echo $res[0]['userName']; } ?></td>
			                                 <td><?php echo date('d M Y h:i a',strtotime($value['createdDate']))?></td>
													
												</tr>
												<?php } ?>
												<?php }?>
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>

						  <div id="tab-3" class="tab-pane <?php if($userType == 'inactive'){ echo 'active';}else{ echo ' ';}?>">
						   <div class="ibox-title">
                            <h5>Inactive User List</h5>
                            <div class="ibox-tools">
                            	
                            	<form method="POST" action="<?php echo base_url()?>index.php/home/downloadUserData">
									<input type="hidden" name="excelPage" value="inactive">
									<input type="hidden" name="exceldaterange1" value="<?php echo $exceldaterange1;?>">
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> User Data</button>
                            	   </form> 
                                <!--<a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>-->
                            </div>
                        </div>
                          <div class="ibox-content">
                        	<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterUser">
                        		<input type="hidden" name="userType" value="inactive">
                        		<div class="form-group">
                        			<div class="col-sm-3">
                        				<select class="chosen-select"  name="userBy">
                        				 	<option value="">-Choose created By-</option>
                        				 		<option value="1">admin</option>
                        				 	<?php foreach($empUser as $data){?>
                        				 	<option value="<?php echo $data['userId']?>"><?php echo $data['userName']?></option>	
                        				 	<?php }?>
                        				 	<!-- 	<?php foreach($websiteUser as $data){?>
                        				 	<option value="<?php echo $data['userId']?>"><?php echo $data['userName']?></option>		
                        				 	<?php }?>	 -->	
                        				</select>
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
												<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>	
												   <th>Date of Registraion</th>
                                                    <th>Registration Number</th>
	                                                 <th>Camp code</th>
													
													<th>User Name</th>
													<th>Name</th>
													<th>Name Alias</th>
													<th>Date Of Birth</th>
													<th>Age</th>
													<th>Gender</th>
													<th>HRG</th>
											       <th>ARG</th>
											       
												
													<th>Address</th>
													<th>State</th>
													<th>District</th>
													
													<th>Mobile No</th>
													<th>Date of Finger Prick Screening</th>
													<th>Referred to SA-ICTC</th>

													<th>ART Registration Number</th>
													<th>Baseline CD4 Count</th>
													<th>Status Of Client</th>
													<th>Remarks</th>	
													
													<th>Created By</th>
													<th>Create Date</th>
													
												</tr>
												</thead>
												<tbody>
												<?php if(!empty($inactiveuserList)){?>	
												<?php foreach($inactiveuserList as $value) { ?>
                                                <tr id="row<?php echo $value['userId']; ?>">
                                                	<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['userId']; ?>,'userId','tbl_user')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>

													<td><?php if(!empty($value['registeredOn']))
													{ echo date('d M Y',strtotime($value['registeredOn'])) ; } ?></td>
													<td><?php echo $value['client_id']; ?></td>
													 <td><?php echo $value['campCode']?></td>
													
													 <td><?php echo $value['userName']; ?></td>
													 <td><?php echo $value['name']; ?></td>
													<td><?php echo $value['nameAlias']; ?></td>
													<td><?php echo date('d M Y',strtotime($value['dob']));?></td>
													<td><?php echo $value['age']; ?></td>
													<td><?php echo $value['gender']?></td>
												  <td><?php echo $value['hrg']; ?></td>
												  <td><?php echo $value['arg']; ?></td>
												  <td><?php echo $value['address']; ?></td>
												<td><?php echo $value['addressState1']?></td>
												<td><?php echo $value['addressDistrict1']?></td>
											  	<td><?php echo $value['mobileNo']; ?></td>		
												<td><?php if(!empty($value['fingerDate']))
													{ echo date('d M Y',strtotime($value['fingerDate'])) ; }  ?></td>			
											  <td><?php echo $value['saictcStatus']?></td>
											  <td><?php echo $value['artNumber'] ?></td>
											   <td><?php echo $value['cd4Result'] ?></td>
												<td><?php echo $value['clientStatus'] ?></td>
											 <td><?php echo $value['remarks']?></td>
											<td><?php if(!empty($value['createdBy'])){ $res = $role_master->userById($value['createdBy']); echo $res[0]['userName']; } ?></td>
			                                 <td><?php echo date('d M Y h:i a',strtotime($value['createdDate']))?></td>
													
												</tr>
												
												<?php } ?>
												<?php }?>
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						 <div id="tab-1" class="tab-pane <?php if(!empty($userById)){ echo 'active'; }else { echo ''; } ?>">
						   <div class="ibox-title">
                            <h5>User Entry</h5>
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
						   <form method="post"  class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/userexcelupload/uploadExcelUser" >
							   <div class="form-group" margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import User Excel</label>
										   <div class="col-sm-8" display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <input type="text" class="form-control" required="" name="limit" placeholder="No of records need to be uploaded*">
											   <button class="btn btn-primary" type="submit" padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/userexcelupload/download/user_excel_format" class="btn btn-primary" margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
                        
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" id="userForm" onsubmit="return checkAge() && formValidation();" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addUser/<?php if(!empty($userById)){echo $userById[0]['userId']; }?>">

                          	<fieldset style="padding: 2% 2%;">
							  <legend>Registration Details:</legend>	
							

                          		<div class="form-group">
								<div class=" col-sm-6">
									<label class="control-label">Date of Registation</label>
								</div>
									<div class=" col-sm-6">
									<div class="input-groups dates">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
										</span>		
									<input type="text" required name="registeredOn" value="" id="regDate"  class="form-control">				
									</div>	  
								</div>
						
								</div> 
                                 
                               <div class="form-group">
									<div class="col-sm-6">
										<label class="control-label">Camp Code</label>
									</div>
									<div class="col-sm-6">	
								
										  <!-- <input type="text" name="campCode" value="<?php echo $userById[0]['campCode'] ?>" class="form-control">	 -->

										<div class="col-sm-2"  >
													
													<input type="text"  maxlength="2" minlength="2" name="stateCode"  id="stateCode"  class="form-control">
												 <span style="width: 30% !important;color: red">State- 2 Character Code</span>	
												</div>
												
												<div class="col-sm-2">
													<input type="text" maxlength="2" minlength="2" name="districtCode"  id="districtCode" class="form-control">
												 <span style="color: red">District- 2 Character Code</span>		
												</div>
												
												<div class="col-sm-3">
													<input type="text" onkeypress="return isNumberKey(event)"   id="campCode1" name="campCode1" minlength="3" maxlength="3" class="form-control">
												<span style="color: red">3 digit sequence</span>		
												</div>  	
										
									</div>
									
							
									<div class="col-sm-6">
										<label class="control-label">Registered Done By</label>	
										
										 <select class="form-control" name="registeredBy">
										 	<option value="">-select-</option>
										 	<option>CRP</option>
										 	<option>SPC</option>
										 	<option>SPO</option>
										 	<option>Volunteer</option>
										 </select>
									</div>
									
                                 </div>

                                 <div class="form-group">
                                 

                                 	<div class="col-sm-6">
                                 		<label class="control-label">Mode Of Contact</label>
                                 		<select class="form-control" name="modeOfContact">
                                 			<option value="">-select-</option>
                                 			<option>Offline one to one</option>
                                 			<option>Offline-Camps-CBS events</option>
                                 		</select>
                                 	</div>
                                 </div>

                             </fieldset>

                               <div class="hr-line-dashed"></div>

                             <fieldset style="padding: 0 2%;">
                             <div class="form-group">
                             	<div class="col-sm-6">
                             		  <label class="control-label">Name<span class="required">*</span></label>
                             		  <input type="text"  name="name" tabindex="5" value="" class="form-control" id="name" >
                             	</div>
                             	<div class="col-sm-6">
                             		  <label class="control-label">Name (Alias)</label>
                             		    <input type="text"  name="nameAlias" value="" id="nameAlias" tabindex="6" class="form-control" >  
                             	</div>
                             </div>
                             <div class="form-group">
                             	<div class="col-sm-6">
                             		  <label class="control-label">Password
                             		  	<!-- <span class="required">*</span> -->
                             		  </label>
                             		  <input type="password" class="form-control" name="password" id="password" value="" >
                             	</div>
                             	<div class="col-sm-6">
                             		  <label class="control-label">Confirm Password
                             		  	<!-- <span class="required">*</span> -->
                             		  		
                             		  	</label>
                             		   <input type="password" name="password" id="cpassword" tabindex="4" class="form-control"   >
											<p style="display: none;color: red;" id="spanPassword">password does not match</p>
                             	</div>
                             </div>
                             <div class="form-group">
                             	<div class="col-sm-6">
                             		 <label class="control-label">Date Of Birth
                             		 	<!-- <span class="required">*</span> -->
                             		 </label>	
                             		  <input type="text"  name="dob" id="dob" value="" tabindex="7" class="form-control" > 
                             	</div>
                             	<div class="col-sm-6">
                             	 <label class="control-label">Age
                             	 	<span class="required">*</span>
                             	 </label>	
                             	 <input type="text"  required  name="age" maxlength="2" id="age" value="" tabindex="7" onkeypress="return isNumberKey(event)" class="form-control" >
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		 <label class="control-label">Gender<span class="required">*</span></label>	
                             		 <select class="form-control" name="gender">
                             		 	<option value="">-Select-</option>
                             		 	<option >Male</option>
                             		 	<option>Female</option>
                             		 	<option>TG</option>
                             		 </select>
                             	</div>
                             	<div class="col-sm-6">
                             		 <label class="control-label">Mobile Number (to receive OTP)</label>
                             		 <input style="width: 14%;float: left;margin-top: 5.5%;" type="text" id="" disabled="" name="" placeholder="+91-"  class="form-control" onkeypress="return isNumberKey(event)" >
                             		 <input type="text" value="" style="width: 80%" id="mobileNo" name="mobileNo" onchange="checkMobile()" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" tabindex="9" >
                             	</div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             	  <label class="control-label">Current Address</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="text" id="address"  name="address" value="" tabindex="10" class="form-control" >
                             	</div>
                             </div>
                            
                               <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">State<span class="required">*</span></label>
                             	 <select class="form-control" onchange="getAddressDistrict()"  tabindex="11"  id="state1" name="addressState" required>
						 		       <option value="" >Select State</option>
									     <?php foreach($stateList as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>" ><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>
                             	</div>
                             	<div class="col-sm-6">
                             		<label class="control-label">District<span class="required">*</span></label>
                             		<select name="addressDistrict" required tabindex="12" id="districtId1" class="form-control">
									<option value="" readonly>Select District</option>							
									</select>
                             	</div>
                             </div>
                             </fieldset>

                                 <div class="hr-line-dashed"></div>

                             <fieldset style="padding: 0 2%;">
                             	 <div class="form-group">
                             	<div class="col-sm-6">
                             	   <label class="control-label">Education</label>
                             	   <select name="education" tabindex="13" class="form-control" id="education" >
						 		        <option value="" readonly>Select Education</option>
						 		        <option value="Pre-Literate" >Pre-Literate</option>
						 		        <option value="Primary(1-5)" >Primary(1-5)</option>
						 		        <option value="Secondary(6-10)" >Secondary(6-10)</option>
						 		        <option value="Higher Secondary"  >Higher Secondary</option>
						 		      <!--   <option value="Secondary" ></option> -->
						 		        <option value="Graduation and above" >Graduation and Above</option>
						 		        <option value="Non formal education" >Non formal education</option>
						 	     </select>	
                             	</div>
                               <div class="col-sm-6">
                               	<label class="control-label">Monthly Income</label>
                               	<select name="monthlyIncome" tabindex="16"  class="form-control" id="monthly Income" >
						 		<option value="">Select Income</option>
						 		<option value=">1000"> > 1000</option>
						 		<option value="1001-5000">1001-5000</option>
						 		<option value="5001-10000">5001-10000</option>
						 		<option value="Above 10000">Above 10000</option>
						 	</select>
                               </div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Marital Status</label>
                             	   <select name="maritalStatus"  class="form-control" tabindex="18" id="maritalStatus" >
										 		<option value="">Select Marital Status</option>
										 		<option value="Married"  >Married</option>
										 		<option value="Divorced"  >Divcored</option>
										 		<option value="Widow/Widower"  >Widow/Widower</option>
										 		<option value="Unmarried"  >Unmarried</option>
										 		<option value="Separated"  >Separated</option>
										 		<option value="Other" >Other</option>
						 	          </select>	
                             	</div>

                             	<div class="col-sm-6">
                             		 <label class="control-label">Marital Status-Others</label>

                             		<input type="text" class="form-control" id="maritalStatus1" name="maritalStatus1"> 
                             	</div>
                             </div>

                             <div class="form-group">
                             		<div class="col-sm-6">
                             		<label class="control-label">Occupation</label>
                             		 <select name="occupation" tabindex="14" class="form-control" id="occupation" >
						 		         <option value="" readonly>Select Occupation</option>
						 		         <option value="Salaried" >Salaried</option>
						 		          <option value="Self employed"  >Self employed</option>
						 		        <!--   <option value="employed"  >employed</option> -->
						 		          <option value="Daily wage"  >Daily wage</option>
						 		          <!-- <option value="Wage" >Wage</option> -->
						 		          <option value="Student"  >Student</option>
						 		          <option value="Sex Work"  >Sex Work</option>
						 		        <!--   <option value="Work"  >Work</option> -->
						 		          <option value="Badhai"  >Badhai</option>
						 		          <option value="Mangt"  >Mangt</option>
						 		          <option value="Dancing"  >Dancing</option>
						 		          <option value="Truckers"  >Truckers</option>
						 		          <option value="Migrant">Migrant</option>
						 		          <option value="Drivers">Drivers</option>
						 		          <option value="Other"  >Other</option>
						 	          </select>
                             	</div>
                             	<div class="col-sm-6">
                             	 <label class="control-label">Occupation-Others</label>
                             	   <input type="text" name="occupation1" value="<?php echo $userById[0]['occupation_other']?>" tabindex="15" id="occupation1" class="form-control">
                             	</div>
                             </div>
                             <div class="form-group">
                             	<div class="col-sm-6">
                             		<input type="radio" id="hrgRadio" onclick="hrgDisplay()" name="hrgDiv"><b>HRG</b>
                             		<input type="radio" id="argRadio" onclick="hrgDisplay()"  name="hrgDiv"><b> ARG </b>
                             		<input type="radio" name="hrgDiv" onclick="hrgDisplay()" id="Neither"><b>Neither</b>
                             	</div>
                             	
                             </div>

                             <div class="form-group" >
                             	<div class="col-sm-6" id="hrgDiv" style="display: none;" >
                             	<label class="control-label">HRG</label>
                             	 <select name="hrg" tabindex="16" class="form-control" id="hrg" >
						 		      <option value="">-select-</option>
						 		      <option value="MSM" >MSM</option>
						 		      <option value="TG_M-F" >TG_M-F</option>
						 		     
						 		      <option value="FSW" >FSW</option>
						 		      <option value="IDU" >IDU</option>
						 	          </select>
						 	      </div> 
						 	      <div class="col-sm-6" id="argDiv" style="display: none;" >
						 	      	<label class=" control-label">ARG</label>
						 	      	 <select name="arg"   tabindex="17" class="form-control" id="arg" >
						 	    	<option value="">-select-</option>
						 	    	<option>Single Male migrant</option>
						 	    	<option>Trucker</option>
						 	    	<option>Partner / Spouse of FSW</option>
						 	    	<option>Have multiple partners </option>
						 	    	<!-- <option>Female partner (FPARG)</option>
						 	    	<option>Female Partner (FPHRG)</option> -->
						 	    	<option>Female Partner-ARG</option>
						 	    	<option>Female Partner-HRG</option>
						 	    	<option value="TG_F-M" >TG_F-M</option>
						 	    </select>
						 	      </div>   
                             </div>

                             	<div class="form-group">
								<div class="row">
								 <div class=" col-sm-4" >
								 	<label class="control-label">Male Children</label>
								 	<input type="text" tabindex="20" name="malechildren" id="malechildren" class="form-control" value="" onkeypress="return isNumberKey(event)" >
								 </div>	
								 <div class=" col-sm-4" >
								 	<label class="control-label">Female Children</label>
								 	<input type="text"  tabindex="21" name="femalechildren" id="femalechildren" class="form-control" value="" onkeypress="return isNumberKey(event)">
								 </div>
		                          <div class=" col-sm-4" >
								 	<label class="control-label">Total Chidren</label>
								 	<input type="text"  value="" tabindex="22" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" readonly="">
								 </div>
									</div>
								</div> 

								<div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Native State</label>
                             	 <select class="form-control" onchange="getDistrict()" tabindex="23"  id="state" name="state">
						 		               <option value="" readonly >Select State</option>
									      <?php foreach($stateList as $data){ ?>
									         <option value="<?php echo $data['stateId']; ?>" <?php if($data['stateId'] == $userById[0]['state']){echo 'selected';}?>><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	       </select>
                             	</div>
                             	<div class="col-sm-6">
                             		<label class="control-label">Native District<span></span></label>
                             	   <select name="districtId" tabindex="24" id="districtId" class="form-control">
									     <option value="" readonly>Select District</option>							
								       </select>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Referral Points<span></span></label>
                             		<select class="form-control" onchange="getDistrict()" tabindex="23"  id="referralPoint" name="referralPoint">
					 		               <option value="">-select-</option>
								           <option >Construction Site</option>
								           <option>Youth Club</option>
							               <option>Hotspot</option> 	
							               <option>Truckers Point</option>					
							               <option>Others</option>				
						 	            </select>
                             	</div>
                             	<div class="col-sm-6">
                             		 <label class="control-label">Referral Points- Details<span></span></label>
                             		  <input type="text" name="referralPoint1" class="form-control">
                             	</div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class=" control-label">Like to share information about sexual behaviour </label>
                             	</div>
                             	<div class="col-sm-6">
                             	 <select name="sexualBehaviour" tabindex="27" class="form-control" id="sexualBehaviour" >
						 		      <option value="">Select to share information</option>
						 		       <option value="Yes">Yes</option>
						 		        <option value="No">No</option>
						 	      </select>
                             	</div>
                             </div>
                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Have multiple sex partner</label>
                             	</div>
                             	<div class="col-sm-6">
                             	  <select name="multipleSexPartner" tabindex="28" class="form-control" id="multipleSexPartner" >
						 		      <option value="" readonly>Select</option>
						 		      <option value="Yes">Yes</option>
						 		      <option value="No">No</option>
						 	      </select>	
                             	</div>
                             </div>
                             	
                             <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Ever Sought paid sex</label>
                             	</div>
                             	<div class="col-sm-6">
                             	   <select name="sought" tabindex="29" class="form-control" id="sought" >
						 		      <option value="">-select-</option>
						 		      <option value="Yes">Yes</option>
						 		     <option value="No">No</option>
						 	      </select>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Preferred sexual act</label>
                             	</div>
                             	<div class="col-sm-6">
                             	   <select name="prefferedSexualAct[]" multiple="" tabindex="35" class="chosen-select" id="prefferedSexualAct" >
						 		       <option value="" readonly>Select</option>
						 		        <option value="Oral">Oral</option>
						 		        <option value="Anal">Anal</option>
						 		        <option value="Vaginal">Vaginal</option>
						 	        </select>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class=" control-label">Preferred sex/Gender of sexual partner</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<select name="prefferedGender[]" multiple="" tabindex="34" class="chosen-select" id="prefferedGender" >
						 		<option value="" readonly> Select</option>
						 		<option value="Male">Male</option>
						 		<option value="Female">Female</option>
						 		<option value="TG">TG</option>-
						 		
						 	
						 	</select>	
                             	</div>
                             </div> 


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class=" control-label">Status of condom usage</label>
                             	</div>
                             	<div class="col-sm-6">
                             	  <select name="condomUsage" tabindex="30" class="form-control" id="condomUsage" >
						 		     <option value="" readonly>Select</option>
						 		     <option value="In every sex">In every sex </option>
						 		     <option value="In paid sex">In paid sex</option>
						 		     <option value="Sometime">Sometime</option>
						 		     <option value="Never">Never</option>
						 		     <option value="Not aware">Not aware</option>
						 		</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class=" control-label">Substance Use</label>


                             	</div>
                             	<div class="col-sm-6">
                             		<select name="substanceUse[]" multiple tabindex="31" class="chosen-select" id="substanceUse" >
									 		<option value="" readonly>Select</option>
									 		<option value="Tobacco">Tobacco</option>
									 		<option value="Drug">Drug</option>
									 		<option value="Alcohol">Alcohol</option>	
						 	           </select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Have you ever been tested for HIV before?</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		 <select name="hivTestResult" tabindex="32" class="form-control" id="testHiv" >
								 		<option value="" readonly>Select</option>
								 		<option value="Yes">Yes</option>
								 		<option value="No">No</option>
						 	       </select>
                             	</div>
                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">If yes, When (Please mention how many months / year before)</label>
                             	</div>
                             	<div class="col-sm-6">
                             		<!-- <select name="hivConfirmation" tabindex="33" class="form-control" id="hivConfirmation" >
						 		       <option value="" >-Select-</option>
						 		       <option value="reactive">Reactive</option>
						 		       <option value="not-reactive">Not-reactive</option>
						 	        </select> -->
						 	        <input type="text" class="form-control" name="hivTestTime">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class=" control-label">Past HIV Test Result</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	 <select name="pastHivReport" tabindex="33" class="form-control" id="pastHivReport" >
								 		<option value="" readonly>Select</option>
								 		<option value="Reactive">Reactive</option>
								 		<option value="Not-reactive">Not-reactive</option>
								 		<option value="Result not collected">Result not collected</option>
						 	       </select>	
                             	</div>
                             </div>	

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Date of Finger Prick Screening 
                             	<span class="required">*</span>
                             	</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<div class="input-group date">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
								<input type="text" id="DOFPS" onchange="checkdofps()" name="fingerDate"  value="<?php if(!empty($userById[0]['fingerDate']) && $userById[0]['fingerDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['fingerDate'])); }?>" id="data_5" class="form-control input-daterange" required >
							</div>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Referred to SA-ICTC<span class="required">*</span></label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<select class="form-control" id="saictcRefer" onchange="displayDiv1()" name="saictcRefer" required>
									<option value="">-select-</option>
									<option>Yes</option>
									<option>No</option>
								</select>	
                             	</div>
                             </div>

                           <div id="saictcReferDiv" style="display: none;" >  

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Date of Out-referral to SA-ICTC</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="saictcDate" id="SAICTCDATE" onchange="checkdofps()" value="<?php if(!empty($userById[0]['saictcDate']) && $userById[0]['saictcDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['saictcDate'])); }?>"  class="form-control">
								</div>
                             	</div>
                             </div>

                             <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Upload Referral Slip </label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="file" name="referralUpload" class="form-control">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Place of SA-ICTC Referred</label>
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="text" name="saictcPlace" value="<?php echo $userById[0]['saictcPlace'] ?>" class="form-control">
                             	</div>
                             </div>

                               <div class="form-group">
                             	<div class="col-sm-6">
                             			<label class="control-label">ICTC -PID Number</label>
                             	</div>
                             	<div class="col-sm-6">
                             	<input type="text" name="ictcNumber" value="<?php echo $userById[0]['ictcNumber'] ?>" class="form-control"	
                             	</div>
                             </div>
                         </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Date of HIV Confirmation Test</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="hivDate" id="HIVDATE" onchange="checkdofps()" value="<?php if(!empty($userById[0]['hivDate']) && $userById[0]['hivDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['hivDate'])); }?>"  class="form-control">
								</div>	
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Result of HIV Confirmatory Test</label>	
                             	</div>
                             	<div class="col-sm-6">
                             			<select class="form-control" onchange="displayPositive()" id="hivStatus" name="hivStatus">
                             		<option value="">-select-</option>		
									<option >Reactive</option>
									<option >Non-Reactive</option>
								</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Upload ICTC test report scan</label> 
                             	</div>
                             	<div class="col-sm-6">
                             						
								<input type="file" class="form-control" name="ictcUpload">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	   <label class="control-label">Date of Test Report Issued to Client</label> 	
                             	</div>
                             	<div class="col-sm-6">
                             	 <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="reportIssuedDate" id="TRITC" onchange="checkdofps()" value="<?php if(!empty($userById[0]['reportIssuedDate']) && $userById[0]['reportIssuedDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['reportIssuedDate'])); }?>"  class="form-control">
								</div>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             		<label class="control-label">Status Of HIV Confirmation on Report</label>
                             	</div>
                             	<div class="col-sm-6">
	                             	<select class="form-control" name="reportStatus">
									<option value="">-select</option>
									<option>Received by Community</option>
									<option>Migrated</option>
									<option> Non Acceptance</option>
									<option>Died</option>
								</select>
                             	</div>
                             </div>

                         </div>

                         <div id="positiveLineDiv" style="display: none;">

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Linked to ART</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<select class="form-control" name="artLink">
                             			<option value="">-select-</option>
                             			<option>Yes</option>
                             			<option>No</option>
                             		</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">ART Registration Date</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	 <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="artDate" id="ARTRD" onchange="checkdofps()" value=""  class="form-control">
								</div>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">ART Registration Number</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<input type="text" class="form-control" name="artNumber">
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Baseline CD4 Count</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<input type="text" name="cd4Result" class="form-control">	
                             	</div>
                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Upload ART Green Card scan / photo</label>	
                             	</div>
                             	<div class="col-sm-6">
                             	<input type="file" class="form-control" name="artUpload">	
                             	</div>
                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Other services provided</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<select class="chosen-select" multiple="" name="otherService[]">
                             			<option value="">-select-</option>
                             			<option> Positive living counselling  </option>
											<option> ART adherence counselling </option>
											<option> Linkage to Social protection </option>
											<option> Other services </option>
                             		</select>
                             	</div>
                             </div>

                              <div class="form-group">
                             	<div class="col-sm-6">
                             	 <label class="control-label">Status of Client</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<select class="form-control" name="clientStatus" >
                             			<option value="">-select-</option>
                             			<option>New Detection </option>
										<option> Known Positive </option>
										<option> LFU </option>
                             		</select>
                             	</div>
                             </div>

                             </div>


                              <div class="form-group">
                             	<div class="col-sm-6">
                             	<label class="control-label">Remarks</label>	
                             	</div>
                             	<div class="col-sm-6">
                             		<textarea class="form-control" name="remark"></textarea>
                             	</div>
                             </div>
                             </fieldset>
						        

						      	  <div class="hr-line-dashed"></div>  
					
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/user" class="btn btn-white">Cancel</a>
                                    <!--     <button class="btn btn-primary" type="button" onclick="getUserUniqueId('<?php if(!empty($userById)){echo $userById[0]['userId'];} ?>');">Submit</button> -->
										<button class="btn btn-primary" type="submit" id="submit" >Submit</button> 
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
        <script type="text/javascript">
        	$(function(){
            $('#dob').datepicker({changeYear: true, changeMonth: true,format: 'dd-mm-yyyy', endDate: new Date()});
            $('#regDate').datepicker({   
            	 autoclose: true,
                 format: 'dd-mm-yyyy',
                 endDate: new Date()
             });
             /* $('#dob').change(function(){
                var today = new Date(), 
               birthday_val = $("#dob").val().split('/'),
                birthday = new Date(birthday_val[0],birthday_val[1],birthday_val[2]),
                todayYear = today.getFullYear(),
                todayMonth = today.getMonth(),
                todayDay = today.getDate(),
                birthdayYear = birthday.getFullYear(),
                birthdayMonth = birthday.getMonth(),
                birthdayDay = birthday.getDate(),
               yearDifference = (todayMonth == birthdayMonth && todayDay > birthdayDay) ? 
               todayYear - birthdayYear : (todayMonth > birthdayMonth) ? todayYear - birthdayYear : todayYear - birthdayYear-1;

             $('#age').val(yearDifference);

              alert(birthday);
             //alert("Age: " + yearDifference);
      });*/

      $('#dob').change(function(){

      	//alert('hgjghj');

      	var today = new Date();
      	birthday_val = $('#dob').val().split("-");

      	todayYear = today.getFullYear();
      	todayMonth = today.getMonth();
      	todayDay = today.getDate();

      	var dob = new Date(birthday_val);

      	dobYear = birthday_val[2];
        dobDay = birthday_val[1];
        dobMonth = birthday_val[0];
        console.log(dobYear+" "+dobMonth+" "+dobDay);
        console.log(birthday_val);
        console.log(birthday_val[0]+" "+birthday_val[1]+" "+birthday_val[2]);
        console.log(today);

        if(dobMonth > todayMonth || dobDay < todayDay)
            {
               yearDifference = todayYear-dobYear;
               yearDifference = yearDifference-1;
            }
            else
            {	
             yearDifference = todayYear-dobYear;
            }

            //alert(yearDifference);
			//console.log('yearDifference',yearDifference);
             if( yearDifference < 18)
            {
               $('#submit').attr('type','button');

               alert('You should be 18 years or above to register & view this website');
            }
            else{
            	$('#submit').attr('type','submit');
            }

           $('#age').val(yearDifference);
      })

      $('#password,#cpassword').change(function(){
           if($('#cpassword').val() != '')
       	   {
             if($('#password').val() != $('#cpassword').val())
             {
             	$('#spanPassword').css('display','block');
             	$('#submit').attr('type','button')
             }else{
             	$('#spanPassword').css('display','none');
             	$('#submit').attr('type','submit');
             }
       	   }

      });
   })
        </script>                
      <script type="text/javascript">    
    	$('#malechildren,#femalechildren').change(function(){
     
           if($('#malechildren').val() == 0)
           	var a = 0;
           else
           	var a = parseInt($('#malechildren').val(),10);

           if($('#femalechildren').val() == 0)
            var b = 0;
           else
           	var b = parseInt($('#femalechildren').val(),10);

           $('#totalchildren').val(a+b);
  
    	});

      </script>
  <script type="text/javascript">
  	$('#forOthers').change(function () {
    if(this.checked) 
    {
        $('#occupation1').prop('required', true);
        $('#occupation').prop('required',false);
        $('#referralPoint').prop('required',false);
        $('#referralPoint1').prop('required',true);
        $('#secondaryIdentity').prop('required',false);
        $('#secondaryIdentity1').prop('required',true);
        $('#primaryIdentity1').prop('required',true);
        $('#primaryIdentity').prop('required',false);
        $('#maritalStatus').prop('required',false);
        $('#maritalStatus1').prop('required',true);
    } 
    else 
    {
        $('#occupation1').prop('required',false);
        $('#occupation').prop('required',true);
        $('#referralPoint').prop('required',true);
        $('#referralPoint1').prop('required',false);
        $('#secondaryIdentity').prop('required',true);
        $('#secondaryIdentity1').prop('required',false);
        $('#primaryIdentity1').prop('required',false);
        $('#primaryIdentity').prop('required',true);
        $('#maritalStatus').prop('required',true);
        $('#maritalStatus1').prop('required',false);
    }
});

  </script>
       <script>

       	var checkUserMobile = 0;
		window.onload = function() {
			  // alert('aaa');
			   getDistrict();

			   getAddressDistrict();
		};
		function getUserUniqueId(userId){
			//alert(serviceProviderId);
			var id = $('#userName').val();
			//alert(id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getUserUniqueId",
				data: {id:id,userId:userId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(resul         	t[0].total);
					if(result[0].total == 0){
						$('#error').html('');
						$('#submit').trigger('click');
					}else{
						$('#error').html('Should be Unique UserName');
						$('#userName').focus();
					}
				}
			});
		}
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
						
						if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['districtId'];} ?>'){
							htm += '<option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option>';
						}else{
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						
					}
					
					//alert(htm);
					$('#districtId').html('');
					$('#districtId').html(htm);
					
				}
			});
			
		}

		function getAddressDistrict()
		{
				var stateId = $('#state1').val();
    		
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

									
									$("#districtId1").html(htm);
									
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
								
									$("#districtId1").html(htm);
								
							} 
						}
					});

		}

         function getAddressDistrict1()
		{
				var stateId = $('#stateFilter').val();
    		
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

									
									$("#districtFilter").html(htm);
									
							}else{
								var htm = '';
									htm += '<option value="" readonly>Select District</option>';
									for(var i = 0; i < len; i++){
                                       if(result[i].districtId == '<?php if(!empty($userById)){echo $userById[0]['addressDistrict'];} ?>'){
							                   htm += '<select name="districtFilter[]" multiple tabindex="12" id="districtFilter" class="chosen-select"><option value="" readonly>Select District</option><option value="'+result[i].districtId+'" selected>'+result[i].districtName+'</option><select>';
						                  }else{
							                htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						                 }
						
									}
								
									//$("#districtFilter").html(htm);
									  $('#districtFilter').html(''); 
									$("#districtFilter").html(htm);
									$('#districtFilter').trigger("chosen:updated");
								
							} 
						}
					});

		}


		function checkName()
		{
             var userName = $('#userName').val();

             $.ajax({
                type: "POST",
    	        url: "<?php echo base_url()?>index.php/homeweb/checkUserExist",
    	        data: {userName:userName},
    	        success:function(data){
                  var rslt = $.trim(data)
    		      var result = JSON.parse(rslt);
    		      var len =  result.length;

    		      if(len != 0)
    		      {
                    $('#spanUser').css('display','block');
                    $('#submit').attr('type','button');
    		      }
    		      else{
    		      	$('#spanUser').css('display','none');
    		      	$('#submit').attr('type','submit');
    		      }	
    	        }
             });
    	}

    	function checkAge()
    	{
    		var age = $('#age').val();

    		if(age < 18 && age != '')
    		{
    			  alert('You should be 18 years or above to register & view this website'); 
    			return false;
    			
    		}
    		else{
    			return true;
    		}	
    	}

    	function checkMobile()
    	{
    		
    		var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '')
    		{
    			$.ajax({
    				type:"POST",
    				url : "<?php echo base_url().'index.php/home/checkUserMobile'?>",
    				data:{mobileNo:mobileNo},
    				success: function (data){
    					var rslt = $.trim(data);
    					result = JSON.parse(rslt);
				        var len = result.length;

				        if(len != '')
				        {
				        	checkUserMobile = 1;
                          alert('Mobile no already taken.choose another');
                          $('#submit').attr('type','button');
				        }
				         else{
    		      	        checkUserMobile = 0;
    		      	        $('#submit').attr('type','submit');
    		             }		
    				}
    			});
    		}
    		else{
    			checkUserMobile = 0;
    		}	
    	}

    	function formValidation()
    	{	
    		if(checkUserMobile == 1)
    		{
    			alert('Mobile no already taken.choose another');
    			return false;
    		}
    		else{

    			return true;
    		}	
    	}


    	function displayDiv1()
    	{
    		 var saictcRefer = $('#saictcRefer').val();

    		 if(saictcRefer == 'Yes')
    		 {
    		 	$('#saictcReferDiv').css('display','block');
    		 }else{
    		 	$('#saictcReferDiv').css('display','none');
    		 }	
    	}

    	function displayPositive()
    	{

    		var hivStatus = $('#hivStatus').val();

    		//alert(hivStatus);

    		if(hivStatus == 'Reactive')
    		{
    			//alert('bnjbhj');
                $('#positiveLineDiv').css('display','block');
    		}else{

    			$('#positiveLineDiv').css('display','none');
    		}	
    	}

    	/*function wildcardUsername()
    	{
    		var wildcard = $('#wildcard').val();

    		$.ajax({
    			type:"POST",
    				url : "<?php echo base_url().'index.php/home/wildcardUsername'?>",
    				data:{wildcard:wildcard},
    				success: function (data){
    					var rslt = $.trim(data);
    					result = JSON.parse(rslt);
				        var len = result.length;

				   $('#activeuserList').html(' ');

				   var html = " ";
				   
				  for (var i = 0; i < len; i++) {
				   	
				   } 
				             	
    		 }
    		});
    	}*/
		</script>
		 <script type="text/javascript">
    	   //$(document).ready(function(){

    		

	       $('#cpassword').change(function(){
	        
	       	   if($('#cpassword').val() != '')
	       	   {
	             if($('#password').val() != $('#cpassword').val())
	             {
	             	$('#spanPassword').css('display','block');
	             	$('#submit').attr('type','button')
	             }else{
	             	$('#spanPassword').css('display','none');
	             	$('#submit').attr('type','submit');
	             }
	       	   }
	       });

	       $('#password').on('change',function(e){
	           if($('#cpassword').val() != '')
	       	   {
	             if($('#password').val() != $('#cpassword').val())
	             {
	             	$('#spanPassword').css('display','block');
	             	$('#submit').attr('type','button')
	             }else{
	             	$('#spanPassword').css('display','none');
	             	$('#submit').attr('type','submit');
	             }
	       	   }
	       });


	       function hrgDisplay()
	       {
	       	 if($('#hrgRadio').prop('checked') == true)
	       	 {
	       	 	$('#hrgDiv').css('display','block');
	       	 	 $('#argDiv').css('display','none');	
	       	 	 $('#hrg').prop('required',true);
	       	 	 $('#arg').prop('required',false);
	       	 }else if($('#argRadio').prop('checked') == true){
                  $('#argDiv').css('display','block');
                  $('#hrgDiv').css('display','none');
                  $('#arg').prop('required',true);
                  $('#hrg').prop('required',false);
	       	 }else{
	       	 		$('#hrgDiv').css('display','none');
	       	 	 $('#argDiv').css('display','none');	
	       	 	  $('#arg').prop('required',false);
	       	 	   $('#hrg').prop('required',false);
	       	 }

	       }

      /* $('#dob').on('change',function(){
    		var today = new Date();
    		birthday_val = $("#dob").val();
    		todayYear = today.getFullYear();
    		todayMonth = today.getMonth();
    		todayDay = today.getDate();
            var dob = new Date(birthday_val);
            dobYear = dob.getFullYear();
            dobMonth = dob.getMonth();
            dobDay = dob.getDate();
            if(dobMonth > todayMonth || dobDay < todayDay)
            {
               yearDifference = todayYear-dobYear;
               yearDifference = yearDifference-1;
            }
            else
            {	
             yearDifference = todayYear-dobYear;
            }

            if( yearDifference < 18)
            {
               $('#submit').attr('type','button');

               alert('You should be 18 years or above to register & view this website');
            }
            else{
            	$('#submit').attr('type','submit');
            } 
       $('#age').val(yearDifference);

    	});
*/
       $('#malechildren,#femalechildren').change(function(){
     
           if($('#malechildren').val() == 0)
           	var a = 0;
           else
           	var a = parseInt($('#malechildren').val(),10);

           if($('#femalechildren').val() == 0)
            var b = 0;
           else
           	var b = parseInt($('#femalechildren').val(),10);

           $('#totalchildren').val(a+b);
  
    	});

       	$('#gender').change(function()
    	{
    		if($('#gender').val() == 'Others')
    	  {		
            $('#occupation1').prop('required', true);
            $('#occupation').prop('required',false);
            $('#referralPoint').prop('required',false);
            $('#referralPoint1').prop('required',true);
            $('#secondaryIdentity').prop('required',false);
            $('#secondaryIdentity1').prop('required',true);
            $('#primaryIdentity1').prop('required',true);
            $('#primaryIdentity').prop('required',false);
           $('#maritalStatus').prop('required',false);
           $('#maritalStatus1').prop('required',true);
          } 
    	});

    	$('#name').change(function(){
    		var name = $('#name').val();

    		var nameAlias = $('#nameAlias').val();
 
               if(name != '')
               {
               	 $('#name').prop('required',true);
               	 $('#nameAlias').prop('required',false);
               }else{
               	$('#name').prop('required',false);
               	 $('#nameAlias').prop('required',false);
               }
    	});

    	$('#nameAlias').change(function(){
    		var name = $('#name').val();

    		var nameAlias = $('#nameAlias').val();
 
               if(nameAlias != '')
               {
               	 $('#name').prop('required',false);
               	 $('#nameAlias').prop('required',true);
               }else{
               	$('#name').prop('required',false);
               	 $('#nameAlias').prop('required',false);
               }
    	});

    	$('#mobileNo').change(function(){
    		var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
    			alert('Mobile Number should have atleast 10 digits');
    			checkMobile
    			$('#submit').attr('type','button');
    		}else{
    			//$('#mobileSpan').css('display','none');
    			$('#submit').attr('type','submit');
    		}	
    	});

    	$('#submit').click(function(){

    		var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
                 $('#submit').attr('type','button');
    			alert('Mobile Number should have atleast 10 digits')
    			
    		}else{
                $('#submit').attr('type','submit');
    		}	
    	});

       $("form[id='userForm']").submit(function(event){

           var mobileNo = $('#mobileNo').val();

    		if(mobileNo != '' && mobileNo.length != 10)
    		{
    			//$('#mobileSpan').css('display','block');
    			event.preventDefault();
    			alert('Mobile Number should have atleast 10 digits')
    			
    		}

       if($('#name').val() == '' && $('#nameAlias').val() == '')
       {
       	  event.preventDefault();
       	  alert('you need to enter either Name or Name alias to register');
       }

      if($('#confirm').prop('checked') == false ||  $('#consent').prop('checked') == false)
      { 	
       	event.preventDefault();
         alert('click to agree with terms and conditions');
        } 
       });


       function checkdofps(){
       //	alert("function");
       		var dofps=$('#DOFPS').val();
       		var regDate=$('#regDate').val();
       		var saictcDate=$('#SAICTCDATE').val();
       		var hivDate=$('#HIVDATE').val();
       		var testreportDate=$('#TRITC').val();
       		var artDate=$('#ARTRD').val();

       		if(regDate!='' && dofps<regDate){
       			alert("Date of Finger Prick Screening should be greater than"+"\n"+"Date of Registeration!!!");
       			$('#DOFPS').val('');
       		}

       		if(saictcDate!=''&& dofps!='' && saictcDate<dofps){
       			alert("Date of Out-referral to SA-ICTC should be greater than\nDate of finger prick Screening!!!");
       			$('#SAICTCDATE').val('');
       		}

       		if(saictcDate!='' && hivDate!='' && hivDate<saictcDate){
       				alert("Date of HIV Confirmation Test should be greater than\nDate of Out-referral to SA-ICTC!!!");
       				$('#HIVDATE').val('');		
       		}

       		if(testreportDate!='' && hivDate!='' && testreportDate<hivDate){
       			alert("Date of Test Report Issued to Client should be greater than\nDate of HIV Confirmation Test!!!");
       			$('#TRITC').val('');
       		}

       		if(hivDate!='' && artDate!='' && artDate<hivDate){
       			alert("Art Registeration Date should be greater than\nDate of HIV Confirmation test!!!");
       			$('#ARTRD').val('');
       		}



       }

    		
    	//});
    </script>
   <!-- <script type="text/javascript">
    function getDistrict{
    		var stateId = $('#state').val();

    		//alert(stateId);
	     $("#aaaa").html('');
	  $.ajax({
			type: "POST",
			url: "getDistrict",
			data: {state:state},
			success: function(data) {
				//alert(data);
				var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					
					var htm = '';
						htm += '<select class="form-control"  name="districtId" id="sl2"><option value="" readonly>No District</option></select>';
						$("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select class="form-control"  name="districtId"  id="sl2"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						$("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
		
					
					
				}
			}
		}); }

    </script>-->

	<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->
		
		
		
		
