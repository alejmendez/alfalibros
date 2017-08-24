@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido div-round div-card div-white">
		<h3><b>UPS! Su compra no se puede confirmar.</b></h3>
		
		<div class="row">
			<div class="col-sm-12" style="font-size: 16px">
				<h4>
					Disculpe.
				</h4>
				<p>
					Su pedido ha caducado, ya ha pasado una hora o más desde su solicitud, puede volver hacer un pedido navegando en nuestra pagina web o haciendo click <a href="{{ route('pag.index') }}">aqu&iacute;</a> para ir a la pagina de inicio.
				</p>
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection