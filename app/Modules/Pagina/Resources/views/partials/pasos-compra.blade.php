<?php
$lista = [
    1 => [
        'titulo' => 'Dirección de Envío',
        'subtitulo' => 'Envío',
        'icono'     => 'fa-map-marker'
    ],
    [
        'titulo' => 'Revisar Orden',
        'subtitulo' => 'Revisión',
        'icono'     => 'fa-eye'
    ],
    [
        'titulo' => 'Forma de Pago',
        'subtitulo' => 'Pago',
        'icono'     => 'fa-credit-card'
    ],
    [
        'titulo' => 'Confirmar Orden',
        'subtitulo' => 'Confirmación',
        'icono'     => 'fa-thumbs-o-up'
    ],
];
?>

<div class="portlet light portlet-fit ">
    <div class="portlet-title">
        <div class="caption">
            <i class=" icon-layers font-green"></i>
            <span class="caption-subject font-green bold uppercase">
                {{ $lista[$paso]['titulo'] }}
            </span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="mt-element-step">
            <div class="row step-line">
                @foreach($lista as $key => $elemento)
                <div class="col-md-3 mt-step-col {{ $paso > $key ? 'active' : '' }} {{ $paso == $key ? 'done' : '' }} {{ $key == 1 ? 'first' : '' }} {{ $key == 4 ? 'last' : '' }}">
                    <a href="{{ $paso < $key ? '#' : route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => $key ]) }}">
                        <div class="mt-step-number bg-white"><i class="fa {{ $elemento['icono']}}"></i></div>
                        <div class="mt-step-title uppercase font-grey-cascade">{{ $elemento['titulo'] }}</div>
                        <div class="mt-step-content font-grey-cascade">{{ $elemento['subtitulo'] }}</div>
                    </a>
                </div>
                @endforeach
            </div>
            <br>
            <br>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <button id="cotizacion" type="button" class="btn btn-primary btn-imprimir" style="float: right;">
            <i class="fa fa-print" aria-hidden="true"></i> Ver Cotización
        </button>
        @if($paso == 3)
            <button id="btn-datosBancosModal" type="button" class="btn btn-info" data-dismiss="modal" style="float: right; margin-right: 10px;" data-toggle="modal" data-target="#datosBancosModal">
                <i class="fa fa-info" aria-hidden="true"></i>
                Informaci&oacute;n de Pago
            </button>
        @endif
    </div>
</div>


@push('js')
    <script type="text/javascript">
        $('#cotizacion').click(function(){
        
            url_cotiza = "{{ route('pag.compra.cotizacion', [ 'codigo' => $codigo ]) }}";
            window.open(url_cotiza, '_blank');
        
        });
    </script>
@endpush
