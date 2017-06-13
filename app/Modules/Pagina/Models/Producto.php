<?php 

namespace alfalibros\Modules\Pagina\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $connection = 'phppos';

	public $timestamps = false;
	protected $primaryKey = 'sale_id';
    public $incrementing = false;

	protected $table = 'phppos_items';
	protected $fillable = [
		'name',
		'category_id',
		'supplier_id',
		'manufacturer_id',
		'item_number',
		'product_id',
		'ecommerce_product_id',
		'description',
		'size',
		'tax_included',
		'cost_price',
		'unit_price',
		'promo_price',
		'start_date',
		'end_date',
		'reorder_level',
		'expire_days',
		'item_id',
		'allow_alt_description',
		'is_serialized',
		'override_default_tax',
		'is_ecommerce',
		'is_service',
		'is_ebt_item',
		'commission_percent',
		'commission_percent_type',
		'commission_fixed',
		'change_cost_price',
		'disable_loyalty',
		'deleted',
		'aaatex_qb_item_name',
		'last_modified'
	];

	public function detalle()
    {
        return $this->hasOne('alfalibros\Modules\Pagina\Models\VentaDetalle', 'sale_id', 'sale_id');
    }

    public function imagenes()
    {
        return $this->hasMany('alfalibros\Modules\Pagina\Models\Imagenes', 'sale_id', 'sale_id');
    }

    public function location()
    {
        return $this->hasOne('alfalibros\Modules\Pagina\Models\Location', 'sale_id', 'sale_id');
    }

    public function getNameAttribute($value)
	{
		$name = $this->attributes['name'];
		$name = preg_match('/libros/i', $name) ? substr($name, strrpos($name, ',') + 1) : $name;

		return $name;
	}
}
