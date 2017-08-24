<?php

$menu['base'] = [
	[
		'nombre' 	=> 'Administrador',
		'direccion' => '#Administrador',
		'icono' 	=> 'fa fa-gear',
		'menu' 		=> [
			[
				'nombre' 	=> 'Usuarios',
				'direccion' => 'usuarios',
				'icono' 	=> 'fa fa-user'
			],
			[
				'nombre' 	=> 'Perfiles',
				'direccion' => 'perfiles',
				'icono' 	=> 'fa fa-users'
			],
			[
				'nombre' 	=> 'Bancos',
				'direccion' => 'bancos',
				'icono' 	=> 'fa fa-bank'
			]
		]
	], 
	[
		'nombre' 	=> 'Compras',
		'direccion' => '#Compras',
		'icono' 	=> 'fa fa-shopping-bag',
		'menu' 		=> [
			[
				'nombre' 	=> 'Compras',
				'direccion' => 'compras',
				'icono' 	=> 'fa fa-shopping-bag'
			]
		]
	]
];