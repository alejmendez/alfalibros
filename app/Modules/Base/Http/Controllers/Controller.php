<?php

namespace alfalibros\Modules\Base\Http\Controllers;

use alfalibros\Http\Controllers\Controller as BaseController;

class Controller extends BaseController {
	public $app = 'Base';

	protected $patch_js = [
		'public/js',
		'public/plugins',
		'app/Modules/Base/Assets/js',
	];

	protected $patch_css = [
		'public/css',
		'public/plugins',
		'app/Modules/Base/Assets/css',
	];
}