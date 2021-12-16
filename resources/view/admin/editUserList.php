<?php

if ( 
	!in_array("admin", $_SESSION['modulo'] ) ) {
		header("location: ../");
}

require_once "class/Theme.php";
Theme::get_head_admin_profile();

global $txt;

?>

<link id="bsdp-css" href="<?php echo Theme::get_public_directory(); ?>/js/datepicker/datetimepicker.css" rel="stylesheet">

<!-- page content -->
<div class="right_col" role="main">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Editar registro de Usuario</h2>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">

      <form id="editFormUser" class="form-horizontal form-label-left" data-parsley-validate method="POST">

        <p>&nbsp;</p>

		<input type="hidden" name="_method" value="_edit">
		<input type="hidden" name="ref" value="<?php echo \NumHash::decrypt($_GET['ref']); ?>">
		<input type="hidden" name="old_password" value="<?= $dataUserList["passUsuario"]; ?>">		
		<input type="hidden" name="idAccess_profile" value="<?= $dataUserList["idAccess_profile"]; ?>">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="nickname">Nickname <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="nickname" name="nickname" data-parsley-required-message="Ingrese el Nickname" required="required" value="<?= $dataUserList["loginUsuario"]; ?>">
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="passUsuario">Contraseña <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" class="form-control" id="passUsuario" name="passUsuario" value="<?= $dataUserList["passUsuario"]; ?>">
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="nombre">Nombre <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="nombre" name="nombre" data-parsley-required-message="Ingrese el Nombre" required="required" value="<?= $dataUserList["nombre"]; ?>">
          </div>
        </div>		

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="aPaterno">Apellido paterno <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="aPaterno" name="aPaterno" data-parsley-required-message="Ingrese el Apellido paterno" required="required" value="<?= $dataUserList["aPaterno"]; ?>">
          </div>
        </div>			

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="aMaterno">Apellido materno <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="aMaterno" name="aMaterno" data-parsley-required-message="Ingrese el Apellido materno" required="required" value="<?= $dataUserList["aMaterno"]; ?>">
          </div>
        </div>		

        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="dni">DNI <span class="required">*</span></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="number" class="form-control" id="dni" name="dni" data-parsley-required-message="Ingrese el DNI" required="required" value="<?= $dataUserList["dni"]; ?>">
			</div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="direccion">Dirección <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="direccion" name="direccion" data-parsley-required-message="Ingrese la Dirección" required="required" value="<?= $dataUserList["direccion"]; ?>">
          </div>
        </div>	

        <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="telefono">Teléfono </label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" class="form-control" id="telefono" name="telefono" value="<?= $dataUserList["telefono"]; ?>">
			</div>
        </div>
		
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="correo">Correo <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="correo" name="correo" data-parsley-required-message="Ingrese el correo" required="required" value="<?= $dataUserList["correo"]; ?>">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="modulo">Módulo <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="modulo" id="modulo" data-parsley-required-message="Ingrese el Módulo" required="required">
				<option value="<?= $dataUserList["idModulo"]; ?>"><?= $dataUserList["nombreModulo"]; ?></option>
				<?php
				foreach ( $modulo as $value => $name) {
					echo "<option value=\"{$value}\">{$name}</option>";
				}
				?>
			</select>
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="tipoUsuario">Tipo de Usuario <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="tipoUsuario" id="tipoUsuario" data-parsley-required-message="Ingrese el Tipo de usuario" required="required">
				<option value="<?= $dataUserList["idTipo_usuario"]; ?>"><?= $dataUserList["tipoUsuario"]; ?></option>
				<?php
				foreach ( $tipoUsuario as $value => $name) {
					echo "<option value=\"{$value}\">". ucfirst($name) . "</option>";
				}
				?>
			</select>
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="typeProfile">Perfil de Acceso <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="typeProfile" id="typeProfile" data-parsley-required-message="Ingrese el Tipo de Perfil" required="required">
				<option value="<?= $dataUserList["typeProfile"]; ?>"><?= ucfirst($dataUserList["typeProfile"]); ?></option>
				<option value="user">Usuario</option>
				<option value="admin">Admin</option>
			</select>
          </div>
        </div>	

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 label-align" for="estado">Estado <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" name="estado" id="estado" data-parsley-required-message="Ingrese el estado" required="required">
				<option value="<?= $dataUserList["estado"]; ?>"><?php 
				if ($dataUserList["estado"] == 1) $estado = "Activo";
				else $estado = "Desactivado";
				echo $estado ?></option>
				<option value="1">Activo</option>
				<option value="0">Desactivado</option>
			</select>
          </div>
        </div>	

        <div class="ln_solid"></div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
		    <div id="submitButton" class="d-inline-block"><button id="submit" type="button" class="btn btn-primary" name="enviar"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button></div>&nbsp;	 		  
            <a href="UserList"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button></a>
          </div>
        </div>

        <div class="modal-body"></div>
      </form>

			</div>

		</div>
	</div>
  
</div>
<!-- /page content -->

<script type="text/javascript" language="javascript" src="<?php echo Theme::get_public_directory(); ?>/js/jquery-2.2.4.min"></script>
<script type="text/javascript" language="javascript" src="<?php echo Theme::get_public_directory(); ?>/js/notify.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Theme::get_public_directory(); ?>/js/managerContent.ajx.js"></script>


<!-- Parsley -->
<script src="<?php echo Theme::get_public_directory(); ?>/js/validate/parsley.min.js"></script>

<script type="text/javascript">
	$().ready( ()=>{

		let idForm = $("#editFormUser");	
		idForm.on('click', 'button#submit', function() {				
			idForm.parsley().validate();
			if ( idForm.parsley().isValid() ) {			
				editRow(idForm, "UserList");						
			}	
		});	
	});
</script>
	
<?php include_once Theme::get_template_directory() . '/below.php'; ?>
