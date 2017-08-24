<?php

namespace alfalibros\Modules\Configuracion\Http\Requests;

use alfalibros\Http\Requests\Request;
 
class ConfiguracionRequest extends Request {
	protected $reglasArr = [
		'nombre'       => [ 'min:3', 'max:100' ], 
		'logo'         => [ 'max:100' ],
		'format_fecha' => [ 'max:100' ],
		'miles'        => [ 'max:100' ],
		'login_logo'   => [ 'max:100' ],
		'email'        => [ 'max:100' ],
		'email_name'   => [ 'max:100' ],
		'email_prueba' => [ 'max:100' ],
		'fecha'        => [ 'max:100' ],
		'warehouse'	   => [ 'min:1' ]
	];
}