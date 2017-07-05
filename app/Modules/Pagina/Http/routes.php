<?php

Route::group(['middleware' => 'web', 'namespace' => 'alfalibros\Modules\Pagina\Http\Controllers'], function() {
	// controlador de productos
	Route::get('/', 									'ProductoController@index')->name('pag.index');
	Route::get('producto/{id}', 						'ProductoController@producto')->name('pag.producto');
	Route::get('categorias', 							'ProductoController@categorias')->name('pag.categorias');
	Route::get('categoria/{id}', 						'ProductoController@categoria')->name('pag.categoria');
	Route::get('autor/{autor}', 						'ProductoController@autor')->name('pag.autor');

	// controlador de Pagina
	Route::get('login', 								'PaginaController@loginForm')->name('pag.loginForm');
	Route::post('login', 								'PaginaController@login')->name('pag.login');
	Route::get('salir', 								'PaginaController@salir')->name('pag.salir');

	// controlador de usuarios
	Route::group(['prefix' => 'usuarios'], function() {
		Route::get('nuevo', 							'UsuariosController@usuarios')->name('pag.usuarios.nuevo');
		Route::get('registrado', 						'UsuariosController@registrado')->name('pag.usuarios.registrado');
		Route::post('registrar', 						'UsuariosController@registrar')->name('pag.usuarios.registrar');
		Route::get('recuperar/clave', 					'UsuariosController@recuperar')->name('pag.usuarios.recuperar.clave');
		Route::post('recuperar/clave', 					'UsuariosController@recuperar')->name('pag.usuarios.recuperar.clave');
		Route::get('recuperar/{codigo}', 				'UsuariosController@recuperar_clave')->where('codigo', '[a-zA-Z0-9]+')->name('pag.usuarios.recuperarclave');
		Route::post('recuperar/{codigo}', 				'UsuariosController@recuperar_clave')->where('codigo', '[a-zA-Z0-9]+')->name('pag.usuarios.recuperarclave');
		Route::get('confirmar/{codigo}', 				'UsuariosController@confirmar')->where('codigo', '[a-zA-Z0-9]+')->name('pag.usuarios.confirmar');
		Route::post('direccion/nuevo',					'UsuariosController@direccionNueva')->name('pag.usuarios.direccion.nuevo');;
	});

	// controlador de Carrito
	Route::group(['prefix' => 'carrito'], function() {
		Route::get('/', 								'CarritoController@index')->name('pag.carrito.');
		Route::post('agregar/{id}/{cantidad}', 			'CarritoController@agregar')->where('cantidad', '[0-9]+')->name('pag.carrito.agregar.cantidad');
		Route::post('agregar/{id}', 					'CarritoController@agregar')->name('pag.carrito.agregar');
		Route::delete('eliminar/{rowid}', 				'CarritoController@eliminar')->name('pag.carrito.eliminar');
		Route::get('vaciar', 							'CarritoController@vaciar')->name('pag.carrito.vaciar');
		Route::post('recargar', 						'CarritoController@carrito')->name('pag.carrito.recargar');
		Route::post('comprar', 							'CompraController@comprar')->name('pag.carrito.comprar');
	});
	
	Route::group(['prefix' => 'compra'], function() {
		Route::get('ver/{codigo?}/{paso?}',				'CompraController@ver')
			->where('codigo', '[a-zA-Z0-9]{80}')
			->where('paso', '[1|2|3|4]')
			->name('pag.compra.ver');
		
		Route::get('ver/cotizacion/{codigo?}',			'CompraController@cotizacion')
			->name('pag.compra.cotizacion');

		Route::post('facturacion', 						'CompraController@facturacion');
		
		Route::get('confirmar/{codigo}',				'CompraController@confirmar')->where('codigo', '[a-zA-Z0-9]{80}')->name('pag.compra.confirmar');
		Route::post('confirmar/{codigo}',				'CompraController@confirmar')->where('codigo', '[a-zA-Z0-9]{80}')->name('pag.compra.confirmar');

		Route::get('cancelar/{codigo}',					'CompraController@cancelar')->where('codigo', '[a-zA-Z0-9]{80}')->name('pag.compra.cancelar');
	});
});