@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido div-round div-card div-white">
				
		<div class="row">
			<div class="col-sm-12 text-center">
				<i class="fa fa-thumbs-o-up fa-5x gracias" style="text-align: center;padding: 50px;"></i> <br> <br>
				<p class="text-center" style="text-align: center;">
					<h3>¡Gracias por Registrarte! </h3>
					<br>
					Ya puedes iniciar sesión en tu cuenta
					
					<a href="#" data-toggle="modal" data-target="#login-modal">click aquí</a>
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
		color:#337AB7;
	}
</style>
@endpush

@push('js')
<script>
	setTimeout(function() {
		location.href = "{{ route('pag.index') }}";
	}, 8000);
</script>
@endpush