<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'           => 'basic',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log', 'api'],
    'homeUrl'      => 'login',
    'defaultRoute' => 'login',
    'language'     => 'ru',
    'modules'        => [
        'api' => 'api\Module'
    ],
    'components'   => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5MLnCDCuzk1UrYECizML8AXux4lHBbtu',

            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]

        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl'        => 'login'
        ],
        'errorHandler' => [
            'errorAction' => 'error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => require(__DIR__ . '/db.php'),
        'crmNotifier'  => [
            'class' => 'app\components\CrmNotifier',
            'apis'  => [
                'newReport'    => 'http://localhost:8001/crm.php/?action=newReport',
                'newOperation' => 'http://localhost:8001/crm.php?action=newOperation'
            ]
        ],
        'i18n'         => [
            'translations' => [
                'app*' => [
                    'class'   => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php'
                    ],
                ],
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => true,
            'showScriptName'      => false,
            'rules'               => [
                ''                      => 'login/login',
                '<controller:(login|user|admin)>/<action>' => "<controller>/<action>",
            ],
        ],

    ],
    'params'       => $params,
    'aliases'        => [
        '@api' => '@app/modules/api'
    ]
];

if(YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
