<?php

use craft\helpers\App;

return [
	'*' => [
		// With this setting enabled, Blitz will log detailed messages to `storage/logs/blitz.log`.
		//'debug' => false,

		// With this setting enabled, Blitz will provide template performance hints in a utility.
		//'hintsEnabled' => true,

		// With this setting enabled, Blitz will begin caching pages according to the included/excluded URI patterns. Disable this setting to prevent Blitz from caching any new pages.
		'cachingEnabled' => App::env('BLITZ_CACHE_ENABLED') ?: false,

		// Determines when and how the cache should be refreshed.
		// https://putyourlightson.com/plugins/blitz#refresh-mode
		// - `0`: Expire the cache, regenerate manually
		// - `1`: Clear the cache, regenerate manually or organically
		// - `2`: Expire the cache and regenerate in a queue job
		// - `3`: Clear the cache and regenerate in a queue job
		'refreshMode' => 2,

		// The URI patterns to include in caching. Set `siteId` to a blank string to indicate all sites.
		'includedUriPatterns' => [
			[
				'siteId' => 2,
				'uriPattern' => '.*',
			],
		],

		// The URI patterns to exclude from caching (overrides any matching patterns to include). Set `siteId` to a blank string to indicate all sites.
		'excludedUriPatterns' => [
			['siteId' => 2, 'uriPattern' => 'saved-entries'],

			['siteId' => 2, 'uriPattern' => 'customer/*'],
			['siteId' => 2, 'uriPattern' => 'online-store/basket'],
			['siteId' => 2, 'uriPattern' => 'online-store/checkout/*'],
		],

		// The storage type to use.
		'cacheStorageType' => 'putyourlightson\blitz\drivers\storage\FileStorage',

		// The storage settings.
		'cacheStorageSettings' => [
			'folderPath' => '@webroot/cache/blitz',
			'createGzipFiles' => false,
			'countCachedFiles' => true,
		],

		// The storage type classes to add to the plugin’s default storage types.
		//'cacheStorageTypes' => [],

		// The generator type to use.
		//'cacheGeneratorType' => 'putyourlightson\blitz\drivers\generators\HttpGenerator',

		// The generator settings.
		//'cacheGeneratorSettings' => ['concurrency' => 3],

		// The generator type classes to add to the plugin’s default generator types.
		//'cacheGeneratorTypes' => [],

		// Custom site URIs to generate when either a site or the entire cache is generated.
		//'customSiteUris' => [
		//    [
		//        'siteId' => 1,
		//        'uri' => 'pages/custom',
		//    ],
		//],

		// The purger type to use.
		//'cachePurgerType' => 'putyourlightson\blitz\drivers\purgers\CloudflarePurger',

		// The purger settings (zone ID keys are site UIDs).
		//'cachePurgerSettings' => [
		//    'zoneIds' => [
		//        'f64d4923-f64d4923-f64d4923' => [
		//            'zoneId' => '',
		//        ],
		//    ],
		//    'authenticationMethod' => 'apiKey',
		//    'apiKey' => '',
		//    'email' => '',
		//],

		// The purger type classes to add to the plugin’s default purger types.
		//'cachePurgerTypes' => [
		//    'putyourlightson\blitzcloudfront\CloudFrontPurger',
		//],

		// The deployer type to use.
		//'deployerType' => 'putyourlightson\blitz\drivers\deployers\GitDeployer',

		// The deployer settings (zone ID keys are site UIDs).
		//'deployerSettings' => [
		//    'gitRepositories' => [
		//        'f64d4923-f64d4923-f64d4923' => [
		//            'repositoryPath' => '@root/path/to/repo',
		//            'branch' => 'master',
		//            'remote' => 'origin',
		//        ],
		//    ],
		//    'commitMessage' => 'Blitz auto commit',
		//    'username' => '',
		//    'personalAccessToken' => '',
		//    'name' => '',
		//    'email' => '',
		//    'commandsBefore' => '',
		//    'commandsAfter' => '',
		//],

		// The deployer type classes to add to the plugin’s default deployer types.
		//'deployerTypes' => [
		//    'putyourlightson\blitzshell\ShellDeployer',
		//],

		// With this setting enabled, Blitz will statically include templates using Server-Side Includes (SSI), which must be enabled on the web server.
		'ssiEnabled'   => App::env('SSI_ENABLED'),
		'ssiTagFormat' => App::env('SERVER_TYPE') === 'caddy' ?
			'<!--#caddy httpInclude "{uri}" -->' :
			'<!--#include virtual="{uri}" -->',

		// With this setting enabled, Blitz will statically include templates using Edge-Side Includes (ESI), which must be enabled on the web server or CDN.
		//'esiEnabled' => false,

		// Whether URLs with query strings should be cached and how.
		// - `0`: Do not cache URLs with query strings
		// - `1`: Cache URLs with query strings as unique pages
		// - `2`: Cache URLs with query strings as the same page
		'queryStringCaching' => 0,

		// The query string parameters to include when determining if and how a page should be cached (regular expressions may be used).
		//'includedQueryStringParams' => [
		//    [
		//        'siteId' => '',
		//        'queryStringParam' => '.*',
		//    ],
		//],

		// The query string parameters to exclude when determining if and how a page should be cached (regular expressions may be used).
		//'excludedQueryStringParams' => [
		//    [
		//        'siteId' => '',
		//        'queryStringParam' => 'gclid',
		//    ],
		//    [
		//        'siteId' => '',
		//        'queryStringParam' => 'fbclid',
		//    ],
		//],

		// An API key that can be used via a URL (min. 16 characters).
		//'apiKey' => '',

		// Whether pages containing query string parameters should be generated.
		//'generatePagesWithQueryStringParams' => true,

		// Whether the cache should automatically be refreshed after a global set is updated.
		//'refreshCacheAutomaticallyForGlobals' => true,

		// Whether the cache should be refreshed when an element is moved within a structure.
		//'refreshCacheWhenElementMovedInStructure' => true,

		// Whether the cache should be refreshed when an element is saved but unchanged.
		//'refreshCacheWhenElementSavedUnchanged' => false,

		// Whether the cache should be refreshed when an element is saved but not live.
		//'refreshCacheWhenElementSavedNotLive' => false,

		// Whether non-HTML responses should be cached. With this setting enabled, Blitz will also cache pages that return non-HTML responses. If enabled, you should ensure that URIs that should not be caches, such as API endpoints, XML sitemaps, etc. are added as excluded URI patterns.
		//'cacheNonHtmlResponses' => false,

		// Whether elements should be cached in the database.
		//'cacheElements' => true,

		// Whether element queries should be cached in the database.
		//'cacheElementQueries' => true,

		// The amount of time after which the cache should expire (if not 0). See [[ConfigHelper::durationInSeconds()]] for a list of supported value types.
		//'cacheDuration' => 0,

		// Element types that should not be cached (in addition to the defaults).
		//'nonCacheableElementTypes' => [
		//    'putyourlightson\campaign\elements\ContactElement',
		//],

		// Source ID attributes for element types (in addition to the defaults).
		//'sourceIdAttributes' => [
		//    'putyourlightson\campaign\elements\CampaignElement' => 'campaignTypeId',
		//],

		// The integrations to initialise. BY DEFAULT THEY'RE ALL INITIALISED
		// 'integrations' => [
		// 	'putyourlightson\blitz\drivers\integrations\CommerceIntegration',
		// 	'putyourlightson\blitz\drivers\integrations\FeedMeIntegration',
		// 	'putyourlightson\blitz\drivers\integrations\SeomaticIntegration',
		// ],

		// The value to send in the cache control header.
		//'cacheControlHeader' => 'public, s-maxage=31536000, max-age=0',

		// Whether an `X-Powered-By: Blitz` header should be sent.
		//'sendPoweredByHeader' => true,

		// Whether the "cached on" and "served by" timestamp comments should be appended to the cached output.
		// - `false`: Do not append any comments
		// - `true`: Append all comments
		// - `2`: Append "cached on" comment only
		// - `3`: Append "served by" comment only
		//'outputComments' => true,

		// The priority to give the refresh cache job (the lower the number, the higher the priority). Set to `null` to inherit the default priority.
		//'refreshCacheJobPriority' => 10,

		// The priority to give driver jobs (the lower the number, the higher the priority). Set to `null` to inherit the default priority.
		//'driverJobPriority' => 100,

		// The time to reserve for queue jobs in seconds.
		//'queueJobTtr' => 300,

		// The maximum number of times to attempt retrying a failed queue job.
		//'maxRetryAttempts' => 10,

		// The time in seconds to wait for mutex locks to be released.
		//'mutexTimeout' => 1,

		// The paths to executable shell commands.
		//'commands' => [
		//    'git' => '/usr/bin/git',
		//],

		// The name of the JavaScript event that will trigger a script inject.
		//'injectScriptEvent' => 'DOMContentLoaded',
	],
];
