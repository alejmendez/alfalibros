<?php

namespace alfalibros\Modules\Pagina\Http\Requests;

use alfalibros\Http\Requests\Request;

class UsuariosDireccionRequest extends Request {
	protected $reglasArr = [
		'nombre_direccion' => ['required', 'max:150'],
		'persona_contacto' => ['max:150'],
		'telefono'         => ['max:20'],
		'estado'           => ['required', 'max:50'],
		'ciudad'           => ['required', 'max:50'],
		'codigo_postal'    => ['required', 'max:50'],
		'direccion'        => ['required'],
		'punto_referencia' => []
	];
}