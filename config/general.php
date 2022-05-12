<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

$isDev  = App::env('ENVIRONMENT') === 'dev';
$isProd = App::env('ENVIRONMENT') === 'production';

return [
    // Global settings
    '*' => [
        'defaultWeekStartDay' => 1, // (0 = Sunday, 1 = Monday...)
        'omitScriptNameInUrls' => true,
        'cpTrigger' => App::env('CP_TRIGGER') ?: 'admin',
        'securityKey' => App::env('SECURITY_KEY'), // The secure key Craft will use for hashing and encrypting data
        'devMode' => $isDev,
        'allowAdminChanges' => $isDev,
        'allowUpdates' => $isDev,
        'disallowRobots' => !$isProd,
        'maxRevisions' => 15,
        'useEmailAsUsername' => true,

        // https://docs.craftcms.com/v3/config/#aliases
        'aliases' => [
            '@web' => rtrim( App::env('PRIMARY_SITE_URL'), '/' ), // explicitly set to avoid cache poisoning vulnerability
            '@webroot' => dirname(__DIR__) . '/web', // console command compat

            '@primarySiteUrl' => rtrim( App::env('PRIMARY_SITE_URL'), '/' ), // explicitly set to avoid cache poisoning vulnerability
            '@primarySiteWebroot' => dirname(__DIR__) . '/web', // console command compat
        ],

        // https://github.com/craftcms/cms/issues/1511
        'extraFileKinds' => [
            'svg' => [
                'label' => 'SVG',
                'extensions' => ['svg']
            ],
            'photos' => [
                'label' => 'Photos',
                'extensions' => ['jpg', 'jpeg', 'webp']
            ],
            'logos' => [
                'label' => 'Logos',
                'extensions' => ['png', 'svg']
            ],
        ],
    ],

    'dev' => [
        'enableTemplateCaching'  => false, // Whether to enable Craft's template {% cache %} tag on a global basis
        'translationDebugOutput' => false, // Whether translated messages should be wrapped in special characters, to help find any strings that are not being run through `Craft::t()` or the `|translate` filter.
        'testToEmailAddress'     => App::env('TEST_TO_EMAIL_ADDRESS'), // Configures Craft to send all system emails to a single email address, or an array of email addresses for testing purposes.
    ],
];
