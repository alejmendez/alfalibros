<?php

Route::group(['middleware' => 'web', 'prefix' => Config::get('admin.prefix') . '/generador', 'namespace' => 'alfalibros\\Modules\Generador\Http\Controllers'], function()
{
	Route::get('/', 				'GeneradorController@index');
	Route::get('campos/{tabla}',	'GeneradorController@campos');
	Route::post('guardar',			'GeneradorController@guardar');
	Route::get('modelos',			'GeneradorController@modelos');

	Route::group(['prefix' => 'table'], function() {
		Route::get('/', 		'TableController@index');
		Route::post('guardar',	'TableController@guardar');
	});
	
	//{{route}}
});
