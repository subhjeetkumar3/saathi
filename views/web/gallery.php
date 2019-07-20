<?php /* Template Name: Events  */?>
<style>
.product-desc {
height: 200px;
overflow: hidden;
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
.modal {
    display: block; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
	display: none;
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


.breadcrumb > li:last-child::after {
    content: open-quote !important;
    
}
</style>
    <!-- Page Content -->
	<!-- <div id="main-content" class="container"> -->
		<div class="content"> 
		<article>
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-12">
				<h4>GALLERY</h4>
					
				</div>
			</div>
			<!-- <div class="wrapper wrapper-content animated fadeInRight"> 				
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody> -->
				<div class="post-inner">
				  <div class="entry">
								<?php foreach($contentList as $data){ //pr($data);?>
								<!-- <tr> 
								    <div class="clear"></div>-->
									<div class="one_half" style="margin-right: 2%;margin-bottom: 0.5% !important;">
										<div class="ibox">
											<div class="ibox-content product-box">
												<div class="product-imitation">
												<?php if($data['contentType'] == 'image'){?>	
												<img src="<?php echo base_url().'uploads/galleryData/'.$data['content']; ?>" style="width:100%;height: 50vh;">
												<?php }elseif ($data['contentType'] == 'link') { ?>
                          <a target="_blank"  href="<?php echo 'https://'.$data['link']; ?>"><span style="font-weight:bold;color: #0371d2;" class="product-price">
                            <iframe src="<?php echo str_replace('watch?v=','embed/','https://'.$data['link']); ?>"></iframe>
                            <?php echo $data['link'];?>
                          </span></a>
                      <?  } else{?>
													<video style="width :100%;height: 50vh;"  controls>
														<source src="<?php echo base_url().'uploads/galleryData/'.$data['content']?>" type="video/mp4">
													</video>
												<?php }?>	
												</div>
												<div class="product-desc">
				                   <div style="color: #f30584;font-size: 15px;" class="small m-t-xs">
                          <?php echo $data['contentName'];?>
                          </div>  

                          <div style="margin: 0;overflow: hidden;">
                                  <?php echo $data['description']?>
                                  </div>           	
												<div>	
												
													</div>
													
													<!--<div style="color: #e65f18;" class="small m-t-xs">
													       	 <a class="content" data-event="<?php echo $data['id'];?>"  style="color: blue;float:right;cursor: pointer;font-size:16px;font-weight: bold;border: 1px solid blue;margin-top: 2%;margin-bottom:0.5%;padding: 0.5%;border-radius: 5%;"><span>See More</span></a>
													    </div>-->
													    <!--<div style="color: #e65f18;" class="small m-t-xs" style="margin-bottom: 0;">
													     
													    </div>-->
												</div>
											</div>
										</div>
									</div>
								 
							<!--	</tr> -->
								<?php } ?>
						<!--	</tbody>
						</table>
					</div>-->
				  </div>
				  	<div class="clear"></div>
					<!--<div class="paginate">
						<ul class="pagination">
						<?php foreach ($links as $link) {
							echo "<li>". $link."</li>";
							} ?>
						</ul>
					</div>-->
					<div class="clear"></div>
				</div>			
				
			</article>

		
		
		</div>

		<div class="hover_bkgr_fricc">
		    <span class="helper"></span>
		    <div>			
				<div id="infoDIv">

				</div>
   	
		    </div>
		</div>
	
		
	<!--	<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php // echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>
	
	</div>-->
    <!-- /.Page Content -->
   <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
    <script type="text/javascript">
     (function($){
          $('#infoDIv').html('');

           //alert(type);
          $('.content').click(function(){
          	//alert($(this).attr('data-event'));
          	var contentId = $(this).attr('data-event');
          	$.ajax({
          		type : "POST",
          		url : "<?php echo base_url()?>index.php/homeweb/contentInfo",
          		data : {contentId:contentId},
          		success:function(data){
                   // alert(data);
                    var rslt = $.trim(data);
					result = JSON.parse(rslt);
					var len = result.length;

                     var htm = "<div class='ibox'><a href='<?php echo base_url();?>homeweb/event/"+type+"'><img src='<?php echo base_url();?>uploads/eventImage/close-button.png' width='25' height='25' style='float:right'></a><div class='ibox-content product-box'><div class='product-imitation'><img src='<?php echo base_url(); ?>uploads/eventImage/";
                     if(result[0]['eventImage'])
                     {
                     	htm += result[0]['eventImage'];
                     }
                     else{
                     	htm += 'dummy_image.jpg';
                     }	
                     
                     htm += "' style='width:100%;height: 50vh;'></div><div class='product-desc'><div><span style='font-weight:bold;color: #0371d2;margin-bottom:2%;' class='product-price'>"+result[0]['eventName']+"</span></div><div style='color: #f30584;text-align:left;margin-bottom:2%;'  >"+result[0]['eventVenue']+"</div><div style='color: #e65f18;' class='small m-t-xs'>";
                     if(result[0]['startDate'] || result[0]['startTime'])
                    { 
                       var mydate = new Date(result[0]['startDate']);

                       var str = mydate.toString("dd MMMM yyyy");	
                     htm +=  "<p class='small m-t-xs' style='text-align:left;'><span>Starts on </span>"+str;

                     
                   }

                  /* if(result[0]['startTime'])
                   {
                   	  var date = new Date(result[0]['startTime']);

                   	  htm +=  date;
                   }
*/
                   htm += "</p><p>";

                   if(result[0]['endDate'] || result[0]['startTime'])
                   {
                   	 var mydate1 = new Date(result[0]['endDate']);
                     
                        var end = mydate1.toString("dd MMMM yyyy");

                        htm += "<p class='small m-t-xs' style='text-align:left;'><span>Ends on </span><span style='margin-left:5px;'>"+end;
                   }

                    htm += "</span></p><p>";
             
                   htm += "<p style='text-align:left;margin-top:2%;'>"+result[0]['otherInfo'];

                   htm += "</p></div></div></div></div>";
                    
          	$('#infoDIv').html(htm);
          	$('.hover_bkgr_fricc').show();
          		}
          	});

          	
         });
      
    })(jQuery);

    </script>