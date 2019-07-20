<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.5/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2016 09:53:03 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SAATHI | Dashboard</title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url(); ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/chosen/chosen.css" rel="stylesheet">
	
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		//google.charts.load('current', {'packages':['bar','corechart']});
		google.charts.load('current', {'packages': ['corechart', 'bar', 'calendar']});
	</script>
	
	<style>
	.chzn-container-multi .chzn-choices .search-field .default{
		height:30px !important;
	}
	</style>
	<style>
	.nav > li.<?php echo $content; ?> {
		border-left: 4px solid #19aa8d;
		background: #293846;
		position: relative;
		display: block;
		list-style: none;
	}
	.nav > li.<?php echo $content; ?> > a {
		color:white !important;
	}
	#page-wrapper{
		min-height:100% important;
	}
	.chosen-container{
		width:100% !important;
	}
	.chosen-container-multi .chosen-choices li.search-field input[type="text"]{
		width:100% !important;
	}
	.nav > li.<?php echo $contentActive; ?> {
		border-left: 4px solid #19aa8d;
		background: #293846;
		position: relative;
		display: block;
		list-style: none;
	}
	.<?php echo $contentActive; ?> ul {
		display: block !important;
	}
	</style>
	

</head>

<body class="fixed-sidebar no-skin-config full-height-layout">
  <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" width="50px" class="img-circle" src="<?php echo base_url(); ?>assets/img/a4.jpg"/>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('userName'); ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $this->session->userdata('email'); ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                               <li><a href="<?php echo base_url(); ?>index.php/home/logout">LOGOUT</a></li>
							  <!-- <li><a href="<?php echo base_url(); ?>index.php/home/changePassword">Change Password</a></li>-->
                            </ul>
                        </div>
                        <div class="logo-element">
                           SAATHI
                        </div>
                    </li>
                    <li class="dashboard">
                        <a href="<?php echo base_url(); ?>index.php/home/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
					<li class="importantLink">
                        <a href="<?php echo base_url(); ?>index.php/home/importantLink"><i class="fa fa-user"></i> <span class="nav-label">Important Link</span></a>
                    </li>
					<li class="event">
                        <a href="<?php echo base_url(); ?>index.php/home/event"><i class="fa fa-user"></i> <span class="nav-label">Event</span></a>
                    </li>
					<li class="ongroundPartner">
                        <a href="<?php echo base_url(); ?>index.php/home/ongroundPartner"><i class="fa fa-user"></i> <span class="nav-label">Onground Partner</span></a>
                    </li>
					<li class="sms">
						<a href="#"><i class="fa fa-user"></i><span class="nav-label">SMS</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li class="smsModule"><a href="<?php echo base_url(); ?>index.php/home/smsModule"><i class="fa fa-user"></i> <span class="nav-label">SMS</span></a></li>
							<li class="smsTemplate"><a href="<?php echo base_url(); ?>index.php/home/smsTemplate"><i class="fa fa-user"></i> <span class="nav-label">Template</span></a></li>
						</ul>
					</li>
					<li class="notification">
                        <a href="<?php echo base_url(); ?>index.php/home/notification"><i class="fa fa-user"></i> <span class="nav-label">Notification</span></a>
                    </li>
					<li class="serviceProvider">
                        <a href="<?php echo base_url(); ?>index.php/home/serviceProvider"><i class="fa fa-user"></i> <span class="nav-label">Service Provider</span></a>
                    </li>
					<li class="user">
                        <a href="<?php echo base_url(); ?>index.php/home/user"><i class="fa fa-user"></i> <span class="nav-label">User</span></a>
                    </li>
					<li class="quiz">
                        <a href="<?php echo base_url(); ?>index.php/home/quiz"><i class="fa fa-user"></i> <span class="nav-label">Quiz</span></a>
                    </li>
					<li class="comments">
                        <a href="<?php echo base_url(); ?>index.php/home/commentsWp"><i class="fa fa-user"></i> <span class="nav-label">Comments</span></a>
                    </li>

                    <li class="contactRequest">
                     <a href="<?php echo base_url(); ?>index.php/home/getContactRequest"><i class="fa fa-user"></i> <span class="nav-label">Contact Request</span></a>	
                    </li>
					
				</ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg" style="min-height:100%;height:auto;">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"> Welcome to the SAATHI Admin Panel</span>
                </li>
				<li>
                    <a href="<?php echo base_url(); ?>index.php/home/logout">
                        <i class="fa fa-sign-out"></i> LOGOUT
                    </a>
                </li>
            
            </ul>

        </nav>
        </div>
