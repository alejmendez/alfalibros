@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido">
		<h3>Categoria: {{ ucwords(strtolower($categoria->nombre)) }}</h3>
		@foreach ($productos->chunk(4) as $_productos)
			<div class="row">
				@foreach ($_productos as $producto)
				<?php
					$enCarrito = $carrito->where('id', $producto->id)->count() > 0;
				?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="libro div-round div-card div-white">
						<div class="libro-img">
							<a href="{{ route('pag.producto', ['id' => $producto->id]) }}">
								<img src="http://alfalibros.net/paneldelibros/index.php/app_files/view/{{ $producto->imagen }}" alt="" class="img-responsive" />
							</a>
						</div>
						<h6 title="{{ preg_match('/libros/i', $producto->nombre) ? 
									substr($producto->nombre, strrpos($producto->nombre, ',') + 1) : 
									$producto->nombre }}">
							<a href="{{ route('pag.producto', ['id' => $producto->id]) }}" class="color_dark">
								{{ str_limit(preg_match('/libros/i', $producto->nombre) ? 
									substr($producto->nombre, strrpos($producto->nombre, ',') + 1) : 
									$producto->nombre, 30) }}
							</a>
						</h6>
						<!-- <a href="{{ route('pag.categoria', ['id' => $producto->categoria_id]) }}"><i>{{ $producto->categoria }}</i></a> -->
						<h4 class="text-danger">
							<p>
								Bs. {{ number_format(floatval($producto->precio), 2, ',', '.') }}
							</p>
						</h4>

						<input type="number" name="cantidad" class="form-control" value="1" min="1" max="{{ intval($producto->cantidad) }}" {!! $enCarrito ? 'disabled="disabled"' : '' !!} />

						<button data-producto="{{ $producto->id }}" class="btn btn-success btn-comprar" {!! $enCarrito ? 'disabled="disabled"' : '' !!}>
							<i class="fa fa-shopping-cart"></i> Agregar
						</button>
					</div>
				</div>
				@endforeach
			</div>
		@endforeach
		<div class="row">
			<div class="col-md-12" style="text-align: center;">
				{{ $productos->links() }}
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection