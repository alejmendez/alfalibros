<?php 

namespace alfalibros\Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
	protected $connection = 'phppos';

	public $timestamps = false;
	
	protected $table = 'phppos_customers';
	protected $fillable = [
		'person_id',
		'account_number',
		'override_default_tax',
		'company_name',
		'balance',
		'credit_limit',
		'points',
		'current_spend_for_points',
		'current_sales_for_discount',
		'taxable',
		'tax_certificate',
		'cc_token',
		'cc_preview',
		'card_issuer',
	];

	public function persona()
	{
		return $this->hasOne('alfalibros\Modules\Base\Models\personas', 'person_id', 'person_id');
	}

	public function setAccountNumberAttribute($value)
	{
		$this->attributes['account_number'] = strtoupper($value);
	}
}
