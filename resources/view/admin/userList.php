<?php

require_once "class/Theme.php";

Theme::get_head_admin_profile();

?>

<style>
    #statistic-grid_filter > label > input[type=search] {
        font-weight: normal;
    }
    .estado {
        color: #f8f9fa;
        padding: 2px 4px;
        background: green;
        border-radius: 4px;
    }
    }
</style>

<!-- page content -->
<div class="right_col" role="main">

    <div class="x_panel">
        <div class="x_title">
            <h2>Usuarios</h2>
            <div class="clearfix"></div>
        </div>

        <?= Theme::get_dependecies_css_inbody(); ?>

        <div class="table-responsive">
            <table id="statistic-grid" cellspacing="0" class="table-hover table table-striped dt-responsive dataTable" width="100%">
                <thead>
                <tr>
                    <th>Nick</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Modulo</th>
                    <th>Perfil</th>
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>

</div>
<!-- /page content -->

<?= Theme::get_dependecies_js_inbody(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#statistic-grid').DataTable( {
            "lengthChange": false,
            "language": {
                "url": "../public/js/Spanish.json",
                searchPlaceholder: "Buscar... ",
                buttons: {
                    pageLength: {
                        _: "%d ",
                        '-1': "Todos"
                    }
                }
            },
            dom: 'Bfrltip',
            lengthMenu: [
                [12, 24, 36, 48, 60, 72, 84],
                [ '12 Registros', '24 Registros', '36 Registros', '48 Registros', '48 Registros', '60 Registros', '72 Registros', '84 Registros' ]
            ],

            buttons: [
                <?php
                if ( in_array("admin", $_SESSION['modulo'] ) ) {
                    echo "	
					{					
						text: '<i class=\"fa fa-plus\" aria-hidden=\"true\"></i> Agregar Usuario',
						attr:  {            
							class: 'btn-agregar'
						},
						action: function ( e, dt, node, config ) {
							$('#Agregar').modal('show');
						}
					}";
                }
                ?>
                ,'pageLength',
                {extend:'colvis', text:'<i class="fa fa-list-ul"></i>'},
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    title: 'Reportes ',
                    filename: 'Reportes<?= date("_d-m-Y_H-i") ?>',
                    customize: function ( doc ) {
                        var colsH = [];
                        colsH[0] = {image: '<?php echo file_get_contents("public/images/base64LogoCOER.txt"); ?>', alignment: 'left', width:32, margin:[30, 16, 0, 0]};
                        colsH[1] = {image: '<?php echo file_get_contents("public/images/base64LogoRegion.txt"); ?>', alignment: 'left', width:34, margin:[740, 20, 0, 0] };
                        var objHeader = {};
                        objHeader['columns'] = colsH;
                        doc['header']=objHeader;

                        var cols = [];
                        cols[0] = {text: '', alignment: 'left', margin:[20] };
                        cols[1] = {text: 'Sired v.1.0', alignment: 'right', margin:[0,0,20] };
                        var objFooter = {};
                        objFooter['columns'] = cols;
                        doc['footer']=objFooter;
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                }
            ],

            "order": [[ 0, "desc" ]],
            "processing": false,
            "serverSide": true,
            "ajax":{
                url :"UserList?jsonDataReportes=1",
                type: "post",
                error: function(){
                    $(".statistic-grid-error").html("");
                    $("#statistic-grid").append('<tbody class="statistic-grid-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
                    $("#statistic-grid_processing").css("display","none");
                }
            },
            <?php
            $editRow = '<a href=\'#\' class=\'editFile\'><i class=\'fa fa-edit\'></i></a>';
            $deleteRow = "";
            $deleteRow = '<a href=\'#\' class=\'deleteFile\'><i class=\'fa fa-trash\'></i></a>';
            if ( in_array("admin", $_SESSION['modulo'] ) ) {
                echo '
						"columnDefs": [
							{ "targets": -1,	"data": null,
							"defaultContent": " ' , $editRow ,'&nbsp;&nbsp; ' , $deleteRow , ' "
							},
							{ "render": function ( data, type, row ) {
								if ( data == \'1\')									
                    				return \'<span class="estado">Activo</span>\';
								else 
									return \'-\';	
                				},
                			"targets": 8
							}
						]';
            }
            ?>
        } );
        /* End datatable settings */

        var location = <?php echo "'" . RequestUri::getRequestUrl() . "'"; ?>;
        const tbody = $('#statistic-grid tbody');
        tbody.on( 'click', 'a.editFile', function () {
            let data = dataTable.row( $(this).parents('tr') ).data();
            window.location.href = "EditUserList?ref=" + data[9] + "&token=" + data[10] + "&ap=" + data[11];
        } );
        tbody.on( 'click', 'a.deleteFile', function () {
            let data = dataTable.row( $(this).parents('tr') ).data();
            deleteUser(data[9], data[11], location);
        } );

        let idForm = $("#formAddUser");
        idForm.on('click', 'button#submit', function() {
            idForm.parsley().validate();
            if ( idForm.parsley().isValid() ) {
                addRow(idForm, location);
            }
        });

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

<?php include_once Theme::get_template_directory() . '/form/formAddUser.php'; ?>
<?php include_once Theme::get_template_directory() . '/below.php'; ?>
