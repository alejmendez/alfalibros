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
use alfalibros\Modules\Pagina\Models\Venta;
use alfalibros\Modules\Pagina\Models\VentaDetalle;

class CarritoController extends Controller 
{
	public $librerias = ['vue','jquery-countdown'];
	public $js = ['carrito.js'];

	public function index()
	{
		$this->setTitulo('Carrito de Compras');
		$usuario = auth()->user();
		if (!$usuario){
			return redirect('login');
		}
		
		$cantidad_compras = Compras::where('usuario_id', $usuario->id)->count();
		
		return $this->view('pagina::Carrito', [
			'cantidad_compras' => $cantidad_compras
		]);
	}

	public function agregar(Request $request, $id)
	{
		$producto = $this->productoQB()->where('phppos_items.item_id', $id)->first();

		$cantidad = intval($request->cantidad);

		if (!$producto) {
			return '0';
		}

		$producto->cantidad = intval($producto->cantidad);
		if ($cantidad <= 0) {
			return \Response::json('No ha introducido ninguna cantidad de artículos, por favor verifique.', 400);
		}

		if ($cantidad > $producto->cantidad) {
			return \Response::json('No puede agregar más de ' . $producto->cantidad . ' artículos al carrito.', 400);
		}

		$producto->nombre = preg_match('/libros/i', $producto->nombre) ? 
					substr($producto->nombre, strrpos($producto->nombre, ',') + 1) : 
					$producto->nombre;
					
		Cart::add([
			'id'      => $producto->id, 
			'name'    => $producto->nombre, 
			'qty'     => $cantidad, 
			'price'   => $producto->precio, 
			'options' => [
				'descripcion' => $producto->descripcion,
				'imagen'      => $producto->imagen,
				'cantidad'    => $producto->cantidad,
				'costo'       => $producto->costo
			]
		]);

		return Cart::content();
	}

	public function eliminar($id)
	{
		$carrito = Cart::content();

		if (preg_match('/^[a-f0-9]{32}$/', $id)){
			if (isset($carrito[$id])){
				Cart::remove($id);
			}
		} else {
			$producto = $carrito->where('id', $id)->first();

			if ($producto){
				Cart::remove($producto->rowId);
			}else{
				return abort(404);
			}
		}
		
		return Cart::content()->values();
	}

	public function carrito(Request $request)
	{
		$carrito = Cart::content();
		if (!$request->carrito) {
			return [
				'errores' => '',
				'carrito' => Cart::content()->values()
			];
		}

		foreach($carrito as $producto) {
			$productos_ids[] = $producto->id;
		}
		foreach($request->carrito as $producto) {
			$productos_ids[] = $producto['id'];
		}
		
		$productos_ids = array_unique($productos_ids);

		$productos = $this->productoQB()->whereIn('phppos_items.item_id', $productos_ids)->get();
		$errores = [];

		foreach($request->carrito as $carritoTabla){
			$_cart = $carrito->where('rowId', $carritoTabla['rowId'])->first();
			$_cartDB = $productos->where('id', $carritoTabla['id'])->first();

			if ($_cart && $_cartDB) {
				if ($_cartDB->cantidad < $carritoTabla['qty']){
					$nombre = preg_match('/libros/i', $_cartDB->nombre) ? 
								substr($_cartDB->nombre, strrpos($_cartDB->nombre, ',') + 1) : 
								$_cartDB->nombre;
					$errores[] = 'El Libro ' . $nombre . ' no se encuentra en las cantidades solicitadas.';
					Cart::update($carritoTabla['rowId'], ['qty' => intval($_cartDB->cantidad)]);
				}else{
					Cart::update($carritoTabla['rowId'], ['qty' => intval($carritoTabla['qty'])]);
				}
			}
		}

		$salida = [
			'errores' => '',
			'carrito' => Cart::content()->values()
		];

		if (count($errores) > 0){
			$salida['errores'] = implode("\n", $errores) . "\n" . 'Se realizaron ajustes al carrito de compras';
		}

		return $salida;
	}

	public function vaciar(Request $request)
	{
		Cart::destroy();
		return back();
	}
}