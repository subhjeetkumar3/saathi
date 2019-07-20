<style>
.none{
	display:none !important;
}
</style>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Vouchers</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li class="active">
                            <strong>Tickers</strong>
                        </li>
                    </ol>
                </div>
            </div>
			<div class="wrapper wrapper-content animated fadeInRight">

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
							<li class="active">
								<a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Tickers List</a>
							</li>
							
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane active">
								<div class="ibox-title">
									<h5>Tickers List</h5>
									<div class="ibox-tools">
										
									</div>
								</div>
								
								<div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>S.No</th>
													<th>Ticker Title</th>
													<th>Published Status</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
										<?php $i=1; foreach($tickerList as $ticker){?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $ticker['post_title']; ?></td>
												<td><?php if($ticker['post_status'] == 'publish'){echo 'published';}else{echo 'trash';} ?></td>
												<td>
													<?php if($ticker['post_status']=='publish'){ ?>
													<span class="btn-success btn btn-xs" onclick="changeTickerStatus('trash','<?php echo $ticker['ID']?>')">
														Approved
													</span>
													<?php } ?>
													<?php if($ticker['post_status']=='trash'){ ?>
													<span class="btn-danger btn btn-xs" onclick="changeTickerStatus('publish','<?php echo $ticker['ID']?>')">
														Unapproved
													</span>
													<?php } ?>

												</td>
											</tr>
										<?php  $i++; } ?>	
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
						</div>
                    </div>
                </div>
			</div>
        </div>

	</div>
</div>

    <div class="modal inmodal" id="changeStatusResultModal" role="dialog" data-backdrop="static" data-keyboard="false">
       <div class="modal-dialog">
       	 <div class="modal-content animated bounceInRight"  >
    		<div class="modal-header" style="padding: 12px 15px !important;">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>	
       	 	<div class="modal-body" id="viewPopResponse" style="height: 50px;font-size: 25px;height: 50px;text-align: center;margin-bottom: 33px;">
       	 		
            </div>   
       </div>
    </div>
   </div>

<script type="text/javascript">
        function changeTickerStatus(status,postId){

        	$.ajax({

    		 type: "POST",
                url: "changePostStatusWp",
                data: {status:status,postId:postId},
                success: function(data) {
                    var html;
                    result = JSON.parse(data);
                    
                    if (result.responseCode == '200') {

                    	html ='<span style="color:green;">'+result.responseMessage+'</span>';
						$('#viewPopResponse').append(html);
						setTimeout(function(){ location.reload(); }, 1000);
                    } else {
                    	html = '<span style="color:red;">'+result.responseMessage+'</span>';
						$('#viewPopResponse').append(html);
                    }


                    $('#changeStatusResultModal').modal('show');

                 	   
                }
        	});
        }
</script>		
		
		
