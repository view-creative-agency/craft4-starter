<?php
// Named Transforms are stored here, see:
// https://imager-x.spacecat.ninja/usage/named-transforms.html#nested-named-transforms

return [
	'bannerImageJpg' => [
		'defaults' => [
			'format' => 'jpg',
			'mode' => 'crop',
			'ratio' => 2.39,
			'jpegQuality' => 80
		],
		'transforms' => [
			['width' => 480, 'ratio' => '16/9'],
			['width' => 960],
			['width' => 1500],
			['width' => 2200]
		]
	],
	'bannerImageWebp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'bannerImageJpg'
	],

	'textByImageJpg' => [
		'defaults' => [
			'format' => 'jpg',
			'mode' => 'crop',
			'ratio' => 4 / 3,
			'jpegQuality' => 80
		],
		'transforms' => [
			['width' => 720, 'ratio' => '16 / 9'],
			['width' => 960]
		]
	],
	'textByImageWebp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'textByImageJpg'
	],

	'imageSingleUncroppedJpg' => [
		'defaults' => [
			'format' => 'jpg',
			'mode' => 'crop',
			'jpegQuality' => 80
		],
		'transforms' => [
			['width' => 960],
			['width' => 1500],
			['width' => 2200]
		]
	],
	'imageSingleUncroppedWebp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'imageSingleUncroppedJpg'
	],

	'imageSingleLandscape32Jpg' => [
		'defaults' => [
			'format' => 'jpg',
			'ratio' => 3/2,
			'mode' => 'crop',
			'jpegQuality' => 80,
		],
		'transforms' => [
			['width' => 960],
			['width' => 1500],
			['width' => 2200]
		]
	],
	'imageSingleLandscape32Webp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'imageSingleLandscape32Jpg'
	],

	'imageSingleLandscape169Jpg' => [
		'defaults' => [
			'format' => 'jpg',
			'ratio' => 16/9,
			'mode' => 'crop',
			'jpegQuality' => 80,
		],
		'transforms' => [
			['width' => 960],
			['width' => 1500],
			['width' => 2200]
		]
	],
	'imageSingleLandscape169Webp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'imageSingleLandscape169Jpg'
	],

	'imageSingleLandscape2391Jpg' => [
		'defaults' => [
			'format' => 'jpg',
			'ratio' => 2.39,
			'mode' => 'crop',
			'jpegQuality' => 80,
		],
		'transforms' => [
			['width' => 960],
			['width' => 1500],
			['width' => 2200]
		]
	],
	'imageSingleLandscape2391Webp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'imageSingleLandscape2391Jpg'
	],

	'imagesGridJpg' => [
		'defaults' => [
			'format' => 'jpg',
			'mode' => 'crop',
			'ratio' => 1,
			'jpegQuality' => 80
		],
		'transforms' => [
			['width' => 420]
		]
	],
	'imagesGridWebp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'imagesGridJpg'
	],

	'imageListingExcerptJpg' => [
		'defaults' => [
			'format' => 'jpg',
			'mode' => 'crop',
			'ratio' => 2.39,
			'jpegQuality' => 80
		],
		'transforms' => [
			['width' => 420]
		]
	],
	'imageListingExcerptWebp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'imageListingExcerptJpg'
	],

	'lightboxJpg' => [
		'defaults' => [
			'format' => 'jpg',
			'mode' => 'crop',
			'jpegQuality' => 80
		],
		'transforms' => [
			['width' => 960],
			['width' => 1500]
		]
	],
	'lightboxWebp' => [
		'defaults' => [
			'format' => 'webp',
			'webpQuality' => 80
		],
		'transforms' => 'lightboxJpg'
	],
];
