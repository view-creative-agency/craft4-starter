<?php
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

	return GeneralConfig::create()
		->omitScriptNameInUrls(true)
		->defaultWeekStartDay(1)
		->cpTrigger(App::env('CP_TRIGGER'))
		->devMode($isDev)
		->allowAdminChanges($isDev)
		->allowUpdates($isDev)
		->disallowRobots(!$isProd)
		->maxRevisions(10)
		->maxBackups(10)
		->enableTemplateCaching(!$isDev)
		->translationDebugOutput(false)
		->errorTemplatePrefix('_errors')
		->postCpLoginRedirect('entries')
		->testToEmailAddress(App::env('TEST_TO_EMAIL_ADDRESS'))
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
