@extends('pagina::layouts.default')

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/pagina/imrpimir-cotizacion.css') }}" />
@endpush

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div id="ver-compra" class="col-md-9 col-sm-12">
		<div class="row">
			<div class="col-sm-12 div-round div-card div-white">
				@if ($autenticado)
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
													
												@elseif ($compra->aprobado == 0 && is_null($compra->bancos_id))
													<div class="btn-group">
														<a href="{{ route('pag.compra.ver', ['codigo' => $compra->codigo]) }}" title="Pagar ahora" data-toggle="tooltip" class="btn btn-info">
															<i class="fa fa-check" aria-hidden="true"></i>
														</a>
														<a href="{{ route('pag.compra.cancelar', ['codigo' => $compra->codigo]) }}" title="Cancelar Compra" data-toggle="tooltip" class="btn btn-danger">
															<i class="fa fa-remove" aria-hidden="true"></i>
														</a>
													</div>
												@elseif ($compra->aprobado > 0 && $compra->bancos_id > 0)
													<div class="btn-group">
														<a href="{{ route('pag.compra.cotizacion', ['codigo' => $compra->codigo]) }}" title="ver compra" data-toggle="tooltip" class="btn btn-info">
															<i class="fa fa-eye" aria-hidden="true"></i>
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
													
												@elseif ($compra->aprobado == 0 && is_null($compra->bancos_id))
													<div class="btn-group">
														<a href="{{ route('pag.compra.ver', ['codigo' => $compra->codigo]) }}" title="Pagar ahora" data-toggle="tooltip" class="btn btn-info">
															<i class="fa fa-check" aria-hidden="true"></i>
														</a>
														<a href="{{ route('pag.compra.cancelar', ['codigo' => $compra->codigo]) }}" title="Cancelar Compra" data-toggle="tooltip" class="btn btn-danger">
															<i class="fa fa-remove" aria-hidden="true"></i>
														</a>
													</div>
												@elseif ($compra->aprobado > 0 && $compra->bancos_id > 0)
													<div class="btn-group">
														<a href="{{ route('pag.compra.cotizacion', ['codigo' => $compra->codigo]) }}" title="ver compra" data-toggle="tooltip" class="btn btn-info">
															<i class="fa fa-eye" aria-hidden="true"></i>
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
						@else
							@if ($compras_suspendida->count() == 0)
								<h3>No tiene ningun registro de compras.</h3>
							@endif
						@endif
					
				@else
					@include('pagina::partials.no-login')
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
<style type="text/css">
	#tabla-compra img {
		max-width: 50px;
	}
</style>
@endpush

@push('js')
<script type="text/javascript">
$(".btn-imprimir").click(function(e){
	e.preventDefault();
	window.print();
});
</script>
@endpush