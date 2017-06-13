<?php

$menu['base'][0]['menu'][] = [
	'nombre' 	=> 'Generador',
	'direccion' => '#Generador',
	'icono' 	=> 'fa fa-gear',
	'menu' 		=> [
		[
			'nombre' 	=> 'Tablas',
			'direccion' => 'generador/table',
			'icono' 	=> 'fa fa-user'
		],
		[
			'nombre' 	=> 'Generador',
			'direccion' => 'generador',
			'icono' 	=> 'fa fa-users'
		]
	]
];