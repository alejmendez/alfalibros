<?php

namespace alfalibros\Modules\Generador\Http\Requests;

use alfalibros\Http\Requests\Request;

class TablesRequest extends Request {
	protected $reglasArr = [
		'modulo'		=> ['required', 'min:3'],
		'nombre'		=> ['regex:/^[a-zA-Z_]+$/', 'min:3'],
		'name.*'		=> ['required', 'regex:/^[a-zA-Z_]+$/', 'min:2'],
		'type.*'		=> ['required', 'min:3'],
		'length.*'		=> [],
		'default.*'		=> [],
		'null.*'		=> [],
		'unique.*'		=> [],
	];
}