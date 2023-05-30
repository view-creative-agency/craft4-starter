<?php /** @noinspection ProblematicWhitespace */

/**
	 * General Configuration
	 *
	 * All of your system's general configuration settings go in here. You can see a
	 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
	 *
	 * @see \craft\config\GeneralConfig
	 */

	use craft\config\GeneralConfig;
	use craft\helpers\App;

	$isDev  = App::env('CRAFT_ENVIRONMENT') === 'dev';
	$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';
	$blitzCacheEnabled = App::env('BLITZ_CACHE_ENABLED') === 'true';

	// Do we want the templateCaching disabled (i.e., if Blitz is enabled or we are in dev)
	$enableTemplateCaching = true;
	if ( $blitzCacheEnabled or $isDev ) {
		$enableTemplateCaching = false;
	}

	return GeneralConfig::create()
		->omitScriptNameInUrls(true)
		->defaultWeekStartDay(1)
		->isSystemLive(App::env('SYSTEM_IS_LIVE'))
		->cpTrigger(App::env('CP_TRIGGER'))
		->devMode($isDev)
		->allowAdminChanges($isDev)
		->allowUpdates($isDev)
		->disallowRobots(!$isProd)
		->maxRevisions(10)
		->maxBackups(10)
		->enableTemplateCaching($enableTemplateCaching)
		->translationDebugOutput(false)
		->errorTemplatePrefix('_errors')
		->postCpLoginRedirect('entries')
		->preventUserEnumeration()
		->testToEmailAddress($isDev ? App::env('TEST_TO_EMAIL_ADDRESS') : null)
		->accessibilityDefaults([
			'useShapes' => true,
		])
		->aliases([
			'@web'     => rtrim(APP::env('PRIMARY_SITE_URL'), '/'), // explicitly set to avoid cache poisoning vulnerability
			'@webroot' => rtrim(APP::env('PRIMARY_SITE_WEB_ROOT'), '/'), // console command compat

			'@primarySiteUrl'     => rtrim(APP::env('PRIMARY_SITE_URL'), '/'), // explicitly set to avoid cache poisoning vulnerability
			'@primarySiteWebRoot' => rtrim(APP::env('PRIMARY_SITE_WEB_ROOT'), '/'), // console command compat
		])
		->extraFileKinds([
			'svg'    => [
				'label'      => 'SVG',
				'extensions' => ['svg']
			],
			'photos' => [
				'label'      => 'Photos',
				'extensions' => ['jpg', 'jpeg', 'webp']
			],
			'logos'  => [
				'label'      => 'Logos',
				'extensions' => ['png', 'svg']
			],
		]);
