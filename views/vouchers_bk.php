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
                            <strong>Vouchers</strong>
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
							<li class="<?php if(empty($giftCoupon)){echo 'active';}?>"><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i>Service Providers Vouchers</a></li>
							<li class="<?php if(!empty($giftCoupon)){echo 'active';}?>"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>Gift Coupon Vouchers</a></li>
						</ul>
                    <div class="ibox float-e-margins">
						<div class="tab-content">
							<div id="tab-2" class="tab-pane <?php if(empty($giftCoupon)){echo 'active';}?>">
								<div class="ibox-title">
									<h5>Service Providers Vouchers List</h5>
									<div class="ibox-tools">
									  <form method="POST" action="<?php echo base_url()?>index.php/home/downloadSACdata">
									    <input type="hidden" name="excelFilter" value="<?php echo $excelFilter;?>">
									    <input type="hidden" name="exceldaterange" value="<?php echo $exceldaterange;?>">
								      <?php if(!empty($exceldataName)){?>	
								        <?php foreach($exceldataName as $data){?>	
									       <input type="hidden" name="exceldataName[]"  value="<?php echo $data;?>">
								        <?php }?>	
								     <?php }?>	
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> SAC Data</button>
                            	     </form> 
										<!-- <a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a> -->
									</div>
								</div>
								<div class="ibox-content">
									<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterVoucher">
										<div class="form-group">
											<input type="hidden" name="voucherName" value="serviceAccess">
										</div>
										<div class="form-group">
											<div class="col-sm-3">
												<select class="form-control" name="filter" id="filter" onchange="getFilter(this.value,'serviceAccess');" required>
													<option value="">-choose filter-</option>
													<option value="voucherAwarded">Voucher awarded</option>
													<option value="userwise">Userwise</option>
													<option value="claimed">Total Voucher claimed</option>
													<option value="serviceProvider">Service Provider Wise</option>
													<option value="unclaimed">Unclaimed Voucher</option>
												</select>
											</div>
											<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="" readonly placeholder="select date" required>
											</div>
											</div>
											<div class="col-sm-3" id="dataDiv" style="display: none;">
											
												<select name="dataName[]" required multiple class="chosen-select" id="filterData">

												</select>

											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit" id="submit" >Submit</button>
											</div>
										</div>
									</form>
								</div>
								<div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>Service Access Voucher No</th>
													<th>Service Access Voucher Code</th>
													<th>User Name</th>
													<th>Date awarded</th>
													<th>Time awarded</th>
													<th>Expiry Date</th>
													<th>Service Provider Name</th>
													<th>Date SAV claimed from SP</th>
													<th>Time SAV claimed from SP</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($serviceProviderVouchers as $voucher){?>
												<tr>
													<td><?php echo $voucher['voucherNumber'] ?></td>
													<td><?php echo $voucher['voucherCode']?></td>
													<td><?php echo $voucher['userName']?></td>
													<td><?php echo date('d M Y',strtotime($voucher['voucherDate']));?></td>
													<td><?php echo date('h:i a',strtotime($voucher['voucherDate']));?></td>
													<td><?php echo date('d M Y',strtotime($voucher['voucherExpDate']));?></td>
													<td><?php echo $voucher['serviceProviderName']?></td>
													<td></td>
													<td></td>
												</tr>
											<?php }?>	
										    </tbody>
										</table>
								   </div>
								</div>
							</div>
							<div id="tab-1" class="tab-pane <?php if(!empty($giftCoupon)){echo 'active';}?>">
								<div class="ibox-title">
									<h5>Gift Voucher List</h5>
									<div class="ibox-tools">
										<form method="POST" action="<?php echo base_url()?>index.php/home/downloadGCdata">
									     <input type="hidden" name="excelFilter1" value="<?php echo $excelFilter;?>">
									      <input type="hidden" name="exceldaterange1" value="<?php echo $exceldaterange;?>">
								       <?php if(!empty($exceldataName)){?>	
								          <?php foreach($exceldataName as $data){?>	
									      <input type="hidden" name="exceldataName1[]"  value="<?php echo $data;?>">
								         <?php }?>	
								        <?php }?>	
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-download"></i> GC Data</button>
                            	     </form> 
										<!-- <a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
										<a class="close-link">
											<i class="fa fa-times"></i>
										</a> -->
									</div>
								</div>
								<div class="ibox-content">
									<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/home/filterVoucher">
										<div class="form-group">
											<input type="hidden" name="voucherName" value="giftCoupon">
										</div>
										<div class="form-group">
											<div class="col-sm-3">
												<select class="form-control" name="filter" id="filter1" onchange="getFilter(this.value,'giftCoupon');" required>
													<option value="">-choose filter-</option>
													<option value="voucherAwarded">Voucher awarded</option>
													<option value="userwise">Userwise</option>
													<option value="claimed">Total Voucher claimed</option>
													<option value="ongroundPartner">Onground Partner Wise</option>
													<option value="contestWise">Contest Wise</option>
													<option value="unclaimed">Unclaimed Voucher</option>
												</select>
											</div>
											<div class="col-sm-3">
												<div class="input-group calender">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control" name="daterange" value="" readonly placeholder="select date" required>
											</div>
											</div>
											<div class="col-sm-3" id="dataDiv1" style="display: none;">
											<div id="dataName1">	
												<select name="dataName[]" multiple class="chosen-select" id="filterData1">

												</select>
											</div>	
											</div>
											<div class="col-sm-3">
												<button class="btn btn-primary" type="submit" id="submit" >Submit</button>
											</div>
										</div>
									</form>
								</div>
								<div class="ibox-content">
							     <div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>	
													<th>Gift Coupon  No</th>
													<th>Gift Coupon Code</th>
													<th>User Name</th>
													<th>Date awarded</th>
													<th>Time awarded</th>
													<th>Expiry Date</th>
													<th>Onground Partner Name</th>
													<th>Date SAV claimed from OGP</th>
													<th>Time SAV claimed from OGP</th>
													<th>Contest Name</th>
													<th>Score</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($quizVouchers as $voucher){?>
												<tr>
													<td><?php echo $voucher['voucherNumber'] ?></td>
													<td><?php echo $voucher['voucherCode']?></td>
													<td><?php echo $voucher['userName']?></td>
													<td><?php echo date('d M Y',strtotime($voucher['voucherDate']));?></td>
													<td><?php echo date('h:i a',strtotime($voucher['voucherDate']));?></td>
													<td><?php echo date('d M Y',strtotime($voucher['voucherExpDate']));?></td>
													<td><?php echo $voucher['partnerName']?></td>
													<td></td>
													<td></td>
													<td><?php echo $voucher['quizName']?></td>
													<td><?php echo $voucher['quizTotalMarks'];?></td>
												</tr>
											<?php }?>	
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
<script type="text/javascript">
	function getFilter(filter,screen) {
		if(filter == 'userwise'){

			var to = 'verified';
           $.ajax({
           	type:"POST",
           	url:"<?php echo base_url();?>index.php/home/getUsersList",
           	data :{to:to},
           	success:function(data){
           		var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
            
             var htm = '<select required class="chosen-select"  name="dataName" data-placeholder="choose a user" >'
             htm += "<option>-choose User-</option>";

             for(i = 0;i < len;i++)
             {
             	htm += '<option value="'+result[i].userId+'">'+result[i].userName+'</option>'
             }	

             htm += "</select>";

             if(screen == 'serviceAccess')
             { 
              $('#dataDiv').css('display','block');
                $('#filterData').prop('required',true);
              $('#filterData').html(htm); 
              $('#filterData').trigger("chosen:updated");
              }else{
              	$('#dataDiv1').css('display','block');
                $('#filterData1').prop('required',true);
              $('#filterData1').html(htm); 
              $('#filterData1').trigger("chosen:updated");
              }  
           	}
           });

		}

		if(filter=='serviceProvider'){

			  $.ajax({
			  	type:"GET", 
           	url:"<?php echo base_url();?>index.php/home/getServiceProviders",
           	success:function(data){
           		var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
            
             var htm = "<select required class='chosen-select'  name='dataName' data-placeholder='choose a user' >"
             htm += "<option>-choose User-</option>";

             for(i = 0;i < len;i++)
             {
             	htm += '<option value="'+result[i].serviceProviderId+'">'+result[i].name+'</option>'
             }	

             htm += "</select>";

              $('#dataDiv').css('display','block');
              $('#filterData').prop('required',true);
              $('#filterData').html(htm);
               $('#filterData').trigger("chosen:updated");   
           	}
           });

		}

		if(filter == 'ongroundPartner')
		{
			$.ajax({
				type :"GET",
				url:"<?php echo base_url();?>index.php/home/getOngroundPartner",
				success:function(data){
					var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
            
             var htm = "<select required  name='dataName' data-placeholder='choose a user' class='chosen-select'>"
             htm += "<option>-choose User-</option>";

             for(i = 0;i < len;i++)
             {
             	htm += '<option value="'+result[i].ongroundPartnerId+'">'+result[i].name+'</option>'
             }	

             htm += "</select>";

              $('#dataDiv1').css('display','block');
              $('#filterData1').prop('required',true);
              $('#filterData1').html(htm); 
              $('#filterData1').trigger("chosen:updated");  
				}
			});
		}

		if(filter == 'contestWise')
		{
				$.ajax({
				type :"GET",
				url:"<?php echo base_url();?>index.php/home/getquiz",
				success:function(data){
					var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
            
             var htm = "<select required style='width:100%;' name='dataName' data-placeholder='choose a user' class='chosen-select'>"
             htm += "<option>-choose User-</option>";

             for(i = 0;i < len;i++)
             {
             	htm += '<option value="'+result[i].quizId+'">'+result[i].quizName+'</option>'
             }	

             htm += "</select>";

              $('#dataDiv1').css('display','block');
              $('#filterData1').prop('required',true);
              $('#filterData1').html(htm);   
              $('#filterData1').trigger("chosen:updated");
				}
			});
		}	
	}
</script>		
		
		
