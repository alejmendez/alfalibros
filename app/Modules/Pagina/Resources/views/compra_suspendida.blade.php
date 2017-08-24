@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido div-round div-card div-white">
				
		<div class="row">
			<div class="col-sm-12 text-center">
				<i class="fa fa-info-circle fa-5x gracias" style="text-align: center;padding: 50px;"></i> <br> <br>
				<p class="text-center" style="text-align: center;">
					<h3>Disculpe... </h3>
					<br>
					Usted tiene compras pendientes por aprobar o concretar, debe esperar a que se culmine el proceso de aprobación
				</p>
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection
@push('css')
<style type="text/css">
	.gracias {
		color:#F7CA18;
	}
</style>
@endpush