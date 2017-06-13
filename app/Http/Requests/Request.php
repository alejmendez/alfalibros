<?php

namespace alfalibros\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;

class Request extends FormRequest
{
	protected $reglasArr = [];

	protected $librerias = [];
	protected $form = [];

	public function reglas($rules = []){
		$id = $this->id();
		if (empty($rules)){
			$rules = $this->reglasArr;
		}

		if ($id !== 0){
			foreach ($rules as $key => $value){
				if (is_string($value)) continue;

				foreach ($value as $k => $v){
					if (strpos($v, "unique:") !== false){
						$rules[$key][$k] .= "," . $id;
					}
				}
			}
		}

		return $rules;
	}

	public function id(){
		if (!is_null($this->id)){
			return $this->id;
		}

		$segments = $this->segments();
		$this->id = $id = (int) end($segments);

		return $id;
	}

	public function rules() {
		$rules = $this->reglas();

		switch ($this->method()) {
			case 'GET':
			case 'DELETE':
				return [];
			default:
				break;
		}

		return $rules;
	}

	public function form(){
		$librerias = [];
	}

	public function plantilla($plantilla, $data){
		if (!is_array($data)) return '';
		
		$variables = array_keys($data);
		$datos = array_values($data);
		for ($i = 0, $c = count($variables); $i < $c; $i++) { 
			$variables[$i] = '{{' . trim($variables[$i]) . '}}';
		}

		foreach ($datos as $key => $value) {
			$datos[$key] = str_replace('"', '\'', $datos[$key]);
		}

		return str_replace($variables, $datos, $plantilla);
	}

	public function authorize() {
		return \Auth::check();
	}
}
