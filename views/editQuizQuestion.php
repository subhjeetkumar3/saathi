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
                                
								<!--   <li class="active"><a data-toggle="tab" href="#tab-3"><i class="fa fa-user"></i>Quiz List</a></li> -->
								   <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Update Entry</a></li>
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
						 
						 <div id="tab-1" class="tab-pane active">
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
						   <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateQuizData" >
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label">Question Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="questionName" value="<?php echo $quizData[0]['quizQuestionName'] ?>" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<label class="col-sm-2 control-label">Options</label>
										<div class="col-sm-8">
                                         <?php $options = explode('||', $quizData[0]['options']);

                                             $b = 1; 

                                               foreach ($options as $key => $value) { 
                                                 
                                                 $optData = explode('-', $value);
                                            	?>
                                            	<?php if($b >= 3) {?>
                                            		<br>
                                            		<i id="removeOldQuestion<?php echo $b; ?>" onclick="removeOldQuestion('<?php echo $b; ?>')" class="fa fa-times"></i>

                                            	<?php }?>
                                            		<input type="text" id="optionsOld<?php echo $b; ?>" value="<?php echo $optData[0]?>" required name="optionsOld[]" class="form-control">
									    	<input type="checkbox" id="answerOld<?php echo $b; ?>" onclick="changeAnswer('<?php echo $b; ?>')" <?php if($optData[1]==1){echo 'checked';}else{ echo 'unchecked';}?> value="1" name="answerOld[]" class="">
									    	<input type="hidden" id="answerNew<?php echo $b; ?>"  value="<?php if($optData[1]==1){echo '1';}else{ echo '0'; }?>" name="answerNew[]" class="">
									    	
									    	<input type="hidden" id="optionId<?php echo $b; ?>" name="optionId[]" value="<?php echo $optData[2]; ?>">
                                              	
                                        <?php  $b++;    }  
                                          ?>
                                          <div id="optionsDiv"></div>	
										</div>
									    	<!-- <input type="text" required name="options[]" class="form-control">
									    	<input type="checkbox" value="1" name="answer[]" class=""> -->
									    		
										<!-- </div>
										<div class="col-sm-8"> -->
									    	<!-- <input type="text" name="options[]" class="form-control">
									    		<input type="checkbox" value="1" name="answer[]" class=""> -->
									    		
									    	
									    
										
										<input type="hidden" name="count" class="count">
										<input type="hidden" name="quizId" value="<?php echo $quizData[0]['quizId'] ?>" >
										<input type="hidden" name="questionId" value="<?php echo $questionId ?>" >
										<div class="col-sm-2" >
										  <span style="" class="btn btn-primary" id="surveyDivBtn" onclick="appendQuesDivExtra();"><i class="fa fa-plus" aria-hidden="true"></i></span>
									</div>
										
									</div>
									<div  class="form-group">
										<div class="col-sm-12">
										<label class="col-sm-2 control-label">Type of answer</label>	<div class="col-sm-8">
										<select name="answerType" class="form-control">
											<option>-type of answer-</option>
											<option <?php if($quizData[0]['typeOfAnswer'] == 'Single Correct Answer(SCA)' || $quizData[0]['typeOfAnswer'] == 'Single Correct Answers (SCA)'){echo 'selected';}?> value="Single Correct Answer(SCA)">Single Correct Answer(SCA)</option>
											<option <?php if($quizData[0]['typeOfAnswer'] == 'Multiple Correct Answers(MCA)'){echo 'selected';}?>  value="Multiple Correct Answers(MCA)">Multiple Correct Answers(MCA)</option>
										</select>
										</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Number of correct options</label>
											<input type="text" value="<?php echo $quizData[0]['NumberOfCorrectOptions'] ?>" name="numCorrect" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Marks for each correct options</label>
											<input type="text" value="<?php echo $quizData[0]['MarksForEachCorrectAnswe'] ?>" name="marks" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Additional Info</label>
											<input type="text" value="<?php echo $quizData[0]['AdditionalInfoInCaseOfWrongAnswer'] ?>" name="info" class="form-control">
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
                 var ht = '<div  id="optionIdNew'+(k+1)+'"><i number="'+(k+1)+'" id="optionIdCross'+(k+1)+'" class="fa fa-times" onclick="removeOption(this)"></i><input type="text" class = "form-control" name="options[]"><input type="checkbox" value="1" name="answer[]" class=""></div>';

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

      		$("#optionIdNew"+id).html('');       
      	}

      	function changeAnswer(id)
      	{
      		if($('#answerOld'+id).is(':checked'))
      		{
      			$('#answerNew'+id).val('1');
      		}else{
      		  $('#answerNew'+id).val('0');	
      		} 
      	}


      	function removeOldQuestion(id)
      	{
          $('#optionsOld'+id).prop("disabled", true);
          $('#optionsOld'+id).remove();

          $('#answerOld'+id).prop("disabled", true);
           $('#answerOld'+id).remove();

          $('#answerNew'+id).prop("disabled", true);
            $('#answerNew'+id).remove();

          $('#optionId'+id).prop("disabled", true);
            $('#optionId'+id).remove();

         $('#removeOldQuestion'+id).remove();    
      	}

		</script>
		
		
		
