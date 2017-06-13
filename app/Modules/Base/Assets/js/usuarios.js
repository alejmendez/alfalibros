var aplicacion, $form, tabla = false, to, $arbol;

$(function() {
	aplicacion = new app("formulario", {
		'antes' : function(accion){
			if (accion !== 'guardar') return;

			$("#permisos", $form).val(data_arbol());
		},
		'limpiar' : function(){
			$arbol.uncheck_all();
			tabla.ajax.reload();

			$("#foto").prop("src", imagenDefault);
			$('#usuario').prop('readonly', false);
		},
		'buscar' : function(r){
			$arbol.uncheck_all();
			$("#foto").prop("src", r.foto);
			$('#usuario').prop('readonly', true);
			var $estructura = $arbol.get_json('#', {flat : true});

			for(var i in $estructura){
				var estructura = $estructura[i].li_attr['data-direccion'];
				
				if ($estructura[i].icon == "fa fa-folder-o" || 
					estructura.substring(0, 1) == '#' || 
					r.permisos.indexOf(estructura) === -1){
					continue;
				}

				$arbol.check_node($estructura[i].id);
			}
		}
	});

	$("#upload_link").on('click', function(e){
	    e.preventDefault();
	    $("#upload:hidden").trigger('click');
	});

	$form = aplicacion.form;

	arbol();

	$("#dni", $form).numeric({ min : 0 });
	$("#telefono", $form).mask("0999-999-9999");

	$('#input_buscar').keyup(function () {
		if(to) { clearTimeout(to); }
		to = setTimeout(function () {
			$arbol.search($('#input_buscar').val());
		}, 250);
	});

	tabla = datatable('#tabla', {
		ajax: $url + "datatable",
		columns: [
			{ data: 'usuario', name: 'usuario' },
			{ data: 'dni', name: 'dni' },
			{ data: 'nombre', name: 'nombre' }
		]
	});
	
	$('#tabla').on("click", "tbody tr", function(){
		aplicacion.buscar(this.id);
	});
});

function data_arbol(){
	var $estructura = $arbol.get_json('#', {flat : true}),
	$seleccionados = $arbol.get_checked(),
	$data = [],
	direccion = '';

	$('.jstree-checkbox.jstree-undetermined', '#arbol').each(function(){
		var id = $(this).parent().parent().attr('id');

		if (id == '#'){
			return;
		}

		$seleccionados.push(id);
	});

	for(var i in $estructura){
		if ($seleccionados.indexOf($estructura[i].id) === -1){
			continue;
		}

		direccion = $estructura[i].li_attr['data-direccion'];

		if (direccion != '#' && $data.indexOf(direccion) === -1){
			$data.push(direccion);
		}
	}

	return $data;
}

function arbol(){
	$.ajax({
		url : $url + 'arbol',
		success : function(r){
			$('#arbol')
			.html('')
			.jstree('destroy')
			.on('changed.jstree', function (e, data) {
				$("#padre").val(data.instance.get_node(data.selected[0]).id);
				//aplicacion.id = data.instance.get_node(data.selected[0]).id;
			})

			.jstree({
				'core' : {
					//"animation" : 0,
					"check_callback" : true,
					"themes" : { "stripes" : true },
					'force_text' : true,
					"multiple" : true,
					'data' : r
				},
				"types" : {
					"default" : {
						"icon" : "fa fa-folder-o",
						"valid_children" : ["default","file"]
					},
					"todo" : {
						"icon" : "fa fa-sitemap",
						"valid_children" : []
					},
					"arch" : {
						"icon" : "fa fa-file-text-o",
						"valid_children" : []
					},
					"metodo" : {
						"icon" : "fa fa-gears",
						"valid_children" : []
					}
				},
				"redraw_node": function(nodes){
					console.log(nodes);
				},
				"checkbox" : {
					//"keep_selected_style" : false
				},
				"plugins" : [
					"search", "checkbox", "types"
				]
			});
			
			$arbol = $('#arbol').jstree(true);
		}
	});
}