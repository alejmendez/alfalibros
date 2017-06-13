@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			@include('pagina::partials.pasos-compra')
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

			@if (is_null($compras->bancos_id) && $compras_suspendida == 0)
			<div class="text-right">
				<a href="{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 3 ]) }}" class="btn btn-info btn-pagar">
					<i class="fa fa-check" aria-hidden="true"></i> Pagar Ahora 
				</a>
			</div>
			@else
				<div class="text-right">
					<a href="{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 3 ]) }}" class="btn btn-info">
						<i class="fa fa-chevron-right" aria-hidden="true"></i> Siguiente 
					</a>
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
		.mt-step-col a{
			text-decoration: none;
		}
	</style>
@endpush
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