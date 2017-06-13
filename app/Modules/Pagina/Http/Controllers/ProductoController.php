<?php namespace alfalibros\Modules\Pagina\Http\Controllers;

use DB;

use alfalibros\Modules\Pagina\Http\Controllers\Controller;

class ProductoController extends Controller 
{
	public function index()
	{
		$this->setTitulo('Ultimos Libros');
		$productos = $this->productoQB()->paginate($this->paginar);

		return $this->view('pagina::Inicio', ['productos' => $productos]);
	}

	public function categorias()
	{
		$this->setTitulo('Categorias');
		return $this->view('pagina::Categorias');
	}

	public function categoria($id)
	{
		$this->setTitulo('Categorias');
		$productos = $this->productoQB()
			->where('phppos_categories.id', $id)
			->paginate($this->paginar);

		$categoria = DB::connection('phppos')
			->table('phppos_categories')
			->select([
				'phppos_categories.id', 
				'phppos_categories.name as nombre', 
				DB::raw('count(phppos_items.category_id) as cantidad')
			])
			->leftJoin('phppos_items', 'phppos_categories.id', '=', 'phppos_items.category_id')
			->where('phppos_categories.id', $id)
			->where('phppos_categories.deleted', 0)
			->where('phppos_items.deleted', 0)
			->whereNotNull('phppos_items.image_id')
			->groupBy('phppos_categories.id', 'phppos_categories.name')
			->first();

		
		if (!$categoria){
			abort(404);
		}

		return $this->view('pagina::Categoria', [
			'categoria' => $categoria,
			'productos' => $productos
		]);
	}

	public function producto($id)
	{
		$this->setTitulo('Producto');

		$producto = $this->productoQB()
			->where('phppos_items.item_id', $id)
			->first();

		$producto->autor = '';
		if (preg_match('/libros/i', $producto->nombre)) {
			$nombre = explode(',', $producto->nombre);
			$producto->nombre = $nombre[2];
			$producto->autor = $nombre[1];
		}

		$this->setTitulo('Alfalibros: ' . $producto->nombre);

		return $this->view('pagina::Producto', ['producto' => $producto]);
	}

	public function autor($autor)
	{
		$this->setTitulo('Autor');

		$autor = str_slug($autor);
		$autor = str_replace('-', ' ', $autor);

		$productos = $this->productoQB()
			->where(DB::raw('lower(phppos_items.name)'), 'like', 'libro%' . $autor . '%')
			->paginate($this->paginar);

		$this->setTitulo('Alfalibros: ' . ucwords($autor));

		return $this->view('pagina::Autor', ['productos' => $productos, 'autor' => ucwords($autor)]);
	}
}