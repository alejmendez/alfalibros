@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			@if (get_class($compras) == 'Illuminate\Database\Eloquent\Collection')
					@if ($compras_suspendida->count() > 0)
					<h3>Registros de Compras.</h3>
					<div class="table-responsive">
						<table id="tabla-compra" class="table responsive_table">
							<thead>
								<tr>
									<th style="width: 15%">Monto</th>
									<th style="width: 20%">Estatus</th>
									<th style="width: 25%">Fecha de Pedido</th>
									<th style="width: 25%">Tiempo Limite</th>
									<th style="width: 150px">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($compras_suspendida as $compra)
								<tr>
									<td>
										Bs {{ number_format($compra->monto, 2, ',', '.') }}
									</td>
									<td>
										@if ($compra->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
											<span class="label label-danger">Tiempo Agotado</span>
										@elseif ($compra->aprobado == 0)
											<span class="label label-primary">En Espera de confirmación</span>
										@elseif ($compra->aprobado == 1)
											<span class="label label-success">Aprobado</span>
										@else
											<span class="label label-danger">Rechazado</span>
										@endif
									</td>
									<td>
										{!! $compra->created_at->format('d/m/Y \<\b\r\>h:i:s a') !!}
									</td>
									<td>
										@if ($compra->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
											Tiempo Agotado
										@elseif ($compra->aprobado == 0)
											{!! $compra->created_at->addHour()->format('d/m/Y \<\b\r\>h:i:s a') !!}
										@endif
									</td>
									<td>
										@if ($compra->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
											
										@elseif ($compra->aprobado == 0)
											<div class="btn-group">
												<a href="{{ route('pag.compra.ver', ['codigo' => $compra->codigo]) }}" title="ver Compra" data-toggle="tooltip" class="btn btn-info">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
												<a href="{{ route('pag.compra.confirmar', ['codigo' => $compra->codigo]) }}" title="Confirmar Compra" data-toggle="tooltip" class="btn btn-success">
													<i class="fa fa-check" aria-hidden="true"></i>
												</a>
												<a href="{{ route('pag.compra.cancelar', ['codigo' => $compra->codigo]) }}" title="Cancelar Compra" data-toggle="tooltip" class="btn btn-danger">
													<i class="fa fa-remove" aria-hidden="true"></i>
												</a>
											</div>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif

					@if ($compras->count() > 0)
					<h3>Registros de Cotizaciones.</h3>
					<div class="table-responsive">
						<table id="tabla-compra" class="table responsive_table">
							<thead>
								<tr>
									<th style="width: 15%">Monto</th>
									<th style="width: 20%">Estatus</th>
									<th style="width: 25%">Fecha de Pedido</th>
									<th style="width: 25%">Tiempo Limite</th>
									<th style="width: 150px">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($compras as $compra)
								<tr>
									<td>
										Bs {{ number_format($compra->monto, 2, ',', '.') }}
									</td>
									<td>
										@if ($compra->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
											<span class="label label-danger">Tiempo Agotado</span>
										@elseif ($compra->aprobado == 0)
											<span class="label label-primary">En Espera</span>
										@elseif ($compra->aprobado == 1)
											<span class="label label-success">Aprobado</span>
										@else
											<span class="label label-danger">Rechazado</span>
										@endif
									</td>
									<td>
										{!! $compra->created_at->format('d/m/Y \<\b\r\>h:i:s a') !!}
									</td>
									<td>
										@if ($compra->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
											Tiempo Agotado
										@elseif ($compra->aprobado == 0)
											{!! $compra->created_at->addHour()->format('d/m/Y \<\b\r\>h:i:s a') !!}
										@endif
									</td>
									<td>
										@if ($compra->created_at->addHour()->timestamp < \Carbon\Carbon::now()->timestamp)
											
										@elseif ($compra->aprobado == 0)
											<div class="btn-group">
												<a href="{{ route('pag.compra.ver', ['codigo' => $compra->codigo]) }}" title="ver Compra" data-toggle="tooltip" class="btn btn-info">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
												@if ($compras_suspendida->count() == 0)
												<a href="{{ route('pag.compra.confirmar', ['codigo' => $compra->codigo]) }}" title="Confirmar Compra" data-toggle="tooltip" class="btn btn-success">
													<i class="fa fa-check" aria-hidden="true"></i>
												</a>
												@endif
												<a href="{{ route('pag.compra.cancelar', ['codigo' => $compra->codigo]) }}" title="Cancelar Compra" data-toggle="tooltip" class="btn btn-danger">
													<i class="fa fa-remove" aria-hidden="true"></i>
												</a>
											</div>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
						@if ($compras_suspendida->count() == 0)
							<h3>No tiene ningun registro de compras.</h3>
						@endif
					@endif
				@else
				<div class="row">
					<div style="position: relative;">
						<a href="#" class="btn btn-info btn-imprimir" style="position: absolute; right: 20px; z-index: 10;">
							<i class="fa fa-print" aria-hidden="true"></i> Imprimir
						</a>
					</div>
					<div class="col-md-7 text-center">
						<img src="{{ asset('public/img/logos/logo.png') }}" style="max-width: 100%;" />
					</div>

					<div class="col-md-5" style="padding-top: 25px;">
						Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}<br /><br />
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
							<b>Direcci&oacute;n: </b>{{ $compras->direccion }}<br />
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

				
				@endif
		@else
			@include('pagina::partials.no-login')
		@endif
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