<?php

namespace alfalibros\Modules\Pagina\Http\Requests;

use alfalibros\Http\Requests\Request;
 
class RegistroRequest extends Request {
	protected $reglasArr = [
		'first_name'     => ['required', 'nombre', 'max:80'],
		'last_name'      => ['required', 'nombre', 'max:80'],
		'account_number' => ['required', 'regex:/^[VvEeJjGg]\d{5,8}$/'],
		'email'          => ['required', 'email', 'max:80'],
		'phone_number'   => ['required', 'max:80'],
		'password'       => ['required', 'max:30', 'min:6'],
		//'acepta'       => ['required', 'integer']
	];

	public function authorize() {
		return true;
	}
}