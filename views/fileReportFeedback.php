<style>
.none{
	display:none !important;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Violence Report Feedback</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Violence Report Feedback</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
			
           
            <div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
                                 <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Feedback List</a></li>
								
                                
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($importantLinkById)){ echo ''; }else { echo 'active'; } ?>">
						   <div class="ibox-title">
                            <h5>Feedback List</h5>
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
													<th>Report Id</th>
													<th>Police</th>
                                                    <th>Police Text</th>
													<th>Health Care providers</th>
                                                    <th>Health Care providers Text</th>
													<th>Legal service  providers</th>
                                                    <th>Legal service  providers Text</th>
													<th>Educational Institutions</th>
                                                    <th>Educational Institutions Text</th>
													<th>Created Date</th>
													
												</tr>
												</thead>
												<tbody>		
												<?php foreach($feedbackList as $value) { ?>
                                                <tr id="row<?php echo $value['id']; ?>">
                                                	<td><?php echo $value['report_unique_id'] ?></td>
													<td><?php echo $value['part_one']; ?></td>
                                                    <td><?php echo $value['part_one_text'] ?></td>
													<td><?php echo $value['part_two']; ?></td>
                                                    <td><?php echo $value['part_two_text'] ?></td>
													<td><?php echo $value['part_three'] ?></td>
                                                    <td><?php echo $value['part_three_text'] ?></td>
													<td><?php echo $value['part_four'] ?></td>
                                                    <td><?php echo $value['part_four_text'] ?></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['createdDate'])); ?></td>
													
												</tr>
												<?php } ?>
												
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
		
		
		
