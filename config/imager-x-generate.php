<?php
// when to generate which Named Transforms, see:
// https://imager-x.spacecat.ninja/usage/generate.html#setting-it-up
// https://imager-x.spacecat.ninja/configuration.html#configuring-automatic-generation-of-transforms

use craft\elements\Entry;

return [
	'elements' => [
		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'listingImage'
			],
			'transforms' => [
				'bannerImageJpg',
				'bannerImageWebp'
			]
		],

		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:textByImage.image'
			],
			'transforms' => [
				'textByImageJpg',
				'textByImageWebp'
			]
		],

		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:imageSingle.uncropped'
			],
			'transforms' => [
				'imageSingleUncroppedJpg',
				'imageSingleUncroppedWebp'
			]
		],
		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:imageSingle.landscape32'
			],
			'transforms' => [
				'imageSingleLandscape32Jpg',
				'imageSingleLandscape32Webp'
			]
		],
		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:imageSingle.landscape169'
			],
			'transforms' => [
				'imageSingleLandscape169Jpg',
				'imageSingleLandscape169Webp'
			]
		],
		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:imageSingle.landscape2391'
			],
			'transforms' => [
				'imageSingleLandscape2391Jpg',
				'imageSingleLandscape2391Webp'
			]
		],

		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:imagesGrid.images'
			],
			'transforms' => [
				'imagesGridJpg',
				'imagesGridWebp',
				'lightboxJpg',
				'lightboxWebp'
			]
		],

		[
			'elementType' => Entry::class,
			'criteria' => [
				'section' => '*'
			],
			'fields' => [
				'mixedContent:featuredLink.backgroundImage'
			],
			'transforms' => [
				'bannerImageJpg',
				'bannerImageWebp'
			]
		],

	]
];
