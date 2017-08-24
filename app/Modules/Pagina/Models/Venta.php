<?php 

namespace alfalibros\Modules\Pagina\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	protected $connection = 'phppos';

	public $timestamps = false;
	protected $primaryKey = 'sale_id';

	protected $table = 'phppos_sales';
	protected $fillable = [
		//'sale_id',
		'sale_time',
		'customer_id',
		'employee_id',
		'sold_by_employee_id',
		'comment',
		'discount_reason',
		'show_comment_on_receipt',
		'sale_id',
		'rule_id',
		'rule_discount',
		'payment_type',
		'cc_ref_no',
		'auth_code',
		'deleted_by',
		'deleted',
		'suspended',
		'store_account_payment',
		'was_layaway',
		'was_estimate',
		'location_id',
		'register_id',
		'tier_id',
		'points_used',
		'points_gained',
		'did_redeem_discount',
		'signature_image_id',
		'deleted_taxes',
		'total_quantity_purchased',
		'subtotal',
		'tax',
		'total',
		'profit',
		'aaatex_qb_imported',
	];

	protected $dates = [
        'sale_time'
    ];

    public function compra()
    {
        return $this->hasOne('alfalibros\Modules\Base\Models\Compras', 'sale_id', 'sale_id');
    }

    public function detalle()
    {
        return $this->hasMany('alfalibros\Modules\Pagina\Models\VentaDetalle', 'sale_id', 'sale_id');
    }
}
