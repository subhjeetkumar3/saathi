



 <div class="middle-box text-center loginscreen animated fadeInDown" style="width:50% !important;">
        <div>
            <div>

                  <h1 class="logo-name">S</h1>
				 <!-- <img src="<?php echo base_url(); ?>assets/img/salogo.png" style="width:100%;">-->

            </div>
            <h3>Forget Password</h3>
            
           
            <?php if($this->session->flashdata('errorMessage')){ ?>
            <div class="alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <!--  <i class="fa fa-check-circle fa-fw fa-lg"></i> -->
                <?php echo $this->session->flashdata('errorMessage'); ?>.
            </div>
            <?php } ?>
            <form class="m-t" role="form" action="<?php echo base_url(); ?>index.php/home/checkUsername" method="post">
			<div id="main">
				<div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Your Username" required="" name="userName">				
                </div>
               
                <button type="submit" class="btn btn-primary block full-width m-b">SUBMIT</button>
                  <a href="<?php echo base_url()?>" class="btn btn-primary block full-width m-b">Back</a>
				</div>
                
            </form>
         
        </div>
    </div>