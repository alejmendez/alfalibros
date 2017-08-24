<?php

namespace alfalibros\Modules\Base\Models;

use alfalibros\Modules\Base\Models\Modelo;



class UsuarioDireccion extends modelo
{
    protected $table = 'usuario_direccion';
    protected $fillable = [
        'usuario_id',
        'customer_id',
        'nombre_direccion',
        'persona_contacto',
        'telefono',
        'estado',
        'ciudad',
        'codigo_postal',
        'direccion',
        'punto_referencia'
    ];

    protected $campos = [
        'nombre_direccion' => [
            'type'        => 'text',
            'label'       => 'Nombre de la dirección',
            'placeholder' => 'Nombre de la dirección',
        ],
        'persona_contacto' => [
            'type'        => 'text',
            'label'       => 'Persona de contacto',
            'placeholder' => 'Persona de contacto',
        ],
        'telefono' => [
            'type'        => 'text',
            'label'       => 'Teléfono de contacto',
            'placeholder' => 'Teléfono de contacto',
            'id'          => 'telefono_contacto'
        ],
        'estado' => [
            'type'        => 'text',
            'label'       => 'Estado',
            'placeholder' => 'Estado',
        ],
        'ciudad' => [
            'type'        => 'text',
            'label'       => 'Ciudad',
            'placeholder' => 'Ciudad',
        ],
        'direccion' => [
            'type'        => 'textarea',
            'label'       => 'Direción de envío',
            'placeholder' => 'Direción de envío',
            'id'          => 'direccion_envio',
            'cont_class'  => 'col-xs-12'
        ],
        'punto_referencia' => [
            'type'        => 'text',
            'label'       => 'Punto de referencia',
            'placeholder' => 'Punto de referencia',
        ]
    ];

    public function usuario()
    {
        return $this->belongsTo('alfalibros\Modules\Base\Models\Usuario', 'usuario_id');
    }
    
}