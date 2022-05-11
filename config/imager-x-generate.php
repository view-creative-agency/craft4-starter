<?php
// when to generate which Named Transforms, see:
// https://imager-x.spacecat.ninja/usage/generate.html#setting-it-up

return [
    'elements' => [
        [
            'elementType' => \craft\elements\Entry::class,
            'criteria' => [
                'section' => 'pages'
            ],
            'fields' => [
                'listingImage'
            ],
            'transforms' => [
                'bannerImageJpg',
                'bannerImageWebp'
            ]
        ]
    ]
];