@extends('pagina::layouts.default')
@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-7 col-sm-12 contenido">
		<div class="row">
			<div class="col-sm-12 div-round div-card div-white">
				@if ($autenticado)
					<div class="row">
						<div class="col-sm-12">
							<h2>
								Hola {{ $usuario->persona->first_name }}.
							</h2>
							
							<p>Ya te encuentras autenticado, puedes continuar viendo la gran cantidad de productos q tenemos para ofrecerte...</p>

							<p>Haz click <a href="{{ route('pag.index') }}">aqu&iacute;</a> para ir a la p&aacute;gina de inicio</p>
						</div>
					</div>
				@else
				<h3 class="col-sm-12">Iniciar sesión</h3>
				{!! Form::open(['url' => 'login']) !!}
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							{!! Form::bsText('usuario', '', [
								'label'       => false,
								'placeholder' => 'Correo',
								'class_cont'  => 'col-sm-12'
							]) !!}

							{!! Form::bsPassword('password', '', [
								'label'       => false,
								'placeholder' => 'Contraseña',
								'required'    => 'required',
								'class_cont'  => 'col-sm-12'
							]) !!}
							
							<div class="col-sm-12">
								<label for="recordar">
									<input id="recordar" type="checkbox" name="recordar" value="1" /> Recuerdame
								</label>
							</div>

							<div class="form-group col-sm-12 text-center">
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</div>
						</div>

						
						<div class="form-group col-sm-12">
							<a href="{{ url('usuarios/recuperar/usuario') }}">&iquest;Olvidaste tu usuario?</a><br />
							<a href="{{ url('usuarios/recuperar/clave') }}">&iquest;Olvidaste tu contrase&ntilde;a?</a>
						</div>
					</div>

					No tienes cuenta en Alfalibros.com?<br />
					<a href="#" data-toggle="modal" data-target="#crear-usuarios-modal">&iexcl;Create una cuenta nueva!</a>
				{!! Form::close() !!}
				@endif
			</div>
		</div>
	</div>
	@include('pagina::partials.side-menu-right')
</div>
@endsection

@push('js')
<script type="text/javascript">
$(function(){
	//$('input[type="checkbox"]', '#form-registrar').val()
	$('#form-registrar').submit(function(e){
		e.preventDefault();

		$.ajax('{{ url("usuarios/registrar") }}', {
			data: $('#form-registrar').serialize(),
			method : 'POST',
			success : function(r) {
				alert(r);
			}
		});
	});
});
</script>
@endpush