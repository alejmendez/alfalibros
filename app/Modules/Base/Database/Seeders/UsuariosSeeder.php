<?php 

namespace alfalibros\Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use alfalibros\Modules\Base\Models\Usuario;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = Usuario::create([
			'usuario' => 'admin',
			'nombre' => 'Administrador',
			'apellido'=> '',
			'password' => 'admin',
			'dni' => 12345678,
			'correo' => 'admin@gmail.com',
			'telefono' => '0414-123-1234',
			'autenticacion' => 'B',
			'perfil_id' => 1,
			'super' => 's',
			'sexo'=> 'm',
			'edo_civil'=> 's'
		]);
    }
}
