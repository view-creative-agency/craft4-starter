<?php
// Named Transforms are stored here, see:
// https://imager-x.spacecat.ninja/usage/named-transforms.html#nested-named-transforms

return [
    'bannerImageJpg' => [
        'defaults' => [
            'format' => 'jpg',
            'mode' => 'crop',
            'ratio' => 2.39/1,
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
    ]
];