<!-- <style>

@media only screen and (min-width: 800px) {
	#comments{
    width: 70%;
    padding: 20px 10px;}
    .commentlist li{    padding: 15px;}

}


	@media only screen and (max-width: 600px){ {padding: 20px 10px;}
.commentlist li{    padding: 15px;}

}
</style> -->


<?php if($this->uri->segment(2) != "contactUs"){?>
<div id="comments">
	<?php if(!empty($comments)){?>
	<div class="comments-box">
<div class="block-head">
			<h3 id="comments-title"><?php echo count($comments); ?> comments </h3><div class="stripe-line"></div>
		</div>			
	<div class="post-listing">
		<ol class="commentlist">
			 <?php foreach($comments as $comments){?>	
			<li id="comment-30">
				<div class="comment byuser comment-author-admin bypostauthor even thread-even depth-1 comment-wrap">
			<div class="comment-avatar"><img alt="" src="http://0.gravatar.com/avatar/fc726d5e275de7b08b0c9a1dd1fc623f?s=65&amp;d=mm&amp;r=r" srcset="http://0.gravatar.com/avatar/fc726d5e275de7b08b0c9a1dd1fc623f?s=130&amp;d=mm&amp;r=r 2x" class="avatar avatar-65 photo tie-appear" height="65" width="65"></div>

			<div class="comment-content">
			 
				<div class="author-comment">
					<cite class="fn"><?php echo $comments['comment_author']?></cite> 					<div class="comment-meta commentmetadata"><a href="http://101.53.136.41/sahya/information/gender-sexuality/#comment-30">	<?php echo date('F d,Y',strtotime($comments['comment_date']));?> at <?php echo date('h:i a',strtotime($comments['comment_date']));?></a></div><!-- .comment-meta .commentmetadata -->
					<div class="clear"></div>
				</div>
			
									
				<p><?php echo $comments['comment_content']?></p>
				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="http://101.53.136.41/sahya/information/gender-sexuality/?replytocom=30#respond" onclick="return addComment.moveForm( &quot;comment-30&quot;, &quot;30&quot;, &quot;respond&quot;, &quot;1006&quot; )" aria-label="Reply to admin">Reply</a>
			</div><!-- .reply -->
			
			</div>

		</div><!-- #comment-##  -->

				
			</li>
				<?php }?>
		</ol>	
	</div>
	

</div>
<?php }?>
<div class="clear"></div>
	<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">Leave a Comment <small>
			<a rel="nofollow" id="cancel-comment-reply-link" href="/sahya/information/gender-sexuality/#respond" style="display:none;">Cancel reply</a>
			</small>
		</h3>
		<div class="stripe-line"></div>			
		<form action="<?php echo base_url() ?>index.php/homeweb/insertCommentWp/<?php echo $pageId;?>" method="post" id="commentform" class="comment-form" novalidate="novalidate">
<p class="comment-notes">
	<span id="email-notes">Your email address will not be published.</span>
</p>
<p class="comment-form-comment">
	<label for="comment">Comment</label> 
	<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>
</p>
<p class="comment-form-author">
	<?php if(!$this->session->userdata('validated') || $this->session->userdata('userType') == 'admin'){?>
		<label for="author">Name</label> 
		<span class="required">*</span> (Your name will be displayed on website)<?php }?>
		<input id="author" autocomplete="off" name="author" type="<?php if($this->session->userdata('validated') && $this->session->userdata('userType') == 'employee'){echo 'hidden';}else{echo 'text';}?>" value="<?php if(!$this->session->userdata('validated') && $this->session->userdata('userType') != 'employee'){echo $this->session->userdata('userName');}?>" size="30"  aria-required="true" <?php if(!$this->session->userdata('validated') && $this->session->userdata('userType') != 'employee'){echo 'required';}?> >
</p>
<p class="comment-form-email">
	<?php if(!$this->session->userdata('validated') || $this->session->userdata('userType') == 'admin'){?>
		<label for="email">Email</label><?php }?>
		<input id="email" autocomplete="off" name="email" type="<?php if($this->session->userdata('validated') && $this->session->userdata('userType') == 'employee'){echo 'hidden';}else{echo 'text';}?>" value="<?php if(!$this->session->userdata('validated') && $this->session->userdata('userType') != 'employee'){echo $this->session->userdata('email');}?>" size="30"  aria-required="true"<?php if(!$this->session->userdata('validated') && $this->session->userdata('userType') != 'employee' ){echo 'required';}?> >
</p>
<p class="comment-form-url">
	<?php if(!$this->session->userdata('validated') || $this->session->userdata('userType') == 'admin'){?>
		<label for="url">Website</label><?php }?>
		<input id="url" name="url" type="<?php if($this->session->userdata('validated') && $this->session->userdata('userType') == 'employee'){echo 'hidden';}else{echo 'text';}?>" value="" size="30" >
</p>
<?php if(!$this->session->userdata('validated') || $this->session->userdata('userType') == 'admin'){ ?>
<p class="comment-form-cookies-consent">
	<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
	<label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label>
</p>
<p class="comment-notes-after">
	<span id="email-notes">Your Email or Phone is required (<span class="required">*</span>). Neither will be published on the website as per our Privacy Policy.</span>
</p>
		<?php }?>	
<p class="comment-form-phone">
	<?php if(!$this->session->userdata('validated') || $this->session->userdata('userType') == 'admin'){?>
		
		<label for="phone">Phone</label><?php }?>
		<input id="phone" autocomplete="off" name="phone" type="<?php if($this->session->userdata('validated') && $this->session->userdata('userType') == 'employee'){echo 'hidden';}else{echo 'text';}?>" size="30"  value="<?php $this->session->userdata('mobile')?>"  <?php if(!$this->session->userdata('validated') && $this->session->userdata('userType') == 'employee'){echo 'required';}?> >
	</p>
<p style="order: 7;">
	<span id="email-notes"><bold>Note : </bold>On approval of your comment by our Web Administrator, your name will be displayed along with your comment on the website.</span>
</p>	
<p class="form-submit">
	<input name="submit" type="submit" id="submit1"  class="submit" value="Post Comment"> 
	<input type="hidden" name="comment_post_ID" value="1006" id="comment_post_ID">
	<input type="hidden" name="comment_parent" id="comment_parent" value="0">
</p>			
<p class="comment-subscription-form"><input type="checkbox" name="subscribe_blog" id="subscribe_blog" value="subscribe" style="width: auto; -moz-appearance: checkbox; -webkit-appearance: checkbox;"> <label class="subscribe-label" id="subscribe-blog-label" for="subscribe_blog">Notify me of new posts by email.</label></p>
</form>
			</div><!-- #respond -->
	

</div>
<?php }?>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>