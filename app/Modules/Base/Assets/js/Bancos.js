var aplicacion, $form, tabla;
$(function() {
	aplicacion = new app('formulario', {
		'limpiar' : function(){
			tabla.fnDraw();
		}
	});

	$form = aplicacion.form;

	tabla = datatable('#tabla', {
		ajax: $url + "datatable",
		columns: [{"data":"banco","name":"banco"},{"data":"tipo_cuenta","name":"tipo_cuenta"},{"data":"cuenta","name":"cuenta"},{"data":"nombre","name":"nombre"},{"data":"cedula","name":"cedula"},{"data":"correo","name":"correo"}]
	});
	
	$('#tabla').on("click", "tbody tr", function(){
		aplicacion.buscar(this.id);
	});
});