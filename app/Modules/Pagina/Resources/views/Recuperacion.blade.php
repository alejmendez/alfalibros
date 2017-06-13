@extends('pagina::layouts.default')
@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		<h3 class="col-sm-12">Recupera tu contraseña</h3>
		
		<div class="col-md-12">
			<p>Hemos confirmado tu correo electr&oacute;nico, solo falta guardar una contrase&ntilde;a nueva.</p>
		</div>

		{!! Form::open([
			'url'            => route('pag.usuarios.recuperarclave', ['codigo' => $token]), 
			'accept-charset' => 'UTF-8',
			'class'          => 'form',
			'id'             => 'recovery-form',
			'method'         => 'post',
			'name'           => 'recovery-form',
			'role'           => 'form',
		]) !!}
			{!! Form::bsPassword('password', '', [
				'label'       => 'Contraseña',
				'placeholder' => 'Contraseña',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'title'        => 'La Contraseña debe contener al menos un letra en Mayuscula, una letra en Minuscula, al menos un numero y 8 caracteres.',
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