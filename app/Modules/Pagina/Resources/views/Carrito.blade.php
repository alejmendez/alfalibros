@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div id="app-carrito" class="col-md-9 col-sm-12">
		<div class="row">
			<div class="col-sm-12 div-round div-card div-white">
				<h3>Carrito de Compras</h3>
				<div class="table-responsive" v-show="carrito.length > 0">
					<carrito-table :carrito="carrito" :total="0"></carrito-table>
				</div>

				<div v-show="carrito.length == 0" style="min-height: 200px;">
					No posee elementos en su carro de compra, puede revisar nuestros catalogos de productos haciendo click <a href="{{ route('pag.index') }}">aqu&iacute;</a>
				</div>

				@if ($autenticado)
					<div class="text-right">
						<button class="btn btn-info btn-lg" data-toggle="tooltip" title="Actualizar el carrito de compras" @click="actualizar()">
							Actualizar <i class="fa fa-refresh" aria-hidden="true"></i>
						</button>

						<button class="btn btn-success btn-lg" @click="comprar()" :disabled="carrito.length == 0">
							Comprar <i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>
					</div>
				@else
					@include('pagina::partials.no-login')
				@endif
			</div>
		</div>
	</div>
</div>

<script type="text/x-template" id="carrito-template">
	<table id="tabla-compra" class="table responsive_table">
		<thead>
			<tr>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="producto in carrito">
				<td>
					<a :href="'{{ url('producto') }}/' + producto.id">
						<img :src="'http://alfalibros.net/paneldelibros/index.php/app_files/view/' + producto.options.imagen" alt="" />
					</a>
				</td>
				<td>
					<h4 :title="producto.options.descripcion">
						<a :href="'{{ url('producto') }}/' + producto.id">
							@{{ producto.name }}
						</a>
					</h4>
				</td>
				<td>
					Bs. @{{ number_format(producto.price, 2, ',', '.') }}
				</td>
				<td class="text-center">
					<input type="number" v-model="producto.qty" min="1" :max="producto.options.cantidad" :title="app.max(producto.options.cantidad)" data-toggle="tooltip"/>
				</td>
				<td>
					@{{ number_format(producto.qty * producto.price, 2, ',', '.') }}
				</td>
				<td>
					<button class="btn btn-danger" @click="eliminar(producto.rowId, producto.id)">
						<i class="fa fa-times"></i>
					</button>
				</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right">
					Total:
				</td>
				<td colspan="2" class="text-danger">Bs @{{ total }}</td>
			</tr>
		</tbody>
	</table>
</script>
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
app.carrito = {!! json_encode($carrito->values()) !!};
</script>
@endpush