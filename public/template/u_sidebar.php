
<div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="init" class="site_title">
				  <img src="<?php echo Theme::get_public_directory(); ?>/images/isotipo-m-index.png" width="48" alt="">&nbsp;
				 <!--  <i class="fa fa-paw"></i> -->
			  <span><?php echo $system_name; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo Theme::get_public_directory(); ?>/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo $_SESSION['nameUser']." ". $_SESSION['secondNameUser']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <!-- <h3>General</h3> -->
        <ul class="nav side-menu">
            <li><a href="System"><i class="fas fa-tachometer-alt"></i> Inicio </a></li>
			<li><a href="Sismos"><i class="fas fa-file-invoice" aria-hidden="true"></i> Sismos</a></li>
        </ul>
        <div class="empty-block-side-menu"></div>
      </div>

    </div>
    <!-- /sidebar menu -->

<script type="text/javascript">
  function closePanel() {
    if(confirm("Salir del SIRED?")) {
      window.location = 'LogOut';
    } else {
      return false;
    }
  } 
</script>

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="">&nbsp;</a>
      <a data-toggle="tooltip" data-placement="top" title="">&nbsp;</a>
      <a data-toggle="tooltip" data-placement="top" title="">&nbsp;</a>
      <a data-toggle="tooltip" onclick="closePanel();" data-placement="top" title="Salir" href="#">
        <span><i class="fas fa-power-off" aria-hidden="true"></i></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
	
          </div>
        </div>