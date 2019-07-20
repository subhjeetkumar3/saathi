<style type="text/css">
	p{
		margin: 5px 0;
	}


.content	{text-align: left;

background: #f9f9f9;

display: block; padding: 30px 20px;}
</style>
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content"> 
		<h4 style="font-size: 15px; font-size: 17px;

line-height: 50px;

color: green;">User has been successfully created</h4>  
		 <table style="width:50%;margin-bottom: 10px;">
		 	<tr>
		 		<th>User Name:</th>
		 		<td><?php print_r($userName);?></td>
		 	</tr>
		 	<!-- <tr>
		 	 <th>Password:</th>	
		 	 <td><?php print_r($password);?></td>
		 	</tr> -->
		 	<tr>
		 	 <th>Name:</th>	
		 	 <td><?php print_r($name);?></td>
		 	</tr>

		 	<tr>
		 	  <th>Contact Number:</th>	
		 	  <td><?php print_r($mobileNo)?></td>
		 	</tr>
		 	<tr>
		 	 <th>Email:</th>
		 	 <td><?php print_r($emailAddress);?></td>	
		 	</tr>
		 	
		 </table> 
		 <a href="<?php echo base_url()?>/index.php/homeweb/login"><button class="btn btn-primary btn-xs" style="padding: 10px 15px;

font-weight: bold;

text-transform: uppercase; color: #fff;

background: #0000ff80;">Log in</button></a>
		 </div>
		
<!-- 		<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside> -->
	</div>
    <!-- /.Page Content -->