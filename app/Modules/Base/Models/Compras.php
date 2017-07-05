<?php

namespace alfalibros\Modules\Base\Models;

use DB;
use alfalibros\Modules\Base\Models\Modelo;

use alfalibros\Modules\Base\Models\Bancos;
use alfalibros\Modules\Base\Models\MetodoEnvio;
use alfalibros\Modules\Pagina\Models\Producto;
use alfalibros\Modules\Pagina\Models\Venta;
use alfalibros\Modules\Pagina\Models\VentaDetalle;

class Compras extends Modelo
{
    protected $table = 'compras';
    protected $fillable = [
        "sale_id",
        "codigo",
        "usuario_id",
        "bancos_id",
        "nombre",
        "cedula",
        "telefono",
        "correo",
        "direccion_id",
        "direccion",
        "metodo_envio_id",
        "nota",
        "codigo_transferencia",
        "banco_usuario",
        "comprobante",
        "monto",
        "estatus",
        "aprobado"
    ];

    protected $casts = [
        "aprobado" => "boolean",
    ];

    protected $campos = [
        'sale_id' => [
            'type'        => 'number',
            'label'       => 'Codigo de Venta (PHPPOS)',
            'placeholder' => 'Codigo de Venta (PHPPOS)'
        ],
        'codigo' => [
            'type'        => 'text',
            'label'       => 'Codigo',
            'placeholder' => 'Codigo de la Compra',
            'disabled'    => 'disabled'
        ],
        'usuario_id' => [
            'type'        => 'select',
            'label'       => 'Usuario',
            'placeholder' => '- Seleccione un Usuario',
            'url'         => 'usuarios'
        ],
        'bancos_id' => [
            'type'        => 'select',
            'label'       => 'Bancos',
            'placeholder' => '- Seleccione un Bancos',
            'url'         => 'bancos'
        ],
        'metodo_envio_id' => [
            'type'        => 'select',
            'label'       => 'Método de envio',
            'placeholder' => '- Seleccione un Método de envio',
            'url'         => 'metodo_envio'
        ],
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre del Cliente'
        ],
        'cedula' => [
            'type'        => 'text',
            'label'       => 'Cedula',
            'placeholder' => 'Cedula del Cliente'
        ],
        'telefono' => [
            'type'        => 'text',
            'label'       => 'Telefono',
            'placeholder' => 'Telefono de la Compra'
        ],
        'correo' => [
            'type'        => 'text',
            'label'       => 'Correo',
            'placeholder' => 'Correo del Cliente'
        ],
        'direccion' => [
            'type'        => 'text',
            'label'       => 'Direccion',
            'placeholder' => 'Direccion del Cliente'
        ],
        'nota' => [
            'type'        => 'text',
            'label'       => 'Nota',
            'placeholder' => 'Nota del Cliente'
        ],
        'codigo_transferencia' => [
            'type'        => 'text',
            'label'       => 'Codigo Transferencia',
            'placeholder' => 'Codigo Transferencia de la Compra'
        ],
        'banco_usuario' => [
            'type'        => 'text',
            'label'       => 'Banco del Cliente',
            'placeholder' => 'Banco del Cliente'
        ],
        'comprobante' => [
            'type'        => 'text',
            'label'       => 'Comprobante',
            'placeholder' => 'Comprobante de la Compra'
        ],
        'monto' => [
            'type'        => 'text',
            'label'       => 'Monto',
            'placeholder' => 'Monto de la Compra'
        ]
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->campos['bancos_id']['options'] = Bancos::pluck('nombre', 'id');
        $this->campos['metodo_envio_id']['options'] = MetodoEnvio::pluck('nombre', 'id');
        
    }

    public static function boot(){
        parent::boot();
        
        static::deleted(function($model) {
            $model->sale_id;
            if ($model->estatus == 0) {
                $dbDefault = \Config::get('database.default');

                VentaDetalle::on($dbDefault)->where('sale_id', $model->sale_id)->delete();
                Venta::on($dbDefault)->where('sale_id', $model->sale_id)->delete();
            } else {
                $venta = Venta::where('sale_id', $model->sale_id)->first();
                if (!$venta) {
                    return;
                }

                if ($venta->deleted != 1){
                    $detalles = VentaDetalle::where('sale_id', $model->sale_id)->get();

                    foreach ($detalles as $detalle) {
                        DB::connection('phppos')
                            ->table('phppos_location_items')
                            ->where('item_id', $detalle->item_id)
                            ->where('location_id', 1)
                            ->increment('quantity', $detalle->quantity_purchased);
                    }
                }

                $venta->deleted = 1;
                $venta->save();


                /*
                DB::connection('phppos')
                    ->table('phppos_sales_items_taxes')
                    ->where('sale_id', $model->sale_id)
                    ->delete();
                VentaDetalle::where('sale_id', $model->sale_id)->delete();
                Venta::where('sale_id', $model->sale_id)->update([
                    'deleted' => 1
                ]);
                */
            }

            return true;
        });
    }

    public function usuario()
	{
		return $this->belongsTo('alfalibros\Modules\Base\Models\Usuario');
	}

	public function bancos()
	{
		return $this->belongsTo('alfalibros\Modules\Base\Models\Bancos');
	}

    public function venta()
    {
        return $this->hasOne('alfalibros\Modules\Pagina\Models\Venta', 'sale_id', 'sale_id');
    }

    public function getVenta()
    {
        return $this->hasOne('alfalibros\Modules\Pagina\Models\Venta', 'sale_id', 'sale_id');
    }

}