<?php

return array(

	'root' => public_path('css'),
	'public_uri' => '/css/',

	'assets' => [
		'less' => app_path('views/less/site/site.less'),
		'css' => app_path('views/css/*'),
	],

	'assetCache' => [
		'assetcache' => 'Assetic\Asset\AssetCache',
		'cache' => 'Assetic\Cache\FilesystemCache',
		'storage_path' => storage_path('cache')
	],

	'filters' => [
		'less' => 'Zae\Larattic\Filters\LessFilter',
		'minify' => '\Assetic\Filter\CssMinFilter'
	],

	'workers' => [
//		'Assetic\Factory\Worker\CacheBustingWorker' => default worker, doesn't need to be added.
	],

	'options' => [
		'output' => 'style.css'
	]

);
