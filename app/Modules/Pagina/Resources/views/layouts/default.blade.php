<!DOCTYPE html>
<!--[if IE 8]>    <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>    <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="es"><!--<![endif]-->
<head>
	@include('pagina::partials.head')
</head>

<body>
	@include('pagina::partials.page-header')

	<div class="container">
		@yield('content')
	</div>
	
	<hr />
	@if (!$autenticado)
	@include('pagina::partials.login')
	@include('pagina::partials.crear_usuarios')
	@endif
	
	@include('pagina::partials.page-footer')

	@include('pagina::partials.footer')
</body>
</html>