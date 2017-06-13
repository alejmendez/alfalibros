<div class="col-md-3 hidden-sm hidden-xs side-left">
	<div class="col-sm-12 div-round div-card div-white side-menu side-empresa">
		<p class="text-center">
			<img src="{{ asset('public/img/logos/logo.png') }}" class="img-responsive center-ele" />
		</p>
		<hr />

		<p><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Ciudad Bol&iacute;var</p>
		<p><i class="fa fa-home fa-fw" aria-hidden="true"></i> Paseo Heres, Diagonal a Plaza el Manguito, Frente El Colegio Latinoamericano</p>
		<p><i class="fa fa-phone fa-fw" aria-hidden="true"></i></i> Tel: 0285-6340567</p>
	</div>

	<div class="col-sm-12 div-round div-card div-white side-menu">
		<h3>Categorias</h3>
		<ul class="lista">
		@foreach ($categorias as $categoria)
			<li>
				<a href="{{ url('categoria/' . $categoria->id) }}">{{ ucwords(strtolower($categoria->name)) }} ({{ $categoria->cantidad }})</a>
				@if (count($categoria->hijos) > 0)
				<ul class="lista">
				@foreach ($categoria->hijos as $subcategoria)
					<li>
						<a href="{{ url('categoria/' . $subcategoria->id) }}">{{ ucwords(strtolower($subcategoria->name)) }} ({{ $subcategoria->cantidad }})</a>
					</li>
				@endforeach
				</ul>
				@endif
			</li>
		@endforeach
		</ul>
	</div>

	<div class="col-sm-12 div-round div-card div-white side-menu">
		<h3>Autores</h3>
		<ul class="lista">
		@foreach ($autores as $slug => $autor)
			<li>
				<a href="{{ url('autor/' . $slug) }}">{{ ucwords(strtolower($autor)) }}</a>
			</li>
		@endforeach
		</ul>
	</div>
</div>
