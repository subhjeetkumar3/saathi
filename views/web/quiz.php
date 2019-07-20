
<style>
ol .active{
	font-weight: bold;
    
}
</style>
    <!-- Page Content 
	<div id="main-content" class="container">-->
	<div class="content">   
        <article>	
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>Play a QUIZ. Win exciting Gifts!</h4>
					<ol class="breadcrumb">
						<!-- <li class=""><a href="<?php echo base_url(); ?>index.php/homeweb/quiz">START QUIZ</a></li> -->
						<li class="active">
							<a href="">START QUIZ</a>
						</li>
						 <li class=""><a href="<?php echo base_url();?>index.php/homeweb/playedQuiz">PLAYED QUIZ</a></li>
					</ol>
				</div>            
			</div>
		
				<div class="post-inner">
					<div class="entry">
						<?php  $i=1;foreach($quizList as $name){ //pr($data);?>
								<!-- <tr> -->
						<div class="one_half" style="margin-right: 2%;">
							<div class="ibox">
								<div style="cursor: pointer;" class="ibox-content product-box quizBox" data-href ="<?php echo base_url(); ?>index.php/homeweb/quizQuestions/<?php echo $name['quizId']; ?>">
									<div class="product-imitation">
										<?php if(!empty($name['quizImage'])){?>	
											<img src="<?php echo base_url(); ?>uploads/quizImage/<?php echo $name['quizImage'];?>" style="width:100%;height: 50vh;" alt="No image">
										<?php }else{?>
										<img src="<?php echo base_url(); ?>uploads/quizImage/noImage.png" style="width:100%;height: 50vh;" alt="No image">
										<?php }?>	
									</div>
									<div class="product-desc">
										<a href="<?php echo base_url(); ?>index.php/homeweb/quizQuestions/<?php echo $name['quizId']; ?>"><span style="font-weight:bold;color: #0371d2;" class="product-price">
											<?php echo $name['quizName']?>
										</span></a>
									</div>
								</div>
							</div>
						</div>		
						<?php } ?>
												
					</div>	
					
								
<!--
<div class="share-post">
	<span class="share-text">Share</span>
	
		<ul class="flat-social">	
			<li><a href="http://www.facebook.com/sharer.php?u=http://101.53.136.41/sahya/saathi/index.php/homeweb/quiz" class="social-facebook" rel="external" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>		
			<li><a href="https://twitter.com/intent/tweet?text=QUIZ&amp;url=http://101.53.136.41/sahya/saathi/index.php/homeweb/quiz" class="social-twitter" rel="external" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
			<li><a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://101.53.136.41/sahya/saathi/index.php/homeweb/quiz/&amp;name=QUIZ" class="social-google-plus" rel="external" target="_blank"><i class="fa fa-google-plus"></i> <span>Google +</span></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://101.53.136.41/sahya/saathi/index.php/homeweb/quiz/&amp;title=QUIZ" class="social-linkedin" rel="external" target="_blank"><i class="fa fa-linkedin"></i> <span>LinkedIn</span></a></li>
			<li><a href="http://pinterest.com/pin/create/button/?url=http://101.53.136.41/sahya/saathi/index.php/homeweb/quiz/&amp;description=QUIZ&amp;media=http://101.53.136.41/sahya/wp-content/uploads/2017/12/sandwich.jpg" class="social-pinterest" rel="external" target="_blank"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a></li>
		</ul>
		<div class="clear"></div>
</div>
-->				
				
				</div>						
				<div class="clear"></div>	
					
		</article>

						
	
		
	</div>	
    <!-- /.Content -->
   	<script type="text/javascript">
	    
		(function($) {
			$(document).ready(function(){
				$(".quizBox").click(function(){
					
					window.location.href = $(this).attr('data-href');

				     
				})
			});
		}(jQuery));	

	</script>	    