<?php

namespace alfalibros\Modules\Base\Http\Requests;

use alfalibros\Http\Requests\Request;

class MetodoEnvioRequest extends Request {
	protected $reglasArr = [
		'nombre'         => ['required', 'min:3', 'max:150'],
	];
}
