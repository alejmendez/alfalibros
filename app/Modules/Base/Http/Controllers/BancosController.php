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
use alfalibros\Modules\Base\Http\Requests\BancosRequest;

//Modelos
use alfalibros\Modules\Base\Models\Bancos;

class BancosController extends Controller
{
    protected $titulo = 'Bancos';

    public $js = [
        'Bancos'
    ];
    
    public $css = [
        'Bancos'
    ];

    public $librerias = [
        'datatables'
    ];

    public function index()
    {
        return $this->view('base::Bancos', [
            'Bancos' => new Bancos()
        ]);
    }

    public function nuevo()
    {
        $Bancos = new Bancos();
        return $this->view('base::Bancos', [
            'layouts' => 'base::layouts.popup',
            'Bancos' => $Bancos
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Bancos = Bancos::find($id);
        return $this->view('base::Bancos', [
            'layouts' => 'base::layouts.popup',
            'Bancos' => $Bancos
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Bancos = Bancos::withTrashed()->find($id);
        } else {
            $Bancos = Bancos::find($id);
        }

        if ($Bancos) {
            return array_merge($Bancos->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(BancosRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Bancos = $id == 0 ? new Bancos() : Bancos::find($id);

            $Bancos->fill($request->all());
            $Bancos->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Bancos->id,
            'texto' => $Bancos->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Bancos::destroy($id);
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
            Bancos::withTrashed()->find($id)->restore();
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
            Bancos::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Bancos::select([
            'id', 'banco', 'tipo_cuenta', 'cuenta', 'nombre', 'cedula', 'correo', 'deleted_at'
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