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
            <div class="col-xs-12 subtitulo">
                <h4>Datos del producto</h4>
            </div>
        	<div class="form-group col-xs-12">
	        	<label>Aprobar Compra:</label>
	        	<input id="aprobado" name="aprobado" type="checkbox" checked class="make-switch" data-size="large" value="1" />
        	</div>
            {!! $Compras->generate(['sale_id','codigo']) !!}

            <div class="col-xs-12 subtitulo">
                <h4>Datos del cliente</h4>
            </div>
                {!! $Compras->generate(['nombre','cedula','telefono','correo','direccion','nota']) !!}

            <div class="col-xs-12 subtitulo">
                <h4>Datos del pago</h4>
            </div>
                {!! $Compras->generate(['codigo_transferencia','banco_usuario','monto']) !!}

            <div class="form-group col-xs-12" id="soporte">
                <label for="comprobante">Comprobante:</label>
                <br/>
               <a href="#" style="text-decoration: none" id="img-comprobante" target="_blank">
                    <i class="fa fa-file-image-o fa-5x" style="padding:30px;"></i> Comprobante adjunto
                </a>
               
                <input id="comprobante" class="form-control" name="comprobante" type="hidden">
            </div>

            <div class="col-xs-12 subtitulo">
                <h4>Datos de envío</h4>
            </div>
                {!! $Compras->generate(['metodo_envio_id']) !!}
            
                {!! $Envio->generate(['persona_contacto','telefono','estado','ciudad', 'direccion','punto_referencia']) !!}
            
        {!! Form::close() !!}
    </div>
@endsection
