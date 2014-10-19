<?php

return array(

	'root' => public_path('js'),
	'public_uri' => '/js/',

	'assets' => [
		'js' => app_path('views/js/main.js'),
	],

	'assetCache' => [
		'assetcache' => 'Assetic\Asset\AssetCache',
		'cache' => 'Assetic\Cache\FilesystemCache',
		'storage_path' => storage_path('cache')
	],

	'filters' => [
		'commonjs' => 'Zae\Larattic\Filters\CommonJSFilter',
	],

	'workers' => [
//		'Assetic\Factory\Worker\CacheBustingWorker' => default worker, doesn't need to be added.
	],

	'options' => [
		'output' => 'script.js'
	]

);
