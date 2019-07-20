<style>
ol .active{
	font-weight: bold;
    
}

.form-control{
	margin-left: 13px;
}

.control-label{
	margin-left: 13px;
}

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

.nextbtn{

	background: #76b51b;color: #fff;width: 75%;height: 30px;
}

.stopPlay{
	background: #de7428;
    width: 55%;
    height: 30px;
    color: white;
}
.footer-bottom{bottom: -170px !important;}
#sidebar{position: absolute !important;
    right: 0px !important;
    top: 5px !important;}

	#comments{display:none;}
</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>GIFT COUPON</h4>
                <ol class="breadcrumb">
                    
					<li class="active">
                        <a href="#">GIFT COUPON</a>
                    </li>
					<li class="">
                        <!--<a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">SEARCH SERVICE PROVIDER
						</a>-->
                    </li>
					
                </ol>
            </div>

			
            
        </div>
         <?php $this->session->set_userdata('giftCouponNo',$accessVoucherDetail[0]['voucherId']);?>
		Your Gift Coupon number is <?php echo $accessVoucherDetail[0]['voucherNumber']; ?>.Kindly search and select onground partner to redeem your gift coupon.
		<form action="<?php echo base_url();?>/index.php/homeweb/getGiftCoupon/<?php echo $quizNumber?>" class="form-horizontal" method="post">
			<div class="form-group">
						<div class="row">
						 <div class="col-lg-6">
						 	<label class="control-label">State</label>
						 	<select class="form-control" required  id="state" name="state" >
						 		<option value="" readonly>Select State</option>
									<?php foreach($state as $data){ ?>
									<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
								<?php } ?>									
						 	</select>
						 </div>	
						 <div class="col-lg-6">
						 	<label class="control-label">District</label>
						  <div id="aaaa">	
						 	<select name="districtId" id="districtId" class="form-control">
									<option value="" readonly>Select District</option>							
								</select>
						 </div>		
						 </div>
						</div>
					</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12">
							<input style="margin-left: 13px;" type="checkbox" onchange="findOnGroundPartner(this.value);" name="area" id="currentArea">
							Click Here To find Onground partner in your area.
						</div>
					</div>
				</div>	
				<div class="form-group">
					<div class="row">
						<!-- <div class="col-lg-6">
						<?php if(!$this->session->userdata('validated')){?>	
						 <button onclick="history.go(-2)" class="btn btn-primary pull-right">Back</button>
						 <?php }else{?>
						 <button onclick="history.go(-1)" class="btn btn-primary pull-right">Back To</button>	
						 <?php }?>
						</div> -->
						<div class="col-lg-6">
						 <input type="submit" name="search" value="Search" class="btn btn-primary" style="margin: 2% 0;">	
						</div>
					</div>
				</div>	
			</form>
			
		<!--<div class="well m-t"><strong><?php echo $accessVoucherDetail[0]['name']; ?> </strong>
                              &nbsp;   <br> 
							  <?php echo $accessVoucherDetail[0]['address']; ?> <br>
							<strong> mobile : </strong><?php echo $accessVoucherDetail[0]['mobile']; ?> <br>
							<strong> Skype : </strong><?php echo $accessVoucherDetail[0]['skypeId']; ?> <br>
							<strong>Website :   </strong><?php echo $accessVoucherDetail[0]['website']; ?> <br>
							  
                        </div>-->
                 <div id="findOnGroundPartner">
                 </div>   
                <?php if(!empty($ongroundPartners)){?>
                <h3>Search Results - On Ground Partners</h3>        
                        <?php foreach($ongroundPartners as $val){?>
			<div class="well m-t">
				<strong> Partner Name : </strong><?php echo $val['name']; ?> <br>
				<strong> Address : </strong><?php echo $val['address']; ?> <br>
				<strong> Contact Number : </strong><?php echo $val['mobile']; ?> <br>
				<strong>Email Address:</strong><?php echo $val['email'];?><br>
				<strong>Website:</strong><?php echo $val['website'];?>
				  
			  <a class="getPartner" onpartnerId = "<?php echo $val['ongroundPartnerId'];?>"  style="float:right;color:  blue;border: 1px solid blue;border-radius: 5%;padding: 0 0.5%;cursor: context-menu;">Select Onground Partner </a>
			</div>
		<?php } ?>
		<?php }else{?>
		<?php if(!empty($response))
		 {
           echo $response;
		 }
		   ?>
			<?php }?>

		
			
						
 			
		</div>
		
		<!--<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>-->
	</div>
    <!-- /.Page Content -->

      <div class="hover_bkgr_fricc" id="confirmPartner">
		    <span class="helper"></span>
		    <div>			
				<div id="infoDIv">

				</div>
				<div class="" style="width: 100%;margin-top: 25px;display: flex;">
				 <div class="popupCloseButton" style="width: 50%;">	
					<button type="button" ongroundPartnerId="" id="redeemCoupon" class="btn btn-primary btn-md nextbtn">Yes</button> 
				 </div>
				 <div  style="width: 50%;">	
					<button  type="button" onclick="window.location.reload();" class="btn btn-primary btn-md stopPlay">No</button>
				 </div>	
				</div>
   	
		    </div>
		</div>

		<!-- model for message alert -->
		<div class="hover_bkgr_fricc" id="messageAlert">
		    <span class="helper"></span>
		    <div>			
				<div id="infoDIv">
						<div style="font-weight: bold;margin-top: 10px;color:red;" > 
							Your gift coupon number is send to your number with ongroundPartner details
						</div>
				</div>
				<div  style="width: 100%;margin-top: 25px;">
				 <div >	
					<a href="<?php echo base_url();?>index.php/homeweb/voucherInformation"><button  type="button" class="btn btn-primary btn-md popupCloseButton ">OK</button></a>
				 </div>	
				</div> 	
		    </div>
	


	<script>	

(function($){
	$('#state').change(function(){
	//alert(stateId);

	var stateId = $('#state').val();
	$("#aaaa").html('');
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>/index.php/homeweb/getDistrict",
			data: {stateId:stateId,},
			success: function(data) {
				//alert(data);
				var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					
					var htm = '';
						htm += '<select class="form-control"  name="districtId" id="sl2"><option value="" readonly>No District</option></select>';
						$("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select class="form-control"  name="districtId"  id="sl2"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						$("#aaaa").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
		
					
					
				}
			}
		});
});


$('#currentArea').change(function(){
	//alert(currentArea);

	var currentArea = $('#currentArea').val();
 if($("#currentArea").prop("checked") == true){	
	$.ajax({
		type:"POST",
		url:"<?php echo base_url();?>/index.php/homeweb/checkArea",
		data:{currentArea:currentArea,},
		success:function(data){
            //alert(data);
            var rslt = $.trim(data);
			result = JSON.parse(rslt);
			var len = result.length;

			console.log(result);

			if(len==0){
					
					var htm = '';
						htm += '<p>No Onground in Area '+currentArea+'</p>';
						$("#findOnGroundPartner").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						//htm += '';
						for (var i = 0; i < len; i++) 
						{
							htm += '<div class="well m-t">'+
							'<strong>'+'Partner name:'+'</strong>'+result[i].name+'<br>'+
							'<strong>'+'Address:'+'</strong>'+result[i].address+'<br>'+
							'<strong>'+'Contact name:'+'</strong>'+result[i].mobile+'<br>'+
							'<strong>'+'Email Address:'+'</strong>'+result[i].email+'<br>'+
							'<strong>'+'Website:'+'</strong>'+result[i].website+'<br>'+'</div>'
							;
						};
						$("#findOnGroundPartner").html(htm);
						//$('.form-control').chosen().trigger("liszt:updated");
		
					
					
				}
		}

	});
  }	
  else
  {
  	$("#findOnGroundPartner").html('');
  }
});

 $('.getPartner').click(function(){

 	  $('#infoDIv').html('');

 	var partnerId = $(this).attr('onpartnerId');

      $.ajax({
      	type: "POST",
      	url:"<?php echo base_url();?>index.php/homeweb/ongroundPartnerDetail",
      	data:{ongroundPartnerId:partnerId},
      	success:function(data){
             var rslt = $.trim(data);
			result = JSON.parse(rslt);
			var len = result.length;

             var htm ="<div style='font-weight: bold;margin-top: 10px;color:green;'>Are you sure you want redeem your gift voucher with "+result[0]['name']+"</div>";

             //htm += ""

             //$('#infoDIv').html(htm);
             $('#infoDIv').html(htm);

             $('#redeemCoupon').attr('ongroundPartnerId',partnerId);
             	$('#confirmPartner').show();
          	//$('.hover_bkgr_fricc').show();
      	}
      })
 });

 $('#redeemCoupon').click(function(){
   
   var voucherId = "<?php echo $accessVoucherDetail[0]['voucherId'];?>";

   var partnerId = $('#redeemCoupon').attr('ongroundPartnerId');
 
 	$.ajax({
 		type:"POST",
 		url:"<?php echo base_url();?>index.php/homeweb/redeemCoupon",
 		data:{voucherId:voucherId,partnerId:partnerId},
 		success:function(data){
 			//alert('Your gift coupon number is send to your number with ongroundPartner details');
 				$('#messageAlert').show();
           /* window.location.href = "<?php echo base_url();?>index.php/homeweb/voucherInformation";*/

 		}
 	})
 })

})(jQuery);

	
</script>
	<script type = "text/javascript">
	//window.open ("<?php echo base_url();?>/serviceAccessVoucher","mywindow","status=1,toolbar=0");

    window.onload = function () {
		
        document.onkeydown = function (e) {
			
			if(e.keyCode==116){
				return (e.which || e.keyCode) != 116 ;
			}
			if(e.keyCode== 82){
				return (e.which || e.keyCode) != 82 ;
			}
			if(e.button==2)
			{
			alert(status);
			return false;	
			}
			
           
        };
    }
</script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCcoUn4U56QX4KGazNN7_krWu8SP6j9p9Q&sensor=false"></script>
<script type="text/javascript">

var geocoder;

	function getLocation() 
	{
       if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
       } else { 
        alert("Geolocation is not supported by this browser.");
      }
  }

  function showPosition(position) {

document.getElementById('currentArea').value = position.coords.latitude+','+position.coords.longitude;

codeLatLng(position.coords.latitude,position.coords.longitude);
//$("#currentLat").val(position.coords.latitude+','+position.coords.longitude);

}

function initialize() {
    geocoder = new google.maps.Geocoder();
  }


function codeLatLng(lat,lng)
{
	var latlng = new google.maps.LatLng(lat,lng);

	geocoder.geocode({'latLng':latlng},function(results,status){
            if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
        // alert(results[0].formatted_address)
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
            }
        }
        //city data
        //alert(city.short_name + " " + city.long_name);
      document.getElementById('currentArea').value = city.long_name;


        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
	})
}

function aa()
	  {
			 getLocation();
             initialize();
	  }
		window.onload=aa;
</script>


<!--<script>
$.get("http://ipinfo.io", function (response) {
	console.log(response);
    //$("#ip").html("IP: " + response.ip);
    //$("#address").html("Location: " + response.city + ", " + response.region);
    //$("#details").html(JSON.stringify(response, null, 4));
}, "jsonp");
</script>-->