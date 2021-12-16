<?php

require_once "class/Theme.php";

Theme::get_head_admin_profile();

?>

	<!-- page content -->
	<div class="right_col" role="main">

		<div class="x_panel">
			<div class="x_title">
				<h2>Admin - Dashboard</h2>
				<div class="clearfix"></div>
			</div>
			<div>
                <?php
                echo "==== ADMIN - Data from controller ====";
                ?>
			</div>

		</div>

	</div>
	<!-- /page content -->
<script type="text/javascript" language="javascript" src="<?=Theme::get_public_directory() ?>/js/jquery-2.2.4.min"></script>
<?php include_once Theme::get_template_directory() . '/below.php'; ?>
