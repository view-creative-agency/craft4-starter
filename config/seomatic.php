<?php

use craft\helpers\App;

$isProd = App::env('CRAFT_ENVIRONMENT') === 'production'; // Evaluates to true or false

return [
	'pluginName'      => 'SEO',
	'environment'     => $isProd ? 'live' : 'local',
	'renderEnabled'   => $isProd,
	'sitemapsEnabled' => $isProd,
];
