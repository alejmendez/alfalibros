<?php 

namespace alfalibros\Modules\Pagina\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $connection = 'phppos';

	public $timestamps = false;
	protected $primaryKey = null;
    public $incrementing = false;

	protected $table = 'phppos_location_items';

	public function productos()
    {
        return $this->hasOne('alfalibros\Modules\Pagina\Models\Producto', 'item_id', 'item_id');
    }
}
