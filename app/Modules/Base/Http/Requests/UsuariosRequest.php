<?php

namespace alfalibros\Modules\Base\Http\Requests;

use alfalibros\Http\Requests\Request;

class UsuariosRequest extends Request {
	protected $reglasArr = [
		'usuario'        => ['required', 'min:3', 'max:50', 'unique:app_usuario,usuario'],
		'password'       => ['required', 'password', 'min:8', 'max:50'],
		//'dni'            => ['required', 'integer', 'unique:app_usuario,dni'],
		//'nombre'         => ['required', 'nombre', 'min:3', 'max:50'],
		//'apellido'       => ['nombre', 'min:3', 'max:100'],
		//'correo'         => ['max:50', 'unique:app_usuario,correo'],
		//'telefono'       => ['telefono', 'min:3', 'max:15'],
		//'foto'           => ['mimes:jpeg,png,jpg'],
		'perfil_id'	     => ['required', 'integer'],
		//'autenticacion'  => ['required'],
		'super'          => ['required'],
		//'sexo'           => ['max:1'],
		//'edo_civil'      => ['max:2'],
		//'direccion'      => ['max:200'],
		//'facebook'       => ['max:200'],
		//'instagram'      => ['max:200'],
		//'twitter'        => ['max:200']
	];

	public function rules() {
		$rules = parent::rules();

		switch ($this->method()){
			case 'PUT':
			case 'PATCH':
				if ($this->input('password') == '') {
					unset($rules['password']);
				}

				break;
		}

		return $rules;
	}
}