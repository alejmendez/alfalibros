<?php

namespace alfalibros\Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioPermisos extends Model {
	protected $table = 'app_usuario_permisos';
	
	protected $fillable = ['usuario_id', 'ruta'];
	protected $hidden = ['created_at', 'updated_at'];

	public $incrementing = false;
	
	public function usuario(){
		// belongsTo = "pertenece a" | hace relacion desde el detalle hasta el maestro
		return $this->belongsTo('alfalibros\Modules\Base\Models\Usuario', 'usuario_id');
	}
}
