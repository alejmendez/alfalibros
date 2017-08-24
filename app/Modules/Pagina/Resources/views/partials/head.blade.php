	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<meta name="robots" content="NONE,NOARCHIVE" />

	{!! SEO::generate(true) !!}
	
@if (isset($html['css']))
@foreach ($html['css'] as $css)
	<link rel="stylesheet" type="text/css" href="{{ asset($css) }}?v={{ env('APP_VERSION') }}" />
@endforeach
@endif

	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/pagina/style.css') }}?v={{ env('APP_VERSION') }}" />
	<link rel="shortcut icon" type="image/x-icon" href="images/fav.ico" />

	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	@stack('css') 