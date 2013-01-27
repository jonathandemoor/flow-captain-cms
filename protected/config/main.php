<?php

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Flow Captain CMS',

	'preload'=>array(
		'log',
		'bootstrap'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),
	
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),

	'modules'=>array(
		'gii'=>array(
	        'generatorPaths'=>array(
	            'bootstrap.gii',
	        ),
	    ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		'bootstrap'=>array(
			'class'         => 'ext.bootstrap.components.Bootstrap',
			'coreCss'       => true,
			'responsiveCss' => true,
	        'plugins'		=> array(
				'transition' => true,
				'modal'      => true,
	        ),
	    ),
	    'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            'driver'=>'GD',
            'params'=>array('directory'=>'/opt/local/bin'),
        ),		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'login'										=> 'site/login',
				'logout'									=> 'site/logout',
				'<controller:\w+>/<id:\d+>'					=> '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'	=> '<controller>/<action>',
				'<controller:\w+>/<action:\w+>'				=> '<controller>/<action>',
			),
		),
		
		'db'=> include(dirname(__FILE__) . '/db.php'),
		
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	'params' => include(dirname(__FILE__) . '/params.php'),
);