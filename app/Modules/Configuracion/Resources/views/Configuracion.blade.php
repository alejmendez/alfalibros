@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['General', 'Configuración']])
@endsection

@section('content')
<form id="formulario" name="formulario" enctype="multipart/form-data" role="form" autocomplete="off">
	<div class="row">
		<h2>General</h2>

		{{ Form::bsText('nombre', $controller->conf('nombre'), [
			'name'			=> 'conf[nombre]',
			'label'     	=> 'Nombre de la Aplicación:',
			'placeholder'   => 'Nombre de la Aplicación'
		]) }}

		{{ Form::bsText('nombre_empresa', $controller->conf('nombre_empresa'), [
			'name'			=> 'conf[nombre_empresa]',
			'label'     	=> 'Nombre de la Empresa:',
			'placeholder'   => 'Nombre de la Empresa'
		]) }}

		{{ Form::bsSelect('formato_fecha', [
			'd/m/Y' 		=> 'd/m/Y',
			'd-m-Y' 		=> 'd-m-Y',
			'Y-m-d' 		=> 'Y-m-d',
			'Y/m/d' 		=> 'Y/m/d',
			'D, dd M Y' 	=> 'D, dd M Y',
			'D, d M y' 		=> 'D, d M y',
			'DD, dd-M-y' 	=> 'DD, dd-M-y',
			'D, d M y' 		=> 'D, d M y',
		], $controller->conf('formato_fecha'), [
			'name'			=> 'conf[formato_fecha]',
			'label'     	=> 'Formato de Fecha:',
			'placeholder'   => 'Formato de Fecha'
		]) }}

		{{ Form::bsSelect('miles', [
			',' => ',',
			'.' => '.',
		], $controller->conf('miles'), [
			'name'			=> 'conf[miles]',
			'label'     	=> 'Separador de miles:'
		]) }}
	</div>
	<div class="row">
		<h2>Imagenes</h2>

		<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<label for="miles">Imagen de Aplicaci&oacute;n</label>
			
			<div id="log" class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;">
				<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;">
					<img id="cargar_logo" class="img-responsive" style="width: 100%;" src="{{ url('public/img/logos/' . $controller->conf('logo')) }}" />
				</div>
				<div>
					<span class="btn btn-default btn-file">
						<span class="fileinput-new" >Seleccionar Imagen</span>
						<span class="fileinput-exists">Cambiar</span>
						<input type="file" name="logo" id="upload">
					</span>
					<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" >Eliminar</a>
				</div>
			 </div>
		</div> 

		<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<label for="miles">Imagen de login</label>
			<div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;">
				<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;">
					<img id="cargar_logo" class="img-responsive" style="width: 100%;" src="{{ url('public/img/logos/' . $controller->conf('login_logo')) }}" />
				</div>
				<div>
					<span class="btn btn-default btn-file">
						<span class="fileinput-new">Seleccionar Imagen</span>
						<span class="fileinput-exists">Cambiar</span>
						<input type="file" name="login_logo" id="login_upload">
					</span>
					<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<h2>Email</h2>

		{{ Form::bsText('email',$controller->conf('email'), [
			'label'     	=> 'Email:',
			'placeholder'   => 'Formato de Fecha',
			'name'			=> 'conf[email]',
		]) }}

		{{ Form::bsText('email_name',$controller->conf('email_name'), [
			'label'     	=> 'Nombre remitente:',
			'placeholder'   => 'Nombre del remitente en los correos',
			'name'			=> 'conf[email_name]',
		]) }}

		{{ Form::bsText('email_prueba',$controller->conf('email_prueba'), [
			'label'     	=> 'Prueba:',
			'placeholder'   => 'Enviar un mensaje de prueba a...'
		]) }}
	</div>
</form>
@endsection