@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido div-round div-card div-white">
		<h3>Error al Autenticar Usuario</h3>
		
		<div class="row">
			<div class="col-sm-12">
				No encontramos un usuario con sus datos, intenta nuevamente, si no puedes crear una nueva cuenta haciendo click <a href="{{ route('pag.usuarios.nuevo') }}">Aqu&iacute;</a>.
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection