@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Compras']])

    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Compras.',
        'columnas' => [
            'Codigo PHPPOS' => '10',
			'Nombre' => '18',
			'Cedula' => '18',
			'Codigo Transferencia' => '20',
			'Banco Cliente' => '20',
			'Monto' => '14'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
        	<div class="form-group col-xs-12">
	        	<label>Aprobar Compra:</label>
	        	<input id="aprobado" name="aprobado" type="checkbox" checked class="make-switch" data-size="large" value="1" />
        	</div>

            {!! $Compras->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection