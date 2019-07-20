<style>
.none{
	display:none !important;
}


</style>
<div <?php if(!empty($er)){?> style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/user"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 color:red;" class="modal-title"><?php if(!empty($total_error)){echo $total_error;}  ?></h4>
			</div>
			<div class="modal-body" style="height:35vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
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
													<th>Secondary Identity</th>
													<th>Secondary Identity Other</th>
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
													<th>Remarks</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color: red;"><?php echo $value['error']?></td>
							<td><?php echo $value['userName'] ;?>
							
							<td><?php echo $value['name'] ?>
							<td><?php echo  $value['nameAlias'] ; ?>
							<td><?php echo  $value['dob']  ?>
							<td><?php echo  $value['age']?>
							<td><?php echo  $value['mobileNo']  ?>
							<td><?php echo  $value['address'] ?>
							<td><?php echo  $value['educationalLevel']  ?>
							<td><?php echo $value['occupation'] ?>
							<td><?php echo $value['occupation_other']?>
							<td><?php echo $value['monthlyIncome']?>
							<td><?php echo $value['maritalStatus'] ?>
							<td><?php echo $value['maritalStatus_other']  ?>
							<td><?php echo $value['male_children']  ?>
							<td><?php echo  $value['female_children'] ?>
							<td><?php echo $value['total_children']  ?>
							<td><?php echo  $value['state'];?>
							<td><?php echo  $value['districtId'] ?>
							<td><?php echo $value['addressState']  ?>
							<td><?php echo $value['addressDistrict'] ?>
									 
						    <td><?php echo  $value['secondaryIdentity']  ?>
							<td><?php echo $value['secondaryIdentity_other'] ?>
							<td><?php echo $value['shareInfoAboutSexualBehaviour']  ?>
							<td><?php echo  $value['multipleSexPartner']  ?>
							<td><?php echo  $value['sought'] ?>
						    <td><?php echo $value['sexualBehaviour']  ?>
							<td><?php echo $value['prefferedSexualAct'] ?>
						    <td><?php echo $value['condomUsage']?>
							<td><?php echo  $value['substanceUse']  ?>
							<td><?php echo $value['hivTestResult']  ?>
							<td><?php echo $value['hivTestTime'] ?>
							<td><?php echo $value['pastHivReport']  ?>
							<td><?php echo $value['remark']?>
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
                            <h5>Active User List</h5>
                            <div class="ibox-tools">
                            		<form method="POST" action="<?php echo base_url()?>index.php/home/downloadUserData">
									<input type="hidden" name="excelPage" value="active">
									<input type="hidden" name="exceldaterange" value="<?php echo $exceldaterange;?>">
									<input type="hidden" name="wildcard" value="<?php echo $wildcard?>">
									<input type="hidden" name="userBy" value="<?php echo $userBy?>">
									<input type="hidden" name="stateExcel" value="<?php echo $stateFilter?>">
									<?php $districts = explode(',',$districtFilter); foreach ($districts as $key => $value) { ?>
										<input type="hidden" name="districtExcel[]" value="<?php echo $value?>">
								     <?php	} ?>
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
                        		</div>
                        		<div class="col-sm-3">
												<button class="btn btn-primary" type="submit"  >Submit</button>
											</div>
                        	</form>
                        	</div>
                        </div>
                        <div class="ibox-content">
                        	<i style="color: red;">Users created in last 30 days are displayed by default.</i>
                        	<i style="color: red;float: right;">This will search only in data displayed on screen here</i>
                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
													
													
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
													<td><?php echo $value['registrationNumber'] ?></td>
													  <td><?php echo $value['campCode']?></td>
													<td><?php echo $value['userUniqueId']; ?></td>
                                                    <td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['nameAlias']; ?></td>
													<td><?php echo date('d M Y',strtotime($value['dob']));?></td>
													<td><?php echo $value['age']; ?></td>
													<td><?php echo $value['gender']?></td>
													<td><?php echo $value['mobileNo']; ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['addressState1']?></td>
													<td><?php echo $value['addressDistrict1']?></td>
													<td><?php echo $value['educationalLevel']?></td>
													<td><?php echo $value['occupation']?></td>
													<td><?php echo $value['occupation_other']?></td>
													<!-- <td><?php echo $value['domainOfWork']?></td> -->
													<td><?php echo $value['monthlyIncome']?></td>
													<td><?php echo $value['maritalStatus']?></td>
													<td><?php echo $value['maritalStatus_other']?></td>
													<td><?php echo $value['male_children']?></td>
													<td><?php echo $value['female_children']?></td>
													<td><?php echo $value['total_children']?></td>
													<td><?php echo $value['state1']?></td>
													<td><?php echo $value['district1']?></td>
													<td><?php echo $value['secondaryIdentity']?></td>
													<td><?php echo $value['secondaryIdentity_other']?></td>
													<td><?php echo $value['referralPoint']?></td>
													<td><?php echo $value['referralPoint_others']?></td>
													<td><?php echo $value['sexualBehaviour']?></td>
													<td><?php echo $value['multipleSexPartner']?></td>
													<td><?php echo $value['sought']?></td>
													<td><?php echo $value['prefferedGender']?></td>
													<td><?php echo $value['prefferedSexualAct']?></td>
													<td><?php echo $value['condomUsage']?></td>
                                                    <td><?php echo $value['substanceUse']?></td>
                                                    <td><?php echo $value['hivTestResult']?></td>
                                                    <td><?php echo $value['testHiv']?></td>
                                                    <td><?php echo $value['pastHivReport']?></td>
                                                    <td><?php echo $value['fingerDate']?></td>
                                                    <td><?php echo $value['saictcStatus']?></td>
                                                    <td><?php echo $value['saictcDate']?></td>
                                                    <td><?php echo $value['saictcPlace']?></td>
                                                    <td><?php echo $value['ictcNumber']?></td>
                                                    <td><?php echo $value['hivDate']?></td>
                                                    <td><?php echo $value['hivStatus']?></td>
                                                    <td><?php echo $value['reportIssuedDate']?></td>
                                                    <td><?php echo $value['reportStatus']?></td>
                                                    <td><?php echo $value['remarks']?></td>
                                                  
                                                    <td><?php echo $value['registeredBy']?></td>
                                                    <td><?php echo $value['registeredOn']?></td>
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
													<th>Registration Number</th>	
													<th>UniqueId</th>
                                                    <th>User Name</th>
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
														<th>Secondary Identity</th>
													<th>Secondary Identity Other</th>
													<th>Referral Point</th>
													<th>Referral Point Other</th>
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
													<th>Date of Out-referral to SA-ICTC</th>
													<th>Place of SA-ICTC Referred</th>
													<th>ICTC -PID Number</th>
													<th>Date of HIV Confirmation Test</th>
													<th>Result of HIV Confirmatory Test</th>
													<th>Date of Test Report Issued to Client</th>
													<th>Status of HIV Confirmation Report</th>
													<th>Remarks</th>
													<th>Camp Code</th>
													<th>Registered By</th>
													<th>Registered On</th>
													<th>Created By</th>
													<th>Create Date</th>
													<th class="text-right footable-visible footable-last-column" background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php if(!empty($inactiveuserList)){?>	
												<?php foreach($inactiveuserList as $value) { ?>
                                                <tr id="row<?php echo $value['userId']; ?>">
													<td><?php echo $value['userUniqueId']; ?></td>
                                                    <td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['nameAlias']; ?></td>
													<td><?php echo date('d M Y',strtotime($value['dob']));?></td>
													<td><?php echo $value['age']; ?></td>
													<td><?php echo $value['mobileNo']; ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['addressState1']?></td>
													<td><?php echo $value['addressDistrict1']?></td>
													<td><?php echo $value['educationalLevel']?></td>
													<td><?php echo $value['occupation']?></td>
													<td><?php echo $value['occupation_other']?></td>
													<td><?php echo $value['monthlyIncome']?></td>
													<td><?php echo $value['maritalStatus']?></td>
													<td><?php echo $value['maritalStatus_other']?></td>
													<td><?php echo $value['male_children']?></td>
													<td><?php echo $value['female_children']?></td>
													<td><?php echo $value['total_children']?></td>
													<td><?php echo $value['state1']?></td>
													<td><?php echo $value['district1']?></td>
													<td><?php echo $value['secondaryIdentity']?></td>
													<td><?php echo $value['secondaryIdentity_other']?></td>
													<td><?php echo $value['referralPoint']?></td>
													<td><?php echo $value['referralPoint_others']?></td>
													<td><?php echo $value['sexualBehaviour']?></td>
													<td><?php echo $value['multipleSexPartner']?></td>
													<td><?php echo $value['sought']?></td>
													<td><?php echo $value['prefferedGender']?></td>
													<td><?php echo $value['prefferedSexualAct']?></td>
													<td><?php echo $value['condomUsage']?></td>
                                                    <td><?php echo $value['substanceUse']?></td>
                                                    <td><?php echo $value['hivTestResult']?></td>
                                                    <td><?php echo $value['testHiv']?></td>
                                                    <td><?php echo $value['pastHivReport']?></td>
                                                    <td><?php echo $value['fingerDate']?></td>
                                                    <td><?php echo $value['saictcStatus']?></td>
                                                    <td><?php echo $value['saictcDate']?></td>
                                                    <td><?php echo $value['saictcPlace']?></td>
                                                    <td><?php echo $value['ictcNumber']?></td>
                                                    <td><?php echo $value['hivDate']?></td>
                                                    <td><?php echo $value['hivStatus']?></td>
                                                    <td><?php echo $value['reportIssuedDate']?></td>
                                                    <td><?php echo $value['reportStatus']?></td>
                                                    <td><?php echo $value['remarks']?></td>
                                                    <td><?php echo $value['campCode']?></td>
                                                    <td><?php echo $value['registeredBy']?></td>
                                                    <td><?php echo $value['registeredOn']?></td>
                                                    <td><?php if(!empty($value['createdBy'])){ $res = $role_master->userById($value['createdBy']); echo $res[0]['userName']; } ?></td>
                                                    <td><?php echo date('d M Y h:i a',strtotime($value['createdDate']))?></td>												<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['userId']; ?>,'userId','tbl_user')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>
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
						   <form method="post"  class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelUser" >
							   <div class="form-group" margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import User Excel</label>
										   <div class="col-sm-8" display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/user_excel_format" class="btn btn-primary" margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
                        
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" id="userForm" onsubmit="return checkAge() && formValidation();" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addUser/<?php if(!empty($userById)){echo $userById[0]['userId']; }?>">
                          	<?php if(empty($userById)){?><span style="color: red">User mobile number will be by default User login username</span><br><?php }?>
                          	<?php if(!empty($userById)){?>
                          	<div class="form-group">
									<div class="col-sm-12">
										<div class="col-sm-2">
										<label class="control-label">User Unique Id</label>
									</div>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="uniqueId" readonly id="uniqueId" value="<?php if(!empty($userById)){echo $userById[0]['userUniqueId'];} ?>" required>
										</div>
									</div>
									
								</div>
							<?php }?>

							<?php //if(!empty($userById)){?>
                          				<div class="form-group">
									<div class="col-sm-12">
										<div class="col-sm-2">
										<label class="control-label">User Name</label>
									</div>
										<div class="col-sm-10">
											<input type="text" onchange="checkName()" readonly class="form-control"  name="userName" id="userName" value="" required>
											<span style="color:red;display: none;" id="spanUser">User Name already exist</span>
										</div>
									</div>
									
								</div>
							<?php //}?>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" name="password" id="password" value="" required>
										</div>
									</div>
								<?php //if(empty($userById)){?>	
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Confirm Password</label>
										<div class="col-sm-10">
                                         <input type="password" name="password" id="cpassword" tabindex="4" class="form-control"   required>
											<p style="display: none;color: red;" id="spanPassword">password does not match</p>
										</div>
									</div>
								<?php //}?>	
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
						          <div class=" col-sm-6" >
						 	        <label class=" col-sm-2 control-label">Name<span>*</span></label>
						 	        <div class="col-sm-10">
						 	          <input type="text"  name="name" tabindex="5" value="" class="form-control" id="name" >
						 	      </div>
						         </div>	
						       <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Name (Alias)<span>*</span></label>
						 	      <div class="col-sm-10">
						 	         <input type="text" name="nameAlias" value="" id="nameAlias" tabindex="6" class="form-control" > 
						 	      </div>
						       </div>
					         </div>
							  
								
								<div class="hr-line-dashed"></div>
								 <div class="form-group">
							     <div class=" col-sm-6" >
                                  <label class="col-sm-2 control-label">Date Of Birth<span>*</span></label>
                                  <div class="col-sm-10">
						 	       <input type="text"  name="dob" id="dob" value="" tabindex="7" class="form-control" required>
						 	     </div>
						       </div>	
							  <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Age<span>*</span></label>
						 	     <div class="col-sm-10">
						 	     <input type="text" name="age" value="" readonly id="age" tabindex="8" class="form-control" required>
						 	 </div>
						    </div>		
					       </div>
								
							<div class="hr-line-dashed"></div>
							
							<div class="form-group"> 
						        <div class=" col-sm-6">
						 	      <label class="col-sm-2 control-label">Mobile Number (to receive OTP)<span>*</span></label>
						 	      <div class="col-sm-10">
						 	          <div class="row">
						 	     				<input style="width: 14%;float: left;" type="text" id="" disabled="" name="" placeholder="+91-"  class="form-control" onkeypress="return isNumberKey(event)" required="">
						 	      <input type="text" value="" style="width: 80%" id="mobileNo" name="mobileNo" onchange="checkMobile()" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" tabindex="9" required>
							  <p style="display: none;"  id="mobileSpan">Mobile number should have atleast 10 digits</p>
							</div>
							</div>
						 </div>
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Current Address<span>*</span></label>
						 	<div class="col-sm-10">
						 	<input type="text" id="address"  name="address" value="" tabindex="10" class="form-control" required>
						 </div>
						 </div>	
					   </div>
															
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						          <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">State<span>*</span></label>
						 	         <div class="col-sm-10">
						 	          <select class="form-control" onchange="getAddressDistrict()"  tabindex="11"  id="state1" name="addressState" required>
						 		       <option value="" >Select State</option>
									     <?php foreach($stateList as $data){ ?>
									       <option value="<?php echo $data['stateId']; ?>" ><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	         </select>
						 	     </div>
						          </div>
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">District<span>*</span></label>
						 	<div class="col-sm-10">	
						 	<select name="addressDistrict" tabindex="12" id="districtId1" class="form-control">
									<option value="" readonly>Select District</option>							
							</select>
							</div>	
						 </div>	
					</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"> 
							   <div class="row">		
						 	     <div class=" col-sm-12" >
						 	     	<div class="col-sm-2">
						 	        <label class="control-label">Education</label>
						 	        </div>
						 	        <div class="col-sm-10">
						 	         <select name="education" tabindex="13" class="form-control" id="education" >
						 		        <option value="" readonly>Select Education</option>
						 		        <option value="Literate" >Pre Literate</option>
						 		        <option value="Primary(1-5)" >Primary(1-5)</option>
						 		        <option value="Secondary(6-10)" >Secondary(6-10)</option>
						 		        <option value="Higher Secondary"  >Higher Secondary</option>
						 		      <!--   <option value="Secondary" ></option> -->
						 		        <option value="Graduation and above" >Graduation and Above</option>
						 		        <option value="Non formal education" >Non formal education</option>
						 	     </select>
						 	    </div>
						     </div>
					     </div>
					 </div>
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
							      <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">Occupation</label>
						 	         <div class="col-sm-10">
						 	           <select name="" tabindex="14" class="form-control" id="occupation" >
						 		         <option value="" readonly>Select Occupation</option>
						 		         <option value="Salaried" >Salaried</option>
						 		          <option value="Self"  >Self</option>
						 		          <option value="employed"  >employed</option>
						 		          <option value="Daily"  >Daily</option>
						 		          <option value="Wage" >Wage</option>
						 		          <option value="Student"  >Student</option>
						 		          <option value="Sex"  >Sex</option>
						 		          <option value="Work"  >Work</option>
						 		          <option value="Badhai"  >Badhai</option>
						 		          <option value="Mangt"  >Mangt</option>
						 		          <option value="Dancing"  >Dancing</option>
						 		          <option value="Truckers"  >Truckers</option>
						 		          <option value="Migrant">Migrant</option>
						 		          <option value="Drivers">Drivers</option>
						 		          <option value="Other"  >Other</option>
						 	          </select>
						 	      </div>
						         </div>
						     <div class=" col-sm-6" >
						 	   <label class="col-sm-2 control-label">Occupation-Others</label>
						 	   <div class="col-sm-10">
						 	    <input type="text" name="occupation1" value="<?php echo $userById[0]['occupation_other']?>" tabindex="15" id="occupation1" class="form-control">
						 	</div>
						    </div>
					    </div>

					    <div class="hr-line-dashed"></div>

								<div class="form-group">
							      <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">HRG</label>
						 	         <div class="col-sm-10">
						 	           <select name="hrg" tabindex="16" class="form-control" id="hrg" >
						 		      <option value="">-select-</option>
						 		      <option value="MSM" >MSM</option>
						 		      <option value="TG(M-F)" >TG(M-F)</option>
						 		      <option value="TG(F-M)" >TG(F-M)</option>
						 		      <option value="FSW" >FSW</option>
						 		      <option value="IDU" >IDU</option>
						 	          </select>
						 	      </div>
						         </div>
						     <div class=" col-sm-6" >
						 	   <label class="col-sm-2 control-label">ARG</label>
						 	   <div class="col-sm-10">
						 	    <select name="arg" tabindex="17" class="form-control" id="arg" >
						 	    	<option value="">-select-</option>
						 	    	<option>Single Male migrant</option>
						 	    	<option>Trucker</option>
						 	    	<option>Partner / Spouse of FSW</option>
						 	    	<option>Have multiple partners </option>
						 	    	<option>Female partner (FPARG)</option>
						 	    	<option>Female Partner (FMHRG)</option>
						 	    </select>
						 	</div>
						    </div>
					    </div>
															
								<div class="hr-line-dashed"></div>
								<div class="form-group">
						<div class="row">
						<div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Monthly Income</label>
						 	<div class="col-sm-10">
						 	<select name="monthlyIncome" tabindex="16"  class="form-control" id="monthly Income" >
						 		<option value="">Select Income</option>
						 		<option value=">1000"> > 1000</option>
						 		<option value="1001-5000"  >1001-5000</option>
						 		<option value="5001-10000"  >5001-10000</option>
						 		<option value="Above 10000"  >Above 10000</option>
						 	</select>
						 </div>
						 </div>
							 	
						</div>
					</div>
								
					<div class="hr-line-dashed"></div>

								<div class="form-group">
						           <div class=" col-sm-6" >
						 	           <label class="col-sm-2 control-label">Marital Status</label>
						 	           <div class="col-sm-10">
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
						           </div>	
						         <div class=" col-sm-6" >
						 	         <label class="col-sm-2 control-label">Marital Status-Others</label>
						 	         <div class="col-sm-10">
						 	         	<input type="text" name="maritalStatus1" class="form-control" id="maritalStatus1" >
						 	            <!-- <select name="" id="maritalStatus1" tabindex="19" class="form-control">
						 		           <option value="">Select Marital Status</option>
						 		           <option value="Married" <?php if($userById[0]['maritalStatus_other'] == 'Married'){echo 'selected';}?>>Married</option>
						 		           <option value="Divorced" <?php if($userById[0]['maritalStatus_other'] == 'Divcorced'){echo 'selected';}?>>Divcored</option>
						 		           <option value="Widow/Widower" <?php if($userById[0]['maritalStatus_other'] == 'Widow/Widower'){echo 'selected';}?>>Widow/Widower</option>
						 		           <option value="Unmarried" <?php if($userById[0]['maritalStatus_other'] == 'Unmarried'){echo 'selected';}?>>Unmarried</option>
						 		            <option value="Separated" <?php if($userById[0]['maritalStatus_other'] == 'Separated'){echo 'selected';}?>>Separated</option>
						 	          </select> -->
						 	      </div>
						         </div>
					         </div>
								
								 <div class="hr-line-dashed"></div>

								<div class="form-group">
						<div class="row">
						 <div class=" col-sm-4" >
						 	<label class="col-sm-2 control-label">Male Children</label>
						 	<input type="text" id="malechildren" tabindex="20" name="malechildren" id="malechildren" class="form-control" value="" onkeypress="return isNumberKey(event)" >
						 </div>	
						 <div class=" col-sm-4" >
						 	<label class="col-sm-2 control-label">Female Children</label>
						 	<input type="text" id="femalechildren" tabindex="21" name="femalechildren" id="femalechildren" class="form-control" value="" onkeypress="return isNumberKey(event)">
						 </div>
                          <div class=" col-sm-4" >
						 	<label class="col-sm-2 control-label">Total Chidren</label>
						 	<input type="text" id="totalchildren" value="" tabindex="22" name="totalchildren" id="totalchildren" class="form-control" onkeypress="return isNumberKey(event)" readonly="">
						 </div>
							</div>
						</div> 
								
									
								<div class="hr-line-dashed"></div>

									<div class="form-group">
						              <div class=" col-sm-6" >
						                <label class="col-sm-2 control-label">Native State<span></span></label>
						                <div class="col-sm-10">
						                  <select class="form-control" onchange="getDistrict()" tabindex="23"  id="state" name="state">
						 		               <option value="" readonly >Select State</option>
									      <?php foreach($stateList as $data){ ?>
									         <option value="<?php echo $data['stateId']; ?>" <?php if($data['stateId'] == $userById[0]['state']){echo 'selected';}?>><?php echo $data['stateName']; ?></option>
								         <?php } ?>									
						 	            </select>
						 	        </div>
						            </div>	
						             <div class=" col-sm-6" >
						 	           <label class="col-sm-2 control-label">Native District<span></span></label>
						 	           <div class="col-sm-10">
						               <div id="aaaa">	
						 	            <select name="districtId" tabindex="24" id="districtId" class="form-control">
									     <option value="" readonly>Select District</option>							
								       </select>
						              </div>
						              </div>		
						            </div>
					              </div>

					              <div class="hr-line-dashed"></div>

									<div class="form-group">
						              <div class=" col-sm-6" >
						                <label class="col-sm-2 control-label">Referral Points<span></span></label>
						                <div class="col-sm-10">
						                  <select class="form-control" onchange="getDistrict()" tabindex="23"  id="" name="state">
						 		               <option value="">-select-</option>
									           <option >Construction Site</option>
									           <option>Youth Club</option>
								               <option>Hotspot</option> 	
								               <option>Truckers Point</option>					
								               <option>Others</option>				
						 	            </select>
						 	        </div>
						            </div>	
						             <div class=" col-sm-6" >
						 	           <label class="col-sm-2 control-label">Referral Points- Others<span></span></label>
						 	           <div class="col-sm-10">
						               <input type="text" name="" class="form-control">
						              </div>		
						            </div>
					              </div>	
								
								<!--<div class="hr-line-dashed"></div>

								<div class="form-group">
						         <div class=" col-sm-6" >
						 	        <label class="col-sm-2 control-label">Secondary Identity</label>
						 	        <div class="col-sm-10">
						 	         <select name="secondaryIdentity" tabindex="25" class="form-control" id="secondaryIdentity" >
						 		       <option value="">Select Secondary Identity</option>
						 		       <option value="MSM">MSM</option>
						 		       <option value="TG(M-F)">TG(M-F)</option>
						 		       <option value="TG(F-M)">TG(F-M)</option>
						 		       <option value="Female Partner(ARG)">Female Partner(ARG)</option>
						 		       <option value="Female Partner(HRG)">Female Partner(HRG)</option>
						 		       <option value="FSW">FSW</option>
						 		       <option value="IDU">IDU</option>
						 		     <option value="Others">Others</option>
						 	   </select>
						 	  </div>
						    </div>		
						 <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Secondary Identity-Others</label>
						 	<div class="col-sm-10">
						 	<input type="text" name="secondaryIdentity1" tabindex="26" id="secondaryIdentity1" class="form-control">
						 </div>
						 </div>
					</div>-->
								
								<div class="hr-line-dashed"></div>

								<div class="form-group">
						         <div class=" col-sm-6" >
						 	     <label class="col-sm-2 control-label">Like to share information about sexual behaviour </label>
						 	     <div class="col-sm-10">
						 	        <select name="sexualBehaviour" tabindex="27" class="form-control" id="sexualBehaviour" >
						 		      <option value="" readonly>Select to share information</option>
						 		       <option value="Yes">Yes</option>
						 		        <option value="No">No</option>
						 	      </select>
						 	     </div>
						      </div>	
						      <div class=" col-sm-6" >
						 	     <label class="control-label">Have multiple sex partner</label>
						 	     <div class="col-sm-10">
						 	       <select name="col-sm-2 multipleSexPartner" tabindex="28" class="form-control" id="multipleSexPartner" >
						 		      <option value="" readonly>Select</option>
						 		      <option value="Yes">Yes</option>
						 		      <option value="No">No</option>
						 	      </select>
						 	  </div>
						    </div>	
					     </div>
								
								<div class="hr-line-dashed"></div>	

							  <div class="form-group">
						         <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Ever Sought paid sex</label>
						 	       <div class="col-sm-10">
						 	       <select name="sought" tabindex="29" class="form-control" id="sought" >
						 		      <option value="" >-select-</option>
						 		      <option value="Yes">Yes</option>
						 		     <option value="No">No</option>
						 	      </select>
						 	     </div>
						       </div>	
						       <div class=" col-sm-6" >
						 	    <label class="col-sm-2 control-label">Status of condom usage</label>
						 	    <div class="col-sm-10">
						 	       <select name="condomUsage" tabindex="30" class="form-control" id="condomUsage" >
						 		     <option value="" readonly>Select</option>
						 		     <option value="every sex">In every sex </option>
						 		     <option value="paid sex">In paid sex</option>
						 		     <option value="sometime">Sometime</option>
						 		     <option value="never">Never</option>
						 		     <option value="not aware">Not aware</option>
						 	</select>
						 </div>
						 </div>	
						   <!-- <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Preferred sex/Gender of sexual partner</label>
						 	<div class="col-sm-10">
						 	<select name="prefferedGender" tabindex="34" class="form-control" id="prefferedGender" >
						 		<option value="" readonly> Select</option>
						 		<option value="Male">Male</option>
						 		<option value="Female">Female</option>
						 		<option value="TG">TG</option>
						 		
						 	</select>
						 </div>
						 </div> -->
					</div>

								
							<div class="hr-line-dashed"></div>
								<div class="form-group">
						         <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Preferred sexual act</label>
						 	       <div class="col-sm-10">
						 	         <select name="prefferedSexualAct" multiple="" tabindex="35" class="chosen-select" id="prefferedSexualAct" >
						 		       <option value="" readonly>Select</option>
						 		        <option value="Oral">Oral</option>
						 		        <option value="Anal">Anal</option>
						 		        <option value="Vaginal">Vaginal</option>
						 	        </select>
						 	    </div>
						       </div>
						         <div class=" col-sm-6" >
						 	<label class="col-sm-2 control-label">Preferred sex/Gender of sexual partner</label>
						 	<div class="col-sm-10">
						 	<select name="prefferedGender" multiple="" tabindex="34" class="chosen-select" id="prefferedGender" >
						 		<option value="" readonly> Select</option>
						 		<option value="Male">Male</option>
						 		<option value="Female">Female</option>
						 		<option value="TG">TG</option>-
						 		
						 	
						 	</select>
						 </div>
						 </div>
                           

					</div>
							  
							  <div class="hr-line-dashed"></div> 

							  	<div class="form-group">
						           <div class=" col-sm-6" >
						 	          <label class="col-sm-2 control-label">Substance Use</label>
						 	          <div class="col-sm-10">
						 	            <select name="substanceUse" tabindex="31" class="form-control" id="substanceUse" >
									 		<option value="" readonly>Select</option>
									 		<option value="tabcoo">Tabcoo</option>
									 		<option value="drug">Drug</option>
									 		<option value="alcohol">Alcohl</option>	
						 	           </select>
						 	       </div>
						          </div>	
						          <div class=" col-sm-6" >
						 	    <label class="col-sm-2 control-label">Status of condom usage</label>
						 	    <div class="col-sm-10">
						 	       <select name="condomUsage" tabindex="30" class="form-control" id="condomUsage" >
						 		     <option value="" readonly>Select</option>
						 		     <option value="every sex">In every sex </option>
						 		     <option value="paid sex">In paid sex</option>
						 		     <option value="sometime">Sometime</option>
						 		     <option value="never">Never</option>
						 		     <option value="not aware">Not aware</option>
						 	</select>
						 </div>
						 </div>
						        <!-- <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Have you ever been tested for HIV before?</label>
						 	       <div class="col-sm-10">
						 	         <select name="testHiv" tabindex="32" class="form-control" id="testHiv" >
								 		<option value="" readonly>Select</option>
								 		<option value="Yes">Yes</option>
								 		<option value="No">No</option>
						 	       </select>
						 	   </div>
						      </div>	 -->
					    </div>



							  							  	
							  <div class="hr-line-dashed"></div>

							  <div class="form-group">
					             <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">If yes, When (Please mention how many months / year before)</label>
						 	       <div class="col-sm-10">
						 	        <select name="hivConfirmation" tabindex="33" class="form-control" id="hivConfirmation" >
						 		       <option value="" readonly>Select</option>
						 		       <option value="reactive">Reactive</option>
						 		       <option value="not-reactive">Not-reactive</option>
						 	        </select>
						 	       </div> 
						        </div>
						       <div class=" col-sm-6" >
						 	   	    <label class="col-sm-2 control-label">Past HIV Test Result</label>
						 	       <div class="col-sm-10">
						 	        <select name="pastHivReport" tabindex="33" class="form-control" id="pastHivReport" >
								 		<option value="" readonly>Select</option>
								 		<option value="reactive">Reactive</option>
								 		<option value="not-reactive">Not-reactive</option>
						 	       </select>
						 	   </div>
						      </div>
						      <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Have you ever been tested for HIV before?</label>
						 	       <div class="col-sm-10">
						 	         <select name="testHiv" tabindex="32" class="form-control" id="testHiv" >
								 		<option value="" readonly>Select</option>
								 		<option value="Yes">Yes</option>
								 		<option value="No">No</option>
						 	       </select>
						 	   </div>
						      </div>		
					       </div>
							  
							<!--  <div class="hr-line-dashed"></div>  -->

							 <!-- <div class="form-group">
						         <div class=" col-sm-6" >
						 	       <label class="col-sm-2 control-label">Past HIV Test Result</label>
						 	       <div class="col-sm-10">
						 	        <select name="pastHivReport" tabindex="33" class="form-control" id="pastHivReport" >
								 		<option value="" readonly>Select</option>
								 		<option value="reactive">Reactive</option>
								 		<option value="not-reactive">Not-reactive</option>
						 	       </select>
						 	   </div>
						        </div>
			                  <div class=" col-sm-6" >
							 	<label class="col-sm-2 control-label">Remarks</label>
							 	<div class="col-sm-10">
							 	<input type="text" name="remark" tabindex="17" id="remark" class="form-control">
							 	</div>					 
                              </div>		
					</div> -->

					<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Date of Finger Prick Screening</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
									<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
								<input type="text" name="fingerDate"  value="<?php if(!empty($userById[0]['fingerDate']) && $userById[0]['fingerDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['fingerDate'])); }?>" id="data_5" class="form-control input-daterange">
							</div>
							</div>
							</div>
					    </div>

					    <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Referred to SA-ICTC</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<!-- <input type="text" name="saictcRefer" value="<?php echo $userById[0]['saictcStatus'] ?>"  class="form-control"> -->
								<select class="form-control" >
									<option>-select-</option>
									<option>Yes</option>
									<option>No</option>
								</select>
							</div>
							</div>
					    </div>


					    <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Date of Out-referral to SA-ICTC</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="saictcDate" value="<?php if(!empty($userById[0]['saictcDate']) && $userById[0]['saictcDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['saictcDate'])); }?>"  class="form-control">
							</div>
							</div>
							</div>
							<div class=" col-sm-6" >
						 	      <label class="control-label">Place of SA-ICTC Referred</label>
						 	       <div class="col-sm-10">
						 	        <input type="text" name="saictcPlace" value="<?php echo $userById[0]['saictcPlace'] ?>" class="form-control">
						 	   </div>
						      </div>	
					    </div>

					     <div class="hr-line-dashed"></div>

						<div class="form-group">
							<!-- <div class=" col-sm-6">
								<label class="control-label">Place of SA-ICTC Referred</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="saictcPlace" value="<?php echo $userById[0]['saictcPlace'] ?>" class="form-control">
							</div>
							</div>
					    </div> -->

					       <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">ICTC -PID Number</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="ictcNumber" value="<?php echo $userById[0]['ictcNumber'] ?>" class="form-control">
							</div>
							</div>
					    </div>

					      <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Date of HIV Confirmation Test</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="hivDate"  value="<?php if(!empty($userById[0]['hivDate']) && $userById[0]['hivDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['hivDate'])); }?>"  class="form-control">
							</div>
							</div>
							</div>
					    </div>
							 
					 <div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Result of HIV Confirmatory Test</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<!-- <input type="text" name="hivStatus" value="<?php echo $userById[0]['hivStatus'] ?>" class="form-control"> -->
								<select class="form-control">
									<option >Reactive</option>
									<option >Non-Reactive</option>
								</select>
							</div>
							</div>
							<div class=" col-sm-6">
								 <label class="control-label">Upload ICTC test report scan</label> 
							 </div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								
												
								<input type="file" class="form-control" name="">
							
							</div>
							</div>
					    </div>

					     <div class="hr-line-dashed"></div>

				<div class="form-group">
							<div class=" col-sm-6">
								 <label class="control-label">Date of Test Report Issued to Client</label> 
							 </div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>	
								<input type="text" name="reportIssuedDate" value="<?php if(!empty($userById[0]['reportIssuedDate']) && $userById[0]['reportIssuedDate'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['reportIssuedDate'])); }?>"  class="form-control">
							</div>
							</div>
							</div>
					</div>
							
							 
					<div class="hr-line-dashed"></div>

				  <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Status Of HIV Confirmation on Report</label>
					</div>
					<div class=" col-sm-6">
						<select class="form-control">
							<option value="">-select</option>
							<option>Received by Community</option>
							<option>Migrated</option>
							<option> Non Acceptance</option>
							<option>Died</option>
						</select>
					</div>
				</div>
							 
				<!-- <div class="hr-line-dashed"></div>

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Referred To ART Center</label>
					</div>
					<div class=" col-sm-6">
					<div class="col-sm-10">
					<input type="text" name="artCenter" class="form-control">
				   </div>
					</div>
				</div> -->
							 
				
					<div class="hr-line-dashed"></div>

				<!-- <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Created By</label>
					</div>
						<div class=" col-sm-6">
						 <select class="form-control" name="createdBy">
						 	<option>-select created by-</option>
						 	<option value="1" <?php if($userById[0]['createdBy'] == '1'){ echo 'selected'; }?>>admin</option>
                        	<?php foreach($empUser as $data){?>
                        	<option value="<?php echo $data['userId']?>" <?php if($userById[0]['createdBy'] == $data['userId']){ echo 'selected'; }?>><?php echo $data['userName']?></option>	
                        	<?php }?>
						 </select>
					   </div>
						
					</div>  -->
							 

				  <div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">ART Number</label>
							</div>
							<div class=" col-sm-6">
								<div class="col-sm-10">
								<input type="text" name="artNumber" class="form-control">
							</div>
							</div>
					</div>
							 
					<div class="hr-line-dashed"></div>

					<div class="form-group">
							<div class=" col-sm-6">
								<label class="col-sm-2 control-label">Status Of CD4 Test</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="cd4Status" class="form-control">
							</div>
						
					</div>
							  
					<div class="hr-line-dashed"></div>

				  <div class="form-group">
							<div class="col-sm-6">
								<label class="control-label">Baseline CD4 Count</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="cd4Result" class="form-control">
							</div>
					</div>
							  
				<div class="hr-line-dashed"></div>

				 <div class="form-group">
							<div class="col-sm-6">
								<label class="control-label">Status of Client</label>
							</div>
							<div class="col-sm-6">
								<input type="text" name="clientStatus" class="form-control">
							</div>
					</div>
							  
				<div class="hr-line-dashed"></div>


				<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Status Of ART Intake</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="artStatus" class="form-control">
							</div>
					</div>
							 
					<div class="hr-line-dashed"></div>

					<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Tested For Syphilis</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="syphilisTest" class="form-control">
							</div>
					</div>
							
					<div class="hr-line-dashed"></div>

						<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Result For TB Test</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="syphilisResult" class="form-control">
							</div>
						
					</div>
							
					<div class="hr-line-dashed"></div>

					<div class="form-group">
							<div class=" col-sm-6">
								<label class="control-label">Tested for TB</label>
							</div>
							<div class=" col-sm-6">
								<input type="text" name="tbTest" class="form-control">
							</div>
					</div>
							
				<div class="hr-line-dashed"></div>
							   
				  <div class="form-group">
					<div class=" col-sm-6">
						<label class="col-sm-2 control-label">Result For TB Test</label>
					</div>
				  <div class=" col-sm-6">
					<input type="text" name="tbResult" class="form-control">
				</div>
			</div>
							 
				<div class="hr-line-dashed"></div>

				 <div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">If Yes,Referred To RNTCP</label>
					</div>
					<div class=" col-sm-6">
						<input type="text" name="rntcpRefer" class="form-control">
					</div>
				</div> 
							  

			 <div class="form-group">
			 	<div class=" col-sm-6">
						<label class="control-label">Camp Code</label>
					</div>
						<div class=" col-sm-6">
						  <input type="text" name="campCode" value="<?php echo $userById[0]['campCode'] ?>" class="form-control">
					   </div>
			 </div>	

			 <div class="hr-line-dashed"></div>			 

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Registered By</label>
					</div>
						<div class=" col-sm-6">
						  <input type="text" name="registeredBy" value="<?php echo $userById[0]['registeredBy'] ?>" class="form-control">
					   </div>
						
					</div> 
        <div class="hr-line-dashed"></div>

						<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Registered On</label>
					</div>
						<div class=" col-sm-6">
						<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>		
						<input type="text" name="registeredOn" value="<?php if(!empty($userById[0]['registeredOn']) && $userById[0]['registeredOn'] != '0000-00-00'){ echo date('d-m-Y',strtotime($userById[0]['registeredOn'])); }?>"  class="form-control">				
						</div>	  
					</div>
						
					</div> 
							 				 
							 
			  <div class="hr-line-dashed"></div>

				<div class="form-group">
					<div class=" col-sm-6">
						<label class="control-label">Remark	</label>
					</div>
						<div class=" col-sm-6">
						  <input type="text" name="remark" class="form-control">
					   </div>
						
					</div> 
							 
							  
							 
															
								
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
            $('#dob').datepicker({changeYear: true, changeMonth: true});
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
      	var today = new Date();
      	birthday_val = $('#dob').val();

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

    		if(age < 18)
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

    		

/*       $('#cpassword').change(function(){
        
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
       });*/

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
		
		
		
		
