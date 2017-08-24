<?php

namespace alfalibros\Modules\Base\Http\Requests;

use alfalibros\Http\Requests\Request;

class ComprasRequest extends Request {
	protected $reglasArr = [
		'aprobado' => ['required'],
	];
}
