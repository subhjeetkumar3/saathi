<style>
.required{
	color : red;
}

.increaseColumn{
	width: 500px;
}
</style>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Event</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Event</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
		<?php if($this->session->flashdata('success_message')){?>
		   <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <?php echo $this->session->flashdata('success_message');?>
                            </div>
		   <?php }?>
			<div class="row">
				<div class="col-lg-12">
							<ul class="nav nav-tabs" style="background-color:white;">
								 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Update Entry</a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
				
						 
						<div id="tab-1" class="tab-pane active">
							<div class="ibox-title">
								<h5>Update Content</h5>
								<div class="ibox-tools">
									<!--<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
									<a class="close-link">
										<i class="fa fa-times"></i>
									</a>-->
								</div>
							</div>
							<div class="ibox-content">
								<form method="post" class="form-horizontal" onsubmit="return checkFormat();" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/updateContent">
									<span style="color: red">Make sure not to put 'https://' or 'http://' before the link</span>
									<input type="hidden" name="contentId" value="<?php echo $contentId; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label">Content Name<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="name" value="<?php echo $galleryData[0]['contentName']?>" required>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Content Type<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<select class="form-control" name="contentType" onchange="setValidation(this.value);checkFormat();">
												<option value="">-Select Content Type-</option>
												<option value="image" <?php if($galleryData[0]['contentType'] == 'image'){echo 'selected';} ?>>Image</option>
												<option value="video" <?php if($galleryData[0]['contentType'] == 'video'){echo 'selected';} ?>>Video</option>
												<option  <?php if($galleryData[0]['contentType'] == 'link'){echo 'selected';} ?> value="link">Link</option>	
											</select>
										</div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="form-control" name="description" ><?php echo $galleryData[0]['description'] ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Link</label>
										<div class="col-sm-10">
											<input type="text" name="link" value="<?php echo $galleryData[0]['link']?>" class="form-control">
										</div>
									</div>
								<?php if($galleryData[0]['contentType'] == 'image' || $galleryData[0]['contentType'] == 'video'){?>	
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Upload audio/video<span class ="required" >*</span></label>
										<div class="col-sm-5">
											<?php if($galleryData[0]['contentType'] == 'image'){?>
												<img style="width: 100%;height: 40%;" onclick="myfunction()" src="<?php echo base_url().'uploads/galleryData/'.$galleryData[0]['content']?>">
											<?php } else{?>	
												<video style="width: 100%;height: 50%;" onclick="myfunction()" controls>
													<source src="<?php echo base_url()."uploads/galleryData/".$galleryData[0]['content'];?>" type="video/mp4">
												</video>
											<?php }?>	
												<input  type="file"  style="display: none" onchange="checkFormat()" accept="image/jpg,image/png/image/gif,image/jpeg,video/mp4,videoMP4" name="content" id="inputImage" class="" value="<?php echo base_url()."uploads/galleryData/".$galleryData[0]['content'];?>" >
										</div>
									</div>
									<?php }?>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2">
											<a href="<?php echo base_url(); ?>index.php/home/gallery" class="btn btn-white">Cancel</a>
											<button class="btn btn-primary" id="formSubmit" name ="submit" type="submit">Submit</button>
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
        <div class="footer">
            
        </div>

        </div>
        </div>
		
<script>
	function isNumberKey(evt){
	//alert(evt);
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}    
</script>	
<script>
		function minlength(val){
			var count = val.length;
			if(count<10){
				$("#mobileSpan").css({'display':'block'});
				$("#formSubmit").attr('type','button');
				$("#mobile").focus();
			}else{
				$("#mobileSpan").css({'display':'none'});
				$("#formSubmit").attr('type','submit');
				//$("#formSubmit").trigger('click');
			}
			
		}
</script>	

<script>
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



	function setValidation(contentType)
	{
		if(contentType == 'image')
		{
			$('#inputImage').attr('accept','image/jpg,/image/png,image/jpeg,image/gif');
		}
		else if(contentType == 'video')
		{
			$('#inputImage').attr('accept','video/mp4');
		}	
	}

	function checkFormat()
	{		
       var content = $('#inputImage').val();

        var arr = content.split(".");

        if($('#contentType').val() == 'image' && arr != '')
        {
            if(arr[1] == 'jpg' || arr[1] == 'png' || arr[1] == 'gif' || arr[1] == 'jpeg')
            {
            	return true;
            	$('#formSubmit').attr('type','submit');
            }
            else{

            	return false;
            	$('#formSubmit').attr('type','button');
            	alert('Content type does not match with Uploaded file format');
            }	
        }
        else if($('#contentType').val() == 'video' && arr!= ''){
          if(arr[1] == 'mp4'|| arr[1] == 'MP4')
            {
            	return true;
            	$('#formSubmit').attr('type','submit');
            }
            else{
            	return false;
            	$('#formSubmit').attr('type','button');
            	alert('Content type does not match with Uploaded file format');
            }

        }	

	}



		</script>
		
