<style>
ol .active{
	font-weight: bold;
    
}
.panel-default>.panel-heading {
    color: #fff;
    background-color: #76b51b;
    border-color: #ddd;
}
.panel-body {
  
    background: #f9f9f9;
}

.hover_bkgr_fricc > div {
    background-color: #efebe9f7;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 220px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 60px 5%;
    color: #fff;
    font-size: 15px;
}
.nextbtn{

	background: #76b51b;color: #fff;width: 75%;height: 30px;
}

.back_button li{font-size: 18px;
    top: -10px;
    position: relative;
    padding: 10px 10px;
    background: #a5630d;
    color: #fff;
    border-radius: 5px;
}

.back_button li a {    color: #fff;}


.stopPlay{
	background: #de7428;
    width: 55%;
    height: 30px;
    color: white;
}

.corretAns{
	color: black;
    font-weight: bold;

}
   
.submitSuccess {
    width: auto;
    position: relative;
    background-color: #76b51b;
    color: #FFF;
    padding: 5px 12px;
    font: 12px Tahoma;
    display: inline-block;
    line-height: 22px;
    border: 0 none;
    cursor: pointer;
    text-decoration: none;
}   
#quizComplete{
	margin: 0 50px;
	height: 130px;
	display: none; 
	font-size: 18px;
}  

.okbtn {
    background: red;
    color: #fff;
    width: 75%;
    height: 30px;
}

.cancelBtn{

	background: green;
    width: 55%;
    height: 30px;
    color: white;	
}
</style>
    <!-- Page Content 
	<div id="main-content" class="container">-->
		<div class="content">   
			<div class="row wrapper border-bottom white-bg page-heading">

				<div class="col-lg-12 back_button">
					<li style="font-size: 15px;" class="fa fa-angle-left pull-right">
							<a href="javascript:void(0)"> Back </a>
						</li>
					
				</div>

				<div class="col-lg-12">
				<h4>QUIZ QUESTIONS</h4>
				<div class="row">
					<div class="col-md-9">
					<ol class="breadcrumb">
						<!-- <li class="">  
							<a href="<?php echo base_url();?>index.php/homeweb/playedQuiz">PLAYED QUIZ</a>
						</li>
						<li class="">  
							<a href="<?php echo base_url(); ?>index.php/homeweb/quiz">START YOUR QUIZ</a>
						</li> 
						<li class="">
							<a href="<?php echo base_url(); ?>index.php/homeweb/quiz">QUIZ</a>
						</li> -->
						<li class="active">
							<a href="#"><?php echo $quizName; ?></a>
						</li>
						
					</ol>
					</div>
					<div class="col-md-3 ">
						<!-- <li style="font-size: 15px;" class=""> -->
						<input name="submit" type="button" id="submitQ" class="submit pull-right" value="Submit Test" style="font-size: 15px;margin-top: -53px;">
						<!-- </li> -->
					</div>

				</div>
				</div>

				
			</div>

			<div id="quizComplete">		
				<div style="font-weight: bold;margin-top: 10px;color:green;" > Congratulations  <img src="https://s.w.org/images/core/emoji/2.4/svg/1f600.svg" height="10" width="30"> You have completed the quiz.
				Please submit your answers using the </br>
				Submit Test button on topright corner</br>		
				</div>
			</div>		

			<form method="post" id="quizForm" action="<?php echo base_url(); ?>index.php/homeweb/submitQuiz">
				<input type="hidden" name="quizId" value="<?php echo $quizId; ?>">
				<?php $i=1; foreach($quizQuestionsList as $name) { ?>
				<div class="panel panel-default" id="question<?php echo $i; ?>" >
					<div class="panel-heading">
						<strong>Question <?php echo $i; ?> :</strong> <?php echo $name['quizQuestionName']; ?>							
					</div>					
					<div class="panel-body">
					<?php $j=1; foreach($name['options'] as $options) { ?>
						<div>
							<div id="message<?php echo $i.$j; ?>"></div>
							<?php if($name['typeOfAnswer'] == 'SCA'){?> 
							<label>
								<input type="radio" data-ques="<?php echo $i.$j; ?>" value="<?php echo $options['optionId']; ?>" id="optionsRadios1"  name="options[<?php echo $name['quizQuestionId']; ?>][]" class="question<?php echo $i; ?>" > <?php echo $options['optionName']; ?>
							</label> 
						<?php }else{?>
						<label>
								<input type="checkbox" data-ques="<?php echo $i.$j; ?>" value="<?php echo $options['optionId']; ?>" id="optionsRadios1"  name="options[<?php echo $name['quizQuestionId']; ?>][]" class="question<?php echo $i; ?>" > <?php echo $options['optionName']; ?>
							</label>	
						<?php }?>	
						</div>
						<?php $j++; } ?>    
					</div>
					
				</div>
				<?php $i++; } ?>
				<button type="button" class="next submitSuccess" >Submit Answer</button>
				<!-- <input name="submit" type="submit" id="submit" class="submit" value="Submit Answer"> -->
			</form>
		
						
	

			
			
		</div>


		<div class="hover_bkgr_fricc" id="nextQuestion">
		    <span class="helper"></span>
		    <div>			
				<div id="infoDIv">

				</div>
				<div class="" style="width: 100%;margin-top: 25px;display: flex;">
				 <div class="popupCloseButton" style="width: 50%;">	
					<button type="button" class="btn btn-primary btn-md nextbtn">Next Question</button> 
				 </div>
				 <div  style="width: 50%;">	
					<button  type="button" class="btn btn-primary btn-md stopPlay">Stop Play</button>
				 </div>	
				</div>    	
		    </div>
		</div>


		<div class="hover_bkgr_fricc" id="incompleteTest" >
		    <span class="helper"></span>
		    <div>			
				<div id="infoDIv">
						<div style="font-weight: bold;margin-top: 10px;color:red;" > 
							Please complete your test.	
						</div>
				</div>
				<div  style="width: 100%;margin-top: 25px;">
				 <div >	
					<button  type="button" class="btn btn-primary btn-md popupCloseButton ">OK</button>
				 </div>	
				</div> 	
		    </div>
		</div>


		<div class="hover_bkgr_fricc" id="leaveTest" >
		    <span class="helper"></span>
		    <div>			
				<div id="infoDIv">
						<div style="font-weight: bold;margin-top: 10px;color:red;" > 
							Do you want to leave quiz without Submitting test?	
						</div>
				</div>
				<div  style="width: 100%;margin-top: 25px;display: flex;">
				 <div class="popupCloseButton" style="width: 50%;">	
					<button type="button" class="btn btn-primary btn-md cancelQuiz okbtn">Ok</button> 
				 </div>
				 <div  style="width: 50%;">	
					<button  type="button" class="btn btn-primary btn-md popupCloseButton cancelBtn">Cancel</button>
				 </div>	
				</div> 	
		    </div>
		</div>
		

    <!-- /.Page Content -->
  	<script type="text/javascript">
  	    
   (function($) {
  $(document).ready(function(){


  	$('.panel').hide();
  	$('#question1').show();
  	var nextdiv=1;
  	var lastQuestion = <?php echo count($quizQuestionsList); ?>;

  	var answer1 = [];

  	$('.next').click(function(){
		
		
		if(nextdiv > lastQuestion){
			
			event.preventDefault();
       		 $('.next').attr('onclick','').unbind('click');
       		 $('#quizComplete').show();
       		 //alert('your test is complete.');
		}else{



	    	$(this).attr('checked','checked');
	    	 var value = $(this).val();
	    	 var i = $(this).attr('data-ques');


            //alert($(this).attr('type')); 

           
			 /*var answer = [];
		        $("input:checkbox[class=question"+nextdiv+"]:checked").each(function () {
		             answer.push($(this).val());
		        });*/
          
           var answer = [];

            $(".question"+nextdiv).each(function(){
            	if($(this).attr('type') == 'radio')
            	{
            		 $("input:radio[class=question"+nextdiv+"]:checked").each(function(){
            	           answer.push($(this).val());
                    }); 
            	}
               	else{
                      $("input:checkbox[class=question"+nextdiv+"]:checked").each(function () {
		             answer.push($(this).val());
		           });
            	}	
            });

		    if (answer.length == 0) 
		    {
		    	//alert(nextdiv);
		    	//alert(answer);
		    	//alert(answer.length);
		    	//alert(answer1.length);
		    		alert('Please answer your question');
		    		//alert(answer1.length);
		    } else{ 		    

		    $('#infoDIv').html('');    
			var html = '';

				

	    	 //alert(answer);
	         $.ajax({
	         	type:"POST",
	         	url:"<?php echo base_url()?>index.php/homeweb/showMessage",
	         	data:{optionId:answer},
	         	async:false,
	         	success:function(data){
	         		//$('.hover_bkgr_fricc').show();
	         		//alert(answerNew);
	         		alert(answer);
	         		$('#nextQuestion').show();
	         		var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;
					html = '<div class="corretAns"><span>Correct Answer(s) : </span>';
					for (var i = 0; i <= result['rigthAnswer'].length-1; i++) {
						html += result['rigthAnswer'][i]['quizQuestionOptionName'];
						if(i != result['rigthAnswer'].length-1){
							html += ',';
						}
					}
					if(result[0]['AdditionalInfoIncaseOfCorrectAnswer'] != ''){	
					html += '</div><div style="color: black;margin-top: 10px;"> < '+result[0]['AdditionalInfoIncaseOfCorrectAnswer']+' > </div>';
					}
					if(result['youranswer'][0] == 'correct'){
						html += '<div style="font-weight: bold;margin-top: 10px;color:green;"> Your answer is Correct! <img src="https://s.w.org/images/core/emoji/2.4/svg/1f600.svg" height="10" width="30"></div>';	
					}
					if(result['youranswer'][0] == 'wrong'){
						html += '<div style="margin-top: 10px;color:red;font-weight: bold;">Sorry <img src="https://s.w.org/images/core/emoji/2.4/svg/1f614.svg" height="10" width="30">,your answer is incorrect/insufficient!</div>';	
					}
								
					$('#infoDIv').html(html);
	         	}
	         });

	        } 

  		}
  	});

    $('.nextbtn').click(function() {
		$('.panel').hide();
		nextdiv = nextdiv + 1;
  		$('#question'+nextdiv).show();	

  		if(nextdiv > lastQuestion){
       		 $('#quizComplete').show();
   		}	        	
    }); 

 	$(".trigger_popup_fricc").click(function(){
       //$('.hover_bkgr_fricc').show();
       $('#nextQuestion').show();
    });
    $('.hover_bkgr_fricc').click(function(){
       // $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });

    $('#submitQ').click(function(){

    	if(nextdiv > lastQuestion){
    		$('#quizForm').submit();
   		 }else{
   		 	$('#incompleteTest').show();
   		 }
    });

    $('.stopPlay').click(function(){

    	if(confirm('DO YOU WANT TO LEAVE THE QUIZ WITHOUT COMPLETING IT ?')){
    		window.location = '<?php echo $this->agent->referrer(); ?>';
    	}
    	

    });

    $('.back_button').click(function(){

    	$('#leaveTest').show();

    });

 	$('.cancelQuiz').click(function(){	
    	window.location = '<?php echo $this->agent->referrer(); ?>';
    });
/*    $(":checkbox").click(function(){
    	//alert($(':checkbox').attr('checked','checked'));
    	$(this).attr('checked','checked');
    	 var value = $(this).val();
    	 var i = $(this).attr('data-ques');
    	 //alert(i);
         $.ajax({
         	type:"POST",
         	url:"<?php echo base_url()?>index.php/homeweb/showMessage",
         	data:{optionId:value},
         	success:function(data){
         		var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(result[0]['AdditionalInfoInCaseOfWrongAnswer'])
				{
					$('#message'+i).html("<p style='color:red'>"+result[0]['AdditionalInfoInCaseOfWrongAnswer']+"</p>");
                    //alert(result[0]['AdditionalInfoInCaseOfWrongAnswer']);
				}
				else{
					$('#message'+i).html("<p style='color:green'>"+result[0]['AdditionalInfoIncaseOfCorrectAnswer']+"</p>");
                  //alert(result[0]['AdditionalInfoIncaseOfCorrectAnswer']);
				}	
         	}
         });
    })*/
 });
}(jQuery));	   		
    </script>
 	   	
