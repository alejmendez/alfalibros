<?php

namespace alfalibros\Modules\Base\Models;

use alfalibros\Modules\Base\Models\Modelo;



class UsuarioDireccion extends modelo
{
    protected $table = 'usuario_direccion';
    protected $fillable = [
        'usuario_id',
        'nombre_direccion',
        'persona_contacto',
        'telefono',
        'estado',
        'ciudad',
        'codigo_postal',
        'direccion',
        'punto_referencia'
    ];

    public function usuario()
    {
        return $this->belongsTo('alfalibros\Modules\Base\Models\Usuario', 'usuario_id');
    }
    
}