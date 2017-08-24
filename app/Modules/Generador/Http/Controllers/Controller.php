<?php

namespace alfalibros\Modules\Generador\Http\Controllers;

use Config;
use Storage;
use Illuminate\Filesystem\Filesystem;

use alfalibros\Http\Controllers\Controller as BaseController;

class Controller extends BaseController {
	public $app = 'base';

	protected $patch_js = [
		'public/js',
		'public/plugins',
		'app/Modules/Generador/Assets/js',
	];

	protected $patch_css = [
		'public/css',
		'public/plugins',
		'app/Modules/Generador/Assets/css',
	];

	protected function archivo($modulo, $tipoArchivo, $nombre, $data){
		$gestor = Storage::disk('modules');

		$archivo = $this->nombreArchivo($modulo, $tipoArchivo, $nombre);

		$directorio = substr($archivo, 0, strrpos($archivo, "/"));

		if (!is_dir($directorio)){
			$gestor->makeDirectory($directorio);
			//mkdir($directorio, 0755, true);
		}
		
		if (is_file($archivo)){
			$gestor->delete($archivo);
			//unlink($archivo);
		}

		$contenidoArchivo = $gestor->get('Generador/Resources/plantillas/' . $tipoArchivo . '.stub');
		$contenidoArchivo = $this->stub($contenidoArchivo, $data);
		
		$gestor->put($archivo, $contenidoArchivo);

		//chmod($archivo, 0644);

		return true;
	}

	protected function nombreArchivo($modulo, $tipoArchivo, $nombre = ''){
		$archivo = [$modulo];

		$nombre = $nombre == '' ? $this->nombre : $nombre;
		$_nombre = studly_case($nombre);

		switch ($tipoArchivo) {
			case 'migration':
				array_push($archivo, "Database", "Migrations", $nombre . '.php');
				break;
			case 'controller':
				array_push($archivo, "Http", "Controllers", $_nombre . 'Controller.php');
				break;
			case 'request':
				array_push($archivo, "Http", "Requests", $_nombre . 'Request.php');
				break;
			case 'model':
				array_push($archivo, "Models", $_nombre . '.php');
				break;
			case 'view':
				array_push($archivo, "Resources", "Views", $_nombre . '.blade.php');
				break;
			case 'css':
				array_push($archivo, "Assets", "css", $_nombre . '.css');
				break;
			case 'js':
				array_push($archivo, "Assets", "js", $_nombre . '.js');
				break;
		}

		$archivo = implode(DIRECTORY_SEPARATOR, $archivo);
		return $archivo;
	}

	public function stub($plantilla, $data){
		if (!is_array($data)) return '';
		
		$variables = array_keys($data);
		$datos = array_values($data);
		for ($i = 0, $c = count($variables); $i < $c; $i++) {
			if (is_array($variables[$i])){
				$variables[$i] = json_encode($variables[$i]);
			}

			$variables[$i] = '{{' . trim($variables[$i]) . '}}';
		}

		return str_replace($variables, $datos, $plantilla);
	}
}