
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<?php echo $_SESSION['nameUser']." ". $_SESSION['secondNameUser']; ?>&nbsp;&nbsp;
						<span style="background:#fff; color: #73879C;padding: 4px; border: 1px solid #D9DEE4; border-radius: 50%;" class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;
						
					</a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">                    
                  	<a class="dropdown-item"  href="change_pass"> Cambio de Contraseña</a>
                    <a class="dropdown-item"  onclick="closePanel();"><i class="fa fa-sign-out pull-right"></i> Salir</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->		