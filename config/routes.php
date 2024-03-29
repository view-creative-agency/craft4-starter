<?php
/**
 * Site URL Rules
 *
 * You can define custom site URL rules here, which Craft will check in addition
 * to any routes you’ve defined in Settings → Routes.
 *
 * See http://www.yiiframework.com/doc-2.0/guide-runtime-routing.html for more
 * info about URL rules.
 *
 * In addition to Yii’s supported syntaxes, Craft supports a shortcut syntax for
 * defining template routes:
 *
 *     'blog/archive/<year:\d{4}>' => ['template' => 'blog/_archive'],
 *
 * That example would match URIs such as `/blog/archive/2012`, and pass the
 * request along to the `blog/_archive` template, providing it a `year` variable
 * set to the value `2012`.
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
	'rss/all' => ['template' => 'rss/all'],

	// misc
	'saved-entries' => ['template' => '_partials/saved-entries']
];
