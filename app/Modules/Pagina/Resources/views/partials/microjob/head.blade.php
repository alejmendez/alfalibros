	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 ,user-scalable=no">

	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<meta name="robots" content="NONE,NOARCHIVE" />

	{!! SEO::generate(true) !!}

	<!--[if lt IE 9]>
        <script src="https://microjobengine.enginethemes.com/../assets/themes/microjobengine/includes/aecore/assets/js/html5.js"></script>
    <![endif]-->  

	
	
@if (isset($html['css']))
@foreach ($html['css'] as $css)
	<link rel="stylesheet" type="text/css" href="{{ asset($css) }}?v={{ env('APP_VERSION') }}" />
@endforeach
@endif

	<script type="text/javascript">
		window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.2.1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.2.1\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/microjobengine.enginethemes.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.7.5"}};
		!function(a,b,c){function d(a){var b,c,d,e,f=String.fromCharCode;if(!k||!k.fillText)return!1;switch(k.clearRect(0,0,j.width,j.height),k.textBaseline="top",k.font="600 32px Arial",a){case"flag":return k.fillText(f(55356,56826,55356,56819),0,0),!(j.toDataURL().length<3e3)&&(k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,57331,65039,8205,55356,57096),0,0),b=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,57331,55356,57096),0,0),c=j.toDataURL(),b!==c);case"emoji4":return k.fillText(f(55357,56425,55356,57341,8205,55357,56507),0,0),d=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55357,56425,55356,57341,55357,56507),0,0),e=j.toDataURL(),d!==e}return!1}function e(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g,h,i,j=b.createElement("canvas"),k=j.getContext&&j.getContext("2d");for(i=Array("flag","emoji4"),c.supports={everything:!0,everythingExceptFlag:!0},h=0;h<i.length;h++)c.supports[i[h]]=d(i[h]),c.supports.everything=c.supports.everything&&c.supports[i[h]],"flag"!==i[h]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[i[h]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
	</script>

	<style type="text/css">
		img.wp-smiley,
		img.emoji {
			display: inline !important;
			border: none !important;
			box-shadow: none !important;
			height: 1em !important;
			width: 1em !important;
			margin: 0 .07em !important;
			vertical-align: -0.1em !important;
			background: none !important;
			padding: 0 !important;
		}
	</style>
	
	<script type="text/javascript" href="{{ url('public/plugins/microjobengine/assets/js/lib/jquerydetecttimezone9e1e.js')}}?v={{ env('APP_VERSION') }}"></script>

	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/pagina/style.css') }}?v={{ env('APP_VERSION') }}" />
	<link rel="shortcut icon" type="image/x-icon" href="images/fav.ico" />


	<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="https://microjobengine.enginethemes.com/../assets/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen"><![endif]--><!--[if IE  8]><link rel="stylesheet" type="text/css" href="https://microjobengine.enginethemes.com/../assets/plugins/js_composer/assets/css/vc-ie8.min.css" media="screen"><![endif]-->
	<noscript>
		<style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style>
	</noscript>

	@stack('css') 