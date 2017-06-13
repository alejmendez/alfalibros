var aplicacion, $form, tabla;
$(function() {
	aplicacion = new app('formulario', {
		'buscar' : function(r) {
			$("#aprobado").bootstrapSwitch('state', r.aprobado, true);
		},
		'limpiar' : function(){
			$("#aprobado").bootstrapSwitch('state', false, true);
			tabla.ajax.reload();
		}
	});

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