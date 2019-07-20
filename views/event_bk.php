<style>
ol .active{
	font-weight: bold;
    
}
.product-desc {
height: 200px;
overflow: hidden;
}
</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content"> 
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>EVENTS</h4>
					<ol class="breadcrumb">
					 <?php if($type != 'past' && $type != 'upcoming'){?>	
						<li class="<?php if($type != 'past' && $type != 'upcoming'){ echo 'active'; } ?>">
							<a href="<?php echo base_url(); ?>index.php/homeweb/event">ALL</a>
						</li>
						<?php }?>
						<?php if($type == 'past'){?>
						<li class="<?php if($type == 'past'){ echo 'active'; } ?>">
							<a href="<?php echo base_url(); ?>index.php/homeweb/event/past">PAST</a>
						</li>
						<?php }?>
						<?php if($type == 'upcoming'){?>
						<li class="<?php if($type == 'upcoming'){ echo 'active'; } ?>">
							<a href="<?php echo base_url(); ?>index.php/homeweb/event/upcoming">UPCOMING </a>
						</li>
						<?php }?>
					</ol>
				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="main-box-body clearfix">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<?php foreach($eventList as $data){ //pr($data);?>
								<tr>
									<div class="col-md-6" >
										<div class="ibox">
											<div class="ibox-content product-box">
												<div class="product-imitation">
													<img src="<?php echo base_url(); ?>uploads/eventImage/<?php echo $data['eventImage'];?>" style="width:100%;height: 50vh;">
												</div>
												<div class="product-desc">
													<a href="<?php echo 'http://'.$data['website']?>" target="_blank" ><span style="font-weight:bold;color: #0371d2;" class="product-price">
														<?php echo $data['eventName'];?>
													</span>
													
													<div style="color: #f30584;" class="small m-t-xs">
													<?php echo $data['eventVenue'];?>
													</div>
													<div style="color: #e65f18;" class="small m-t-xs">
													<?php if((!empty($data['startDate'])) || (!empty($data['startTime'])) ){ ?>	
														<p style="margin: 0;">
														<span>Start Day & Time </span>	
													     <?php echo $data['startDate'];?>
													      <?php if(!empty($data['startTime'])){echo date('g:ia',strtotime($data['startTime']));}?>
													  </p>
													  <?php }?>
													  <?php if((!empty($data['endDate'])) || (!empty($data['endTime'])) ){ ?>
													      <p style="margin: 0;"> 
													      <span>End Day & Time</span>	
													        <?php echo $data['endDate'];?>
													        <?php if(!empty($data['endTime'])) {echo date('g:ia',strtotime($data['endTime']));}?>
													       </p> 
													      <?php }?>
													       <p style="margin: 0;">
													       	<?php echo $data['otherInfo']?>
													       </p>
													    </div>
													    <!--<div style="color: #e65f18;" class="small m-t-xs" style="margin-bottom: 0;">
													     
													    </div>-->
												</div>
											</div>
										</div>
									</div>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<ul class="pagination pull-right" style="position:  absolute;">
					<?php foreach ($links as $link) {
						echo "<li>". $link."</li>";
						} ?>
					</ul>
				</div>			
				<!--<div class="row">
					<?php foreach($eventList as $data){?>
					<div class="col-md-6">
						<div class="ibox">
							<div class="ibox-content product-box">
								<div class="product-imitation">
									<img src="<?php echo base_url(); ?>uploads/eventImage/<?php echo $data['eventImage'];?>" style="width:100%;height: 50vh;">
								</div>
								<div class="product-desc">
									<span style="font-weight:bold;color: #0371d2;" class="product-price">
										<?php echo $data['eventName'];?>
									</span>
									
									<div style="color: #f30584;" class="small m-t-xs">
										<?php echo $data['eventVenue'];?>
									</div>
									<div class="m-t text-righ">
										<span style="color: #e65f18;"><?php echo $data['eventDate'];?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>-->
			</div>
		</div>
		
		<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>
	</div>
    <!-- /.Page Content -->