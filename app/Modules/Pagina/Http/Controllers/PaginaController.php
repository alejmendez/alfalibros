<?php namespace alfalibros\Modules\Pagina\Http\Controllers;

use alfalibros\Modules\Pagina\Http\Controllers\Controller;

//Dependencias
use Illuminate\Support\Facades\Auth;

//Request
use alfalibros\Modules\Base\Http\Requests\LoginRequest;

//Modelos

class PaginaController extends Controller 
{
	public function loginForm()
	{
		return $this->view('pagina::Login');
	}

	public function login(LoginRequest $request)
	{
		$data = [
			'usuario'    => strtolower($request->usuario),
			'password'   => $request->password,
			'confirmado' => 's'
		];
		
		$autenticado = Auth::attempt($data, $request->recordar());
		
		$idregistro = '';
		$login = $data['usuario'];

		if (!$autenticado) {
			$idregistro = 'Clave:' . $data['password'];
		}

		if ($request->ajax()) {
			$salida = ['s' => $autenticado];
			if (!$autenticado) {
				$salida['msj'] = 'Usuario o contraseña incorrectas';
			}
			return $salida;
		}

		$this->setTitulo('Login Incorrecto');
		return $autenticado ? \Redirect::to(\URL::previous()) : $this->view('pagina::ErrorLogin');
	}

	public function salir()
	{
		Auth::logout();
		return redirect('/');
	}
}