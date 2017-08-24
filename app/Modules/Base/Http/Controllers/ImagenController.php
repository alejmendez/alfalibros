<?php

namespace alfalibros\Modules\Base\Http\Controllers;

use Illuminate\Http\Request;

use alfalibros\Modules\Base\Http\Controllers\Controller;

use Image;

class ImagenController extends Controller {
	public $autenticar = false;
	
	protected $tamano = [
		'small' 	=> [120, 90],
		'medium' 	=> [240, 180],
		'large' 	=> [480, 360]
	];

	public function getIndex(){
		abort(404);
	}

	protected function src($request){
		$src = $request->path();
		//$src = substr($src, strpos($src, '/') + 1);
		//$src = substr($src, strpos($src, '/') + 1);

		return $src;
	}
	
	// http://localhost/app/public/img/logos/login_logo.png
	// http://localhost/app/public/img/logos/large/login_logo.png
	// /{dir?}/{tam}/{arch}

	public function public_img(Request $request, $dir, $tam, $arch){
		$src = "img/$dir/$arch";
		
		if (!preg_match('/[A-Z0-9\/\.\-\_]+/i', $src)){
			abort(404);
		}
		
		$_src = $src;

		$src = 'public/' . $src;
		if (!is_file($src)){
			abort(404);
		}


		$ruta = "img/$dir/$tam/$arch";
		$ruta = substr($ruta, 0, strrpos($ruta, '/'));
		
		if (!is_dir($ruta)){
			mkdir($ruta, 0777, true);
		}

		if (!isset($this->tamano[$tam])) {
			if (preg_match('/\d{1,4}x\d{1,4}/', $tam)) {
				$this->tamano[$tam] = explode('x', $tam);
			}
		}
		
		if ($tam == 'original') {
			$tam = false;
		}
		//dd($src, $ruta);
		$image = Image::make($src);

		if ($tam !== false){
			$image = $image->resize(
				$this->tamano[$tam][0], 
				$this->tamano[$tam][1], 
				function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				}
			);
		}
		
		$image->save("img/$dir/$tam/$arch");
		return $image->response();
	}
}