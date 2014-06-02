<?php

include 'constants.php';

return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name'     => 'TwiWordsCloud',
	'preload'  => array('log'),
	'import'   => array(
		'application.models.*',
		'application.helpers.*',
		'application.components.*',
	),
	'components' => array(
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules'     => array(
				'<controller:\w+>/<id:\d+>'              => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
			),
		),
		'db' => array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/devres1.db',
		),
		'errorHandler' => array(
			'errorAction'=>'error/index',
		),
		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
				array(
					'class'  => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
		'Twt' => array(
            'class'  => 'application.extensions.Twt.Twt',
            'config' => array(
				'api_key'    => TWITTER_API_KEY,
				'api_secret' => TWITTER_API_SECRET,
			),
		),
		'TwitterData' => array(
            'class' => 'application.components.TwitterData',
        ),
	),
);