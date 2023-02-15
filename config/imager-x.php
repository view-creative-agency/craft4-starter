<?php
// General ImagerX settings here, see:
// https://imager-x.spacecat.ninja/configuration.html#general-configuration

use craft\helpers\App;

return [
	'*' => [
		'interlace' => true,
		'allowUpscale' => true,
		'safeFileFormats' => ['jpg', 'jpeg', 'gif', 'png', 'webp'],
		'optimizerConfig' => [
			'jpegoptim' => [
				'extensions' => ['jpg'],
				'path' => '/usr/bin/jpegoptim',
				'optionString' => '-s',
			],
			'jpegtran' => [
				'extensions' => ['jpg'],
				'path' => '/usr/bin/jpegtran',
				'optionString' => '-optimize -copy none -progressive',
			],
			'mozjpeg' => [
				'extensions' => ['jpg'],
				'path' => '/usr/bin/mozjpeg',
				'optionString' => '-optimize -copy none',
			],
			'optipng' => [
				'extensions' => ['png'],
				'path' => '/usr/bin/optipng',
				'optionString' => '-o4 -strip all',
			],
			'gifsicle' => [
				'extensions' => ['gif'],
				'path' => '/usr/bin/gifsicle',
				'optionString' => '--optimize=3 --colors 128',
			],
		],
		'optimizers' => ['mozjpeg', 'optipng', 'gifsicle']
	],

	'dev' => [
		'mockImage' => App::env('PATH_TO_MOCK_IMAGE') ?: null,
		'cacheEnabled' => true,
		'suppressExceptions' => false
	],

	'staging' => [
		// Ubuntu doesn't have webp support baked into ImageMagik, so we provide cwebp
		'customEncoders' => [
			'webp' => [
				'path' => App::env('PATH_TO_CWEBP'),
				'options' => [
					'quality' => 80,
					'effort' => 4,
				],
				'paramsString' => '-q {quality} -m {effort} {src} -o {dest}'
			],
		],
	],

	'production' => [
		// Ubuntu doesn't have webp support baked into ImageMagik, so we provide cwebp
		'customEncoders' => [
			'webp' => [
				'path' => App::env('PATH_TO_CWEBP'),
				'options' => [
					'quality' => 80,
					'effort' => 4,
				],
				'paramsString' => '-q {quality} -m {effort} {src} -o {dest}'
			],
		],
	]
];
