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

					<h4 class="col-sm-12">Datos Bancarios</h4>
					<h5 class="col-sm-12">
						 Despues de realizar la transferencia, rellene los siguientes campos para así poder verificarla en un lapso de 24 horas aproximadamente 
					</h5>

					{!! Form::bsText('banco_usuario', '', [
						'label'       => 'Banco del cliente',
						'placeholder' => 'Banco del cliente',
						'help'        => 'Nombre del Banco del Cliente',
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

					<div class="form-group col-sm-12">
					    <label class="requerido">Monto</label>
					    <div class="form-control">
					    	{{ $compras->monto }} {{ $controller->conf('moneda') }}
					    </div>
				    </div>

					{!! Form::bsSelect('bancos_id', $controller->bancos(), '', [
						'label'       => 'Banco Receptor',
						'placeholder' => '- Seleccione un Banco',
						'help'        => 'Seleccione el banco al cual realizó la transferencia',
						'required'    => true,
						'class_cont'  => 'col-sm-12'
					]) !!}
					
					<div class="form-group col-sm-12">
					    <label for="monto" class="requerido">Imagen del comprobante</label>
				        {!! Form::file('image', '', [
				        	'required' => 'required',
				        ]) !!}

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
							Confirmar Pago <i class="fa fa-thumbs-up"></i>
						</button>
					</div>
				{!! Form::close() !!}
			</div>
			@else
			<div class="row">
				{!! Form::open(['id' => 'form-confirmar', 'url' => route('pag.compra.confirmar', [ 'codigo' => $codigo])]) !!}
					
					{!! Form::hidden('codigo', $compras->codigo) !!}

					<h4 class="col-sm-12">Datos Bancarios</h4>

					<div class="form-group col-sm-12">
					    <label for="banco_usuario" class="requerido">Banco del cliente</label>
				        <div class="form-control">
				        	{{ $compras->banco_usuario}}
				        </div>

				        <span class="help-block">Nombre del Banco del Cliente</span>
				    </div>

					<div class="form-group col-sm-12">
					    <label for="codigo_transferencia" class="requerido">Codigo de transferencia</label>
				        <div class="form-control">
				        	{{ $compras->codigo_transferencia }}
				        </div>
				        <span class="help-block">Codigo del comprobante de transferencia</span>
				    </div>

					<div class="form-group col-sm-12">
					    <label class="requerido">Monto</label>
					    <div class="form-control">
					    	{{ $compras->monto }} {{ $controller->conf('moneda') }}
					    </div>
				    </div>

				    <div class="form-group col-sm-12">
					    <label for="bancos_id" class="requerido">Banco Receptor</label>
				        <div class="form-control">
				        	{{ $compras->bancos->banco }}
				        	
				        </div>

				        <span class="help-block">Banco al cual realizó la transferencia</span>
				    </div>
					
					<div class="form-group col-sm-12">
					    <label for="monto" class="requerido">Comprobante de Transferencia</label>
					    <div class="form-control">
					        <a href="{{ url('public/soportes/pagos/'.$compras->comprobante) }}" style="text-decoration: none">
					        	<i class="fa fa-file-image-o"></i> Comprobante adjunto
					        </a>
					    </div>
				    </div>

					<div class="form-group col-sm-12">
					    <label for="nota" class="requerido">Nota Adicional</label>
				        <div class="form-control">
				        	{{ $compras->nota}}
				        </div>

				        <span class="help-block">Nota Adicional</span>
				    </div>

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
<div id="datosBancosModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="datosBancosModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="datosBancosModalLabel">Datos para realizar la transferencia.</h4>
			</div>
			<div class="modal-body">
				@if(is_null($compras->bancos_id))
					<p>
						Cuenta con un limite de <b title="Hata el {{ $compras->created_at->addHour()->format('d/m/Y h:i:s a') }}">{{ $compras->created_at->addHour()->diffInMinutes(\Carbon\Carbon::now()) }} minutos</b> a partir de este momento para completar el pago, su(s) artículo(s) se encuentra(n) apartado(s), Si no completa el pago antes de finalizar el tiempo el (los) items volverán a estar disponibles al público.
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
		/*
		setTimeout(function(){
			location.href = $url_paso_4;
		}, 3000);
		*/
	});
	
	/*
	$('#cotizacion').click(function(){
		
		url_cotiza = "{{ route('pag.compra.cotizacion', [ 'codigo' => $codigo ]) }}";
  		window.open(url_cotiza, '_blank');
	
	});
	*/

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