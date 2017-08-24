<?php

namespace alfalibros\Modules\Base\Http\Requests;

use alfalibros\Http\Requests\Request;

class PerfilesRequest extends Request {
	protected $reglasArr = [
		'nombre' => ['required', 'nombre', 'min:3', 'max:50'],
	];
}