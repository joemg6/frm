<link id="bsdp-css" href="<?php echo Theme::get_public_directory(); ?>/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<!-- Modal -->
<div id="Agregar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Nuevo registro de Autoridad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formAddUser" class="form-horizontal form-label-left" data-parsley-validate method="POST">

        <p>&nbsp;</p>

		<input type="hidden" name="_method" value="_add">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="nickname">Nickname <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="nickname" name="nickname" data-parsley-required-message="Ingrese el Nickname" required="required" value="">
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="passUsuario">Contraseña <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" class="form-control" id="passUsuario" name="passUsuario" data-parsley-required-message="Ingrese el Nombre" required="required" value="">
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="nombre">Nombre <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="nombre" name="nombre" data-parsley-required-message="Ingrese el Nombre" required="required" value="">
          </div>
        </div>		

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="aPaterno">Ap. paterno <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="aPaterno" name="aPaterno" data-parsley-required-message="Ingrese el Apellido paterno" required="required" value="">
          </div>
        </div>			

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="aMaterno">Ap. materno <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="aMaterno" name="aMaterno" data-parsley-required-message="Ingrese el Apellido materno" required="required" value="">
          </div>
        </div>		

        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="dni">DNI <span class="required">*</span></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="number" class="form-control" id="dni" name="dni" data-parsley-required-message="Ingrese el DNI" required="required" value="">
			</div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="direccion">Dirección <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="direccion" name="direccion" data-parsley-required-message="Ingrese la Dirección" required="required" value="">
          </div>
        </div>	

        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="telefono">Teléfono </label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" class="form-control" id="telefono" name="telefono" data-parsley-required-message="Ingrese el Teléfono" required="required" value="">
			</div>
        </div>
		
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="correo">Correo <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="correo" name="correo" data-parsley-required-message="Ingrese el correo" required="required" value="">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="modulo">Módulo <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="modulo" id="modulo" data-parsley-required-message="Ingrese el Módulo" required="required">
				<option value=""></option>
				<?php
				foreach ( $modulo as $value => $name) {
					echo "<option value=\"{$value}\">{$name}</option>";
				}
				?>
			</select>
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="tipoUsuario">T. Usuario <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="tipoUsuario" id="tipoUsuario" data-parsley-required-message="Ingrese el Tipo de usuario" required="required">
				<option value=""></option>
				<?php
				foreach ( $tipoUsuario as $value => $name) {
					echo "<option value=\"{$value}\">". ucfirst($name) . "</option>";
				}
				?>
			</select>
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="typeProfile">P. Acceso <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="typeProfile" id="typeProfile" data-parsley-required-message="Ingrese el Tipo de Perfil" required="required">
				<option value=""></option>
				<option value="user">Usuario</option>
				<option value="admin">Admin</option>
			</select>
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

<script src="<?php echo Theme::get_public_directory(); ?>/js/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo Theme::get_public_directory(); ?>/js/datepicker/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

<!-- Parsley -->
<script src="<?php echo Theme::get_public_directory(); ?>/js/validate/parsley.min.js"></script>

<script>
$('#fechaIngreso').datepicker({
	language: 'es',
    format: 'dd-mm-yyyy'
});
</script>