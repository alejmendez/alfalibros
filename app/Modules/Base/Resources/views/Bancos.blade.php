@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Bancos']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Bancos.',
        'columnas' => [
            'Banco' => '16.666666666667',
		'Tipo Cuenta' => '16.666666666667',
		'Cuenta' => '16.666666666667',
		'Nombre' => '16.666666666667',
		'Cedula' => '16.666666666667',
		'Correo' => '16.666666666667'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Bancos->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection