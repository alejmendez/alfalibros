<?php

namespace alfalibros\Modules\Configuracion\Http\Controllers;


//Dependencias
use DB;
use URL;
use Yajra\Datatables\Datatables;
use alfalibros\Http\Requests\Request;

use Validator;

//Controlador Padre
use alfalibros\Modules\Configuracion\Http\Controllers\Controller;

//Request
use alfalibros\Modules\Configuracion\Http\Requests\ConfiguracionRequest;

//Modelos
use alfalibros\Modules\Configuracion\Models\Configuracion;

class ConfiguracionController extends Controller {
	protected $titulo = 'Configuracion';

	public $css = ['configuracion'];
	public $js = ['configuracion'];

	public $librerias = [
		'alphanum',
		'maskedinput',
		'datatables',
		'jasny-bootstrap',
		'jquery-ui',
		'jquery-ui-timepicker'
	];

	public function index() {
		return $this->view('configuracion::Configuracion');
	}

	public function buscar(Request $request, $id ){
		if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')){
			$Configuracion = Configuracion::withTrashed()->find($id);
		}else{
			$Configuracion = Configuracion::find($id);
		}
		
		if ($Configuracion){
			$Configuracion->logo = URL::to("public/img/logo/" . $Configuracion->logo);

			return array_merge($Configuracion->toArray(), [
				's' => 's', 
				'msj' => trans('controller.buscar')
			]);
		}
		
		return trans('controller.nobuscar');
	}

	public function guardar(ConfiguracionRequest $request, $id = 0){
		DB::beginTransaction();
		try{
			//LOGO
			if ($request->logo) {
				$validator = Validator::make($request->all(), [
					'logo' => ['mimes:jpeg,png,jpg'],
				]);

				if ($validator->fails()) {
					return response($validator->errors(), 422);
				}
				
				$file = $request->file('logo');
				$nombre_imagen= 'logo.png';// $file->getClientOriginalExtension();
		        //$nombre_imagen = $request->nombre.'.'.$file->getClientOriginalExtension();
				$path = public_path('img/logos/');

				$file->move($path, $nombre_imagen);
				$filename = $path .$nombre_imagen;

				chmod($filename, 0777);

				$this->conf('logo',$nombre_imagen);
			}

             //LOGO LOGIN
			if ($request->login_logo) {
				$validator = Validator::make($request->all(), [
					'login_logo' => ['mimes:jpeg,png,jpg'],
				]);

				if ($validator->fails()) {
					return response($validator->errors(), 422);
				}
				
				$file = $request->file('login_logo');
				$nombre_login= 'login_logo.png';
				$path = public_path('img/logos/');

				$file->move($path, $nombre_login);
				$filename = $path .$nombre_login;

				chmod($filename, 0777);

				$this->conf('login_logo',$nombre_login);
			}

			foreach ($request->conf as $key => $value) {
				$this->conf($key, $value);
			}
		}catch(Exception $e){
			DB::rollback();
			return $e->errorInfo[2];
		}
		DB::commit();

		return ['s' => 's', 'msj' => trans('controller.incluir')];
	}

	public function eliminar(Request $request, $id = 0){
		try{
			Configuracion::destroy($id);
		}catch(Exception $e){
			return $e->errorInfo[2];
		}

		return ['s' => 's', 'msj' => trans('controller.eliminar')];
	}

	public function restaurar(Request $request, $id = 0) {
		try {
			Configuracion::withTrashed()->find($id)->restore();
		} catch (Exception $e) {
			return $e->errorInfo[2];
		}

		return ['s' => 's', 'msj' => trans('controller.restaurar')];
	}

	public function destruir(Request $request, $id = 0) {
		try {
			Configuracion::withTrashed()->find($id)->forceDelete();
		} catch (Exception $e) {
			return $e->errorInfo[2];
		}

		return ['s' => 's', 'msj' => trans('controller.destruir')];
	}

	public function getDatos(){
		$configuracion = Configuracion::select(
			'id', 
			'propiedad', 
			'valor'
		);
		
		return $configuracion->get();
	}

	public function datatable(Request $request){
		$sql = Configuracion::select([
			'id', 'propiedad', 'valor', 'deleted_at'
		]);

		if ($request->verSoloEliminados == 'true'){
			$sql->onlyTrashed();
		}elseif ($request->verEliminados == 'true'){
			$sql->withTrashed();
		}
		
		return Datatables::of($sql)
			->setRowId('id')
			->setRowClass(function ($registro) {
				return is_null($registro->deleted_at) ? '' : 'bg-red-thunderbird bg-font-red-thunderbird';
			})
			->make(true);
	}

	public function warehouse(){
		return DB::connection('phppos')->table('phppos_locations')->pluck('name', 'location_id');
	}

}