<?php

require_once "class/Theme.php";

Theme::get_head_profile();

$rol_access = $_SESSION['modulo'];

function setButtonAddRegistro(array $rol_access) {
    if ( in_array("admin", $rol_access) ) {
        return '{
                    text: \'<i class="fa fa-plus" aria-hidden="true"></i> Agregar Registro\',
                    attr:  {            
                        class: \'btn-agregar\'
                    },
                    action: function ( e, dt, node, config ) {
                        $("#Agregar").modal("show");
                    }
                }';
    }
    return "'pageLength'";
}

function setButtonsInRows(array $rol_access) {
    $mapViewer = '<a href=\'#\' class=\'mapViewer\'><i class=\'fas fa-bullseye\'></i></a>';
    $editRow = '<a href=\'#\' class=\'editFile\'><i class=\'fa fa-edit\'></i></a>';
    $deleteRow = "";
    if ( in_array("admin", $rol_access ) ) {
        if ( in_array("admin", $rol_access) ) {
            $deleteRow = '<a href=\'#\' class=\'deleteFile\'><i class=\'fa fa-trash\'></i></a>';
        }
        return '
                { "targets": -1,	"data": null,
                "defaultContent": " '. $mapViewer .'&nbsp;&nbsp; '. $editRow .'&nbsp;&nbsp; ' . $deleteRow . ' "
                }';
    }
    return '
            { "targets": -1,	"data": null, 
            "defaultContent": " '. $mapViewer .' " }';
}

?>

<style>
	div.table-responsive > table {
		border-top: 1px solid #ddd;
		border-bottom: 1px solid #ddd;
		border-left: 1px solid #ddd;
		border-right: 1px solid #ddd;
	}
	#statistic-grid > tbody > tr > td:first-child + td + td {
		text-align: center;
	}
	#statistic-grid > tbody > tr > td > div.report {
		width: 1.8rem;
		height: 1.8rem;
		margin: auto;
		padding-top: 0.3rem;
		font-weight: bold;
		text-align: center;
		color: #ffffff;
		border-radius: 50%;
	}
	#statistic-grid > tbody > tr > td > div.green {
		background-color: #229954;
	}
	#statistic-grid > tbody > tr > td > div.yellow {
		background-color: #F1C40F;
	}	
	#statistic-grid > tbody > tr > td > div.red {
		background-color: #E20000;
	}
</style>

	<!-- page content -->
	<div class="right_col" role="main">

		<div class="x_panel">
			<div class="x_title">
				<h2>Sismos registrados y sentidos en la región Áncash</h2>
				<div class="clearfix"></div>
			</div>	

			<div>

				<div class="table-responsive">	
					<div class="tile_count">		
						<div class="col-md-2 col-sm-2 col-xs-12 tile_stats_count">
							<span class="count_top"><i class="fa fa-file-invoice"></i> Sismos en total</span>
							<div class="count green" style="text-align:center;"><?= $total_rpt??''; ?></div>
						</div>						
						<div class="col-md-2 col-sm-2 col-xs-12 tile_stats_count">
							<span class="count_top"><i class="fa fa-file-invoice"></i> Magnitud menor a 4.5</span>
							<div class="count" style="color:#229954; text-align:center;"><?= $min_sismos??''; ?></div>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 tile_stats_count">
							<span class="count_top"><i class="fa fa-file-invoice"></i> Magnitud entre 4.5 y 6</span>
							<div class="count" style="color:#F1C40F; text-align:center;"><?= $mid_sismos??''; ?></div>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 tile_stats_count">
							<span class="count_top"><i class="fa fa-file-invoice"></i> Magnitud mayor a 6</span>
							<div class="count" style="color:#E20000; text-align:center;"><?= $max_sismos??''; ?></div>
						</div>							
					</div>
				</div>

	<?= Theme::get_dependecies_css_inbody(); ?>

				<div class="table-responsive">		
					<table id="statistic-grid" class="table-hover table table-striped dt-responsive dataTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Magnitud</th>
								<th>Referencia</th>
								<th>Profundidad</th>
								<th>Intensidad</th>
								<th>Fecha</th>						
								<th>Latitud y Longitud</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
					</table> 
				</div>		
			</div>		
		</div>		
	</div>
	<!-- /page content -->

	<?= Theme::get_dependecies_js_inbody(); ?>

<script type="text/javascript" src="<?= Theme::get_public_directory();?>/js/datatables/customDataTables.js"></script>

<script>

    let magnitudFormat = {
       "render": function ( data) {
                if ( data < 4.5 )
                   return `<div class="report green">${data}</div>`;
                else if ( data >= 4.5 && data <= 6 )
                   return `<div class="report yellow">${data}</div>`;
                else if ( data > 6 )
                   return `<div class="report red">${data}</div>`;
                else
                   return '';
            },
            "targets": 1
       };
    let hideFirstColum = {
           "targets": [ 0 ],
           "visible": false
       };

    let buttonAddRegistro, buttonsInRows = "";
    buttonAddRegistro = <?php echo setButtonAddRegistro($rol_access);?>;
    Buttons.unshift(buttonAddRegistro);

    ColumnDefs.push(magnitudFormat);
    ColumnDefs.push(hideFirstColum);
    buttonsInRows = <?php echo setButtonsInRows($rol_access);?>;
    ColumnDefs.push(buttonsInRows);

    let Ajax = {
        url :"Sismos?jsonDataReportes=1",
        type: "post",
        error: function(){
            $(".statistic-grid-error").html("");
            $("#statistic-grid").append('<tbody class="statistic-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
            $("#statistic-grid_processing").css("display","none");
        }
    };

		$(function() {
			let dataTable = $('#statistic-grid').DataTable( {
    			"lengthChange": false,
			    "language": Language,
				dom: 'Bfrltip',
				lengthMenu: LengthMenu1,
				buttons: Buttons,
				"order": [[ 0, "desc" ]],
				"processing": false,
				"serverSide": true,
				"ajax": Ajax,
				"columnDefs": ColumnDefs
			});

			let location = window.location.href.split("\/").slice(-1).pop();
			const tbody = $('#statistic-grid tbody');
			
			tbody.on( 'click', 'a.editFile', function () {
				let data = dataTable.row( $(this).parents('tr') ).data();
				$("#e_ref").val(data[7]);
				$.getJSON("Sismos?jsonDataEditReportes=1&ref="+data[7], function(json) {
					$("#e_magnitud").val(json.magnitud);
					$("#e_referencia").val(json.referencia);
					$("#e_profundidad").val(json.profundidad);
					$("#e_intensidad").val(json.intensidad);
					$("#datetimepickerEdit").val(json.fechaSismo);
					$("#e_coordenadas").val(json.coordenadas);
				});					
				$('#Editar').modal('show');
			} );	
			let idFormEdit = $("#formEditSismos");	
			idFormEdit.on('click', 'button#submit', function() {				
				idFormEdit.parsley().validate();
				if ( idFormEdit.parsley().isValid() ) {			
					editRowAjx(idFormEdit, "Sismos");						
				}	
			});				
			
			tbody.on( 'click', 'a.deleteFile', function () {
				let data = dataTable.row( $(this).parents('tr') ).data();
				deleteRow(data[7], location);
			} );

			let idForm = $("#formAddSismos");
			idForm.on('click', 'button#submit', function() {
				idForm.parsley().validate();				
				if ( idForm.parsley().isValid() ) {
					addRow(idForm, location);
				}		
			});

			tbody.on( 'click', 'a.mapViewer', function () {
				let data = dataTable.row( $(this).parents('tr') ).data();
				if (data[6] !== 0 || data[6] !== '') {
					$('<a href="#?ref=' + data[7] + '&token=' + data[8] + '&lt=' + data[6] + '" target="blank"></a>')[0].click();
				} 
			} );
			
			setTimeout(() => {
				let col = "&nbsp;|&nbsp;";
				$("#statistic-grid_wrapper > div.dt-buttons > button:nth-child(3)").after(col);	
				$("#statistic-grid_wrapper > div.dt-buttons > button:nth-child(5)").after(col);	
				<?php
					$msn = $_GET['msn']?? NULL;
					if ($msn == "updated") {
						echo '
							$.notify("Registro Actualizado", {	
								className: \'success\'	
							});
						';
					}
				?>							
			}, 100);		
								
		} );

</script>

<?php include_once Theme::get_template_directory() . '/form/formAddRegSismos.php'; ?>
<?php include_once Theme::get_template_directory() . '/form/formEditRegSismos.php'; ?>
<?php include_once Theme::get_template_directory() . '/below.php'; ?>
