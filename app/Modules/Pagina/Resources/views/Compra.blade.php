@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			<h3>Confirmaci&oacute;n de Compra</h3>
			
			<button id="btn-datosBancosModal" type="button" class="btn btn-info" data-dismiss="modal" style="float: right;" data-toggle="modal" data-target="#datosBancosModal">
				<i class="fa fa-info" aria-hidden="true"></i>
				Informaci&oacute;n de Pago
			</button>

			<div class="row">
				<h4 class="col-sm-12">Datos Personales</h4>
				{!! Form::open(['id' => 'form-confirmar']) !!}
					{!! Form::hidden('codigo', $compra->codigo) !!}

					{!! Form::bsText('nombre', $usuario->persona->full_name, [
						'label'       => 'Nombre',
						'placeholder' => 'Razon Social o Nombre',
						'help'        => 'Razon Social o Nombre del Cliente',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}

					{!! Form::bsText('cedula', $usuario->persona->cliente->account_number, [
						'label'       => 'Cédula',
						'placeholder' => 'RIF/C.I',
						'help'        => 'RIF/C.I del Cliente',
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

					{!! Form::bsText('correo', $usuario->persona->email, [
						'label'       => 'Correo Electronico',
						'placeholder' => 'Correo Electronico',
						'help'        => 'Correo Electronico',
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

					<h4 class="col-sm-12">Datos Bancarios</h4>

					{!! Form::bsText('banco_usuario', '', [
						'label'       => 'Banco del cliente',
						'placeholder' => 'Banco del cliente',
						'help'        => 'Nombre del Banco del CLiente',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}

					{!! Form::bsText('codigo_transferencia', '', [
						'label'       => 'Codigo de transferencia',
						'placeholder' => 'Codigo de transferencia',
						'help'        => 'Codigo del comprobante de transferencia',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}

					{!! Form::bsText('monto', $compra->monto, [
						'label'       => 'Monto',
						'placeholder' => 'Monto de la transferencia',
						'help'        => 'Monto de la transferencia en Bs',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}

					{!! Form::bsSelect('bancos_id', $controller->bancos(), '', [
						'label'       => 'Banco Receptor',
						'placeholder' => '- Seleccione un Banco',
						'help'        => 'Seleccione el banco al cual realizó la transferencia',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}
					
					<div class="form-group col-sm-12">
					    <label for="monto" class="requerido">Imagen del comprobante</label>
				        {!! Form::file('image') !!}

				        <span class="help-block">La imagen puede ser .pdf, .jpeg, .jpg &oacute; .png</span>
				    </div>

					{!! Form::bsTextarea('nota', '', [
						'label'       => 'Nota Adicional',
						'placeholder' => 'Nota Adicional',
						'help'        => 'Nota Adicional',
						'rows'        => 3,
						'class_cont'  => 'col-sm-12'
					]) !!}

					<div class="form-group col-sm-12 text-right">
						<button id="btn_confirmar" type="submit" class="btn btn-success btn-lg">
							Confirmar <i class="fa fa-thumbs-up"></i>
						</button>
					</div>
				{!! Form::close() !!}
			</div>
		@else
			@include('pagina::partials.no-login')
		@endif
	</div>
</div>

<div id="datosBancosModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="datosBancosModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="datosBancosModalLabel">Datos para realizar la transferencia.</h4>
			</div>
			<div class="modal-body">
				<p>
					Se cuenta con un limite de <b title="Hata el {{ $compra->created_at->addHour()->format('d/m/Y h:i:s a') }}">{{ $compra->created_at->addHour()->diffInMinutes(\Carbon\Carbon::now()) }} minutos</b>, para realizar el pago, durante este tiempo sus artirulos estaran apartados, al finalizar el tiempo sin confirmar su pago los articulos volveran a estar a disposicion de cualquier otro usuario para su compra.
				</p>
				<table class="table table-striped table-bordered table-hover">
					<tbody>
						@foreach (alfalibros\Modules\Base\Models\Bancos::all() as $banco)
						<tr>
							<td class="active">Banco</td>
							<td>{{ $banco->banco }}</td>
						</tr>
						<tr>
							<td class="active">Tipo de cuenta</td>
							<td>{{ $banco->tipo_cuenta }}</td>
						</tr>
						<tr>
							<td class="active">Cuenta</td>
							<td>{{ $banco->cuenta }}</td>
						</tr>
						<tr>
							<td class="active">Nombre</td>
							<td>{{ $banco->nombre }}</td>
						</tr>
						<tr>
							<td class="active">Rif</td>
							<td>{{ $banco->cedula }}</td>
						</tr>
						<tr>
							<td class="active">Correo</td>
							<td>{{ $banco->correo }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

@endsection

@push('js')
<script type="text/javascript">
	$("#datosBancosModal").modal();

	$('#form-confirmar').submit(function() { 
		// submit the form 
		$(this).ajaxSubmit({
			success : function(r){
				alert(r);
				
				setTimeout(function(){
					location.href = $urlApp;
				}, 3000);
			}
		}); 
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});
</script>
@endpush