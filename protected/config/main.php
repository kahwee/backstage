<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Backstage',
	// preloading 'log' component
	'preload' => array('log'),
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'ext.giix-components.*',
	),
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '1234',
			'ipFilters' => array('127.0.0.1', '::1'),
			'generatorPaths' => array(
				'ext.giix-core', // giix generators
				'application.gii',
				'ext.bootstrap-theme.gii',
			),
		),
		'backstage' => array(
			#'autoloadModels' => false,
			'models' => array(
				'Tag' => array(
					'id' => array(
						'control' => 'datetime',
						'visible' => true,
					),
				),
				'User' => false,
				'Article' => array(
					'content' => array(
						'control' => 'richtext',
					),
					'create_by' => array(
						'control' => 'relation',
					),
					'create_time' => array(
						'visible' => array('index', 'search'),
						'locked' => array('update'),
					),
				),
			)
		),
	),
	// application components
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
			'showScriptName' => false,
		),
		'db' => array(
			'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		/*
		  'db'=>array(
		  'connectionString' => 'mysql:host=localhost;dbname=testdrive',
		  'emulatePrepare' => true,
		  'username' => 'root',
		  'password' => '',
		  'charset' => 'utf8',
		  ),
		 */
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			// uncomment the following to show log messages on web pages
			/*
			  array(
			  'class'=>'CWebLogRoute',
			  ),
			 */
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
);
