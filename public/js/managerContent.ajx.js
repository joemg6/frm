
function addRow(idForm, location) {

	var url_location = location, id_form = idForm;
	var formData = new FormData(document.querySelector(id_form.selector));
	$.ajax({
		async: true,
		url: url_location,
		type: "POST",
		dataType: "html",
		data: formData,
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#submitButton").html('<button type="button" class="btn btn-primary" name="enviar">&nbsp;&nbsp;<img width="18" src="../public/images/ajax_loader.svg">&nbsp;&nbsp;</button>');
		}
	})
		.done(function(data) {
			let response = data;
			//console.log(response);
			$('#Agregar').modal('hide');
			$('#statistic-grid').DataTable().ajax.reload();
			if (response.length > 10) {
				$.notify("Registro No ingresado", {
					className: 'error'
				});
			} else {
				$.notify("Registro ingresado", {
					className: 'success'
				});
			}
		})
		.fail(function(data) {
			$.notify("Registro No ingresado", {
				className: 'error'
			});
		})
		.always(function(data) {
			$(id_form).trigger("reset");
			//$("input#fileSource.custom-file-input").siblings(".custom-file-label").removeClass("selected").html("Seleccionar Archivo");
			$("input#fileSource").siblings(".custom-file-label").removeClass("selected").html("Seleccionar Archivo");
			$("#submitButton").html('<button id="submit" type="button" class="btn btn-primary" name="enviar"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button>');
			console.log( "complete" );
		});
	return true;
}

function editRow(idForm, location) {

	var url_location = location, id_form = idForm;
	var formData = new FormData(document.querySelector(id_form.selector));

	$.ajax({
		async: true,
		url: url_location,
		type: "POST",
		dataType: "html",
		data: formData,
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#submitButton").html('<button type="button" class="btn btn-primary" name="enviar">&nbsp;&nbsp;<img width="18" src="../public/images/ajax_loader.svg">&nbsp;&nbsp;</button>');
		}
	})
		.done(function(data) {
			//console.log(data);
			window.location.href = url_location + '?msn=updated';
			$.notify("Registro ingresado", {
				className: 'success'
			});
		})
		.fail(function(data) {
			$.notify("Registro No ingresado", {
				className: 'error'
			});
		})
		.always(function(data) {
			console.log( "complete" );
		});
	return true;
}

function editRowAjx(idForm, location) {

	var url_location = location, id_form = idForm;
	var formData = new FormData(document.querySelector(id_form.selector));

	$.ajax({
		async: true,
		url: url_location,
		type: "POST",
		dataType: "html",
		data: formData,
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#submitButton").html('<button type="button" class="btn btn-primary" name="enviar">&nbsp;&nbsp;<img width="18" src="../public/images/ajax_loader.svg">&nbsp;&nbsp;</button>');
		}
	})
		.done(function(data) {
			//console.log(data);
			$('#Editar').modal('hide');
			$('#statistic-grid').DataTable().ajax.reload();
			$.notify("Registro Actualizado", {
				className: 'success'
			});
		})
		.fail(function(data) {
			$.notify("Registro No Actualizado", {
				className: 'error'
			});
		})
		.always(function(data) {
			$(id_form).trigger("reset");
			$("#submitButton").html('<button id="submit" type="button" class="btn btn-primary" name="enviar"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button>');
			console.log( "complete" );
		});
	return true;
}

function deleteRow(id, location) {

	var data_id = id;
	var url_location = location;

	if (confirm("Está seguro de eliminar: ")) {
		$.ajax({
			async: true,
			url: url_location,
			type: "POST",
			dataType: "html",
			data: { '_method': '_del', 'delId': data_id},
			contentType: "application/x-www-form-urlencoded",
			beforeSend: function(){
				$('#case_alert').fadeIn('slow', function () {
					$("#case_alert").html('<img src="../public/images/ajax_loader.gif">&nbsp;Eliminando...');
				});
			},
			timeout: 40000
		})
			.done(function(data) {
				$('#statistic-grid').DataTable().ajax.reload();
				$.notify("Se eliminó el Registro", {
					className: 'info'
				});
			})
			.fail(function(){
				$.notify("Registro No eliminado", {
					className: 'error'
				});
			})
			.always(function() {
				console.log( "complete" );
			});
	} else {
		return false;
	}
	return true;
}

function deleteUser(idUser, idAccess_profile, location) {

	var data_idUser = idUser;
	var data_idAccess_profile = idAccess_profile;
	var url_location = location;

	if (confirm("Está seguro de eliminar: ")) {
		$.ajax({
			async: true,
			url: url_location,
			type: "POST",
			dataType: "html",
			data: { '_method':'_del', 'delIdUser':data_idUser, 'delIdAccess_profile':data_idAccess_profile},
			contentType: "application/x-www-form-urlencoded",
			beforeSend: function(){
				$('#case_alert').fadeIn('slow', function () {
					$("#case_alert").html('<img src="../public/images/ajax_loader.gif">&nbsp;Eliminando...');
				});
			},
			timeout: 40000
		})
			.done(function(data) {
				//console.log(data);
				$('#statistic-grid').DataTable().ajax.reload();
				$.notify("Se eliminó el Registro", {
					className: 'info'
				});
			})
			.fail(function(){
				$.notify("Registro No eliminado", {
					className: 'error'
				});
			})
			.always(function() {
				console.log( "complete" );
			});
	} else {
		return false;
	}
	return true;
}