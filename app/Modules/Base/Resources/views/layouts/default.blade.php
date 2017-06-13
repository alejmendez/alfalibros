<!DOCTYPE html>
<!--[if IE 8]>    <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>    <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="es"><!--<![endif]-->
<head>
	@include('base::partials.head')
</head><!--/head-->

<body class="page-container-bg-solid">
	@include('base::partials.page-header')

	<div class="page-container">
		<div class="page-content-wrapper">
			<div class="page-head">
				<div class="container-fluid">
					<div class="page-title">
						<h1>{{ ucwords($html['titulo']) }}</h1>
					</div>
				</div>
			</div>
			<div class="page-content">
				<div class="container-fluid">
					@yield('content-top')
					@yield('content')
				</div>
			</div>
		</div>
	</div>
	@include('base::partials.page-footer')

	@include('base::partials.footer')
</body>
</html>