@extends('pagina::layouts.default')
{{ $compras->created_at}}
@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)

				<div class="row">
					<div style="position: relative;">
						<a href="#" class="btn btn-info btn-imprimir" style="position: absolute; right: 20px; z-index: 10;">
							<i class="fa fa-print" aria-hidden="true"></i> Imprimir
						</a>
					</div>

					<div class="col-xs-12 text-center">
						<h3 style="font-weight:bold;"> 
							<i>
							@if ($compras->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
								
							@elseif ($compras->estatus == 0 && $compras->aprobado == 0)
								COTIZACIÓN
							@elseif (is_null($compras->bancos_id) && $compras->estatus == 1 && $compras->aprobado == 0)
								COTIZACIÓN
							@elseif (!is_null($compras->bancos_id) && $compras->estatus == 1 && $compras->aprobado == 0)
								<span class="label label-primary">En Espera de confirmación</span>
							@elseif ($compras->estatus == 1 && $compras->aprobado == 1)
								FACTURA
							@else
								
							@endif
							</i>
						</h3>
						<hr/>
					</div>
					<div class="col-md-7 text-center">
						<img src="{{ asset('public/img/logos/logo.png') }}" style="max-width: 100%;" />
					</div>

					<div class="col-md-5" style="padding-top: 25px;">
						Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}<br /><br />
						<p> 
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
							<b>Direcci&oacute;n de envío: </b>{{ $compras->direccion_envio }}<br />
							<b>Método de envío: </b>{{ $compras->metodo_envio }}<br />
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
	
		@else
			@include('pagina::partials.no-login')
		@endif
	</div>
</div>



@endsection

@push('css')
<link rel="stylesheet" href="{{ url('public/css/pagina/imprimir-cotizacion.css')}}" media = "print">
	<style type="text/css">
		.portlet {
		    margin-top: 0;
		    margin-bottom: 0px;
		    padding: 0;
		    border-radius: 4px;
		}
	</style>
@endpush
@push('js')
<script type="text/javascript">
	$("#datosBancosModal").modal();

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