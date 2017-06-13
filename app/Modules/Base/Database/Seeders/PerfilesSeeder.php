<?php 

namespace alfalibros\Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use alfalibros\Modules\Base\Models\Perfil;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = [
            'Desarrollador',
            'Administrador',
            'Tecnico',
            'Supervisor',
            'Asistente',
            'Secretaria',
            'Administracion',
            'Contador',
        ];

        foreach ($perfiles as $perfil) {
            Perfil::create([
                'nombre' => $perfil
            ]);
        }
    }
}
