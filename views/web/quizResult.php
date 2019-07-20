<style>
ol .active{
	font-weight: bold;
    
}

.back_button li{font-size: 18px;
    top: -53px;
    position: relative;
    padding: 10px 10px;
    background: #a5630d;
    color: #fff;
    border-radius: 5px;
}

.back_button li a {    color: #fff;}


button{    background: #f43d2a !important;
    color: #fff !important;
    margin-top: 10px;}

</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>QUIZ RESULT</h4>
			<div class="col-md-12 ">
                  
            </div>
                <div class="col-md-3 back_button">
                	<li style="font-size: 15px;" class="fa fa-angle-left pull-right">
							<a href="<?php echo base_url(); ?>homeweb/quiz"> Back To Quiz </a>
					</li>
				</div>
            </div>
            
        </div>
		<?php //echo '<pre>'; print_r($this->session->all_userdata()); exit;?>
		<h4>Your score is <?php if(strpos($quizResult['quizTotalMarks'],'.')!==false)
		{echo number_format((float)$quizResult['quizTotalMarks'],1,'.','');}
		else{echo $quizResult['quizTotalMarks']; } ?> /<?php echo $quizResult['quizOutofMarks']; ?></h4>
			<?php if(!$this->session->userdata('validated')){ ?>
			Please collect your gift coupon from your on ground partner.<br>

			<a href="<?php echo base_url(); ?>index.php/homeweb/login/quiz/<?php echo $quizResult['quizUniqueNumber'];?>" ><button class="btn btn-primary" type="submit">Login</button></a>
			<a href="<?php echo base_url(); ?>index.php/homeweb/createUser" ><button class="btn btn-primary" type="submit">Register</button></a>
			<?php } else {?>
			Claim your gift coupon
			<a href="<?php echo base_url();?>index.php/homeweb/getGiftCoupon/<?php echo $quizResult['quizUniqueNumber']; ?>"><button class="btn btn-primary">Get Coupon</button></a>
			<?php }?>
			
		<?php if(!empty($quizResult['data'])){?>	
		<?php $i=1; foreach($quizResult['data'] as $val) { ?>
		<div class="well m-t"  <?php if( $val['answer'] == $val['correctAnswer']){ 
			echo "style='background-color: #90EE90  !important;' "; }else{ echo "style='background-color: #F9CCCA !important;' ";} ?>  >
		<strong>Question <?php echo $i;?> : </strong><?php echo $val['quizQuestionName']; ?><br><strong>Your Answer : </strong> <?php echo $val['answer']; ?><br>
		<strong>Correct Answer : </strong><?php echo $val['correctAnswer']; ?>
		
        </div>
							<?php $i++; } ?>
		<?php }?>

						
		

       
		

			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->