<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
	'name' => 'Teachblock',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'layout' => 'base',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		
		'yiimorphy' => [
            'class' => 'maxodrom\phpmorphy\components\YiiMorphy',
            'language' => 'de',
        ],
		
		'reCaptcha' => [
        'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
        'siteKeyV2' => '6Ld_18AUAAAAAEqxaw3a258njKB7EHavOFqqCdF9',
        'secretV2' => '6Ld_18AUAAAAAIujzUief-JLB4WFTyhakjsJJQuZ',
        'siteKeyV3' => '',
        'secretV3' => '',
		],
 
        
        'urlManager' => [
			'showScriptName' => false,
			'enableStrictParsing' => true,
			'enablePrettyUrl' => true,
			'rules' => array(
		 
				'/' => 'site/index',
				
				'<action:\w+>' => 'site/<action>',
                
				'<action:search|request-password-reset|resend-verification-email|signup-confirm|reset-password>' => 'site/<action>',
				
				'post/<id:\d+>' => 'site/view',
				
				'post/<id:\d+>' => 'site/course',
				
				'page/<page:\d+>' => 'site/news',
				
				'page/<page:\d+>' => 'site/courses',
					
			),

		],
        
    ],
    'params' => $params,
];
