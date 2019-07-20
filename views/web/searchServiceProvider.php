<style>


/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    border: 1px solid #e9ecef;
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 40%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
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

.modal-header {
	height: 40px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
    padding: 2px 16px;
    background-color: #444;
    color: white;
}

.modal-body {
	background-color: #fefefe;
	padding: 10px 16px;
	height: auto;
}

.modal-footer {
	height: 40px;
    padding: 2px 16px;
    background-color: #444;
    color: white;
    border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}
.go_button{background: green;color: white;}
.cancel_button{background: red;color: white;margin-top: 3px;}
.button_btn{    text-align: center;
    /* margin-top: 15px; */
    position: relative;
    top: 45px;
   }
    .pull-right{margin-right: 100px;}

    @media only screen and (max-width: 800px) {
   .modal-content {
   
    font-size: 12px;
    text-align: center;
    width: 60%;
    
}
.pull-right {
    margin-right: 0px;
}

.modal-body {
    background-color: #fefefe;
    padding: 10px 16px;
    height: auto;
}
}
@media screen and (min-device-width: 801px) and (max-device-width: 1200px) { 
    /* STYLES HERE */
    .pull-right {
    margin-right: 13px;
}

}
@media screen and (min-device-width: 1201px) and (max-device-width: 1400px) {
.cancel_button{
    position: absolute;
    margin-left: 10px;
}

 }
 
</style>
    <!-- Page Content 
	<div id="main-content" class="container"> -->
	<div class="content">    
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
			<h4>SEARCH SERVICE PROVIDER</h4>
                <!--<ol class="breadcrumb">
                    
					<li class="active">
                        <a href="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">SEARCH SERVICE PROVIDER</a>
                    </li>
					
                </ol>-->
            </div>
            
        </div>
		
		
			<div class="ibox-content">
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/homeweb/searchServiceProvider">
					<div class="form-group">
						<div class="row">
							<div class="one_half" style="margin-right: 2%;">
								<div class="input-group">
									<select data-placeholder="Choose a Country..." name="stateId" class="chosen-select" id="stateId" tabindex="2" >
										<option value="" readonly>Select State</option>
										<?php foreach($state as $data){ ?>
										<option value="<?php echo $data['stateId']; ?>"><?php echo $data['stateName']; ?></option>
										<?php } ?>
										
									</select>
								</div>
							</div>						
							<div class="one_half" style="margin-right: 2%;">
								<div class="input-group" id="aaaa">
									<select data-placeholder="Choose a Country..." name="districtId" id="districtId" class="chosen-select" tabindex="3" >
										<option value="" readonly>Select District</option>
										
									</select>
								</div>
							</div>
						</div>	
					</div>
					<div class="clear"></div>
					<div class="form-group">							
						<!---<div class="col-lg-6">
						<input type="text" name="searchText" placeholder="Name, Address" class="form-control"> 
						</div>-->
						<div class="one_half" style="margin-right: 2%;">
							<select class="form-control" name="serviceTypeId" id="serviceTypeId" >
								<option value="" readonly>Select Service Focus</option>
								<?php foreach($serviceProviderType as $val){ ?>
									<option value="<?php echo $val['serviceTypeId']; ?>" <?php if($val['serviceTypeId'] == $search['serviceTypeId']){ echo 'selected';}?>><?php echo $val['serviceTypeName']; ?></option>
								<?php } ?>
								
							</select>
						</div>
						<!--</div>
						<div class="form-group"> -->
						<div  class="one_half" style="margin-right: 2%;">
							<select class="form-control" name="serviceTypeParameterId" id="serviceTypeParameterId">
								<option value="" readonly>Select Service Area</option>
							</select>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="col-lg-12" style="margin: 15px 0;">
							<input type="checkbox" name="latLong" id="currentLat" value=""> 
							<label>Click here to find service provider in the neighbourhood (10Km radius)</label>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button id="search" class="submit" type="button">Search</button>
							<input type="submit" name="" id="subSearch" style="display:none;">
						</div>
					</div>
				</form>
			</div>

		
						<div class="well m-t" id="msgAlert" style="display:none;margin: 1px;padding: 1px;">
							<strong>Please Select A Field</strong>
                        </div>
                 
						<?php if(empty($serviceProviderList[0]) && !empty($search)){ ?>

							<div style="display: block;" id="myModal" class="modal">

							  <!-- Modal content -->
							  <div class="modal-content">
							    <div class="modal-header">
							      <span class="close" onclick="closemodal()">&times;</span>
							      <h2></h2>
							    </div>
							    <div class="modal-body">
							    	<div class="ibox-content">
							    	<div class="row">
									    <div class="col-sm-12 col-md-12" style="margin-top: 25px;">
									    	<p class="pull-center">There are no service providers with the selected criteria. Kindly access External Service Providers page for information on other service providers.</p>
									    
									    </div>
									</div>
								    <div class="button_btn">
								    	<button onclick="redirectTo()"  class="btn btn-primary go_button">Go</button>
								    	<button onclick="closemodal()" class="btn btn-danger cancel_button">Cancel</button>
									</div>
									</div>
							    </div>
							    <div class="modal-footer">
							      <h3></h3>
							    </div>
							  </div>
							</div>

<!-- 						<div class="well m-t" style="margin: 1px;padding: 1px;margin-top: 5px;">
							<strong>There are no service providers empanelled with us in your selected district.<p style="line-height: 10px;"></p>Please click <a href="<?php echo base_url()?>index.php/homeweb/allServiceProvider" style="color: red;text-decoration: underline;">Here</a>  to view Other Services Providers</strong>
                        </div> -->


						<?php } ?>
						<?php //echo '<pre>'; print_r($serviceProviderList); ?>
						<?php if(!empty($serviceProviderList)) { ?>
						<?php $i=1; foreach($serviceProviderList as $list) { ?>
						<div style="line-height:13px;" class="well m-t"><strong><?php echo $list['name']; ?>: </strong>
                             
							  <?php echo $list['address']; ?> 
							  , <?php echo $list['mobile']; ?> 
							    <?php //echo $list['website']; ?> 
							  <p style="margin:1.5px 0;"></p>
							  <strong>Days & Time: </strong><?php echo $list['day'].'  '.$list['time']; ?><br>
							  <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $list['stateName']; ?> <i class="fa fa-user" aria-hidden="true"></i><?php echo $list['serviceTypeName']; ?>
							  <p style="margin:4px 0;"></p>

							  <?php if(!$this->session->userdata('validated')){ ?>
							  <div class="row">
							  	
								  	<a href="<?php echo base_url();?>index.php/homeweb/serviceProviderDetails/<?php echo $list['serviceProviderId']; ?>" class="btn btn-primary btn-xs">Get More Detail</a>
								
								
								<a class="btn btn-primary btn-xs pull-right" href="<?php echo base_url(); ?>index.php/homeweb/login/<?php echo $list['serviceProviderId']; ?>">Get Service Access Voucher</a>
							  
							 </div>	
							  <?php }else{ ?>
							  <div class="row">
							 
								  	<a href="<?php echo base_url();?>index.php/homeweb/serviceProviderDetails/<?php echo $list['serviceProviderId']; ?>" class="btn btn-primary btn-xs">Get More Detail</a>
								
								<a class="btn btn-primary pull-right btn-xs" href="<?php echo base_url(); ?>index.php/homeweb/serviceAccessVoucher/<?php echo $list['serviceProviderId']; ?>">Get Service Access Voucher</a>
							 
							  </div>	
							  <?php }?>
							  
							 <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/homeweb/feedback/<?php echo $list['serviceProviderId']; ?>">Add Feedback</a>-->
                        </div>
							<?php $i++; } ?>
							<?php } ?>

		<p id="demo"></p>
	<?php if(!empty($serviceProviderList)) { ?>
	 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcoUn4U56QX4KGazNN7_krWu8SP6j9p9Q&libraries=places&v=3&callback=initMap">
    </script>
	<div id="map" style="width:70%;height:100%; "></div>
	<?php } ?>

	
				

			
	</div>
		
	<!--	<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>
	</div> -->
	
	
	<script>
	function getLocation() 
	{
       if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
       } else { 
        alert("Geolocation is not supported by this browser.");
      }
  }

function showPosition(position) {
alert(position.coords.latitude+','+position.coords.longitude);
//$("#currentLat").val(position.coords.latitude+','+position.coords.longitude);

document.getElementById('currentLat').value = position.coords.latitude+','+position.coords.longitude;
}
	function aa()
	  {
			 getLocation();
	  }
		window.onload=aa;	

			


</script>
<script>


	function subCategory() {
		//alert("hhh");
		var aa = '<?php echo $search['serviceTypeParameterId']; ?>';
		var x = document.getElementById("serviceTypeId").value;
				//alert(x);
		$("#serviceTypeParameterId").html('');
		$.ajax({
			type: "POST",
			url: "serivceTypeParameters",
			data: {typeId:x},
			success: function(data) {
				//alert(data);
				var rslt =$.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					$("#serviceTypeParameterId").append('<option value="" readonly>No Specialization</option>');
				}else{
					$("#serviceTypeParameterId").append('<option value="" readonly>Select Specialization</option>');
					for(var i = 0; i < len; i++){
						if(result[i].serviceTypeParameterId == aa){
							$("#serviceTypeParameterId").append('<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>');
						}else{
							$("#serviceTypeParameterId").append('<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>');
						}
						
								
					}
				}
			}
		});
	}
	
	
</script>
<?php //echo json_encode($serviceProviderList); ?>

<?php //if($serviceProviderList) { ?>
 <script>
     /* function initMap() {
		  var markers   = [];
		var locations = []; 

		var details = [];
		
		<?php if(!empty($serviceProviderList)){?>
		var aa = <?php echo json_encode($serviceProviderList); ?>
		<?php }?>
		// var aa = '[{"serviceProviderId": "3","serviceTypeId": "2","name": "adsad","address": "dasdass","officePhone": "dsadad","mobile": "sadasas","email": "asdasdd@ds.fd","latitude": "28.6618976","longitude": "77.2273958","skypeId": "dsadas","website": "sdasd"}, {"serviceProviderId": "4","serviceTypeId": "2","name": "New SP","address": "dasdass","officePhone": "dsadad","mobile": "sadasas","email": "asdasdd@ds.fd","latitude": "28.637549","longitude": "77.206972","skypeId": "dsadas","website": "sdasd"}]';
		
		var rslt = jq.trim(aa);
		var qq = JSON.stringify(aa);
		var ss = JSON.parse(qq);
		var len = ss.length;
				
		//alert("jjj");
		//alert(ss);
		for(var i = 0; i < len; i++)
		{	
		 if(ss[i].latitude && ss[i].longitude)
		 {									 		
			locations[i] = [ 
			ss[i].latitude,ss[i].longitude];

			//alert(locations[i]);

			details[i] = [ss[i].name,ss[i].address];
          }
		}

	    var map = new google.maps.Map(document.getElementById('map'), {
		//zoom: 10,
			  center: new google.maps.LatLng(28.6139391,77.2090212),
			  mapTypeId: google.maps.MapTypeId.TERRAIN,
			   scrollwheel: false,
			});
		//console.log(locations);
        // var number = ['this','is','a','number','gsfdsj','hjhjkh'];

        var marker, i;
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0; i <= locations.length-1; i++) 
		{ 
		  if(locations[i])
		  { 
         
			var latitude = ConvertDMSToDD(locations[i][0]);

			//alert(latitude);

			var longitude = ConvertDMSToDD(locations[i][1]);

			//alert(longitude);
					
			var myLatLng = new google.maps.LatLng(latitude,longitude);
				   marker  = new google.maps.Marker({
				   position: myLatLng,
				   map: map,
				   html:details[i][0]+"<br />"+details[i][1]
				  });	

			//alert(details[i][0]);	   


			var infoWindow = new google.maps.InfoWindow();	  	   
				  
					bounds.extend(myLatLng);
					markers.push(marker);

			  	
			 /* markers.addListener('click',function(){
			  	infowindow.open(markers.get('map'),markers);
			  });*/

			      /*var	markerContent = details[i][0]+details[i][1];
			      //alert(markerContent);
                 google.maps.event.addListener(marker, 'click',  (function(markers, markerContent ) {

                   return function() {
                 infowindow.setContent(markerContent);
                infowindow.open(map, markers);
                   }

                 })(marker, markerContent));

                 google.maps.event.addListener(marker, 'click', (function(infoWindow) {
                    return function() {
                    infoWindow.setContent(this.html); 	
                    infoWindow.open(map,this);
                  }
              })(infoWindow));
				
			}		
				  			
			}
			map.fitBounds(bounds);	



       /* var uluru = {lat: 28.6139391, lng: 77.2090212};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });	
		
		
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });*/
		//console.log('a');
       

      function ConvertDMSToDD(dms)
      {
      	     //let parts = dms.split(/[^\d+(\,\d+)\d+(\.\d+)?\w]+/);
      	     let parts = dms.split(" ");
            let degrees = parseFloat(parts[1]);
           // alert(degrees);
            let minutes = parseFloat(parts[3]);
            //alert(minutes);
            let seconds = parseFloat(parts[5].replace(',','.'));
            //alert(seconds);
            let direction = parts[0];
            //alert(direction);

       /*console.log('degrees: '+degrees)
       console.log('minutes: '+minutes)
        console.log('seconds: '+seconds)
       console.log('direction: '+direction)*/

        let dd = degrees + minutes / 60 + seconds / (60 * 60);

        if (direction == 'S' || direction == 'W') {
            dd = dd * -1;
         } // Don't do anything for N or E
         return dd;

      }
    </script>
    <script>


var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function showmodal() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closemodal() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function redirectTo() {
	window.location = "http://101.53.136.41/sahya/service-providers/links-to-websites-of-other-service-providers/";
}


    </script>
    <script type="text/javascript">
    (function($){
      
    $('.reply').click(function(){
       alert('jkjk');	
       $('#comment').prop('autofocus',true);
    }); 

    $('#stateId').change(function(){
	//alert(stateId);

	var stateId = $('#stateId').val();
	$("#aaaa").html('');
	$.ajax({
			type: "POST",
			url: "getDistrict",
			data: {stateId:stateId},
			success: function(data) {
				//alert(data);
				var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					
					var htm = '';
						htm += '<select data-placeholder="Choose a Country..." class="chosen-select" style="width:100%;" name="districtId" tabindex="2" id="sl2"><option value="" readonly>No District</option></select>';
						$("#aaaa").html(htm);
						$('.chosen-select').chosen().trigger("liszt:updated");
				}else{
					
					//$('.chosen-select').chosen("destroy").chosen();

					var htm = '';
						htm += '<select data-placeholder="Choose a Country..." class="chosen-select" style="width:100%;" name="districtId" tabindex="2" id="sl2"><option value="" readonly>Select District</option>';
						for(var i = 0; i < len; i++){
							htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
						}
						htm +='</select>';
						$("#aaaa").html(htm);
						$('.chosen-select').chosen().trigger("liszt:updated");


					
					
					
				}
			}
		});
  });

  $('#serviceTypeId').change(function(){
  		var aa = '<?php echo $search['serviceTypeParameterId']; ?>';
		var x = document.getElementById("serviceTypeId").value;
				//alert(x);
		$("#serviceTypeParameterId").html('');
		$.ajax({
			type: "POST",
			url: "serivceTypeParameters",
			data: {typeId:x},
			success: function(data) {
				//alert(data);
				var rslt = $.trim(data);
				result = JSON.parse(rslt);
				var len = result.length;
				if(len==0){
					$("#serviceTypeParameterId").append('<option value="" readonly>No Specialization</option>');
				}else{
					$("#serviceTypeParameterId").append('<option value="" readonly>Select Specialization</option>');
					for(var i = 0; i < len; i++){
						if(result[i].serviceTypeParameterId == aa){
							$("#serviceTypeParameterId").append('<option value="'+result[i].serviceTypeParameterId+'" selected>'+result[i].serviceTypeParameterName+'</option>');
						}else{
							$("#serviceTypeParameterId").append('<option value="'+result[i].serviceTypeParameterId+'">'+result[i].serviceTypeParameterName+'</option>');
						}
						
								
					}
				}
			}
		});
  });

  		$('#search').click(function(){
			if($("#currentLat").prop("checked") == true){
				var aas='';
			}else{
				$("#currentLat").val('');
			}
//alert('msgAlert');
if($("#stateId").val()!='' || $("#districtId").val()!='' || $("#serviceTypeId").val()!='' || $("#serviceTypeParameterId").val()!='' || $("#currentLat").val()!=''){
	//alert("kkk");
	$("#msgAlert").css({'display':'none'});
	$("#subSearch").trigger("click");
	
	
}else{
	//alert("jjjj");
	$("#msgAlert").css({'display':'block'});
}
}); 


 function initMap() {
		  var markers   = [];
		var locations = []; 

		var details = [];
		
		<?php if(!empty($serviceProviderList)){?>
		var aa = <?php echo json_encode($serviceProviderList); ?>
		<?php }?>
		// var aa = '[{"serviceProviderId": "3","serviceTypeId": "2","name": "adsad","address": "dasdass","officePhone": "dsadad","mobile": "sadasas","email": "asdasdd@ds.fd","latitude": "28.6618976","longitude": "77.2273958","skypeId": "dsadas","website": "sdasd"}, {"serviceProviderId": "4","serviceTypeId": "2","name": "New SP","address": "dasdass","officePhone": "dsadad","mobile": "sadasas","email": "asdasdd@ds.fd","latitude": "28.637549","longitude": "77.206972","skypeId": "dsadas","website": "sdasd"}]';
		
		var rslt = $.trim(aa);
		var qq = JSON.stringify(aa);
		var ss = JSON.parse(qq);
		var len = ss.length;
				
		//alert("jjj");
		//alert(ss);
		for(var i = 0; i < len; i++)
		{	
		 if(ss[i].latitude && ss[i].longitude)
		 {									 		
			locations[i] = [ 
			ss[i].latitude,ss[i].longitude];

			//alert(locations[i]);

			details[i] = [ss[i].name,ss[i].address];
          }
		}

	    var map = new google.maps.Map(document.getElementById('map'), {
		//zoom: 10,
			  center: new google.maps.LatLng(28.6139391,77.2090212),
			  mapTypeId: google.maps.MapTypeId.TERRAIN,
			   scrollwheel: false,
			});
		//console.log(locations);
        // var number = ['this','is','a','number','gsfdsj','hjhjkh'];

        var marker, i;
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0; i <= locations.length-1; i++) 
		{ 
		  if(locations[i])
		  { 
         
			var latitude = ConvertDMSToDD(locations[i][0]);

			//alert(latitude);

			var longitude = ConvertDMSToDD(locations[i][1]);

			//alert(longitude);
					
			var myLatLng = new google.maps.LatLng(latitude,longitude);
				   marker  = new google.maps.Marker({
				   position: myLatLng,
				   map: map,
				   html:details[i][0]+"<br />"+details[i][1]
				  });	

			//alert(details[i][0]);	   


			var infoWindow = new google.maps.InfoWindow();	  	   
				  
					bounds.extend(myLatLng);
					markers.push(marker);

			  	
			 /* markers.addListener('click',function(){
			  	infowindow.open(markers.get('map'),markers);
			  });*/

			      /*var	markerContent = details[i][0]+details[i][1];
			      //alert(markerContent);
                 google.maps.event.addListener(marker, 'click',  (function(markers, markerContent ) {

                   return function() {
                 infowindow.setContent(markerContent);
                infowindow.open(map, markers);
                   }

                 })(marker, markerContent));*/

                 google.maps.event.addListener(marker, 'click', (function(infoWindow) {
                    return function() {
                    infoWindow.setContent(this.html); 	
                    infoWindow.open(map,this);
                  }
              })(infoWindow));
				
			}		
				  			
			}
			map.fitBounds(bounds);	



       /* var uluru = {lat: 28.6139391, lng: 77.2090212};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });	
		
		
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });*/
		//console.log('a');
      }      
    })(jQuery);
    </script>
<?php //} ?>
