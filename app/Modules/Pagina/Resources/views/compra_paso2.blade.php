@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			@include('pagina::partials.pasos-compra')
			<div class="row">
					<div class="col-xs-12 text-center">
						<h3 style="font-weight:bold;"> 
							@if ($compras->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
								
							@elseif ($compras->estatus == 0 && $compras->aprobado == 0)
								Cotización
							@elseif (is_null($compras->bancos_id) && $compras->estatus == 1 && $compras->aprobado == 0)
								Cotización
							@elseif (!is_null($compras->bancos_id) && $compras->estatus == 1 && $compras->aprobado == 0)
								<span class="label label-primary">En Espera de confirmación</span>
							@elseif ($compras->estatus == 1 && $compras->aprobado == 1)
								Factura
							@else
								
							@endif
						</h3>
						<hr/>
					</div>
					<div class="col-md-7 text-center">
						<img src="{{ asset('public/img/logos/logo.png') }}" style="max-width: 100%;" />
					</div>

					<div class="col-md-5" style="padding-top: 25px;">
						Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}<br /><br />
						<p class="p_estatus"> 
							<b>Estatus:</b>
							@if ($compras->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
								<span class="label label-danger">Tiempo Agotado</span>
							@elseif ($compras->estatus == 0 && $compras->aprobado == 0)
								<span class="label label-primary">En espera de pago</span>
							@elseif (is_null($compras->bancos_id) && $compras->estatus == 1 && $compras->aprobado == 0)
								<span class="label label-warning">En Espera de pago</span>
							@elseif (!is_null($compras->bancos_id) && $compras->estatus == 1 && $compras->aprobado == 0)
								<span class="label label-primary">En Espera de confirmación</span>
							@elseif ($compras->estatus == 1 && $compras->aprobado == 1)
								<span class="label label-success">Aprobado</span>
							@else
								<span class="label label-danger">Rechazado</span>
							@endif

						</p>
						<p>
							<b>Alfalibros C.A</b>
						</p>
						<p>
							Rif: J-40800027-0<br />
							Direcci&oacute;n: Paseo Heres, Diagonal a Plaza el Manguito, Frente El Colegio Latinoamericano<br />
							Telefonos: 0285-6340567<br />
							E-mail: <a href="mailto: ventas@alfalibros.com">ventas@alfalibros.com</a><br />
							Pagina: <a href="http://www.alfalibros.com">www.alfalibros.com</a>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<p>
							<b>Cliente: </b>{{ $compras->nombre }}<br />
							<b>C&eacute;dula: </b>{{ $compras->cedula }}<br />
							<b>E-mail: </b>{{ $compras->correo }}<br />
							<b>Direcci&oacute;n de envío: </b>
								{{ $compras->direccion_envio->estado }} /
								{{ $compras->direccion_envio->ciudad }} /
								{{ $compras->direccion_envio->direccion }}
								<br />
							<b>Telefono: </b>{{ $compras->direccion_envio->telefono }}<br />
							<b>Punto de Referencia: </b>{{ $compras->direccion_envio->punto_referencia }}<br />
							<b>Codigo Postal: </b>{{ $compras->direccion_envio->codigo_postal }}<br />
							<b>Método de envío: </b>{{ $compras->metodo_envio->nombre }}<br />
							@if (trim($compras->nota) != '')
							<b>Nota: </b>{{ $compras->nota }}<br />
							@endif
						</p>
					</div>
				</div>

				<div class="table-responsive">
					<table id="tabla-compra" class="table responsive_table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th class="text-center">Cantidad</th>
								<th class="text-right">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($productos as $producto)
							<?php
							$total += $producto->quantity_purchased * $producto->item_unit_price;
							?>
							<tr>
								<td>
									<h4 title="{{ $producto->producto->description }}">
										<a href="{{ url('producto/' . $producto->item_id) }}">
											{{ $producto->producto->name }}
										</a>
									</h4>
								</td>
								<td>
									Bs. {{ number_format($producto->item_unit_price, 2, ',', '.') }}
								</td>
								<td class="text-center">
									{{ number_format($producto->quantity_purchased, 0, ',', '.') }}
								</td>
								<td class="text-right">
									{{ number_format($producto->quantity_purchased * $producto->item_unit_price, 2, ',', '.') }}
								</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="3" class="text-right">
									Total:
								</td>
								<td class="text-danger text-right">Bs {{ number_format($total, 2, ',', '.') }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			@if($compras_suspendida > 0)
				<div class="text-right">
					<a href="#" class="btn btn-info btn-disabled" disabled>
						<i class="fa fa-check" aria-hidden="true"></i> Pagar Ahora 
					</a>
				</div>
			@else
				<div class="text-right">
					<a href="{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 1 ]) }}" class="btn btn-info" style="float: left;">
						<i class="fa fa-pencil" aria-hidden="true"></i> Editar
					</a>

					<span id="texto" style="float: left; margin-left: 10px;"></span>
                	<span class="clock" style="float: left; margin-left: 4px;"></span>

                	<span class="visible-print-block" style="float: left; margin-left: 10px;">Estos precios están sujetos a cambios sin previo aviso</span>

					<a href="#" class="btn btn-info btn-imprimir">
						<i class="fa fa-print" aria-hidden="true"></i> Imprimir
					</a>
					@if (is_null($compras->bancos_id) && $compras_suspendida == 0)
						<a href="{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 3 ]) }}" class="btn btn-success btn-pagar">
							<i class="fa fa-check" aria-hidden="true"></i> Pagar Ahora 
						</a>
					@else
						<a href="{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 3 ]) }}" class="btn btn-success">
							<i class="fa fa-chevron-right" aria-hidden="true"></i> Siguiente 
						</a>
					@endif
				</div>
			@endif
		@else
			@include('pagina::partials.no-login')
		@endif
	</div>
</div>

<div id="informacionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="informacionModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="informacionModalLabel">Información.</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					@if($compras_suspendida > 0)
						<div class="col-sm-12 text-center">
							<i class="fa fa-exclamation-triangle fa-5x gracias text-warning" style="text-align: center;padding: 30px;"></i> <br>
							<p class="text-center" style="text-align: center;">
								<h3>Disculpe... </h3>
								<br>
								Usted tiene compras pendientes por aprobar o concretar, debe esperar a que se culmine el proceso de aprobación
							</p>
						</div>
					@else
						<div class="col-sm-12 text-center">
							<i class="fa fa-info-circle fa-5x gracias text-primary" style="text-align: center;padding: 30px;"></i> <br>
							<p class="text-center" style="text-align: center;">
								<h3>Información</h3>
								<br>
								Verifique todos los productos antes de realizar su compra y proceda a realizar el pago de la misma.
							</p>
						</div>
					@endif
				</div>

			</div>
			<div class="modal-footer">
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
		}
	</style>
@endpush
@push('js')
<script type="text/javascript">
	$("#informacionModal").modal();
	
	$(".btn-imprimir").click(function(e){
		e.preventDefault();
		window.print();
	});

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