@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido div-round div-card div-white">
		<h3>Confirmaci&oacute;n</h3>
		
		<div class="row">
			<div class="col-sm-12">
				<p>Hemos Confirmado Satisfactoriamente tu cuenta, puedes continuar en nuestra pagina.</p>
				<p>Haz click <a href="{{ route('pag.index') }}">aqu&iacute;</a> para ir a la p&aacute;gina de inicio.</p>
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection