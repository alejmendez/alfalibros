<?php

namespace alfalibros\Modules\Base\Models;

use alfalibros\Modules\Base\Models\Modelo;



class MetodoEnvio extends modelo
{
    protected $table = 'metodo_envio';
    protected $fillable = [
        'nombre'
    ];

    protected $campos = [
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre',
        ],
       
    ];
    
}