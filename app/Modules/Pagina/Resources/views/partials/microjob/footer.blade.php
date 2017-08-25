<footer id="footer">
    <div class="et-pull-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <span class="site-copyright"></span><span class="enginethemes">&copy; {{ date('Y') }} Alfalibros.com - Dise&ntilde;ado y Desarrollo <a href="http://www.tumundoclick.com" target="_blank">Tumundoclick.com</a></span>                
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End Footer-->

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