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
                    <h2>Gallery</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Gallery</strong>
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
                               <?php if(empty($id)){?>  <li class="active"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Gallery List</a></li>
							   <?php } ?>
								 <li class="<?php if(!empty($id)){ echo 'active'; }?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i><?php if(!empty($id)){ echo 'Update Entry'; }else{ echo 'New Entry'; }?></a></li>
							</ul>
                    <div class="ibox float-e-margins">
					<div class="tab-content">
					<div id="tab-2" class="tab-pane <?php if(empty($id)){ echo 'active'; } ?> ">
						
						   <div class="ibox-title">
                            <h5>Gallery List</h5>
                            <div class="ibox-tools">
                            	<a class="btn btn-primary" href="<?php echo base_url()?>index.php/home/downloadGallerydata">
                            		<i class="fa fa-download"></i> Gallery Data
                            	</a>
                               
                            </div>
                        </div>
                        <div class="ibox-content">
                             <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
												<tr>
													<th>Content Name</th>
													<!--<th>Content</th>-->
													<th>Created Date</th>
													<th  style="padding: 0 15%;">Description</th>
													<th>Link</th>
													<th>Created By</th>
													<th class="text-right footable-visible footable-last-column" style="background-color:white;">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($contents as $data){?>
												<tr id="row<?php echo $data['id'];?>">
													<td><?php echo $data['contentName']?></td>
													<td><?php echo date('d M Y h:i a',strtotime($data['createdOn']));?></td>
													<td><?php echo $data['description']?></td>
													<td><?php echo $data['link']; ?></td>
													<td><?php echo $data['empName'];?></td>
													<td><a href="<?php echo base_url();?>index.php/home/editContent/<?php echo $data['id']?>"><span class="btn-white btn btn-xs">Edit</span></a>
												<span class="btn-white btn btn-xs"
													onclick="deletedTransData(<?php echo $data['id']; ?>,'id','tbl_gallery_content')">
													Delete</span></td>
												</tr>	
												<?php }?>
                                               </tbody>
                                            </table>
                                       </div>
                        </div>
						 </div>
						 
						<div id="tab-1" class="tab-pane ">
							<div class="ibox-title">
								<h5>Please Add Content</h5>
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
								<form method="post" class="form-horizontal"  enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/home/insertContent">
									<span style="color: red">Make sure not to put 'https://' or 'http://' before the link</span>
									<div class="form-group">
										<label class="col-sm-2 control-label">Content Name<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="name" value="" required>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Content Type<span class ="required" >*</span></label>
										<div class="col-sm-10">
											<select class="form-control" onchange="setValidation(this.value);checkFormat();checkContent();" name="contentType" id="contentType">
												<option value="">-Select Content Type-</option>
												<option value="image">Image</option>
												<option value="video">Video</option>
												<option value="link">Link</option>
											</select>
										</div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="form-control" name="description" ></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Link</label>
										<div class="col-sm-10">
											<input type="text" name="link" class="form-control">
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group" id="contentsData">
										<label class="col-sm-2 control-label">Upload audio/video</label>
										<div class="col-sm-10">
												<input  type="file" style="" onchange="checkFormat()" accept="image/jpg/image/png/image/gif,image/jpeg,video/mp4/video/MP4" name="content" id="inputImage" class="" value="" >
										</div>
									</div>
									
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
            	$('#formSubmit').attr('type','submit');
            }
            else{
            	$('#formSubmit').attr('type','button');
            	alert('Content type does not match with Uploaded file format');
            }	
        }
        else if($('#contentType').val() == 'video' && arr!= ''){
          if(arr[1] == 'mp4'|| arr[1] == 'MP4')
            {
            	$('#formSubmit').attr('type','submit');
            }
            else{
            	$('#formSubmit').attr('type','button');
            	alert('Content type does not match with Uploaded file format');
            }

        }	

	}

	function checkContent()
	{
		var contentType = $('#contentType').val();

		if(contentType == 'link')
		{
			$('#contentsData').css('display','none');
		}else{
			$('#contentsData').css('display','block');
		}	
	}		

		</script>
		
