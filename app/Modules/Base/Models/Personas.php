<?php 

namespace alfalibros\Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
	protected $connection = 'phppos';

	protected $primaryKey = 'person_id';

	public $timestamps = false;
	
	protected $table = 'phppos_people';
	protected $fillable = [
		'first_name',
		'last_name',
		'full_name',
		'phone_number',
		'email',
		'address_1',
		'address_2',
		'city',
		'state',
		'zip',
		'country',
		'comments',
		'image_id',
	];

	public function usuario()
	{
		return $this->hasOne('alfalibros\Modules\Base\Models\Usuario', 'persona_id');
	}

	public function cliente()
	{
		return $this->hasOne('alfalibros\Modules\Base\Models\Clientes', 'person_id', 'person_id');
	}

	public function setFirstNameAttribute($value)
	{
		$this->attributes['first_name'] = ucwords(strtolower($value));
	}

	public function setLastNameAttribute($value)
	{
		$this->attributes['last_name'] = ucwords(strtolower($value));
	}

	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function getFullNameAttribute($value)
	{
		return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
	}
}
