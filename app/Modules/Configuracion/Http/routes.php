<?php

Route::group(['middleware' => 'web', 'prefix' => Config::get('admin.prefix'), 'namespace' => 'alfalibros\\Modules\Configuracion\Http\Controllers'], function() {
    Route::group(['prefix' => 'configuracion'], function() {
		Route::get('/', 				'ConfiguracionController@index');
		Route::get('buscar/{id}', 		'ConfiguracionController@buscar');

		Route::post('guardar',			'ConfiguracionController@guardar');
		Route::put('guardar/{id}', 		'ConfiguracionController@guardar');

		Route::delete('eliminar/{id}', 	'ConfiguracionController@eliminar');
		Route::post('restaurar/{id}', 	'ConfiguracionController@restaurar');
		Route::delete('destruir/{id}', 	'ConfiguracionController@destruir');
	    Route::get('datatable', 		'ConfiguracionController@datatable');
		Route::get('configuracion', 	'ConfiguracionController@configuracion');
		Route::get('datos/{id}', 	'ConfiguracionController@getDatos');
	});
});
