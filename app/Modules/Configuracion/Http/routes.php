<?php

Route::group(['middleware' => 'web', 'prefix' => 'configuracion', 'namespace' => 'alfalibros\\Modules\Configuracion\Http\Controllers'], function()
{
    Route::get('/', 'ConfiguracionController@index');
});