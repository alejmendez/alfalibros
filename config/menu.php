<?php

$menu = [];

$modules = ['app', 'modules.json'];
$modules = implode(DIRECTORY_SEPARATOR , $modules);
$modules = storage_path($modules);
$modules = file_get_contents($modules);
$modules = json_decode($modules);
$modules = collect($modules);

//$modules = \Nwidart\Modules\Facades\Module::all();

foreach ($modules->sortBy('order') as $module) {
	$file = base_path(implode(DIRECTORY_SEPARATOR , ['app', 'Modules', $module->name, 'Config', 'menu.php']));

	if (!is_file($file)) {
		continue;
	}
	
	$menu[$module->slug] = [];

	include($file);
}

//dd($menu);
return $menu;