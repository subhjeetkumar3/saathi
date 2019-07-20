<style>
ol .active{
	font-weight: bold;
    
}
</style>
    <!-- Page Content 
	<div id="main-content" class="container">-->
		<div class="content">    
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>Play A Quiz.Win Exciting Gifts!</h4>
					<ol class="breadcrumb">
						 
						<li class="">
							<a href="<?php echo base_url(); ?>index.php/homeweb/quiz">START QUIZ</a>
							
						</li>
						<li class="active">
							<a href="<?php echo base_url(); ?>index.php/homeweb/playedQuiz">PLAYED QUIZ</a>
							
						</li>
					</ol>
				</div>
				
			</div>
			<?php foreach($playedQuizList as $name) { ?>
			<div class="well m-t"><strong>Quiz Name : </strong>
									<?php echo $name['quizName']; ?><br>
									<strong>Quiz Date : </strong><?php echo $name['quizTakenDate']; ?> <br>
									<strong>Quiz Result : </strong><?php echo $name['quizTotalMarks']; ?>/<?php echo $name['quizOutofMarks']; ?>
									
			</div>
			<?php } ?>
			<?php if(!empty($comments)){?>
	<div class="post-listing">
		<ol class="commentlist">
			 <?php foreach($comments as $comments){?>	
			<li id="comment-30">
				<div class="comment byuser comment-author-admin bypostauthor even thread-even depth-1 comment-wrap">
			<div class="comment-avatar"><img alt="" src="http://0.gravatar.com/avatar/fc726d5e275de7b08b0c9a1dd1fc623f?s=65&amp;d=mm&amp;r=r" srcset="http://0.gravatar.com/avatar/fc726d5e275de7b08b0c9a1dd1fc623f?s=130&amp;d=mm&amp;r=r 2x" class="avatar avatar-65 photo tie-appear" height="65" width="65"></div>

			<div class="comment-content">
			 
				<div class="author-comment">
					<cite class="fn"><?php echo $comments['name']?></cite> 					<div class="comment-meta commentmetadata"><a href="http://101.53.136.41/sahya/information/gender-sexuality/#comment-30">	<?php echo date('F d,Y',strtotime($comments['createdAt']));?> at <?php echo date('h:i a',strtotime($comments['createdAt']));?></a></div><!-- .comment-meta .commentmetadata -->
					<div class="clear"></div>
				</div>z
			
									
				<p><?php echo $comments['comment']?></p>
				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="http://101.53.136.41/sahya/information/gender-sexuality/?replytocom=30#respond" onclick="return addComment.moveForm( &quot;comment-30&quot;, &quot;30&quot;, &quot;respond&quot;, &quot;1006&quot; )" aria-label="Reply to admin">Reply</a>
			</div><!-- .reply -->
			
			</div>

		</div><!-- #comment-##  -->

				
			</li>
				<?php }?>
		</ol>	
	</div>
	<?php }?>
						
	
		
			

			
		</div>
		
	<!--	<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>
	</div>
     /.Page Content -->