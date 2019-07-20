<style>
.none{
	display:none !important;
}
</style>
<div <?php if(!empty($er)){?>style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/user"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php if(!empty($total_error)){echo $total_error;}  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td><?php echo $value['error']?></td>
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
							<ul class="nav nav-tabs" style="background-color:white;">
                                 <li class="<?php if(!empty($userById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>User List</a></li>
								 <li class="<?php if(!empty($userById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($userById)){ echo ''; }else { echo 'active'; } ?>">
						   <div class="ibox-title">
                            <h5>User List</h5>
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
													<th>UniqueId</th>
                                                    <th>User Name</th>
													<th>Password</th>
													<th>Name</th>
													<th>Name Alias</th>
													<th>Domain of Work</th>
													<th>Monthly Income</th>
													<th>No of Children</th>
													<th>Address</th>
													<th>Primary Identity</th>
													<th>Secondary Identity</th>
													<th>HIV History</th>
													<th>Gender</th>
													<th>Email</th>
													<th>Age</th>
													<th>Occupation</th>
													<th>Educational Level</th>
													<th>District</th>
													<th>State</th>
													<th>Place Of Origin</th>
													<th>Mobile No</th>
													<th>Marital Status</th>
													<th>Sexual Behaviour</th>
													<th>Hardware</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($userList as $value) { ?>
                                                <tr id="row<?php echo $value['userId']; ?>">
													<td><?php echo $value['userUniqueId']; ?></td>
                                                    <td><?php echo $value['userName']; ?></td>
													<td><?php echo $value['password']; ?></td>
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['nameAlias']; ?></td>
													<td><?php echo $value['domainOfWork']; ?></td>
													<td><?php echo $value['monthlyIncome']; ?></td>
													<td><?php echo $value['noOfChildren']; ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['primaryIdentity']; ?></td>
													<td><?php echo $value['secondaryIdentity']; ?></td>
													<td><?php echo $value['hivHistory']; ?></td>
													<td><?php echo $value['gender']; ?></td>
													<td><?php echo $value['emailAddress']; ?></td>
													<td><?php echo $value['age']; ?></td>
													<td><?php echo $value['occupation']; ?></td>
													<td><?php echo $value['educationalLevel']; ?></td>
													<td><?php echo $value['districtId']; ?></td>
													<td><?php echo $value['state']; ?></td>
													<td><?php echo $value['placeOforigin']; ?></td>
													<td><?php echo $value['mobileNo']; ?></td>
													<td><?php echo $value['maritalStatus']; ?></td>
													<td><?php echo $value['sexualBehaviour']; ?></td>
													<td><?php echo $value['hydc']; ?></td>
													
													<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['userId']; ?>,'userId','tbl_user')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/user/<?php echo $value['userId']; ?>"><span class="btn-white btn btn-xs">
													Edit</span></a>
													</td>
												</tr>
												<?php } ?>
												
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelUser" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import User Excel</label>
										   <div class="col-sm-8" style="display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/user_excel_format" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
                        
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addUser/<?php if(!empty($userById)){echo $userById[0]['userId']; }?>">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">User Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="userName" id="userName" value="<?php if(!empty($userById)){echo $userById[0]['userName'];} ?>" required>
											<span style="color:red;" id="error"></span>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="password" value="<?php if(!empty($userById)){echo $userById[0]['password']; }?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
							   <div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="name" value="<?php if(!empty($userById)) echo $userById[0]['name']; ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Name(Alias)</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="nameAlias" value="<?php if(!empty($userById)){echo $userById[0]['nameAlias'];} ?>" required>
										</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Date of Birth</label>
										<div class="col-sm-10">
											<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" required id="dob" class="form-control" name="dob" value="<?php if(!empty($userById)){echo date('d-m-Y', strtotime($userById[0]['dob']));} ?>" >
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Age</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="age" name="age" value="<?php if(!empty($age)){echo $userById[0]['age'];} ?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">	
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Gender</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="gender" id="knowledgeCenterId" required>
												<option value="" readonly>Select Gender</option>
												<option value="Male" <?php if(!empty($userById)){if($userById[0]['gender'] == 'Male'){echo "selected ='selected'";}}?>>Male</option>
												<option value="Female" <?php if(!empty($userById)){if($userById[0]['gender'] == 'Female'){echo "selected ='selected'";}}?>>Female</option>
												<option value="TG" <?php if(!empty($userById)){if($userById[0]['gender'] == 'TG'){echo "selected ='selected'";}}?>>TG</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Education</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="educationalLevel" value="<?php if(!empty($userById)){echo $userById[0]['educationalLevel'];} ?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								 <div class="col-sm-6">
								 	<label class="col-sm-2 control-label">For Others</label>
								 	<div class="col-sm-10">
								 		<div class="checkbox">
								 			<label><input type="checkbox" name="forOthers" id="forOthers"></label>
								 		</div>
								 	</div>
								 </div>	
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Occupation</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="occupation" name="occupation" value="<?php if(!empty($userById)){echo $userById[0]['occupation'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Occupation-Others</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="occupation1" name="occupation1" value="<?php if(!empty($userById)){echo $userById[0]['occupation1'];} ?>">
										</div>
									</div>
								</div>									
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Domain of Work</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="domainOfWork" value="<?php if(!empty($userById)){echo $userById[0]['domainOfWork'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Monthly Income</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="monthlyIncome" value="<?php if(!empty($userById)){echo $userById[0]['monthlyIncome']; }?>" onkeypress="return isNumberKey(event)" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Marital Status</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="maritalStatus" id="maritalStatus" required>
												<option value="" readonly>Select Marital Status</option>
												<option value="Married" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Married'){echo "selected ='selected'";}}?>>Married</option>
												<option value="Divorced" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Divorced'){echo "selected ='selected'";}}?>>Divorced</option>
												<option value="Widow/Widower" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Widow/Widower'){echo "selected ='selected'";}}?>>Widow/Widower</option>
												<option value="Unmarried" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Unmarried'){echo "selected ='selected'";}}?>>Unmarried</option>
												<option value="Separated" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Separated'){echo "selected ='selected'";}}?>>Separated</option>
												<option value="Others" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Others'){echo "selected ='selected'";}}?>>Others</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Marital Status-others</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="maritalStatus1" id="maritalStatus1">
												<option value="" readonly>Select Marital Status</option>
												<option value="Married" <?php if(!empty($userById)){if($userById[0]['maritalStatus1'] == 'Married'){echo "selected ='selected'";}}?>>Married</option>
												<option value="Divorced" <?php if(!empty($userById)){if($userById[0]['maritalStatus1'] == 'Divorced'){echo "selected ='selected'";}}?>>Divorced</option>
												<option value="Widow/Widower" <?php if(!empty($userById)){if($userById[0]['maritalStatus'] == 'Widow/Widower'){echo "selected ='selected'";}}?>>Widow/Widower</option>
												<option value="Unmarried" <?php if(!empty($userById)){if($userById[0]['maritalStatus1'] == 'Unmarried'){echo "selected ='selected'";}}?>>Unmarried</option>
												<option value="Separated" <?php if(!empty($userById)){if($userById[0]['maritalStatus1'] == 'Separated'){echo "selected ='selected'";}}?>>Separated</option>
												<option value="Others" <?php if(!empty($userById)){if($userById[0]['maritalStatus1'] == 'Others'){echo "selected ='selected'";}}?>>Others</option>
											</select>
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								 <div class="col-sm-6">
								 	<label class="col-sm-2 control-label">No. Of Male children</label>
								 	<div class="col-sm-10">  
								 	<input type="text" name="malechildren" id="malechildren" class="form-control" value="<?php //echo $userById[0]['malechildren']?>" onkeypress="return isNumberKey(event)">
								 </div>
								 </div>
								 <div class="col-sm-6">
								 	<label class="col-sm-2 control-label">No. of Female Children</label>
								 	<div class="col-sm-10">
								 	<input type="text" name="femalechildren" id="femalechildren" class="form-control" value="<?php //echo $userById[0]['femalechildren']?>" onkeypress="return isNumberKey(event)">
								 </div>
								 </div>
								</div>
								<div class="form-group">
								 <div class="col-sm-6">
								 	<label class="col-sm-2 control-label">Total Children</label>
								 	<div class="col-sm-10">
								 	<input type="text" name="totalchildren" id="totalchildren" class="form-control" value="<?php //echo $userById[0]['totalchildren']?>" >
								 </div>
								 </div>	
								</div>								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Current Address</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="address" value="<?php if(!empty($userById)){echo $userById[0]['address'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Contact Number</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="mobileNo" value="<?php if(!empty($userById)){echo $userById[0]['mobileNo'];} ?>" onkeypress="return isNumberKey(event)" maxlength="10" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Native State</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="state" id="state" onchange="getDistrict()" required>
												<option value="" readonly>Select Native State</option>
												<?php foreach($stateList as $value){ ?>
												<option value="<?php echo $value['stateId'];?>"x	><?php echo $value['stateName'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Native District</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="districtId" id="districtId" required>
												<!-- Data come from JS -->
											</select>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
							     <div class="col-sm-6">
										<label class="col-sm-2 control-label">Primary Identity</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="primaryIdentity" value="<?php if(!empty($userById)){echo $userById[0]['primaryIdentity'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Primary Identity-others</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="primaryIdentity1" value="<?php if(!empty($userById)){echo $userById[0]['primaryIdentity1'];} ?>">
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Secondary Identity</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="secondaryIdentity" value="<?php if(!empty($userById)){echo $userById[0]['secondaryIdentity'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Secondary Identity-others</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="secondaryIdentity1" value="<?php if(!empty($userById)){echo $userById[0]['secondaryIdentity1'];} ?>">
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>	
								 <div class="form-group">	
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Referral Point</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="referralPoint" value="<?php if(!empty($userById)){echo $userById[0]['referralPoint'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Referral Point-others</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="referralPoint1" value="<?php if(!empty($userById)){echo $userById[0]['referralPoint1'];} ?>">
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" name="emailAddress" value="<?php if(!empty($userById)){echo $userById[0]['emailAddress'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Place of Origin</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="placeOforigin" value="<?php if(!empty($userById)){echo $userById[0]['placeOforigin'];} ?>" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-3 control-label">Have You Ever Been Tested For HIV Before</label>
										<div class="col-sm-9">
											<input type="text" name="hivTest" class="form-control" value="<?php if(!empty($userById)){echo $userById[0]['hivTest'];}?>">
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>	
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-3 control-label">If Yes,When (Please mention how many months/years before)</label>
										<div class="col-sm-9">
											<input type="text" name="hivTestTime" class="form-control" value="<?php if(!empty($userById)){echo $userById[0]['hivTestTime'];}?>">
										</div>
									</div>
								</div>
							<div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Past HIV Test Result</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="hivTestResult" class="form-control" value="<?php if(!empty($userById)){echo $userById[0]['hivTestResult'];}?>">
							  		</div>
							  	</div>
							   </div>
							  <div class="hr-line-dashed"></div> 
							  <div class="form-group"> 	
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Date OF Finger Prick Screening</label>
							  		<div class="col-sm-9">
							  		  <div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text"  required class="form-control" name="fingerDate" value="<?php echo date('d-m-Y'); ?>" >
										</div>	
							        </div>
							  	</div>
							  </div>								  	
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Finger Prick Screening Report</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="fingerReport" class="form-control" >
							  		</div>
							  	</div>
							  </div>
							 <div class="hr-line-dashed"></div> 
							  <div class="form-group">	
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Status Of Referrral To SA-ICTC</label>
							  		<div class="col-sm-9"> 
							  			<input type="text" name="saictcStatus" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Date of Out-referral to SA-ICTC</label>
							  		<div class="col-sm-9">
							  			<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" required  class="form-control" name="saictcDate" value="<?php echo date('d-m-Y') ?>">
											</div>
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">	
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Place Of SA-ICTC Referred</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="saictcPlace" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">ICTC-PID Number</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="ictcNumber" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Date of HIV Confirmation Test</label>
							  		<div class="col-sm-9">
							  			<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" required  class="form-control" name="dob" value="<?php echo date('d-m-Y'); ?>">
											</div>
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Status of HIV Confimation Test</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="hivStatus" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Date of Test Report Issued to Client</label>
							  		<div class="col-sm-9">
							  			<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" required id="reportIssuedDate" class="form-control" name="reportIssuedDate" value="<?php echo date('d-m-Y'); ?>">
											</div>
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Status Of Confirmation on Report</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="reportStatus" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Referred To ART Center</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="artCenter" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Pre-ART/ART Number</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="artNumber" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Status Of CD4 Test</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="cd4Status" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Result of CD4 test</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="cd4Result" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Status Of ART Intake</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="artStatus" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Tested For Syphilis</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="syphilisTest" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Result Of Syphilis Test</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="syphilisResult" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Tested for TB</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="tbTest" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Result For TB Test</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="ictcNumber" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">If Yes,Referred To RNTCP</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="rntcpRefer" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							  <div class="hr-line-dashed"></div>
							  <div class="form-group">
							  	<div class="col-sm-12">
							  		<label class="col-sm-3 control-label">Remark</label>
							  		<div class="col-sm-9">
							  			<input type="text" name="remark" class="form-control" value="">
							  		</div>
							  	</div>
							  </div>
							 
															
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/user" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="button" onclick="getUserUniqueId('<?php if(!empty($userById)){echo $userById[0]['userId'];} ?>');">Submit</button>
										<button class="btn btn-primary" type="submit" id="submit" style="display:none;">Submit</button>
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
              $('#dob').change(function(){
                var today = new Date(), 
               birthday_val = $("#dob").val().split('-'),
                birthday = new Date(birthday_val[2],birthday_val[1],birthday_val[0]-1),
                todayYear = today.getFullYear(),
                todayMonth = today.getMonth(),
                todayDay = today.getDate(),
                birthdayYear = birthday.getFullYear(),
                birthdayMonth = birthday.getMonth(),
                birthdayDay = birthday.getDate(),
               yearDifference = (todayMonth == birthdayMonth && todayDay > birthdayDay) ? 
               todayYear - birthdayYear : (todayMonth > birthdayMonth) ? todayYear - birthdayYear : todayYear - birthdayYear-1;

             $('#age').val(yearDifference);
             //alert("Age: " + yearDifference);
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
		window.onload = function() {
			  // alert('aaa');
			   getDistrict();
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
			//alert(serviceTypeId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getDistrict",
				data: {state:state},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					//alert("Image Approved");
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
		</script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		
		
		
		
