
    <!-- Page Content -->
	<div id="main-content" class="container">
		<div class="content">    
		
			<table class="table">
                            <thead>
                            <tr>
                                <th>Event Data</th>
                             </tr>
                            </thead>
                            <tbody>
							<form method="post" action="<?php echo base_url(); ?>index.php/homeweb/eventSearch">
							<tr>
								<td>Name</td>
								<td><input type="text" name="name"></td>
							</tr>
							<tr>
								<td>Date</td>
								<td><input type="text" name="date"></td>
							</tr>
							<tr>
								<td><input type="submit" value="SEARCH"></td>
							</tr>
							</form>
                            </tbody>
                        </table>
						<?php if($eventList) { ?>
						<table class="table">
                            <tbody>
							<?php foreach($eventList as $list) { ?>
                            <tr>
                                <td><?php echo $list['eventName']; ?></td>
                                <td><?php echo $list['eventVenue']; ?></td>
                                <td><?php echo $list['eventDate']; ?></td>
                            </tr>
							<?php } ?>
                            </tbody>
                        </table>
						<?php } ?>

			
		</div>
		
		<aside id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 623px;">
			<img src="<?php echo base_url(); ?>assetsweb/img/image1.jpg">
		</aside>
	</div>
    <!-- /.Page Content -->