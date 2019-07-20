



 <div class="middle-box text-center loginscreen animated fadeInDown" style="width:50% !important;">
        <div>
            <div>

                  <h1 class="logo-name">S</h1>
				 <!-- <img src="<?php echo base_url(); ?>assets/img/salogo.png" style="width:100%;">-->

            </div>
            <h3>Verify User</h3>
            
           
            <?php if($errorMessage){ ?>
            <div class="alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <i class="fa fa-check-circle fa-fw fa-lg"></i> 
                <?php echo $errorMessage; ?>.
            </div>
            <?php } ?>
                <?php $this->session->set_userdata('temp_userId_panel',$userId);?>
            <form class="m-t" role="form" action="<?php echo base_url(); ?>index.php/home/checkUserOtp" method="post">
			<div id="main">
				<div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Your OTP" required="" name="otp">				
                </div>

                <div class="form-group">
                        
                       
                            <input type="hidden" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile?>" required>
                        

                    </div>


                    <div class="form-group">
                       
                            <input type="hidden" name="userId" id="userId" class="form-control" value="<?php echo $userId?>" required>
                      

                    </div>
               
                <button type="submit" class="btn btn-primary block full-width m-b">SUBMIT</button>
                <a href="<?php echo base_url()?>" class="btn btn-primary block full-width m-b">Back</a>
				</div>
                
            </form>
         
        </div>
    </div>