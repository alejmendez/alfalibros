<?php

namespace alfalibros\Modules\Base\Models;

use alfalibros\Modules\Base\Models\Modelo;



class Bancos extends modelo
{
    protected $table = 'bancos';
    protected $fillable = ["banco","tipo_cuenta","cuenta","nombre","cedula","correo"];
    protected $campos = [
    'banco' => [
        'type' => 'text',
        'label' => 'Banco',
        'placeholder' => 'Banco del Bancos'
    ],
    'tipo_cuenta' => [
        'type' => 'text',
        'label' => 'Tipo Cuenta',
        'placeholder' => 'Tipo Cuenta del Bancos'
    ],
    'cuenta' => [
        'type' => 'text',
        'label' => 'Cuenta',
        'placeholder' => 'Cuenta del Bancos'
    ],
    'nombre' => [
        'type' => 'text',
        'label' => 'Nombre',
        'placeholder' => 'Nombre del Bancos'
    ],
    'cedula' => [
        'type' => 'text',
        'label' => 'Cedula',
        'placeholder' => 'Cedula del Bancos'
    ],
    'correo' => [
        'type' => 'text',
        'label' => 'Correo',
        'placeholder' => 'Correo del Bancos'
    ]
];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
    }

    
}