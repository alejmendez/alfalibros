<script type="text/javascript">
	var $url = "{{ URL::current() }}/",
		$urlApp = "{{ env('APP_URL') }}/",
		sessionLife = {{ \Config::get('session.lifetime') }};
</script>
	
@if (isset($html['js']))
@foreach ($html['js'] as $js)
	<script type="text/javascript" src="{{ asset($js) }}?v={{ env('APP_VERSION') }}"></script>
@endforeach
@endif

	
<script type="text/javascript" src="{{ asset('public/js/pagina/init.js') }}?v={{ env('APP_VERSION') }}"></script>

@stack('js')