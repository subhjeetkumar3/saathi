<style>
.required{
	color : red;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Comment</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Comment</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
		<?php if($this->session->flashdata('success_message')){?>
		   <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <?php echo $this->session->flashdata('success_message');?>
                            </div>
		   <?php }?>
			<div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
                                <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Pending Comment List</a></li>
                                <li><a  data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Approved Comment List</a></li>
                                <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-user"></i>Rejected Comment List</a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					<div id="tab-2" class="tab-pane <?php if(empty($id)){ echo 'active'; } ?> ">
						
						   <div class="ibox-title">
                            <h5>Pending Comment List</h5>
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
													<th>Comment</th>
													<th>Name</th>
													<th>Email</th>
													<th>Website</th>
													<th>From Page</th>
													<th>Status</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($pendingComments as $comments){?>
												<tr id="row<?php echo $comments['id']?>">
													<td><?php echo $comments['comment'];?></td>
													<td><?php echo $comments['name']?></td>
													<td><?php echo $comments['email']?></td>
													<td><?php echo $comments['website']?></td>
													<td><?php echo $comments['pageName']?></td>
													<td><?php echo $comments['comment_status']?></td>
													<td>
														<span class="btn-white btn btn-xs">Edit</span>
														<span class="btn-white btn btn-xs">Delete</span>
														<span class="btn-success btn btn-xs" onclick="changeStatus('<?php echo $comments['id']?>')">Change Status</span>
													</td>
												</tr>
												<?php }?>
												
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						<div id="tab-1" class="tab-pane">
							<div class="ibox-title">
								<h5>Approaved Comment List</h5>
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
                              <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
													<th>Comment</th>
													<th>Name</th>
													<th>Email</th>
													<th>Website</th>
													<th>From Page</th>
													<th>Status</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($approvedComments as $comments){?>
												<tr id="row<?php echo $comments['id']?>">
													<td><?php echo $comments['comment'];?></td>
													<td><?php echo $comments['name']?></td>
													<td><?php echo $comments['email']?></td>
													<td><?php echo $comment['website']?></td>
													<td><?php echo $comments['pageName']?></td>
													<td><?php echo $comments['comment_status']?></td>
													<td>
														<span class="btn-white btn btn-xs">Edit</span>
														<span class="btn-white btn btn-xs">Delete</span>
													</td>
												</tr>
												<?php }?>
												
                                               </tbody>
                                            </table>
                                       </div>
							</div>
						</div>
							<div id="tab-3" class="tab-pane">
							<div class="ibox-title">
								<h5>Rejected Comment List</h5>
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
                              <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
													<th>Comment</th>
													<th>Name</th>
													<th>Email</th>
													<th>Website</th>
													<th>From Page</th>
													<th>Status</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($rejectedComments as $comments){?>
												<tr id="row<?php echo $comments['id']?>">
													<td><?php echo $comments['comment'];?></td>
													<td><?php echo $comments['name']?></td>
													<td><?php echo $comments['email']?></td>
													<td><?php echo $comment['website']?></td>
													<td><?php echo $comments['pageName']?></td>
													<td><?php echo $comments['comment_status']?></td>
													<td>
														<span class="btn-white btn btn-xs">Edit</span>
														<span class="btn-white btn btn-xs">Delete</span>

													</td>
												</tr>
												<?php }?>
                                               </tbody>
                                            </table>
                                       </div>
							</div>
						</div>
						</div>
                    </div>

                    <div class="modal inmodal" id="changeStatusModel" role="dialog" data-backdrop="static" data-keyboard="false">
       <div class="modal-dialog">
       	 <div class="modal-content animated bounceInRight"  >
       	 	 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <small class="modal-title">Change Comment Status</small>
        </div>
       	 	<div class="modal-body" id="viewCountPop">
       	 		<form action="<?php echo base_url()?>index.php/home/changeCommentStatus" method="post">
       	 			<input type="hidden" name="commentId" id="commentId" >
       	 			<div class="form-group">
       	 				<label for="status">Change Status</label>
       	 				<select name="status" required class="form-control">
       	 					<option value="">-Change Status-</option>
       	 					<option value="approved">Approve</option>
       	 					<option value="rejected">Reject</option>
       	 				</select>
       	 			</div>
       	 			<div class="form-group">
       	 				<input type="submit" name="submit" class='btn btn-primary' value="Change">
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
        function changeStatus(commentId)
        {
        	$('#commentId').val(commentId);
        	$('#changeStatusModel').modal();
        }
        </script>
		
