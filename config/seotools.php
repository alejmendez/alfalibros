<?php

return [
	'meta'      => [
		/*
		 * The default configurations to be used by the meta generator.
		 */
		'defaults'       => [
			'title'        => "Alfalibros C.A.", // set false to total remove
			'description'  => 'Alfalibros C.A. description', // set false to total remove
			'separator'    => ' - ',
			'keywords'     => [],
			'canonical'    => false, // Set null for using Url::current(), set false to total remove
		],

		/*
		 * Webmaster tags are always added.
		 */
		'webmaster_tags' => [
			'google'    => null,
			'bing'      => null,
			'alexa'     => null,
			'pinterest' => null,
			'yandex'    => null,
		],
	],
	'opengraph' => [
		/*
		 * The default configurations to be used by the opengraph generator.
		 */
		'defaults' => [
			'title'       => 'Alfalibros C.A.', // set false to total remove
			'description' => 'Alfalibros C.A. description', // set false to total remove
			'url'         => false,
			'type'        => false,
			'site_name'   => false,
			'images'      => [],
		],
	],
	'twitter' => [
		/*
		 * The default values to be used by the twitter cards generator.
		 */
		'defaults' => [
			'card'        => 'summary',
			'site'        => '@tumundoclick',
			'site'        => 'Tumundoclick Venezuela - Somos Publicidad y Tecnología',
			'description' => 'Empresa dedicada a promover el crecimiento de las Pymes y Grandes empresas, impulsandolas en el mercado con herramientas informàticas de alto impacto.',
			'creator'     => '@tumundoclick',
			'image'       => 'https://4.bp.blogspot.com/-AYhJ3r4JTsU/WI4FzNkujiI/AAAAAAAACDk/EjlzZVQUPFgIX4t676xpULFgBVeTovuMgCLcB/s1600/Logo%2BTumundoclick%2B400x400.jpg',
		],
	],
];
