

        <!-- footer content -->
        <footer>
          <div class="pull-right" style="float:right;">
        	<?php echo base64_decode('Q29weXJpZ2h0IMKpIDIwMjEgSm9lTUcgVG9kb3MgbG9zIGRlcmVjaG9zIHJlc2VydmFkb3Mu'); ?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script>window.jQuery || document.write('<script src="../vendors/jquery/dist/jquery.min.js"><\/script>')</script>

	<script>
	if ($(window).width() > 990) {
		$(function() {
			$('body').removeClass('nav-md').addClass('nav-sm');
			$('.left_col').removeClass('scroll-view').removeAttr('style');
			$('#sidebar-menu li').removeClass('active');
			$('#sidebar-menu li ul').slideUp();
		});
	}
	</script>	

    <!-- Bootstrap -->
   <script src="<?php echo Theme::get_vendor_directory(); ?>/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo Theme::get_vendor_directory(); ?>/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo Theme::get_vendor_directory(); ?>/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo Theme::get_vendor_directory(); ?>/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo Theme::get_public_directory(); ?>/build/js/custom.js?v=0.1"></script>
  </body>
</html>
