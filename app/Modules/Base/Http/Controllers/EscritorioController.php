<?php

namespace alfalibros\Modules\Base\Http\Controllers;

use alfalibros\Modules\Base\Http\Controllers\Controller;

class EscritorioController extends Controller {
	public $autenticar = false;

	protected $titulo = 'Escritorio';

	public function __construct() {
		parent::__construct();

		$this->middleware('Authenticate');
	}

	public function getIndex() {
		return $this->view('base::Escritorio');
	}
}