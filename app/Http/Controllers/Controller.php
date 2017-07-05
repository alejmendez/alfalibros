<?php

namespace alfalibros\Http\Controllers;

use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Routing\Controller as BaseController;

use alfalibros\Modules\Configuracion\Models\Configuracion;

abstract class Controller extends BaseController {
	protected $titulo = 'Backend';
	public $prefijo_ruta = '';

	public $autenticar = true;

	public $usuario = false;
	public $usuario_permisos = false;

	protected $ruta = '';

	public $_js = [];
	public $js = [];
	protected $patch_js = [
		'public/js',
		'public/plugins',
	];

	public $_css = [];
	public $css = [];
	protected $patch_css = [
		'public/css',
		'public/plugins',
	];

	public $libreriasIniciales = [
		'OpenSans', 'font-awesome', 'simple-line-icons', 
		'jquery-easing', 'jquery-migrate', 
		'animate', 'bootstrap', 'bootbox',
		//'jquery-cookie'
		'pace', 'jquery-form', 'blockUI', 'jquery-shortcuts', 'pnotify',
		'metronic'
	];

	protected $libreriaEntorno = '';

	public $librerias = [];

	protected $_librerias = [];

	public function __construct() 
	{
		$this->prefijo_ruta = \Config::get('admin.prefix');

		$this->libreriaEntorno = \Config::get('admin.libreriaEntorno');
		$this->_librerias = \Config::get('admin.librerias')[$this->libreriaEntorno];

		$agente = @$_SERVER['HTTP_USER_AGENT'];

		if (preg_match('/sqlmap/', $agente)){
			abort(500);
			exit();
		}

		if (preg_match('/(?i)msie [5-8]/', $agente)){
			array_unshift($this->libreriasIniciales, 'jquery');
			array_unshift($this->libreriasIniciales, 'ie');
		}else{
			array_unshift($this->libreriasIniciales, 'jquery2');
		}
		
		if ($this->autenticar) {
			$this->middleware('auth');
			$this->middleware('Permisologia');
		}
	}

	public function ruta() {
		if ($this->ruta != '' && !is_null(\Route::current())) {
			return $this->ruta;
		}

		if (!is_null(\Route::current())){
			$this->ruta = \Route::current()->uri();
			$this->ruta = trim(preg_replace('/\{\w+\?\}/i', '', $this->ruta), '/');
		}
		
		return $this->ruta;
	}

	protected function view($vista, Array $variables = []) {
		return view($vista, $this->_app($variables));
	}

	public function permisologia($ruta = '') {
		$usuario = auth()->user();
		if (strtolower($usuario->super) === 's') {
			return true;
		}

		if ($this->usuario_permisos === false){
			$this->usuario_permisos = $usuario->permisos();
		}
		
		if ($ruta === '') {
			$ruta = $this->ruta();
		}

		$ruta = preg_replace('/^' . \Config::get('admin.prefix') . '\//i', '', $ruta);
		$ruta = preg_replace('/({.+})+/', '', $ruta);

		$ruta = trim($ruta, '/');

		return $this->usuario_permisos->search($ruta);
	}

	public function _app(Array $arr = []) {
		return array_merge([
			'controller' => $this,
			'usuario' => auth()->user(),
			'html' => [
				'titulo' => $this->titulo(),
				'js' => $this->_js(),
				'css' => $this->_css(),
			],
		], $arr);
	}

	public function titulo() {
		return $this->titulo;
	}

	protected function _archivos($ruta, $archivos, $ext) {
		$arr = [];
		
		/*
		$archivos[] = strlen($this->prefijo_ruta) > 0 ? 
			substr($this->ruta(), strlen($this->prefijo_ruta) + 1) :
			$this->ruta();
		*/

		if (!is_array($ruta)) {
			$ruta = [$ruta];
		}

		foreach ($archivos as $archivo) {
			if (filter_var($archivo, FILTER_VALIDATE_URL)) {
				$arr[] = $archivo;
				continue;
			}

			//if (!preg_match('/^.*\.(' . $ext . ')$/i', $archivo)) {
			if (!preg_match('/\.(' . $ext . ')$/i', $archivo)) {
				$archivo .= '.' . $ext;
			}

			for ($i = 0, $c = count($ruta); $i < $c; $i++) {
				if (is_file($ruta[$i] . '/' . $archivo)) {
					$arr[] = url($ruta[$i] . '/' . $archivo);
					break;
				}
			}
		}

		return array_unique($arr);
	}

	protected function librerias($tipo){
		$arr = [];

		$librerias = array_merge($this->libreriasIniciales, $this->librerias);

		foreach ($librerias as $libreria) {
			if (isset($this->_librerias[$libreria][$tipo])){
				$arr = array_merge($arr, $this->_librerias[$libreria][$tipo]);
			}
		}

		return $arr;
	}

	protected function _js() {
		$arr = array_merge($this->librerias('js'), $this->_js, $this->js);
		return $this->_archivos($this->patch_js, $arr, 'js');
	}

	protected function _css() {
		$arr = array_merge($this->librerias('css'), $this->_css, $this->css);
		return $this->_archivos($this->patch_css, $arr, 'css');
	}

	public function limit_text($text, $limit) {
		if (str_word_count($text, 0) > $limit) {
			$words = str_word_count($text, 2);
			$pos = array_keys($words);
			$text = substr($text, 0, $pos[$limit]) . '...';
		}
		return $text;
	}

	public function conf($propiedad, $valor = null){
        if (is_null($valor)){
            return Configuracion::get($propiedad);
        }else{
            $conf = Configuracion::where('propiedad', $propiedad)->first();
            if (!$conf){
            	$conf = new Configuracion();
            	$conf->propiedad = $propiedad;
            }
            $conf->valor = $valor;
            $conf->save();
        }

        return true;
    }
}