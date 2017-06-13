<?php 

namespace alfalibros\Modules\Pagina\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
	protected $connection = 'phppos';

	public $timestamps = false;
	protected $table = 'phppos_categories';

	public function productos()
    {
        return $this->hasMany('alfalibros\Modules\Pagina\Models\Producto', 'category_id');
    }
}
