<?php 
namespace alfalibros\Modules\Pagina\Http\Controllers;

use DB;

use alfalibros\Modules\Pagina\Http\Controllers\Controller;

use alfalibros\Modules\Pagina\Http\Requests\RegistroRequest;

//Dependencias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
			return 'Para reg&iacute;strate debes Aceptar las condiciones y uso de Alfalibros.com';
		}
		
		$usuario = Usuario::where('usuario', $request->email)->first();
		$persona = Personas::where('email', $request->email)->first();

		if ($persona || $usuario) {
			return 'Ya el correo ' . $request->email . ' se encuentra registrado';
		}
		
		$persona = new Personas();
		$cliente = Clientes::where('account_number', $request->account_number)->first();

		if (!$cliente) {
			$cliente = $persona->cliente;

			if (!$cliente) {
				$cliente = new Clientes();
			}
		}

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
				'account_number'             => $request->account_number,
				'person_id'                  => $persona->person_id,
				'override_default_tax'       => 0,
				'company_name'               => '',
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
			return 'Se gener&oacute; un error al registrar al usuario, int&eacute;ntelo m&aacute;s tarde.';
		}

		DB::commit();
		DB::connection('phppos')->commit();

		return 'Hemos enviado un mensaje para confirmar tu cuenta de Correo Electr&oacute;nico.';
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

	public function direccionNueva(Request $request){
        $usuario = auth()->user();
        $data = $request->all();
        $data['usuario_id'] = $usuario->id;
        $data['nombre_direccion'] = $request->nombre;
        $data['punto_referencia'] = $request->punto_ref;

        $ubicacion = UsuarioDireccion::create($data);
    	$salida = [
    		's' => 'n', 'msj' => 'No se pudo realizar el registro'
    	];
        if($ubicacion){
        	$salida = [
        		's' => 's', 'msj' => 'Se registró correctamente la dirección'
        	];
        }

        return $salida;

    }
}