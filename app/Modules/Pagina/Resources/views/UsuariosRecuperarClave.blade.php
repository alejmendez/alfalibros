@extends('pagina::layouts.default')
@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		<h3 class="col-sm-12">Recupera tu contraseña</h3>
		
		<div class="col-md-12">
			<p>Podemos ayudarte a cambiar tu contraseña mediante tu dirección de correo electrónico.</p>
		</div>

		{!! Form::open([
			'url'            => route('pag.usuarios.recuperar.clave'), 
			'accept-charset' => 'UTF-8',
			'class'          => 'form',
			'id'             => 'recovery-form',
			'method'         => 'post',
			'name'           => 'recovery-form',
			'role'           => 'form',
		]) !!}
			{!! Form::bsText('email', '', [
				'label'       => 'Correo electrónico',
				'placeholder' => 'Correo electrónico',
				'title'       => 'Correo electrónico',
				'required'    => 'required',
				'class_cont'  => 'col-sm-12'
			]) !!}

			<div class="col-sm-12 text-center" style="margin-top: 40px">
				<button type="submit" class="btn btn-primary">Recuperar</button>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(function(){
	$("#recovery-form").submit(function(e){
		e.preventDefault();
		var form = $(this);
		$.post(form.attr('action'), form.serialize(), function(r){
			aviso(r);
			if (r.s) {
				setTimeout(function(){
					location.href = $urlApp.replace(/\/+$/,'');
				}, 3000);
			}
		});
	});
});
</script>
@endpush