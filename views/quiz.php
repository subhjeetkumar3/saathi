<div <?php if(!empty($er)){?>style="display:block;" <?php } ?> class="modal " id="errorModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<a href="<?php echo base_url();?>index.php/home/quiz"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
				<h4 style="color:red;" class="modal-title"><?php if(!empty($total_error)){echo $total_error;}  ?></h4>
			</div>
			<div class="modal-body" style="height:65vh !important;">
				<div class="table-responsive" style="height: 100%;">
					<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Error</th>
							<th>Quiz Name</th>
							<th>Total No. Of Questions</th>
							<th>Question</th>
							<th>Options</th>
							<th>Number Of Correct Options</th>
							<th>Marks For Each Correct Answer</th>
							<th>Correct Options</th>
							<th>Additional Info Incase Of Correct Answer</th>
							<th>Additional Info Incase Of Wrong Answer</th>
						</tr>
					</thead>
					<tbody>
				<?php if(!empty($er)){?>		
					<?php foreach($er as $value){ ?>
						<tr>	
							<td style="color:red;"><?php echo $value['error']?></td>
							<td><?php echo $value['quizName']?></td>
							<td><?php echo $value['TotalNoOfQuestion']?></td>
							<td><?php echo $value['question']?></td>
							<td><?php echo $value['options']?></td>
							<td><?php echo $value['numberofcorrectoptions']?></td>
							<td><?php echo $value['marksforeachcorrectanswer']?></td>
							<td><?php echo $value['correctOptions']?></td>
							<td><?php echo $value['AdditionalInfoInCaseOfCorrectAnswer']?></td>
							<td><?php echo $value['AdditionalInfoInCaseOfWrongAnswer']?></td>
						</tr>
					<?php  } ?>
					<?php }?>
					</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url();?>index.php/home/quiz"><button type="button" class="btn btn-white" data-dismiss="modal">Close</button></a>
			</div>
		</div>
	</div>
</div>


    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Quiz</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Quiz</strong>
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
							<ul class="nav nav-tabs" style="background-color:white;">
                                 <li class="<?php if(!empty($quizById)){ echo 'none'; }else { echo 'active'; } ?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Quiz Data Import</a></li>
								  <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-user"></i>Quiz List</a></li>
								 <!--<li class="<?php if(!empty($quizById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Quiz Entry</a></li>-->
								
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane <?php if(!empty($quizById)){ echo ''; }else { echo 'active'; } ?>">
						<div class="ibox-title">
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelQuiz" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <!--<div class="col-lg-12">
										   <label class="col-sm-2 control-label">Choose Quiz Name</label>
										   <div class="col-sm-10">
											   <select class="form-control m-b ff" name="quizName" id="quizId" onchange = "getQuizQuestions();">
													<option value="" readonly>Choose Quiz Name</option>
													<?php foreach($quizNameList as $value){ ?>
													<option value="<?php echo $value['quizId'];?>"><?php echo $value['quizName'];?></option>
													<?php } ?>
												</select>
										   </div>
									   </div>-->
									   <div class="col-lg-12">
										   <label class="col-sm-4 control-label">Import Quiz Excel</label>
										   <div class="col-sm-8" style="display:flex;">
											   <label style="border: 1px solid gray;margin-right: 5px;background-color: #8080801a;height:28px;">
											   <input type="file" name="importExcel" required>
											   </label>
											   <button class="btn btn-primary" type="submit" style="padding:0px 5px;">Import</button>
											   <a href="<?php echo base_url(); ?>index.php/home/download/quiz_excel_format" class="btn btn-primary" style="margin-left: 5px;">Download Format</a>
										   </div>
									   </div>
								   </div>
							   </div>
						   </form>
					   </div>
						  <div class="ibox-content">
                             <div class="table-responsive" id="tableData">
                                      <!-- Data come from JS -->      
                                       </div>
                        </div>
						 </div>
						 
						 <div id="tab-1" class="tab-pane <?php if(!empty($quizById)){ echo 'active'; }else { echo ''; } ?>">
							 <div class="ibox-title">
                            <h5>Quiz Name Entry</h5>
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/addQuiz/<?php if(!empty($quizById)){echo $quizById[0]['quizId'];} ?>" >
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Quiz Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="quizName" value="<?php if(!empty($quizById)){echo $quizById[0]['quizName'];} ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Quiz Image</label>
										<div class="col-sm-10">
											<img class="img-responsive" onclick="myfunction();"  id="image1" src="<?php echo base_url();?>uploads/quizImage/<?php if($quizById[0]['quizImage']){echo $quizById[0]['quizImage'];}else{ echo 'noImage.png'; }?>" style="width: 124px; border: 1px solid #e7eaec;padding:5px; cursor:pointer;" >
											<input  type="file" style="display:none;" name="quizImage" id="inputImage" class="" value="" onchange="imageChange(this,'image1')" >
										</div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo base_url(); ?>index.php/home/quiz" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
									 </div>
                                </div>
						   </form>
					   </div>
					</div>
					<div id="tab-3" class="tab-pane">
								<div class="ibox-title">
									<h5>Quiz List</h5>
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
													<th>Quiz Name</th>
													<th>Quiz Image</th>
													<th>Date & Time</th>
													<th>Created By</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($quizNameList as $value) { ?>
                                                <tr id="row<?php echo $value['quizId']; ?>">
													<td><?php echo $value['quizName']; ?></td>
													<?php $src = 'noImage.png'; if(!empty($value['quizImage'])){ $src = $value['quizImage'];}?>
													<td><img style="width: 100px; height: 90px;" src="<?php echo base_url().'uploads/quizImage/'.$src;?>"></td>
													<td><?php echo date('d-m-Y H:i:s', strtotime($value['createdDate'])); ?></td>
													<td><?php echo $value['empName'];?></td>
													<td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['quizId']; ?>,'quizId','tbl_quiz_names')">
														Delete</span>
														<a href="<?php echo base_url(); ?>index.php/home/quiz/<?php echo $value['quizId']; ?>"><span class="btn-white btn btn-xs">
														Edit</span></a>
														<a href="<?php echo base_url(); ?>index.php/home/quizData/<?php echo $value['quizId']; ?>"><span class="btn-white btn btn-xs">
														See more</span></a>
													</td>
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


			function myfunction(){
	          $('#inputImage').trigger('click');
			
		}
		
		function imageChange(input,clickId){
				if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+clickId).attr('src', e.target.result).width(126).height(114);
                };

                reader.readAsDataURL(input.files[0]);
            }			 
			 
			}
		</script>
		
		
		
