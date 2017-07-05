@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Métodos de envio']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Métodos de envío.',
        'columnas' => [
            'Nombre' => '100',
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $MetodoEnvio->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection