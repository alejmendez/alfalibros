<?php 
namespace alfalibros\Modules\Pagina\Http\Controllers;

use DB;
use Cart;
use Carbon\Carbon;

use alfalibros\Modules\Pagina\Http\Controllers\Controller;

//Dependencias
use Illuminate\Http\Request;

//Modelos
use alfalibros\Modules\Base\Models\Compras;
use alfalibros\Modules\Base\Models\Bancos;
use alfalibros\Modules\Base\Models\MetodoEnvio;
use alfalibros\Modules\Base\Models\UsuarioDireccion;
use alfalibros\Modules\Pagina\Models\Producto;
use alfalibros\Modules\Pagina\Models\Venta;
use alfalibros\Modules\Pagina\Models\VentaDetalle;

class CompraController extends Controller 
{
	protected $paginado = 5;
	
	public $librerias = [
		'components-metronic',
		'jquery-countdown',
		'maskedinput'
	];

	public function ver(Request $request, $codigo = 0, $paso = 1)
	{
		//$productos = $this->productoVendidoQB();
		$usuario = auth()->user();

		$productos          = [];
		$compras            = [];
		$compras_suspendida = [];

		if (!$usuario){
			return redirect('login');
		}

		$dbDefault = \Config::get('database.default');

		$eliminar = Compras::where('created_at', '<', Carbon::now()->subHour())
			->whereNull('bancos_id')
			->where('aprobado', 0)
			->get();
		
		foreach ($eliminar as $elimina) {
			$elimina->delete();
		}

		if (preg_match('/[a-z0-9]{80}/i', $codigo)) {
			$compras    = Compras::where('codigo', $codigo)->first();

			if(!$compras){
				return $this->view('pagina::CompraAnulada', [
					'compra' => $compras,
				]);
			}
			if ($compras->estatus == 0) {
				$venta = Venta::on($dbDefault)->find($compras->sale_id);
				$productos = VentaDetalle::on($dbDefault)->where('sale_id', $compras->sale_id)->get();
			} else {
				$venta = Venta::find($compras->sale_id);
				$productos = VentaDetalle::where('sale_id', $compras->sale_id)->get();
			}

			if ($compras->created_at->addHour()->timestamp < Carbon::now()->timestamp && is_null($compras->bancos_id)){
				return $this->view('pagina::CompraAnulada', [
					'compra' => $compras,
				]);
			}

			if($paso == 3 && $compras->estatus == 0){
				$this->resetearTiempo($codigo);
				$compras    = Compras::where('codigo', $codigo)->first();
			}

			if ($paso == 1){
				$compras->cedula = $compras->cedula != '' ?
					$compras->cedula : 
					$usuario->persona->cliente->account_number;
			}elseif ($paso == 2) {
				$this->css[] = 'pagina/imprimir-cotizacion.css';
			}elseif ($paso == 3) {
				$apartado = $this->apartarArticulo($codigo);
				if ($apartado !== true) {
					return $apartado;
				}
			}
			
			$compras_suspendida = $this->compras_suspendidas($codigo);
			
			if($paso >= 3 && $compras_suspendida >= 1){
				return $this->view('pagina::compra_suspendida', [
					'compras'            => $compras,
					'compras_suspendida' => $compras_suspendida,
					'productos'          => $productos,
				]);
			}
		}else{
			$compras = Compras::where('estatus', 0)->where('usuario_id', $usuario->id)->paginate($this->paginado);
			$compras_suspendida = Compras::where('estatus', 1)->where('usuario_id', $usuario->id)->paginate($this->paginado);

			return $this->view('pagina::VerCompra', [
				'bancos'             => Bancos::all(),
				'compras'            => $compras,
				'compras_suspendida' => $compras_suspendida,
				//'productos'          => $productos,
				'total'              => 0
			]);
		}

		return $this->view('pagina::compra_paso' . $paso, [
			'paso'               => $paso,
			'codigo'             => $codigo,
			'bancos'             => Bancos::all(),
			'compras'            => $compras,
			'compras_suspendida' => $compras_suspendida,
			'productos'          => $productos,
			'total'              => 0
		]);
	}


	public function comprar(Request $request)
	{
		$usuario = auth()->user();
		$carrito = Cart::content();
		
		foreach ($request->carrito as $_carrito) {
			if ($carrito->where('rowId', $_carrito['rowId'])->first()){
				Cart::update($_carrito['rowId'], ['qty' => $_carrito['qty']]);
			}
		}

		$carrito = Cart::content();

		$total = 0;
		$productos_ids = [];
		foreach($carrito as $producto) {
			$total += $producto->qty * $producto->price;
			$productos_ids[] = $producto->id;
		}

		$productos = $this->productoQB()->whereIn('phppos_items.item_id', $productos_ids)->get();
		$errores = [];
		foreach ($productos as $producto) {
			$productoCarrito = $carrito->where('id', $producto->id)->first();
			
			if ($producto->cantidad < $productoCarrito->qty) {
				$nombre = preg_match('/libros/i', $producto->nombre) ? 
							substr($producto->nombre, strrpos($producto->nombre, ',') + 1) : 
							$producto->nombre;
				$errores[] = 'El Libro ' . $nombre . ' no se encuentra en las cantidades solicitadas.';

				if ($productoCarrito->qty <= 1) {
					Cart::remove($productoCarrito->rowId);
				} else {
					Cart::update($productoCarrito->rowId, ['qty' => $producto->cantidad]);
				}
			}
		}

		if (count($errores) > 0) {
			return [
				'errores' => implode("\n", $errores) . "\n" . 'Se realizaron ajustes al carrito de compras'
			];
		}

		DB::beginTransaction();
		DB::connection('phppos')->beginTransaction();
		try {
			$dbDefault = \Config::get('database.default');

			$venta = Venta::on($dbDefault)->create([
				'sale_time'               => Carbon::now(),
				'customer_id'             => $usuario->persona_id,
				'web'                     => 1,
				'employee_id'             => 247, // cambiar por el usuario de venta
				'sold_by_employee_id'     => 247, // cambiar por el usuario de venta
				'comment'                 => '',
				'show_comment_on_receipt' => 1,
				'payment_type'            => 'Transferencia: BsF' . number_format($total, 0, '', '.') . '<br />',
				'cc_ref_no'               => '',
				'auth_code'               => '',
				'deleted'                 => 0,
				'suspended'               => 1,
				'store_account_payment'   => 0,
				'was_layaway'             => 0,
				'was_estimate'            => 0,
				'location_id'             => $this->location_id(),
				'register_id'             => 3, // cambiar por el usuario de venta
				'points_used'             => 0,
				'points_gained'           => 0,
				'did_redeem_discount'     => 0,
				'discount_reason'         => '',
			]);

			$i = 1;
			$productos_ids = [];
			foreach($carrito as $producto) {
				$productos_ids[] = $producto->id;
			}
			$productos = Producto::whereIn('item_id', $productos_ids)->get();

			foreach($carrito as $producto) {
				$line = $i++;

				$_producto = $productos->where('item_id', $producto->id)->first();

				$item = VentaDetalle::on($dbDefault)->create([
					'sale_id'            => $venta->sale_id,
					'item_id'            => $producto->id,
					'description'        => '',
					'serialnumber'       => '',
					'line'               => $line,
					'quantity_purchased' => $producto->qty,
					'item_cost_price'    => $_producto->cost_price,
					'item_unit_price'    => $_producto->unit_price,
					'discount_percent'   => 0,
					'commission'         => 0,
				]);
			}

			$compra = Compras::create([
				"sale_id"              => $venta->sale_id,
				"usuario_id"           => $usuario->id,
				'codigo'               => str_random(80),
				"nombre"               => $usuario->persona->full_name,
				"cedula"               => $usuario->persona->cliente->account_number,
				"telefono"             => $usuario->persona->phone_number,
				"correo"               => $usuario->persona->email,
				"direccion"            => $usuario->persona->address_1,
				"nota"                 => '',
				"codigo_transferencia" => '',
				"banco_usuario"        => '',
				"comprobante"          => '',
				"estatus"              => 0,
				"monto"                => $total
			]); 

			$msj = 'Se cuenta con un limite de <b>60 minutos</b> para realizar la compra (
				Hasta el <b>' . Carbon::now()->addHour()->format('d/m/Y H:i:s') . '</b>), 
				durante este tiempo sus artirulos estaran en una venta suspendida, 
				al finalizar el tiempo sin confirmar su compra los articulos volveran 
				a estar a disposicion de cualquier otro usuario para su compra.<br><br>';

			foreach (Bancos::all() as $banco) {
				/*$msj .= 
					'<b>Banco:</b> '          . $banco->banco . '<br>' .
					'<b>Tipo de cuenta:</b> ' . $banco->tipo_cuenta . '<br>' .
					'<b>Cuenta:</b> '         . $banco->cuenta . '<br>' .
					'<b>Nombre:</b> '         . $banco->nombre . '<br>' .
					'<b>Rif:</b> '            . $banco->cedula . '<br>' .
					'<b>Correo:</b> '         . $banco->correo . '<br><br>';
					*/
			}

			$msj .= 'Al tener el codigo de la transferencia puede hacer el acuse del pago 
			<a href="' . url('compra/confirmar/' . $compra->codigo) . '">aqu&iacute;</a>.';

			$datosCorreo = [
				'usuario' => $usuario,
				'titulos' => [
					'Compra en',
					'AlfaLibros',
					'Falta realizar el pago por la la compra de los articulos.',
				],
				'tituloCuerpo' => 'Datos para realizar la transferencia.',
				'cuerpo' => $msj,
			];

			if ($request->ip() != "::1") {
				
				\Mail::send("pagina::emails.mensaje", $datosCorreo, function($message) use($usuario) {
					$message->from('no_responder@alfalibros.com', 'Alfalibros.com');
					$message->to($usuario->persona->email, $usuario->persona->full_name)
						->subject("Compra en Alfalibros.com");
				});
			}

			Cart::destroy();
		} catch (Exception $e) {
			DB::rollback();
			DB::connection('phppos')->rollback();
			return 'Se generó un error al registrar la compra, inténtelo más tarde.';
		}

		DB::commit();
		DB::connection('phppos')->commit();

		//return 'Hemos enviado un mensaje para confirmar tu cuenta de Correo Electrónico.';
		return [
			'codigo' => $compra->codigo
		];
	}

	public function confirmar(Request $request, $codigo = '')
	{
		DB::beginTransaction();
		DB::connection('phppos')->beginTransaction();
		try {
			$data = $request->all();
			$file = $request->file('image');
			if ($file) {
				$path = public_path('soportes/pagos/');

				$name = str_random(40) . '.' . $file->getClientOriginalExtension();

				$file->move($path, $name);
				$filename = $name;

				chmod($path.'/'.$filename, 0777);
				$data['comprobante'] = $filename;
			}
			
			$compra = Compras::where('codigo', $codigo)->firstOrFail();

			$compra->fill($data)->save();

			$venta = Venta::find($compra->sale_id);
		} catch (Exception $e) {
			DB::rollback();
			DB::connection('phppos')->rollback();

			/*
				TODO: agregar un response con un codigo de error 400
			*/
			return 'Se generó un error al registrar la compra, inténtelo más tarde.';
		}

		DB::commit();
		DB::connection('phppos')->commit();

		return 'Acabas de confirmar tu compra, nuestro personal estará verificando la información, esto puede tardar algunos minutos.';
	}

	public function cancelar(Request $request, $codigo = '')
	{
		DB::beginTransaction();
		DB::connection('phppos')->beginTransaction();
		try {
			$compra = Compras::where('codigo', $codigo)->firstOrFail();
			$compra->delete();
		} catch (Exception $e) {
			DB::rollback();
			DB::connection('phppos')->rollback();
			return 'Se generó un error eliminar la compra, inténtelo más tarde.';
		}

		DB::commit();
		DB::connection('phppos')->commit();
		return redirect('compra/ver');
	}


	public function bancos()
	{
		return Bancos::all()->pluck('banco', 'id');
	}

	public function facturacion(Request $request)
	{
		//$data    =  $request;
		$compras = Compras::where('codigo', $request->codigo)->first();
		$compras->direccion_id    = $request->direccion_id;
		$compras->metodo_envio_id = $request->metodo_envio_id;
		$compras->nombre          = $request->nombre;
		$compras->direccion       = $request->direccion;
		$compras->save();
		

		$salida = [ 's'=> 'n', 'msj' => 'No se pudo realizar la Facturación'];

		if($compras){
			$salida = [ 's'=> 's', 'msj' => 'Facturación guardada'];
		}
		return $salida;
	}

	protected function compras_suspendidas($codigo)
	{
		$usuario = auth()->user();

		return Compras::where('estatus', 1)
			->where('usuario_id', $usuario->id)
			->where('codigo', '!=', $codigo)
			->count() >= 1;
	}

	public function apartarArticulo($codigo)
	{
		$usuario = auth()->user();
		$compra = Compras::where('codigo', $codigo)->firstOrFail();
		/*
		si ya se realizo el pago evitar que el usuario modifique la información colocando div
		if (!is_null($compra->bancos_id)) {
			return abort(404);
		}
		*/

		if ($compra->created_at->addHour()->timestamp < Carbon::now()->timestamp){
			return $this->view('pagina::CompraAnulada', [
				'compra' => $compra,
			]);
		}
		
		$compras_suspendida = Compras::where('estatus', 1)
			->where('usuario_id', $usuario->id)
			->where('codigo', '!=', $codigo)
			->count();

		if ($compras_suspendida >= 1) {
			return abort(404);
		}

		if ($compra->estatus == 0){
			DB::beginTransaction();
			DB::connection('phppos')->beginTransaction();
			try {
				$dbDefault = \Config::get('database.default');

				$venta = Venta::on($dbDefault)->find($compra->sale_id)->toArray();
				$productos = VentaDetalle::on($dbDefault)->where('sale_id', $compra->sale_id)->get();

				unset($venta['sale_id'], $venta['sale_time']);
				$venta['sale_time'] = Carbon::now();

				$venta = Venta::create($venta);
				$errores = [];

				foreach ($productos as $producto) {
					$producto = $producto->toArray();
					$producto['sale_id'] = $venta->sale_id;
					$producto = VentaDetalle::create($producto);
					
					DB::connection('phppos')
						->table('phppos_sales_items_taxes')
						->insert([
							'sale_id'    => $venta->sale_id,
							'item_id'    => $producto['item_id'],
							'line'       => $producto['line'],
							'name'       => 'EXENTO',
							'percent'    => 0,
							'cumulative' => 0,
						]);

					/*
					Restar del inventario
					*/
					$_producto = Producto::find($producto->item_id);

					$cantidad = DB::connection('phppos')
                        ->table('phppos_location_items')
                        ->where('item_id', $producto['item_id'])
                        ->where('location_id', $this->location_id())
						->first();


					if ($cantidad->quantity >= $producto['quantity_purchased']) {
                    	$cantidad = DB::connection('phppos')
							->table('phppos_location_items')
							->where('item_id', $producto['item_id'])
							->where('location_id', $this->location_id())
							->decrement('quantity', $producto['quantity_purchased']);
					} else {
						$errores[] = 'La cantidad de "' .
							$_producto->name . 
							'" solicitada no se encuentra disponible';
					}
				}
				
				if (count($errores) > 0) {
					throw new Exception(implode(', ', $errores) . '.');
				}
				
				$compra->sale_id = $venta->sale_id;
				$compra->estatus = 1;
				$compra->save();
			} catch (Exception $e) {
				DB::rollback();
				DB::connection('phppos')->rollback();
				return $e->getMessage();
			}

			DB::commit();
			DB::connection('phppos')->commit();
		}

		return true;
	}

	public function cotizacion(Request $request, $codigo = 0){
		$usuario = auth()->user();
		
		$productos          = [];
		$compras            = [];
		$compras_suspendida = [];

		if (!$usuario){
			return redirect('login');
		}

		$dbDefault = \Config::get('database.default');

		$eliminar = Compras::where('created_at', '<', Carbon::now()->subHour())
			->whereNull('bancos_id')
			->where('aprobado', 0)
			->get();
		
		foreach ($eliminar as $elimina) {
			$elimina->delete();
		}

		if (preg_match('/[a-z0-9]{80}/i', $codigo)) {
			$compras    = Compras::where('codigo', $codigo)->first();
			$compras_suspendida = Compras::where('estatus', 1)
				->where('usuario_id', $usuario->id)
				->where('codigo', '!=', $codigo)
				->count();

			if(!$compras){
				return $this->view('pagina::CompraAnulada', [
					'compra' => $compras,
				]);
			}
			if ($compras->estatus == 0) {
				$venta = Venta::on($dbDefault)->find($compras->sale_id);
				$productos = VentaDetalle::on($dbDefault)->where('sale_id', $compras->sale_id)->get();
			} else {
				$venta = Venta::find($compras->sale_id);
				$productos = VentaDetalle::where('sale_id', $compras->sale_id)->get();
			}

			if ($compras->created_at->addHour()->timestamp < Carbon::now()->timestamp && is_null($compras->bancos_id)){
				return $this->view('pagina::CompraAnulada', [
					'compra' => $compras,
				]);
			}

		}else{
			$compras = Compras::where('estatus', 0)->where('usuario_id', $usuario->id)->paginate($this->paginado);
			$compras_suspendida = Compras::where('estatus', 1)->where('usuario_id', $usuario->id)->paginate($this->paginado);
		}

		$compras->metodo_envio = MetodoEnvio::where('id', $compras->metodo_envio_id)->first()->nombre;
		$compras->direccion_envio = UsuarioDireccion::where('id', $compras->direccion_id)->first()->direccion;

		return $this->view('pagina::cotizacion', [
			'codigo'             => $codigo,
			'bancos'             => Bancos::all(),
			'compras'            => $compras,
			'compras_suspendida' => $compras_suspendida,
			'productos'          => $productos,
			'total'              => 0
		]);
	}

	public function metodoEnvio(){
		return MetodoEnvio::pluck('nombre', 'id');
	}

	public function resetearTiempo($codigo){
		$compras = Compras::where('codigo', $codigo)->where('estatus', 0)->first();
		$dbDefault = \Config::get('database.default');
		
		if($compras){
			$venta = Venta::on($dbDefault)->find($compras->sale_id);
			
			$compras->created_at =  Carbon::now()->addSecounds(10)->format('Y-m-d H:i:s');
			$compras->estatus = 1;
			$compras->save();

			$venta->update([
				'sale_time' => Carbon::now()->addSecounds(10)->format('Y-m-d H:i:s')
			]);
			
			return true;
		}

		return false;
	}
}