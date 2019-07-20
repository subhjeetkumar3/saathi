



 <div class="middle-box text-center loginscreen animated fadeInDown" style="width:50% !important;">
        <div>
            <div>

                  <h1 class="logo-name">S</h1>
				 <!-- <img src="<?php echo base_url(); ?>assets/img/salogo.png" style="width:100%;">-->

            </div>
            <h3>Reset Password</h3>
            '<div class = "alert alert-error" id="divPassword" style="background-color: #1ab394;margin:0px !important;display: none;">
                    <button type = "button" class = "close" data-dismiss = "alert">
                    <i class = "icon-remove"></i>
                    </button>
                    <strong style="color:white;">
                    <i class = "icon-remove"></i>
                     Password does not match
                    </strong>
                    </div>
           
              
            <form class="m-t" role="form" action="<?php echo base_url(); ?>index.php/home/setPassword" method="post">
			<div id="main">
				
                <div class="form-group">
                      
                            <input type="password" name="password" id="password" class="form-control" required placeholder="ENTER PASSWORD">
                                                    
                    </div>
                    <div class="form-group">
                     
                            <input type="password" name="cpassword" onchange="checkPassword()" id="cpassword" class="form-control" required placeholder="CONFIRM PASSWORD">
                                              
                    </div>


                    <div class="form-group">
                        
                        <div class="col-lg-6">
                            <input type="hidden" name="userId" id="userId" class="form-control" value="<?php echo $userId?>" required>
                        </div>

                    </div>
                <button type="submit" id="submitBtn" class="btn btn-primary block full-width m-b">SUBMIT</button>
				</div>
                
            </form>
         
        </div>
    </div>
    <script type="text/javascript">
        function checkPassword()
        {

         var pass = $('#password').val();

         var cpass = $('#cpassword').val();

             if(pass != cpass)
             {
                $('#divPassword').css('display','block');
                $('submitBtn').attr('type','button');

             }else{

                $('#divPassword').css('display','none');
                $('submitBtn').attr('type','submit');

             }  
        }
    </script>