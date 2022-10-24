<?php
// Config for the Craft Vite Plugin (not for Vite itself, that's at /vite.config.js)
	use craft\helpers\App;

	$isDev  = App::env('CRAFT_ENVIRONMENT') === 'dev';
	$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';

	return [
		// 'useDevServer'      => App::env('ENVIRONMENT') === 'dev',
		'checkDevServer'    => true,
		'devServerInternal' => 'http://localhost:3000',

		'manifestPath'    => Craft::getAlias('@webroot') . '/dist/manifest.json',
		'devServerPublic' => Craft::getAlias('@web') . ':3000',
		'serverPublic'    => Craft::getAlias('@web') . '/dist/',
		'errorEntry'      => 'src/js/app.js',
		'useDevServer'    => $isDev,
	];
