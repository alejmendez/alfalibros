var aplicacion, $form, tabla;
$(function() {
	aplicacion = new app('formulario', {
		'antes' : function (){
			$('#metodo_envio_id').prop('disabled', false);
		},
		'buscar' : function(r) {
			$("#aprobado").bootstrapSwitch('state', r.aprobado, true);
			var path_img = 
			$('#img-comprobante').prop('href', r.url_comprobante).show();
			$('#persona_contacto').prop('readonly', true);
			$('#telefono_contacto').prop('readonly', true);
			$('#estado').prop('readonly', true);
			$('#ciudad').prop('readonly', true);
			$('#direccion_envio').prop('readonly', true);
			$('#nombre').prop('readonly', true);
			$('#cedula').prop('readonly', true);
			$('#telefono').prop('readonly', true);
			$('#correo').prop('readonly', true);
			$('#direccion').prop('readonly', true);
			$('#nota').prop('readonly', true);
			$('#codigo_transferencia').prop('readonly', true);
			$('#banco_usuario').prop('readonly', true);
			$('#monto').prop('readonly', true);
			$('#punto_referencia').prop('readonly', true);
			$('#metodo_envio_id').prop('disabled', true);

			
		},
		'limpiar' : function(){
			$("#aprobado").bootstrapSwitch('state', false, true);
			tabla.ajax.reload();
			$('#img-comprobante').prop('href', '#').hide();
			
			$('#punto_referencia').prop('readonly', false);
			$('#persona_contacto').prop('readonly', false);
			$('#telefono').prop('readonly', false);
			$('#estado').prop('readonly', false);
			$('#ciudad').prop('readonly', false);
			$('#direccion_envio').prop('readonly', false);
			$('#nombre').prop('readonly', false);
			$('#cedula').prop('readonly', false);
			$('#telefono').prop('readonly', false);
			$('#correo').prop('readonly', false);
			$('#direccion').prop('readonly', false);
			$('#nota').prop('readonly', false);
			$('#codigo_transferencia').prop('readonly', false);
			$('#banco_usuario').prop('readonly', false);
			$('#monto').prop('readonly', false);
		}
	});

	$('#img-comprobante').prop('href', '#').hide();
	$("#aprobado").bootstrapSwitch('state', false, true);
	
	$form = aplicacion.form;

	tabla = datatable('#tabla', {
		ajax: $url + "datatable",
		columns: [
			{"data":"sale_id","name":"sale_id"},
			{"data":"nombre","name":"nombre"},
			{"data":"cedula","name":"cedula"},
			{"data":"codigo_transferencia","name":"codigo_transferencia"},
			{"data":"banco_usuario","name":"banco_usuario"},
			{"data":"monto","name":"monto"}
		]
	});
	
	$('#tabla').on("click", "tbody tr", function(){
		aplicacion.buscar(this.id);
	});
});