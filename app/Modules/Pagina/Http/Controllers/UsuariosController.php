<?php 
namespace alfalibros\Modules\Pagina\Http\Controllers;

use DB;

use alfalibros\Modules\Pagina\Http\Controllers\Controller;

//Dependencias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Requests
use alfalibros\Modules\Pagina\Http\Requests\RegistroRequest;
use alfalibros\Modules\Pagina\Http\Requests\UsuariosDireccionRequest;

//Modelos
use alfalibros\Modules\Base\Models\Usuario;
use alfalibros\Modules\Base\Models\Personas;
use alfalibros\Modules\Base\Models\Clientes;
use alfalibros\Modules\Base\Models\UsuarioDireccion;

class UsuariosController extends Controller 
{
	public function usuarios()
	{
		$this->setTitulo('Creación de Usuario');
		return $this->view('pagina::Usuarios');
	}


	public function recuperar(Request $request)
	{
		if ($request->isMethod('post')){
			$request->email = strtolower($request->email);

			$usuario = Usuario::where('usuario', $request->email)->first();

			if (!$usuario){
				$persona = Personas::where('email', $request->email)->first();

				if ($persona) {
					$usuario = Usuario::create([
						'usuario'    => $request->email,
						'password'   => $request->password,
						'perfil_id'  => 7,
						'persona_id' => $persona->person_id,
						'super'      => 'n',
						'confirmado' => 's',
						'codigo'     => str_random(50)
					]);
				} else {
					return ['s' => false, 'msj' => 'No existe ningun usuario con este correo electronico.'];
				}
			}

			$token = str_random(80);

			DB::table('password_resets')->insert([
				'email'      => $usuario->usuario, 
				'token'      => $token,
				'created_at' => date('Y-m-d H:i:s')
			]);

			\Mail::send("pagina::emails.recovery", ['usuario' => $usuario, 'token' => $token], function($message) use($usuario) {
				$message->from('no_responder@alfalibros.com', 'Alfalibros.com');
				$message->to($usuario->usuario, $usuario->nombre)
					->subject("Recupera tu contraseña de Alfalibros!");
			});

			return ['s' => true, 'msj' => 'Se envio un correo electronico con las instrucciones para restaurar su contraseña.'];
		}

		$this->setTitulo('Recuperar Clave de Usuario');
		return $this->view('pagina::UsuariosRecuperarClave');
	}

	public function recuperar_clave(Request $request, $token) {
		if ($request->isMethod('post')){
			$data = DB::table('password_resets')->where('token', $token)->first();
			if (!$data){
				return ['s' => false, 'msj' => "Error de token"];
			}
			
			$usuario = Usuario::where('usuario', $data->email)->first();
			$usuario->password = $request->password;
			$usuario->save();

			DB::table('password_resets')->where('token', $token)->delete();

			return ['s' => true, 'msj' => "Se ha realizado el cambio de contraseña"];
		}

		$data = DB::table('password_resets')->select('email')->where('token', $token)->first();
		
		if (!$data){
			return redirect('/');
		}

		$usuario = Usuario::where('usuario', $data->email)->first();

		return $this->view('pagina::Recuperacion', [
			'usuario' => $usuario,
			'token' => $token
		]);
	}

	public function registrado()
	{
		$this->setTitulo('graciasRegistro');
		return $this->view('pagina::graciasRegistro');
	}
	
	public function recuperar_usuario()
	{
		$this->setTitulo('Recuperar Login de Usuario');
		return $this->view('pagina::UsuariosRecuperarUsuario');
	}

	public function registrar(RegistroRequest $request)
	{
		$request->email = strtolower($request->email);
		$request->account_number = strtoupper($request->account_number);
		if ($request->aceptar != 1) {
			return response()->json([
				'error' => 1,
				'msj' => 'Para reg&iacute;strate debes Aceptar las condiciones y uso de Alfalibros.com'
			], 400);
		}
		
		$usuario = Usuario::where('usuario', $request->email)->first();
		$persona = Personas::where('email', $request->email)->first();

		if ($persona || $usuario) {
			return response()->json([
				'error' => 2,
				'url' => route('pag.usuarios.recuperar.clave'),
				'msj' => 'Su correo ya se encuentra registrado con nosotros, ' .
							'es posible que haya comprado en alguna de nuestras ' .
							'tiendas, para poder acceder debe recuperar la contraseña.'
			], 400);
		}
		
		$persona = new Personas();
		$cliente = new Clientes();
		/*
		$cliente = Clientes::where('account_number', $request->account_number)->first();

		if (!$cliente) {
			$cliente = $persona->cliente;

			if (!$cliente) {
				$cliente = new Clientes();
			}
		}
		*/

		DB::beginTransaction();
		DB::connection('phppos')->beginTransaction();
		try {
			$persona->fill([
				'email'        => $request->email,
				'first_name'   => $request->first_name,
				'last_name'    => $request->last_name,
				'full_name'    => $request->first_name . ' ' . $request->last_name,
				'phone_number' => $request->phone_number,
				'address_1'    => '',
				'address_2'    => '',
				'comments'     => '',
				'city'         => '',
				'state'        => '',
				'zip'          => '',
				'country'      => ''
			]);

			$persona->save();

			$dataCliente = [
				//'account_number'             => $request->account_number,
				'person_id'                  => $persona->person_id,
				'override_default_tax'       => 0,
				'company_name'               => $request->account_number,
				'balance'                    => 0,
				'points'                     => 0,
				'current_spend_for_points'   => 0,
				'current_sales_for_discount' => 0,
				'taxable'                    => 1,
				'card_issuer'                => '',
			];

			if ($persona->person_id == $cliente->person_id) {
				//unset($dataCliente['person_id']);
			}

			$cliente->fill($dataCliente);

			$cliente->save();
			
			$usuario = Usuario::create([
				'usuario'    => $request->email,
				'password'   => $request->password,
				'perfil_id'  => 7,
				'persona_id' => $persona->person_id,
				'super'      => 'n',
				'confirmado' => 's',
				'codigo'     => str_random(50)
			]);

			/*\Mail::send("pagina::emails.bienvenido", ['usuario' => $usuario], function($message) use($usuario, $request) {
				$message->from('no_responder@alfalibros.com', 'Alfalibros.com');
				$message->to($request->email, $request->first_name . ' ' . $request->last_name)
					->subject("Bienvenido a Alfalibros.com");
			});*/
		} catch (Exception $e) {
			DB::rollback();
			DB::connection('phppos')->rollback();
			return response()->json([
				'error' => 3,
				'msj' => 'Se gener&oacute; un error al registrar al usuario, int&eacute;ntelo m&aacute;s tarde.'
			], 400);
		}

		DB::commit();
		DB::connection('phppos')->commit();

		if($request->ajax()){
			return [
				's' => 's',
				'msj' => 'Usuario registrado satisfactorimente'
			];
		} else {
			return $this->view('pagina::graciasRegistro');
		}
		//return 'Hemos enviado un mensaje para confirmar tu cuenta de Correo Electr&oacute;nico.';
	}

	public function confirmar($codigo)
	{
		$this->setTitulo('Confirmar Usuario');
		try {
			$usuario = Usuario::where('codigo', $codigo)
				->where('confirmado', 'n')
				->first();
				
			if (!$usuario){
				return redirect('/');
			}

			$usuario->confirmado = 's';
			$usuario->save();
		} catch (Exception $e) {
			DB::rollback();
			return 'Se generó un error al registrar al usuario, inténtelo más tarde.';
		}

		Auth::login($usuario);
		
		return $this->view('pagina::Confirmacion');
	}

	public function direccionGuardar(UsuariosDireccionRequest $request, $id = null)
	{
		$usuario = auth()->user();
		$data = $request->all();

        $data['usuario_id'] = $usuario->id;

		DB::beginTransaction();
        try{
            $ubicacion = is_null($id) ? new UsuarioDireccion() : UsuarioDireccion::find($id);
			if (is_null($id)) {
            	$ubicacion = new UsuarioDireccion();
				$cliente = Clientes::create([
					//'account_number'             => $request->account_number,
					'person_id'                  => $usuario->persona->person_id,
					'override_default_tax'       => 0,
					'company_name'               => $request->persona_cedula,
					'balance'                    => 0,
					'points'                     => 0,
					'current_spend_for_points'   => 0,
					'current_sales_for_discount' => 0,
					'taxable'                    => 1,
					'card_issuer'                => '',
				]);
			} else {
            	$ubicacion = UsuarioDireccion::find($id);
				$cliente = Clientes::find($ubicacion->customer_id);

				$cliente->company_name = $request->persona_cedula;
				$cliente->save(); 
			}
			
			$ubicacion->usuario_id       = $usuario->id;
			$ubicacion->customer_id      = $cliente->id;
			
			$ubicacion->nombre_direccion = $request->nombre_direccion;
			$ubicacion->persona_contacto = $request->persona_contacto;
			$ubicacion->persona_cedula   = $request->persona_cedula;
			$ubicacion->telefono         = $request->telefono;
			$ubicacion->estado           = $request->estado;
			$ubicacion->municipio        = $request->municipio;
			$ubicacion->parroquia        = $request->parroquia;
			$ubicacion->sector           = $request->sector;
			$ubicacion->ciudad           = $request->ciudad;
			$ubicacion->codigo_postal    = $request->codigo_postal;
			$ubicacion->direccion        = $request->direccion;
			$ubicacion->punto_referencia = $request->punto_referencia;

            $ubicacion->save();
        } catch(QueryException $e) {
            DB::rollback();
            return [ 's' => 'n', 'msj' => 'No se pudo guardar la dirección' ];
        } catch(Exception $e) {
            DB::rollback();
            return [ 's' => 'n', 'msj' => 'No se pudo guardar la dirección' ];
        }
        DB::commit();

		return [
			'id'      => $ubicacion->id,
			'nombre'  => $ubicacion->nombre_direccion,
			's'       => 's', 
			'msj'     => 'Se registró correctamente la dirección'
		];
    }

	public function direccionBuscar(Request $request, $id)
	{
        $UsuarioDireccion = UsuarioDireccion::find($id);

        if ($UsuarioDireccion) {
            return array_merge($UsuarioDireccion->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
	}

	public function direccionEliminar(Request $request, $id = null)
	{
		try{
            UsuarioDireccion::destroy($id);
        } catch (QueryException $e) {
            return [ 's' => 'n', 'msj' => 'No se pudo eliminar la dirección' ];
        } catch (Exception $e) {
            return [ 's' => 'n', 'msj' => 'No se pudo eliminar la dirección' ];
        }

        return ['s' => 's', 'msj' => trans('controller.eliminar')];
	}
}