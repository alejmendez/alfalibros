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
						<div class="form-group col-xs-12">
							<label for="direccion_id">
								Dirección de envío: 
								<i class="fa fa-plus" data-ele="direccion_id" data-toggle="modal" data-target="#nuevaDireccionModal" title="Registrar una Dirección">&nbsp; Agregar</i>
							</label>

							{!! Form::select('direccion_id', $usuario->direcciones->pluck('nombre_direccion', 'id'), $compras->direccion_id, [
								'id'	=> 'direccion_id',
								'placeholder' => '- Seleccione una direccion de envío',
								'required'    => true,
								'class'	=> 'form-control'
							]) !!}
							

						</div>
						
						<div class="form-group col-xs-12">
							<label for="metodo_envio_id">
								Método de Envío:
							</label>

							{!! Form::select('metodo_envio_id', $controller->metodoEnvio(), $compras->metodo_envio_id, [
								'id'	=> 'metodo_envio_id',
								'placeholder' => '- Seleccione un método de envío',
								'required'    => true,
								'class'	=> 'form-control'
							]) !!}
							

						</div>
	
					
				</div>

				<div class="row">
					<div class="col-xs-12">
						<h4>Datos de Facturación</h4>
					</div>

					{!! Form::bsText('nombre', $compras->nombre != '' ? $compras->nombre  : $usuario->persona->full_name, [
						'label'       => 'Razon Social',
						'placeholder' => 'Razon Social o Nombre',
						'help'        => 'Razon Social o Nombre del Cliente',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}
					
					<div class="form-group col-sm-12">
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
							<input class="cedula form-control" placeholder="RIF/C.I" required id="cedula_input" type="text" value="{{ substr($compras->cedula, 1) }}">
						</div>
						<!-- /btn-group -->
						
						<span class="help-block">RIF/C.I del Cliente ejemplo: V15467845, J854575640, E8897547</span>
					</div>
					
		
					{!! Form::bsTextarea('direccion', $compras->direccion != '' ? $compras->direccion :  $usuario->persona->address_1, [
						'label'       => 'Dirección Fiscal',
						'placeholder' => 'Dirección Fiscal',
						'help'        => 'Dirección Fiscal',
						'required'    => true,
						'rows'        => 3,
						'class_cont'  => 'col-sm-12'
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
					
					{!! Form::open(['id' => 'form-nva-direccion', 'url' => 'usuarios/direccion/nuevo']) !!}


						{!! Form::bsText('nombre', '', [
							'label'       => 'Nombre (Para uso personal)',
							'placeholder' => 'Nombre ',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('persona_contacto', $usuario->persona->full_name, [
							'label'       => 'Persona de Contacto',
							'placeholder' => 'Persona  contacto',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('telefono', $usuario->persona->phone_number, [
							'label'       => 'Telefono',
							'placeholder' => 'Telefono',
							'help'        => 'Telefono de Contacto',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						

						{!! Form::bsText('estado', '', [
							'label'       => 'Estado',
							'placeholder' => 'Estado',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						
						{!! Form::bsText('ciudad', '', [
							'label'       => 'Ciudad',
							'placeholder' => 'Ciudad',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}

						{!! Form::bsText('codigo_postal', '', [
							'label'       => 'Código Postal',
							'placeholder' => 'Código Postal',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						
						{!! Form::bsTextarea('direccion', $usuario->persona->address_1, [
							'label'       => 'Dirección de Envio',
							'placeholder' => 'Dirección de Envio',
							'help'        => 'Dirección de Envio',
							'required'    => true,
							'rows'        => 3,
							'class_cont'  => 'col-sm-12'
						]) !!}
						
						{!! Form::bsText('punto_ref', '', [
							'label'       => 'Punto de Referencia',
							'placeholder' => 'Punto de Referencia',
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
		label .fa-plus {
		    color: #70BF2B;
		    cursor: pointer;
		}
	</style>
@endpush
@push('js')
<script type="text/javascript">
var direccion = $('#direccion_id').val();
	$.mask.definitions['R']='[JGVEjgve]';
	$(".cedula").mask("999999?999");
	$('#cedula_input').on('blur',function(){
		 nacionalidad($("#nacionalidad span").text());
	});
	if( !direccion ){
		$('#cotizacion').remove();
	}

	$("#datosBancosModal").modal();
	var $url_paso_2 = "{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 2 ]) }}";

	$('#form-confirmar').submit(function() { 
		// submit the form 
		$(this).ajaxSubmit({
			success : function(r){
				
				setTimeout(function(){
					location.href = $url_paso_2;
				}, 3000);

			}
		}); 
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});

	$('#btn_guardar').click(function() { 
		
		// submit the form 
		$('#form-nva-direccion').ajaxSubmit({
			success : function(r){
				if(r.s == 's'){
					$("#nuevaDireccionModal").modal('hide');
					$('#direccion_id').append('<option value=' + r.id + '>' + r.nombre + '</option>');
					$('#direccion_id').val(r.id);
				}else{
					alert(r.msj);
					return false;
				}
			}
		});
		
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});

	function nacionalidad(nac){
		nac = nac || $("#nacionalidad span").text();
		$("#nacionalidad span").text(nac);
		$("#cedula").val(nac + $("#cedula_input").val());
	}
</script>
@endpush