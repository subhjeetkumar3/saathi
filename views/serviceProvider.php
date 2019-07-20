<style>
.none{
	display:none !important;
}
</style>

<div <?php if(!empty($er)){?> style="display:block;" <?php } ?>class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/serviceProvider"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php echo $total_error;  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<!-- <th>Unique Id</th> -->
							<th>Name</th>
							<th>Address</th>
							<th>Gender</th>
							<th>Mobile</th>
							<th>Landline</th>
							<th>Email</th>
							<th>Other Contact</th>
							<th>Location</th>
							<th>District</th>
							<th>State</th>
							<th>Service Focus</th>
							<th>Queer Friendly rating</th>
							<th>Qualifications</th>
							<th>Affiliation</th>
							<th>Linkage</th>
							<th>Days</th>
							<th>Time</th>
							<th>Face To Face Consulations</th>
							<th>Home Visits</th>
							<th>Consulations On Telephone</th>
							<th>Consulations Through Email</th>
							<th>Consulations over Skype / video conference/other chat</th>
							<th>Consulation Charges</th>
							<th>Concession</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Sexual Health Services</th>
							<th>Mental health services</th>
							<th>Legal aid services</th>
							<th>Dealing with sexually transmitted / reproductive tract infection testing and treatment</th>
							<th>Dealing with HIV counselling and testing issues</th>
							<th>Dealing with HIV prevention, care, support and treatment issues</th>
							<th>Prevention of parent to child transmission of HIV</th>
							<th>Guidance around family planning, safer child birth, abortion issues</th>
							<th>Dealing with feminization and masculinisation (gender transition) medical procedures</th>
							<th>Dealing with sexual injuries and dysfunction</th>
							<th>Dealing with physical impact of sexual assault / sexual abuse</th>
							<th>Dealing with Sexual health and disablities issues</th>
							<th>Others</th>
							<th>Dealing with confusion / dysphoria, depression, anxiety or other mental health concerns around gender, sexuality or HIV status</th>
							<th>Dealing with disclosure around gender or sexuality</th>
							<th>Dealing with HIV disclosure, HIV and marriage / relationships, HIV succession planning</th>
							<th>Dealing with feminization and masculinisation (gender transition) – psychosocial issues</th>
							<th>Dealing with family acceptance issues around gender and sexuality</th>
							<th>Dealing with marital / relationship issues</th>
							<th>Dealing with gender and sexuality issues in relation to disabilities</th>
							<th>Dealing with stigma, discrimination and violence around gender and sexuality in educational institutions, seeking employment, workplace, health or legal aid services</th>
							<th>Dealing with stigma, discrimination and violence around HIV or disability in educational institutions, seeking employment, workplace, health or legal aid services</th>
							<th>Dealing with emotional impact of sexual assault / sexual abuse</th>
							<th>Dealing with ageing issues around gender and sexuality</th>
							<th>Dealing with mental health concerns in relation to reproductive health</th>
							<th>Others</th>
							<th>Information on legal rights of queer people</th>
							<th>Dealing with marital / relationship issues</th>
							<th>Legal gender identity change guidance</th>
							<th>Dealing with extortion or blackmail around gender, sexuality or HIV status</th>
							<th>Dealing with sexual assault / sexual abuse</th>
							<th>Dealing with family or intimate partner violence</th>
							<th>Dealing with issues related to inheritance / eviction from home</th>
							<th>Dealing with issues related to insurance</th>
							<th>Dealing with denial of rented accommodation on grounds of gender, sexuality or HIV status</th>
							<th>Dealing with discrimination / harassment / bullying on grounds of gender and sexuality in educational institutions, seeking employment, workplace, health or legal aidservices</th>
							<th>Dealing with discrimination / harassment / bullying on grounds of HIV status or disability in educational institutions, seeking employment, workplace, health or legal aid </th>
							<th>Adoption guidance</th>
							<th>Dealing with denial of reproductive health rights</th>
							<th>Others</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color:red;"><?php echo $value['error']?></td>
							<!-- <td><?php echo $value['uniqueId']?></td> -->
							<td><?php echo $value['name']?></td>
							<td><?php echo $value['address']?></td>
							<td><?php echo $value['gender']?></td>
							<td><?php echo $value['mobile']?></td>
							<td><?php echo $value['officePhone']?></td>
							<td><?php echo $value['email']?></td>
							<td><?php echo $value['otherMobile']?></td>
							<td><?php echo $value['location']?></td>
							<td><?php echo $value['districtId']?></td>
							<td><?php echo $value['state']?></td>
							<td><?php echo $value['serviceTypeId']?></td>
							<td><?php echo $value['rating']?></td>
							<td><?php echo $value['qualification']?></td>
							<td><?php echo $value['affiliation']?></td>
							<td><?php echo $value['linkage']?></td>
							<td><?php echo $value['day']?></td>
							<td><?php echo $value['time']?></td>
							<td><?php echo $value['conFace']?></td>
							<td><?php echo $value['conHome']?></td>
							<td><?php echo $value['conTel']?></td>
							<td><?php echo $value['conEmail']?></td>
							<td><?php echo $value['conOnline']?></td>
							<td><?php echo $value['conCharges']?></td>
							<td><?php echo $value['concession']?></td>
							<td><?php echo $value['latitude']?></td>
							<td><?php echo $value['longitude']?></td>
							<td><?php echo $value['sexualhealthservices']?></td>
							<td><?php echo $value['mentalhealthservices']?></td>
							<td><?php echo $value['Legalaidservices']?></td>
						    <td><?php echo $value['shs1']?></td>
						    <td><?php echo $value['shs2']?></td>
						    <td><?php echo $value['shs3']?></td>
						    <td><?php echo $value['shs4']?></td>
						    <td><?php echo $value['shs5']?></td>
						    <td><?php echo $value['shs6']?></td>
						    <td><?php echo $value['shs7']?></td>
						    <td><?php echo $value['shs8']?></td>
						    <td><?php echo $value['shs9']?></td>
						    <td><?php echo $value['shs10']?></td>
						    <td><?php echo $value['mhs1']?></td>
						    <td><?php echo $value['mhs2']?></td>
						    <td><?php echo $value['mhs3']?></td>
						    <td><?php echo $value['mhs4']?></td>
						    <td><?php echo $value['mhs5']?></td>
						    <td><?php echo $value['mhs6']?></td>
						    <td><?php echo $value['mhs7']?></td>
						    <td><?php echo $value['mhs8']?></td>
						    <td><?php echo $value['mhs9']?></td>
						    <td><?php echo $value['mhs10']?></td>
						    <td><?php echo $value['mhs11']?></td>
						    <td><?php echo $value['mhs12']?></td>
						    <td><?php echo $value['mhs13']?></td>
						    <td><?php echo $value['las1']?></td>
						    <td><?php echo $value['las2']?></td>
						    <td><?php echo $value['las3']?></td>
						    <td><?php echo $value['las4']?></td>
						    <td><?php echo $value['las5']?></td>
						    <td><?php echo $value['las6']?></td>
						    <td><?php echo $value['las7']?></td>
						    <td><?php echo $value['las8']?></td>
						    <td><?php echo $value['las9']?></td>
						    <td><?php echo $value['las10']?></td>
						    <td><?php echo $value['las11']?></td>
						    <td><?php echo $value['las12']?></td>
						    <td><?php echo $value['las13']?></td>
						    <td><?php echo $value['las14'];?></td>
						</tr>
					<?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/serviceProvider"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>
 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Service Provider</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Service Provider</strong>
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

			 <?php if($this->session->flashdata('message1')){ ?>
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="fa fa-check-circle fa-fw fa-lg"></i>
				<?php echo $this->session->flashdata('message1'); ?>.
			</div>
			<?php } ?>
           
            <div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
                                 <li class="<?php if(!empty($serviceProviderById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Service Provider List</a></li>
								 <li class="<?php if(!empty($serviceProviderById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($serviceProviderById)){ echo ''; }else { echo 'active'; } ?>">
						   <div class="ibox-title">
                            <h5>Service Provider List</h5>
                            <div class="ibox-tools">
                            		<form method="POST" action="<?php echo base_url()?>index.php/home/downloadServiceProviderData">
									<input type="hidden" name="exceldaterange" value="<?php echo $exceldaterange;?>">
									<?php if(!empty($exceldataName)){?>	
									<?php foreach($exceldataName as $data){?>	
										<input type="hidden" name="exceldataName[]"  value="<?php echo $data;?>">
									<?php }?>	
									<?php }?>	
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> SAC Data</button>
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
                        	<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterServiceProvider">
                        		<div class="form-group">
                        			<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="<?php echo $daterange ?>" readonly placeholder='Select "Create Date" daterange' required>
											</div>
											</div>
											<div class="col-sm-6" id="dataDiv" >
											
												<select data-placeholder="<?php if(!empty($states)){  $State = $role_master->state_by_id($states); echo implode(',',array_column($State,'stateName'));}else{ echo 'choose state';} ?>" name="states[]" data-placeholder="choose state" multiple class="chosen-select" id="states">
                                                 <?php foreach($stateList as $list ){?>
                                                 	<option value="<?php echo $list['stateId']?>"><?php echo $list['stateName'];?></option>
                                                 <?php }?>	
												</select>

											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit" id="submit" >Submit</button>
											</div>
                        		</div>
                        	</form>
                        </div>
                        <div class="ibox-content">
                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
							                     <th>Unique Id</th>
							                       <th>Name</th>
							                       <th>Address</th>
							                        <th>Mobile</th>
							                        <th>Gender</th>
							                        <th>Landline</th>
							                         <th>Email</th>
							                       <th>Other Contact</th>
						                        	<th>Location</th>
							                         <th>District</th>
							                          <th>State</th>
							                     <th>Queer Friendly rating</th>
							                       <th>Qualifications</th>
							                       <th>Affiliation</th>
							                        <th>Linkage</th>
							                   <th>Days</th>
							                   <th>Time</th>
							                 <th>Face To Face Consulations</th>
							                       <th>Home Visits</th>
							                  <th>Consulations On Telephone</th>
													<th>Consulations Through Email</th>
													<th>Consulations over Skype / video conference/other chat</th>
													<th>Consulation Charges</th>
													<th>Concession</th>
													<th>Latitude</th>
													<th>Longitude</th>
													<th>Services Focus</th>
													<!--<th>Dealing with sexually transmitted / reproductive tract infection testing and treatment</th>
													<th>Dealing with HIV counselling and testing issues</th>
													<th>Dealing with HIV prevention, care, support and treatment issues</th>
													<th>Prevention of parent to child transmission of HIV</th>
													<th>Guidance around family planning, safer child birth, abortion issues</th>
													<th>Dealing with feminization and masculinisation (gender transition) medical procedures</th>
													<th>Dealing with sexual injuries and dysfunction</th>
													<th>Dealing with physical impact of sexual assault / sexual abuse</th>
													<th>Dealing with Sexual health and disablities issues</th>
													<th>Others</th>
													<th>Dealing with confusion / dysphoria, depression, anxiety or other mental health concerns around gender, sexuality or HIV status</th>
													<th>Dealing with disclosure around gender or sexuality</th>
													<th>Dealing with HIV disclosure, HIV and marriage / relationships, HIV succession planning</th>
													<th>Dealing with feminization and masculinisation (gender transition) – psychosocial issues</th>
													<th>Dealing with family acceptance issues around gender and sexuality</th>
													<th>Dealing with marital / relationship issues</th>
													<th>Dealing with gender and sexuality issues in relation to disabilities</th>
													<th>Dealing with stigma, discrimination and violence around gender and sexuality in educational institutions, seeking employment, workplace, health or legal aid services</th>
													<th>Dealing with stigma, discrimination and violence around HIV or disability in educational institutions, seeking employment, workplace, health or legal aid services</th>
													<th>Dealing with emotional impact of sexual assault / sexual abuse</th>
													<th>Dealing with ageing issues around gender and sexuality</th>
													<th>Dealing with mental health concerns in relation to reproductive health</th>
													<th>Others</th>
													<th>Information on legal rights of queer people</th>
													<th>Dealing with marital / relationship issues</th>
													<th>Legal gender identity change guidance</th>
													<th>Dealing with extortion or blackmail around gender, sexuality or HIV status</th>
													<th>Dealing with sexual assault / sexual abuse</th>
													<th>Dealing with family or intimate partner violence</th>
													<th>Dealing with issues related to inheritance / eviction from home</th>
													<th>Dealing with issues related to insurance</th>
													<th>Dealing with denial of rented accommodation on grounds of gender, sexuality or HIV status</th>
													<th>Dealing with discrimination / harassment / bullying on grounds of gender and sexuality in educational institutions, seeking employment, workplace, health or legal aidservices</th>
													<th>Dealing with discrimination / harassment / bullying on grounds of HIV status or disability in educational institutions, seeking employment, workplace, health or legal aid </th>
													<th>Adoption guidance</th>
													<th>Dealing with denial of reproductive health rights</th>
													<th>Others</th>-->
													<th>Create Date</th>
													<th>Created By</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
											<?php if(!empty($serviceProviderList)){?>		
									           <?php foreach($serviceProviderList as $value) { ?>
                                                <tr id="row<?php echo $value['serviceProviderId']; ?>">
                                                	<td><?php echo $value['uniqueId']?></td>
                                                    <td><?php echo ucfirst($value['name']); ?></td>
													<td><?php echo $value['address']; ?></td>
													<td><?php echo $value['mobile']; ?></td>
													<td><?php echo $value['gender'] ?></td>
													<td><?php echo $value['officePhone']; ?></td>
													<td><?php echo $value['email']; ?></td>
													<td><?php echo $value['otherMobile']?></td>
													<td><?php echo $value['location']?></td>
													<td><?php echo $value['districtName']?></td>
													<td><?php echo $value['stateName']?></td>
													<td><?php echo $value['rating']?></td>
													<td><?php echo $value['qualification']?></td>
													<td><?php echo $value['affiliation']?></td>
													<td><?php echo $value['linkage']?></td>
													<td><?php echo $value['day']?></td>
													<td><?php echo $value['time']?></td>
													<td><?php echo $value['conFace']?></td>
													<td><?php echo $value['conHome']?></td>
													<td><?php echo $value['conTel']?></td>
													<td><?php echo $value['conEmail']?></td>
													<td><?php echo $value['conOnline']?></td>
													<td><?php echo $value['conCharges']?></td>
													<td><?php echo $value['concession']?></td>
													<td><?php echo $value['latitude']; ?></td>
													<td><?php echo $value['longitude']; ?></td>
													<td><?php echo $value['services']; ?></td>
													<td><?php echo date('d M Y H:i a', strtotime($value['createdDate'])); ?></td>
													<td><?php echo $value['empName']?></td>
													<td class="text-right footable-visible footable-last-column">
													<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $value['serviceProviderId']; ?>,'serviceProviderId','tbl_service_provider_details')">
													Delete</span>
													<a href="<?php echo base_url(); ?>index.php/home/serviceProvider/<?php echo $value['serviceProviderId']; ?>"><span class="btn-white btn btn-xs">
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
						 
						 <div id="tab-1" class="tab-pane <?php if(!empty($serviceProviderById)){ echo 'active'; }else { echo ''; } ?>">
						<div class="ibox-title">
                            <h5>Service Provider Entry</h5>
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/newExcelUplaodServiceProvider" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import Service Provider Excel</label>
										   <div class="col-sm-8" style="display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/service_provider_excel_format" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
                        <div class="ibox-content">
                          <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addServiceProvider/<?php if(!empty($serviceProviderById)){echo $serviceProviderById[0]['serviceProviderId']; }?>">
							   <div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Unique Id</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="uniqueId" id="uniqueId" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['uniqueId']; }else{ echo $serviceProviderUniqueId;} ?>" readonly required>
											<span style="color:red;" id="error"></span>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="name" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['name'];} ?>" required>
										</div>
									</div>

									
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Gender</label>
										<div class="col-sm-10">
											<select class="form-control" name="gender">
												<option value="">-Select Gender-</option>
												<option value="TG" <?php if($serviceProviderById[0]['gender'] == 'TG'){echo 'selected';}?>>TG</option>
												<option value="Male" <?php if($serviceProviderById[0]['gender'] == 'Male'){echo 'selected';}?>>Male</option>
												<option  value="Female" <?php if($serviceProviderById[0]['gender'] == 'Female'){echo 'selected';}?>>Female</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Qualification</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="qualification" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['qualification'];} ?>" >
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Address</label>
										<div class="col-sm-10">
											<textarea type="text" class="form-control" name="address" required><?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['address'];} ?></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Mobile</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="mobileNo" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['mobile'];} ?>" maxlength ="10" onkeypress="return isNumberKey(event)" required>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Landline</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="officePhone" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['officePhone'];} ?>" onkeypress="return isNumberKey(event)" >
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" name="email" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['email'];} ?>" >
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Other Mobile</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="otherMobile" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['otherMobile']; }?>" maxlength ="10" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Location</label>
										<div class="col-sm-10">
											<select name="location" class="form-control">
												<option value="">-Select location-</option>
												<option value="Village" <?php if($serviceProviderById[0]['location'] == 'Village'){echo 'selected';}?>>Village</option>
												<option value="Town" <?php if($serviceProviderById[0]['location'] == 'Town'){echo 'selected';}?>>Town</option>
												<option value="City" <?php if($serviceProviderById[0]['location'] == 'City'){echo 'selected';}?>>City</option>
											</select>
										</div>
									</div>
								</div>		
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">State</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="state" id="state" onchange="getDistrict()" required>
												<option value="" readonly>Select State</option>
												<?php foreach($stateList as $value){ ?>
												<option value="<?php echo $value['stateId'];?>" <?php if(!empty($serviceProviderById)){if($serviceProviderById[0]['state'] == $value['stateId']){echo "selected ='selected'";}}?>><?php echo $value['stateName'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">District</label>
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
										<label class="col-sm-2 control-label">Queer friendly rating</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="rating" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['rating']; }?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Affiliation</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="affiliation" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['affiliation'];} ?>">
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<div class="col-sm-6">
										<label class="col-sm-2 control-label">Days</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="day" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['day'];} ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Time</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="time" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['time'];} ?>">
										</div>
									</div>
							  </div>
							  <div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Linkage</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="linkage" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['linkage']; }?>">
										</div>
									</div>
								</div>
								 <div class="hr-line-dashed"></div>
								 <div class="form-group">
									<div class="col-sm-6">
									  <label class="col-sm-2 control-label">Face to face consultations</label>
											<div class="col-sm-10">
											<select name="conFace" class="form-control">
												<option value="">-Select-</option>
												<option value="Yes" <?php if($serviceProviderById[0]['conFace'] == 'Yes' || $serviceProviderById[0]['conFace'] == 'yes'){echo 'selected';}?>>Yes</option>
												<option value="No" <?php if($serviceProviderById[0]['conFace'] == 'No' || $serviceProviderById[0]['conFace'] == 'no'){echo 'selected';}?>>No</option>
											</select>
											</div>
										</div>
										<div class="col-sm-6">
										<label class="col-sm-2 control-label">Home Visits</label>
										<div class="col-sm-10">
										<select name="conHome" class="form-control">
											<option value="">-Select-</option>
											<option value="Yes" <?php if($serviceProviderById[0]['conHome'] == 'Yes' || $serviceProviderById[0]['conHome'] == 'yes'){echo 'selected';}?>>Yes</option>
											<option value="No" <?php if($serviceProviderById[0]['conHome'] == 'No' || $serviceProviderById[0]['conHome'] == 'no'){echo 'selected';}?>>No</option>
										</select>
										</div>
									</div>
	
									</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consultations on telephone</label>
										<div class="col-sm-10">
										 <select name="conTel" class="form-control">
										 	<option value="">-Select-</option>
										 	<option value="Yes" <?php if($serviceProviderById[0]['conTel'] == 'Yes' || $serviceProviderById[0]['conTel'] == 'yes'){echo 'selected';}?>>Yes</option>
										 	<option value="No" <?php if($serviceProviderById[0]['conTel'] == 'No' || $serviceProviderById[0]['conTel'] == 'no'){echo 'selected';}?>>No</option>
										 </select>	
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consultations through emails</label>
										<div class="col-sm-10">
											<select name="conEmail" class="form-control">
											<option value="">-Select-</option>
											<option value="Yes" <?php if($serviceProviderById[0]['conEmail'] == 'Yes' || $serviceProviderById[0]['conEmail'] == 'yes'){echo 'selected';}?>>Yes</option>
											<option value="No" <?php if($serviceProviderById[0]['conEmail'] == 'No' || $serviceProviderById[0]['conEmail'] == 'no'){echo 'selected';}?>>No</option>
											</select>
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								 <div class="col-sm-12">
								 	<div class="col-sm-6">
								 	<label class="control-label">Consultations over Skype / video conference / other chat</label>
								 	</div>
								 	<div class="col-sm-6">
								 		<select name="conOnline" class="form-control">
								 			<option>-Select-</option>
								 			<option value="Yes" <?php if($serviceProviderById[0]['conOnline'] == 'Yes' || $serviceProviderById[0]['conOnline'] == 'yes'){echo 'selected';}?>>Yes</option>
								 			<option value="No" <?php if($serviceProviderById[0]['conOnline'] == 'No' || $serviceProviderById[0]['conOnline'] == 'no'){echo 'selected';}?>>No</option>
								 		</select>
								 	</div>
								 </div>	
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consulation Charges</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="conCharges" value="<?php if(!empty($serviceProviderById)){echo $serviceProviderById[0]['conCharges'];} ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Concession</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="concession" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['concession'];} ?>">
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Latitude</label>
										<div class="col-sm-10">
											<input title="Latitude should be equal to or below 99.9999" type="text" class="form-control" name="latitude" placeholder="Latitude should be equal to or below 99.9999" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['latitude'];} ?>" required  onkeypress="return isNumberLatLong(event,this)" id="lat">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Longitude</label>
										<div class="col-sm-10">
											<input type="text"  class="form-control" name="longitude" title="Longitude should be equal to or below 99.9999" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['longitude'];} ?>" required onkeypress="return isNumberLatLong(event,this)" placeholder="Longitude should be equal to or below 99.9999" id="long">
										</div>
									</div>
								</div>	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Service Focus</label>
									<div class="col-sm-4">
										<input type="checkbox" value="1" id="serviceFocus1" name="serviceTypeId[]" onclick="showDivFirst()">Sexual Health
									</div>

									<div class="col-sm-4">
										<input type="checkbox" value="2" id="serviceFocus2" name="serviceTypeId[]" onclick="showDivSecond()">Mental Health
									</div>

									<div class="col-sm-4">
										<input type="checkbox" value="3" id="serviceFocus3" name="serviceTypeId[]" onclick="showDivThird()">Legal aid
									</div>
								</div>
								
								
								
							


								<!--<div class="hr-line-dashed"></div>

								<div>
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Sexual Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields" name="serviceFields[]" required>
												
												
											</select>
										</div>
									</div>
								</div>	
								</div> -->

								<div id="sexualServiceDiv" style="display: none;">
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Sexual Health Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields1" name="serviceFields[]" >
												
												<!-- Data Come from JS -->
											</select>
										</div>
									</div>
								</div>	
								</div>
								
								<div id="mentalServiceDiv" style="display: none;">
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Mental Health Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields2" name="serviceFields[]" >
												
												<!-- Data Come from JS -->
											</select>
										</div>
									</div>
								</div>	
								</div>
								
								<div id="legalServiceDiv" style="display: none;">
									<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-1 control-label">Legal Aid Service Area</label>
										<div class="col-sm-11">
											<select data-placeholder="Choose Service Area" class="chosen-select" multiple style="width:350px;" tabindex="4" id="serviceFields3" name="serviceFields[]" >
												
												<!-- Data Come from JS -->
											</select>
										</div>
									</div>
								</div>	
								</div>
																	
									
								<!--<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Skype Id</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="skypeId" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['skypeId'];} ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Website</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="website" value="<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['website'];} ?>">
										</div>
									</div>
								</div>-->									
									
								<!--<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Consulation Mode</label>
										<div class="col-sm-10">
											<select class="form-control m-b ff" name="conMode" required>
												<option value="" readonly>Select Consulation Mode</option>
												<?php foreach($modeList as $value){ ?>
												<option value="<?php echo $value['modeId'];?>" <?php if(!empty($serviceProviderById)){ if($serviceProviderById[0]['conMode'] == $value['modeId']){echo "selected ='selected'";}}?>><?php echo $value['modeName'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>-->	
																	
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/serviceProvider" class="btn btn-white">Cancel</a>
                                       <!--  <button class="btn btn-primary" type="button" onclick="getServiceUniqueId('<?php if(!empty($serviceProviderById)){ echo $serviceProviderById[0]['serviceProviderId']; }?>');">Submit</button> -->
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
		<?php if(!empty($serviceProviderById)){ //if($serviceProviderById){ ?>
		<script>
			window.onload = function() {
			  // alert('aaa');
			   getDistrict();
			   getServiceFieldsEdit();
			};
		</script>
		<?php //} 
	     } ?>
		<script>
		/*function submitForm(){
			//alert('aaa');
			$('#submit').trigger('click');
		}*/
		function getServiceUniqueId(serviceProviderId){
			//alert(serviceProviderId);
			var id = $('#uniqueId').val();
			//alert(id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceUniqueId",
				data: {id:id,serviceProviderId:serviceProviderId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					if(result[0].total == 0){
						$('#error').html('');
						$('#submit').trigger('click');
					}else{
						$('#error').html('Should be Unique Id');
						$('#uniqueId').focus();
					}
				}
			});
		}


		function isNumberLatLong(evt,element){
			

			var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			    return false;
			  else {

			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');
			    //alert($(element).val().charAt(2));
			    
			    if (len > 1 ) {
				    if( $(element).val().charAt(2) == '.' || charCode == 46){

					    if (index > 0 && charCode == 46) {
					      return false;
					    }
					    if (index > 0) {
					      var CharAfterdot = (len + 1) - index;
					      if (CharAfterdot > 5) {
					        return false;
					      }
					    }	
				    }else{
						return false;
				    }	
			    }
			    

			    

			    
				
			  }
		}
		
		function getServiceFields(){
			/*var pausecontent = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php
				foreach($serviceFields as $key => $val){ ?>
				pausecontent.push('<?php echo $val; ?>');
			<?php } ?>*/
			//console.log(pausecontent);
			var serviceTypeId = $('#serviceTypeId').val();
			//alert(serviceTypeId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:serviceTypeId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					//alert("Image Approved");
					htm = '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					//	var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent);
						//if (idx == -1) {
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						/*} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}*/
					}

					alert("1-"+serviceTypeId.indexOf("1"));

					alert("2-"+serviceTypeId.indexOf("2"));

                    alert("3-"+serviceTypeId.indexOf("3"));


				/*	if(serviceTypeId.indexOf("1") == -1)
					{
						alert('ghyjghjg');
					}	*/



					if(serviceTypeId.indexOf("1") == 0)
					{
						$('#sexualServiceDiv').css('display','block');
						$('#serviceFields1').html('');
					$('#serviceFields1').html(htm);
					$('#serviceFields1').trigger("chosen:updated");
					}

					if(serviceTypeId.indexOf("2") == 0)
					{
						$('#mentalServiceDiv').css('display','block');
						$('#serviceFields2').html('');
					$('#serviceFields2').html(htm);
					$('#serviceFields2').trigger("chosen:updated");
					}

				    if(serviceTypeId.indexOf("3") == 0)
					{
						$('#legalServiceDiv').css('display','block');
						$('#serviceFields3').html('');
					$('#serviceFields3').html(htm);
					$('#serviceFields3').trigger("chosen:updated");
					}	
					//alert(htm);
					
				}
			});
			
		}
		
		function getServiceFieldsEdit(){
			var pausecontent = new Array();
			<?php if(!empty($serviceProviderById)){$serviceFields = explode(',',$serviceProviderById[0]['serviceFields']);} ?>
			<?php if(!empty($serviceFields)){
				foreach($serviceFields as $key => $val){ ?>
				pausecontent.push('<?php echo $val; ?>');
			<?php } } ?>
			//console.log(pausecontent);
			var serviceTypeId = $('#serviceTypeId').val();
			//alert(serviceTypeId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:serviceTypeId},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].total);
					//alert("Image Approved");
					htm = '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
						var idx = $.inArray(result[i].serviceTypeParameterId,pausecontent);
						if (idx == -1) {
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						} else {
							htm += '<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>';
						}
					}
					//alert(htm);
					$('#serviceFields').html('');
					$('#serviceFields').html(htm);
					$('#serviceFields').trigger("chosen:updated");
				}
			});
			
		}

		function showDivFirst()
		{
			if($('#serviceFocus1').is(':checked'))
			{
			 	$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:'1'},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].serviceTypeParameterId);
					//alert("Image Approved");
					var htm = ''; 
					htm += '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						
					}

						//alert(htm);
               $('#sexualServiceDiv').css('display','block');
						$('#serviceFields1').html('');
					$('#serviceFields1').html(htm);
					$('#serviceFields1').prop('required',true);
					$('#serviceFields1').trigger("chosen:updated");	
					
				}
			});	

			 
			}
			else{
                $('#sexualServiceDiv').css('display','none');
                $('#serviceFields1').prop('required',false);
                $('#serviceFields1').prop('disabled',true);
						$('#serviceFields1').html('');
				/*	$('#serviceFields1').html(htm);
					$('#serviceFields1').trigger("chosen:updated");*/
			}
		}

		function showDivSecond()
		{
			if($('#serviceFocus2').is(':checked'))
			{
			   $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:'2'},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].serviceTypeParameterId);
					//alert("Image Approved");
					var htm = ''; 
					htm += '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						
					}

			          $('#mentalServiceDiv').css('display','block');
						$('#serviceFields2').html('');
					$('#serviceFields2').html(htm);
					$('#serviceFields2').prop('required',true);
					$('#serviceFields2').trigger("chosen:updated");
					
				}
			});		

            
			}
			else{
                $('#mentalServiceDiv').css('display','none');
                $('#serviceFields1').prop('required',false);
                $('#serviceFields2').prop('disabled',true);
						$('#serviceFields2').html('');
				/*	$('#serviceFields2').html(htm);
					$('#serviceFields2').trigger("chosen:updated");*/
			}
		}

		function showDivThird()
		{
           if($('#serviceFocus3').is(':checked'))
			{
			  $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getServiceFields",
				data: {serviceTypeId:'3'},
				success: function(data) {
					//alert(data);
					var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					//alert(result[0].serviceTypeParameterId);
					//alert("Image Approved");
					var htm = ''; 
					htm += '<option value="" readonly>Select Service Fields</option>';
					for(var i = 0; i < len; i++){
					
							htm += '<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>';
						
					}

			        $('#legalServiceDiv').css('display','block');
						$('#serviceFields3').html('');
					$('#serviceFields3').html(htm);
					$('#serviceFields3').prop('required',true);
					$('#serviceFields3').trigger("chosen:updated");
				}
			});			
               
			}
			else{
                $('#legalServiceDiv').css('display','none');
                $('#serviceFields3').prop('disabled',true);
						$('#serviceFields3').html('');
					/*$('#serviceFields2').html(htm);
					$('#serviceFields2').trigger("chosen:updated");*/
			}
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
						
						if(result[i].districtId == '<?php echo $serviceProviderById[0]['districtId']; ?>'){
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
		
		
		
		
