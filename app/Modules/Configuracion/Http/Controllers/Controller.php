<?php

namespace alfalibros\Modules\Configuracion\Http\Controllers;

use alfalibros\Http\Controllers\Controller as BaseController;

class Controller extends BaseController {
	public $app = 'admin';

	protected $patch_js = [
		'public/js',
		'public/plugins',
		'app/Modules/Configuracion/Assets/js',
	];

	protected $patch_css = [
		'public/css',
		'public/plugins',
		'app/Modules/Configuracion/Assets/css',
	];
}