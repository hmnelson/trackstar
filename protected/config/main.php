<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'TrackStar',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'B1ll_murr4y',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','128.210.93.*'),
			'generatorPaths'=>array(
					'bootstrap.gii',
			),
		),
		
	),

	// application components
	'components'=>array(
	
		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
		),
				
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		
		// uncomment the following to use a local MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=pmm',
			'tablePrefix' => 'ts_',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
		
		// uncomment the following to use a MySQL database on the Purdue cluster
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=lppdbamys01.itap.purdue.edu;dbname=pmm',
			'tablePrefix' => 'ts_',
			'emulatePrepare' => true,
			'username' => 'pmm',
			'password' => 'B1ll_murr4y',
			'charset' => 'utf8',
		),
		*/
		
		'authManager'=>array(
		  'class'=>'CDbAuthManager',
			'connectionID'=>'db',
			'itemTable'=>'mmw_authItem',
			'itemChildTable'=>'mmw_authItemChild',
			'assignmentTable'=>'mmw_authAssignment',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'pmmweb@purdue.edu',
	),
);