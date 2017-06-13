<?php

Route::group(['middleware' => 'web', 'prefix' => Config::get('admin.prefix'), 'namespace' => 'alfalibros\\Modules\Base\Http\Controllers'], function() {
    Route::get('/', 'EscritorioController@getIndex');
	 
	/**
	 * Login
	 */
	
	Route::group(['prefix' => 'login'], function() {
		Route::get('/', 				'LoginController@index');
		Route::get('salir', 			'LoginController@salir');
		Route::post('validar', 			'LoginController@validar');
		Route::get('bloquear', 			'LoginController@bloquear');
	});

	/**
	 * Perfiles
	 */

	Route::group(['prefix' => 'perfiles'], function() {
		Route::get('/', 				'PerfilesController@index');
		Route::get('buscar/{id}', 		'PerfilesController@buscar');
		Route::post('guardar', 			'PerfilesController@guardar');
		Route::put('guardar/{id}', 		'PerfilesController@guardar');
		Route::delete('eliminar/{id}', 	'PerfilesController@eliminar');
		Route::post('restaurar/{id}', 	'PerfilesController@restaurar');
		Route::delete('destruir/{id}', 	'PerfilesController@destruir');
		Route::get('arbol', 			'PerfilesController@arbol');
		Route::get('datatable', 		'PerfilesController@datatable');
	});

	/**
	 * Perfil
	 */

	Route::group(['prefix' => 'perfil'], function() {
		Route::get('/', 				'PerfilController@index');
		Route::put('actualizar', 		'PerfilController@actualizar');
		Route::put('clave', 			'PerfilController@clave');
		Route::post('cambio', 			'PerfilController@cambio');
	});

	/**
	 * Usuarios
	 */

	Route::group(['prefix' => 'usuarios'], function() {
		Route::get('/', 				'UsuariosController@index');
		Route::get('buscar/{id}', 		'UsuariosController@buscar');

		Route::post('guardar',			'UsuariosController@guardar');
		Route::put('guardar/{id}', 		'UsuariosController@guardar');

		Route::delete('eliminar/{id}', 	'UsuariosController@eliminar');
		Route::post('restaurar/{id}', 	'UsuariosController@restaurar');
		Route::delete('destruir/{id}', 	'UsuariosController@destruir');

		Route::post('cambio', 			'UsuariosController@cambio');
		Route::get('arbol', 			'UsuariosController@arbol');
		Route::get('datatable', 		'UsuariosController@datatable');
	});

	Route::group(['prefix' => 'bancos'], function() {
		Route::get('/', 				'BancosController@index');
		Route::get('nuevo', 			'BancosController@nuevo');
		Route::get('cambiar/{id}', 		'BancosController@cambiar');
		
		Route::get('buscar/{id}', 		'BancosController@buscar');

		Route::post('guardar',			'BancosController@guardar');
		Route::put('guardar/{id}', 		'BancosController@guardar');

		Route::delete('eliminar/{id}', 	'BancosController@eliminar');
		Route::post('restaurar/{id}', 	'BancosController@restaurar');
		Route::delete('destruir/{id}', 	'BancosController@destruir');

		Route::get('datatable', 		'BancosController@datatable');
	});

	Route::group(['prefix' => 'compras'], function() {
		Route::get('/', 				'ComprasController@index');
		Route::get('nuevo', 			'ComprasController@nuevo');
		Route::get('cambiar/{id}', 		'ComprasController@cambiar');
		
		Route::get('buscar/{id}', 		'ComprasController@buscar');

		Route::post('guardar',			'ComprasController@guardar');
		Route::put('guardar/{id}', 		'ComprasController@guardar');

		Route::delete('eliminar/{id}', 	'ComprasController@eliminar');
		Route::post('restaurar/{id}', 	'ComprasController@restaurar');
		Route::delete('destruir/{id}', 	'ComprasController@destruir');

		Route::get('datatable', 		'ComprasController@datatable');
	});

});

Route::group(['middleware' => 'web', 'prefix' => 'img/', 'namespace' => 'alfalibros\Modules\Base\Http\Controllers'], function() {
	Route::get('{dir}/{tam}/{arch}', 'ImagenController@public_img');
});
