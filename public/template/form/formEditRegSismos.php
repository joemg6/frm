
<link id="bsdp-css" href="<?php echo Theme::get_public_directory(); ?>/js/datepicker/datetimepicker.css" rel="stylesheet">

<!-- Modal -->
<div id="Editar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <h2 style="font-size:14px;" class="modal-title">Editar registro de Reportes - Sismos</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formEditSismos" class="form-horizontal form-label-left" data-parsley-validate enctype="multipart/form-data" method="POST">

        <p>&nbsp;</p>

		<input type="hidden" name="_method" value="_edit">
		<input type="hidden" id="e_ref" name="e_ref" value="">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">


        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="e_magnitud">Magnitud <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" style="text-transform: uppercase;" class="form-control" id="e_magnitud" name="e_magnitud" data-parsley-required-message="Ingrese la Magnitud" required="required" value="">
          </div>
        </div>	
	
        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="e_referencia">Referencia <span class="required">*</span></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<textarea type="text" class="form-control" id="e_referencia" name="e_referencia" data-parsley-required-message="Ingrese la Referencia" required="required" rows="4"></textarea>
			</div>
        </div>

        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="e_profundidad">Profundidad <span class="required">*</span></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="number" class="form-control" id="e_profundidad" name="e_profundidad" data-parsley-required-message="Ingrese la Profundidad" required="required" value="">
			</div>
        </div>

        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="e_intensidad">Intensidad</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" class="form-control" id="e_intensidad" name="e_intensidad"  value="">
			</div>
        </div>

		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="e_fecha">Fecha <span class="required">*</span></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
					<div class="input-group-addon"><i style="font-size:18px; padding-top:3px;" class="fa fa-calendar" aria-hidden="true"></i></div>
					<input type="text" class="form-control" id="datetimepickerEdit" name="e_fecha" data-parsley-required-message="Ingrese la fecha" required="required" value="<?= date("d-m-Y h:m"); ?>">
				</div>
			</div>
		</div>
		
        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="e_coordenadas">Coordenadas <span class="required">*</span></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" class="form-control" id="e_coordenadas" name="e_coordenadas" data-parsley-required-message="Ingrese las coordenadas" required="required" value="">
			</div>
        </div>
									
        <div class="ln_solid"></div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12 pr-0">
		    <div id="submitButton" class="d-inline-block"><button id="submit" type="button" class="btn btn-primary" name="enviar"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button></div>&nbsp;		  
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>	  
          </div>
        </div>

		<div class="modal-body"></div>
      </form>

    </div>
    <!-- /Modal content-->
  </div>
</div>
<!-- /Modal -->

<!-- Datepicker -->
<script src="<?php echo Theme::get_public_directory(); ?>/js/moment/moment.2.21.0.min.js" type="text/javascript"></script>
<script src="<?php echo Theme::get_public_directory(); ?>/js/datepicker/datetimepicker.js"></script>
<script src="<?php echo Theme::get_public_directory(); ?>/js/datepicker/datetimepicker.es.js"></script>

<!-- Parsley -->
<script src="<?php echo Theme::get_public_directory(); ?>/js/validate/parsley.min.js"></script>

	<script type="text/javascript">
		$(function () {
			$('#datetimepickerEdit').datetimepicker({
				locale: 'es',
				format:'DD-MM-YYYY HH:mm',
				defaultDate: new Date()					
			});
		});
	</script>


	