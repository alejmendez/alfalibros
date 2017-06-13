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
								Seleccione Dirección: 
								<i class="fa fa-plus" data-ele="direccion_id" data-toggle="modal" data-target="#nuevaDireccionModal" title="Registrar una Dirección">&nbsp; Agregar</i>
							</label>

							{!! Form::select('direccion_id', $usuario->direcciones->pluck('nombre_direccion', 'id'), $compras->direccion_id, [
								'id'	=> 'direccion_id',
								'placeholder' => '- Seleccione una direccion',
								'required'    => true,
								'class'	=> 'form-control'
							]) !!}
							

						</div>


						
						<!--

						<div class="form-group col-sm-12 text-right">
							<button id="btn_confirmar" type="submit" class="btn btn-success btn-lg">
								Confirmar <i class="fa fa-thumbs-up"></i>
							</button>
						</div>-->
					
				</div>

				<div class="row">
					<div class="col-xs-12">
						<h4>Datos de Facturación</h4>
					</div>
					@if($compras->nombre != '')
						{!! Form::bsText('nombre', $compras->nombre , [
							'label'       => 'Nombre',
							'placeholder' => 'Razon Social o Nombre',
							'help'        => 'Razon Social o Nombre del Cliente',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
					@else
						{!! Form::bsText('nombre', $usuario->persona->full_name, [
							'label'       => 'Nombre',
							'placeholder' => 'Razon Social o Nombre',
							'help'        => 'Razon Social o Nombre del Cliente',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
					@endif


					@if($compras->cedula != '')
						{!! Form::bsText('cedula', $compras->cedula, [
							'label'       => 'Cédula',
							'placeholder' => 'RIF/C.I',
							'help'        => 'RIF/C.I del Cliente',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
					@else
						{!! Form::bsText('cedula', $usuario->persona->cliente->account_number, [
							'label'       => 'Cédula',
							'placeholder' => 'RIF/C.I',
							'help'        => 'RIF/C.I del Cliente',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
					@endif
					

					
					@if($compras->direccion != '')
						{!! Form::bsTextarea('direccion', $compras->direccion, [
							'label'       => 'Dirección Fiscal',
							'placeholder' => 'Dirección Fiscal',
							'help'        => 'Dirección Fiscal',
							'required'    => true,
							'rows'        => 3,
							'class_cont'  => 'col-sm-12'
						]) !!}
					@else
						{!! Form::bsTextarea('direccion', $usuario->persona->address_1, [
							'label'       => 'Dirección Fiscal',
							'placeholder' => 'Dirección Fiscal',
							'help'        => 'Dirección Fiscal',
							'required'    => true,
							'rows'        => 3,
							'class_cont'  => 'col-sm-12'
						]) !!}
					@endif

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
							'label'       => 'Nombre de Dirección',
							'placeholder' => 'Nombre de Dirección',
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
				}else{
					alert(r.msj);
					return false;
				}
			}
		});
		
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});

	
</script>
@endpush