<div class="col-md-2 col-sm-12">
	<div class="col-sm-12 div-round div-card div-white side-menu">
		<div class="text-center">
			<h4>Compra Actual:</h4>
			<h4>-------------</h4>
		</div>

		Cantidad de Productos: <b id="cantidadProductor">{{ Cart::count() }}</b><br />
		Total a Pagar: <br />
		Bs 
		<span id="carritoTotal">
			{{ number_format(floatval($totalCarrito), 2, ',', '.') }}
		</span>
		<br />
		<p>
			<br />
			<a href="{{ url('carrito') }}" class="btn btn-primary btn-block" style="margin-bottom: 10px;">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i> Ver Carrito
			</a>
			<a href="{{ url('carrito/vaciar') }}" class="btn btn-danger btn-block">
				<i class="fa fa-ban" aria-hidden="true"></i> Vaciar Carrito
			</a>
		</p>
	</div>
</div>