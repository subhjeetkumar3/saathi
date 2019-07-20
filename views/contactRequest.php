
    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Contact Request</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Contact Request</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
    </div>
       <!-- <div class="wrapper wrapper-content animated fadeInRight"> -->	   
	   <div class="post-inner">
		 <div class="entry">
		 
		<?php if($this->session->flashdata('message')){ ?>
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="fa fa-check-circle fa-fw fa-lg"></i>
				<?php echo $this->session->flashdata('message'); ?>.
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-lg-12">
							<!--<ul class="nav nav-tabs" style="background-color:white;">
                                 <li class="active"><i class="fa fa-user"></i>Contact Request</li>
								  <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-user"></i>Quiz List</a></li>-->
								 <!--<li class="<?php if(!empty($quizById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Quiz Entry</a></li>
								
							</ul>-->
                    <div class="ibox float-e-margins">
											 
								<div class="ibox-title">
									<h5>Contact Request List</h5>
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
													<th>Name</th>
													<th>Email</th>
													<th>Mobile</th>
													<th>Subject</th>
													<th>Message</th>
													<!-- <th>Action</th> -->
													<th>Contact Request Date & Time</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($contactRequest as $value) { ?>
                                                <tr id="row<?php echo $value['id']; ?>">
													<td><?php echo $value['name']; ?></td>
													<td><?php echo $value['email'];?></td>
													<td><?php echo $value['mobile']; ?></td>
													<td><?php echo $value['subject'];?></td>
													<td><?php echo $value['message'];?></td>
													<td><?php echo date('d M Y h:i a',strtotime($value['createdAt']))?></td>
													<!-- <td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['quizId']; ?>,'quizId','tbl_quiz_names')">
														Delete</span>
														<a href="<?php echo base_url(); ?>index.php/home/quiz/<?php echo $value['quizId']; ?>"><span class="btn-white btn btn-xs">
														Edit</span></a>
													</td> -->
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
        <div class="footer">
            
        </div>

        </div>
        </div>
		<script>
		function getQuizQuestions(){
			//alert('aaa');
			var quizId = $('#quizId').val();
			//alert(quizId);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/home/getQuizQuestions",
				data: {quizId:quizId},
				success: function(data) {
					//alert(data);
					$('#tableData').html('');
					$('#tableData').html(data);
					
				}
			});
		}
		</script>
		
		
		
