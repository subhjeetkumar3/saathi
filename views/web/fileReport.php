
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<style>
.current-menu-ancestor a {
   color: #FFF;
    height: 52px !important;
    line-height: 57px;
    position: relative;
    border-width: 0 !important;
    bottom: 5px;
}
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #ff0400;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
   /* background-color: #f2f2f2;*/
    padding: 20px;

   }


.send_enquiry{width:74%; float: left;display: inline-block;}
.reach_us {
    width: 24%;
    padding: 0px;
    float: right;
    border-radius: 10px;
    background: #ffc0cb63;
    text-align: center;
    line-height: 25px;
    padding-bottom: 10px;
}

.reach_us h3
{    background: #f37736d4;
    color: #fff;
    border-radius: 10px 9px 0px 0px;}


    .reach_us a
{    text-decoration:underline; }
.post-title {
    color: #f43d2a;
    border-bottom: 1px dotted;
}

.hr_line  {
    border-bottom: 1px solid #f2f2f2;
    padding-bottom: 5px;
    margin-bottom: 10px;
}

.share-post {
    clear: both;
    padding: 10px 0px;
    background: #F7F7F7;
    border-top: 1px solid #EAEAEA;
    margin-left: 30px;
    border-bottom: 5px solid red;
}

.flat-social{list-style: none;
    margin-top: 0px;
}
.flat-social li{float: left;margin-left: 20px;}
.flat-social li a {
    text-decoration: none;
    color: #fff;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 13px;
}

.share-post span.share-text {
    background: #FF8500;
    margin: -10px 10px -10px -10px;
    display: block;
    float: left;
    color: #FFF;
    padding: 0 9px;
    font-family: BebasNeueRegular, arial, Georgia, serif;
    font-size: 14pt;
    height: 45px;
    line-height: 50px;
}

.send_enquiry form label{font-size: 17px;}

h3{font-size: 20px;line-height: 50px;}
</style>
</head>
<body>

<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope="" itemtype="http://schema.org/Thing"><span itemprop="name">File Report</span></h1>
<?php if($this->session->flashdata('completeMessage')) {?>
<h4 style="color: #e5e5e5;background: #a5630d;padding: 10px;"><?php echo $this->session->flashdata('completeMessage'); ?>.</h4>
<?php }?>
<p class="hr_line"></p>
<div class="container">
<div class="send_enquiry"> 
<h3>Name  of the complainant </h3>

	<form action="<?php echo base_url()?>homeweb/getFileReport" method='POST'>

   
     <label for="fname"> First Name</label>
     <br>

    <input type="text"  id="fname" value="" name="fname">

     
     <label for="lname"> Last Name</label>
     <br>
     
    <input type="text" id="lname" value="" name="lname">


    <label for="gender">Gender</label>
    <select id="gender" name="gender">
      <option value="">Select</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
       <option value="Other">Other</option>

    </select>

   
  
     <label for="guardian"> Son of/Daughter of/Care of</label>
     
   
    <input type="text" id="guardian"  name="guardian">

     
     <label for="age">Age</label>
     
    
    <input type="text" id="age" onkeypress="return isNumberKey(event)" name="age">


     <label for="address">Contact Address</label>
     

    <input type="text" id="address"  name="address">


     <label for="state">State</label>
    <select id="state" name="state">
      <option value="">-Select State-</option>
      <?php foreach ($state as $key => $value) { ?>
     <option value="<?php echo $value['stateId']?>"><?php echo $value['stateName'] ?></option>
     <?php } ?>
    </select>


    <label for="district">District</label>
    <div></div>
    <select id="district" name="district">
    
    </select>

     <label for="mobile"> Mobile No.</label>
     
    
    <input type="text" id="mobile" required="" maxlength="10"  minlength="10" onkeypress="return isNumberKey(event)"  name="mobile">

 
    <label for="incidenceDate">Date of incidence </label>
 
    <input type="date" id="incidenceDate" style="width: 100%" value="" name="incidenceDate" >


    <label for="phone">Place of incidence occurred: </label>
 

<br>
  <select id="stateIncidence" required="" name="stateIncidence" style="width: 48%;float: left;margin-right: 17px;">
     <option value="">-Select State-</option>
      <?php foreach ($state as $key => $value) { ?>
     <option value="<?php echo $value['stateId']?>"><?php echo $value['stateName'] ?></option>
     <?php } ?>

    </select>


    
    <select id="districtIncidence"  required="" name="districtIncidence" style="width: 48%">
     <option>-select-</option>

    </select>
    <div>

 
  <!--   <label for="incidenceReport">Date of incidence  Reported</label>
 
    <input type="date" id="incidenceReport"  style="width: 100%" value="" name="incidenceReport" >
 -->

    <label for="incidenceType">Type of incidence</label>

    <select id="incidenceType" id="incidenceType" name="incidenceType">
      <option value="">Select</option>
      <option value="Violence">Violence</option>
      <option value="Discrimination">Discrimination</option>
       <option value="Physical Abuse">Physical Abuse</option>
       <option value="Mental Abuse">Mental Abuse</option>
       <option value="Economic Abuse">Economic Abuse</option>
       <option value="Others">Others </option>
  


    </select>


<div id="incidenceTypeDiv" style="display: none;">
   <label for="incidenceType">Type of incidence-others details</label>    
    <input type="text" name="incidenceTypeOther" id="incidenceTypeOther" >
</div>

    <label for="byWhom">By whom</label>

        <select id="byWhom" name="byWhom">
      <option value="">Select</option>
      <option >Parents</option>
      <option >Siblings</option>
       <option >Friends</option>
       <option >Community members</option>
       <option >Health care providers</option>
       <option >Teachers</option>
        <option >Partners</option>
       <option >Others </option>
     
    </select>

    <div id="byWhomOtherDiv" style="display: none;">
      <label for="incidenceType">By Whom-others details</label>    
    <input type="text" name="byWhomOther" id="byWhomOther" >
    </div>

     <label for="support">Support Required</label>

        <select id="support" name="support">
      <option value="">Select</option>
      <option >Counselling</option>
      <option >Legal</option>
       <option >Police</option>
       <option >Community</option>
       <option >Leaders</option>
       <option >TG Welfare Board</option>
        <option >Child Rights Commission</option>
        <option >Human Rights Commission</option>
       <option >Others</option>
     
    </select>

    
       <div id="supportOtherDiv" style="display: none;">
      <label for="incidenceType">Support Required-others details</label>    
    <input type="text" name="supportOther" id="supportOther" >
    </div>




    </div>
   

    <label for="description">Incidence Description</label>
    <textarea id="description" name="description" style="height:200px"></textarea>

    <input type="checkbox" name="agree" required >By signing up, I agree to your Terms, Privacy Policy and agree to receive calls, messages, emails from the website.
    <br>

    <input type="submit" id="SubmitBtn" value="Submit">

<p style="    padding-top: 10px;
    padding-bottom: 10px;">
    <span class="updated">Last Modified: 14 June 2018</span></p>
  </form>

</div>
<!-- <div class="reach_us">
	
	<h3><u>Reach Us</u></h3>
<p style="font-size: 17px;"><br>
<b>E-mail:</b><br>
<a href="mailto:help@sahay-india.org"><u>help@sahay-india.org</u></a>
</p>
<br>
<p style="font-size: 17px;"><b>Phone:</b><br>
 011- 4100 7035<br>
</p>
</div> -->

 

</div>


<div class="share-post">
	<span class="share-text" style="
    background-color: #ff0400;
">Share</span>
	
		<ul class="flat-social">	
			<li ><a href="http://www.facebook.com/sharer.php?u=http://101.53.136.41/sahya/contact/" class="social-facebook" rel="external" target="_blank" style="background: #39599f;"><i class="fa fa-facebook" ></i> <span>Facebook</span></a></li>
		
			<li><a href="https://twitter.com/intent/tweet?text=Contact+Us&amp;url=http://101.53.136.41/sahya/contact/" class="social-twitter" rel="external" target="_blank" style="background: #45b0e3;><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
				<li><a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://101.53.136.41/sahya/contact/&amp;name=Contact+Us" class="social-google-plus" rel="external" target="_blank" style="background: #fa0101;><i class="fa fa-google-plus"></i> <span>Google +</span></a></li>
					<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://101.53.136.41/sahya/contact/&amp;title=Contact+Us" class="social-linkedin" rel="external" target="_blank" style="background: #65b7d2;><i class="fa fa-linkedin"></i> <span>LinkedIn</span></a></li>
				<li><a href="http://pinterest.com/pin/create/button/?url=http://101.53.136.41/sahya/contact/&amp;description=Contact+Us&amp;media=http://101.53.136.41/sahya/wp-content/uploads/2017/12/espresso.jpg" class="social-pinterest" rel="external" target="_blank" style="background: #E00707;><i class="fa fa-pinterest"></i> <span>Pinterest</span></a></li>
		</ul>
		<div class="clear"></div>
</div>
<script type="text/javascript">
    (function($){

      $('#fname').keypress(function( e ) {
           var regex = new RegExp("^[a-zA-Z]+$");

           var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      /* if(e.which === 32 || e.key == '@'  || e.key == '#' || e.key == '$' || e.key == '%' || e.key == '^' || e.key == '*' || e.key == '(' || e.key == ')' || e.key == '-' || e.key == '-' || e.key == '+' || e.key == '|' || e.key == '/' || e.key == '<' || e.key == '>' || e.key == '&' || e.key == '!' || e.key == '`' || e.key == '~') 
         return false;*/

         if(e.which === 32 || !regex.test(key))
          return false;
       });



       $('#lname').keypress(function( e ) {
           var regex = new RegExp("^[a-zA-Z]+$");

           var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      /* if(e.which === 32 || e.key == '@'  || e.key == '#' || e.key == '$' || e.key == '%' || e.key == '^' || e.key == '*' || e.key == '(' || e.key == ')' || e.key == '-' || e.key == '-' || e.key == '+' || e.key == '|' || e.key == '/' || e.key == '<' || e.key == '>' || e.key == '&' || e.key == '!' || e.key == '`' || e.key == '~') 
         return false;*/

         if(e.which === 32 || !regex.test(key))
          return false;
       });


       $('#incidenceType').change(function(){
           
           var incidenceType = $('#incidenceType').val();
           
           if(incidenceType == 'Others')
           {
              $('#incidenceTypeDiv').css('display','block');

              $('#incidenceTypeOther').prop('required',true);
           }else{
             $('#incidenceTypeDiv').css('display','none');
              $('#incidenceTypeOther').prop('required',false);
           } 

       });

         $('#byWhom').change(function(){
           
           var byWhom = $('#byWhom').val();
           
           if(byWhom == 'Others')
           {
              $('#byWhomOtherDiv').css('display','block');

              $('#byWhomOther').prop('required',true);
           }else{
             $('#byWhomOtherDiv').css('display','none');
              $('#byWhomOther').prop('required',false);
           } 

       });

         $('#support').change(function(){
          var support = $('#support').val();

          if(support == 'Others')
           {
            $('#supportOtherDiv').css('display','block');

            $('#supportOther').prop('required',true);
           }else{
              $('#supportOtherDiv').css('display','none');
              $('#supportOther').prop('required',false);
           } 

         });

   
      $('#incidenceReport').change(function(){
        incidenceDate = $('#incidenceDate').val();
        incidenceReport = $('#incidenceReport').val();
          //alert(incidenceDate);

          var value1 = incidenceDate.replace(/\-/g, '');

           var value2 = incidenceReport.replace(/\-/g, '');

           if(value1 > value2)
           {
             alert('Date of Incidence Reported can not be earlier than date of Incidence');

             $('#SubmitBtn').prop('type','button');
           }else{

               $('#SubmitBtn').prop('type','submit');

           } 
      });


      $('#state').change(function(){
        var stateId = $('#state').val();

        //alert(stateId);
       $("#district").html('');
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
            htm += '<option value="" readonly>No District</option>';
            $("#district").html(htm);
            //$('.form-control').chosen().trigger("liszt:updated");
        }else{
          
          //$('.chosen-select').chosen("destroy").chosen();

          var htm = '';
            htm += '<option value="" readonly>Select District</option>';
            for(var i = 0; i < len; i++){
              htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
            }
            //htm +='</select>';
            $("#district").html(htm);
            //$('.form-control').chosen().trigger("liszt:updated");
    
          
          
        }
      }
         });
    });

        $('#stateIncidence').change(function(){
        var stateId = $('#stateIncidence').val();

        //alert(stateId);
       $("#districtIncidence").html('');
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
            htm += '<select class="form-control"  name="districtId" id="sl2"><option value="" readonly>No District</option></select>';
            $("#districtIncidence").html(htm);
            //$('.form-control').chosen().trigger("liszt:updated");
        }else{
          
          //$('.chosen-select').chosen("destroy").chosen();

          var htm = '';
            htm += '<select class="form-control"  name="districtId"  id="sl2"><option value="" readonly>Select District</option>';
            for(var i = 0; i < len; i++){
              htm += '<option value="'+result[i].districtId+'">'+result[i].districtName+'</option>';
            }
            htm +='</select>';
            $("#districtIncidence").html(htm);
            //$('.form-control').chosen().trigger("liszt:updated");
    
          
          
        }
      }
         });
    });


        $('#email').change(function(){
            if($('#email').val() != '')
            {
                $('#email').prop('required',true);
                $('#phone').prop('required',false);
            }else{
                $('#email').prop('required',false);
                $('#phone').prop('required',false);
            }   
        });

        $('#phone').change(function(){
            if($('#phone').val() != '')
            {
                $('#email').prop('required',false);
                $('#phone').prop('required',true);

                var phone = $('#phone').val();

                if(phone.length < 10)
                {
                    //alert('hjghg');
                    $('#spanMobile').css('display','block');
                    $('#submit').attr('type','button');
                }
                else{
                    $('#spanMobile').css('display','none');
                    $('#submit').attr('type','submit');
                }   
            }else{
                $('#spanMobile').css('display','none');
                    $('#submit').attr('type','submit');
                $('#email').prop('required',false);
                $('#phone').prop('required',false);
            }   
        });


    })(jQuery);
</script>
<script type="text/javascript">
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            //alert(charCode);
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>



