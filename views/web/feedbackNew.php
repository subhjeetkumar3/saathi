<style>
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

.hr_line  {
    border-bottom: 1px solid #f2f2f2;
    padding-bottom: 5px;
    margin-bottom: 10px;
}
</style>
<style type="text/css">
    .overall-rating{font-size: 14px;margin-top: 5px;color: #8e8d8d;}
</style>
<!-- <h1>SAPCE-O - Rating Blog</h1> -->
  <!--   <input name="rating" value="0" id="rating_star" type="hidden" postID="1" />
    <div class="overall-rating">(Average Rating <span id="avgrat"><?php echo $ratingRow['average_rating']; ?></span> -->


    <?php if($this->session->flashdata('feedbackMessage') && !$this->session->flashdata('feedbackSubmitMessage')) {?>
<h4 style="color: #e5e5e5;background: #a5630d;padding: 10px;"><?php echo $this->session->flashdata('feedbackMessage'); ?>.</h4>
<?php }?>  

 <?php if($this->session->flashdata('feedbackSubmitMessage')) {?>
<h4 style="color: #e5e5e5;background: #a5630d;padding: 10px;"><?php echo $this->session->flashdata('feedbackSubmitMessage'); ?>.</h4>
<?php }?>  

<p class="hr_line"></p>

 <form action="getFileReportFeedback" method="POST">     

 <input type="text"  required name="reportId" id="reportId" placeholder="Enter Your Report Id">  
 <span id="reportIdSpan" style="display: none;color: red">No such report id</span>   
<h3> Police   </h3>

  <img style="width: 50px;height: 50px;"  imgType="empty"  id="img1" src="<?php echo base_url();?>uploads/img/emptyStar.png">
   <img style="width: 50px;height: 50px;"  imgType="empty" id="img2" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;"  imgType="empty" id="img3" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;"  imgType="empty" id="img4" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;"  imgType="empty" id="img5" src="<?php echo base_url();?>uploads/img/emptyStar.png">

    <input type="hidden" name="part1" id="part1" value="0" >
    <input type="text" placeholder="Write your feedback here" name="parttext1">


  <h3>Health Care providers    </h3>

  <img style="width: 50px;height: 50px;" imgType="empty"  id="img6" src="<?php echo base_url();?>uploads/img/emptyStar.png">
   <img style="width: 50px;height: 50px;" imgType="empty" id="img7" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img8" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img9" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img10" src="<?php echo base_url();?>uploads/img/emptyStar.png">
      <input type="hidden" name="part2" id="part2" value="0" >
          <input type="text" placeholder="Write your feedback here" name="parttext2">
    
  <h3> Legal service  providers     </h3>

  <img style="width: 50px;height: 50px;" imgType="empty"  id="img11" src="<?php echo base_url();?>uploads/img/emptyStar.png">
   <img style="width: 50px;height: 50px;" imgType="empty" id="img12" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img13" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img14" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img15" src="<?php echo base_url();?>uploads/img/emptyStar.png">

      <input type="hidden" name="part3" id="part3" value="0" >
          <input type="text" placeholder="Write your feedback here" name="parttext3">
    
  <h3> Educational Institutions    </h3>

  <img style="width: 50px;height: 50px;" imgType="empty"  id="img16" src="<?php echo base_url();?>uploads/img/emptyStar.png">
   <img style="width: 50px;height: 50px;" imgType="empty" id="img17" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img18" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img19" src="<?php echo base_url();?>uploads/img/emptyStar.png">
    <img style="width: 50px;height: 50px;" imgType="empty" id="img20" src="<?php echo base_url();?>uploads/img/emptyStar.png">

      <input type="hidden" name="part4" id="part4" value="0" >
          <input type="text" placeholder="Write your feedback here" name="parttext4">
      <br>

      <p class="hr_line"></p>

    
    <input type="submit" name="submit" value="Submit" id="submitFeedback">
</form>



    <script language="javascript" type="text/javascript">


   (function($){

    var base_url1 = '<?php echo base_url();?>';

     document.getElementById("reportId").onchange = function()
     {
       var reportId = document.getElementById("reportId").value;

         var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
             if(this.responseText);

              var rslt = this.responseText.trim();
            result = JSON.parse(rslt);
            var len = result.length;

            if(len == 0)
             {
               document.getElementById("submitFeedback").setAttribute('type','button');

               document.getElementById("reportIdSpan").style.display = "block";
               
             }else{
              document.getElementById("submitFeedback").setAttribute('type','submit');

               document.getElementById("reportIdSpan").style.display = "none";
             } 

          }
        };
        xhttp.open("POST",base_url1+"homeweb/checkFileReportId", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("reportId="+reportId);
     }


     var base_url = '<?php echo base_url();?>uploads/img/';
   	


    document.getElementById("img1").onclick =function(){
  
  
         document.getElementById("img1").src = base_url+'fillStar.png';

         
          document.getElementById("part1").value = 1;


          document.getElementById("img2").src = base_url+'emptyStar.png';
          document.getElementById("img3").src = base_url+'emptyStar.png';

          document.getElementById("img4").src = base_url+'emptyStar.png';
          document.getElementById("img5").src = base_url+'emptyStar.png';

       

          
           
    };

      document.getElementById("img2").onclick =function(){
        
       
         document.getElementById("img1").src = base_url+'fillStar.png';
          document.getElementById("img2").src = base_url+'fillStar.png';

          document.getElementById("part1").value = 2;

      
          document.getElementById("img3").src = base_url+'emptyStar.png';

          document.getElementById("img4").src = base_url+'emptyStar.png';
          document.getElementById("img5").src = base_url+'emptyStar.png';
          

      
       
    };



      document.getElementById("img3").onclick =function(){
 
        
         document.getElementById("img1").src = base_url+'fillStar.png';
          document.getElementById("img2").src = base_url+'fillStar.png';
          document.getElementById("img3").src = base_url+'fillStar.png';

          document.getElementById("part1").value = 3;

        document.getElementById("img4").src = base_url+'emptyStar.png';
          document.getElementById("img5").src = base_url+'emptyStar.png';
        

        
     
       
    };


      document.getElementById("img4").onclick =function(){
       
         document.getElementById("img1").src = base_url+'fillStar.png';
          document.getElementById("img2").src = base_url+'fillStar.png';
          document.getElementById("img3").src = base_url+'fillStar.png';
          document.getElementById("img4").src = base_url+'fillStar.png';
           document.getElementById("img5").src = base_url+'emptyStar.png';

          document.getElementById("part1").value = 4;

      
       
    };

      document.getElementById("img5").onclick =function(){
         
       
         document.getElementById("img1").src = base_url+'fillStar.png';
          document.getElementById("img2").src = base_url+'fillStar.png';
          document.getElementById("img3").src = base_url+'fillStar.png';
          document.getElementById("img4").src = base_url+'fillStar.png';
          document.getElementById("img5").src = base_url+'fillStar.png';

          document.getElementById("part1").value = 5;

       
    };

     document.getElementById("img6").onclick =function(){
         
       
          document.getElementById("img6").src = base_url+'fillStar.png';
           document.getElementById("part2").value = 1;
            document.getElementById("img7").src = base_url+'emptyStar.png';

          document.getElementById("img8").src = base_url+'emptyStar.png';
          document.getElementById("img9").src = base_url+'emptyStar.png';
          document.getElementById("img10").src = base_url+'emptyStar.png';  

     
      
    };

     document.getElementById("img7").onclick =function(){
   
         document.getElementById("img6").src = base_url+'fillStar.png';

          document.getElementById("img7").src = base_url+'fillStar.png';
          document.getElementById("part2").value = 2;
            document.getElementById("img8").src = base_url+'emptyStar.png';
          document.getElementById("img9").src = base_url+'emptyStar.png';
          document.getElementById("img10").src = base_url+'emptyStar.png'; 

    
       
    };

   document.getElementById("img8").onclick =function(){
         document.getElementById("img6").src = base_url+'fillStar.png';

          document.getElementById("img7").src = base_url+'fillStar.png';
          document.getElementById("img8").src = base_url+'fillStar.png';
          document.getElementById("part2").value = 3;

            
          document.getElementById("img9").src = base_url+'emptyStar.png';
          document.getElementById("img10").src = base_url+'emptyStar.png';
       
    };
    

     document.getElementById("img9").onclick =function(){
         
    
         document.getElementById("img6").src = base_url+'fillStar.png';

          document.getElementById("img7").src = base_url+'fillStar.png';
          document.getElementById("img8").src = base_url+'fillStar.png';
          document.getElementById("img9").src = base_url+'fillStar.png';

          document.getElementById("part2").value = 4;

          document.getElementById("img10").src = base_url+'emptyStar.png';

      
        
    };


     document.getElementById("img10").onclick =function(){
         document.getElementById("img6").src = base_url+'fillStar.png';

          document.getElementById("img7").src = base_url+'fillStar.png';
          document.getElementById("img8").src = base_url+'fillStar.png';
          document.getElementById("img9").src = base_url+'fillStar.png';
          document.getElementById("img10").src = base_url+'fillStar.png';

          document.getElementById("part2").value = 5;

       
    };

   document.getElementById("img11").onclick =function(){
         
          document.getElementById("img11").src = base_url+'fillStar.png';      

           document.getElementById("part3").value = 1;

          document.getElementById("img12").src = base_url+'emptyStar.png';
          document.getElementById("img13").src = base_url+'emptyStar.png';

          document.getElementById("img14").src = base_url+'emptyStar.png';
          document.getElementById("img15").src = base_url+'emptyStar.png';


    };
    
     document.getElementById("img12").onclick =function(){
  
        document.getElementById("img11").src = base_url+'fillStar.png';
          document.getElementById("img12").src = base_url+'fillStar.png';

           document.getElementById("part3").value = 2;

           document.getElementById("img13").src = base_url+'emptyStar.png';

          document.getElementById("img14").src = base_url+'emptyStar.png';
          document.getElementById("img15").src = base_url+'emptyStar.png';
        
    };


   document.getElementById("img13").onclick =function(){
         
           document.getElementById("img11").src = base_url+'fillStar.png';
          document.getElementById("img12").src = base_url+'fillStar.png';
          document.getElementById("img13").src = base_url+'fillStar.png';

           document.getElementById("part3").value = 3;

           document.getElementById("img14").src = base_url+'emptyStar.png';
          document.getElementById("img15").src = base_url+'emptyStar.png';
        

         
    };
    
   document.getElementById("img14").onclick =function(){
  
         document.getElementById("img11").src = base_url+'fillStar.png';
          document.getElementById("img12").src = base_url+'fillStar.png';
          document.getElementById("img13").src = base_url+'fillStar.png';
          document.getElementById("img14").src = base_url+'fillStar.png';


           document.getElementById("part3").value = 4;

              document.getElementById("img15").src = base_url+'emptyStar.png';
      
    };
    
  document.getElementById("img15").onclick =function(){ 
         document.getElementById("img11").src = base_url+'fillStar.png';
          document.getElementById("img12").src = base_url+'fillStar.png';
          document.getElementById("img13").src = base_url+'fillStar.png';
          document.getElementById("img14").src = base_url+'fillStar.png';
          document.getElementById("img15").src = base_url+'fillStar.png';

      

           document.getElementById("part3").value = 5;
       
    };
    
   document.getElementById("img16").onclick =function(){
         
          document.getElementById("img16").src = base_url+'fillStar.png';

           document.getElementById("part4").value = 1;

           document.getElementById("img17").src = base_url+'emptyStar.png';

          document.getElementById("img18").src = base_url+'emptyStar.png';
          document.getElementById("img19").src = base_url+'emptyStar.png';
          document.getElementById("img20").src = base_url+'emptyStar.png';  
        
    };
    
   document.getElementById("img17").onclick =function(){

         document.getElementById("img16").src = base_url+'fillStar.png';
          document.getElementById("img17").src = base_url+'fillStar.png';

                     document.getElementById("part4").value = 2;

         document.getElementById("img18").src = base_url+'emptyStar.png';
          document.getElementById("img19").src = base_url+'emptyStar.png';
          document.getElementById("img20").src = base_url+'emptyStar.png';               
      
    };
    
    document.getElementById("img18").onclick =function(){
            
            document.getElementById("img16").src = base_url+'fillStar.png';
          document.getElementById("img17").src = base_url+'fillStar.png';

          document.getElementById("img18").src = base_url+'fillStar.png';

            document.getElementById("img19").src = base_url+'emptyStar.png';
          document.getElementById("img20").src = base_url+'emptyStar.png';

     
                     document.getElementById("part4").value = 3;
       
    };
    

     document.getElementById("img19").onclick =function(){
         
        document.getElementById("img19").setAttribute('imgType','fill');
          document.getElementById("img16").src = base_url+'fillStar.png';
          document.getElementById("img17").src = base_url+'fillStar.png';

          document.getElementById("img18").src = base_url+'fillStar.png';
          document.getElementById("img19").src = base_url+'fillStar.png';

            document.getElementById("img20").src = base_url+'emptyStar.png';


                     document.getElementById("part4").value = 4;
      
    };


    document.getElementById("img20").onclick =function(){
         
        document.getElementById("img16").src = base_url+'fillStar.png';
          document.getElementById("img17").src = base_url+'fillStar.png';

          document.getElementById("img18").src = base_url+'fillStar.png';
          document.getElementById("img19").src = base_url+'fillStar.png';
          document.getElementById("img20").src = base_url+'fillStar.png';


                     document.getElementById("part4").value = 5;

        
    };
    
  


   })(jQuery);

</script>
