@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 div-round div-card div-white">
		<h3>{{ $producto->nombre }}</h3>
		<div class="row">
			<div class="col-md-3 col-sm-4 col-xs-12">
				<img src="http://alfalibros.net/paneldelibros/index.php/app_files/view/{{ $producto->imagen }}" alt="" class="img-responsive" />
			</div>
			<div class="col-md-9 col-sm-8 col-xs-12">
				<h4>
					{{ $producto->nombre }}
				</h4>
				@if ($producto->autor != '')
				<p>
					Autor: <a href="{{ url('autor/' . str_slug($producto->autor)) }}">{{ $producto->autor }}</a>
				</p>
				@endif
				<p>
					{{ $producto->descripcion }}
				</p>
				<a href="{{ route('pag.categoria', ['id' => $producto->categoria_id]) }}" class="fs_medium color_grey d_inline_b m_bottom_3">Categoria: <i>{{ $producto->categoria }}</i></a>
				<div class="im_half_container m_bottom_10">
					<h4 class="text-danger">
						<p>
							Bs. {{ number_format(floatval($producto->precio), 2, ',', '.') }}
						</p>
					</h4>
				</div>

				<?php
					$enCarrito = $carrito->where('id', $producto->id)->count() > 0;
				?>
				
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<input type="number" name="cantidad" class="form-control" value="1" min="1" max="{{ intval($producto->cantidad) }}" {!! $enCarrito ? 'disabled="disabled"' : '' !!} />
					</div>
				</div>
				
				<div style="max-width: 270px;">
					<button data-producto="{{ $producto->id }}" class="btn btn-success btn-comprar" {!! $enCarrito ? 'disabled="disabled"' : '' !!} style="float: left; margin-right: 20px;">
						<i class="fa fa-shopping-cart"></i> Agregar
					</button>

					<button data-producto="{{ $producto->id }}" class="btn btn-danger btn-cancelar-comprar {!! !$enCarrito ? 'hide' : '' !!}" {!! !$enCarrito ? 'disabled="disabled"' : '' !!} style="float: left;">
						<i class="fa fa-remove"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection