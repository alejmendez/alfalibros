<?php

namespace alfalibros\Modules\Configuracion\Database\Seeders;

use Illuminate\Database\Seeder;
use alfalibros\Modules\Configuracion\Models\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$configuraciones = [
			'logo'           => 'logo.png',
			'login_logo'     => 'login_logo.png',
			'nombre'         => 'alfalibros',
			'formato_fecha'  => 'd/m/Y',
			'miles'          => '.',
			'email'          => 'admin@tumundoclick.com.ve',
			'email_name'     => 'Tumundoclick',
			'nombre_empresa' => 'Alfalibros.com',
			'warehouse'      => '2',
    	];

    	foreach ($configuraciones as $propiedad => $valor) {
	        Configuracion::create([
				'propiedad' => $propiedad,
				'valor' => $valor
			]);
    	}
    }
}
