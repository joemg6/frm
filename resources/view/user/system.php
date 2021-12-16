<?php

require_once "class/Theme.php";

Theme::get_head_profile();

?>

<!-- page content -->
<div class="right_col" role="main">

		<div class="content">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel tile overflow_hidden">
					<div class="x_title">
                		<h2>USER PAGE</h2>
						<div class="clearfix"></div>
					</div>
                    <div class="content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            echo "==== USER - Data from controller ====";
                            ?>
                        </div>
                    </div>
				</div>
			</div>
		</div>

</div>

<!-- /page content -->

<script type="text/javascript" src="<?php echo Theme::get_public_directory(); ?>/js/jquery-2.2.4.min"></script>

<?php include_once Theme::get_template_directory() . '/below.php'; ?>
