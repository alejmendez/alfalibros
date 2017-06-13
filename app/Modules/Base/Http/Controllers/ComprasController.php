<?php

namespace alfalibros\Modules\Base\Http\Controllers;

//Controlador Padre
use alfalibros\Modules\Base\Http\Controllers\Controller;

//Dependencias
use DB;
use alfalibros\Http\Requests\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;

//Request
use alfalibros\Modules\Base\Http\Requests\ComprasRequest;

//Modelos
use alfalibros\Modules\Base\Models\Compras;
use alfalibros\Modules\Base\Models\Usuario;
use alfalibros\Modules\Pagina\Models\Venta;
use alfalibros\Modules\Pagina\Models\VentaDetalle;

class ComprasController extends Controller
{
    protected $titulo = 'Compras';

    public $js = [
        'Compras'
    ];
    
    public $css = [
        'Compras'
    ];

    public $librerias = [
        'datatables',
        'bootstrap-switch'
    ];

    public function index()
    {
        return $this->view('base::Compras', [
            'Compras' => new Compras()
        ]);
    }

    public function nuevo()
    {
        $Compras = new Compras();
        return $this->view('base::Compras', [
            'layouts' => 'admin::layouts.popup',
            'Compras' => $Compras
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Compras = Compras::find($id);
        return $this->view('base::Compras', [
            'layouts' => 'admin::layouts.popup',
            'Compras' => $Compras
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Compras = Compras::withTrashed()->find($id);
        } else {
            $Compras = Compras::find($id);
        }

        if ($Compras) {
            return array_merge($Compras->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(ComprasRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Compras = $id == 0 ? new Compras() : Compras::find($id);

            $data = $request->all();
            $Compras->fill($data);
            $Compras->save();

            if ($data['aprobado'] == 1) {
                // hay q descontar de inventario
                $venta = Venta::find($Compras->sale_id)->update([
                    'suspended'               => 0
                ]);

                $msj = '
                Se ha confirmado la tu compra, puedes ver tus compras realizadas 
                <a href="' . url('compra/historia') . '">aqu&iacute;</a> y para 
                ver la compra que acabamos de confirmar haz click 
                <a href="' . url('compra/historia/' . $Compras->codigo) . '">aqu&iacute;</a>, 
                en momentos contactaremos contigo para el envio de tu compra';
                $usuario = Usuario::find($Compras->usuario_id);
                $datosCorreo = [
                    'usuario' => $usuario,
                    'titulos' => [
                        'Compra en',
                        'AlfaLibros',
                        'Ya aprobamos tu compra!',
                    ],
                    'tituloCuerpo' => '',
                    'cuerpo' => $msj,
                ];

                \Mail::send("pagina::emails.mensaje", $datosCorreo, function($message) use($usuario) {
                    $message->from('no_responder@alfalibros.com', 'Alfalibros.com');
                    $message->to($usuario->persona->email, $usuario->persona->full_name)
                        ->subject("Compra en Alfalibros.com");
                });
            }
        } catch(QueryException $e) {
            DB::rollback();
            //return response()->json(['s' => 's', 'msj' => $e->getMessage()], 500);
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch(Exception $e) {
            DB::rollback();
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }
        DB::commit();

        return [
            'id'    => $Compras->id,
            'texto' => $Compras->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Compras::destroy($id);
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.eliminar')];
    }

    public function restaurar(Request $request, $id = 0)
    {
        try {
            Compras::withTrashed()->find($id)->restore();
        } catch (QueryException $e) {
           return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.restaurar')];
    }

    public function destruir(Request $request, $id = 0)
    {
        try {
            Compras::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Compras::select([
            'id', 
            'sale_id', 
            'nombre', 
            'cedula', 
            'codigo_transferencia', 
            'banco_usuario', 
            'monto', 
            'deleted_at'
        ]);

        if ($request->verSoloEliminados == 'true') {
            $sql->onlyTrashed();
        } elseif ($request->verEliminados == 'true') {
            $sql->withTrashed();
        }

        return Datatables::of($sql)
            ->setRowId('id')
            ->setRowClass(function ($registro) {
                return is_null($registro->deleted_at) ? '' : 'bg-red-thunderbird bg-font-red-thunderbird';
            })
            ->make(true);
    }
}