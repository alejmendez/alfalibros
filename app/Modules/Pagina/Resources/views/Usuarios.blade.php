@extends('pagina::layouts.default')
@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		<h3 class="col-sm-12">Formulario de Registro de Nuevos Usuarios</h3>
		{!! Form::open([
			'url'            => 'usuarios/registrar', 
			'accept-charset' => 'UTF-8',
			'class'          => 'form',
			'id'             => 'login-form',
			'method'         => 'post',
			'name'           => 'login-form',
			'role'           => 'form',
		]) !!}
			<div class="row">
			{!! Form::bsText('usuario', '', [
				'label'       => 'Usuario',
				'placeholder' => 'Usuario',
				'title'       => 'Usuario',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}

			{!! Form::bsText('first_name', '', [
				'label'       => 'Nombre',
				'placeholder' => 'Nombre',
				'title'       => 'Nombre',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}

			</div>
			<div class="row">

			{!! Form::bsText('last_name', '', [
				'label'       => 'Apellido',
				'placeholder' => 'Apellido',
				'title'       => 'Apellido',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}
		
			<div class="form-group col-sm-6">
				<label for="cedula_input" class="requerido">C&eacute;dula o Rif</label>
				<input id="cedula" nombre="cedula" type="hidden" value="" />
				
				<div class="input-group">
					<div class="input-group-btn">
						<button id="nacionalidad" type="button" class="btn green dropdown-toggle" data-toggle="dropdown">
							<span>V</span>
							<i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu">
							@foreach(['V', 'E', 'J', 'G'] as $nacionalidad)
							<li>
								<a href="javascript:nacionalidad('{{ $nacionalidad }}');"> {{ $nacionalidad }} </a>
							</li>
							@endforeach
						</ul>
					</div>
					<input id="cedula_input" class="cedula form-control" 
						required type="text" value="" 
						data-toggle="tooltip"
						title="RIF/C.I del Cliente ejemplo: V15467845, J854575640, E8897547" />
				</div>
			</div>

			</div>
			<div class="row">
			
			{!! Form::bsText('email', '', [
				'label'       => 'Correo Electronico',
				'placeholder' => 'Ejm: usuario@gmail.com',
				'title'       => 'Ejm: usuario@gmail.com',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}

			{!! Form::bsText('phone_number', '', [
				'label'       => 'Numero de Telefono',
				'placeholder' => 'Ejm: 0414-890-9876',
				'title'       => 'Ejm: 0414-890-9876',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}
			
			</div>
			<div class="row">

			{!! Form::bsTextarea('address_1', '', [
				'label'       => 'Dirección',
				'placeholder' => '',
				'title'       => 'Dirección',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-12'
			]) !!}
			
			</div>
			<div class="row">
			
			{!! Form::bsText('country', '', [
				'label'       => 'Pais',
				'placeholder' => 'Pais',
				'title'       => 'Pais',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}

			{!! Form::bsText('state', '', [
				'label'       => 'Estado',
				'placeholder' => 'Estado',
				'title'       => 'Estado',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}
			
			</div>
			<div class="row">

			{!! Form::bsText('city', '', [
				'label'       => 'Ciudad',
				'placeholder' => 'Ciudad',
				'title'       => 'Ciudad',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}

			{!! Form::bsText('zip', '', [
				'label'       => 'Codigo Postal',
				'placeholder' => 'Codigo Postal',
				'title'       => 'Codigo Postal',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}
			
			</div>
			<div class="row">

			{!! Form::bsPassword('password', '', [
				'label'       => 'Contraseña',
				'placeholder' => 'Contraseña',
				'title'       => 'Contraseña',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'help'        => 'La Contraseña debe contener al menos un letra en Mayuscula, una letra en Minuscula, al menos un numero y 8 caracteres.',
				'class_cont'  => 'col-sm-6'
			]) !!}

			{!! Form::bsPassword('password_confirmation', '', [
				'label'       => 'Repetir Contraseña',
				'placeholder' => 'Repetir Contraseña',
				'title'       => 'Repetir Contraseña',
				'required'    => 'required',
				'data-toggle' => 'tooltip',
				'class_cont'  => 'col-sm-6'
			]) !!}
			
			</div>

			<div class="col-sm-12" style="margin-top: 20px">
				<label for="aceptar">
					<input id="aceptar" name="aceptar" type="checkbox" value="1" /> 
					Estoy de acuerdo con las condiciones y uso de 
					<a href="{{ url('legal') }}" target="_blank">alfalibros.com</a>
				</label>
			</div>

			<div class="col-sm-12 text-center" style="margin-top: 40px">
				<button type="submit" class="btn btn-primary">Registrame!</button>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(function(){
	$.mask.definitions['R']='[JGVEjgve]';
	$(".cedula").mask("999999?999");

	$('#cedula_input').on('blur',function(){
		nacionalidad($("#nacionalidad span").text());
	});
});

function nacionalidad(nac){
	nac = nac || $("#nacionalidad span").text();
	$("#nacionalidad span").text(nac);
	$("#cedula").val(nac + $("#cedula_input").val());
}
</script>
@endpush