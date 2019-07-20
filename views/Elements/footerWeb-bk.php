 <!-- Footer -->
    <footer class="bg-dark">  
		<div class="footer-bottom">
		<div class="container">
			<div class="alignright">
				<a href="#">Privacy Policy</a> | <a href="#">Disclaimer</a> |  <a href="<?php echo base_url(); ?>index.php/homeweb/createUser">Registeration</a> |  <a href="#">Testimonials</a>		</div>
					
			<div class="alignleft">
				© Copyright 2017. All Rights Reserved. 		</div>
			<div class="clear"></div>
		</div><!-- .Container -->
		</div>
	</footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assetsweb/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assetsweb/vendor/popper/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assetsweb/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assetsweb/js/plugins/chosen/chosen.jquery.js"></script>
</div>
  </body>

</html>

 <script>
		$(document).ready(function() {
			
			
			var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
			
	});
				
				</script>