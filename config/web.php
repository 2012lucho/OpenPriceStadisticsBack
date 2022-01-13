<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7hSF802zvlVYMSbq6E6hQlhCvJ-dQw0C',
            'parsers' => [
               'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => null,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
          'class' => 'yii\swiftmailer\Mailer',
          'transport' => [
              'class' => 'Swift_SmtpTransport',
              'host' => 'mail-v2.coodesoft.com.ar',  // ej. smtp.mandrillapp.com o smtp.gmail.com
              'username' => 'postmaster@coodesoft.com.ar',
              'password' => '**c00des0ft**',
              'port' => '587', // El puerto 25 es un puerto común también
              'encryption' => 'tls', // Es usado también a menudo, revise la configuración del servidor
            ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
              
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'login',
                'pluralize' => false,
              ],
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'change-password',
                'pluralize' => false,
              ],
              
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'user',
              ],
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'register',
              ],
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'confirm-email',
              ],
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'change-password-token',
                'pluralize' => false,
              ],
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'password-reset',
                'pluralize' => false,
              ],
              [ 'class' => 'yii\rest\UrlRule',
                'controller' => 'resend-email-verification',
                'pluralize' => false,
              ],
              
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-branch', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-category', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-enterprice', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-price', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-product-category', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-products', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-vendor', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-news', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-incremental-stats', 'pluralize' => false ],
              [ 'class' => 'yii\rest\UrlRule', 'controller' => 'public-enterprice-commercial-item', 'pluralize' => false ],

              'products_by_price' => 'public-search-products/get-by-price',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
