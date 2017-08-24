@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			@include('pagina::partials.pasos-compra')

			@if(intval($compras->bancos_id) == 0 )
			<div class="row">
				{!! Form::open(['id' => 'form-confirmar', 'url' => route('pag.compra.confirmar', [ 'codigo' => $codigo])]) !!}
					
					{!! Form::hidden('codigo', $compras->codigo) !!}

					<h2 class="col-sm-12">Datos Bancarios</h2>
					<h5 class="col-sm-12">
						 Después de realizar la transferencia, rellene 
						 los siguientes campos para que nuestro equipo
						 pueda confirmar su orden.
					</h5>

					<div class="col-sm-6">
						<div class="row">
						{!! Form::bsText('banco_usuario', '', [
							'label'       => 'Banco del cliente',
							'placeholder' => false,
							'title'       => 'Nombre del Banco del Cliente',
							'data-toggle' => 'tooltip',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						<div class="col-sm-12"></div>

						{!! Form::bsText('codigo_transferencia', '', [
							'label'       => 'Numero de Recibo',
							'placeholder' => false,
							'title'       => 'Numero de Recibo de transferencia',
							'data-toggle' => 'tooltip',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						<div class="col-sm-12"></div>

						<div class="form-group col-sm-12">
							<label class="requerido">Monto a Pagar</label>
							<div class="form-control">
								{{ $compras->monto }} {{ $controller->conf('moneda') }}
							</div>
						</div>
						<div class="col-sm-12"></div>

						{!! Form::bsSelect('bancos_id', $controller->bancos(), '', [
							'label'       => 'Banco Receptor',
							'placeholder' => '- Seleccione un Banco',
							'title'       => 'Seleccione el banco al cual realizó la transferencia',
							'data-toggle' => 'tooltip',
							'required'    => true,
							'class_cont'  => 'col-sm-12'
						]) !!}
						<div class="col-sm-12"></div>
						
						{!! Form::bsTextarea('nota', '', [
							'label'       => 'Nota Adicional',
							'placeholder' => false,
							'rows'        => 3,
							'class_cont'  => 'col-sm-12'
						]) !!}
						</div>
					</div>
					<div class="col-sm-6">
						@if(is_null($compras->bancos_id))
							<p>
								Cuenta con un limite de 
								<b title="Hata el {{ $compras->created_at->addHour()->format('d/m/Y h:i:s a') }}">
									<time datetime="{!! $compras->created_at->addHour()->toRfc3339String() !!}" class="age">
										{{ $compras->created_at->addHour()->diffInMinutes(\Carbon\Carbon::now()) }} minutos
									</time>
								</b> 
								a partir de este momento para completar el pago, su(s) artículo(s) se 
								encuentra(n) apartado(s), Si no completa el pago antes de finalizar el tiempo 
								el (los) items volverán a estar disponibles al público.
							</p>
						@endif
					
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
								<tr>
									<td class="active">Referencia</td>
									<td>Compra N&deg;: {{ $compras->sale_id }}</td>
								</tr>
								<tr>
									<td class="active">Monto a Pagar</td>
									<td>{{ number_format($compras->monto, 2, ',', '.') }} {{ $controller->conf('moneda') }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-sm-12"></div>

					<div class="form-group col-sm-12 text-right">
						<button id="btn_confirmar" type="submit" class="btn btn-success btn-lg">
							Confirmar Pago <i class="fa fa-thumbs-up"></i>
						</button>
					</div>
				{!! Form::close() !!}
			</div>
			@else
			<div class="row">
				{!! Form::open(['id' => 'form-confirmar', 'url' => route('pag.compra.confirmar', [ 'codigo' => $codigo])]) !!}
					
					{!! Form::hidden('codigo', $compras->codigo) !!}

					<h2 class="col-sm-12" style="font-weight: bold;">Datos Bancarios</h2>

					<div class="col-sm-6">
						<div class="form-group col-sm-12">
							<label for="banco_usuario" class="requerido">Banco del cliente</label>
							<div class="form-control" data-toggle="tooltip" title="Nombre del Banco del Cliente">
								{{ $compras->banco_usuario}}
							</div>
						</div>
						<div class="col-sm-12"></div>
						
						<div class="form-group col-sm-12">
							<label for="codigo_transferencia" class="requerido">Numero de Recibo</label>
							<div class="form-control" data-toggle="tooltip" title="Numero de Recibo de transferencia">
								{{ $compras->codigo_transferencia }}
							</div>
						</div>
						<div class="col-sm-12"></div>

						<div class="form-group col-sm-12">
							<label class="requerido">Monto a Transferir</label>
							<div class="form-control">
								{{ $compras->monto }} {{ $controller->conf('moneda') }}
							</div>
						</div>
						<div class="col-sm-12"></div>

						<div class="form-group col-sm-12">
							<label for="bancos_id" class="requerido">Banco Receptor</label>
							<div class="form-control" data-toggle="tooltip" title="Banco al cual realizó la transferencia">
								{{ $compras->bancos->banco }}
							</div>
						</div>
					<div class="form-group col-sm-12">
					    <label for="nota" class="requerido">Nota Adicional</label>
				        <div class="form-control">
				        	{{ $compras->nota }}
				        </div>
				    </div>
				    </div>
					
					<div class="col-sm-6">
						@if(is_null($compras->bancos_id))
							<p>
								Cuenta con un limite de 
								<b title="Hata el {{ $compras->created_at->addHour()->format('d/m/Y h:i:s a') }}">
									<time datetime="{!! $compras->created_at->addHour()->toRfc3339String() !!}" class="age">
										{{ $compras->created_at->addHour()->diffInMinutes(\Carbon\Carbon::now()) }} minutos
									</time>
								</b> 
								a partir de este momento para completar el pago, su(s) artículo(s) se 
								encuentra(n) apartado(s), Si no completa el pago antes de finalizar el tiempo 
								el (los) items volverán a estar disponibles al público.
							</p>
						@endif
					
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
								<tr>
									<td class="active">Referencia</td>
									<td>Compra N&deg;: {{ $compras->sale_id }}</td>
								</tr>
								<tr>
									<td class="active">Monto a Pagar</td>
									<td>{{ number_format($compras->monto, 2, ',', '.') }} {{ $controller->conf('moneda') }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-sm-12"></div>

				    @if (is_null($compras->bancos_id) && $compras_suspendida == 0)
						<div class="form-group col-sm-12 text-right">
							<span class="btn btn-success btn-lg confirma">
								Confirmar Pago <i class="fa fa-thumbs-up"></i>
							</span>
						</div>
				    @else
						<div class="col-sm-12 text-right">
							<a href="{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 4 ]) }}" class="btn btn-info">
								<i class="fa fa-chevron-right" aria-hidden="true"></i> Siguiente 
							</a>
						</div>
				    @endif
				{!! Form::close() !!}
			</div>
			@endif
		@else
			@include('pagina::partials.no-login')
		@endif
	</div>
</div>

@endsection

@push('css')
	<style type="text/css">
		.portlet {
		    margin-top: 0;
		    margin-bottom: 0px;
		    padding: 0;
		    border-radius: 4px;
		}
		.mt-step-col a{
			text-decoration: none;
		}
		.modal-dialog{
			margin: 30px auto;
			width: 600px;
		}
	</style>
@endpush
@push('js')
	
<script type="text/javascript">	
	var $url_paso_4 = "{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 4 ]) }}";
	if(parseInt(banco_id) != 0){
		$('#conteo').remove();
	}
	
	$("#datosBancosModal").modal();
	
	$('.confirma').click(function(){
		location.href = $url_paso_4;
	});

	$('#form-confirmar').submit(function() { 
		// submit the form 
		$(this).ajaxSubmit({
			success : function(r){
				alert(r);
				
				setTimeout(function(){
					location.href = $url_paso_4;
				}, 10000);
			}
		}); 
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});
</script>
@endpush