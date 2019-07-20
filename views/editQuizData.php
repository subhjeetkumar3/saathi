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
                                
								  <li class="active"><a data-toggle="tab" href="#tab-3"><i class="fa fa-user"></i>Quiz List</a></li>
								   <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>New Entry</a></li>
								 <!--<li class="<?php if(!empty($quizById)){ echo 'active'; }else { echo ''; } ?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Quiz Entry</a></li>-->
								
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					 <div id="tab-2" class="tab-pane">
						<div class="ibox-title">
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/uploadExcelQuiz" >
							   <div class="form-group" style="margin:0px;">
								   <div class="row">
									   <div class="col-lg-12">
										  
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
						 
						 <div id="tab-1" class="tab-pane">
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/insertQuizData" >
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Question Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="questionName" value="" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Options</label>
										<div class="col-sm-8">
									    	<input type="text" required name="options[]" class="form-control">
									    	<input type="checkbox" value="1" name="answer[]" class="">
									    		
										<!-- </div>
										<div class="col-sm-8"> -->
									    	<input type="text" name="options[]" class="form-control">
									    		<input type="checkbox" value="1" name="answer[]" class="">
									    		
									    	
									    	<div id="optionsDiv"></div>	
										</div>
										<input type="hidden" name="count" class="count">
										<input type="hidden" name="quizId" value="<?php echo $quizId?>" >
										<div class="col-sm-2" >
										  <span style="" class="btn btn-primary" id="surveyDivBtn" onclick="appendQuesDivExtra();"><i class="fa fa-plus" aria-hidden="true"></i></span>
									</div>
									</div>
									<div  class="form-group">
										<div class="col-sm-12">
										<label class="col-sm-2 control-label">Type of answer</label>	<div class="col-sm-8">
										<select name="answerType" class="form-control">
											<option>-type of answer-</option>
											<option value="Single Correct Answer(SCA)">Single Correct Answer(SCA)</option>
											<option value="Multiple Correct Answers(MCA)">Multiple Correct Answers(MCA)</option>
										</select>
										</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Number of correct options</label>
											<input type="text" onkeypress="return isNumberKey(event)"  name="numCorrect" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Marks for each correct options</label>
											<input type="text" onkeypress="return isNumberKey(event)"  name="marks" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Additional Info</label>
											<input type="text" name="info" class="form-control">
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
					<div id="tab-3" class="tab-pane active">
								<div class="ibox-title">
									<h5><?php echo $quizData[0]['quizName']?></h5>
									<h5>   Quiz List</h5>
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
													<th>Options</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($quizData as $value) { ?>
                                                <tr id="">
													<td><?php echo $value['quizQuestionName']; ?></td>
											        <td><?php
											         $i =1; 
											        $optionData = explode('||',$value['options']); foreach ($optionData as $key => $val) {
											        	$optName = explode('-',$val);
											        	$optionname = $i.'-'.$optName[0].'  ';

											        	if($optName[1] == 0)
											        	{
											        		$optionname .= '<i style="color:red" class="fa fa-times"></i>';
											        	}else{
											        		$optionname .= '<i style="color:green" class="fa fa-check"></i>';
											        	}	

											        	echo $optionname;
											        	echo "<br>";
											        	$i ++;
											        } ?></td>
													<td class="text-right footable-visible footable-last-column">
														<span class="btn-white btn btn-xs"
														onclick="deletedTransData(<?php echo $value['quizId']; ?>,'quizId','tbl_quiz_names')">
														Delete</span>
														<a href="<?php echo base_url(); ?>index.php/home/editQuizData/<?php echo $value['quizQuestionId']; ?>"><span class="btn-white btn btn-xs">
														Edit</span></a>
														
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

				var k = 0; var i =0;

			var count = 0;

		function appendQuesDivExtra()
		{
                 var ht = '<div  id="optionId'+(k+1)+'"><i number="'+(k+1)+'" id="optionIdCross'+(k+1)+'" class="fa fa-times" onclick="removeOption(this)"></i><input type="text" class = "form-control" name="options[]"><input type="checkbox" value="1" name="answer[]" class=""></div>';

                    count++;   
             $('.count').val(count);  

      		  $("#optionsDiv").append(ht);
                k++;
 
		}

		  	function removeOption(val)
      	{
      		var id = $(val).attr('number');

      		 count--;   

      		   $('.count').val(count);  

      		$("#optionId"+id).html('');       
      	}




		

		</script>
		
		
		
