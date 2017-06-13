<?php 

namespace alfalibros\Modules\Pagina\Models;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
	protected $connection = 'phppos';

	public $timestamps = false;
	protected $table = 'phppos_item_images';

	public function producto()
    {
        return $this->belongsTo('alfalibros\Modules\Pagina\Models\Producto', 'item_id', 'image_id');
    }
}