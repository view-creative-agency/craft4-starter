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

	return GeneralConfig::create()
		->isSystemLive(App::env('SYSTEM_IS_LIVE'))
		->devMode($isDev)

		->defaultCountryCode('GB')
		->useEmailAsUsername(true)
		->loginPath('customer/sign-in')
		->setPasswordRequestPath('customer/reset-password')
		->setPasswordPath('customer/set-password')

		->preloadSingles()
		->preventUserEnumeration()
		->omitScriptNameInUrls(true)
		->cpTrigger(App::env('CP_TRIGGER'))
		->postCpLoginRedirect('entries')
		->allowAdminChanges($isDev)
		->allowUpdates($isDev)
		->disallowRobots(!$isProd)
		->maxRevisions(10)
		->maxBackups(10)
		->defaultWeekStartDay(1)
		->enableTemplateCaching($blitzCacheEnabled)
		->translationDebugOutput(false)
		->errorTemplatePrefix('_errors/')
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
