<?php
/**
 * Site URL Rules
 *
 * You can define custom site URL rules here, which Craft will check in addition
 * to any routes you’ve defined in Settings → Routes.
 *
 * https://craftcms.com/docs/4.x/routing.html
 */

return [
    // News section
    'news/archive/<year:\d{4}>/<month:\d{2}>' => ['template' => 'news/archive'],
    'news/archive/<year:\d{4}>'               => ['template' => 'news/archive'],

    // GraphQL
    'api1' => 'graphql/api',

    // responsive image template
    'responsive-image/<number:\d+>' => ['template' => 'responsive-image'],

    // RSS of last 10 news items
    'rss/all' => ['template' => 'rss/all']
];
