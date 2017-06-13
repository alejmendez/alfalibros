	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<meta name="robots" content="NONE,NOARCHIVE" />

	<title>{{ ucwords($html['titulo']) }}</title>

@if (isset($html['css']))
@foreach ($html['css'] as $css)
	<link rel="stylesheet" type="text/css" href="{{ url($css) }}?v={{ env('APP_VERSION') }}" />
@endforeach
@endif
	
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/img/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" href="{{ url('public/img/favicon/favicon-32x32.png') }}" sizes="32x32">
	<link rel="icon" type="image/png" href="{{ url('public/img/favicon/favicon-16x16.png') }}" sizes="16x16">
	<link rel="manifest" href="{{ url('public/img/favicon/manifest.json') }}">
	<link rel="mask-icon" href="{{ url('public/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	@stack('css') 