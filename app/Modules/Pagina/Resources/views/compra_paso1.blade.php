@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			@include('pagina::partials.pasos-compra')
			

			{!! Form::open(['id' => 'form-confirmar','url' => 'compra/facturacion']) !!}
				<div class="row">
					{!! Form::hidden('codigo', $compras->codigo) !!}
					<div class="form-group col-sm-6 col-xs-12">
						<label for="direccion_id">
							Dirección de envío: 
							<div class="btn-group direccion">
								<button type="button" class="btn btn-primary agregar" data-toggle="tooltip" title="Agregar Nueva Direcci&oacute;n" >
									<i class="fa fa-plus"></i>
									Agregar
								</button>
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="caret"></span>
									<span class="sr-only">Alternar desplegable</span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="#" class="agregar" title="Agregar Nueva Direcci&oacute;n" data-toggle="tooltip" >
											<i class="fa fa-plus"></i>
											Agregar
										</a>
									</li>
									<li>
										<a href="#" class="editar" title="Editar la Direcci&oacute;n Seleccionada" data-toggle="tooltip" >
											<i class="fa fa-pencil"></i>
											Editar
										</a>
									</li>
									<li>
										<a href="#" class="eliminar" title="Eliminar la Direcci&oacute;n Seleccionada" data-toggle="tooltip" >
											<i class="fa fa-remove"></i>
											Eliminar
										</a>
									</li>
								</ul>
							</div>
						</label>
						
						{!! Form::select('direccion_id', $controller->getCampo('direccion'), $compras->direccion_id, [
							'id'          => 'direccion_id',
							'required'    => true,
							'class'	      => 'form-control',
							'class_cont'  => 'col-sm-6'
						]) !!}
					</div>
					
					<div class="col-xs-12"></div>
					
					<div class="form-group col-sm-6 col-xs-12">
						<label for="metodo_envio_id">
							Método de Envío:
						</label>

						{!! Form::select('metodo_envio_id', $controller->getCampo('metodo_envio'), $compras->metodo_envio_id, [
							'id'          => 'metodo_envio_id',
							'placeholder' => '- Seleccione un método de envío',
							'required'    => true,
							'class'	      => 'form-control',
							'class_cont'  => 'col-sm-6'
						]) !!}
					</div>
				</div>

				<div class="row row-facturacion">
					<div class="col-xs-12">
						<h2 style="font-weight: bold;">Datos de Facturación</h2>
					</div>

					{!! Form::bsText('nombre', $compras->nombre != '' ? $compras->nombre  : $usuario->persona->full_name, [
						'label'       => 'Razon Social o Nombre del Cliente',
						'placeholder' => false,
						'required'    => true,
						'class_cont'  => 'col-sm-6'
					]) !!}
					
					<div class="col-xs-12"></div>

					<div class="form-group col-sm-6">
						<label for="cedula" class="requerido">C&eacute;dula o Rif</label>
						<input id="cedula" nombre="cedula" type="hidden" value="{{ strtoupper($compras->cedula) }}" />
						
						<div class="input-group">
							<div class="input-group-btn">
								<button id="nacionalidad" type="button" class="btn green dropdown-toggle" data-toggle="dropdown">
									<span>{{ strtoupper(substr($compras->cedula, 0, 1)) }}</span>
									<i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									@foreach(['V', 'E', 'J', 'G'] as $nacionalidad)
									<li>
										<a href="javascript:nacionalidad('{{ $nacionalidad }}');"> {{ $nacionalidad }} </a>
									</li>
									@endforeach
								</ul>
							</div>
							<input id="cedula_input" class="cedula form-control" 
								required type="text" value="{{ substr($compras->cedula, 1) }}" 
								data-toggle="tooltip"
								title="RIF/C.I del Cliente ejemplo: V15467845, J854575640, E8897547" />
						</div>
					</div>
					
					<div class="col-xs-12"></div>

					{!! Form::bsTextarea('direccion', $compras->direccion != '' ? $compras->direccion :  $usuario->persona->address_1, [
						'label'       => 'Dirección Fiscal',
						'placeholder' => false,
						'required'    => true,
						'rows'        => 3,
						'class_cont'  => 'col-sm-6'
					]) !!}

					<div class="form-group col-sm-12 text-right">
						<button id="btn_confirmar2" type="submit" class="btn btn-success btn-lg">
							Aceptar <i class="fa fa-chevron-right"></i>
						</button>
					</div>
				</div>
			{!! Form::close() !!}

		@else
			@include('pagina::partials.no-login')
		@endif
	</div>
</div>

<div id="nuevaDireccionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevaDireccionModalModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="nuevaDireccionModalModalLabel">Registrar Nueva Dirección.</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					{!! Form::open(['id' => 'form-nueva-direccion', 'url' => route('pag.usuarios.direccion.nuevo')]) !!}
						{!! Form::bsText('nombre_direccion', '', [
							'label'       => 'Nombre (Para uso personal)',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('persona_contacto', '', [
							'label'       => 'Persona de Contacto',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('persona_cedula', '', [
							'label'       => 'Cedula de al Persona de Contacto',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('telefono', '', [
							'label'       => 'Telefono',
							'placeholder' => false,
							'help'        => 'Telefono de Contacto',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						

						{!! Form::bsText('estado', '', [
							'label'       => 'Estado',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('municipio', '', [
							'label'       => 'Municipio',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('parroquia', '', [
							'label'       => 'Parroquia',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('sector', '', [
							'label'       => 'Sector',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						
						{!! Form::bsText('ciudad', '', [
							'label'       => 'Ciudad',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('codigo_postal', '', [
							'label'       => 'Código Postal',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						
						{!! Form::bsTextarea('direccion', $usuario->persona->address_1, [
							'label'       => 'Dirección de Envio',
							'placeholder' => false,
							'help'        => 'Dirección de Envio',
							'required'    => true,
							'rows'        => 3,
							'class_cont'  => 'col-sm-12'
						]) !!}
						
						{!! Form::bsText('punto_referencia', '', [
							'label'       => 'Punto de Referencia',
							'placeholder' => false,
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

					{!! Form::close() !!}
				</div>
			</div>
			<div class="modal-footer">
				<button id="btn_guardar" type="submit" class="btn btn-primary">
					Guardar <i class="fa fa-save"></i>
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>



@endsection

@push('js')
<style type="text/css">
.row-facturacion {
	display: none;
}
.portlet {
	margin-top: 0;
	margin-bottom: 0px;
	padding: 0;
	border-radius: 4px;
}
.mt-step-col a{
	text-decoration: none;
	color: #000;
}
</style>
@endpush
@push('js')
<script type="text/javascript">
	var direccion = $('#direccion_id').val(),
		rutaDireccion = '{{ route('pag.usuarios.direccion.nuevo') }}';

	$.mask.definitions['R']='[JGVEjgve]';
	$(".cedula").mask("999999?999");

	$('#cedula_input').on('blur',function(){
		 nacionalidad($("#nacionalidad span").text());
	});

	if( !direccion ){
		$('#cotizacion').remove();
	}

	var $url_paso_2 = "{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 2 ]) }}";
	
	showRowFacturacion();
	
	$("#direccion_id").change(function(){
		showRowFacturacion();

		$.ajax(rutaDireccion + '/' + $("#direccion_id").val(), {
			method:'get',
			success : function(r) {
				if (typeof(r) === 'string'){
					aviso(r);
					return false;
				}

				if (r.persona_contacto != ''){
					$("#nombre").val(r.persona_contacto);
				}

				if (r.persona_cedula != ''){
					$("#cedula_input").val(r.persona_cedula);
				}

				var dir = [
					r.direccion,
					r.parroquia,
					r.municipio,
					r.estado,
				].join(", ").replace(/, +/g, ", ");
				
				if (dir != ''){
					$("#direccion").val(dir);
				}
			}
		});
	});

	$("#metodo_envio_id").change(function(){
		showRowFacturacion();
	});

	$('#form-confirmar').submit(function() { 
		// submit the form 
		$("#btn_confirmar2").prop('disabled', true);
		$(this).ajaxSubmit({
			error : function() {
				$("#btn_confirmar2").prop('disabled', false);
			},
			success : function(r) {
				location.href = $url_paso_2;
				
				/*
				setTimeout(function(){
					location.href = $url_paso_2;
				}, 3000);
				*/

			}
		}); 
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});

	$('#btn_guardar').click(function() { 
		var id = $("#direccion_id").val();
		
		var $opciones = {
			'url' : $('#form-nueva-direccion').attr('action'),
			'type' : 'POST',
			'success': function(r){
				aviso(r);
				if(r.s == 'n'){
					return;
				}

				$("#nuevaDireccionModal").modal('hide');
				if (id > 0){
					$('#direccion_id option[value=\'' + r.id + '\']').html(r.nombre);
				} else {
					$('#direccion_id').append('<option value=' + r.id + '>' + r.nombre + '</option>');
					$('#direccion_id').val(r.id);
				}
			}
		};

		if (id > 0){
			$opciones.url = $opciones.url + '/' + id;
			$opciones.data = {
				'_method': 'put'
			};
		}

		$('#form-nueva-direccion').ajaxSubmit($opciones);

		return false; 
	});

	$('.agregar').click(function(e){
		e.preventDefault();
		$("#nuevaDireccionModal").modal('show');
		$("#form-nueva-direccion").get(0).reset();
	});

	$('.editar').click(function(e){
		e.preventDefault();
		var direccion = $("#direccion_id").val();
		
		if (direccion == null || direccion == '') {
			return;
		}

		$("#nuevaDireccionModal").modal('show');
		$("#form-nueva-direccion").get(0).reset();

		buscarDireccion(direccion);
	});
	
	$('.eliminar').click(function(e){
		e.preventDefault();
		var direccion = $("#direccion_id").val();
		
		if (direccion == null || direccion == '') {
			return;
		}

		bootbox.confirm("&iquest;Esta seguro que desea eliminar esta dirección?", function(result) {
			if (!result){
				return true;
			}

			$.ajax({
				'url' : rutaDireccion + '/' + direccion,
				'data' : {
					'_method': 'delete'
				},
				'type' : 'POST',
				'success' : function(r){
					aviso(r);
					$('#direccion_id option[value=\'' + direccion + '\']').remove();
				}
			});
		});
	});

	function nacionalidad(nac){
		nac = nac || $("#nacionalidad span").text();
		$("#nacionalidad span").text(nac);
		$("#cedula").val(nac + $("#cedula_input").val());
	}

	function showRowFacturacion() {
		var direccion = $("#direccion_id").val(),
		    metodo_envio = $("#metodo_envio_id").val();
		
		console.log(direccion, metodo_envio);

		if (!(direccion == null || direccion == '') &&
			!(metodo_envio == null || metodo_envio == '')) {
			$('.row-facturacion').show();
		} else {
			$('.row-facturacion').hide();
		}
	}

	function buscarDireccion(id) {
		$.ajax(rutaDireccion + '/' + id, {
			method:'get',
			success : function(r) {
				if (typeof(r) === 'string'){
					aviso(r);
					return false;
				}

				aviso(r.msj, 'info', 'Busqueda');

				$.each(r, function(id, valor){
					var ele = $('#' + id, "#form-nueva-direccion");

					if (!ele.length){ return; }

					ele.val(valor);
				});
			}
		});
	}
</script>
@endpush