<?php
$controller = app('alfalibros\Modules\Base\Http\Controllers\Controller');
$controller->css[] = 'login.min.css';
$controller->js[] = 'login.js';

$data = $controller->_app();
extract($data);

$html['titulo'] = 'Inicio de Sesión';
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>    <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="es"><!--<![endif]-->
<head>
	@include('base::partials.head')
</head><!--/head-->

	<body class="login">
		<div class="logo">
			<a href="{{ url(\Config::get('admin.prefix')) }}">
				<img src="{{ asset('public/img/logos/' . $controller->conf('login_logo')) }}" alt="Logo" />
			</a>
		</div>
		<div class="content">
			{!! Form::open(array('id' => 'formulario', 'url' => 'login')) !!}
				<h3 class="form-title font-green">{{ Lang::get('login.log_in') }}</h3>

				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">{{ Lang::get('login.user') }}</label>
					{!! Form::text('nombre', '', ['class' => 'form-control form-control-solid placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => Lang::get('login.user')]) !!}
				</div>

				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">{{ Lang::get('login.password') }}</label>
					{!! Form::password('password', ['class' => 'form-control form-control-solid placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => Lang::get('login.password')]) !!}
				</div>

				<label class="rememberme check mt-checkbox mt-checkbox-outline">
					{!! Form::checkbox('recordar', '1', false) !!}
					{{ Lang::get('login.remember_me') }}
					<span></span>
				</label>

				<div class="form-actions" style="text-align: center;">
					{!! Form::button(Lang::get('login.log_in'), ['class' => 'btn green uppercase']) !!}
				</div>
				
				<!-- <div class="login-options">
					<h4>&Oacute; Iniciar sesi&oacute;n como</h4>
					<ul class="social-icons">
						<li>
							<a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
						</li>
						<li>
							<a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
						</li>
						<li>
							<a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
						</li>
						<li>
							<a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
						</li>
					</ul>
				</div> -->

				<div class="create-account">
					<p>{{ date('Y') }} &copy; {{ $controller->conf('nombre_empresa') }}.</p>
				</div>
			{!! Form::close() !!}
		</div>
		
		@include('base::partials.footer')
	</body>
</html>