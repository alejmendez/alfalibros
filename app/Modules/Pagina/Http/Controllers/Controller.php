<?php namespace alfalibros\Modules\Pagina\Http\Controllers;

use DB;
use Cart;
use SEO;
use SEOMeta;

use Illuminate\Support\Facades\Auth;

use alfalibros\Http\Controllers\Controller as BaseController;

use alfalibros\Modules\Pagina\Model\Producto;

class Controller extends BaseController
{
	public $app = 'Pagina';
	
	public $titulo = 'Alfalibros';

	public $autenticar = false;
	public $paginar = 12;
	public $urlphppos = 12;

	protected $patch_js = [
		'public/js',
		'public/plugins',
		'app/Modules/Pagina/Assets/js',
		'public/js/pagina',
	];

	protected $patch_css = [
		'public/css',
		'public/plugins',
		'app/Modules/Pagina/Assets/css',
	];

	public $libreriasIniciales = [
		'OpenSans', 'font-awesome',
		'animate', 'bootstrap', 'bootbox',
		'maskedinput',
		//'owl-carousel',
		'pace', 'jquery-form', 'pnotify',
		'modernizr','components-metronic'
	];

	public function __construct()
	{
		parent::__construct();
		$this->urlphppos = $this->urlphppos();
	}

	public function setTitulo($titulo)
	{
		//$this->titulo = 'Tumundoclick | ' . $titulo;
		SEOMeta::setTitle('Alfalibros ' . $titulo);
	}
	
	public function urlphppos($url = '')
	{
		return env('APP_URL_PHPPOS', 'http://alfalibros.net/paneldelibros/index.php/') . $url;
	}

	protected function productoQB()
	{
		return DB::connection('phppos')
			->table('phppos_items')
			->select([
				'phppos_items.item_id as id',
				'phppos_items.name as nombre',
				'phppos_items.description as descripcion',
				DB::raw('(
					select 
						image_id 
					from 
						phppos_item_images
					where
						phppos_item_images.item_id = phppos_items.item_id
					limit 1) as imagen'),
				'phppos_items.cost_price as costo',
				'phppos_items.unit_price as precio',
				'phppos_location_items.quantity as cantidad',
				'phppos_categories.id as categoria_id',
				'phppos_categories.name as categoria'
			])
			->leftJoin('phppos_location_items', 'phppos_location_items.item_id', '=', 'phppos_items.item_id')
			->leftJoin('phppos_categories', 'phppos_categories.id', '=', 'phppos_items.category_id')
			->whereRaw('(select image_id from phppos_item_images where phppos_item_images.item_id = phppos_items.item_id limit 1) is not null')
			->where('phppos_items.deleted', 0)
			->where('phppos_categories.deleted', 0)
			->where('phppos_location_items.location_id', $this->location_id())
			->whereRaw('IFNULL(phppos_items.reorder_level, 0) < phppos_location_items.quantity')
			->orderBy('phppos_items.item_id', 'desc');
	}

	public function location_id() {
		return $this->conf('warehouse');
	}

	public function __categorias($id = 0)
	{
		$categorias = [];

		$sql = DB::connection('phppos')
			->table('phppos_categories')
			->select([
				'phppos_categories.id', 
				'phppos_categories.name', 
				DB::raw('count(phppos_items.category_id) as cantidad')
			])
			->leftJoin('phppos_items', 'phppos_categories.id', '=', 'phppos_items.category_id')
			->where('phppos_categories.deleted', 0)
			->where('phppos_items.deleted', 0)
			//->whereRaw('(select image_id from phppos_item_images where phppos_item_images.item_id = phppos_items.item_id limit 1) is not null')
			->groupBy('phppos_categories.id', 'phppos_categories.name');

		if ($id == 0) {
			$sql->whereNull('parent_id');
		} else {
			$sql->where('parent_id', $id);
		}

		$categorias = $sql->get()->toArray();

		if (count($categorias) > 0) {
			foreach ($categorias as $key => $categoria) {
				$categorias[$key]->hijos = $this->__categorias($categoria->id);
			}
		}

		return $categorias;
	}

	public function _app(Array $arr = [])
	{
		$arr = parent::_app($arr);

		$carrito = Cart::content();
		$totalCarrito = 0;

		foreach ($carrito as $car) {
			$totalCarrito += $car->qty * $car->price;
		}

		$categorias = $this->__categorias();

		$autores = [];
		
		$_autores = $this->productoQB()->get();
		foreach ($_autores as $item) {
			$item->autor = '';
			if (preg_match('/libros/i', $item->nombre)) {
				$nombre = explode(',', $item->nombre);
				$item->autor = trim($nombre[1]);
			}

			if ($item->autor == '') {
				continue;
			}

			$autores[str_slug($item->autor)] = ucwords($item->autor);
		}

		asort($autores);

		return array_merge([
			'autenticado'  => Auth::check(),
			'usuario'      => Auth::user(),
			'carrito'      => $carrito,
			'totalCarrito' => $totalCarrito,
			'categorias'   => $categorias,
			'autores'      => $autores
		], $arr);
	}
}