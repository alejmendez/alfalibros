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
use alfalibros\Modules\Base\Http\Requests\MetodoEnvioRequest;

//Modelos
use alfalibros\Modules\Base\Models\MetodoEnvio;

class MetodoEnvioController extends Controller
{
    protected $titulo = 'Metodo de Envio';

    public $js = [
        'MetodoEnvio'
    ];
    
    public $css = [
        'MetodoEnvio'
    ];

    public $librerias = [
        'datatables'
    ];

    public function index()
    {
        return $this->view('base::MetodoEnvio', [
            'MetodoEnvio' => new MetodoEnvio()
        ]);
    }

    public function nuevo()
    {
        $MetodoEnvio = new MetodoEnvio();
        return $this->view('base::MetodoEnvio', [
            'layouts' => 'base::layouts.popup',
            'MetodoEnvio' => $MetodoEnvio
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $MetodoEnvio = MetodoEnvio::find($id);
        return $this->view('base::MetodoEnvio', [
            'layouts' => 'base::layouts.popup',
            'MetodoEnvio' => $MetodoEnvio
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $MetodoEnvio = MetodoEnvio::withTrashed()->find($id);
        } else {
            $MetodoEnvio = MetodoEnvio::find($id);
        }

        if ($MetodoEnvio) {
            return array_merge($MetodoEnvio->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(MetodoEnvioRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $MetodoEnvio = $id == 0 ? new MetodoEnvio() : MetodoEnvio::find($id);

            $MetodoEnvio->fill($request->all());
            $MetodoEnvio->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $MetodoEnvio->id,
            'texto' => $MetodoEnvio->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            MetodoEnvio::destroy($id);
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.eliminar')];
    }

    public function restaurar(Request $request, $id = 0)
    {
        try {
            MetodoEnvio::withTrashed()->find($id)->restore();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.restaurar')];
    }

    public function destruir(Request $request, $id = 0)
    {
        try {
            MetodoEnvio::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = MetodoEnvio::select([
            'id', 'nombre', 'deleted_at'
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