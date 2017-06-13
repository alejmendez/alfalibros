@extends('pagina::layouts.default')

@section('content')
@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 div-round div-card div-white">
		<h3>Categorias</h3>
		<ul class="lista">
		@foreach ($categorias as $categoria)
			<li>
				<a href="{{ route('pag.categoria', ['id' => $categoria->id]) }}">{{ ucwords(strtolower($categoria->name)) }} ({{ $categoria->cantidad }})</a>
				@if (count($categoria->hijos) > 0)
				<ul class="lista">
				@foreach ($categoria->hijos as $subcategoria)
					<li>
						<a href="{{ route('pag.categoria', ['id' => $subcategoria->id]) }}">{{ ucwords(strtolower($subcategoria->name)) }} ({{ $subcategoria->cantidad }})</a>
					</li>
				@endforeach
				</ul>
				@endif
			</li>
		@endforeach
		</ul>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection