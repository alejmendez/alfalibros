<?php

namespace alfalibros\Http\Middleware;

use Closure;

class Permisologia {
	protected $usuario = false;
	protected $ruta = '';

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$this->usuario = \Auth::user();

		if (!$this->permisologia()) {
			if ($request->ajax() || $request->wantsJson()) {
				//abort(403, \Lang::get('backend.without_permission_ajax'));
	            return response(\Lang::get('backend.without_permission_ajax'));
	        } else {
	            return redirect('errors/permiso');
	            /*
	            return view('admin::errors/permiso', [
					'controller' => $this,
					'usuario' => $this->usuario,
					'html' => [
						'titulo' => 'Error',
						'js' => [],
						'css' => [],
					],
				]);
				*/
	        }
		}

		return $next($request);
	}

	protected function ruta() {
		if ($this->ruta != '' && !is_null(\Route::current())) {
			return $this->ruta;
		}

		$this->ruta = \Route::current()->getUri();
		$this->ruta = trim(preg_replace('/\{\w+\?\}/i', '', $this->ruta), '/');

		return $this->ruta;
	}

	protected function permisologia($ruta = '') {
		$usuario = auth()->user();
		if (strtolower($usuario->super) === 's') {
			return true;
		}

		$usuario_permisos = $usuario->permisos();
		
		if ($ruta === '') {
			$ruta = $this->ruta();
		}

		$ruta = preg_replace('/^' . \Config::get('admin.prefix') . '\//i', '', $ruta);
		$ruta = preg_replace('/({.+})+/', '', $ruta);

		$ruta = trim($ruta, '/');
		
		return $usuario_permisos->search($ruta);
	}
}
